<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-muted">
                        <h1 class="h4 text-gray-900"><i class="bi-shield-lock" style="font-size: 2rem;"></i> Change your password?</h1>
                        <h5 class="mb-4"><?php echo $this->session->userdata('reset_email'); ?></h5>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php

                    echo form_open_multipart('auth/changepassword',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
                    ?>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password1" id="password1" placeholder="Enter new Password..." required>
                        <div class="invalid-feedback">Silahkan Buat passwprd Baru</div>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="password2" id="password2" placeholder="Repeat new Password..." required>
                        <div class="invalid-feedback">Silahkan Ulangi passwprd Baru</div>
                    </div>


                    <button type="submit" class="btn btn-info btn-block">
                        Change Password
                    </button>

                    <?php echo form_close() ?>


                </div>

            </div>
        </div>
    </div>

</div>