<p class="desc">Disini anda dapat melihat daftar pelanggan di sistem ini</p>
<table>
	<tr>
    	<th>
			ID
		</th>
		<th width="1000px">
			Nama
		</th>
		<th>
			Email
		</th>
		<th>
			No. Telp.
		</th>
        <th>
			Website
		</th>
        <th>
			Alamat
		</th>
		<th>
		</th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
        	<td>
				<?php echo $item['id']; ?>
			</td>
			<td>
				<a href="<?php echo base_url(); ?>/index.php/pelanggan/edit_pelanggan/<?php echo $item['id']; ?>">
					<?php echo $item['nama']; ?>
				</a>
			</td>
			<td>
				<?php echo $item['email']; ?>
			</td>
            <td>
				<?php echo $item['no_telp']; ?>
			</td>
            <td>
				<?php echo $item['website']; ?>
			</td>
            <td>
				<?php echo $item['alamat']; ?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/pelanggan/hapus_pelanggan/' . $item['id']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>