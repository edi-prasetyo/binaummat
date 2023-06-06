<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-header bg-white">
            <?php echo $title; ?>
        </div>
        <div class="card-body">


            <div class="text-center">
                <?php
                echo $this->session->flashdata('message');
                if (isset($error_upload)) {
                    echo '<div class="alert alert-warning">' . $error_upload . '</div>';
                    unset($_SESSION[$error_upload]);
                }
                ?>
            </div>
            <?php
            echo form_open_multipart('admin/asrama/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
            ?>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Nama Asrama <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="asrama_name" placeholder="Nama Asrama" value="<?php echo set_value('asrama_name'); ?>" required>
                    <div class="invalid-feedback">Silahkan masukan nama Asrama</div>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Alamat Asrama <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="asrama_address" placeholder="Alamat" value="<?php echo set_value('asrama_number'); ?>" required>
                    <div class="invalid-feedback">Silahkan masukan Alamat Asrama</div>
                </div>
            </div>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Upload Foto <span class="text-danger">*</span>
                </label>
                <div class="col-lg-9">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon02" required>
                            <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                        </div>

                    </div>

                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Simpan Asrama
                    </button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>