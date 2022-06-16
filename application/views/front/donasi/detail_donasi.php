<?php
$meta = $this->meta_model->get_meta();
// error_reporting(0);
// ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>">
    <meta name="description" content="<?php echo $deskripsi ?>">
    <meta name="keywords" content="<?php echo $meta->title . ',' . $keywords ?>">
    <meta name="author" content="<?php echo $meta->title ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />

    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $meta->title . ',' . $keywords ?>" />
    <meta property="og:description" content="<?php echo $deskripsi ?>" />
    <meta property="og:url" content="<?php echo base_url(); ?>" />
    <meta property="og:image" content="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>" />
    <meta property="og:site_name" content="<?php echo $meta->title ?>" />
    <meta name="twitter:description" content="<?php echo $deskripsi ?>" />
    <meta name="twitter:title" content="<?php echo $meta->title ?>" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/css/style.css">
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/css/theme.css"> -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/front/vendor/offcanvas/offcanvas.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/front/icon/remixicon/remixicon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/front/icon/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/css/component-chosen.css">
    <link rel="stylesheet" href="<?php echo base_url(''); ?>assets/template/front/vendor/date-time-picker-bootstrap-4/css/bootstrap-datetimepicker.min.css" />
    <!-- Font CSS File -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/front/fonts/open-sans/styles.css">




</head>

