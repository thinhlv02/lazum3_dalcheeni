<ol class="breadcrumb" style="border-bottom: 1px solid #E6E9ED;">
	<li class="breadcrumb-item">
	    <i class="fa fa-folder" aria-hidden="true"></i>
	    <a href="<?php echo admin_url('file') ?>">Upload</a>	
	</li>
   <li class="breadcrumb-item active"></li>
</ol>

<div style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px" >
	<a onclick="showFormAdd()" style="cursor: pointer;"><i class="fa fa-plus-square" aria-hidden="true"></i> Thêm thư mục</a>
	<a onclick="showFormUpload()" style="cursor: pointer; margin-left: 20px"><i class="fa fa-upload" aria-hidden="true"> Upload ảnh</i></a>
</div>
<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="add-folder" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px; display: none;">
	<form method="post">
		<label>Tên thư mục</label>
		<input type="text" name="txtFolderName" required>
		<input type="submit" name="btnAddFolder" value="Thêm" class="btn btn-sm btn-primary">
		<a onclick="hideFormAdd()" style="cursor: pointer;" class="btn btn-sm btn-info">Hủy</a>
	</form>
</div>

<div class="upload-image" style="border-bottom: 1px solid #ccc; padding-bottom: 10px; margin-bottom: 20px; display: none;">
	<form method="post" enctype="multipart/form-data">
		<input type="file" id="uploadImg" name="uploadImg" value="" required="required" style="padding: 5px;" accept="image/*">
        <div style="width: 100%;float: left;"><img id="pre_img" style="width: 150px; float: left;" /><br></div>
        <div>
        	<input type="submit" name="btnUpload" class="btn btn-sm btn-primary" style="float: left;margin-top: 10px" value="Upload">
			<a onclick="hideFormUpload()" style="cursor: pointer;float: left;margin-top: 10px;" class="btn btn-sm btn-info">Hủy</a>
        </div>
        
	</form>
</div>