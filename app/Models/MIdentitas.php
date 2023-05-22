<?php

namespace App\Models;

use CodeIgniter\Model;

class MIdentitas extends Model
{
	protected $table = 'identitas';
	protected $primaryKey = 'id_identitas';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['nama_website', 'email', 'url', 'facebook', 'instagram', 'rekening', 'no_telp' ,'kota_id', 'alamat', 'meta_deskripsi', 'meta_keyword', 'favicon', 'maps'];
}