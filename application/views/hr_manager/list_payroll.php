<p class="desc">Disini anda dapat melihat daftar gaji karyawan di sistem ini</p>
<table>
	<tr>
		<th>
			Username
		</th>
		<th>
			Auth
		</th>
		<th>
			Tanggal
		</th>
		<th>
			Gaji
		</th>
		<th>
			Bonus
		</th>
		<th>
			Jumlah
		</th>
		<th>
			Status
		</th>
		<th>
		</th>
	</tr>
	<?php if (is_array($list)) {
	foreach($list as $item) : ?>
		<tr>
			<td>
				<?php echo $item['username']; ?>
			</td>
			<td>
				<?php echo get_job_title($item['auth']); ?>
			</td>
			<td>
				<?php 
					echo $item['tanggal'];
				?>
			</td>
			<td>
				<?php 
					echo $item['gaji'];
				?>
			</td>
			<td>
				<?php 
					echo $item['bonus'];
				?>
			</td>
			<td>
				<?php 
					echo ($item['bonus'] + $item['gaji']);
				?>
			</td>
			<td>
				<?php 
					echo get_status($item['status']);
				?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/payroll/edit_payroll/' . $item['id_payroll']); ?>">edit</a>
				&middot;
				<a href="<?php echo base_url('index.php/payroll/hapus_payroll/' . $item['id_payroll']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; }?>
</table>