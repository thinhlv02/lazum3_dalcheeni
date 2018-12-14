<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin học viên</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <a href="<?php echo admin_url('student/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('student') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtName" name="txtName"
                       value="<?php echo $student->name ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">SĐT<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="phone" required placeholder="sđt" value="<?php echo $student->phone ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Email<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="email" placeholder="email" value="<?php echo $student->email ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Địa chỉ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="address" required placeholder="address" value="<?php echo $student->address ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bắt đầu<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="txtFrom" required placeholder="card_start"
                       class="form-control col-md-7 col-xs-12"
                       value="<?php echo date('d-m-Y', $student->card_start) ?>">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Kết thúc<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtTo" name="txtTo" required placeholder="card_end"
                       class="form-control col-md-7 col-xs-12" value="<?php echo date('d-m-Y', $student->card_end) ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Loại thẻ<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_group form-control" name="card">
                    <?php foreach ($student_card as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($student->card_id == $value->id) echo 'selected' ?>>
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
                        <option value="<?php echo $value->id ?>" <?php if ($student->start == $value->id) echo 'selected' ?>>
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
                        <option value="<?php echo $value->id ?>" <?php if ($student->branch_id == $value->id) echo 'selected' ?>>
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
                        <option value="<?php echo $value->id ?>" <?php if ($student->day == $value->id) echo 'selected' ?>>
                            <?php echo $value->day ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tình trạng <span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="ban">
                    <option value="0" <?php if ($student->ban == 0) echo 'selected' ?>>Đang
                        học
                    </option>
                    <option value="1" <?php if ($student->ban == 1) echo 'selected' ?>>Dừng học
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdatestudent" required
                       class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=changeImg]').change(function () {
            if (this.value == 1) {
                $("#imgChange").html('<input type="file" id="imageEvent" name="imageEvent" value="" required="required" style="padding: 5px;" accept="image/*">');
                $('#pre_img').show();
                $("#img_event").hide();
            }
            else if (this.value == 2) {
                $("#img_event").show();
                $("#imgChange").html('');
                $('#pre_img').hide();
            }
            $("#imageEvent").change(function () {
                readURL(this);
            });
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
</script>

