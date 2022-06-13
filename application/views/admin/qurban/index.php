<div class="card">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">

        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/qurban/create'); ?>" class="btn btn-rounded btn-info text-white">Tambah Qurban</a>

    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php foreach ($qurban as $data) { ?>
                <tr>
                    <td><?php echo $data->qurban_name; ?></td>
                    <td><?php echo number_format($data->qurban_price, 0, ",", "."); ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/qurban/update/') . $data->id; ?>" class="btn btn-info btn-sm text-white"> Ubah</a>
                        <?php include "delete.php"; ?>
                    </td>
                </tr>
            <?php }; ?>
        </table>
    </div>
</div>