	<div style="display: table; border-bottom: 1px solid #ececec; width: 100%; margin-bottom: 15px;">
		<div style="display: table-row;">
			<div style="display: table-cell; width: 30%">
				<?php $style = 'style=" width: 100%; margin-bottom: 20px"'; ?>
                <label>Biaya :</label>
                <div class="mediumtext"><?php echo $list['harga']; ?></div>
			</div>
            <div style="display: table-cell; width: 35%">
            	<label>Pelanggan :</label>
				<br/>
				<div class="mediumtext"><?php echo $list['nama_pelanggan']; ?></div>
				<label>Status :</label>
				<br/>
				<div class="mediumtext"><?php echo $list['status']; ?></div>
            </div>
			<div style="display: table-cell; width: 35%; text-align: center; vertical-align: middle;">
				<label>Sales Person :</label>
				<br/>
				<div class="bigtext"><?php echo $list['sales_person']; ?></div>
				
				<label>Tanggal :</label>
				<br/>
				<div class="bigtext"><?php echo date('d M Y', strtotime($list['tanggal'])); ?></div>
			</div>
		</div>
	</div>
    
    			<div style="display: table-cell; text-align: center; vertical-align: middle; width: 20%; background: #ECECEC;">
				<label>Catatan :</label>
				<div class="mediumtext"><?php echo $list['catatan']; ?></div>
			</div>