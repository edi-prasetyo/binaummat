<div class="card">
    <div class="card-header bg-white">
        <b>Category</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($category as $category) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted" href="<?php echo base_url('category/item/' . $category->category_slug); ?>"> <i class="bi-tag"></i> <?php echo $category->category_name; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- 
<div class="card mt-3">
    <div class="card-header bg-white">
        <b>Donasi</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($donasi_popular as $data) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted sidebar" href="<?php echo base_url('donasi/detail/' . $data->donasi_slug); ?>">
                    <img src="<?php echo base_url('assets/img/donasi/' . $data->donasi_image); ?>">
                    <b><?php echo $data->donasi_title; ?></b><br><br>

                </a></li>
        <?php endforeach; ?>
    </ul>
</div> -->