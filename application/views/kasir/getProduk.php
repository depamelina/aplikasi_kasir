<?php
foreach ($getProduk as $g) {
?>
    <input type="text" class="form-control d-none" name="nama_barang" value="<?= $g->nama_barang ?>" readonly>
    <div class="form-group">
        <label>Harga Jual</label>
        <input type="number" class="form-control" name="harga_jual" value="<?= $g->harga_jual ?>" readonly>
    </div>
<?php } ?>