<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/asrama/create'); ?>" class="btn btn-info btn-sm text-white">Buat Data Asrama</a>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th width="10%">Foto</th>
                    <th>Nama Asrama</th>
                    <th>Alamat</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($asrama as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><img class="img-fluid" src="<?php echo base_url('assets/img/asrama/' . $data->photo); ?>"></td>
                    <td><?php echo $data->asrama_name; ?></td>
                    <td><?php echo $data->asrama_address; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/bank/update/' . $data->id); ?>" class="btn btn-info btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
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