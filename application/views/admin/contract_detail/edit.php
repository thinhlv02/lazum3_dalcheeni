<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin chi tiêt hợp đồng</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <a href="<?php echo admin_url('contract_detail/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <a href="<?php echo admin_url('contract_detail') ?>" class="btn btn-info btn-sm">Danh sách</a>
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
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Chọn loại hợp đồng<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="contract">
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($contract as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($contract2->contract_id == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Từ ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtFrom" name="txtFrom" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo date('d-m-Y', $contract2->start_contract_date) ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">đến ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo" name="txtTo" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo date('d-m-Y', $contract2->end_contract_date) ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Ngày nâng lương lần 1<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo3" name="txtTo3" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo date('d-m-Y', $contract2->nll1) ?>">
                </div>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Ngày nâng lương lần 2<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtTo4" name="txtTo4" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo date('d-m-Y', $contract2->nll2) ?>">
                </div>
            </div>
        </div>

        <div class="form-group">

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Ký quỹ <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="" name="kyquy" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo $contract2->kyquy ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Ghi chú<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="" name="ghichu" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php echo $contract2->ghichu ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdatecontract" required
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