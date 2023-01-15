<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('template/head') ?>
</head>

<body>  

    <?php foreach ($ht_penjualan as $h) {}
    ?>
    Customer    : <?= $h->nama_customer ?><br>
    Tanggal     : <?= date('d/m/Y',strtotime($h->waktu)) ?><br>
    <table id="tabelku" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Nama Produk</th>
					<th class="text-center">Harga Produk</th>
                    <th class="text-center">Kuantitas</th>
                    <th class="text-center">Jumlah</th>
				</tr>
			</thead>

			<tbody>
			    <?php 
                    $no=1; 
                    foreach($dt_penjualan as $d){
				 ?>
				<tr>
					<!-- <td class="text-center"><?= $no++ ?></td> -->
                    <td>1</td>
					<td><?= $d->nama_produk ?></td>
					<td>Rp <span class="float-right">
                            <?= number_format($d->harga_jual, 0, ".", "."); ?></td>
                    <td><?= $d->kuantitas ?></td>
                    <td>Rp <span class="float-right">
                            <?= number_format($d->harga_jual*$d->kuantitas, 0, ".", "."); ?>
                    </td>
				</tr>
                <?php }  
                ?>
			</tbody>
	</table>

</body>