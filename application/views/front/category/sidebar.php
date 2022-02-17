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

<div class="card mt-3">
    <div class="card-header bg-white">
        <b>Rental Mobil</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($mobil_popular as $mobil_popular) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted sidebar" href="<?php echo base_url('rental-mobil/order/' . $mobil_popular->mobil_slug); ?>">
                    <img src="<?php echo base_url('assets/img/mobil/' . $mobil_popular->mobil_gambar); ?>">
                    <b><?php echo $mobil_popular->mobil_name; ?></b><br><br>
                    IDR. <?php echo number_format($mobil_popular->mobil_harga, 0, ",", "."); ?>
                </a></li>
        <?php endforeach; ?>
    </ul>
</div>