<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Boston PHP Raffle: '); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css( array('reset','screen'));
		echo $this->Html->script( array('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js','https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js', 'enhancements'));
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="container">
		<div id="header" class="group">
			<h1 class="logo"><?php echo $html->link( 'BostonPHP', 'http://www.meetup.com/bostonphp/', array( 'title' => 'Back to BostonPHP' ) ); ?></h1>
			<ul>
				<li><?php echo $html->link( 'RSVP', array('controller'=>'rsvps','action'=>'index') ); ?>
				<li><?php echo $html->link( 'Admin', array('controller'=>'admin') ); ?>
			</ul>
		</div>
		<div id="content" class="group">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<div id="credits">
			<p>App created by <?php echo $html->link( 'Michael Bourque', 'http://www.meetup.com/bostonphp/members/5046031/'); ?>, <?php echo $html->link( 'Andrew Drane', 'http://www.meetup.com/bostonphp/members/8266401/'); ?>, and <?php echo $html->link( 'Yifei Zhang', 'http://yifei.co/'); ?>. Made with CakePHP, MySQL, jQuery, and jQuery UI. 'Green Check' icon courtesy of <?php echo $html->link( 'Deziner Folio', 'http://www.dezinerfolio.com/'); ?>.</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>