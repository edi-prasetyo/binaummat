<?php $meta = $this->meta_model->get_meta(); ?>


<nav class="site-header bg-white sticky-top py-1 shadow-sm">
	<div class="container py-2 d-flex justify-content-between align-items-center">
		<span class="text-dark text-center font-weight-bold">
			<div class="col-7 mx-auto"> <img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>">
			</div>
			<?php //echo substr($title, 0, 25); 
			?>
		</span>
		<div style="color:transparent;"></div>
	</div>
</nav>


<div class="container mt-4">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol> -->
		<div class="carousel-inner">
			<?php $i = 1;
			foreach ($slider as $slider) { ?>
				<div class="carousel-item <?php if ($i == 1) {
												echo 'active';
											} ?> ">
					<a href="<?php echo base_url() . $slider->galery_url; ?>"><img class="img-fluid" style="border-radius: 7px;" width="100%" src="<?php echo base_url('assets/img/galery/' . $slider->galery_img) ?>" alt="<?php echo $slider->galery_title ?>"></a>
					<div class="container">
						<div class="carousel-caption text-left">
						</div>
					</div>
				</div>
			<?php $i++;
			} ?>
		</div>
		<a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>


<div class="container">
	<div class="row my-3">

		<?php foreach ($category as $category) : ?>
			<div class="col-md-3 col-6">
				<a class="text-muted text-decoration-none" href="<?php echo base_url('category/item/' . $category->category_slug); ?>">
					<div class="card my-3 shadow border-0">
						<div class="card-body text-center">
							<img class="img-fluid" style="max-width: 30%;" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>"><br>
							<b><?php echo $category->category_name; ?></b>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>


	</div>
</div>

<!-- Most sales -->

<!-- <section class="bg-white">

	<div class="p-3 title d-flex align-items-center">
		<h5 class="m-0 pt-3">Promo</h5>
		<a class="pt-3 font-weight-bold ml-auto" href="#">Detail Promo <i class="feather-chevrons-right"></i></a>
	</div>

	<div class="offer-slider bg-white border-bottom">

		<div class="cat-item px-1 py-3">
			<a class="bg-white d-block text-center shadow" href="trending.html">
				<img src="assets/img/promo/pro1.jpg" class="img-fluid rounded">
			</a>
		</div>
		<div class="cat-item px-1 py-3">
			<a class="bg-white d-block text-center shadow" href="trending.html">
				<img src="assets/img/promo/pro2.jpg" class="img-fluid rounded">
			</a>
		</div>
		<div class="cat-item px-1 py-3">
			<a class="bg-white d-block text-center shadow" href="trending.html">
				<img src="assets/img/promo/pro3.jpg" class="img-fluid rounded">
			</a>
		</div>
		<div class="cat-item px-1 py-3">
			<a class="bg-white d-block text-center shadow" href="trending.html">
				<img src="assets/img/promo/pro4.jpg" class="img-fluid rounded">
			</a>
		</div>
	</div>

</section> -->


<!-- Most sales -->
<div class="p-3 title d-flex align-items-center">
	<h5 class="m-0 pt-3">Berita Terbaru</h5>
	<a class="pt-3 font-weight-bold ml-auto" href="<?php echo base_url('berita'); ?>">Lihat Semua <i class="feather-chevrons-right"></i></a>
</div>


<div class="most_sale px-3 pb-3 mb-5">
	<div class="row">

		<?php foreach ($berita as $data) : ?>

			<div class="col-12 pt-2">
				<a href="<?php echo base_url('berita/detail/' . $data->berita_slug); ?>" class="text-muted text-decoration-none">
					<div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
						<div class="list-card-image">
							<img src="<?php echo base_url('assets/img/artikel/' . $data->berita_gambar); ?>" class="img-fluid item-img w-100">
						</div>
						<div class="p-3 position-relative">
							<div class="list-card-body">
								<h6 class="mb-1"><?php echo substr($data->berita_title, 0, 30); ?>..</h6>
								<p class="text-gray mb-3"><?php echo date('F j, Y', strtotime($data->date_created)); ?></p>
							</div>
							<div class="list-card-badge">
								<span class="badge badge-success"><?php echo $data->category_name; ?></span>
							</div>
						</div>
					</div>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>