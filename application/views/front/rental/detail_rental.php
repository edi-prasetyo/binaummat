<div class="breadcrumb">
  <div class="container">
    <ul class="breadcrumb my-3">
      <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
      <li class="breadcrumb-item active"><?php echo $title ?></li>
    </ul>
  </div>
</div>

<div class="container mb-3">

  <?php if ($mobil == NULL) : ?>

    <div class="card">

      <div class="card-body text-center">
        <h2><i class="bi-x-circle my-auto text-danger display-1"></i><br> Oops</h2>
        Maaf Mobil Yang Anda cari Saat ini tidak tersedia, Silahkan Gunakan Mobil Lainnya<br>
        <a href="<?php echo base_url('rental-mobil'); ?>" class="btn btn-info my-4">Lihat List Mobil</a>

      </div>
    </div>

  <?php else : ?>


    <div class="row">
      <div class="col-md-4">
        <div class="card mb-2">

          <div class="card-body">
            <div class="img-wrap"><img class="img-fluid" src="<?php echo base_url('assets/img/mobil/') . $mobil->mobil_gambar; ?>"></div>
            <div class="badge badge-success"><?php echo $mobil->merek_name; ?></div>
            <h2><?php echo $mobil->mobil_name; ?></h2>
            <span class="mr-5"><i class="bi-people"></i> <?php echo $mobil->mobil_penumpang; ?> Penumpang</span>
            <i class="bi-briefcase"></i> <?php echo $mobil->mobil_bagasi; ?> Bagasi

            <div class="col-md-12">

            </div>

          </div>
        </div>

      </div>

      <div class="col-md-8">

        <h3>Pilih Paket</h3>

        <?php foreach ($listpaket as $listpaket) : ?>
          <div class="card mb-2">
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <?php echo $listpaket->paket_name ?>
                  <h3>IDR. <strong><?php echo number_format($listpaket->paket_price, '0', ',', '.'); ?></strong></h3>
                </div>
                <div class="col-md-4 text-center my-auto">
                  <a href="<?php echo base_url('rental-mobil/booking/' . md5($listpaket->id)); ?>" class="btn btn-info btn-block ">Booking Sekarang</a>
                </div>

              </div>
            </div>
          </div>

        <?php endforeach; ?>

        <div class="card">
          <div class="card-header bg-white">
            Deskripsi Mobil
          </div>
          <div class="card-body">
            <?php echo $mobil->mobil_desc; ?>

          </div>
        </div>


      </div>



    </div>

  <?php endif; ?>

</div>