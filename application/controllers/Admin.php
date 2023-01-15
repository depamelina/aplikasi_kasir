<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->model('Models','m');
    }
	public function index()
	{
		$select = $this->db->select('sum(harga_jual) as total_jual');
		$penjualan = $this->m->Get_All('dt_penjualan', $select);
		$data['penjualan']=0;
		foreach($penjualan as $p) {
			$data['penjualan']=$p->total_jual;
		}
		$select = $this->db->select('sum(harga_beli) as total_beli');
		$pembelian = $this->m->Get_All('dt_pembelian', $select);
		$data['pembelian']=0;
		foreach($pembelian as $p) {
			$data['pembelian']=$p->total_beli;
		}
		$select = $this->db->select('sum(harga_jual-harga_beli) as total_laba');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$laba = $this->m->Get_All('ht_penjualan', $select);
		$data['laba']=0;
		foreach($laba as $p) {
			$data['laba']=$p->total_laba;
		}
		$this->load->view('admin/index',$data);
	}
	public function produk()
	{
		$select = $this->db->select('*');
		$data['read_produk'] = $this->m->Get_All('produk',$select);
		$select = $this->db->select('*');
		$data['read_owner'] = $this->m->Get_All('owner',$select);
		$select = $this->db->select('*');
		$data['read_kategori'] = $this->m->Get_All('kategori',$select);
		$this->load->view('admin/produk',$data);
	}

	public function owner()
	{
		$select = $this->db->select('*');
		$data['read_owner'] = $this->m->Get_All('owner',$select);
		$this->load->view('admin/owner',$data);
	}

	public function customer()
	{
		$select = $this->db->select('*');
		$data['read_customer'] = $this->m->Get_All('customer',$select);
		$this->load->view('admin/customer',$data);
	}

	public function supplier()
	{
		$select = $this->db->select('*');
		$data['read_supplier'] = $this->m->Get_All('supplier',$select);
		$this->load->view('admin/supplier',$data);
	}

	public function kategori()
	{
		$select = $this->db->select('*');
		$data['read_kategori'] = $this->m->Get_All('kategori',$select);
		$this->load->view('admin/kategori',$data);
	}

	public function karyawan()
	{
		$select = $this->db->select('*');
		$data['read_karyawan'] = $this->m->Get_All('user',$select);
		$this->load->view('admin/karyawan',$data);
	}

	public function penjualan()
	{	
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');

		$select = $this->db->select('*,sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));

			$select = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select = $this->db->where('waktu LIKE"' . date('Y-m-d') . '%"');
		}

		$select = $this->db->group_by('ht_penjualan.id');
		$select = $this->db->order_by('waktu', 'DESC');
		$data['read'] = $this->m->Get_All('ht_penjualan', $select);
		$select = $this->db->select('*');

		$data['produk'] = $this->m->Get_All('produk', $select);

		$data['total_bayar'] = 0;
		$data['total_piutang'] = 0;
		$data['total_omset'] = 0;
		foreach ($data['read'] as $r) {
			$data['total_bayar'] += $r->total_bayar;
			$data['total_omset'] += $r->total_omset;
		}
		$data['total_piutang'] = $data['total_omset'] - $data['total_bayar'];

		$data['read_cs'] = $this->m->Get_All('customer', $select);
		$this->load->view('admin/penjualan',$data);
	}

	public function LaporanpenjualanRE()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$this->load->view('admin/laporan-penjualan-re',$data);
	}
	
	public function CetakLaporanPenjualanRE(){
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "'.$_GET['dari'].'"');
		$select = $this->db->where('waktu <= "'.$_GET['sampai'].'"');
		$select = $this->db->where('id_owner','1');
		$data['read_penjualan'] = $this->m->Get_All('ht_penjualan',$select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/cetak-laporan-penjualan-re',$data);
	}

	public function LaporanpenjualanOwner()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$getowner=$this->input->get('id_owner');
		$select = $this->db->select('*');
		$id = 1;
		$select = $this->db->where('id >', $id);
		$data['read_owner'] = $this->m->Get_All('owner',$select);
		$this->load->view('admin/laporan-penjualan-owner',$data,$getowner);
	}


	public function CetakLaporanPenjualanOwner(){
		$select = $this->db->select('*');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		$select = $this->db->where('waktu >= "'.$_GET['dari'].'"');
		$select = $this->db->where('waktu <= "'.$_GET['sampai'].'"');
		$select = $this->db->where("id_owner",$_GET['id_owner']);
		$data['read_penjualan'] = $this->m->Get_All('ht_penjualan',$select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$data['getowner'] = $_GET['id_owner'];
		$this->load->view('admin/cetak-laporan-penjualan-owner',$data);
	}

	public function LaporanProduk(){
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$select = $this->db->select('*');
		$data['read_owner'] = $this->m->Get_All('produk',$select);
		$this->load->view('admin/laporan-produk',$data);
	}

	public function CetakLaporanProduk(){
		$select = $this->db->select('*, produk.kuantitas as kuantitas_produk, produk.harga_jual as harga_jual_produk,  dt_penjualan.harga_jual as detail_harga_jual, dt_penjualan.harga_beli as detail_harga_beli, kategori.nama as nama_kategori, dt_penjualan.kuantitas as kuantitas_penjualan, sum(dt_penjualan.kuantitas) as total_kuantitas_penjualan, sum(dt_pembelian.kuantitas) as total_kuantitas_pembelian');
		$select = $this->db->join('dt_penjualan', 'produk.id=dt_penjualan.id_produk');
		$select = $this->db->join('ht_penjualan', 'dt_penjualan.id=ht_penjualan.id');
		$select = $this->db->join('kategori', 'produk.id_kategori=kategori.id');
		$select = $this->db->join('dt_pembelian', 'produk.id=dt_pembelian.id_produk','left');
		$select = $this->db->where('waktu >= "'.$_GET['dari'].'"');
		$select = $this->db->where('waktu <= "'.$_GET['sampai'].'"');
		// $select = $this->db->where('dt_penjualan.id_owner','1');
		$select = $this->db->group_by('dt_penjualan.id_produk');
		$data['read_produk'] = $this->m->Get_All('produk',$select);
		$this->load->view('admin/cetak-laporan-produk',$data);
	}

	public function LaporanPiutang(){
		$data['dari'] = date('Y-m-d', strtotime(date('Y-m-d') . ' - 1 months'));
		$data['sampai'] = date('Y-m-d');
		$this->load->view('admin/laporan-piutang', $data);
	}

	public function CetakLaporanPiutang(){
		$sampai=date('Y-m-d', strtotime($_GET['sampai'] . ' + 1 days'));
		$select = $this->db->select('*,sum(total_bayar) as total_bayar, sum(harga_jual*kuantitas) as total_omset');
		//$select = $this->db->select('*, sum(harga_jual*kuantitas) as total_omset');
		$select = $this->db->join('dt_penjualan', 'ht_penjualan.id=dt_penjualan.id');
		//$select = $this->db->join('customer', 'ht_penjualan.id_customer=customer.id');
		$select = $this->db->order_by('ht_penjualan.id');
		$select = $this->db->group_by('ht_penjualan.id_customer');
		//$select = $this->db->group_by('customer.id');
		$select = $this->db->where('ht_penjualan.id_customer > ', '1');
		$select = $this->db->where('waktu >= "' . $_GET['dari'] . '"');
		$select = $this->db->where('waktu <= "' . $sampai . '"');
		$data['penjualan'] = $this->m->Get_All('ht_penjualan', $select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		//print_r($data['penjualan']);
		$this->load->view('admin/cetak-laporan-piutang', $data);
	}

	public function penjualan_delete(){
		//update stok bertambah saat transaksi dihapus
		$where = array(
			'id'			=> $this->input->post('id')
		);
		$select = $this->db->select('*');
		$getPenjualan = $this->m->Get_Where($where, 'dt_penjualan');
		foreach($getPenjualan as $p){
			$where2 = array(
				'id'		=> $p->id_produk
			);
			$getProduk2 = $this->m->Get_Where($where2, 'produk');
			foreach ($getProduk2 as $p2){
				$data = array(
					'kuantitas' => $p->kuantitas + $p2->kuantitas,
				);
				$this->m->Update($where2, $data, 'produk');
			}
			
		}	
		//fungsi menghapus transaksi	
		$this->m->delete($where, 'ht_penjualan');
		$this->m->delete($where, 'dt_penjualan');
		redirect('admin/penjualan');
	}

	public function CetakFakturPenjualan ($id){
		$where = array(
			'id'	=> $id
		);
		$data['ht_penjualan'] = $this->m->Get_Where($where, 'ht_penjualan');
		$data['dt_penjualan'] = $this->m->Get_Where($where, 'dt_penjualan');
		$this->load->view('admin/cetakfakturpenjualan', $data);
	}

	public function getProduk()
	{
		$where = array(
			'id' => $this->input->get('id')
		);
		$data['getProduk'] = $this->m->Get_Where($where, 'produk');
		$this->load->view('admin/getProduk', $data);
	}

	function AddCart($id,$qty){
		$select = $this->db->select('*,produk.id as id_produk');
		$select = $this->db->join('owner', 'owner.id=produk.id_owner');
		$select = $this->db->where('produk.id',$id);
		$getProduk = $this->m->Get_All('produk', $select);
		foreach($getProduk as $d){}
		$data = array(
			'id'			=> $d->id_produk, 
			'name'			=> $d->nama_barang, 
			'qty' 			=> $qty, 
			'price' 		=> $d->harga_jual, 
			'harga_beli' 	=> $d->harga_beli, 
			'id_owner' 		=> $d->id_owner, 
			'nama_owner' 	=> $d->nama_owner, 
		);
		$this->cart->insert($data);
		$this->ShowCart();
	}

	function ShowCart(){ 
		$output = '';
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .='
					<tr>
						<td>'.$items['name'].'</td>
						<td>'.$items['qty'].'</td>
						<td>'.$items['price'].'</td>
						<td>'.($items['qty']*$items['price']).'</td>
						<td><center>
								<button type="button"
									class="btn btn-sm btn-danger cancel-cart" 
									onclick="return batal(`'.$items['rowid'].'`)">
									<i class="fa fa-times"></i>
								</button>
							</center>
						</td>
					</tr>
					';
		}
		$output .= '
				<tr>
					<th colspan="4">Total Harga</th>
					<td>'.number_format($this->cart->total(),0,'.','.').'</td>
				
				</tr>
		';	
		
		echo $output;
	}

	function DeleteCart($row_id){
		$data = array(
			'rowid'	=> $row_id,
			'qty'	=> 0,
		);
		$this->cart->update($data);
		$this->ShowCart();
	}

	public function SaveTransaksiPenjualan(){
		$id		= date('YmdHis');
		$id_customer	= $this->input->post('id_customer');
		$where	= array(
			'id' => $id_customer
		);
		$getCustomer = $this->m->Get_Where($where, 'customer');

		$total_bayar = $this->input->post('total_bayar');
		if($id_customer==1){
			$total_bayar=$this->cart->total();
		}

		foreach($getCustomer as $c){
			$data	= array(
				'id'			=> $id,
				'id_customer'	=> $id_customer,
				'nama_customer'	=> $c->nama,
				'waktu'			=> date('Y-m-d H:i:s'),
				'total_bayar'	=> $total_bayar,
				'kasir'			=> $this->session->userdata('nama'),
			);
			$this->m->save($data, 'ht_penjualan');
		}

		foreach ($this->cart->contents() as $items) {
			$data = array(
				'id'			=> $id,
				'id_produk'		=> $items['id'],
				'nama_produk'	=> $items['name'],
				'id_owner'		=> $items['id_owner'],
				'nama_owner'	=> $items['nama_owner'],
				'harga_beli'	=> $items['harga_beli'],
				'harga_jual'	=> $items['price'],
				'kuantitas'		=> $items['qty'],
			);
			$this->m->save($data, 'dt_penjualan');
			//update stok produk berkurang saat menyimpan transaksi
			$where = array(
				'id'			=> $items['id']
			);
			$getProduk = $this->m->Get_Where($where, 'produk');
			foreach($getProduk as $p){
				$data = array(
					'kuantitas'		=> ($p->kuantitas-$items['qty']),
				);
				$this->m->Update($where, $data, 'produk');
			}
		}
		$this->cart->destroy();
	}

	public function Create1()
	{
		$data=array(
			'nama_barang'		=>	$this->input->post('nama_barang'),
			'kuantitas'			=>	$this->input->post('kuantitas'),
			'harga_beli'		=>	$this->input->post('harga_beli'),
			'harga_jual'		=>	$this->input->post('harga_jual'),
			'id_kategori'		=>	$this->input->post('id_kategori'),
			'id_owner'			=>	$this->input->post('id_owner')
		);		
		$this->m->Save($data, 'produk');
		redirect('admin/produk');
	}

	function Update1()
	{
		$where=array(
			'id'			=>	$this->input->post('id')
		);
		$data=array(
			'nama_barang'	=>	$this->input->post('nama_barang'),
			'kuantitas'		=>	$this->input->post('kuantitas'),
			'harga_beli'	=>	$this->input->post('harga_beli'),
			'harga_jual'	=>	$this->input->post('harga_jual'),
			'id_kategori'		=>	$this->input->post('id_kategori'),
			'id_owner'		=>	$this->input->post('id_owner')
		);
	
		$this->m->Update($where, $data, 'produk');
		redirect('admin/produk');
	}
	
	public function Create2()
	{
		$data=array(
			'nama_owner'		=>	$this->input->post('nama_owner'),
			'alamat'			=>	$this->input->post('alamat'),
			'no_hp'	            =>	$this->input->post('no_hp')
			);		
		$this->m->Save($data, 'owner');
		redirect('admin/owner');
	}

	public function Create3()
	{
		$data=array(
			'nama'			=>	$this->input->post('nama'),
			'akses'			=>	$this->input->post('akses'),
			'username'		=>	$this->input->post('username'),
			'password'		=>	$this->input->post('password')
			);		
		$this->m->Save($data, 'user');
		redirect('admin/karyawan');
	}

	public function Create4()
	{
		$data=array(
			'nama_supplier'		=>	$this->input->post('nama_supplier'),
			'alamat'			=>	$this->input->post('alamat'),
			'no_hp'	            =>	$this->input->post('no_hp')
			);		
		$this->m->Save($data, 'supplier');
		redirect('admin/supplier');
	}

	public function Create5()
	{
		$data=array(
			'nama'		=>	$this->input->post('nama'),
			);		
		$this->m->Save($data, 'kategori');
		redirect('admin/kategori');
	}

	public function Create6()
	{
		$data=array(
			'nama'		=>	$this->input->post('nama'),
			'status'	=>	$this->input->post('status'),
			);		
		$this->m->Save($data, 'customer');
		redirect('admin/customer');
	}


	public function Update2()
	{
		$where=array(
			'id'			=> $this->input->post('id')
		);
		$data=array(
			'nama_owner' 	=> $this->input->post('nama_owner'),
			'alamat' 		=> $this->input->post('alamat'),
			'no_hp' 		=> $this->input->post('no_hp')
		);

		$this->m->Update($where,$data,'owner');
		redirect(base_url().'admin/owner');
	}

	public function Update3()
	{
		$where=array(
			'id'			=> $this->input->post('id')
		);
		$data=array(
			'nama' 			=> $this->input->post('nama'),
			'akses' 		=> $this->input->post('akses'),
			'password'		=>	$this->input->post('password')
		);

		$this->m->Update($where,$data,'user');
		redirect(base_url().'admin/karyawan');
	}

	public function Update4()
	{
		$where=array(
			'id'			=> $this->input->post('id')
		);
		$data=array(
			'nama_supplier'	=> $this->input->post('nama_supplier'),
			'alamat' 		=> $this->input->post('alamat'),
			'no_hp' 		=> $this->input->post('no_hp')
		);

		$this->m->Update($where,$data,'supplier');
		redirect(base_url().'admin/supplier');
	}

	public function Update5()
	{
		$where=array(
			'id'			=> $this->input->post('id')
		);
		$data=array(
			'nama'	=> $this->input->post('nama'),

		);

		$this->m->Update($where,$data,'kategori');
		redirect(base_url().'admin/kategori');
	}

	public function Update6()
	{
		$where=array(
			'id'			=> $this->input->post('id')
		);
		$data=array(
			'nama'	=> $this->input->post('nama'),
			'status'=> $this->input->post('status')

		);

		$this->m->Update($where,$data,'customer');
		redirect(base_url().'admin/customer');
	}

	function Delete1()
	{
		
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		$this->m->Delete($where,'produk');
		redirect(base_url().'admin/produk');
	}
	
	function Delete2()
	{
		$table = 'owner';
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		
		$this->m->Delete($where, $table);
		redirect('admin/owner');
	}

	function Delete3()
	{
		$table = 'user';
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		
		$this->m->Delete($where, $table);
		redirect('admin/karyawan');
	}

	function Delete4()
	{
		$table = 'supplier';
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		
		$this->m->Delete($where, $table);
		redirect('admin/supplier');
	}

	function Delete5()
	{
		$table = 'kategori';
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		
		$this->m->Delete($where, $table);
		redirect('admin/kategori');
	}

	function Delete6()
	{
		$table = 'customer';
		$where=array(
			'id'		=>	$this->input->post('id')
		);
		
		$this->m->Delete($where, $table);
		redirect('admin/customer');
	}

	public function pembelian()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d');


		if (isset($_POST['cari'])) {
			$data['dari'] = $_POST['dari'];
			$data['sampai'] = $_POST['sampai'];
			$date = date('Y-m-d', strtotime($data['sampai'] . "+1 days"));

			$select = $this->db->where('waktu >= "' . $data['dari'] . '"');
			$select = $this->db->where('waktu <= "' . $date . '"');
		} else {
			$select = $this->db->where('waktu LIKE"' . date('Y-m-d') . '%"');
		}

		$select = $this->db->group_by('ht_pembelian.id');
		$select = $this->db->order_by('waktu', 'DESC');
		$data['read_pembelian'] = $this->m->Get_All('ht_pembelian',$select);
		$select = $this->db->select('*');

		$data['read_pr'] = $this->m->Get_All('produk',$select);
		

		$data['read_sp'] = $this->m->Get_All('supplier',$select);
		$this->load->view('admin/pembelian',$data);
	}

	function AddCart2($id,$qty){
		$select = $this->db->select('*,produk.id as id_produk');
		$select = $this->db->join('supplier', 'supplier.id=produk.id_supplier');
		$select = $this->db->where('produk.id',$id);
		$getProduk = $this->m->Get_All('produk', $select);
		foreach($getProduk as $d){}
		$data = array(
			'id'			=> $d->id_produk, 
			'name'			=> $d->nama_barang, 
			'qty' 			=> $qty, 
			'price' 		=> $d->harga_beli, 
			'harga_jual' 	=> $d->harga_jual, 
			'id_supplier' 	=> $d->id_supplier, 
			'nama_supplier' => $d->nama_supplier, 
		);
		$this->cart->insert($data);
		$this->ShowCart2();
	}

	function ShowCart2(){ 
		$output = '';
		$no = 1;
		foreach ($this->cart->contents() as $items) {
			$output .='
					<tr>
						<td>'.$items['name'].'</td>
						<td>'.$items['qty'].'</td>
						<td>'.$items['price'].'</td>
						<td>'.($items['qty']*$items['price']).'</td>
						<td><center>
								<button type="button"
									class="btn btn-sm btn-danger cancel-cart" 
									onclick="return batal(`'.$items['rowid'].'`)">
									<i class="fa fa-times"></i>
								</button>
							</center>
						</td>
					</tr>
					';
		}
		$output .= '
				<tr>
					<th colspan="4">Total Harga</th>
					<td>'.number_format($this->cart->total(),0,'.','.').'</td>
				
				</tr>
		';	
		
		echo $output;
	}

	function DeleteCart2($row_id){
		$data = array(
			'rowid'	=> $row_id,
			'qty'	=> 0,
		);
		$this->cart->update($data);
		$this->ShowCart();
	}

	public function SaveTransaksiPembelian(){
		$id		= date('YmdHis');
		$id_supplier	= $this->input->post('id_supplier');
		$where	= array(
			'id' => $id_supplier
		);
		$waktu = $this->input->post('waktu');
		$waktu = date('Y-m-d');
		$getSupplier = $this->m->Get_Where($where, 'supplier');

		foreach($getSupplier as $c){
			$data	= array(
				'id'			=> $id,
				'id_supplier'	=> $id_supplier,
				'nama_supplier'	=> $c->nama_supplier,
				'waktu'			=> $waktu,
				'total_bayar'	=> $this->cart->total(),
				'kasir'			=> $this->session->userdata('nama'),
			);
			$this->m->save($data, 'ht_pembelian');
		}

		foreach ($this->cart->contents() as $items) {
			$data = array(
				'id'			=> $id,
				'id_produk'		=> $items['id'],
				'nama_produk'	=> $items['name'],
				'id_supplier'	=> $items['id_supplier'],
				'nama_supplier'	=> $items['nama_supplier'],
				'harga_jual'	=> $items['harga_jual'],
				'harga_beli'	=> $items['price'],
				'kuantitas'		=> $items['qty'],
			);
			$this->m->save($data, 'dt_pembelian');
			//update stok produk berkurang saat menyimpan transaksi
			$where = array(
				'id'			=> $items['id']
			);
			$getProduk2 = $this->m->Get_Where($where, 'produk');
			foreach($getProduk2 as $p){
				$data = array(
					'kuantitas'		=> ($p->kuantitas+$items['qty']),
				);
				$this->m->Update($where, $data, 'produk');
			}
		}
		$this->cart->destroy();
	}

	public function getProduk2()
	{
		$where = array(
			'id' => $this->input->get('id')
		);
		$data['getProduk2'] = $this->m->Get_Where($where, 'produk');
		$this->load->view('admin/getProduk2', $data);
	}

	public function CetakFakturPembelian ($id){
		$where = array(
			'id'	=> $id
		);
		$data['ht_pembelian'] = $this->m->Get_Where($where, 'ht_pembelian');
		$data['dt_pembelian'] = $this->m->Get_Where($where, 'dt_pembelian');
		$this->load->view('admin/cetakfakturpembelian', $data);
	}

	public function LaporanPembelian()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$this->load->view('admin/laporan-pembelian',$data);
	}

	public function CetakLaporanPembelian(){
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "'.$_GET['dari'].'"');
		$select = $this->db->where('waktu <= "'.$_GET['sampai'].'"');
		$data['read_pembelian'] = $this->m->Get_All('ht_pembelian',$select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$this->load->view('admin/cetak-laporan-pembelian',$data);
	}

	
	public function pembelian_delete(){
		//update stok berkurang saat transaksi dihapus
		$where = array(
			'id'			=> $this->input->post('id')
		);
		$select = $this->db->select('*');
		$getPembelian = $this->m->Get_Where($where, 'dt_pembelian');
		foreach($getPembelian as $p){
			$where2 = array(
				'id'		=> $p->id_produk
			);
			$getProduk2 = $this->m->Get_Where($where2, 'produk');
			foreach ($getProduk2 as $p2){
				$data = array(
					'kuantitas' => $p2->kuantitas - $p->kuantitas,
				);
				$this->m->Update($where2, $data, 'produk');
			}
			
		}	
		//fungsi menghapus transaksi	
		$this->m->delete($where, 'ht_pembelian');
		$this->m->delete($where, 'dt_pembelian');
		redirect('admin/pembelian');
	}


	public function LaporanPembelianSupplier()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$getsupp=$this->input->get('id_supplier');
		$select = $this->db->select('*');
		$data['read_supplier'] = $this->m->Get_All('supplier',$select);
		$this->load->view('admin/laporan-pembelian-supplier',$data,$getsupp);
	}


	public function CetakLaporanPembelianSupplier(){
		$select = $this->db->select('*');
		$select = $this->db->join('dt_pembelian', 'ht_pembelian.id=dt_pembelian.id');
		$select = $this->db->where('waktu >= "'.$_GET['dari'].'"');
		$select = $this->db->where('waktu <= "'.$_GET['sampai'].'"');
		$select = $this->db->where('ht_pembelian.id_supplier',$_GET['id_supplier']);
		$data['read_pembelian'] = $this->m->Get_All('ht_pembelian',$select);
		$data['dari'] = $_GET['dari'];
		$data['sampai'] = $_GET['sampai'];
		$data['getsupp'] = $_GET['id_supplier'];
		$this->load->view('admin/cetak-laporan-pembelian-supplier',$data);
	}

	public function LaporanPemasukan()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$this->load->view('admin/laporan-pemasukan',$data);
	}
	
	public function CetakLaporanPemasukan(){
		$select = $this->db->select('*');
		$data['read_produk'] = $this->m->Get_All('produk',$select);		
		$this->load->view('admin/cetak-laporan-pemasukan',$data);
	}

	public function LaporanPengeluaran()
	{
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($data['dari']. ' + 1 months'));
		$this->load->view('admin/laporan-pengeluaran',$data);
	}

	public function CetakLaporanPengeluaran(){
		$select = $this->db->select('*');
		$data['read_produk'] = $this->m->Get_All('produk',$select);		
		$this->load->view('admin/cetak-laporan-pengeluaran',$data);
	}

}
?>