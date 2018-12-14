<!-- jQuery -->
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo admin_theme() ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo admin_theme() ?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo admin_theme() ?>vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo admin_theme() ?>vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="<?php echo admin_theme() ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo admin_theme() ?>build/js/custom.min.js"></script>

<!-- Datatables -->
<script>
    $(document).ready(function () {
        var handleDataTableButtons = function () {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    dom: "Bfrtip",
                    "iDisplayLength": 7,
                    buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: false, targets: [0]}
            ]
        });
        $datatable.on('draw.dt', function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->

<!--//add-->

<!-- bootstrap-daterangepicker -->
<link href="<?php echo admin_theme() ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<script src="<?php echo admin_theme(''); ?>/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo admin_theme(''); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#datatable-product").dataTable();

        $('#txtFrom').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

//        thinhlv thêm
        $('#txtTo3').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo4').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD-MM-YYYY'
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
//        /thinhlv thêm

        $("#uploadImg").change(function () {
            readURL(this);
        });

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pre_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function showFormAdd() {
        $(".add-folder").show();
    }

    function hideFormAdd() {
        $(".add-folder").hide();
    }

    function showFormUpload() {
        $(".upload-image").show();
    }

    function hideFormUpload() {
        $(".upload-image").hide();
    }

    function confirmDelImage(link) {
        if (confirm("Xác nhận xóa hình ảnh?")) {
            $.ajax({
                url: "<?php echo admin_url(); ?>" + "file/delImage/",
                type: "post",
                dataType: "text",
                data: {
                    path: link
                },
                success: function (result) {
                    location.reload();
                }
            });
        }
    }

    function confirmDelFolder(name) {
        if (confirm("Xác nhận xóa thư mục '" + name + "'?")) {
            $.ajax({
                url: "<?php echo admin_url(); ?>" + "file/delFolder/",
                type: "post",
                dataType: "text",
                data: {
                    path: link
                },
                success: function (result) {

                    // location.reload();
                }
            });
        }
    }
</script>