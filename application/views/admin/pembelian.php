<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('template/head') ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php $this->load->view('template/preloader') ?>
<?php $this->load->view('template/navbar') ?>
<?php $this->load->view('template/sidebar') ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pembelian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
	  
	  
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
	<section class="content">
		 <div class="container-fluid">
			<div class="row">
				<div class="col-12">
				 <div class="card">
				  <div class="card-header">
					<h3 class="card-title">Daftar Pembelian</h3>
					<button class="btn btn-primary float-right ml-2 mb-2" id="btn-create" onclick="return tambah()">
						<i class="fa fa-plus"></i>
						Create
					</button>
				<form class="float-right" method="POST">
					<button name="cari" type="submit" class="btn btn-primary float-right ml-2 mb-2">
						<i class="fas fa-search"></i>
						Cari
					</button>
					<div class="form-group float-right">
						<input type="date" name="sampai" class="form-control" value="<? $sampai ?>">
					</div>
					<div class="form-group float-right p-2">
						Sampai
					</div>
					<div class="form-group float-right">
						<input type="date" name="dari" class="form-control" value="<? $dari ?>">
					</div>
					<div class="form-group float-right p-2">
						Dari
					</div>

				</form>

				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">
				 
					<table id="example1" class="table table-bordered table-striped">
					  <thead>
					  <tr>
						<th>No</th>
						<th>Nama Supplier</th>
						<th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Total Bayar</th>
						<th>Action</th>
				  </tr>
					  </thead>
					  <tbody>
					  <?php $no=1; foreach($read_pembelian as $o){
						 ?>
					  <tr>
						<td><?= $no++ ?></td>
						<td><?= $o->nama_supplier ?></td>
						<td><?= date('d/m/Y',strtotime($o->waktu)) ?></td>
                        <td><?= date('H:i',strtotime($o->waktu)) ?></td>
                        <td>Rp <span class="float-right">
                            <?= number_format($o->total_bayar, 0, ".", "."); ?>
                        </td>
    					<td>
											 <a class="btn btn-secondary btn-sm"
											 href="<?= base_url()?>Admin/CetakFakturPembelian/<?= $o->id ?>"
											 target="_blank">
												 <i class="fas fa-print"></i>
												 Print
					  						 </a>
											 <button type="button" class="btn btn-danger btn-sm" onclick="return hapus(`<?= $o->id ?>`,`<?= $o->nama_supplier ?>`)">
												 <i class="fa fa-trash"></i>
												 Delete
											 </button> 
						 </td>

					</tr>
					  <?php }  ?>
					 </tbody>
					</table>
					</div>
				</div>
			</div>
		 </div>
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php $this->load->view('template/footer') ?>

</div>
<!-- ./wrapper -->
 <?php $this->load->view('template/script') ?>
</body>

