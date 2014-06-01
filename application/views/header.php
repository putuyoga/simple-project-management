<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/anytime.5.0.1-1403131246.min.css">
	<link href="<?php echo base_url('css/select2.css'); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url('css/jquery-te-1.4.0.css'); ?>" rel="stylesheet"/>
	<link href="<?php echo base_url('css/simple-slider.css'); ?>" rel="stylesheet"/>
	<script src="<?php echo base_url('js/jquery-1.11.0.min.js'); ?>"></script>
	
</head>
<body>
<div id="wrapper">
	<div id="sidebar">
		<?php if(isset($sidebar)) echo $sidebar; ?>
	</div>
	<div id="content">
		<div class="header">
			<h2><?php echo $judul; ?></h2>
			<?php if(isset($topbar)) echo $topbar; ?>
			<small><?php if(isset($pesan)) echo $pesan; ?></small>
		</div>
		<div>
		
		