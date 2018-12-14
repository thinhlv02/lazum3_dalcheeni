<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin huấn luyện viên, diễn viên</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <a href="<?php echo admin_url('hlv/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('hlv') ?>" class="btn btn-info btn-sm">Danh sách</a>
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
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtName" name="txtName"
                       value="<?php echo $hlv->name ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Sinh nhật<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="birthday" value="<?php echo date('d-m-Y', $hlv->birthday) ?>"
                       required class="form-control col-md-7 col-xs-12">

            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">SĐT<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="phone" value="<?php echo $hlv->phone ?>"
                       required class="form-control col-md-7 col-xs-12">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">CMTND<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <?php $identity = explode('|', $hlv->identity_card) ?>
                <input type="text" id="txtName" name="cmtnd"
                       value="<?php echo $identity[0] ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">cmt ngày cấp<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo" name="ngaycap"
                       value="<?php echo date('d-m-Y', $identity[1]) ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">cmt cấp tại<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtName" name="captai"
                       value="<?php echo $identity[2] ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Địa chỉ<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-5 col-sm-5 col-xs-12">
                <input type="text" id="txtFrom" name="address" value="<?php echo $hlv->address ?>" required
                       placeholder="địa chỉ"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Level<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="level">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($level as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($hlv->level == $value->id) echo 'selected' ?>>
                            <?php echo $value->level_name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdatehlv" required
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

