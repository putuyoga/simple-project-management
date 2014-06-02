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
			Harga
		</th>
        <th>
			Tangal
		</th>
		<th>
		</th>
	</tr>
    <?php $user = $list[0]['user']; ?>
	<?php foreach($list as $item) : ?>
		<tr>
        	<td>
            	<a href="<?php echo base_url('index.php/order/detail_order/' . $item['id']); ?>">
				<?php echo $item['nama']; ?>
                </a>
			</td>
			<td>
					<?php echo $item['nama_pelanggan']; ?>
				</a>
			</td>
			<td>
				<?php echo $item['status']; ?>
			</td>
            <td>
				<?php echo $item['harga']; ?>
			</td>
            <td>
				<?php echo date('d M Y',strtotime($item['tanggal'])); ?>
			</td>
			<td>
            <?php if($item['sales_person']==$user): ?>
				<a href="<?php echo base_url('index.php/order/edit_order/' . $item['id']); ?>">edit</a>
                &middot;
				<a href="<?php echo base_url('index.php/order/hapus_order/' . $item['id']); ?>">hapus</a>
            <?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
