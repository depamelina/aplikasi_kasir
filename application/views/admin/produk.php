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
            <h1 class="m-0">Produk</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
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
					<button class="btn btn-primary" id="btn-create">
						<i class="fa fa-plus"></i>
						Create
					</button>
				
				  </div>
				  <!-- /.card-header -->
				  <div class="card-body">
				  	
					<table id="example1" class="table table-bordered table-striped">
					  <thead>
					  <tr>
						<th>No</th>
						<th>Nama Produk</th>
						<th>Kuantitas</th>
						<th>Harga Beli</th>
						<th>Harga Jual</th>
						<th>Margin</th>
						<th>Kategori</th>
						<th>ID Owner</th>
						<th class="text-center">Action</th>
					  </tr>
					  </thead>
					  <tbody>
					  <?php $no=1; foreach($read_produk as $d){
						 ?>
					  <tr>
						<td><?= $no++ ?></td>
						<td><?= $d->nama_barang ?></td>
						<td><?= $d->kuantitas ?></td>
						<td><?= $d->harga_beli ?></td>
						<td><?= $d->harga_jual ?></td>
						<td><?= $d->harga_jual-$d->harga_beli ?></td>
						<td><?= $d->id_kategori ?></td>
						<td><?= $d->id_owner ?></td>
						<td>
							<button type="button" class="btn btn-success btn-sm" id="btn-update" onclick="return btn_update(`<?= $d->id ?>`,`<?= $d->nama_barang ?>`,`<?= $d->kuantitas ?>`,`<?= $d->harga_beli ?>`,`<?= $d->harga_jual ?>`,`<?= $d->id_kategori ?>`,`<?= $d->id_owner ?>`)">
									 <i class="fa fa-pen"></i>
									 Update
							 </button>
							 <button type="button" class="btn btn-danger btn-sm" id="btn-delete" onclick="return btn_delete(`<?= $d->id ?>`,`<?= $d->nama_barang ?>`)">
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
<script>

		$(function () {
			$("#example1").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});

		$(document).ready(function() {
			var myTable = $('#table').DataTable({});
		});

			$(document).on('click','#btn-create',function(){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-plus"></i> Create');
				$('#modal-body-update-or-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Create');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
				
				$('[name="id"]').val("");
				$('[name="nama_barang"]').val("");
				$('[name="kuantitas"]').val("");
				$('[name="harga_beli"]').val("");
				$('[name="harga_jual"]').val("");
				$('[name="id_kategori"]').val("");
				$('[name="id_owner"]').val("");
				
				document.form.action = '<?php echo base_url();?>kasir/Create1';
			});
			
			function btn_update (id,nama_barang,kuantitas,harga_beli,harga_jual,id_kategori,id_owner){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-pen"></i> Update');
				$('#modal-body-update-or-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Update');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
					
				$('[name="id"]').val(id);
				$('[name="nama_barang"]').val(nama_barang);
				$('[name="kuantitas"]').val(kuantitas);
				$('[name="harga_beli"]').val(harga_beli);
				$('[name="harga_jual"]').val(harga_jual);
				$('[name="id_kategori"]').val(id_kategori);
				$('[name="id_owner"]').val(id_owner);
				
				document.form.action = '<?php echo base_url();?>kasir/Update1';
			};
			
			function btn_delete (id,nama_barang){
				$('#Modal').modal('show');
				$('#modal-button').html('Delete');
				$('#modal-button').removeClass('btn-success');
				$('#modal-button').addClass('btn-danger');
				$('#modal-body-update-or-create').hide();
				$('#modal-body-delete').show();
				$('#modal-header').html('<i class="fa fa-trash"></i> Delete');
				
				$('[name="id"]').val(id);
				$('#name-delete').html(nama_barang);
				
				document.form.action = '<?php echo base_url();?>kasir/Delete1';
			};
			
		
	</script>
	<!--Modal-->
	<form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
		<div id="Modal" class="modal fade" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="text-align:center">
						<h3 id="modal-header"></h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						
						<input type="hidden" name="id">
						
						<span id="modal-body-update-or-create">
							<div class="form-group">
								<label>Nama Barang</label>
								<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
							</div>
							<div class="form-group">
								<label>Kuantitas</label>
								<input type="number" name="kuantitas" class="form-control" placeholder="Kuantitas">
							</div>
							<div class="form-group">
								<label>Harga Beli</label>
								<input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
							</div>
							<div class="form-group">
								<label>Harga Jual</label>
								<input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual">
							</div>
							<div class="form-group">
								<label>Kategori</label>
								<select class="form-control  selectpicker" data-live-search="true" name="id_kategori">
									<?php foreach($read_kategori as $r){ ?>
									<option value="<?= $r->id ?>"><?= $r->nama ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Owner</label>
								<select class="form-control selectpicker" data-live-search="true" name="id_owner">
									<?php foreach($read_owner as $r){ ?>
									<option value="<?= $r->id ?>"><?= $r->nama_owner ?></option>
									<?php } ?>
								</select>
							</div>
						</span>
						
						<span id="modal-body-delete">
							Are you sure want to delete <b id="name-delete"></b> from this table?
						</span>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Back</button>
						<button type="submit" class="btn btn-success" id="modal-button">Save</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<!--Modal-->
</html>