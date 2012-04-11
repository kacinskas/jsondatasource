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
<h2><?php echo 'Manage Readers'; ?></h2>
<?php
if (Configure::read('debug') > 0):
    Debugger::checkSecurityKeys();
endif;
?>
<?php echo $this->Session->flash(); ?>
<div class="actions">
    <?php echo $this->Html->link('Create new reader', array('action' => 'create')); ?>
</div>
<table>
    <tr>
        <th><?php echo $this->Paginator->sort('username', 'Username'); ?></th>
        <th><?php echo $this->Paginator->sort('email', 'Email'); ?></th>
        <th><?php echo 'News List'; ?></th>
        <th><?php echo $this->Paginator->sort('created', 'Created'); ?></th>
        <th><?php echo $this->Paginator->sort('updated', 'Updated'); ?></th>
        <th><?php echo $this->Paginator->sort('updated_by', 'Updated by'); ?></th>
        <th><?php echo 'View'; ?></th>
        <th><?php echo 'Edit'; ?></th>
        <th><?php echo 'Delete'; ?></th>
    </tr>
    <?php foreach ($data as $record): ?>
        <tr>
            <td><?php echo $record['Reader']['username']; ?> </td>
            <td><?php echo $this->Html->link($record['Reader']['email'], 'mailto:'); ?> </td>
            <td><?php echo implode(', ', $record['Reader']['news']); ?> </td>
            <td><?php echo $record['Reader']['created']; ?> </td>
            <td><?php echo $record['Reader']['updated']; ?> </td>
            <td><?php echo $record['Reader']['updated_by']; ?> </td>
            <td class="actions submit"><?php echo $this->Html->link('View', array('action' => 'view', $record['Reader']['id'])); ?> </td>
            <td class="actions submit"><?php echo $this->Html->link('Edit', array('action' => 'edit', $record['Reader']['id'])); ?> </td>
            <td class="actions"> <?php
    echo $this->Form->create('Reader', array('action' => 'delete'));
    echo $this->Form->input('id', array('type' => 'hidden', 'value' => $record['Reader']['id']));
    echo $this->Form->end('Delete');
        ?> </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="paging">
    <?php
// Shows the next and previous links
    echo $this->Paginator->prev('« Previous', null, null, array('class' => 'disabled'));
// Shows the page numbers
    echo $this->Paginator->numbers();
    echo $this->Paginator->next('Next »', null, null, array('class' => 'disabled'));

// prints X of Y, where X is current page and Y is number of pages
    echo $this->Paginator->counter();
    ?>
</div>
