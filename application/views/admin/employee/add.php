<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm nhân sự mới</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('employee') ?>" class="btn btn-info btn-sm">Danh sách</a>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Họ và tên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtName" name="txtName" value="" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <span style="float: left;margin-top: 7px">Sinh ngày</span>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
<!--                <div class="col-md-6 col-sm-6 col-xs-12">-->
                    <input type="text" id="txtFrom" name="birthday" required
                           class="form-control col-md-7 col-xs-12">
<!--                </div>-->
            </div>
            <span style="float: left;margin-top: 7px">Giới tính</span>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="sex">
                    <option value="0" <?php if (isset($_POST['sex']) && $_POST['sex'] == 0) echo 'selected' ?>>Nam
                    </option>
                    <option value="1" <?php if (isset($_POST['sex']) && $_POST['sex'] == 1) echo 'selected' ?>>Nữ
                    </option>
                </select>
            </div>

        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">CMND<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtFrom" name="cmtnd" required placeholder="Số cmtnd"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <span style="float: left;margin-top: 7px">Ngày cấp&nbsp;</span>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo" name="ngaycap" required class="form-control col-md-7 col-xs-12">
            </div>
            <span style="float: left;margin-top: 7px">Cấp tại&nbsp;&nbsp;</span>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtFrom" name="captai" required
                       class="form-control col-md-7 col-xs-12">
            </div>
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--                <input type="text" id="txtName" name="PROCESS_CODE" value="" required-->
            <!--                       class="form-control col-md-7 col-xs-12">-->
            <!--            </div>-->
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Chức vụ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="position" required placeholder="chức vụ"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <span style="float: left;margin-top: 7px">Địa chỉ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" id="txtFrom" name="address" required placeholder="địa chỉ"
                       class="form-control col-md-6 col-xs-11">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Phòng ban<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="department">
                    <?php foreach ($deparment as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <span style="float: left;margin-top: 7px">SĐT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="phone" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <span style="float: left;margin-top: 7px">Email</span>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text"  name="email" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Nick<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="displayName" required
                       placeholder="displayName"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddemployee" required="required" class="btn btn-success"
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
