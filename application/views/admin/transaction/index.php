<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>

    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Donatur</th>
                    <th>Donasi</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaction as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><b><?php echo $data->donatur_name; ?></b><br>
                        <i> <?php echo $data->category_name; ?><i>
                    </td>
                    <td>
                        <?php echo $data->donasi_title; ?> <br>
                        <b><?php echo $data->invoice_number; ?></b>

                    </td>


                    <td>
                        <b> Rp. <?php echo number_format($data->total_nominal, '0', ',', '.'); ?></b><br>
                        <?php if ($data->payment_method == "Cash") : ?>
                            <div class="text-danger"> <?php echo $data->payment_method; ?></div>
                        <?php else : ?>
                            <div class="text-info"> <?php echo $data->payment_method; ?></div>
                        <?php endif; ?>

                    </td>
                    <td>
                        <?php if ($data->payment_status == "Pending") : ?>
                            <div class="badge rounded-pill bg-warning"> <?php echo $data->payment_status; ?></div>
                        <?php elseif ($data->payment_status == "Process") : ?>
                            <div class="badge rounded-pill bg-info"> <?php echo $data->payment_status; ?></div>
                        <?php elseif ($data->payment_status == "Expired") : ?>
                            <div class="badge rounded-pill bg-danger"> <?php echo $data->payment_status; ?></div>
                        <?php else : ?>
                            <div class="badge rounded-pill bg-success"> <?php echo $data->payment_status; ?></div>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="<?php echo base_url('admin/transaction/detail/' . $data->id); ?>" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Lihat</a>
                    </td>
                </tr>
            <?php $no++;
            }; ?>
        </table>


    </div>

    <div class="card-footer bg-white">
        <div class="pagination col-md-12">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>

</div>