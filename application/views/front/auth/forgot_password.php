<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-muted">
                        <h1 class="h4 text-gray-900 mb-4"><i class="bi-shield-lock" style="font-size: 2rem;"></i> Lupa Password?</h1>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php

                    echo form_open_multipart('auth/forgotpassword',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
                    ?>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Masukan Email Terdaftar..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase" required>
                        <div class="invalid-feedback">Silahkan masukan Email</div>
                    </div>


                    <button type="submit" class="btn btn-info btn-user btn-block">
                        Reset Password
                    </button>

                    <?php echo form_close() ?>
                    <hr>

                    <div class="text-center">
                        <a class="text-muted" href="<?php echo base_url('auth') ?> ">Kembali Ke halaman Login</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>