<div class="container wrapper-content">
    <div class="row">
        <div class="beforeLoadgame">
            <div class="col-md-8 col-sm-12 col-xs-12 margin-top">
                <?php $this->load->view($temp);?>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                
            </div>
        </div>
        <div id="wrapper-game" style="width: 1140px; height: 555px;">
            <iframe id='gameScreen' frameborder="0" scrolling="no" style="height: 0px"></iframe>
        </div>
    </div>
</div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=282420135513035";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script>
    //var gameScreen = $("#gameScreen");
    var container = $(".container");
    var elHeight = 1140;
    var elWidth = 555;
    $(window).resize(function () {
        doResize();
    });
    function doResize() {
        //
        var width = container.outerWidth() - 30;
        var scale = width/1140;
        var height = 555*scale;
        $("#wrapper-game").css({
            'width':width,
            'height': height
        });
    }
    doResize();
</script>