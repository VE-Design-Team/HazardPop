<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RMIT</title>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="mediaelements/mediaelementplayer.css">
<script src="js/jquery.1.12.js"></script>
<script src="js/function.js"></script>
<script src="mediaelements/mediaelement-and-player.js"></script>

<style>

.intro-main{
	background-color: #a7e8ff;
}	

.intro-main .intro-img{
	padding-top:30px;
}

.intro-main .btn-play{
	padding-top:80px;
}

.how-to-play-main{
	background-color: #3fe4c6;
	display: none;
}	

.how-to-play-main .btn-lets-start{
	position:absolute;
	top: 245px;
	right: 38px;

}

.how-to-play-main .btn-how-to-play{
	position:absolute;
	top: 295px;
    right: 38px;
}

.how-to-play-main .page-row{
	max-width: 300px;
	margin: 0 auto;	
	padding-top: 50px;
}

.home-main{
	background-color: #3fe4c6;
	display: none;
}	

.home-main .btn-start-game{
    position: absolute;
    bottom: 105px;
    right: 3px;

}

.home-main .btn-how-to-play{
    position: absolute;
    bottom: 58px;
    right: 3px;
}

</style>
<script>

</script>
</head>

<body>

<div class="main-div intro-main">
	<audio width="1" height="1" controls="none" preload="none" class="aplayer"  style="display:none">
		<source src="media/music.mp3" />
		<object width="320" height="240" type="application/x-shockwave-flash" data="mediaelements/flashmediaelement.swf">
			<param name="movie" value="mediaelements/flashmediaelement.swf" />
			<param name="flashvars" value="controls=true&amp;file=media/music.mp3" />
		</object>
	</audio> 
	<div class="menu-bar">
		<img src="img/menu-home.png" class="menu-home btn-state" onclick="gotoPage('index.html?home-menu=1');">
		<img src="img/menu-sound-mute.png" class="menu-sound-on btn-state" onclick="muteAudio();">
		<img src="img/menu-sound.png" class="menu-sound-mute btn-state" onclick="unmuteAudio();">
	</div>
	<img src="img/intro-img.png" class="center-img intro-img">
	<img src="img/btn-play.png" class="center-img btn-state btn-play" onClick="showSplash();">
	<div class="ios-sound-play">
		
		<p class="iosSoundPlay"><img src="img/play-btn.png" onclick="playAudio()" class="center-img"/>
		
		<a onclick="playAudio()">Press here  to enable audio and we're good to go!</a></p>
	</div>
</div>

<div class="main-div how-to-play-main">
	<audio width="1" height="1" controls="none" preload="none" class="aplayer"  style="display:none">
		<source src="media/splash.mp3" />
		<object width="320" height="240" type="application/x-shockwave-flash" data="mediaelements/flashmediaelement.swf">
			<param name="movie" value="mediaelements/flashmediaelement.swf" />
			<param name="flashvars" value="controls=true&amp;file=media/splash.mp3" />
		</object>
	</audio> 
	<div class="menu-bar">
		<img src="img/menu-home.png" class="menu-home btn-state" onclick="gotoPage('index.html?home-menu=1');">
		<img src="img/menu-sound-mute.png" class="menu-sound-on btn-state" onclick="muteAudio();">
		<img src="img/menu-sound.png" class="menu-sound-mute btn-state" onclick="unmuteAudio();">
	</div>
	<div class="page-row row-1">
		<img src="img/how-to-play-bg.png" class="center-bottom-img">
		<img src="img/btn-lets-start.png" class="btn-state btn-lets-start" onClick="showHome();">
		<img src="img/btn-how-to-play.png" class="btn-state btn-how-to-play" onClick="showPageRow($('.row-2'));playNewAudio('music');">
	</div>

	<div class="page-row row-2">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">You're on the job and need to keep the workplace safe. </p>
		<p class="body-font center-text">Identify the hazards and earn points towards a medal. The faster you respond, the more points you earn. But be quick, before time runs out!</p>
		<p><img src="img/btn-lets-start.png" class="center-img btn-state" onClick="showHome();"></p>
		<p><img src="img/btn-tell-me-more.png" class="center-img btn-state" onClick="showPageRow($('.row-3'));"></p>
		
		
	</div>
	<div class="page-row row-3">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">There are 10 questions. Answer Yes or No before the timer runs out. </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-4'));">
	</div>
	<div class="page-row row-4">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">For every correct answer, you'll earn 100 points.  </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-4-2'));">
	</div>
	<div class="page-row row-4-2">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">The quicker you are, the better you score! Every second you save earns you an extra 50 points.</p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-5'));">
	</div>
	<div class="page-row row-5">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">Get three questions right in a row and level up with 200 bonus points! </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-6'));">
	</div>
	<div class="page-row row-6">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">Don't worry if you get one wrong or time-out, just keep going and see how you score. </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-7'));">
	</div>
	<div class="page-row row-7">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">Score 1,000 points or more and earn a medal! There are three medal levels. </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showPageRow($('.row-8'));">
	</div>
	<div class="page-row row-8">
		<p class="title-font center-text">How to play</p>
		<p class="body-font center-text">Not happy with your score? Just <strong>select</strong> Play Again to reset the game and have another go. </p>
		<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onClick="showHome();">
	</div>
