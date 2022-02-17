<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">
    <div class="row">
        <?php foreach ($category as $category) : ?>
            <div class="col-md-3">
                <div class="card mb-2">
                    <a class="text-decoration-none text-muted" href="<?php echo base_url('category/item/' . $category->category_slug); ?>">
                        <div class="card-body row">
                            <div class="col-4">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>">
                            </div>
                            <div class="col-8 my-auto">
                                <b><?php echo $category->category_name; ?></b>
                            </div>

                        </div>
                    </a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>