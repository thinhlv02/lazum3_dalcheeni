<ol class="breadcrumb" style="background-color: transparent;">
  <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
  <li><a href="<?php echo base_url('su-kien')?>">Hướng dẫn</a></li>
  <li class="active"><?php echo $guide->name ?></li>
</ol>
<div class="wrapper-item-game margin-top">
        <?php $this->load->view('site/home/list_game');?>
    </div>
<div class="panel panel-default margin-top">
    <div class="panel-heading">
        <h1 class="panel-title" style="font-size: 25px">Hướng dẫn</h1>
    </div>
    <div class="panel-body">
    	<a href="#" class="btn btn-primary playGame">Chơi game</a>
        <h2 style="font-size: 20px; color: red"><?php echo $guide->name ?></h2>
        <span style="font-style: italic; color: #666;">Ngày đăng: <?php echo date('d/m/Y',$guide->created) ?></span>
        <div style="margin-top: 10px"><?php echo $guide->content ?></div>
    </div>
</div>