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
        filter: grayscale(100%);
        width: 1000px;
        height: 1000px;
        border-radius: 50%;
        content: "";
        background-color: #333;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .1);

    }

    .inputGroup label:before {
        /* filter: grayscale(100%); */
        width: 1000px;
        height: 1000px;
        border-radius: 50%;
        content: "";
        background-color: #333;
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

    img:after {
        filter: grayscale(100%);
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
<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url('donasi') ?>"> Donasi</a></li>

            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container">

    <div class="col-md-7 mx-auto">
        <?php foreach ($galery_featured as $featured) : ?>
            <div class="offer-slider">
                <div class="cat-item py-3">
                    <a class="d-block text-center" href="<?php echo $featured->galery_url; ?>">
                        <img src="<?php echo base_url('assets/img/galery/' . $featured->galery_img); ?>" class="img-fluid rounded">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php echo form_open('qurban'); ?>



        <div class="card text-center justify-content-center mb-3">
            <div class="card-header bg-white">
                Pilih Jenis Hewan Qurban
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($qurban as $qurban) : ?>
                        <div class="col-12">
                            <div class="inputGroup">
                                <input id="qurban<?php echo $qurban->id; ?>" name="qurban_id" value="<?php echo $qurban->id; ?>" type="radio">
                                <label for="qurban<?php echo $qurban->id; ?>">
                                    <div class="row">
                                        <div class="col-6">
                                            <?php echo $qurban->qurban_name; ?> Rp. <?php echo $qurban->qurban_price; ?>
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

        <div class="card text-center justify-content-center mb-3">
            <div class="card-header bg-white">
                Metode Pembayaran
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($bank as $bank) : ?>
                        <div class="col-6">
                            <div class="inputGroup">
                                <input id="radio<?php echo $bank->id; ?>" name="bank_id" value="<?php echo $bank->id; ?>" type="radio">
                                <label for="radio<?php echo $bank->id; ?>">
                                    <div class="row">
                                        <div class="col-6">
                                            <img class="img-fluid" id="img" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
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
            <div class="card-header bg-white">Informasi Pengqurban</div>
            <div class="card-body">
                <div class="form-group mb-2">
                    <label>Qurban Untuk</label>
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
                <div class="form-group mb-2">

                    <button type="submit" class="btn btn-success">Proses Pembayaran</button>
                </div>
            </div>
        </div>


        <?php echo form_close(); ?>

    </div>
</div>