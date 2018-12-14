<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm học viên</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('student/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('student') ?>" class="btn btn-info btn-sm">Danh sách học viên</a>
            <a href="<?php echo admin_url('start') ?>" target="_blank" class="btn btn-info btn-sm">Danh sách giờ
                học</a>
            <a href="<?php echo admin_url('day') ?>" target="_blank" class="btn btn-info btn-sm">Danh sách thứ
                học</a>
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
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên học viên<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="txtName" required placeholder="tên học viên"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">SĐT<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="phone" placeholder="sđt"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Email<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="email" placeholder="email"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Địa chỉ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="address" placeholder="address"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bắt đầu<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="txtFrom" required placeholder="card_start"
                       class="form-control col-md-7 col-xs-12"
                       value="<?php if (isset($_POST['card_start'])) echo $_POST['card_start']; ?>">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Kết thúc<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtTo" name="txtTo" required placeholder="card_end"
                       class="form-control col-md-7 col-xs-12"
                       value="<?php if (isset($_POST['card_end'])) echo $_POST['card_end']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Loại thẻ<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_group form-control" name="card">
                    <?php foreach ($student_card as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Giờ học<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="start">
                    <?php foreach ($start as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->start ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Địa điểm<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="branch_id">
                    <?php foreach ($room_branch as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Thứ học<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_group form-control" name="day">
                    <?php foreach ($day as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->day ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tình trạng <span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="ban">
                    <option value="0" <?php if (isset($_POST['ban']) && $_POST['ban'] == 0) echo 'selected' ?>>Đang
                        học
                    </option>
                    <option value="1" <?php if (isset($_POST['ban']) && $_POST['ban'] == 1) echo 'selected' ?>>Dừng học
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddstudent" required class="btn btn-success"
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
