<?php if ($this->session->userdata('id')) : ?>

    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb my-3">
                <li class="breadcrumb-item"><a href="<?php echo base_url('myaccount') ?>"><i class="ti ti-user"></i> Account</a></li>
                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>

    <div class="container mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <?php
                    //Notifikasi
                    if ($this->session->flashdata('message')) {
                        echo '<div class="alert alert-success alert-dismissable fade show">';
                        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                        echo $this->session->flashdata('message');
                        echo '</div>';
                    }


                    ?>

                    <div class="card-header bg-white">
                        <?php echo $title; ?>


                    </div>




                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Mobil</th>
                                    <th scope="col">Paket</th>
                                    <th width="col">QTY</th>
                                    <th width="col">Harga</th>
                                    <th width="col">Status</th>
                                    <th width="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transaksi as $transaksi) : ?>

                                    <tr>

                                        <td><?php echo date('d/m/Y', strtotime($transaksi->date_created)); ?></td>
                                        <td><?php echo $transaksi->nama_mobil; ?></td>
                                        <td><?php echo $transaksi->nama_paket; ?> </td>
                                        <td><?php echo $transaksi->lama_sewa; ?> Hari</td>
                                        <td>Rp. <?php
                                                echo number_format($transaksi->total_harga, '0', ',', '.'); ?></td>
                                        <td>
                                            <?php if ($transaksi->status_bayar == "Pending") : ?>
                                                <div class="badge badge-warning badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                                            <?php elseif ($transaksi->status_bayar == "Process") : ?>
                                                <div class="badge badge-info badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                                            <?php elseif ($transaksi->status_bayar == "Cancel") : ?>
                                                <div class="badge badge-danger badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                                            <?php else : ?>
                                                <div class="badge badge-success badge-pill px-3"> <?php echo $transaksi->status_bayar; ?> </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('myaccount/detail_transaksi/' . $transaksi->id); ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Lihat</a>
                                        </td>
                                    </tr>

                                <?php
                                endforeach; ?>

                            </tbody>
                        </table>
                    </div>



                    <div class="card-footer bg-white">
                        <div class="pagination col-md-12 text-center">
                            <?php if (isset($pagination)) {
                                echo $pagination;
                            } ?>
                        </div>
                    </div>






                </div>
            </div>
        </div>
    </div>



<?php else : ?>

    <?php redirect('auth'); ?>

<?php endif; ?>