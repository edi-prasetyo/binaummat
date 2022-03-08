<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo substr($title, 0, 25); ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>
<div class="container my-5">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                Terima Kasih,<br>
                Konfirmasi Berhasil Terkirim<br>
                <div style="font-size: 100px;" class="text-success"> <i class="ri-checkbox-circle-fill"></i></div>
                <?php echo $last_transaction->invoice_number; ?>
            </div>
        </div>

    </div>

</div>