<p class="desc">Disini anda dapat melihat daftar pelanggan di sistem ini</p>
<table>
	<tr>
    	<th>
			ID Order
		</th>
		<th>
			ID Pelanggan
		</th>
		<th>
			Status
		</th>
		<th>
			Harga
		</th>
        <th>
			Tangal
		</th>
        <th>
			Catatan
		</th>
		<th>
		</th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
        	<td>
            <a href="<?php echo base_url(); ?>/index.php/order/edit_order/<?php echo $item['id']; ?>">
				<?php echo $item['id']; ?>
			</td>
			<td>
					<?php echo $item['id_pelanggan']; ?>
				</a>
			</td>
			<td>
				<?php echo $item['status']; ?>
			</td>
            <td>
				<?php echo $item['harga']; ?>
			</td>
            <td>
				<?php echo $item['tanggal']; ?>
			</td>
            <td>
				<?php echo $item['catatan']; ?>
			</td>
			<td>
				<a href="<?php echo base_url('index.php/order/hapus_order/' . $item['id']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>