<p class="desc">Disini anda dapat melihat daftar pelanggan di sistem ini</p>
<table>
	<tr>
    	<th>
			Nama
		</th>
		<th>
			Pelanggan
		</th>
		<th>
			Status
		</th>
        <th>
			Sales
		</th>
        <th>
			Tanggal
		</th>
		<th>
		</th>
	</tr>
	<?php foreach($list as $item) : ?>
		<tr>
        	<td><a href="<?php echo base_url('index.php/order/detail_order/' . $item['id']); ?>">
				<?php echo $item['nama']; ?>
                </a>
			</td>
			<td>
				<?php echo $item['nama_pelanggan']; ?>
			</td>
			<td>
				<?php echo $item['status']; ?>
			</td>
            <td>
				<?php echo $item['sales_person']; ?>
			</td>
            <td>
	            <?php echo date('d M Y',strtotime($item['tanggal'])); ?>
			</td>
			<td>
            	<a href="<?php echo base_url('index.php/order/edit_order/' . $item['id']); ?>">edit</a>
                &middot;
				<a href="<?php echo base_url('index.php/order/hapus_order/' . $item['id']); ?>">hapus</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