<!--Modal-->


		<div id="Modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form>
						<input type="hidden" name="id">
						
						<span id="modal-body-update-or-create">
							<div class="form-group">
								<label>Supplier</label>
								<select class="form-control selectpicker" name="id_supplier" data-live-search="true" >
									<?php foreach($read_sp as $r){ ?>
									<option value="<?= $r->id ?>"><?= $r->nama_supplier ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Produk</label>
								<select class="form-control selectpicker" name="id_produk" data-live-search="true" onchange="return getProduk2()">
									<?php foreach($read_pr as $p){ ?>
									<option value="<?= $p->id ?>"><?= $p->nama_barang ?></option>
									<?php } ?>
								</select>
							</div>
							<span id="data-produk">
								<input type="text" name="nama_barang" class="form-control d-none" readonly>
								<div class="form-group">	
									<label>Harga Beli</label>
									<input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli" readonly>
								</div>
							</span>
							<div class="form-group">
								<label>Tanggal Pembelian</label>
								<input type="date" name="waktu" class="form-control" placeholder="Tanggal Pembelian">
							</div>
						</form>
							<label>Qty</label>
							<input type="number" name="kuantitas" class="form-control" placeholder="Kuantitas" onkeyup="return simpan()">
						
							<div class="form-group m-2">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th class="text-center">Produk</th>
											<th class="text-center">Kuantitas</th>
											<th class="text-center">Harga</th>
											<th class="text-center">Total</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody id="keranjang">
										<?php foreach ($this->cart->contents() as $items) { 
											echo'
											<tr>
												<td>'.$items['name'].'</td>
												<td>'.$items['qty'].'</td>
												<td>'.$items['price'].'</td>
												<td>'.($items['qty']*$items['price']).'</td>
												<td><center><button type="button" onclick="return batal()" id="'.$items['rowid'].'" class="btn btn-sm btn-danger cancel-cart" data-id="'.$items['id'].'"><i class="fa fa-times"></i></button></center></td>
											</tr>';
										} ?>
									</tbody>
								</table>
							</div>
						
                   		</span>
						
						<span id="modal-body-delete">
							Are you sure want to delete <b id="name-delete"></b> from this table?
						</span>
											
					</div>
					<div class="modal-footer">
					    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Back</button>
						<button type="button" onclick="return save()" class="btn btn-success" id="modal-button">Save</button>
					
					</div>
				</div>
			</div>
		</div>
	
	<script>
		$(function () {
			$("#example1").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});

		function simpan(){
			var id = $('[name="id_produk"]').val();
			var qty = $('[name="kuantitas"]').val();
			if (event.key ==="Enter") { 
				$('#keranjang').load("AddCart2/"+id+"/"+qty);
			}
		}

		function save(){
			var id_supplier = $('[name="id_supplier"]').val();
			$.ajax({
				url		: "<?= base_url()?>Admin/SaveTransaksiPembelian",
				method	: "POST",
				data	: {id_supplier:id_supplier},
				success	: function(data){
					window.location = "<?= base_url()?>Admin/pembelian";
				}
			});
		}

		function batal(row_id){
			$('#keranjang').load("DeleteCart2/"+row_id);
		}

		function getProduk2() {
			var id = $('[name="id_produk"]').val();
			$('#data-produk').load("getProduk2?id=" + id);
		};

		function tambah() {
			$('#Modal').modal('show');
			$('#modal-header').html('<i class="fa fa-plus"></i> Save');
			$('#modal-body-update-or-create').removeClass('d-none');
			$('#modal-body-delete').addClass('d-none');
			$('#modal-button').html('Create');
			$('#modal-button').removeClass('btn-danger');
			$('#modal-button').addClass('btn-success');
			$('#modal-button').attr('onclick', 'return save()');

			$('[name="id"]').val("");
			$('[name="id_supplier"]').val("1");
			$('[name="id_produk"]').val("");
			$('[name="nama_barang"]').val("");
			$('[name="harga_jual"]').val("");
			$('[name="harga_beli"]').val("");
			$('[name="kuantitas"]').val("1");
			$('[name="tanggal"]').val("");

	
		};
			
			function btn_update (id,nama){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-pencil"></i> Update');
				$('#modal-body-update-or-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Update');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
					
				$('[name="id"]').val(id);
				$('[name="nama"]').val(nama);
											
				
			};
			
			function hapus (id,nama_supplier){
				$('#Modal').modal('show');
				$('#modal-button').html('Delete');
				$('#modal-button').removeClass('btn-success');
				$('#modal-button').addClass('btn-danger');
				$('#modal-body-update-or-create').hide();
				$('#modal-body-delete').show();
				$('#modal-header').html('<i class="fa fa-trash"></i> Delete');
				$('#modal-button').attr('onclick', 'return hapuss()');
								
				$('[name="id"]').val(id);
				$('#name-delete').html(nama_supplier);
								
			};

			function hapuss(){
				var id = $('[name="id"]').val();
				$.ajax({
					url		: "<?= base_url()?>Admin/pembelian_delete",
					method	: "POST",
					data	: {id: id},
					success	: function(data){
						window.location = "<?= base_url()?>Admin/pembelian";
					}
				});
			}
			
	
	</script>
</html>
