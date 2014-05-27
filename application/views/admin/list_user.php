<p class="desc">Disini anda dapat melihat daftar user di sistem ini</p>
<table>
	<tr>
		<th>
			Username
		</th>
		<th>
			Email
		</th>
		<th>
			Auth
		</th>
		<th>
		</th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/admin/edit_user/<?php echo $item['id']; ?>">
					<?php echo $item['username']; ?>
				</a>
			</td>
			<td>
				<?php echo $item['email']; ?>
			</td>
			<td>
				<?php 
					echo get_job_title($item['auth']);
				?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/admin/hapus_user/' . $item['id']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>