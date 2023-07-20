<?php

namespace App\Controllers;

use App\Models\MProduks;
use App\Models\MKategoriProduk;
use App\Models\MIdentitas;
use App\Models\MLogo;
use App\Models\MPaymentChannel;
use App\Models\MDeliveryService;
use App\Models\MSlide;
use CodeIgniter\Test\Fabricator;

class Home extends BaseController
{
    public function __construct()
    {
        $m_iden = new MIdentitas();
        $m_logo = new MLogo();
        $this->web = $m_iden->where('id_identitas', 1)->first();
        $logo = $m_logo->orderBy('id_logo', 'DESC')->limit(1)->first();
        $this->web['logo'] = $logo['gambar'];
        $this->web['title'] = 'EbyKarya';
    }

    public function index()
    {
        $m_pc = new MPaymentChannel();
        $m_produk = new MProduks();
        $m_katpro = new MKategoriProduk();
        $m_ds = new MDeliveryService();
        $m_sl = new MSlide();
        $this->web['kategori'] = $m_katpro->findAll();
        //$this->web['produk_new'] = $m_produk->orderBy('created_at', 'DESC')->limit(9)->find();
        $db = db_connect();
        $q = $db->query('select m.id_mtran, m.id_produk, p.nama_produk, p.produk_seo, p.gambar, p.harga_konsumen, sum(m.qty) as qty from mtran as m inner join produk as p on m.id_produk=p.id_produk group by p.nama_produk order by qty desc limit 9');
        $this->web['produk_new'] = $q->getResult();
        $db->close();
        $this->web['pc'] = $m_pc->findAll();
        $this->web['ds'] = $m_ds->findAll();
        $this->web['sl'] = $m_sl->findAll();
        return view('frontend/Home', $this->web);
    }
    
    public function produkIS($s, $t = null)
    {
      helper('local');
      $db = db_connect();
      $dt = $db->table('produk');
      $limit = 8;
      $offset = $limit * intval($s - 1);

      if(!is_null($t))
      {
        $dt->where('id_kategori_produk', $t);
      }
      $c = $dt->countAllResults(false);
      if(!($offset < $c))
      {
        return $this->response->setStatusCode(404)->setBody("tidak ada data");
      }
      $dt->orderBy('created_at', 'DESC')->limit($limit, $offset);
      $query = $dt->get();
      $produk = $query->getResult();
      $html = "";
      $data = array();
      foreach ($produk as $row)
      {
        $base = base_url();
        $rupiah = rupiah($row->harga_konsumen);
        $data[] = (object)[
            "base" => $base,
            "nama_produk" => $row->nama_produk,
            "produk_seo" => $row->produk_seo,
            "gambar" => $row->gambar,
            "harga_konsumen" => $rupiah,        
        ];
        // $html .= "<div class='col px-1 mb-1'>
        //             <div class='card h-100'>
        //                 <a href='{$base}produk/detail/{$row->produk_seo} '>
        //                     <img src='{$base}uploads/produk/{$row->gambar}' class='card-img-top' alt='...'>
        //                 </a>
        //                 <div class='card-body p-0 m-1'>
        //                     <h5 class='card-title'>Rp.{$rupiah}</h5>
        //                     <a href='{$base}produk/detail/{$row->produk_seo}' style='text-decoration: none;'><h3 class='card-text lh-sm caption-pb '>{$row->nama_produk}</h3></a>
        //                 </div>
        //                 <ul class='list-group list-group-flush text-end border border-top-0'>
        //                     <li class='list-group-item p-0 m-1'><a href='{$base}produk/detail/{$row->produk_seo}' class='btn btn-primary btn-sm'>Lihat Detil</a></li>
        //                 </ul>
        //             </div>
        //         </div>";
      }
      
      // return $this->response->setStatusCode(200)->setBody($html);
      return $this->response->setJSON($data);
      
    }

    public function produk_detail($name_seo = null)
    {
        helper('local');
        $m_produk = new MProduks();
        $this->web['produk'] = $m_produk->where('produk_seo', $name_seo)->first();
        $this->web['produk']->harga_konsumen = rupiah($this->web['produk']->harga_konsumen);
        $this->web['produk_terkait'] = $m_produk->where('id_kategori_produk', $this->web['produk']->id_kategori_produk)->findAll(10);
        return view('frontend/Produk_detail', $this->web);
    }

    public function produk_kategori($s = null)
    {
        $m_katpro = new MKategoriProduk();
        $this->web['kategori'] = $m_katpro->findAll();
        $this->web['id_kategori'] = $s;
        return view('frontend/Produk_kategori', $this->web);
    }

    public function fake()
    {
        // helper("local");
        // $db = db_connect();
        // $dt = $db->table('produk');
        // $query = $dt->select('gambar,id_kategori_produk')->get();
        // $gambar = $query->getResult('array');
        // for($i=0; $i < 100; $i++)
        // {
        //     $faker = \Faker\Factory::create();
        //     $name = $faker->name;
        //     $data[] = [
        //       'id_kategori_produk' => $gambar[$faker->randomDigit()]['id_kategori_produk'],
        //       'nama_produk' => $name,
        //       'produk_seo' => seo_title($name),
        //       'satuan' => 'pcs',
        //       'harga_beli' => $faker->randomNumber(5, true),
        //       'harga_reseller' => $faker->randomNumber(5, true),
        //       'harga_konsumen' => $faker->randomNumber(5, true),
        //       'berat' => $faker->randomNumber(3, true),
        //       'diskon' => 0,
        //       'gambar' => $gambar[$faker->randomDigit()]['gambar'],
        //       'keterangan' => $faker->text,
        //       'username' => 'admin'
        //     ];

        // }
        // $dt->insertBatch($data);

        //$test = $fabricator->make();
       //d($data);
    }
}
