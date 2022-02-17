<div class="card mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $errors_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/donasi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>

        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Judul Donasi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="donasi_title" placeholder="Judul Donasi" value="<?php echo set_value('donasi_title'); ?>" required>
                <div class="invalid-feedback">Judul Harus Di isi</div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Target Donasi
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="donasi_target" placeholder="Pisahkan dengan koma" value="<?php echo set_value('donasi_target'); ?>">
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Sisa Waktu
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="sisa_waktu" id="sisawaktu">
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="category_id" class="form-control custom-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>">
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Anda harus memilih Kategori</div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Status Donasi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="donasi_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status donasi</div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="donasi_image" required>
                    <div class="invalid-feedback">Silahkan pilih gambar</div>
                </div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Deskripsi Donasi <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="donasi_desc" placeholder="Deskripsi Donasi" required></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Donasi</div>
            </div>
        </div>
        <div class="form-group mb-2">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="donasi_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('donasi_keywords'); ?>">
            </div>
        </div>

        <div class="form-group mb-2">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Donasi
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>