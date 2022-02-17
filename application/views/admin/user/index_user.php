<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
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
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>

                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($list_user as $list_user) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $list_user->user_name; ?></td>
                    <td><?php echo $list_user->role; ?></td>
                    <td>

                        <?php if ($list_user->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>

                    </td>

                    <td>
                        <?php if ($list_user->role_id == 1) : ?>
                        <?php else : ?>
                            <?php if ($list_user->is_active == 0) : ?>
                                <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/admin/activated/' . $list_user->id); ?>"><i class="fas fa-user-times"></i> Activated</a>
                            <?php else : ?>
                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/admin/banned/' . $list_user->id); ?>"><i class="fas fa-user-times"></i> Banned</a>

                            <?php endif; ?>
                        <?php endif; ?>

                        <a href="<?php echo base_url('admin/user/detail/' . $list_user->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>

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