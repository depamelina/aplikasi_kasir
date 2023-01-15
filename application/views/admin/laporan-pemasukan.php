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
            <h1 class="m-0">Laporan Pemasukan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Pemasukan</li>
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
						<form action="<?= base_url()?>Admin/CetakLaporanPemasukan" target="_blank">
						<div class="col-12">
							<div class="form-group">
								<label>Bulan</label>
								<select class="form-control  selectpicker" data-live-search="true" name="bulan">
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maret</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Agustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">Desember</option>
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Tahun</label>
								<select name="tahun" class="form-control">
				
												<?php for($i=date('Y');$i>=2022;$i--){
													$select="";
													if($i==$tahun){$select="selected";}
													echo '<option '.$select.' value="'.$i.'">'.$i.'</option>';
												}?>
								</select>
							</div>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Cetak</button>
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
