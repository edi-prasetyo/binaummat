<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('donasi') ?>"> Donasi</a></li>

            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<?php
$donasi_id      = $donasi->id;
$nominal_donasi = $this->donatur_model->total_nominal_donasi($donasi_id);
$donatur        = $this->donatur_model->list_donatur($donasi_id);
$target_donasi  = $donasi->donasi_target;
$persentase     =  $nominal_donasi * 100 / $target_donasi;


?>

<div class="container mb-3">

    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-5">
                <img class="img-fluid" src="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>">
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2><?php echo $donasi->donasi_title; ?></h2>
                    <div class="progress" style="height:5px">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $persentase; ?>%" aria-valuenow="<?php echo $persentase; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><small>Terkumpul</small><br> <b>Rp. <?php
                                                                                        echo number_format($nominal_donasi, 0, ",", ".");  ?></b> </p>
                        </div>
                        <div class="col-6 text-right">
                            <small>Donatur</small><br>
                            <b><?php echo count($donatur); ?> Orang</b>
                        </div>
                    </div>
                    <a href="<?php echo base_url('donasi/checkout/' . md5($donasi->id)); ?>" class="btn btn-lg btn-success btn-block my-3">Donasi Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="card my-2">
                <div class="card-header bg-white">
                    <i class="ri-quill-pen-line"></i> Deskripsi
                </div>
                <div class="card-body">
                    <?php echo $donasi->donasi_desc; ?>
                </div>
            </div>


            <h3 class="my-3"><i class="ri-hand-coin-fill"></i> <?php echo count($donatur); ?> Donatur</h3>

            <?php foreach ($listdonatur as $listdonatur) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1"><img class="img-fluid" src="<?php echo base_url('assets/img/avatars/default.png'); ?>"></div>
                            <div class="col-11">
                                <b> <?php echo $listdonatur->donatur_name; ?></b><br>
                                Rp. <?php echo number_format($listdonatur->donasi_nominal, 0, ",", ","); ?>
                            </div>
                            <div class="col-5">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>



            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>

        </div>

        <div class="col-md-3">
            <?php include "sidebar.php"; ?>
        </div>

    </div>


</div>