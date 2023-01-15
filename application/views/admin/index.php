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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
          <div class="m-5">
          <div class="m-5">
            <div class="m-3">
            <canvas id="myChart" class="col-12"></canvas>
            </div>
          </div>
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
</body>
<!-- ./wrapper -->
<?php $this->load->view('template/script') ?>


<script src="<?= base_url() ?>assets/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<script>
  var xValues = ["Penjualan", "Pembelian", "Laba"];
	var yValues = [<?= $penjualan ?>, <?= $pembelian ?>, <?= $laba ?>];
	var barColors = ["#047cfc", "#068cfc","#047cfc"];

	new Chart("myChart", {
	  type: "bar",
	  data: {
		labels: xValues,
		datasets: [{
		  backgroundColor: barColors,
		  data: yValues
		}]
	  },
	  options: {
		legend: {display: false},
		title: {
		  display: true,
		  text: "Chart Penjualan, Pembelian, dan Laba"
		},
		scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
		}
	  }
	});


</script>
</html>
