<span style="text-decoration: underline;"><?php echo $username; ?></span><br/>
<span>total poin bulan ini : <?php echo $poin_bulan; ?></span><br/>
<form action="<?php echo current_url(); ?>" method="post" name="form-poin">
	<input type="hidden" name="id_user" value="<?php echo $id; ?>">
	<input type="text" placeholder="poin" name="poin">
	<input type="submit" name="do-give" value="beri" class="button">
</form>