<?php
namespace App\Controllers;
class Produk extends BaseController
{
    protected $ProdukModel;
    function _construct()
    {
        $this->produkModel = new \App\Models\ProdukModel();
    }
 public function index()
 {
    if (isset($_COOKIE['produk'])) {
        $arr_produk = json_decode($_COOKIE['produk'], true);
        } else {
        $arr_produk = [];
        }
        $pencarian_id_produk = !isset($_GET['cari'])?'':$_GET['cari'];
        $data_view = [
        'data' => $arr_produk,
        'pencarian_id_produk' => $pencarian_id_produk
        ];
        return view('produk/list', $data_view);
 }
 public function form()
 {
        $default_id = isset($_GET['default_id'])?$_GET['default_id']:'Pr-';
        $default_nama = isset($_GET['default_nama'])?$_GET['default_nama']:'Produk A';
        $default_deskripsi = isset($_GET['default_deskripsi'])?$_GET['default_deskripsi']:'';
        $default_stok = isset($_GET['default_stok'])?$_GET['default_stok']:0;
        $default_harga = isset($_GET['default_harga'])?$_GET['default_harga']:'0';
        // $add_data = [
            
        // ];
        $data_view = [
            'judul' => 'Form Produk',
            'page_konten' => 'produk/form',
            'default_id' => $default_id,
            'default_nama' => $default_nama,
            'default_deskripsi' => $default_deskripsi,
            'default_stok' => $default_stok,
            'default_harga' => $default_harga
        ];
        return view('produk/form', $data_view);
 }
 public function proses_form()
 {
    $nama_produk = $this->request->getPost('nama_produk');
    $deskripsi_barang = $this->request->getPost('deskripsi');
    $stok = $this->request->getPost('stok_produk');
    $harga = $this->request->getPost('harga_jual');
    $id_produk_input = $_POST['id_produk'];
    $id_produk_pk = $this->request->getPost('id_produk_pk');
    if ($id_produk_pk == '') {
    $url_back_form = 
    base_url("produk/form?default_id=$id_produk_input&default_nama=$nama_produk&default_des
    kripsi=$deskripsi_barang&default_stok=$stok&default_harga=$harga");
    } else {
    $url_back_form = base_url("produk/ubah?id_produk=$id_produk_pk");
    }
    if (($harga<=0) && ($stok <= 0) ) {
    return "<h2>Input Error, Harga dan Stok Minimal 1 !!!</h2>
    <a href='$url_back_form'>Klik untuk kembali ke form</a>";
    } elseif ($harga<=0) {
    return "<h2>Input Error, Harga Minimal 1 !!!</h2>
    <a href='$url_back_form'>Klik untuk kembali ke form</a>";
    } elseif ($stok <= 0) {
    return "<h2>Input Error, Stok Minimal 1 !!!</h2>
    <a href='$url_back_form'>Klik untuk kembali ke form</a>";
    } else {
    $produk_baru = [
        'kode_produk' => $id_produk_input,
        'nama_produk' => $nama_produk,
        'deskripsi' => $deskripsi_barang,
        'stok' => $stok,
        'harga' => $harga,
        'id_produk' => $id_produk_pk,
    ];
    if($id_produk_pk == ''){
        $proses_db = $this->produkModel->insert($produk_baru);
    }else{
        $proses_db = $this->produkModel->update($id_produk_pk,$produk_baru);
    }

    if($proses_db===false){
        $error=$this->produkModel->errors();
        $pesan_error_kd =$error['kode_produk'];
        return"<h2>$pesan_error_kd</h2>
        <a href='$url_back_form'>Klik untuk kembali ke form</a>";
    }else{
        return redirect()->to(base_url('produk'));
    }
 }
 }
}
