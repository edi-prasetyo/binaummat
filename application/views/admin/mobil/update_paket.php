<div class="col-md-6 mx-auto">
  <div class="card shadow-sm">
    <div class="card-header bg-white">
      <?php echo $title; ?>
    </div>
    <div class="card-body">
      <?php
      //Form Open
      echo form_open(base_url('admin/mobil/update_paket/' . $paket->id));
      ?>

      <input type="hidden" name="mobil_id" value="<?php echo $paket->mobil_id ?>">

      <div class="form-group">
        <label>Nama Paket</label>
        <input type="text" class="form-control" name="paket_name" value="<?php echo $paket->paket_name ?>">
      </div>

      <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="paket_price" value="<?php echo $paket->paket_price ?>">
      </div>

      <div class="form-group">
        <label>Syarat & Ketentuan</label>
        <select name="ketentuan_id" class="form-control form-control-chosen">
          <option value="">Pilih Ketentuan</option>
          <?php foreach ($ketentuan as $ketentuan) { ?>
            <option value="<?php echo $ketentuan->id ?>" <?php if ($paket->ketentuan_id == $ketentuan->id) {
                                                            echo "selected";
                                                          } ?>>
              <?php echo $ketentuan->ketentuan_name ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
      </div>


      <?php
      //Form Close
      echo form_close();
      ?>
    </div>
  </div>
</div>