<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Phiếu lương cá nhân <span
                    style="font-weight: bold;text-transform: uppercase;color: red;">bộ phận kinh doanh</span></h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('employee') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Chọn tên hlv, dv<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="employee">
                    <?php
                    $_SESSION['employee'] = $_POST['employee'];
                    ?>
                    <!--                    <option value="">All</option>-->
                    <?php foreach ($emp as $value): ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['employee'] == $value->id) echo 'selected' ?>>
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
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>">
                </div>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-2" for="first-name">kết thúc<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="txtTo" name="txtTo" required
                           class="form-control col-md-7 col-xs-12"
                           value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddEvent" class="btn btn-success"
                       value="Search">
            </div>
        </div>
    </form>


</div>
<div class="x_panel">
    <div class="x_title">
        <h2>Danh sách</h2>
        <?php if (isset($res) && count($res) > 0) { ?>
            <form method="post">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                    <input type="submit" name="btnExportData" class="btn btn-success"
                           value="Xuất Excel">
                </div>
            </form>
        <?php } ?>

        <!--        <h2>--><?php //echo admin_url('phieuluong/excel') ?><!--</h2>-->
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
    <?php $total = $total_cps = 0 ?>
    <div class="x_content">
        <!--        <a href="-->
        <?php //echo admin_url('phieuluong/excel') ?><!--" class="btn btn-success btn-lg">Export excel</a>-->
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Địa điểm</th>
                <th>Số NC</th>
                <th>Lương</th>
                <th>Tổng lương</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0; ?>
            <?php if (isset($res) && count($res) > 0) { ?>
            <?php foreach ($res as $key => $value): ?>
                <?php $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->name ?></td>
                    <td><?php echo $value->nc ?></td>
                    <td><?php echo number_format($value->luong) ?></td>
                    <td><?php echo number_format($value->money) ?></td>
                </tr>
                <?php
                $total += $value->money;
                ?>
            <?php endforeach ?>
            </tbody>
            <tfoot>
            <tr style="background-color: wheat">
                <td colspan="4" style="text-align: center">Tổng lương:</td>
                <td><?php echo number_format($total) ?></td>
            </tr>
            </tfoot>
            <?php } ?>
        </table>
    </div>

    <!--    công phát sinh-->

    <h1>Tổng lương: <span class="maudo"><?php echo number_format($total) ?></span> (vnđ) </h1>
    <!--    công phát sinh-->
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

    .maudo {
        color: red;
    }
</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa nhân sự này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('employee/del/')?>" + id;
        }
    }
</script>