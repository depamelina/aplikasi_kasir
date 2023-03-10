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
            <h1 class="m-0">Laporan Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pembelian</li>
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
				<div class="col-6">
				 <div class="card">
				  <div class="card-header">
				 
					
				  </div>
				  <!-- /.card-header -->
					<div class="card-body">
						<form action="<?= base_url()?>Kasir/CetakLaporanPembelian" target="_blank">
						<div class="col-12">
							<div class="form-group">
								<label>Dari</label>
								<input type="date" name="dari" value="<?= $dari ?>" class="form-control">
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Sampai</label>
								<input type="date" name="sampai" value="<?= $sampai ?>" class="form-control">
							</div>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-success">Cetak</button>
						</div>
					</form>
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

</html>
