<?php if ($message){$this->load->view('admin/message',$this->data); }?>
<div class="x_panel">
    <div class="x_title">
        <h2>Quản lý slide</h2>
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
        <a id="addSlide" class="btn btn-primary">Thêm slide</a><br><br>
        <div id="form_add_slide" style="border: 1px solid #dedede; padding: 20px; margin-bottom: 20px; display: none;">
            <form method="post" action="" enctype="multipart/form-data">
                <div><input type="file"  id="slideUpload" name="slideUpload" accept="image/*"></div>
                <div style="margin: 20px 0px">
                    <img id="pre_img" style="width: 150px" />
                </div>
                <div>
                    <input type="submit" id="btnAddSlide" name="btnAddSlide" required="required" class="btn btn-info" value="Thêm">
                    <a class="btn btn-danger" id="cancelAddSlide">Hủy</a>
                </div>    
            </form>
        </div>
        <table id="" class="table table-striped table-bordered bulk_action">
        <thead>
          <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
          </tr>
        </thead>

        <tbody>
            <?php foreach ($list_slide as $key => $value): ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><img src="<?php echo public_url('images/slide/'.$value);  ?>" width="300px"></td>
                    <td><a onclick="delSlide(<?php echo $key ?>)" class="btn btn-danger">Xóa</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        </table>
    </div>
</div>


<style type="text/css">
    th, td{
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<script src="<?php echo admin_theme()?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    function delSlide(pos){
        var r = confirm("Bạn có chắc chắn muốn xóa slide này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('content/delSlide/')?>" + pos;
        } 
    }

    function readURL(input) {
    if (input.files && input.files[0]) {
            var reader = new FileReader();
                reader.onload = function (e) {
                $('#pre_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        $("#slideUpload").change(function(){
            readURL(this);
        });

        $("#addSlide").click(function () {
            $("#form_add_slide").show();
        });
        $("#cancelAddSlide").click(function () {
            $("#form_add_slide").hide();
        });

    });

</script>