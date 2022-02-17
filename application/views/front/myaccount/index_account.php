<?php if ($this->session->userdata('id')) : ?>



    <div class="container mb-3 my-5">


        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
            echo $this->session->flashdata('message');
            echo '</div>';
        }


        ?>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?php echo $user->user_name; ?></h4>
                                <p class="text-secondary mb-1"><i class="bi-telephone-plus"></i> <?php echo $user->user_phone; ?></p>
                                <p class="text-muted font-size-sm"><?php echo $user->user_address; ?></p>

                                <a href="<?php echo base_url('myaccount/update'); ?>" class="btn btn-outline-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">

                <div class="row">
                    <div class="col-sm-6 col-md-12 mb-2">
                        <div class="card card-stats bg-primary card-round text-white">
                            <div class="card-header">
                                Transaksi
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="display-4 text-center text-white">
                                            <i class="bi-credit-card-2-front"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats my-auto">
                                        <h4 class="card-title"><?php echo count($transaksi); ?></h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user->user_name; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user->email; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user->user_phone; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user->user_address; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



























    </div>


<?php else : ?>

    <?php redirect('auth'); ?>


<?php endif; ?>