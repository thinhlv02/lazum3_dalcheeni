<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left">
        <h3>User : <span
                    style="color: red"><?php echo $this->employee_model->get_info($menu_access_id)->name ?></span>
        </h3>
        <?php
        //        $where = array();
        //        $where[$this->key] = $menu_access;
        ?>
        <h4>Login : <span
                    style="color: green"><?php echo $this->admin_model->get_info_rule(array('employee_id' => $menu_access_id))->UserName ?></span>
        </h4>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('admin') ?>" class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>

<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">

        <div class="x_title">
            <h2>Danh sách quyền</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a></li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <!--            <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
            <table class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <!--                    <th>ID</th>-->
                    <th>Stt</th>
                    <th>Chức năng</th>
                    <th class="center">Quyền xem</th>
                    <th class="center">Quyền thêm, sửa , xóa</th>
                </tr>
                </thead>

                <tbody>
                <?php $i = 0 ?>
                <?php foreach ($menu_access as $key => $value): ?>
                    <?php
                    $i++;
//                $department = $this->department_model->get_info($value->department_id);
//                pre($department);
                    $menu = $this->menu_model->get_info($value->menu_id)
                    ?>
                    <tr>
                        <!--                        <td>--><?php //echo $value->id ?><!--</td>-->
                        <td><?php echo $i ?></td>
                        <td><?php echo $menu->name ?></td>
                        <td class="center"><input type="checkbox" name="access1[]"
                                   value="<?php echo $value->id ?>" <?php if ($value->access == 1) echo 'checked' ?>>
                        </td>
                        <td class="center"><input type="checkbox" name="access2[]"
                                   value="<?php echo $value->id ?>" <?php if ($value->access == 2) echo 'checked' ?>>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
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

<style>
    input[type=checkbox] {
        margin: 0px 0 0;
        zoom: 1.5;
    }

    .center {
        text-align: center;
    }
</style>