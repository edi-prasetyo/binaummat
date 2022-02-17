<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container my-5">
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                Konfirmasi Pembayaran Invoice <?php echo $last_transaction->invoice_number; ?>
            </div>
            <div class="card-body">
                <?php
                echo $this->session->flashdata('message');
                if (isset($error_upload)) {
                    echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                    unset($_SESSION[$error_upload]);
                }
                ?>
                <?php echo form_open_multipart('donasi/confirmation/' . md5($last_transaction->id),  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                <div class="alert alert-success">
                    Silahkan Upload Bukti Tranfer agar kami dapat memverifikasi pembayaran anda
                </div>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input type="file" name="bukti_transfer" required>
                        <div class="invalid-feedback">Silahkan pilih gambar</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-info btn-block" type="submit">Kirim</button>
                    </div>
                    <div class="col-lg-6">
                        <a class="btn btn-success btn-block" href="https://wa.me/<?php echo $meta->whatsapp; ?>?text=Saya%20Ingin%20konfirmasi%20pembayaran%20Donasi%20dengan%20nomor%20Invoice%20<?php echo $last_transaction->invoice_number; ?>"><i class="ri-whatsapp-line"></i> Konfirmasi Manual</a>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>