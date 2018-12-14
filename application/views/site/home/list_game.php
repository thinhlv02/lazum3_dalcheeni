<!-- #region Jssor Slider Begin -->
    <script src="<?php echo public_url()?>js/jssor.slider-23.1.6.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_2_slider_init = function() {

            var jssor_2_options = {
              $AutoPlay: 1,
              $AutoPlaySteps: 4,
              $SlideDuration: 160,
              $SlideWidth: 140,
              $SlideSpacing: 35,
              $Cols: 4,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 4
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
              }
            };

            var jssor_2_slider = new $JssorSlider$("jssor_2", jssor_2_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_2_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 809);
                    jssor_2_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <style>
        /* jssor slider bullet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        .jssorb03 {
            position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
            position: absolute;
            /* size of bullet elment */
            width: 21px;
            height: 21px;
            text-align: center;
            line-height: 21px;
            color: white;
            font-size: 12px;
            background: url('img/b03.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }

        /* jssor slider arrow navigator skin 03 css */
        /*
        .jssora03l                  (normal)
        .jssora03r                  (normal)
        .jssora03l:hover            (normal mouseover)
        .jssora03r:hover            (normal mouseover)
        .jssora03l.jssora03ldn      (mousedown)
        .jssora03r.jssora03rdn      (mousedown)
        .jssora03l.jssora03ldn      (disabled)
        .jssora03r.jssora03rdn      (disabled)
        */
        .jssora03l, .jssora03r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('<?php echo public_url('images')?>/slide/a13.png') no-repeat;
            overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
        .jssora03l.jssora03lds { background-position: -3px -33px; opacity: .3; pointer-events: none; }
        .jssora03r.jssora03rds { background-position: -63px -33px; opacity: .3; pointer-events: none; }
    </style>
    <div id="jssor_2"style="position:relative;margin:0 auto;top:0px;left:-10px;width:809px;height:150px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background:url('<?php echo public_url('images')?>/slide/loading.gif') no-repeat 50% 50%;background-color:rgba(0, 0, 0, 0.7);"></div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:10px;width:690px;height:150px;margin-left: 60px;overflow:hidden;">

            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_tlmn.png') ?>" width="125px"/>
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_tlmn_solo.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_phom.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_sam.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_xi_to.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_xoc_dia.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_lieng.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_mau_binh.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_3cay.png') ?>" />
                </a>
            </div>
            <div>
                <a href="<?php echo base_url('huong-dan/luat-choi-tien-len-mien-nam-1.html') ?>">
                    <img data-u="image" src="<?php echo public_url('images/icon_game/img_chan.png') ?>" />
                </a>
            </div>
            
            <a data-u="any" href="https://wordpress.org/plugins/jssor-slider/" style="display:none">wordpress banner rotator</a>
        </div>
        
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
    </div>
    <script type="text/javascript">jssor_2_slider_init();</script>
    <!-- #endregion Jssor Slider End -->