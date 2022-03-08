<style>
    .inputGroup {
        background-color: #fff;
        display: block;
        margin: 10px 0;
        position: relative;

    }

    .inputGroup label {
        padding: 12px 30px;
        width: 100%;
        display: block;
        text-align: left;
        color: #3C454C;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 3px;

    }

    .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: "";
        background-color: #ececec;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .1);

    }

    .inputGroup label:after {
        width: 32px;
        height: 32px;
        content: "";
        border: 2px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
        border: 1px solid #005d46;

    }

    .inputGroup input:checked~label {
        color: #fff;
    }

    .inputGroup input:checked~label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;

    }

    .inputGroup input:checked~label:after {
        background-color: #008463;
        border-color: #005d46;

    }


    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
</style>

<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo substr($title, 0, 25); ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>


<div class="container my-3 mb-5 pb-3">

    <div class="col-md-7 mx-auto">
        <div class="card mb-3">
            <div class="card-body row">
                <div class="col-md-3"><img class="img-fluid" src="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>"> </div>
                <div class="col-md-9">
                    <h4><?php echo $donasi->donasi_title; ?></h4>
                </div>
            </div>
        </div>
        <?php echo form_open('donasi/checkout/' . md5($donasi->id)); ?>

        <div class="card mb-3">
            <div class="card-header bg-white">Masukan Nominal Donasi Anda</div>
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Nominal</label>

                    <input type="number" class="form-control" name="donasi_nominal" placeholder="">
                    <?php echo form_error('donasi_nominal', '<small class="text-danger pl-3 is-invalid">', '</small>'); ?>

                </div>
            </div>
        </div>

        <div class="card text-center justify-content-center mb-3">
            <div class="card-header bg-white">
                Metode Pembayaran
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($bank as $bank) : ?>
                        <div class="col-md-6">
                            <div class="inputGroup">
                                <input id="radio<?php echo $bank->id; ?>" name="bank_id" value="<?php echo $bank->id; ?>" type="radio">
                                <label for="radio<?php echo $bank->id; ?>">
                                    <div class="row">
                                        <div class="col-6">
                                            <img class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
                                        </div>
                                        <div class="col-4">
                                            <?php //echo $bank->bank_name; 
                                            ?>
                                        </div>
                                    </div>
                                </label>
                                <?php echo form_error('bank_id', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>


        </div>

        <div class="card mb-3">
            <div class="card-header bg-white">Informasi Donatur</div>
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="donatur_name" placeholder="Nama">
                    <?php echo form_error('donatur_name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group mb-2">
                    <label>No. Whatsapp</label>
                    <input type="text" class="form-control" name="donatur_phone" placeholder="081..">
                </div>
                <div class="form-group mb-2">
                    <label>Email</label>
                    <input type="text" class="form-control" name="donatur_email" placeholder="email">
                </div>
                <div class="form-group mb-2">
                    <label>Do'a Khusus</label>
                    <textarea class="form-control" name="doa_khusus" placeholder="Doa Khusus"></textarea>
                </div>
                <div style="z-index: 9999;" class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 p-5 text-center shadow">

                    <button type="submit" class="btn-order-block">Proses Pembayaran <i class="ri-arrow-right-line"></i></button>
                </div>
            </div>
        </div>


        <?php echo form_close(); ?>

    </div>
</div>