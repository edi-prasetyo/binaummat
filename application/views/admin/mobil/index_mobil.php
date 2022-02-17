<?php
if ($this->session->flashdata('message')) {
  echo $this->session->flashdata('message');
  unset($_SESSION['message']);
}
?>

<div class="card">
  <div class="card-header d-flex flex-row align-items-center justify-content-between">
    <?php echo $title; ?>
    <a href="<?php echo base_url('admin/mobil/create') ?>" title="Tambah Mobil baru" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Baru</a>

  </div>

  <div class="table-responsive">
    <table class="table table-flush">
      <thead>
        <tr>
          <th width="5%">No</th>
          <th width="5%">img</th>
          <th>Merek</th>
          <th>Jenis</th>
          <th>Seat</th>
          <th>Bagasi</th>
          <th>Harga Awal</th>
          <th>Status</th>
          <th width="25%">Action</th>
        </tr>
      </thead>
      <tbody>

        <?php $i = 1;
        foreach ($mobil as $data) { ?>

          <tr>
            <td><?php echo $i ?></td>
            <td><img src="<?php echo base_url('assets/img/mobil/' . $data->mobil_gambar) ?>" width="60" class="img img-thumbnail"></td>
            <td><?php echo $data->merek_name; ?> <?php echo $data->mobil_name; ?></td>
            <td><?php echo $data->jenismobil_name; ?></td>
            <td><?php echo $data->mobil_penumpang ?></td>
            <td><?php echo $data->mobil_bagasi ?></td>
            <td>Rp. <?php echo number_format($data->mobil_harga, '0', ',', ','); ?></td>
            <td><?php echo $data->mobil_status ?></td>
            <td>
              <a href="<?php echo base_url('admin/mobil/paket/' . $data->id) ?>" title="Edit Mobil" class="btn btn-info btn-sm"><i class="bi-box-seam"></i> Tambah Paket</a>
              <a href="<?php echo base_url('admin/mobil/update/' . $data->id) ?>" title="Edit Mobil" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
              <?php
              //link Delete
              include('delete_mobil.php');
              ?>


            </td>
          </tr>

        <?php $i++;
        } ?>

      </tbody>
    </table>
  </div>
</div>