<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Data List</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('search/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('search') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Từ ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">

                <input type="text" id="txtFrom" name="txtFrom" required="required"
                       value="<?php if (isset($_POST['txtFrom'])) echo $_POST['txtFrom'] ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Đến ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo" name="txtTo" required
                       value="<?php if (isset($_POST['txtTo'])) echo $_POST['txtTo'] ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Choose Table_Log:<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="Table_Log">
                    <option value="MO_LOG" <?php if (isset($_POST['Table_Log']) && $_POST['Table_Log'] === 'MO_LOG') echo 'selected'; ?>>
                        MO_LOG
                    </option>
                    <option value="CDR_LOG" <?php if (isset($_POST['Table_Log']) && $_POST['Table_Log'] === 'CDR_LOG') echo 'selected'; ?>>
                        CDR_LOG
                    </option>
                    <option value="MT_LOG" <?php if (isset($_POST['Table_Log']) && $_POST['Table_Log'] === 'MT_LOG') echo 'selected'; ?>>
                        MT_LOG
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Telco<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="Telco">
                    <?php
                    $_SESSION['Telco'] = $_POST['Telco'];
                    ?>
                    <option value="">All</option>
                    <?php foreach ($telco as $value): ?>
                        <option value="<?php echo $value->MOBILE_OPERATOR ?>" <?php if ($_SESSION['Telco'] == $value->MOBILE_OPERATOR) echo 'selected' ?>><?php echo $value->MOBILE_OPERATOR ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Servicenumber<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">

                <select class="select2_group form-control" name="SERVICE_NUMBER_NAME">
                    <?php
                    $_SESSION['SERVICE_NUMBER_NAME'] = $_POST['SERVICE_NUMBER_NAME'];
                    ?>
                    <option value="">All</option>
                    <?php foreach ($sv as $value): ?>
                        <option value="<?php echo $value->SERVICE_NUMBER_NAME ?>"<?php if ($_SESSION['SERVICE_NUMBER_NAME'] == $value->SERVICE_NUMBER_NAME) echo 'selected' ?>><?php echo $value->SERVICE_NUMBER_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Command Code<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="COMMAND_CODE_NAME">
                    <?php
                    $_SESSION['COMMAND_CODE_NAME'] = $_POST['COMMAND_CODE_NAME'];
                    ?>
                    <option value="">All</option>
                    <?php foreach ($cmd as $value): ?>
                        <option value="<?php echo $value->COMMAND_CODE_NAME ?>" <?php if ($_SESSION['COMMAND_CODE_NAME'] == $value->COMMAND_CODE_NAME) echo 'selected' ?>><?php echo $value->COMMAND_CODE_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Choose SUB_CP :<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="sub">
                    <?php
                    $_SESSION['sub'] = $_POST['sub'];
                    ?>
                    <option value="99">All</option>
                    <?php foreach ($sub as $value): ?>
                        <option value="<?php echo $value->SUB_CP_USERNAME ?>" <?php if ($_SESSION['sub'] == $value->SUB_CP_USERNAME) echo 'selected' ?>><?php echo $value->SUB_CP_USERNAME ?></option>
                    <?php endforeach; ?>
                </select>
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
                <th>Telco</th>
                <th>Command Code</th>
                <th>Service Number</th>
                <th>Sub_cp</th>
                <th>Total</th>
            </tr>
            </thead>
            <?php if (isset($res) && count($res) > 0) { ?>
                <tbody>
                <?php $total = '' ?>

                <?php foreach ($res as $key => $value): ?>
                    <tr>
                        <td><?php echo $value->TELCO ?></td>
                        <td><?php echo $value->COMMAND_CODE ?></td>
                        <td><?php echo $value->SERVICE_NUMBER ?></td>
                        <td><?php echo $value->SUB_CP_USERNAME ?></td>
                        <td><?php echo $value->TOTAL ?></td>
                    </tr>
                    <?php $total += $value->TOTAL ?>
                <?php endforeach ?>

                </tbody>
                <tfoot>
                <tr style="background: wheat">
                    <td colspan="4">Total:</td>
                    <td><?php echo number_format($total) ?></td>
                </tr>
                </tfoot>
            <?php } ?>

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
        var r = confirm("Bạn có chắc chắn muốn xóa search này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('event/del/')?>" + id;
        }
    }
</script>
