<script language="javascript" src="<?php echo base_url('public')?>/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="x_panel">
    <div class="x_title">
        <h2>Quản lý nội dung website</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post">
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Hotline <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="txtHotline" name="txtHotline" value="<?php echo $content->hotline ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Email hỗ trợ <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $content->email ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Footer <span class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea name="txtFooter" class="form-control" style="height: 120px"><?php echo $content->footer ?></textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtFooter'); </script>
              </div>
            </div>
		    <div class="form-group">
	        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Link iOS <span class="required">*</span></label>
	        	<div class="col-md-8 col-sm-8 col-xs-12">
	          		<input type="text" id="txtIOS" name="txtIOS" value="<?php echo $content->linkiOS ?>" required="required" class="form-control col-md-7 col-xs-12">
	        	</div>
	      	</div>
	        <div class="form-group">
	        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Link Android <span class="required">*</span></label>
	        	<div class="col-md-8 col-sm-8 col-xs-12">
	          		<input type="text" id="txtAndroid" name="txtAndroid" value="<?php echo $content->linkAndroid ?>" required="required" class="form-control col-md-7 col-xs-12">
	        	</div>
	      	</div>
	      	<div class="form-group">
	        	<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
	          		<input type="submit" id="btnUpdateLink" name="btnUpdateLink" required="required" class="btn btn-success" value="Cập nhật">
	        	</div>
	      	</div>
		</form>
    </div>
</div>

