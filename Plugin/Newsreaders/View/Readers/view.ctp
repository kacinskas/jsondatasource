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
<h2><?php echo 'View Reader'; ?></h2>
<?php
if (Configure::read('debug') > 0):
    Debugger::checkSecurityKeys();
endif;
?>
<?php echo $this->Session->flash(); ?>

<div class="actions">
    <?php echo $this->Html->link('View all', array('action' => 'index')); ?>
    <?php echo $this->Html->link('Create', array('action' => 'create')); ?>
    <?php echo $this->Html->link('Edit', array('action' => 'edit', $model->id)); ?>
</div>

<table>
    <?php foreach ($model->data[$model->alias] as $attribute => $value): ?>
        <tr>
            <td><strong><?php echo $attribute ?></strong>:</td>
            <td><?php echo (is_array($value)) ? implode(', ', $value) : $value; ?> </td>
        </tr>
    <?php endforeach; ?>
</table>
