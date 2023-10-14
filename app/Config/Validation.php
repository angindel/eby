<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        // CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
        'produk_list' => 'App\Views\errors\validation\produk_list'
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $produk = [
            'kategori_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
            'nama_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
            'harga_beli' => [
                'rules' => 'required|decimal',
                'errors' => [
                    'required' => 'Harus di isi',
                    'decimal' => 'Harus berupa angka'
                ]
            ],
            'harga_reseller' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi',
                    'decimal' => 'Harga Reseller harus berupa angka'
                ]
            ],
            'harga_konsumen' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi',
                    'decimal' => 'harus berupa angka'
                ]
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi',
                    'decimal' => 'harus berupa angka'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi',
                    'decimal' => 'harus berupa angka'
                ]
            ],
            'berat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
            'warna' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
            'size' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Harus di isi'
                ]
            ],
        ];

        public array $identitas = [
            'nama_website' => 'required|min_length[5]|max_length[100]',
            'email' => 'required|min_length[5]|max_length[100]',
            'url' => 'required|min_length[5]|max_length[100]',
            'facebook' => 'required',
            'instagram' => 'required',
            'no_telp' => 'required|min_length[5]|max_length[100]',
            'kota_id' => 'required',
            'alamat' => 'required',
            'meta_deskripsi' => 'required|min_length[10]|max_length[250]',
            'meta_keyword' => 'required|min_length[10]|max_length[250]',
            'favicon' => 'uploaded[favicon]|is_image[favicon]',
            'maps' => 'required'
        ];
}
