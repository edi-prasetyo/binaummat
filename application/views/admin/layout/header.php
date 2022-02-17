<?php
$meta = $this->meta_model->get_meta();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - <?php echo $meta->title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/template/admin/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/admin/css/custom.css'); ?>" rel="stylesheet">
    <!-- Icon -->
    <link href="<?php echo base_url('assets/template/admin/vendor/icons/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/admin/vendor/icons/feather-icons/feather.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/admin/vendor/autocomplete/jquery-ui.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">


</head>

<body>