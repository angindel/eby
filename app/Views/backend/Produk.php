<?= $this->extend('layout/admin/dashboard_layout') ?>
<?= $this->section('content') ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <?php if (!empty(session()->getFlashdata('msg'))) : ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?php echo session()->getFlashdata('msg'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <?php endif; ?>
                  <h3 class="box-title">Semua Produk</h3>
                  <a class='pull-right btn btn-primary btn-sm' href='<?php echo base_url(); ?>administrator/tambah_produk'>Tambahkan Data</a>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example" class="table table-bordered table-striped table-condensed" style="width: 100%">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Nama Produk</th>
                        <th>Harga Modal</th>
                        <th>Harga Reseller</th>
                        <th>Harga Konsumen</th>
                        <th>Satuan</th>
                        <th>Berat</th>
                        <th style='width:70px'>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $no = 1;
                    foreach ($produk as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row->nama_produk ?></td>
                        <td>Rp <?= $row->harga_beli ?></td>
                        <td>Rp <?= $row->harga_reseller ?></td>
                        <td>Rp <?= $row->harga_konsumen ?></td>
                        <td><?= $row->satuan ?></td>
                        <td><?= $row->berat ?> Gram</td>
                        <td>
                          <center>
                            <a class="btn btn-success btn-xs" title="Edit Data" href="<?= base_url("administrator/edit_produk/$row->id_produk") ?>">
                              <span class='fa fa-edit'></span>
                            </a>
                            <a class='btn btn-danger btn-xs' title='Delete Data' href="<?= base_url("administrator/delete_produk/$row->id_produk") ?>" ><span class='fa fa-remove'></span></a>
                        </center></td>
                      </tr>
                  <?php 
                      $no++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script type="text/javascript">
  let csrf = $('.mtcsrf');
  let csrfName = csrf.attr('name');
  let csrfHash = csrf.val();
  $(document).ready(function () {
    var table = $('#tabel_serverside').DataTable({
      'processing' : true,
      'serverSide' : true,
      'serverMethod' : 'post',
      'searchDelay' : 2000,
      'columnDefs': [
        {
          targets: [0],
          data : 'no',
        },
        {
          targets: [1],
          data : 'nama',
        },
        {
          targets: [2],
          data : 'qty',
        },
        {
          targets: [3],
          data : 'total',
        },
        {
          data:'id_mtran',
          targets: [-1],
          className: "dt-center",
          render: function ( data, type, row ) {
            return '<div class="row"><div class="col-6"><i id="edit-tran" class="fa fa-pencil"></i></div><div class="col-6"><i id="hapus-tran" class="fa fa-trash"></i></div></div>';
          },
          orderable: false
        },
      ],
      order: [[0,'desc']],
      'ajax' : {
        'url' : "<?= site_url('administrator/ajdt/mtran') ?>",
        'type' :'post',
        'data': function(data){
          csrfHash = csrf.val();
          return {
            data : data,
            [csrfName]: csrfHash
          };
        },
        dataSrc:function(data){
          csrf.val(data.token);
          return data.data;
        },
        error: function(){  // error handling
          $(".tabel_serverside-error").html("");
          $("#tabel_serverside").append('<tbody class="tabel_serverside-error"><tr><th colspan="5">Data Tidak Ditemukan di Server</th></tr></tbody>');
          $(".dataTables_processing").css("display","none");
        },
      },
      "oLanguage": {
          "sLengthMenu": "Tampilkan _MENU_ data per halaman",
          "sSearch": "Pencarian: ",
          "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
          "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
          "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
          "sInfoFiltered": "(di filter dari _MAX_ total data)",
          "oPaginate": {
              "sFirst": "<<",
              "sLast": ">>",
              "sPrevious": "< Sebelumnya",
              "sNext": "Selanjutnya >"
         }
      },
    });
    // END-DATATABLES
  });

    ClassicEditor
        .create( document.querySelector( '#editorket' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
<?= $this->endSection() ?>