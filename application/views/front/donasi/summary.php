<div class="container my-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="justify-content-center text-center">
                    Nomor Pembayaran<br>
                    <b style="font-size:25px;"> <?php echo $last_transaction->invoice_number; ?></b><br>
                    Total Pembayaran<br>
                    <b style="font-size:35px;">Rp. <?php echo number_format($last_transaction->total_nominal, 0, ",", "."); ?></b><br>

                </div>

                <div class="alert alert-secondary" role="alert">
                    <ul class="list-group list-group-flush">

                        <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: transparent;">
                            Nominal Donasi
                            <span class="text-muted"><?php echo $last_transaction->total_nominal; ?> </span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: transparent;"> Kode Unik
                            <span class="text-muted"><?php echo $last_transaction->kode_unik; ?> </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="background-color: transparent;"> Status
                            <span class="badge badge-warning badge-pill"><?php echo $last_transaction->payment_status; ?></span>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="card my-3">
            <div class="card-body">
                Silahkan melakukan pembayaran melalui rekening di bawah ini
                <div class="alert alert-light border text-dark text-center">
                    <img width="30%" src="<?php echo base_url('assets/img/bank/' . $last_transaction->bank_logo); ?>"><br>
                    <b style="font-size: 20px;"> <?php echo $last_transaction->bank_number; ?></b><br>
                    <small>A/n <?php echo $last_transaction->bank_account; ?></small>

                </div>

                <div class="alert alert-warning" role="alert">
                    Transfer Sebelum tanggal <?php
                                                $newDate   =   date(" d M Y", strtotime($last_transaction->expired_at));
                                                echo $newDate; ?> Jam <?php
                                                                        $newDate   =   date("H:i", strtotime($last_transaction->expired_at));
                                                                        echo $newDate; ?> atau donasi anda akan di batalkan otomatis
                </div>
            </div>
            <div class="card-footer bg-white">
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-block btn-primary" href="<?php echo base_url('donasi/confirmation/' . md5($last_transaction->id)); ?>">Konfirmasi Pembayaran</a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-block btn-success" href="">Kembali ke Beranda</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>