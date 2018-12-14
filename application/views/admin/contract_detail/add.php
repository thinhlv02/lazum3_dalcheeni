<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm chi tiết hợp đồng </h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
<!--            <a href="--><?php //echo admin_url('contract/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('contract_detail') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>

<div class="x_panel">
    <?php if ($message) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chọn tên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="txtName">
                    <?php
                    $_SESSION['txtName'] = $_POST['txtName'];
                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp_add as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['txtName'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn loại hợp đồng<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="contract">
                    <?php
                    $_SESSION['contract'] = $_POST['contract'];
                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($contract as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['contract'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Từ ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtFrom" name="txtFrom" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">đến ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo" name="txtTo" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                </div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Ngày nâng lương lần 1<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo3" name="txtTo3" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                </div>
            </div>
        </div>

        <div class="form-group">

        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Ngày nâng lương lần 2<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo4" name="txtTo4" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Ký quỹ <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="" name="kyquy"
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['kyquy'])) echo $_POST['kyquy'] ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Ghi chú<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="" name="ghichu"
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['ghichu'])) echo $_POST['ghichu'] ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddcontract" required="required" class="btn btn-success"
                       value="Thêm">
            </div>
        </div>
    </form>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#imageEvent").change(function () {
            readURL(this);
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
    });
</script>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {				    				    
		var editor = CKEDITOR.replace('txtContent', {
			height: '300px',
			filebrowserBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html"; ?>',
			filebrowserImageBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html?Type=Images"; ?>',
			filebrowserFlashBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html?Type=Flash" ?>',
			filebrowserUploadUrl : '<?php echo base_url() . "public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>',
			filebrowserImageUploadUrl : '<?php echo base_url() . "public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"; ?>',
			filebrowserFlashUploadUrl : '<?php echo base_url() . "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"; ?>',
			filebrowserWindowWidth : '800',
			filebrowserWindowHeight : '480'
		});
		CKFinder.setupCKEditor( editor, "<?php echo base_url() . 'public/ckfinder/' ?>" );
	});
</script> -->
