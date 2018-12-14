<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('site/head'); ?>
</head>
<body id="wrapper-body">
<?php $this->load->view('site/header'); ?>
<div class="container wrapper-content">
    <div class="row">
        <div class="beforeLoadgame">
            <div class="col-md-8 col-sm-12 col-xs-12 margin-top">
                <?php $this->load->view($temp); ?>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12 right">
                <?php $this->load->view('site/right'); ?>
            </div>
        </div>
        <div id="wrapper-game" style="width: 100%;">
            <iframe id='gameScreen' frameborder="0" scrolling="no" style="height: 0px" allowfullscreen="true"
                    webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>
        </div>
    </div>
<!--    promotion-->
    <div class="row">
        <div class="beforeLoadgame">
            <div class="col-md-4 col-sm-12 col-xs-12 right">
                <?php $this->load->view('site/promotion'); ?>
            </div>
        </div>
    </div>
</div>
<!-- <iframe id='gameScreen' frameborder="0" scrolling="no"></iframe> -->
<?php $this->load->view('site/footer'); ?>
<div class="chat_fb" style="position: fixed;bottom: 0;right: 0;">
    <?php $this->load->view('site/chat_fb'); ?>
</div>
<!--thêm-->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-101107730-1', 'auto');
    ga('send', 'pageview');

</script>
<!--thêm-->


</body>
<div id="fb-root"></div>
<script>
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
        var scale = width / 1140;
        var height = 555 * scale;
        $("#wrapper-game").css({
            'width': width,
            'height': height
        });
    }
    doResize();
</script>
</html>
