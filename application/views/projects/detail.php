	<div style="display: table; border-bottom: 1px solid #ececec; width: 100%; margin-bottom: 15px;">
		<div style="display: table-row;">
			<div style="display: table-cell; width: 50%">
				<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
				<label>dari order</label>
				<br/>
				<div class="mediumtext"><?php echo $order['nama']; ?></div>
				
				<label>pelanggan</label>
				<br/>
				<div class="mediumtext"><?php $pelanggan['nama']; ?></div>
				<label>project manager</label>
				<br/>
				<div class="mediumtext"><?php echo $project_manager['username']; ?></div>
			</div>
			<div style="display: table-cell; width: 30%; text-align: center; vertical-align: middle;">
				<label>tanggal mulai</label>
				<br/>
				<div class="bigtext"><?php echo date('d M Y', strtotime($tanggal_mulai)); ?></div>
				
				<label>tanggal selesai</label>
				<br/>
				<div class="bigtext"><?php echo date('d M Y', strtotime($tanggal_selesai)); ?></div>
			</div>
			<?php
				 $now = time(); // or your date as well
				 $datediff = strtotime($tanggal_selesai) - $now;
				 $deadline_days = floor($datediff/(60*60*24));
			?>
			<div style="display: table-cell; text-align: center; vertical-align: middle; width: 20%; background: #ECECEC;">
				<label>deadline</label>
				<div class="extrabigtext"><?php echo $deadline_days; ?></div>
				<div class="mediumtext">HARI LAGI</div>
			</div>
		</div>
	</div>
	<label>anggota tim</label>
	<br/>
	<ul class="wraplist" style="margin-top: 20px;">
		<?php foreach($anggota_tim as $individu): ?>
			<li>
				<?php if (!file_exists("images/avatar/" . $individu['id'] . ".jpg")) : ?>
					<img src="<?php echo base_url('images/avatar/no.jpg'); ?>" width="80" height="80">
				<?php else: ?>
					<img src="<?php echo base_url("images/avatar/" . $individu['id'] . ".jpg"); ?>" width="80" height="80">
				<?php endif; ?>
				<br/>
				<?php echo $individu["username"]; ?>
			</li>
		<?php endforeach; ?>
	</ul>