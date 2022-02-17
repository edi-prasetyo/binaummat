<?php
//Error warning
echo validation_errors('<div class="alert alert-warning">', '</div>');
//Error Upload Gabar
if (isset($error_upload)) {
  echo '<div class="alert alert-warning">' . $error_upload . '</div>';
}


// Form Open
echo form_open_multipart('admin/mobil/create', array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
?>

<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <?php echo $title; ?>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-md-3">
            <label>Nama Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_name" class="form-control" placeholder="Nama Mobil" value="<?php echo set_value('mobil_name') ?>" required>
              <div class="invalid-feedback">Silahkan masukan nama Mobil.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Merek Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="merek_id" class="form-control custom-select" required>
                <option value="">-- Pilih Merek --</option>
                <?php foreach ($merek as $merek) { ?>
                  <option value="<?php echo $merek->id ?>">
                    <?php echo $merek->merek_name ?>
                  </option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Silahkan Pilih Merek Mobil.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Jenis Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="jenismobil_id" class="form-control custom-select" required>
                <option value="">-- Pilih Jenis Mobil --</option>
                <?php foreach ($jenismobil as $jenismobil) { ?>
                  <option value="<?php echo $jenismobil->id ?>">
                    <?php echo $jenismobil->jenismobil_name ?>
                  </option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Silahkan Pilih Type Mobil.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Penumpang</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_penumpang" class="form-control" placeholder="Kapasitas Penumpang" value="<?php echo set_value('mobil_penumpang') ?>" required>
              <div class="invalid-feedback">Silahkan masukan Kapasitas Penumpang.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Bagasi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_bagasi" class="form-control" placeholder="Kapasitas Bagasi" value="<?php echo set_value('mobil_bagasi') ?>" required>
              <div class="invalid-feedback">Silahkan masukan Kapasitas Bagasi.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Harga Awal</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_harga" class="form-control" placeholder="Rp. .." value="<?php echo set_value('mobil_harga') ?>" required>
              <div class="invalid-feedback">Silahkan masukan Harga Awal.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Status Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_status" class="form-control custom-select" required>
                <option value="">--Status Mobil--</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
              </select>
              <div class="invalid-feedback">Silahkan Pilih Status Mobil.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Transmisi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_transmisi" class="form-control custom-select" required>
                <option value="">--Transmisi Mobil--</option>
                <option value="Manual">Manual</option>
                <option value="Automatic">Automatic</option>
              </select>
              <div class="invalid-feedback">Silahkan pilih Transmisi.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Jenis BBM</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_bbm" class="form-control custom-select" required>
                <option value="">Pilih Jenis BBM</option>
                <option value="Bensin">Bensin</option>
                <option value="Solar">Solar</option>
                <option value="Bio Solar">Bio Solar</option>
                <option value="Dex Lite">Dex Lite</option>
                <option value="Pertalite">Pertalite</option>
                <option value="Pertamax">Pertamax</option>
                <option value="Pertamax Plus">Pertamax Plus</option>
              </select>
              <div class="invalid-feedback">Silahkan Pilih Jenis BBM.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Tahun Kendaraan</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_tahun" class="form-control" placeholder="Tahun Kendaraan.." value="<?php echo set_value('mobil_tahun') ?>" required>
              <div class="invalid-feedback">Pilih Tahun Kendaraan.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Deskripsi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <textarea name="mobil_desc" class="form-control" id="summernote" placeholder="Deskripsi Mobil" required><?php echo set_value('mobil_desc') ?></textarea>
              <div class="invalid-feedback">Silahkan masukan Deskripsi Kendaraan.</div>
            </div>
          </div>

          <div class="col-md-3">
            <label>Keyword Mobil (Untuk SEO google)</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" name="mobil_keywords" class="form-control" placeholder="Keywords Mobil">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <div class="col-md-md-4">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label>Upload Gambar</label><br>
          <input type="file" name="mobil_gambar" required>
          <div class="invalid-feedback">Silahkan Pilih Gambar.</div>
        </div>


        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan Mobil</button>
        </div>
      </div>
    </div>


    <?php
    //Form close
    echo form_close();
    ?>

  </div>
</div>