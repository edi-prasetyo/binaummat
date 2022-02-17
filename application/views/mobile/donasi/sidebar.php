<div class="card">
    <div class="card-header bg-white">
        <b>Category</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($category as $category) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted" href="<?php echo base_url('category/item/' . $category->category_slug); ?>">
                    <div class="row">
                        <div class="col-3"><img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>"> </div>
                        <div class="col-9"><?php echo $category->category_name; ?></div>
                    </div>
                </a></li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="card mt-3">
    <div class="card-header bg-white">
        <b>Donasi</b>
    </div>
    <ul class="list-group list-group-flush">

    </ul>
</div>