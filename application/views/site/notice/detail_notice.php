<ol class="breadcrumb" style="background-color: transparent;">
  <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
  <li><a href="<?php echo base_url('thong-bao')?>">Thông báo</a></li>
  <li class="active"><?php echo $notice->name ?></li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Thông báo</h1>
    </div>
    <div class="panel-body">
        <h2 style="font-size: 20px; color: red"><?php echo $notice->name ?></h2>
        <span style="font-style: italic; color: #666;">Ngày đăng: <?php echo date('d/m/Y',$notice->created) ?></span>
        <div style="margin-top: 10px"><?php echo $notice->content ?></div>
    </div>
</div>