</div>
<div class="main-div home-main">
		<audio width="1" height="1" controls="none" preload="none" class="aplayer"  style="display:none">
			<source src="media/music.mp3" />
			<object width="320" height="240" type="application/x-shockwave-flash" data="mediaelements/flashmediaelement.swf">
				<param name="movie" value="mediaelements/flashmediaelement.swf" />
				<param name="flashvars" value="controls=true&amp;file=media/music.mp3" />
			</object>
		</audio> 
		<div class="menu-bar">
			<img src="img/menu-home.png" class="menu-home btn-state" onclick="gotoPage('index.html?home-menu=1');">
			<img src="img/menu-sound-mute.png" class="menu-sound-on btn-state" onclick="muteAudio();">
			<img src="img/menu-sound.png" class="menu-sound-mute btn-state" onclick="unmuteAudio();">
		</div>
		
		<img src="img/home-bg.png" class="center-img" id="how-to-play-bg">
		<img src="img/btn-start-game.png" class="btn-state btn-start-game" onClick="gotoPage('questions.html')">
		<img src="img/btn-how-to-play.png" class="btn-state btn-how-to-play" onClick="showHowToPlay();">

</div>
<script>
var $player;
if(!isIOS){
	$('.ios-sound-play').hide();
}




function playNewAudio(audioFile){
	$player.setSrc([{src:'media/'+audioFile+'.mp3',type:'audio/mp3'}]);
	$player.play();
}

function muteAudio(){
    $player.setMuted(true);
	$('.menu-sound-on').hide();
	$('.menu-sound-mute').show();
}

function unmuteAudio(){
    $player.setMuted(false);
	$('.menu-sound-on').show();
	$('.menu-sound-mute').hide();
}
$(document).ready(function(){
	$('.page-row').hide();
	$('.row-1').show();
	
	$player =  new MediaElementPlayer('.aplayer', {
	success: function(player, node) {
		player.play();
	  }
	});
});

function showHowToPlay(){
	$('.intro-main').hide();
	$('.home-main').hide();
	$('.how-to-play-main').show();
	$('.intro-main').hide();
	$('.home-main').hide();
	playNewAudio('music');
	
	$('.page-row').hide();
	$('.row-2').show();
}
function showSplash(){
	$('.intro-main').hide();
	$('.home-main').hide();
	$('.how-to-play-main').show();
	$('.intro-main').hide();
	$('.home-main').hide();
	playNewAudio('splash');
	
	$('.page-row').hide();
	$('.row-1').show();
}
function showHome(){
	$('.how-to-play-main').hide();
	$('.home-main').show();
	playNewAudio('music');
}


function playAudio(){
	$('.ios-sound-play').hide();
	$player.play();
}

var getUrlParameter = function getUrlParameter(sParam) {
	var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		sURLVariables = sPageURL.split('&'),
		sParameterName,
		i;

	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');

		if (sParameterName[0] === sParam) {
			return sParameterName[1] === undefined ? true : sParameterName[1];
		}
	}
};

var toHomeScreen = getUrlParameter('home-menu')||0;

function showHomeScreen(){
	if (toHomeScreen!=0){
		$('.main-div ').hide();
		$('.home-main').show();
	}
}

showHomeScreen();
</script>
</body>
</html>
