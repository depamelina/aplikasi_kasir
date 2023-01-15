<?php
foreach ($getProduk2 as $g) {
?>
    <input type="text" class="form-control d-none" name="nama_barang" value="<?= $g->nama_barang ?>" readonly>
    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" value="<?= $g->harga_beli ?>" readonly>
    </div>
<?php } ?>