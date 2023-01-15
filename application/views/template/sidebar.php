 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?= base_url() ?>assets/AdminLTE-3.2.0/dist/img/my-logoo.png" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light">Daniel Depa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/AdminLTE-3.2.0/dist/img/me.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('nama') ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"  style="color:#047cfc"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php if ($this->session->userdata('akses') == "admin") {
                      echo base_url('Admin');
                    } else {
                      echo base_url('Kasir');
                    } ?>" class="nav-link<?= $this->session->userdata('index') ?>">
             <i class="nav-icon fas fa-home" style="color:#047cfc"></i>
             <p>Dashboard</p>
           </a>
          </li>
	
		  <li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dolly"  style="color:#047cfc" ></i>
              <p>
                Master
                <i class="right fas fa-angle-left"  style="color:#047cfc"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
               <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/produk');
                        } else {
                          echo base_url('Kasir/produk');
                        } ?>" class="nav-link<?= $this->session->userdata('produk') ?>">
                 <i class="far fa-<?= $this->session->userdata('produk') ?>circle nav-icon"></i>
                 <p>Produk</p>
               </a>
              </li>
              <li class="nav-item">
                <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/karyawan');
                        } else {
                          echo base_url('Kasir/error');
                        } ?>" class="nav-link<?= $this->session->userdata('karyawan') ?>">
                 <i class="far fa-<?= $this->session->userdata('karyawan') ?>circle nav-icon"></i>
                 <p>User</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/owner');
                        } else {
                          echo base_url('Kasir/owner');
                        } ?>" class="nav-link<?= $this->session->userdata('owner') ?>">
                 <i class="far fa-<?= $this->session->userdata('owner') ?>circle nav-icon"></i>
                 <p>Owner</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/supplier');
                        } else {
                          echo base_url('Kasir/supplier');
                        } ?>" class="nav-link<?= $this->session->userdata('supplier') ?>">
                 <i class="far fa-<?= $this->session->userdata('supplier') ?>circle nav-icon"></i>
                 <p>Supplier</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/customer');
                        } else {
                          echo base_url('Kasir/customer');
                        } ?>" class="nav-link<?= $this->session->userdata('customer') ?>">
                 <i class="far fa-<?= $this->session->userdata('customer') ?>circle nav-icon"></i>
                 <p>Customer</p>
               </a>
              </li>
              <li class="nav-item">
               <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/kategori');
                        } else {
                          echo base_url('Kasir/kategori');
                        } ?>" class="nav-link<?= $this->session->userdata('kategori') ?>">
                 <i class="far fa-<?= $this->session->userdata('kategori') ?>circle nav-icon"></i>
                 <p>Kategori</p>
               </a>
              </li>
			 </ul>
		
			<li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-coins"  style="color:#047cfc"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"  style="color:#047cfc"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                  <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/penjualan');
                        } else {
                          echo base_url('Kasir/penjualan');
                        } ?>" class="nav-link<?= $this->session->userdata('penjualan') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan</p>
                </a>
              </li>
			 </ul>
			 <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/pembelian');
                        } else {
                          echo base_url('Kasir/pembelian');
                        } ?>" class="nav-link<?= $this->session->userdata('pembelian') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
			 </ul>
		
			<li class="nav-item menu-close">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"  style="color:#047cfc"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"  style="color:#047cfc"></i>
              </p>
            </a>
      <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPenjualanRE');
                        } else {
                          echo base_url('Kasir/LaporanPenjualanRE');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPenjualanRE') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan RE</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPenjualanOwner');
                        } else {
                          echo base_url('Kasir/LaporanPenjualanOwner');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPenjualanOwner') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Per Owner</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPembelian');
                        } else {
                          echo base_url('Kasir/LaporanPembelian');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPembelian') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian</p>
                </a>
              </li>
			 </ul>
			 <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPembelianSupplier');
                        } else {
                          echo base_url('Kasir/LaporanPembelianSupplier');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPembelianSupplier') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembelian Per Supplier</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanProduk');
                        } else {
                          echo base_url('Kasir/LaporanProduk');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanProduk') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Saldo Per Periode</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPiutang');
                        } else {
                          echo base_url('Kasir/LaporanPiutang');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPiutang') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Piutang</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPemasukan');
                        } else {
                          echo base_url('Kasir/LaporanPemasukan');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPemasukan') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pemasukan</p>
                </a>
              </li>
			 </ul>
       <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php if ($this->session->userdata('akses') == "admin") {
                          echo base_url('Admin/LaporanPengeluaran');
                        } else {
                          echo base_url('Kasir/LaporanPengeluaran');
                        } ?>" class="nav-link<?= $this->session->userdata('LaporanPengeluaran') ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pengeluaran</p>
                </a>
              </li>
			 </ul>
		 </nav>
        
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>