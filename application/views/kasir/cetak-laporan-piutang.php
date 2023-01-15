<!DOCTYPE html>
<html lang="en">

<head>
    <!-- paper -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/paper/paper.css">
    <?php $this->load->view("template/head") ?>
</head>

<body class="A4">
    <div class="sheet">
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
            <h4><b>Laporan Piutang Karyawan</b></h4>
             <!-- <?php $no=1; foreach($read_pembelian as $o){}		
                ?>
                Supplier : <?= $o->nama_supplier ?><br> -->
                Dari     : <?= date('d/m/Y',strtotime($dari)) ?><br>
                Sampai   : <?= date('d/m/Y',strtotime($sampai)) ?><br><br>
     </div>

        <div style="width:60%; margin-left: 230px; margin-top:20px;">
            <table id="tabelku" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Customer</th>
                        <th class="text-center">Piutang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_piutang = 0;
                    foreach ($penjualan as $b) {
                        $total_piutang += $b->total_omset - $b->total_bayar;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?>.</td>
                            <td><?= $b->nama_customer ?></td>
                            <td>
                                Rp
                                <span class="float-right">
                                    <?= number_format($b->total_omset - $b->total_bayar, 0, ".", "."); ?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"><b>Total</b></td>
                        <td><b>
                                Rp
                                <span class="float-right">
                                    <?= number_format($total_piutang, 0, ".", "."); ?>
                                </span></b>
                        </td>
                    </tr>
                </tbody>
            </table>
            <script>
              
            </script>
        </div>
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

</html>