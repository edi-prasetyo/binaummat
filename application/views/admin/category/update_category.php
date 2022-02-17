<div class="col-md-7">
    <div class="card">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Error warning
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                echo form_open_multipart(base_url('admin/category/update/' . $category->id));

                ?>

                <div class="form-group mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="category_name" value="<?php echo $category->category_name ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Deskripsi Kategori</label>
                    <textarea class="form-control" name="category_desc" placeholder="Deskripsi Kategori"><?php echo $category->category_desc; ?></textarea>
                    <?php echo form_error('category_name', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label class="col-lg-3 col-form-label">Ubah icon <span class="text-danger">*</span>
                    </label>
                    <?php if ($category->category_image == null) : ?>
                    <?php else : ?>
                        <img class="img-fluid" src="<?php echo base_url('assets/img/category/' . $category->category_image); ?>">
                    <?php endif; ?>
                    <div class="col-lg-6">
                        <div class="input-group mb-3">
                            <input type="file" name="category_image">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>