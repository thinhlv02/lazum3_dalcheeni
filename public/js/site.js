$( document ).ready(function() {
	var notiToTop = $('.notice-game').offset().top -30;
	

    $('.playGame').click(function () {
		//alert('abc');
		$('.menu-header').hide();
		$('.beforeLoadgame').hide();
		$("#gameScreen").css({
			'width':'100%',
			'height': '100%',
			'margin-top': '10px'
		});
	    // var src = 'http://choibaidoithuong.org/';
	    var src = 'http://choibaidoithe.com/';
	    $("#gameScreen").attr('src', src);
	    return false;
	});

	$(".head-chat").click(function(){
		$( ".body-chat" ).toggle();
		$("#hide_chat").toggle();
	});
});
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=282420135513035";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
				