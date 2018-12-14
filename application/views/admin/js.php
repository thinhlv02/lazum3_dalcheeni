<!-- jQuery -->
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo admin_theme()?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>


<!-- iCheck -->
<script src="<?php echo admin_theme()?>vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->


<!-- Custom Theme Scripts -->
<script src="<?php echo admin_theme()?>build/js/custom.min.js"></script>

<!-- Flot -->
<!-- datatable -->
<script src="<?php echo admin_theme('');?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<!-- bootstrap-daterangepicker -->
<link href="<?php echo admin_theme()?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<script src="<?php echo admin_theme('');?>/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo admin_theme('');?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#datatable-product").dataTable();

		$('#txtFrom').daterangepicker({
          	singleDatePicker: true,
          	calender_style: "picker_4",
          	locale: {
            	format: 'DD-MM-YYYY'
        	}
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo').daterangepicker({
          	singleDatePicker: true,
          	calender_style: "picker_4",
          	locale: {
            	format: 'DD-MM-YYYY'
        	}
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });

        $("#uploadImg").change(function(){
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

  function confirmDelImage(link){
      if (confirm("Xác nhận xóa hình ảnh?")) {
          $.ajax({
            url : "<?php echo admin_url(); ?>" + "file/delImage/",
            type : "post",
            dataType:"text",
            data : {
                path: link
            },
            success : function (result){
                location.reload();
            }
        });
      }
  }

  function confirmDelFolder(name){
      if (confirm("Xác nhận xóa thư mục '" +name+ "'?")) {
          $.ajax({
            url : "<?php echo admin_url(); ?>" + "file/delFolder/",
            type : "post",
            dataType:"text",
            data : {
                path: link
            },
            success : function (result){

                // location.reload();
            }
        });
      }
  }
</script>