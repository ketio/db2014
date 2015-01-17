<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min"></script>
	<script type="text/javascript" src="js/jssor.core.js"></script>
	<script type="text/javascript" src="js/jssor.utils.js"></script>
	<script type="text/javascript" src="js/jssor.slider.js"></script>
	<script>
		$(document).ready(function () {

			var _SlideshowTransitions = [
			//Fade
			{ $Duration: 1200, $Opacity: 2 }
			];

			var options = {
				$AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
				$AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
				$AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
				$PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

				$ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
				$SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
				$MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
				//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
				//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
				$SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
				$DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
				$ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
				$UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
				$PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
				$DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

				$SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
					$Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
					$Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
					$TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
					$ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
				},

				$BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
					$Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
					$Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
					$Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
					$SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
					$SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
					$Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
				},

				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
					$ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
					$Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
				}
			};
			var jssor_slider1 = new $JssorSlider$("slider1_container", options);

			//responsive code begin
			//you can remove responsive code if you don't want the slider scales while window resizes
			function ScaleSlider() {
				var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
				if (parentWidth)
					jssor_slider1.$SetScaleWidth(Math.min(parentWidth, 1140));
				else
					window.setTimeout(ScaleSlider, 30);
			}

			ScaleSlider();

			if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
				$(window).bind('resize', ScaleSlider);
			}


			//if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
			//    $(window).bind("orientationchange", ScaleSlider);
			//}
			//responsive code end
			
			$("#subscription_function").focus(function(){
				if($(this).val()=="提供電子信箱，我們將以電子報告訴您最新消息！"){
					$(this).val("");
				}
			});
			$("#subscription_function").blur(function(){
				
				if($(this).val()==""){
					$(this).val("提供電子信箱，我們將以電子報告訴您最新消息！");
				}
			});
			$("#subscription_button").click(function(){
				if($("#subscription_function").val()=="提供電子信箱，我們將以電子報告訴您最新消息！"){
					alert("提供電子信箱，我們將以電子報告訴您最新消息！");
				}
				else if(!isEmail($("#subscription_function").val())){
					alert("請輸入正確的E-mail格式！");
				}
				else{
					$.ajax({
						async:true,
						type:"GET",
						url:"subscribed/insert.php",
						data:{
							email:$("#subscription_function").val(),
						},
						cache:false,
						success:function(response){
							if(response=="SUCCESS"){
								alert("訂閱成功!");
							}
						}
					});
				}
			
			});
			
			
			
			
		});
		function isEmail(strEmail) {
			if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
			return true;
		}
	</script>	
	</head>

	<body>
		<div id="content_wrapper">

			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="index_slideshow">
			
				<!-- Jssor Slider Begin -->
				<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 1140px; height: 494px; overflow: hidden; ">

					<!-- Loading Screen -->
					<div u="loading" style="position: absolute; top: 0px; left: 0px;">
						<div style="filter: alpha(opacity=70); opacity:1;background:#15191f; position: absolute; display: block;
							 top: 0px; left: 0px;width: 100%;height:100%;">
						</div>
						<div style="position:absolute; display: block; top: 0px; left: 0px;width: 100%;height:100%; width:100%;text-align:center">
							<img src="img/slider/loading.gif"/>
						</div>
						
						<!--<div style="position: absolute; display: block; background: url(img/slider/loading.gif) no-repeat center center;
							top: 200px; left: 250px;width: 30%;height:30%;">
						</div>
						-->
					</div>
					<!-- Slides Container -->
					<div u="slides" style="position: absolute; left: 0px; top: 0px; width: 1140px; height: 494px; overflow: hidden;">
						<div>
							<img u="image" src="img/slider/slider1.png" />
						</div>
						<div>
							<img u="image" src="img/slider/slider2.png" />
						</div>
						<div>
							<img u="image" src="img/slider/_0006397.png" />
						</div>
						<div>
							<img u="image" src="img/guide.png" />
						</div>
					</div>
					<!-- bullet navigator container -->
					<div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
						<!-- bullet navigator item prototype -->
						<div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
					</div>
					<!-- Arrow Navigator Skin Begin -->
					<!-- Arrow Left -->
					<span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 230px; left: 0px;">
					</span>
					<!-- Arrow Right -->
					<span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 230px; right: 0px">
					</span>
					<!-- Arrow Navigator Skin End -->
					<a style="display: none" href="http://www.jssor.com">javascript</a>
				</div>
				<!-- Jssor Slider End -->
			</div>

			<!-- facebook & news linl function -->

			<div id="title_interface">
				<div id="news_title">
					NEWS
				</div>
				<div id="facebook_title">
					FACEBOOK
				</div>
			</div>
			<div id="content_inteface">
				<div id="news_content">
					<div class="news_list">
						<div>
							<div class="news_date">
								2014／11／14
							</div>
							<div class="news_press">
								【大內藝術節】串連21家畫廊及藝術機構
							</div>
						</div>
							<div class="news_content">
								臺北創意街區地圖上的新亮點：大內藝術區，為大直與內湖創造新的有機人文生態，並且大聲宣示既有專業價值創造、又有人文藝術創意無限的臺北城市精神！正式成為臺北第13個創意街區大內藝術區⋯⋯
							</div>
							<div class="news_more">
								<a href="http://artemperor.tw/tidbits_page.php?table=tidbits&id=1385?1" target="_BLANK"> more 〉</a>
						</div>
					</div>
					<div class="news_list">
						<div>
							<div class="news_date">
								2014／11／14
							</div>
							<div class="news_press">
								大內藝術街區 年底前推24檔展覽
							</div>
						</div>
						<div class="news_content">
								台北創意街區又多一個！文化局串聯內湖大直二十多家畫廊與藝術機構，打造北市第一個國際藝術街區，並以「城市精神」為主題，推出第一屆「台北大內藝術節」，即日起在捷運劍南路站有「城市精神攝影展」⋯⋯
						</div>
						<div class="news_more">
								<a href="http://news.ltn.com.tw/news/local/paper/830133" target="_BLANK"> more 〉</a>
						</div>
					</div>
					<div class="news_list">
						<div>
							<div class="news_date">
								2014／11／14
							</div>
							<div class="news_press">
								大內藝術節…美麗華前廣場 變身創意街區
							</div>
						</div>
						<div class="news_content">
							「2014台北大內藝術節」昨天開展，美麗華百貨前「中山21號廣場」十數個大型攝影作品，與街景融為一體，成為創意街頭美術館。首屆台北大內藝術節以創意街區方式，讓經過的民眾能夠欣賞5位國內外藝術家⋯⋯
						</div>
						<div class="news_more">
								<a href="http://udn.com/NEWS/DOMESTIC/DOM2/9064915.shtml" target="_BLANK"> more 〉</a>
						</div>
					</div>


					
				</div>
				<div id="facebook_content">
					<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Ftadfestival&amp;width&amp;height=395&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:480px;height:400px;background:white" allowTransparency="true"></iframe>
				</div>
			</div>
			<!-- subscribe function -->

			<div class="subscription">
				<div id="subscription_text">
					SUBSCRIBE
				</div>
				<input id="subscription_function" type="text" name="fname" value="提供電子信箱，我們將以電子報告訴您最新消息！">
				<div id="subscription_button">
					提交
				</div>
			</div>
			
			<!-- header -->
			<?php 
				include_once "footer.php"; 
			?>	
		</div>
	</body>