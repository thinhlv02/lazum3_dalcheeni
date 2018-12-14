<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm chi tiết cho các phòng học mới</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="<?php echo admin_url('schedule_week/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('schedule_week/detail_week/' . $this->uri->segment(4)) ?>"
               class="btn btn-info btn-sm">Danh sách</a>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Chọn giáo viên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="emp">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Chọn Thu ngân(TN)<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="emp2">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp2 as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Giờ bắt đầu<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="start" required placeholder="ví dụ: 12:30"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Level lớp<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="level_room"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddschedule_week" required
                       class="btn btn-success"
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
