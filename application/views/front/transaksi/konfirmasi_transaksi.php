<div class="container my-5">
    <div class="col-md-8 mx-auto">
        <?php if ($transaksi->status_bayar == 'Done') : ?>
            <div class="card alert alert-success">
                <div class="card-body text-center">
                    Order Anda sudah di konfirmasi<br>
                    <a href="<?php echo base_url('transaksi'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
                </div>
            </div>
        <?php elseif ($transaksi->status_bayar == 'Process') : ?>
            <div class="card alert alert-success">
                <div class="card-body text-center">
                    Order Anda sudah di konfirmasi<br>
                    <a href="<?php echo base_url('transaksi'); ?>" class="btn btn-info btn-block my-3">Kembali</a>
                </div>
            </div>
        <?php else : ?>
            <div class="card">
                <div class="card-header bg-white">
                    Detail Pembayaran
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3><?php echo $transaksi->nama_mobil ?></h3>
                        <span class="badge badge-info badge-pill"><?php echo $transaksi->nama_paket; ?></span>
                    </div>

                    <?php echo $transaksi->lama_sewa; ?> Hari
                    IDR. <?php echo number_format($transaksi->harga_satuan, 0, ',', '.'); ?> + <?php echo $transaksi->kode_unik; ?> ( Kode Unik ) <br>

                    Jumlah yang harus di Transfer
                    <div class="display-4 font-weight-bold"> IDR. <?php echo number_format($transaksi->total_harga, 0, ",",  "."); ?></div>
                    Silahkan Transfer Pembayaran ke Rekening
                    <div class="alert alert-success">




                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" width="15%"></th>
                                    <th scope="col">Bank</th>
                                    <th scope="col">Nomor Rek</th>
                                    <th scope="col">Atas Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bank as $bank) : ?>
                                    <tr>
                                        <td><img src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>" class="img-fluid"> </td>
                                        <td> <?php echo $bank->bank_name; ?></td>
                                        <td><?php echo $bank->bank_number; ?></td>
                                        <td><?php echo $bank->bank_account; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>



                    </div>
                    Upload Bukti Struk Pembayaran : <br>

                    <?php echo form_open_multipart('transaksi/konfirmasi/' . $transaksi->id); ?>
                    <div class="form-group row mt-3">
                        <div class="col-12">
                            <div class="wrap-custom-file col-md-12">
                                <input type="file" name="bukti_bayar" id="image1" accept=".gif, .jpg, .png, jpeg">
                                <label for="image1">
                                    <span>Foto Struk Transfer</span>
                                    <i class="fa fa-plus-circle"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="Process" name="transaction_status">
                    <button type="submit" class="btn btn-success btn-block text-white">Konfirmasi Pembayaran</button>
                    <?php echo form_close(); ?>


                </div>
            </div>

        <?php endif; ?>
    </div>
</div>