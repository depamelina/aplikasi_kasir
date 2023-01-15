<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('template/head') ?>
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/AdminLTE-3.2.0/dist/css/paper.css"> -->
</head>

<body class="A4">  
<br>
    <table align="center" width="100%" style="margin-top: 10px;">
        <tr>
            <td align="right">
                <img src="<?= base_url() ?>assets/AdminLTE-3.2.0/dist/img/logo-LP3I.png" width="120">
            </td>
            <td>    <h2 class="text-center">RE Politeknik LP3I Kampus Tasikmalaya</h2>
                    <h4 class="text-center">Jalan Ir. H Djuanda KM. 2 No 106. Panglayungan, Kec. Cipedes, Tasikmalaya, Jawa Barat 46151
                    <br> Telepon : (0265) 311766</h4>
            </td>
        </tr>
     
    </table>
    <hr noshade size=4 width="98%">
    <div class="text-center">
            <h4><b>Laporan Pembelian</b></h4>
             <!-- <?php $no=1; foreach($read_pembelian as $o){}		
                ?>
                Supplier : <?= $o->nama_supplier ?><br> -->
                Dari     : <?= date('d/m/Y',strtotime($dari)) ?><br>
                Sampai   : <?= date('d/m/Y',strtotime($sampai)) ?><br><br>
     </div>
    
    
    <table id="tabelku" class="table table-bordered table-striped">
			<thead>
				<tr>
					
					<th class="text-center">Nama Produk</th>
                    <th class="text-center">Penjualan</th>
                    <th class="text-center">Kuantitas</th>
					<th class="text-center">Harga Jual</th>
                    <th class="text-center">Harga Beli</th>    
                    <th class="text-center">Total Harga Beli</th>
                    <th class="text-center">% Margin</th> 
                    <th class="text-center">Margin</th> 
                    <th class="text-center">Total Margin</th> 
                    
                    
				</tr>
			</thead>

			<tbody>
			    <?php 
                    $no=1; 
                    foreach($read_pembelian as $d){
				 ?>
				<tr>
				                    
					<td><?= $d->nama_produk ?></td>
                    <td>Rp <span class="float-right">
                            <?= number_format($d->harga_jual*$d->kuantitas, 0, ".", "."); ?>
                    </td>
                    <td><?= $d->kuantitas ?></td> 
					<td>Rp <span class="float-right">
                            <?= number_format($d->harga_jual, 0, ".", "."); ?></td>
                    <td>Rp <span class="float-right">
                            <?= number_format($d->harga_beli, 0, ".", "."); ?></td>
                    <td>Rp <span class="float-right">
                            <?= number_format($d->harga_beli*$d->kuantitas, 0, ".", "."); ?>
                    </td> 
                    <td> <?= ($d->harga_jual-$d->harga_beli)/$d->harga_beli; ?></td> 
                    <td> <?= number_format($d->harga_jual-$d->harga_beli, 0, ".", "."); ?></td> 
                    <td><?= number_format(($d->harga_jual-$d->harga_beli)*$d->kuantitas, 0, ".", "."); ?></td>
                    
                         
				</tr>
                <?php }  
                ?>
			</tbody>
	</table>

    <br><br>
<div class="container">
    <div class="row">
        <div class="col">
        
        </div>
        <div class="col">
        
        </div>
        <div class="col text-center">
                Tasikmalaya, 14 06 2022<br>
                Mengetahui<br>
                Kepala Kampus<br><br><br>
                H. Rudi Kurniawan, S.T., M.M<br>
                NIP. xxxxxxxxx xxxxx xxxxx
        </div>
    </div>
</div>


    </div>

</body>