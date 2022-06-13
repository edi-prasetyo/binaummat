<div class="col-md-7 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">

            <div class="text-center">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
            <?php
            echo form_open('admin/qurban/update/' . $qurban->id, array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
            ?>

            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Nama Qurban <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="qurban_name" value="<?php echo $qurban->qurban_name; ?>" required>
                    <div class="invalid-feedback">Silahkan masukan nama Link.</div>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" name="qurban_price" value="<?php echo $qurban->qurban_price; ?>" required>
                    <div class="invalid-feedback">Silahkan masukan Harga</div>
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
                </label>
                <div class="col-lg-6">
                    <div class="input-group mb-3">
                        <input type="file" name="qurban_image">
                    </div>
                    <img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $qurban->qurban_image); ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Add Qurban
                    </button>
                </div>
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>