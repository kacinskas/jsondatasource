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
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
if (Configure::read('debug') == 0):
    throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
//App::uses('Paginator', 'Utility');
?>
<div class="users form">
    
<h2><?php echo 'Edit reader'; ?></h2>
<?php
if (Configure::read('debug') > 0):
    Debugger::checkSecurityKeys();
endif;
?>
<?php echo $this->Session->flash(); ?>

<div class="actions">
    <?php echo $this->Html->link('View all', array('action' => 'index')); ?>
    <?php echo $this->Html->link('Create', array('action' => 'create')); ?>
    <?php echo $this->Html->link('Delete', array('action' => 'delete', $this->request->data('Reader._id'))); ?>
</div>

<?php
echo $this->Form->create('Reader');
echo $this->Form->input('id');
echo $this->Form->input('username', array('label' => 'Username'));
echo $this->Form->input('email', array('label' => 'Email', 'type' => 'text'));
echo $this->Form->end('Save');
?>
</div>
