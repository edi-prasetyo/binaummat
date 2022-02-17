<div class="row">

  <div class="col-md-12">
    <?php
    //Notifikasi
    if ($this->session->flashdata('sukses')) {
      echo $this->session->flashdata('sukses');
    }

    //Error warning
    echo validation_errors('<div class="alert alert-warning">', '</div>');
    //include Tambah


    ?>
  </div>

  <div class="col-md-4">
    <div class="card mb-2">
      <div class="card-body">
        <img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar) ?>" class="img-fluid">
        <h2> <?php echo $mobil->merek_name; ?> <?php echo $mobil->mobil_name; ?></h2>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <?php include('create_paket.php'); ?>
      </div>


      <div class="table-responsive">
        <table class="table table-flush">
          <thead>
            <tr>
              <th>Paket Name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1;
            foreach ($paket as $data) { ?>

              <tr>

                <td><?php echo $data->paket_name ?></td>
                <td>Rp. <?php echo number_format($data->paket_price, '0', ',', ','); ?></td>
                <td>

                  <a href="<?php echo base_url('admin/mobil/update_paket/' . $data->id) ?>" title="Edit Mobil" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                  <?php
                  //link Delete
                  include('delete_paket.php');
                  ?>



                </td>
              </tr>

            <?php } ?>

          </tbody>
        </table>
      </div>

    </div>

  </div>


</div>