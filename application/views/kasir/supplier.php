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
            <h1 class="m-0">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
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
						<th>Nama Supplier</th>
						<th>Alamat</th>
						<th>No HP</th>
						<th>Action</th>
				  </tr>
					  </thead>
					  <tbody>
					  <?php $no=1; foreach($read_supplier as $o){
						 ?>
					  <tr>
						<td><?= $no++ ?></td>
						<td><?= $o->nama_supplier ?></td>
						<td><?= $o->alamat ?></td>
						<td><?= $o->no_hp ?></td>
						<td>
											 <button class="btn btn-success btn-sm" onclick="return btn_update(`<?= $o->id ?>`,`<?= $o->nama_supplier ?>`,`<?= $o->alamat ?>`,`<?= $o->no_hp?>`)" >
												 <i class="fa fa-pen"></i>
												 Update
											 </button>
											 <button type="button" class="btn btn-danger btn-sm" id="btn-delete" onclick="return btn_delete(`<?= $o->id ?>`,`<?= $o->nama_supplier ?>`)">
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

	
			
			$(document).on('click','#btn-create',function(){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-plus"></i> Create');
				$('#modal-body-update-or-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Create');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
				
				$('[name="id"]').val("");
				$('[name="nama_supplier"]').val("");
				$('[name="alamat"]').val("");
				$('[name="no_hp"]').val("");
				
				document.form.action = '<?php echo base_url();?>kasir/Create4';
			});
			
			function btn_update (id,nama_supplier,alamat,no_hp){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-pen"></i> Update');
				$('#modal-body-update-or-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Update');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
					
				$('[name="id"]').val(id);
				$('[name="nama_supplier"]').val(nama_supplier);
				$('[name="alamat"]').val(alamat);
				$('[name="no_hp"]').val(no_hp);
								
				document.form.action = '<?php echo base_url();?>kasir/Update4';
			};
			
			function btn_delete (id,nama_supplier){
				$('#Modal').modal('show');
				$('#modal-button').html('Delete');
				$('#modal-button').removeClass('btn-success');
				$('#modal-button').addClass('btn-danger');
				$('#modal-body-update-or-create').hide();
				$('#modal-body-delete').show();
				$('#modal-header').html('<i class="fa fa-trash"></i> Delete');
				
				// var id = $(this).data('id');
				// var nama_barang = $(this).data('nama_barang');
				
				$('[name="id"]').val(id);
				$('#name-delete').html(nama_supplier);
				
				document.form.action = '<?php echo base_url();?>kasir/Delete4';
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
								<label>Nama Supplier</label>
								<input type="text" name="nama_supplier" class="form-control" placeholder="Nama Supplier">
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="alamat" class="form-control" placeholder="Alamat"> </textarea>
							</div>
							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="no_hp" class="form-control" placeholder="No HP">
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

</html>