<?php if (empty($transaksi)) : ?>
    <?php redirect(base_url('transaksi'), 'refresh'); ?>
<?php else : ?>
    <div class="container my-5">
        <div class="card">
            <div class="card-header bg-white">Detail Order</div>
            <div class="card-body">
                <!-- title row -->

                <!-- info row -->
                <div class="row">

                    <div class="col-sm-6">
                        <address>
                            <strong><?php echo $transaksi->user_name; ?> </strong> <br>
                            Alamat Jemput : <?php echo $transaksi->alamat_jemput; ?> <br>
                            Phone : <?php echo $transaksi->user_phone; ?> <br>
                            Email : <?php echo $transaksi->user_email; ?>
                        </address>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <b>Invoice #<?php echo $transaksi->kode_transaksi; ?></b><br>
                        <br>
                        <b>Tipe Pembayaran :</b> <?php echo $transaksi->tipe_pembayaran; ?><br>
                        <b>Status Pembayaran :</b>
                        <?php if ($transaksi->status_bayar == "Pending") : ?>
                            <div class="badge badge-warning badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                        <?php elseif ($transaksi->status_bayar == "Process") : ?>
                            <div class="badge badge-info badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                        <?php elseif ($transaksi->status_bayar == "Cancel") : ?>
                            <div class="badge badge-danger badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                        <?php else : ?>
                            <div class="badge badge-success badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                        <?php endif; ?>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Paket Kendaraan</th>

                                    <th>Harga</th>
                                    <th>Kode Unik</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td><strong><?php echo $transaksi->nama_mobil; ?></strong><br>
                                        <small><?php echo $transaksi->nama_paket; ?> , <?php echo $transaksi->lama_sewa; ?> Hari </small>
                                    </td>

                                    <td>IDR. <?php echo number_format($transaksi->harga_satuan, 0, ",", "."); ?></td>
                                    <td><?php echo $transaksi->kode_unik; ?></td>
                                    <td>IDR. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?></td>
                                </tr>
                            <tfoot>
                                <tr>
                                    <th> </th>

                                    <th></th>
                                    <th>Total</th>
                                    <th>IDR. <?php echo number_format($transaksi->total_harga, 0, ",", "."); ?></th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div><!-- /.col -->

                    <?php if ($transaksi->tipe_pembayaran == "Cash") : ?>
                    <?php else : ?>
                        <div class="col-md-6">

                            <?php foreach ($bank as $bank) : ?>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo $bank->bank_name; ?>
                                        : <span><?php echo $bank->bank_number; ?></span>
                                        <span><?php echo $bank->bank_account; ?></span>
                                    </li>
                                </ul>
                            <?php endforeach; ?>

                        </div>
                        <div class="col-md-6">

                            <a href="<?php echo base_url('transaksi/konfirmasi/' . $transaksi->id); ?>" class="btn btn-info btn-rounded pull-right"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</a>

                        </div>
                    <?php endif; ?>
                </div><!-- /.row -->


            </div>
        </div>
    </div>
<?php endif; ?>