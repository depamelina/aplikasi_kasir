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
       
    <?php 
    $tgl_terakhir =cal_days_in_month(CAL_GREGORIAN,$_GET['bulan'],$_GET['tahun']);
    $dari=$_GET['tahun'].'-'.$_GET['bulan'].'-01';
    
    $sampai = $_GET['tahun'].'-'.$_GET['bulan'].'-'.cal_days_in_month(CAL_GREGORIAN,$_GET['bulan'],$_GET['tahun']);
    //$tgl_terakhir = date('t', strtotime(date("Y-m-d"))); ?>
   <?php $bln_terakhir = $_GET['bulan'] ?>
    <?php $thn_terakhir = $_GET['tahun'] ?>
    <div class="text-center">
            <h4><b>Data Pengeluaran Bulan <?= $bln_terakhir ?> Tahun <?= $thn_terakhir ?></b></h4>
             <!-- <?php $no=1; foreach($read_pembelian as $o){}		
                ?>
                Supplier : <?= $o->nama_supplier ?><br> -->
                <!-- Dari     : <?= date('d/m/Y',strtotime($dari)) ?><br>
                Sampai   : <?= date('d/m/Y',strtotime($sampai)) ?>--><br><br> 
     </div>
 
    <table id="tabelku" class="table table-bordered text-center">
        <tr>
            <th rowspan="2" align="center">Nama Produk</th>
            <th rowspan="2" align="center">Golongan</th>
            <th rowspan="2" align="center">Kategori</th>
            <th colspan="<?= $tgl_terakhir?>">Bulan <?= $bln_terakhir ?></th>
        </tr>
      
         <tr>
         <?php
                  for ($i=1; $i <= $tgl_terakhir ; $i++) { ?>
                       <td><?= $i ?></td>
          <?php } ?>
         </tr>

        
        <?php 
                    $no=1;
     
                    foreach($read_produk as $d){
                        if($d->id_owner ==1){
                            $golongan = "BD";
                        } else {
                            $golongan = "Konsinyasi";
                        }
				 ?>
        <tr>
            <td><?= $d-> nama_barang ?></td>
            <td><?= $golongan ?></td>
            <td><?= $d-> id_kategori ?></td>
            <?php
                  for ($i=1; $i <= $tgl_terakhir ; $i++) {
                    $waktu = $_GET['tahun'].'-';
                    if($_GET['bulan']<10){
                        $waktu .= '0'.$_GET['bulan'].'-';
                    } else {
                        $waktu .= $_GET['bulan'].'-';

                    }
                    if($i<10){
                        $waktu .= '0'.$i;
                    } else {
                        $waktu .= $i;

                    }
                    $select = $this->db->select('sum(kuantitas) as total');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('date_format(waktu,"%Y-%m-%d")',$waktu);
		$select = $this->db->where('id_produk',$d->id);
		$select = $this->db->group_by('ht_penjualan.id');
		$read_penjualan = $this->m->Get_All('ht_penjualan',$select);
        $total = 0;
        foreach($read_penjualan as $p){
            $total = $p->total;
        }
                    ?>
                       <td><?= $total ?></td>
          <?php } ?>
        </tr>
        <?php 
                    }
        ?>
       
	</table>



    <br><br>
    <div class="container">
         <div class="row">
                <div class="col">
                    
                </div>
                <div class="col">
                    
                </div>
                <div class="col text-center">
                            <br>Tasikmalaya, 14 06 2022<br>
                            Mengetahui<br>
                            <b>Kepala Kampus</b><br><br><br><br>
                            <b>H. Rudi Kurniawan, S.T., M.M</b><br>
                            NIP. xxxxxxxxx xxxxx xxxxx
                </div>
         </div>
     </div>


    </div>

</body>