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