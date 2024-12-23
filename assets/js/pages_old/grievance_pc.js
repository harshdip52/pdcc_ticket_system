window.onload=function(){
    $(document).ready(function () {
      $('#table_pagination').DataTable();
    });
    $('#searchdate').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: 'true',
    });
}
$(document).ready(function () {

    // $('#grievance_solution_pc').on('click', '#DoSubmit', function (e) {
    //     alert("pc cell");
    // });

    $('.allGrievance').on('click', '.getDetails', function (e) {

        e.preventDefault();
        //var baseUrl = '<?php echo base_url();?>';
        const $root = $(this);
        var griReqId = $root.data('grireqid');
        var type = $root.data('type');
        var firstname = $root.data('firstname');
        var middlename = $root.data('middlename');
        var lastname = $root.data('lastname');
        var salutation = $root.data('salutation');

        var subject = $root.data('subject');
        var status = $root.data('status');
        var issue = $root.data('issue');
        var image = $root.data('image');
        var statusname = $root.data('statusname');
        var institute = $root.data('institute');
       

        $('#detail-modal-content').html('');
        $('#detailViewModal').modal({
            show: true
        });
        const $loader = $('#detailViewModal .ajax-loader');
        $loader.show();

        $.post("getGrievanceDetailsForPC/", {
            griReqId: griReqId,
            type: type,
            firstname:firstname,
            middlename:middlename,
            lastname:lastname,
            
            salutation:salutation,
            subject: subject,
            status: status,
            issue: issue,
            image: image,
            statusname: statusname,
            institute:institute,
            
        }, function (data) {
            $loader.hide();

            $('#detail-modal-content').html(data);
        });

    });

    
});//main