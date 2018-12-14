<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách huấn luyện viên, diễn viên</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <?php if ($menu_access[2] == 2) { ?>
                <a href="<?php echo admin_url('hlv/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <?php } ?>
            <!--            <a href="-->
            <?php //echo admin_url('hlv') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        </div>
    </div>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Tìm kiếm<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="ban">
                    <option value="0" <?php if (isset($_POST['ban']) && $_POST['ban'] == 0) echo 'selected' ?>>Tất cả
                    </option>
                    <option value="1" <?php if (isset($_POST['ban']) && $_POST['ban'] == 1) echo 'selected' ?>>Danh sách
                        nhân sự cũ
                    </option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tìm theo tên<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="employee_hlv">
                    <option value="all">Tất cả</option>
                    <?php
                    $_SESSION['employee_hlv'] = $_POST['employee_hlv'];
                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($employee_hlv as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['employee_hlv'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnSearch" required="required" class="btn btn-success"
                       value="Search ">
            </div>
        </div>
    </form>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách ( <?php if (isset($res) && count($res) > 0) echo count($res) . ' hlv, dv' ?>)</h2>
        <?php if (isset($res) && count($res) > 0) { ?>
            <form method="post">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                    <input type="submit" name="btnExportData" class="btn btn-success"
                           value="Export excel">
                </div>
            </form>
        <?php } ?>
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
        <!--        <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
        <table id="" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Nick</th>
<!--                <th>Ngày bắt đầu</th>-->
                <th>màu nền</th>
                <th>màu chữ</th>
                <th>Sinh ngày</th>
                <th>Giới tính</th>
                <th>CMTND số</th>
                <th>CMTND Ngày cấp</th>
                <th>CMTND cấp tại</th>
                <th>SĐT</th>
                <th>Level</th>
                <th>Đ/c</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0 ?>
            <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                <?php
                $i++;
                $date = '';
                $start_date_contract = $this->contract_detail_model->contract_start($value->id);
//                pre($start_date_contract[0]->start_contract_date);
                if ($start_date_contract) {
                    $date = $start_date_contract[0]->start_contract_date;
                }
//                pre($department);
                ?>
                <tr id="<?php echo $value->id; ?>"
                    class="<?php if (isset($_GET['employee_id']) && $_GET['employee_id'] == $value->id) echo 'thinhlv_selected'; ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo $value->displayName ?></td>
<!--                    <td>--><?php //if ($date != '') echo date('d-m-Y', $date); ?><!--</td>-->
                    <td><input disabled type="color" value="<?php echo $value->color ?>"/></td>
                    <td><input disabled type="color" value="<?php echo $value->color_text ?>"/></td>
                    <td><?php echo date('d/m/Y', $value->birthday) ?></td>
                    <td><?php if ($value->sex == 0) {
                            echo 'Nam';
                        } else {
                            echo 'Nữ';
                        } ?></td>
                    <?php $identity = explode('|', $value->identity_card) ?>
                    <td><?php echo $identity[0] ?></td>
                    <td><?php echo date('d-m-y', $identity[1]) ?></td>
                    <td><?php echo $identity[2] ?></td>
                    <td><?php echo $value->phone ?></td>
                    <td><?php echo $value->level ?></td>
                    <td><?php echo $value->address ?></td>
                    <td><?php echo $value->email ?></td>

                    <?php if ($menu_access[1] == 2 && $ban == 0) { ?>
                        <td><a href="<?php echo admin_url('hlv/edit/') . $value->id ?>"
                               class="btn btn-info btn-xs">Sửa</a>
                            <a onclick="confirm_del_event(<?php echo $value->id ?>)"
                               class="btn btn-danger btn-xs">Xóa</a>
                        </td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa huấn luyện viên, diễn viên này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('hlv/del/')?>" + id;
        }
    }
</script>