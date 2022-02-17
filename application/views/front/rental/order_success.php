<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header">Detail Order</div>
        <div class="card-body">



            <!-- title row -->

            <!-- info row -->
            <div class="row">

                <div class="col-sm-6">
                    <address>
                        <strong><?php echo $last_transaksi->user_name; ?> </strong> <br>
                        Alamat Jemput : <?php echo $last_transaksi->alamat_jemput; ?> <br>
                        Phone : <?php echo $last_transaksi->user_phone; ?> <br>
                        Email : <?php echo $last_transaksi->user_email; ?>
                    </address>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <b>Invoice #<?php echo $last_transaksi->kode_transaksi; ?></b><br>
                    <br>
                    <b>Tipe Pembayaran :</b> <?php echo $last_transaksi->tipe_pembayaran; ?><br>
                    <b>Status Pembayaran :</b> <?php echo $last_transaksi->status_bayar; ?>
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
                                <td><strong><?php echo $last_transaksi->nama_mobil; ?></strong><br>
                                    <small><?php echo $last_transaksi->nama_paket; ?> , <?php echo $last_transaksi->lama_sewa; ?> Hari </small>
                                </td>

                                <td>IDR. <?php echo number_format($last_transaksi->harga_satuan, 0, ",", "."); ?></td>
                                <td><?php echo $last_transaksi->kode_unik; ?></td>
                                <td>IDR. <?php echo number_format($last_transaksi->total_harga, 0, ",", "."); ?></td>
                            </tr>
                        <tfoot>
                            <tr>
                                <th> </th>

                                <th></th>
                                <th>Total</th>
                                <th>IDR. <?php echo number_format($last_transaksi->total_harga, 0, ",", "."); ?></th>
                            </tr>
                        </tfoot>
                        </tbody>
                    </table>
                </div><!-- /.col -->


                <?php if ($last_transaksi->tipe_pembayaran == "Cash") : ?>
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

                        <a href="<?php echo base_url('transaksi/konfirmasi/' . $last_transaksi->id); ?>" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</a>

                    </div>
                <?php endif; ?>
            </div><!-- /.row -->


        </div>
    </div>
</div>