<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách Phát sinh gần đây</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <?php if ($menu_access[14] == 2) { ?>
                <a href="<?php echo admin_url('congphatsinh/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <?php } ?>
            <!--            <a href="-->
            <?php //echo admin_url('congphatsinh') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        </div>
    </div>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên nv<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="name">
                    <?php
                    $_SESSION['name'] = $_POST['name'];
                    ?>
                    <?php foreach ($emp as $value): ?>
                        <option value="<?php echo $value->id ?>"<?php if ($_SESSION['name'] == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">Bắt đầu<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input type="text" id="txtFrom" name="txtFrom" required
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">kết thúc<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="txtTo" name="txtTo" required
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddcongphatsinh" class="btn btn-success"
                       value="Search">
            </div>
        </div>
    </form>
</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách (<?php echo count($res) ?>)</h2>
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
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Sự kiện</th>
                <th>Tiền</th>
                <th>Ghi chú</th>
                <th>Thời gian</th>
                <th>Loại</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0 ?>
            <?php foreach ($res as $key => $value): ?>
                <?php $i++; ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php
                        if (isset($this->employee_model->get_info($value->name)->name)) {
                            echo $this->employee_model->get_info($value->name)->name;
                        } else echo 'tk bị xóa';
                        ?></td>
                    <td><?php echo $value->event ?></td>
                    <td><?php echo number_format($value->money) ?></td>
                    <td><?php echo $value->note ?></td>
                    <td><?php echo date('d-m-Y', $value->date) ?></td>
                    <td><?php if ($value->type == 0) {
                            echo 'Tiền Phát sinh';
                        } else {
                            echo '<span style="color: red;">Tiền phạt</span>';
                        } ?></td>

                    <?php if ($menu_access[14] == 2) { ?>
                        <td><a href="<?php echo admin_url('congphatsinh/edit/') . $value->id ?>"
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
        var r = confirm("Bạn có chắc chắn muốn xóa này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('congphatsinh/del/')?>" + id;
        }
    }
</script>