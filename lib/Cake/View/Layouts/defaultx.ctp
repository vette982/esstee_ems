<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('style', 'stylesheet', array('media' => 'screen'));
		echo $this->Html->css('print', 'stylesheet', array('media' => 'print'));
		echo $this->Html->css('reset');
		echo $this->Html->css('universal');
		echo $this->Html->css('text');
		echo $this->Html->css('960');

		echo $scripts_for_layout;
	?>
</head>
<body>
	<div class="container_12">
		<div class="grid_2 suffix_10" id="header_screen">
			<?php echo $this->Html->image('esstee_logo.gif'); ?>
		</div>
		<div class="grid_2 suffix_10" id="header_print">
			&nbsp;<?php //echo $this->Html->image('esstee_logo_white_bg.png'); ?>
		</div>
		<div class="clear"></div>
		<div class="grid_12" id="nav_bar">
			<?php
				if($this->params['controller'] == 'projects' || $this->params['controller'] == 'invoices') {
					echo $this->Html->link('Projects Home', array('controller' => 'projects', 'action' => 'index'));
					echo ' | ';
					echo $this->Html->link('New Project', array('controller' => 'projects', 'action' => 'add'));
					echo ' | ';
					echo $this->Html->link('Invoices', array('controller' => 'projects', 'action' => 'outstandinginvoices'));
					echo ' | ';
					echo $this->Html->link('Log Out', array('controller' => 'users', 'action' => 'index'));
				} else {
					//do nothing
				}
			?>
		</div>
		<div class="clear"></div>
		<div class="grid_12">
			<?php echo $this->Session->flash(); ?>

		</div>
		<div class="clear"></div>
				<?php echo $content_for_layout; ?>
	</div> <!-- end of #container_12-->
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>