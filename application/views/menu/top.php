<div>
<?php if (!file_exists("images/avatar/" . $user['id'] . ".jpg")) : ?>
	<img src="<?php echo base_url('images/avatar/no.jpg'); ?>" width="50" height="50" align="right">
<?php else: ?>
	<img src="<?php echo base_url("images/avatar/" . $user['id'] . ".jpg"); ?>" width="50" height="50" align="right">
<?php endif; ?>
</div>
	<ul>
		<li class="job_title">SALES OFFICER</li>
		<li style="font-weight: bold;"><?php echo $user['username']; ?></li>
		<li><a href="<?php echo base_url(); ?>index.php/main/edit_profil">setting</a></li>
		<li><a href="<?php echo base_url(); ?>index.php/main/logout">logout</a></li>
	</ul>