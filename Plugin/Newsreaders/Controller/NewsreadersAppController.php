<?php

class NewsreadersAppController extends AppController {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'readers', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('subscribe', 'subscribed');
    }

}