<body class="d-flex flex-column min-vh-100">


    <?php
    $id             = $this->session->userdata('id');
    $user           = $this->user_model->user_detail($id);
    $meta           = $this->meta_model->get_meta();
    $menu           = $this->menu_model->get_menu();

    ?>


    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" id="top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url() ?>"><img style="height:60px;width:auto" class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>"></a>
            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav" style="font-size: 18px;">
                    <?php foreach ($menu as $data) : ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url($data->url); ?>"> <?php echo $data->nama_menu_ind; ?> </a></li>
                    <?php endforeach; ?>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <a class="btn btn-success text-white my-auto" href="<?php echo base_url('donasi'); ?>"> Donasi Online</a>
                    <span class="border-left ml-3"></span>
                    <?php if ($this->session->userdata('email')) { ?>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-user"></i> <?php echo $user->user_name; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('myaccount') ?>"> <i class="ri-user-line"></i> Profile</a>
                                <a class="dropdown-item" href="<?php echo base_url('myaccount/update') ?>"> <i class="ri-draft-line"></i> Ubah Profile</a>
                                <a class="dropdown-item" href="<?php echo base_url('myaccount/ubah_password') ?>"> <i class="ri-lock-password-line"></i> Ubah Password</a>
                                <a class="dropdown-item" href="<?php echo base_url('myaccount/transaksi') ?>"> <i class="ri-file-list-3-line"></i> Transaksi</a>

                                <div class="dropdown-divider"></div>
                                <?php if ($user->role_id == 1) : ?>
                                    <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>"> <i class="ri-dashboard-3-line"></i> Panel Admin</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"> <i class="ri-shut-down-line"></i> Logout</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth') ?>"><i class="bi-box-arrow-in-right" style="font-size: 1.5rem;"></i> Login</a></li>

                        <!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth/register') ?>"> Daftar</a></li> -->

                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>





    <div class="breadcrumb">
        <div class="container">
            <ul class="breadcrumb my-3">
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('donasi') ?>"> Donasi</a></li>

                <li class="breadcrumb-item active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>

    <?php
    $donasi_id      = $donasi->id;
    $nominal_donasi = $this->donatur_model->total_nominal_donasi($donasi_id);
    $donatur        = $this->donatur_model->list_donatur($donasi_id);
    $target_donasi  = $donasi->donasi_target;
    $persentase     =  $nominal_donasi * 100 / $target_donasi;


    ?>

    <div class="container mb-3">

        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/donasi/' . $donasi->donasi_image); ?>">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <h2><?php echo $donasi->donasi_title; ?></h2>
                        <div class="progress" style="height:5px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $persentase; ?>%" aria-valuenow="<?php echo $persentase; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="card-text"><small>Terkumpul</small><br> <b>Rp. <?php
                                                                                            echo number_format($nominal_donasi, 0, ",", ".");  ?></b> </p>
                            </div>
                            <div class="col-6 text-right">
                                <small>Donatur</small><br>
                                <b><?php echo count($donatur); ?> Orang</b>
                            </div>
                        </div>
                        <a href="<?php echo base_url('donasi/checkout/' . md5($donasi->id)); ?>" class="btn btn-lg btn-success btn-block my-3">Donasi Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <div class="card my-2">
                    <div class="card-header bg-white">
                        <i class="ri-quill-pen-line"></i> Deskripsi
                    </div>
                    <div class="card-body">
                        <?php echo $donasi->donasi_desc; ?>
                    </div>
                </div>


                <h3 class="my-3"><i class="ri-hand-coin-fill"></i> <?php echo count($donatur); ?> Donatur</h3>

                <?php foreach ($listdonatur as $listdonatur) : ?>
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-1"><img class="img-fluid" src="<?php echo base_url('assets/img/avatars/default.png'); ?>"></div>
                                <div class="col-11">
                                    <b> <?php echo $listdonatur->donatur_name; ?></b><br>
                                    Rp. <?php echo number_format($listdonatur->donasi_nominal, 0, ",", ","); ?>
                                </div>
                                <div class="col-5">
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>



                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>

            </div>

            <div class="col-md-3">
                <?php include "sidebar.php"; ?>
            </div>

        </div>


    </div>



    <?php
    $meta      = $this->meta_model->get_meta();
    $link      = $this->link_model->get_link();
    $page      = $this->page_model->get_page();

    ?>

    <footer class="bg-white mt-auto">
        <div class="bg-success py-md-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-light"><span style="font-size:35px;font-weight:700;">Butuh Bantuan ? Hubungi Kami</span></div>
                    <div class="col-md-4 text-light"><span style="font-size:30px;font-weight:700;"><i class="ri-whatsapp-line"></i> <?php echo $meta->telepon; ?></span></div>
                </div>
            </div>
        </div>
        <div class="container pt-4 pt-md-5 pb-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md-3">
                    <a href="<?php echo base_url(); ?>"><img class="mb-2 img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" alt="" width="250"></a>
                    <span style="font-size:18px;"><br>
                        <i class="ri-phone-line"></i> <?php echo $meta->telepon ?><br>
                        <i class="ri-mail-send-line"></i> <?php echo $meta->email ?>
                    </span>
                </div>
                <div class="col-6 col-md-2">
                    <h5>Halaman</h5>
                    <ul class="list-unstyled text-small">
                        <?php foreach ($page as $page) : ?>
                            <li> <a class="text-muted" href="<?php echo base_url('page/detail/' . $page->page_slug); ?>"><?php echo $page->page_title; ?> </a></li>
                        <?php endforeach; ?>


                    </ul>
                </div>
                <div class="col-6 col-md-2">
                    <h5><?php echo $meta->title; ?></h5>
                    <ul class="list-unstyled text-small">
                        <li> <a class="text-muted" href="<?php echo base_url('contact') ?>">Contact Us</a></li>

                        <li> <a class="text-muted" href="<?php echo base_url('berita') ?>">Berita</a></li>
                        <li> <a class="text-muted" href="<?php echo base_url('donasi') ?>">Donasi</a></li>
                    </ul>
                </div>
                <div class="col-10 col-md footer">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled text-small">
                        <?php foreach ($link as $link) : ?>
                            <li> <a class="text-muted" href="<?php echo $link->link_url; ?>"><?php echo $link->link_name; ?> </a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="credit border-top py-3">
            <div class="container">
                <div class="credit bg-white text-muted py-md-3">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></div>
            </div>
        </div>
    </footer>

    <!-- Load javascript Jquery -->
    <script src="<?php echo base_url() ?>assets/template/front/vendor/jquery/jquery-3.2.1.slim.min.js"></script>

    <script src="<?php echo base_url() ?>assets/template/front/vendor/popper/popper.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/template/front/vendor/offcanvas/offcanvas.js" type="text/javascript"></script>




    <!-- Color Picker JS -->


    <script src="<?php echo base_url() ?>assets/template/front/vendor/date-time-picker-bootstrap-4/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

    <script>
        $(function() {
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);

            $('#id_tanggal').datetimepicker({
                locale: 'id',
                format: 'D MMMM YYYY',
                minDate: minDate
            });
        });
        $("#id_tanggal").keydown(false);
        $('.form-control-chosen').chosen({});
        $('#timepicker').timepicker();
    </script>

    <script>
        $(function() {
            $('#id_tanggal_bayar').datetimepicker({
                locale: 'id',
                format: 'D MMMM YYYY'
            });
        });
    </script>

    <!-- Google Analitycs -->
    <?php echo $meta->google_analytics; ?>
    <!-- End Google Analitycs -->


    <!-- Gambar -->
    <script>
        $('input[type="file"]').each(function() {
            // Refs
            var $file = $(this),
                $label = $file.next('label'),
                $labelText = $label.find('span'),
                labelDefault = $labelText.text();

            // When a new file is selected
            $file.on('change', function(event) {
                var fileName = $file.val().split('\\').pop(),
                    tmppath = URL.createObjectURL(event.target.files[0]);
                //Check successfully selection
                if (fileName) {
                    $label
                        .addClass('file-ok')
                        .css('background-image', 'url(' + tmppath + ')');
                    $labelText.text(fileName);
                } else {
                    $label.removeClass('file-ok');
                    $labelText.text(labelDefault);
                }
            });

            // End loop of file input elements
        });
    </script>


    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


    <script>
        $(document).ready(function() {
            $('.radio-group .radio').click(function() {
                $('.selected .fa').removeClass('fa-check');
                $('.radio').removeClass('selected');
                $(this).addClass('selected');
            });
        });
    </script>

</body>

</html>