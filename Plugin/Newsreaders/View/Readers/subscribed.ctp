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

    <h2><?php echo 'Subscription complete'; ?></h2>
    <?php
    if (Configure::read('debug') > 0):
        Debugger::checkSecurityKeys();
    endif;
    ?>
    <div id="flashMessage" class="message success">
        <?php echo "Congratulations, from now you are our new subscriber!<br /> Start reading or " . $this->Html->link('return to subscribe page', array('action' => 'subscribe')); ?>
    </div>
</div>
