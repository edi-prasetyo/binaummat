<?php
//Error warning
echo validation_errors('<div class="alert alert-warning">', '</div>');
//Error Upload Gabar
if (isset($error_upload)) {
  echo '<div class="alert alert-warning">' . $error_upload . '</div>';
}


// Form Open
echo form_open_multipart(base_url('admin/mobil/update/' . $mobil->id));
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
              <input type="text" name="mobil_name" class="form-control" placeholder="Nama Mobil" value="<?php echo $mobil->mobil_name ?>">
            </div>
          </div>

          <div class="col-md-3">
            <label>Merek Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="merek_id" class="form-control custom-select">
                <option>Pilih Merek</option>
                <?php foreach ($merek as $merek) { ?>
                  <option value="<?php echo $merek->id ?>" <?php if ($mobil->merek_id == $merek->id) {
                                                              echo "selected";
                                                            } ?>>
                    <?php echo $merek->merek_name ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label>Jenis Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="jenismobil_id" class="form-control custom-select">
                <option value="">Pilih Jenis Mobil</option>
                <?php foreach ($jenismobil as $jenismobil) { ?>
                  <option value="<?php echo $jenismobil->id ?>" <?php if ($mobil->jenismobil_id == $jenismobil->id) {
                                                                  echo "selected";
                                                                } ?>>
                    <?php echo $jenismobil->jenismobil_name ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Penumpang</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_penumpang" class="form-control" placeholder="Kapasitas Penumpang" value="<?php echo $mobil->mobil_penumpang ?>">
            </div>
          </div>

          <div class="col-md-3">
            <label>Kapasitas Bagasi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_bagasi" class="form-control" placeholder="Kapasitas Bagasi" value="<?php echo $mobil->mobil_bagasi ?>">
            </div>
          </div>

          <div class="col-md-3">
            <label>Harga Awal</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_harga" class="form-control" placeholder="Rp. .." value="<?php echo $mobil->mobil_harga ?>">
            </div>
          </div>

          <div class="col-md-3">
            <label>Status Mobil</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_status" class="form-control custom-select">
                <option>Status Mobil</option>
                <option value="Aktif" <?php if ($mobil->mobil_status == "Aktif") {
                                        echo "selected";
                                      } ?>>Aktif</option>
                <option value="Nonaktif" <?php if ($mobil->mobil_status == "Nonaktif") {
                                            echo "selected";
                                          } ?>>
                  Nonaktif
                </option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label>Transmisi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_transmisi" class="form-control custom-select">
                <option value="">Transmisi Mobil</option>
                <option value="Manual" <?php if ($mobil->mobil_transmisi == "Manual") {
                                          echo "selected";
                                        } ?>>Manual</option>
                <option value="Automatic" <?php if ($mobil->mobil_transmisi == "Automatic") {
                                            echo "selected";
                                          } ?>>Automatic</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label>Jenis BBM</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <select name="mobil_bbm" class="form-control custom-select">
                <option value="">Pilih Jenis BBM</option>
                <option value="Bensin" <?php if ($mobil->mobil_bbm == "Bensin") {
                                          echo "selected";
                                        } ?>>Bensin</option>
                <option value="Solar" <?php if ($mobil->mobil_bbm == "Solar") {
                                        echo "selected";
                                      } ?>>Solar</option>
                <option value="Bio Solar" <?php if ($mobil->mobil_bbm == "Bio Solar") {
                                            echo "selected";
                                          } ?>>Bio Solar</option>
                <option value="Dex Lite" <?php if ($mobil->mobil_bbm == "Dex Lite") {
                                            echo "selected";
                                          } ?>>Dex Lite</option>
                <option value="Pertalite" <?php if ($mobil->mobil_bbm == "Pertalite") {
                                            echo "selected";
                                          } ?>>Pertalite</option>
                <option value="Pertamax" <?php if ($mobil->mobil_bbm == "Pertamax") {
                                            echo "selected";
                                          } ?>>Pertamax</option>
                <option value="Pertamax Plus" <?php if ($mobil->mobil_bbm == "Pertamax Plus") {
                                                echo "selected";
                                              } ?>>Pertamax Plus</option>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <label>Tahun Kendaraan</label>
          </div>
          <div class="col-md-9">
            <div class="form-group form-group-lg">
              <input type="text" name="mobil_tahun" class="form-control" placeholder="Tahun Kendaraan.." value="<?php echo $mobil->mobil_tahun; ?>">
            </div>
          </div>

          <div class="col-md-3">
            <label>Deskripsi</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <textarea name="mobil_desc" class="form-control" id="summernote" placeholder="Deskripsi Mobil"><?php echo $mobil->mobil_desc ?></textarea>
            </div>
          </div>

          <div class="col-md-3">
            <label>Keyword Mobil (Untuk SEO google)</label>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <input type="text" name="mobil_keywords" class="form-control" value="<?php echo $mobil->mobil_keywords ?>">
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label>Ganti Gambar</label><br>
          <input type="file" name="mobil_gambar">
          <img src="<?php echo base_url('assets/img/mobil/' . $mobil->mobil_gambar) ?>" width="70%" class="img img-thumbnail">
        </div>


        <div class="form-group">
          <button type="submit" name="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Update Mobil</button>
        </div>
      </div>
    </div>


    <?php
    //Form close
    echo form_close();
    ?>

  </div>
</div>