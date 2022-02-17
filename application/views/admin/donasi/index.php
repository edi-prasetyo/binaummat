<div class="card">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/donasi/create'); ?>" class="btn btn-primary text-white waves-effect waves-light">Create Campaign</a>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>


    <div class="table-responsive">
        <table class="table table-flush">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Donasi</th>
                    <th>Kategori</th>
                    <th>date Post</th>
                    <th>Views</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($donasi as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->donasi_title; ?></td>
                    <td><?php echo $data->category_name; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($data->created_at)); ?> <?php echo date('H:i:s', strtotime($data->created_at)); ?> WIB</td>
                    <td><?php echo $data->donasi_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('donasi/detail/' . $data->donasi_slug); ?>" class="btn btn-primary btn-sm"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/donasi/update/' . $data->id); ?>" class="btn btn-info btn-sm"><i class="ti-pencil-alt"></i> Edit</a>
                        <?php include "delete.php"; ?>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>

        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>

    </div>

</div>