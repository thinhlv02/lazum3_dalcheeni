<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách level</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <?php if ($menu_access[13] == 2) { ?>
                <a href="<?php echo admin_url('level/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <?php } ?>
            <!--            <a href="-->
            <?php //echo admin_url('level') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        </div>
    </div>
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
                <th>Level name</th>
                <th>Lương</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0 ?>
            <?php foreach ($res as $key => $value): ?>
                <?php $i++ ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->level_name ?></td>
                    <td><?php echo number_format($value->luong) ?></td>

                    <?php if ($menu_access[13] == 2) { ?>
                        <td><a href="<?php echo admin_url('level/edit/') . $value->id ?>"
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
        var r = confirm("Bạn có chắc chắn muốn xóa level này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('level/del/')?>" + id;
        }
    }
</script>
