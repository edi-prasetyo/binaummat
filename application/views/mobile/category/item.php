<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>


<div class="container my-3">

    <?php foreach ($donasi as $donasi) : ?>

        <?php
        $donasi_id      = $donasi->id;
        $nominal_donasi = $this->donatur_model->total_nominal_donasi($donasi_id);
        $donatur        = $this->donatur_model->list_donatur($donasi_id);
        $target_donasi  = $donasi->donasi_target;
        $persentase     =  $nominal_donasi * 100 / $target_donasi;
        // echo $donasi_id;
        // echo $nominal_donasi;


        ?>
        <div class="col-md-6">
            <div class="card mb-2">
                <a class="text-decoration-none text-muted" href="<?php echo base_url('donasi/detail/' . $donasi->donasi_slug); ?>">
                    <!-- <div class="img-frame"> -->
                    <img src="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>" class="card-img-top" alt="...">
                    <!-- </div> -->
                    <div class="card-body">
                        <h5 class="card-title"><?php echo substr($donasi->donasi_title, 0, 35); ?></h5>

                        <div class="progress" style="height:5px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $persentase; ?>%" aria-valuenow="<?php echo $persentase; ?>" aria-valuemin="0" aria-valuemax="100" title="<?php echo $persentase; ?>"></div>
                        </div>
                        <div class="row">

                            <div class="col-6">
                                <p class="card-text"><small>Terkumpul</small><br> <b>
                                        Rp. <?php
                                            echo number_format($nominal_donasi, 0, ",", ".");  ?></b> </p>
                            </div>
                            <div class="col-6 text-right">
                                <small>Donatur</small><br>
                                <b>
                                    <?php
                                    echo count($donatur); ?>
                                    Orang</b>
                            </div>
                        </div>
                    </div>
                </a>

            </div>

        </div>

    <?php endforeach; ?>

    <div class="pagination col-md-12 text-center">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>
</div>