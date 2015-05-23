<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Thi Trắc Nghiệm');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');

		echo "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";

	   	echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
		echo $this->fetch('script');
		//echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css');
		echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
		echo $this->Html->css('stylesMenu');
		echo $this->Html->script('jquery-1.11.2.min');
		echo $this->Html->script('scriptMenu');

	?>

  
</head>
<body>
	<div id="container">
		<div id="header">
			<div id='cssmenu'>
			<ul>
			   <!-- <li class='active'><a href='#'>Home</a></li> -->
			   <?php
			   echo "<li>".$this->Html->link('Home', array('controller' => 'Pages','action' => 'display'))."</li>";
			   echo "<li>".$this->Html->link('Test', array('controller' => 'Tests','action' => 'index'))."</li>";
			   echo "<li>".$this->Html->link('Question', array('controller' => 'Questions','action' => 'index'))."</li>";
			   if($this->Session->read('Auth.User.role') != "student" && $this->Session->read('Auth.User')) {
			   		echo "<li>".$this->Html->link('Chấm Thi', array('controller' => 'Users','action' => 'examiner'))."</li>";
			   }
			   echo "<li>".$this->Html->link('Luyện Tập', array('controller' => 'Users','action' => 'training'))."</li>";
			   echo "<li>".$this->Html->link('Profile', array('controller' => 'Users','action' => 'viewProfile'))."</li>";
			   if($this->Session->read('Auth.User'))
			   		echo "<li>".$this->Html->link('Log Out', array('controller' => 'Users','action' => 'logout'))."</li>";
			   ?>
			</ul>
			</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
