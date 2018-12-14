<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa HLV dạy</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('hlv/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--            <a href="-->
            <?php //echo admin_url('hlv') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
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
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">HLV<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="teach">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($teach->employee_id == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Thu ngân<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="thungan">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp2 as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($teach->thungan == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Giờ bắt đầu<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="start" value="<?php echo $teach->start ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

<!--            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Level lớp<span-->
<!--                        class="required">*</span></label>-->
<!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
<!--                <input type="text" name="level_room" value="--><?php //echo $teach->level_room ?><!--" required-->
<!--                       class="form-control col-md-7 col-xs-12">-->
<!--            </div>-->

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">SL Học viên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="hv" value="<?php echo $teach->hv ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">TT<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="TT" value="<?php echo $teach->TT ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">LDD<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="LDD" value="<?php echo $teach->LDD ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">TN<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="TN" value="<?php echo $teach->TN ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">T6<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="T6" value="<?php echo $teach->T6 ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">T12<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="T12" value="<?php echo $teach->T12 ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">W<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="W" value="<?php echo $teach->W ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">K<span
                        class="required">*</span></label>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input type="text" name="K" value="<?php echo $teach->K ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateschedule_week" required
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

