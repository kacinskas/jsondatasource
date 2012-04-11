<?php

/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
//App::uses('Newsreaders.NewsreadersAppController', 'Controller');
App::import('Model', 'Newsreaders.Reader');
App::import('Model', 'Newsreaders.Newscategory');

class ReadersController extends NewsreadersAppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Readers';

    /**
     * Default helper
     *
     * @var array
     */
    public $helpers = array('Html', 'Session');

//    /**
//     * Uncoment if controller does not use a model
//     *
//     * @var array
//     */
//    public $uses = array();  



    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('subscribe', 'logout');
    }

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function index() {

        $this->paginate = array(
            'limit' => 5,
            'order' => array(
                'Reader.username' => 'asc'
            )
        );

        $data = $this->paginate('Reader');
        $this->set('data', $data);
    }

    public function edit($id = null) {

        $this->Reader->id = $id;
        if (!$this->Reader->exists()) {
            throw new NotFoundException(__('Invalid reader'));
        }
        
        //@TODO remove this check ;)
        $data = $this->loadData($id);
        if (strtotime($data['Reader']['created']) < strtotime('2012-04-11 20:30:20')) {
            $this->Session->setFlash(__('Are you crazy? Read the name and email. I cant edit him..! Create your own subscriber..'));
            $this->redirect(array('action' => 'index'));
        }
        
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Reader']['updated_by'] = $this->Session->read('Auth.User.username');
            if ($this->Reader->save($this->request->data)) {
                $this->Session->setFlash(__('The reader has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The reader could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->Reader->read(null, $id);
        }
    }

    public function create() {


        $this->set('news', $this->prepareNewsList());

        if ($this->request->is('post')) {
            $this->Reader->create();
            if ($this->Reader->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    public function subscribe() {

        $news = new Newscategory();
        $data = $news->find('list');
        $this->set('news', $data);

        if ($this->request->is('post')) {
            $this->Reader->create();
            if ($this->Reader->save($this->request->data)) {
                $this->redirect(array('action' => 'subscribed'));
            } else {
                $this->Session->setFlash(__('We can not subscribe you. Please, try again.'));
            }
        }
    }

    //show subscribed page
    public function subscribed() {
        
    }

    public function delete($id = null) {

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        //@TODO for some reason dont works with $id; need to investigate...
        if ($id == null) {
            $id = $this->request->data['Reader']['id'];
        }
        $this->Reader->id = $id;
        if (!$this->Reader->exists()) {
            throw new NotFoundException(__('Invalid reader'));
        }

        //@TODO remove this check ;)
        $data = $this->loadData($id);
        if (strtotime($data['Reader']['created']) > strtotime('2012-04-11 20:30:20')) {
            if ($this->Reader->delete($id)) {
                $this->Session->setFlash(__('Reader deleted'));
                $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Reader was not deleted'));
        } else {
            $this->Session->setFlash(__('Are you crazy? Read the name and email. I cant delete him..! Create your own subscriber..'));
        }
        $this->redirect(array('action' => 'index'));
    }

    //@TODO modify other controller actions to use loadmodel, load data
    public function view($id = null) {
        $this->set('model', $this->loadModelData($id));
    }

    public function loadData($id) {
        $this->Reader->id = $id;
        $data = $this->Reader->read();
        if (empty($data)) {
            throw new NotFoundException(__('Invalid reader'));
        }
        return $data;
    }

    public function loadModelData($id) {
        $model = $this->Reader;
        $model->id = $id;
        $data = $model->read();
        if (empty($data)) {
            throw new NotFoundException(__('Invalid reader'));
        }
        $model->set($data);
        return $model;
    }

    public function prepareNewsList() {
        $data = array();
        $news = new Newscategory();
        $list = $news->find('list');
        foreach ($list as $value) {
            $data[$value] = $value;
        }
        return $data;
    }

}
