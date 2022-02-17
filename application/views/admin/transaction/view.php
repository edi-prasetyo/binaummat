<div class="row mt-6">
    <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12
              col-12">
        <div class="row">
            <div class="col-12 mb-6">
                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Info Donasi</h4>
                    </div>
                    <!-- card body  -->
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        }
                        ?>
                        <!-- row  -->
                        <div class="row">
                            <div class="col-xl-7 col-lg-6 col-md-12 col-12">
                                <div class="mb-2">
                                    <!-- content  -->
                                    <p class="text-muted mb-0"><?php echo $transaction->invoice_number; ?></p>
                                    <h3 class="mt-2 mb-3 fw-bold"><?php echo $transaction->donasi_title; ?></h3>
                                    <?php echo $transaction->category_name; ?>
                                </div>
                            </div>
                            <!-- col  -->
                            <div class="col-xl-5 col-lg-6 col-md-12 col-12">
                                <!-- content  -->
                                <div>
                                    <?php if ($transaction->payment_status == 'Expired') : ?>
                                        <small class="text-danger">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php elseif ($transaction->payment_status == 'Pending') : ?>
                                        <small class="text-warning">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php elseif ($transaction->payment_status == 'Process') : ?>
                                        <small class="text-info">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php else : ?>
                                        <small class="text-success">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php endif; ?>
                                    <h2 class="fw-bold text-primary">Rp. <?php echo number_format($transaction->total_nominal, 0, ",", "."); ?></h2>


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card footer  -->
                    <div class="card-footer bg-white">
                        <div class="d-md-flex justify-content-between
                        align-items-center">
                            <!-- text  -->
                            <div class="mb-3 mb-lg-0 text-center text-sm-start">
                                <h5 class="text-uppercase mb-0">Pembayaran</h5>
                                <div class="mt-2">
                                    <?php echo $transaction->bank_name; ?>
                                </div>
                            </div>
                            <div class="text-center text-md-start">
                                <?php if ($transaction->payment_status == "Pending") : ?>
                                    <a href="<?php echo base_url('admin/transaction/paid/' . $transaction->id); ?>" class="btn btn-success text-white">Sudah Dibayar</a>
                                <?php else : ?>
                                <?php endif; ?>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-6">


                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Informasi Donatur</h4>
                    </div>
                    <!-- card body  -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12 col-12 mb-4 mb-lg-0">
                                <div class="mb-3 mb-lg-0">



                                    <span class="d-block text-dark fw-medium fs-4">
                                        <?php echo $transaction->donatur_name; ?><br>
                                        <p class="mb-1">E-mail: <a href="#"><?php echo $transaction->donatur_email; ?></a></p>
                                        <p class="mb-1">Phone: <?php echo $transaction->donatur_phone; ?></p>
                                    </span>



                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 d-flex
                          justify-content-lg-end">
                                <!-- text  -->
                                <div class="mb-2">
                                    <?php if ($transaction->bukti_transfer == null) : ?>
                                        <div class="alert alert-warning">Belum Mengkonfirmasi</div>
                                    <?php else : ?>
                                        <img src="<?php echo base_url('assets/img/struk/' . $transaction->bukti_transfer); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white">
                        <?php if ($transaction->payment_status == "Process") : ?>
                            <a href="<?php echo base_url('admin/transaction/paid/' . $transaction->id); ?>" class="btn btn-success text-white">Sudah Dibayar</a>
                        <?php else : ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>