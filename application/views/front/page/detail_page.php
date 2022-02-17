<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url() ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('page') ?>"> Page</a></li>

            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h2><?php echo $title; ?></h2>
            <?php echo $page->page_desc; ?>

        </div>
    </div>


</div>