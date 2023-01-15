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
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
						<th>Nama User</th>
						<th>Akses</th>
						<th>Username</th>
						<th>Action</th>
				  </tr>
					  </thead>
					  <tbody>
					  <?php $no=1; foreach($read_karyawan as $o){
						 ?>
					  <tr>
						<td><?= $no++ ?></td>
						<td><?= $o->nama ?></td>
						<td><?= $o->akses ?></td>
						<td><?= $o->username ?></td>
    					<td>
											 <button class="btn btn-success btn-sm" id="btn-update" onclick="return btn_update(`<?= $o->id ?>`,`<?= $o->nama ?>`,`<?= $o->username ?>`,`<?= $o->akses ?>`,`<?= $o->username ?>`,`<?= $o->password ?>`)" >
												 <i class="fa fa-pen"></i>
												 Update
											 </button>
											 <button type="button" class="btn btn-danger btn-sm" id="btn-delete" onclick="return btn_delete(`<?= $o->id ?>`,`<?= $o->nama ?>`)">
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
				$('#modal-body-create').show();
				$('#modal-body-update').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Create');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
				
				$('[name="id"]').val("");
				$('[name="nama"]').val("");
				$('[name="username"]').val("");
				$('[name="akses"]').val("");
				$('[name="username"]').val("");
				$('[name="password"]').val("");
			
				
				document.form.action = '<?php echo base_url();?>kasir/Create3';
			});
			
				function btn_update (id,nama,username,akses,password){
				$('#Modal').modal('show');
				
				$('#modal-header').html('<i class="fa fa-pen"></i> Update');
				$('#modal-body-update').hide();
				$('#modal-body-create').show();
				$('#modal-body-delete').hide();
				$('#modal-button').html('Update');
				$('#modal-button').removeClass('btn-danger');
				$('#modal-button').addClass('btn-success');
					
				$('[name="id"]').val(id);
				$('[name="nama"]').val(nama);
				$('[name="username"]').val(username);
				$('[name="akses"]').val(akses);
				$('[name="password"]').val(password);
				
				
				document.form.action = '<?php echo base_url();?>kasir/Update3';
			};
			
			function btn_delete (id,nama){
				$('#Modal').modal('show');
				$('#modal-button').html('Delete');
				$('#modal-button').removeClass('btn-success');
				$('#modal-button').addClass('btn-danger');
				$('#modal-body-create').hide();
				$('#modal-body-update').hide();
				$('#modal-body-delete').show();
				$('#modal-header').html('<i class="fa fa-trash"></i> Delete');
				
				// var id = $(this).data('id');
				// var nama_barang = $(this).data('nama_barang');
				
				$('[name="id"]').val(id);
				$('#name-delete').html(nama);
				
				document.form.action = '<?php echo base_url();?>kasir/Delete3';
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
						
						<span id="modal-body-update">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" placeholder="Username">	
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						</span>

						<span id="modal-body-create">						
								
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">	
							</div>	
							<div class="form-group">
								<label>Akses</label>
								<select class="form-control selectpicker" data-live-search="true" name="akses">							
									<option value="admin">Admin</option>
									<option value="kasir">Kasir</option>							
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

</html>
