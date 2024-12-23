<script src="<?= base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/fontawesome/js/all.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/js-cookie/js.cookie.js"></script>
<script src="<?= base_url(); ?>assets/js/theme/default.min.js"></script>
<script src="<?= base_url(); ?>assets/js/apps.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>assets/plugins/highlight/highlight.common.js"></script>

<script src="<?= base_url(); ?>assets/js/demo/table-manage-default.demo.min.js"></script>
<script src="<?= base_url(); ?>assets/js/demo/render.highlight.js"></script>
<script src="<?= base_url(); ?>assets/js/sweetalert.min.js">
</script>
<!-- Datatable Js -->
<script src="<?= base_url(); ?>assets/js/select2.min.js"></script>



<!-- <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script>

<script src="<?= base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-multiselect.css">



<!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/dataTables.buttons.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/jszip.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/pdfmake.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/vfs_fonts.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" type="text/javascript"></script> -->
<script src="<?= base_url(); ?>assets/js/buttons.html5.min.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" type="text/javascript"></script>  -->
<script src="<?= base_url(); ?>assets/js/buttons.print.min.js"></script>

<!-- <script src="<?= base_url(); ?>assets/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
-->
<!-- <script src="<?= base_url(); ?>assets/js/jquery.multiselect.js"></script> -->

<script src="<?= base_url(); ?>assets/js/moment.min.js"></script>

<script type="text/javascript">
    var admin_permission = <?php echo json_encode($admin_permission) ?>;
    $.fn.dataTable.render.moment = function(from, to, locale) {
        if (arguments.length === 1) {
            locale = 'en';
            to = from;
            from = 'YYYY-MM-DD';
        } else if (arguments.length === 2) {
            locale = 'en';
        }
        return function(d, type, row) {
            if (!d) {
                return type === 'sort' || type === 'type' ? 0 : d;
            }
            var m = window.moment(d, from, locale, true);
            return m.format(type === 'sort' || type === 'type' ? 'x' : to);
        };
    };

    function loader() {
        $(document)
            .ajaxStart(function() {
                $("#overlay").fadeIn(300);
            })
            .ajaxStop(function() {
                setTimeout(function() {
                    $("#overlay").fadeOut(300);
                }, 300);
            });
    }
    // $(document).ready(function() {
    //     var admin_permission = <?php echo json_encode($admin_permission) ?>;
    // });
</script>
</body>

</html>