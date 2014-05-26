<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/anytime.5.0.1-1403131246.min.css">
	<script src="<?php echo base_url(); ?>js/jquery-1.11.0.min.js"></script>
</head>
<body>
<div id="wrapper">
	<div id="sidebar">
		<?php if(isset($sidebar)) echo $sidebar; ?>
	</div>
	<div id="content">
		<div class="header">
			<h2><?php echo $judul; ?></h2>
			<ul class="menu_horizontal" style="margin-left: 50px;">
				<li><a href="default.asp">baru</a></li>
			</ul>
			<small><?php if(isset($pesan)) echo $pesan; ?></small>
		</div>
		<div>
		
		