<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin nhân sự</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <a href="<?php echo admin_url('employee/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('employee') ?>" class="btn btn-info btn-sm">Danh sách</a>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtName" name="txtName"
                       value="<?php echo $employee->name ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Sinh nhật<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="birthday" value="<?php echo date('d-m-Y', $employee->birthday) ?>"
                       required class="form-control col-md-7 col-xs-12">

            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">SĐT<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtFrom" name="phone" value="<?php echo $employee->phone ?>"
                       required class="form-control col-md-7 col-xs-12">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CMTND<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <?php $identity = explode('|', $employee->identity_card) ?>
                <input type="text" id="txtName" name="cmtnd"
                       value="<?php echo $identity[0] ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">ngày cấp<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo" name="ngaycap"
                       value="<?php echo date('d-m-Y', $identity[1]) ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">cấp tại<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtName" name="captai"
                       value="<?php echo $identity[2] ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Phòng ban<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="department">
                    <?php foreach ($deparment as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($employee->department_id == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">Giới tính<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="sex">
                    <option value="0" <?php if ($employee->sex == 0) echo 'selected' ?>>Nam</option>
                    <option value="1" <?php if ($employee->sex == 1) echo 'selected' ?>>Nữ</option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chức vụ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtFrom" name="position" value="<?php echo $employee->position ?>" required
                       placeholder="chức vụ"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Email<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtFrom" name="email" value="<?php echo $employee->email ?>" required
                       placeholder="email"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1" for="first-name">Địa chỉ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" id="txtFrom" name="address" value="<?php echo $employee->address ?>" required
                       placeholder="địa chỉ"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Nick<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="displayName" value="<?php echo $employee->displayName ?>" required
                       placeholder="displayName"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">ngày bắt đầu<span
                        class="required">*</span></label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" id="<?php if ($date != '') echo 'txtTo3' ?>" name="ngaybatdau"
                       value="<?php if ($date != '') echo date('d-m-Y', $date); else echo 'Chưa có thông tin' ?>"
                       required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">hợp đồng<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="select2_group form-control" name="contract">
<!--                    --><?php
//                    $_SESSION['contract'] = $_POST['contract'];
//                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($contract as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($contract_id == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateemployee" required
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

