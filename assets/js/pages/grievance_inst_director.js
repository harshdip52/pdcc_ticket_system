window.onload = function () {
    $(document).ready(function () {
        $('#table_pagination').DataTable();
    });
    $('#searchdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
    });
}
$(document).ready(function () {

    $('.allGrievance').on('click', '.getDetails', function (e) {

        e.preventDefault();
        //var baseUrl = '<?php echo base_url();?>';
        const $root = $(this);
        var griReqId = $root.data('grireqid');
        var firstname = $root.data('firstname');
        var middlename = $root.data('middlename');
        var lastname = $root.data('lastname');
        var institutename = $root.data('institutename');
        var salutation = $root.data('salutation');
        var type = $root.data('type');
        var subject = $root.data('subject');
        var status = $root.data('status');
        var issue = $root.data('issue');
        var image = $root.data('image');
        var statusname = $root.data('statusname')

        $('#detail-modal-content').html('');
        $('#detailViewModal').modal({
            show: true
        });
        const $loader = $('#detailViewModal .ajax-loader');
        $loader.show();

        $.post("getGrievanceDetailsForInstitute/", {
            griReqId: griReqId,
            firstname:firstname,
        middlename:middlename,
        lastname:lastname,
        institutename:institutename,
        salutation:salutation,
            type: type,
            subject: subject,
            status: status,
            issue: issue,
            image: image,
            statusname: statusname
        }, function (data) {
            $loader.hide();

            $('#detail-modal-content').html(data);
        });

    });

    
});//main