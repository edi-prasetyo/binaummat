<div class="col-md-7">
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
            echo form_open_multipart('admin/donasi/update/' . $donasi->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
            ?>

            <div class="form-group mb-2">
                <label class="col-form-label">Judul Donasi <span class="text-danger">*</span>
                </label>

                <input type="text" class="form-control" name="donasi_title" placeholder="Judul Donasi" value="<?php echo $donasi->donasi_title; ?>" required>
                <div class="invalid-feedback">Judul Harus Di isi</div>

            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Target Donasi
                </label>

                <input type="text" class="form-control" name="donasi_target" placeholder="Pisahkan dengan koma" value="<?php echo $donasi->donasi_target; ?>">

            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Sisa Waktu
                </label>

                <input type="text" class="form-control" name="sisa_waktu" id="sisawaktu">

            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Kategori <span class="text-danger">*</span>
                </label>

                <select name="category_id" class="form-control custom-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>" <?php if ($donasi->category_id == $category->id) {
                                                                        echo "selected";
                                                                    } ?>>
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Anda harus memilih Kategori</div>

            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Status Donasi <span class="text-danger">*</span>
                </label>

                <select name="donasi_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1" <?php if ($donasi->donasi_status == 1) {
                                            echo "selected";
                                        } ?>>Active</option>
                    <option value="0" <?php if ($donasi->donasi_status == 0) {
                                            echo "selected";
                                        } ?>>Inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status donasi</div>

            </div>

            <div class="form-group mb-2 row">
                <label class="col-lg-6 col-form-label mb-3">Ganti Gambar <span class="text-danger">*</span>
                    <div class="input-group mb-3">
                        <input type="file" name="donasi_image">
                        <div class="invalid-feedback">Silahkan pilih gambar</div>
                    </div>
                </label>
                <div class="col-lg-3">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>">
                </div>
            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Deskripsi Donasi <span class="text-danger">*</span>
                </label>
                <textarea class="form-control" id="summernote" name="donasi_desc" placeholder="Deskripsi Donasi" required><?php echo $donasi->donasi_desc; ?></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Donasi</div>

            </div>
            <div class="form-group mb-2">
                <label class="col-form-label">Keywords
                </label>

                <input type="text" class="form-control" name="donasi_keywords" placeholder="Pisahkan dengan koma" value="<?php echo $donasi->donasi_keywords; ?>">

            </div>

            <div class="form-group mb-2">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Update Donasi
                    </button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>