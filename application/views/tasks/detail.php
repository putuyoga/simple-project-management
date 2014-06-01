	<?php //untuk atur warna dan lebar progress
		if($progress > 80)
		{
			$bg = '#27ae60';
		}
		elseif($progress > 40)
		{
			$bg = '#f39c12';
		}
		else
		{
			$bg = '#c0392b';
		}
		
		$width = $progress . '%';
		$style = 'style="background-color: ' . $bg . '; width: ' . $width . '; height: 30px;"';
	?>
	<div id="progress"><span id="percent"><?php echo $progress; ?>%</span><div id="bar" <?php echo $style; ?>></div></div>
	<div style="display: table; border-bottom: 1px solid #ececec; width: 100%; margin: 20px 0px;">
		<div style="display: table-row;">
			<div style="display: table-cell; width: 50%">
				<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
				<label>assigned to</label>
				<br/>
				<?php if (!file_exists("images/avatar/" . $assigned_to['id'] . ".jpg")) : ?>
					<img src="<?php echo base_url('images/avatar/no.jpg'); ?>" width="50" height="50">
				<?php else: ?>
					<img src="<?php echo base_url("images/avatar/" . $assigned_to['id'] . ".jpg"); ?>" width="50" height="50">
				<?php endif; ?>
				<div class="mediumtext"><?php echo $assigned_to['username']; ?></div>
				
				<label>project</label>
				<br/>
				<div class="mediumtext"><?php echo $project['nama']; ?></div>
				<label>prioritas</label>
				<br/>
				<div class="mediumtext"><img src="<?php echo base_url('images/' . $prioritas . '.png'); ?>"> <?php echo $prioritas; ?></div>
			</div>
			<div style="display: table-cell; width: 30%; text-align: center; vertical-align: middle;">
				<label>deadline</label>
				<br/>
				<div class="bigtext"><?php echo date('d M Y', strtotime($deadline)); ?></div>
			</div>
			<?php
				 $now = time(); // or your date as well
				 $datediff = strtotime($deadline) - $now;
				 $deadline_days = floor($datediff/(60*60*24));
			?>
			<div style="display: table-cell; text-align: center; vertical-align: middle; width: 20%; background: #ECECEC;">
				<label>sisa waktu</label>
				<div class="extrabigtext"><?php echo $deadline_days; ?></div>
				<div class="mediumtext">HARI LAGI</div>
			</div>
		</div>
	</div>
	<label>deskripsi</label>
	<br/>
	<?php echo $deskripsi; ?>