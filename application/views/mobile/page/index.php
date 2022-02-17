<?php $bank = $this->bank_model->get_allbank(); ?>
<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-3 pb-5">

    <?php foreach ($bank as $bank) : ?>
        <div class="card my-2 border-0 shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <img class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
                    </div>
                    <div class="col-8">
                        <b><?php echo $bank->bank_number; ?></b><br>
                        <small><?php echo $bank->bank_account; ?></small>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php foreach ($page as $page) : ?>
        <a class="text-muted text-decoration-none" href="<?php echo base_url('page/detail/' . $page->page_slug); ?>">
            <div class="card shadow-sm border-0 my-2">
                <div class="card-body">

                    <b><?php echo substr($page->page_title, 0, 20); ?></b>

                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>