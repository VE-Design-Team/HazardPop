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

.questions-main .row-0{
	background-color: #a7e8ff;
	height: 470px;
}	

.questions .btn-lets-start{
	position:absolute;
	top: 245px;
	right: 38px;

}

.questions .btn-how-to-play{
	position:absolute;
	top: 295px;
    right: 38px;
}

.questions .page-row{
	max-width: 300px;
	margin: 0 auto;	
	padding-top: 50px;
}

#timerDiv{
    position: absolute;
    width: 100%;
    height: 5px;
    bottom: 60px;
}

#timerBar{
    width: 0%;
    height: 5px;
    background-color: red;
}
#counter{
	padding-top: 24px;
	padding-left: 8px;
}
#timerBg{
	margin-left: 47%;
	width:36px;
	height:51px;
	background-image:url(img/timer.png)
}
</style>
<script>
$(document).ready(function(){
	$('.page-row').hide();
	$('#timerDiv').hide();
	$('.row-0').show();
	
	/*
	$('.row-11').show();
	$('.final-page').hide();
	$('.final-fb-1').show();
	*/
	
});

var correctAns = [0,0,1,1,0,0,0,1,0,0];
var ansResults =[false,false,false,false,false,false,false,false,false,false];
var currentQ = 1;
var totallScore = 0;
var timeSpent = 0;
function checkAns(q,a){
	if(a==correctAns[q-1]){
		
		ansResults[q-1] = true;
		$('.row-'+q+' .question-div').hide();
		$('.row-'+q+' .q-img').hide();
		switch(timeSpent){
			case 0: totallScore+=250; $('.row-'+q+' .points-earned').html('250'); break;
			case 1: totallScore+=200; $('.row-'+q+' .points-earned').html('200'); break;
			case 2: totallScore+=150; $('.row-'+q+' .points-earned').html('150'); break;
			case 3: totallScore+=100; $('.row-'+q+' .points-earned').html('100'); break;
		}
		
		switch(q){
			case 3: if(ansResults[0]&&ansResults[1]&&ansResults[2]){
						$('.row-'+q+' .fb-fabulous').fadeIn();
						playNewAudio('bonus');
						totallScore+=200;
					}else{
						$('.row-'+q+' .fb-right').fadeIn();
						playNewAudio('pop');
					};
					break;
					
			case 6: if(ansResults[3]&&ansResults[4]&&ansResults[5]){
						$('.row-'+q+' .fb-fabulous').fadeIn();
						playNewAudio('bonus');
						totallScore+=200;
					}else{
						$('.row-'+q+' .fb-right').fadeIn();
						playNewAudio('pop');
					};
					break;
					
			case 9: if(ansResults[6]&&ansResults[7]&&ansResults[8]){
						$('.row-'+q+' .fb-fabulous').fadeIn();
						playNewAudio('bonus');
						totallScore+=200;
					}else{
						$('.row-'+q+' .fb-right').fadeIn();
						playNewAudio('pop');
					};
					break;
			default: playNewAudio('pop'); $('.row-'+q+' .fb-right').fadeIn(); 
		}
	}else{
		$('.row-'+q+' .question-div').hide();
		$('.row-'+q+' .q-img').hide();
		$('.row-'+q+' .fb-wrong').fadeIn();
		playNewAudio('uhoh');
	}
	stop(); 
	reset();
	
	currentQ++;

	//console.log("total score: "+ totallScore);

}



/*------------------timer---------------------------*/

var timeBegan = null,
	timeStopped = null,
	stoppedDuration = 0,
	started = null,
	goTimer = null;

function start() {
	if (timeBegan === null) {
		timeBegan = new Date();
	}

	if (timeStopped !== null) {
		stoppedDuration += (new Date() - timeStopped);
	}
	//console.log(stoppedDuration);
	goTimer = window.setTimeout(timeOutCalled, 4000);
	started = window.setInterval(clockRunning, 10);	
	
	$('#timerDiv').show();
}

function stop() {
	timeStopped = new Date();
	window.clearInterval(started);
	$('#timerDiv').hide();
}

function reset() {
	window.clearInterval(started);
	stoppedDuration = 0;
	timeBegan = null;
	timeStopped = null;
	document.getElementById("counter").innerHTML = "00";
	document.getElementById("timerBar").style.width = '0%';
	window.clearTimeout(goTimer);
	timeSpent = 0;
}

function clockRunning(){
	var currentTime = new Date(),
		timeElapsed = new Date(currentTime - timeBegan - stoppedDuration),
		sec = timeElapsed.getUTCSeconds(),
		ms = timeElapsed.getUTCMilliseconds();
	timeSpent = sec;
	var timerPer = (sec*1000+ms)/40;
	if(timerPer<99){
		document.getElementById("counter").innerHTML = (sec > 9 ? sec : "0" + sec);
		document.getElementById("timerBar").style.width = timerPer+'%';
	}else{
		document.getElementById("timerBar").style.width = '100%';
		document.getElementById("counter").innerHTML = "00";
	}
};

function timeOutCalled(){
	//console.log("time out");
	$player.pause();
	$('.row-'+currentQ+' .question-div').hide();
	$('.row-'+currentQ+' .q-img').hide();
	$('.row-'+currentQ+' .fb-time-up').fadeIn();
	stop(); 
	reset();
	currentQ++;
	playNewAudio('uhoh');
}


</script>
</head>

<body>

<div class="main-div questions-main">
	<audio width="1" height="1" controls="none" preload="none" class="aplayer"  style="display:none">
		<source src="media/tick-tock.mp3" />
		<object width="320" height="240" type="application/x-shockwave-flash" data="mediaelements/flashmediaelement.swf">
			<param name="movie" value="mediaelements/flashmediaelement.swf" />
			<param name="flashvars" value="controls=true&amp;file=media/tick-tock.mp3" />
		</object>
	</audio> 
	<div class="menu-bar">
		<img src="img/menu-home.png" class="menu-home btn-state" onclick="gotoPage('index.html?home-menu=1');">
		<img src="img/menu-sound-mute.png" class="menu-sound-on btn-state" onclick="muteAudio();">
		<img src="img/menu-sound.png" class="menu-sound-mute btn-state" onclick="unmuteAudio();">
	</div>
	<div id="timerDiv">
		<div id="timerBar"></div>
		<div id="timerBg">
			<div id="counter"></div>
		
		</div>
	</div>
	<div class="page-row row-0">
		<img src="img/startTimer.png" class="center-img padding-top-gap">
		<p class="body-font center-text">You have 4 seconds to answer each question.</p>
		<p class="body-font center-text">Ready?</p>
		<img src="img/btn-start.png" class="center-img btn-state btn-start" onclick="showPageRowQ($('.row-1'));	$('#timerDiv').show();">
	</div>
	<div class="page-row row-1">
		<img src="img/q-bg-1.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Giorgio?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(1,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(1,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-2'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-2'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-2'));">
		</div>
	</div>
	<div class="page-row row-2">
		<img src="img/q-bg-2.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Aneeta?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(2,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(2,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-3'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-3'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-3'));">
		</div>
	</div>
	<div class="page-row row-3">
		<img src="img/q-bg-3.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Giorgio?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(3,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(3,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-4'));">
		</div>
		<div class="fb-fabulous">
			<img src="img/fb-fabulous.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned <span class="points-earned title-font center-text font-size5"></span> points</p>
			<p class="center-text">Plus <span class="title-font font-size5">200</span> bonus points for getting three in a row correct!</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-4'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-4'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-4'));">
		</div>
	</div>
	<div class="page-row row-4">
		<img src="img/q-bg-4.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Aneeta?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(4,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(4,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-5'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-5'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-5'));">
		</div>
	</div>
	<div class="page-row row-5">
		<img src="img/q-bg-5.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Giorgio?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(5,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(5,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-6'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-6'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-6'));">
		</div>
	</div>
	<div class="page-row row-6">
		<img src="img/q-bg-6.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Giorgio?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(6,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(6,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-7'));">
		</div>
		<div class="fb-fabulous">
			<img src="img/fb-fabulous.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned <span class="points-earned title-font center-text font-size5"></span> points</p>
			<p class="center-text">Plus <span class="title-font font-size5">200</span> bonus points for getting three in a row correct!</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-7'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-7'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-7'));">
		</div>
	</div>
	<div class="page-row row-7">
		<img src="img/q-bg-7.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Aneeta?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(7,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(7,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-8'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-8'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-8'));">
		</div>
	</div>
	<div class="page-row row-8">
		<img src="img/q-bg-8.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Giorgio?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(8,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(8,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-9'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-9'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-9'));">
		</div>
	</div>
	<div class="page-row row-9">
		<img src="img/q-bg-9.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Aneeta?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(9,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(9,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-10'));">
		</div>
		<div class="fb-fabulous">
			<img src="img/fb-fabulous.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned <span class="points-earned title-font center-text font-size5"></span> points</p>
			<p class="center-text">Plus <span class="title-font font-size5">200</span> bonus points for getting three in a row correct!</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-10'));">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-10'));">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showPageRowQ($('.row-10'));">
		</div>
	</div>
	<div class="page-row row-10">
		<img src="img/q-bg-10.png" class="q-img">
		<div class="question-div">
			<p class="q-text">Is this a hazard for Aneeta?</p>
			<img src="img/btn-yes.png" class="btn-state btn-yes" onclick="checkAns(10,0)">
			<img src="img/btn-no.png" class="btn-state btn-no" onclick="checkAns(10,1)">
		</div>
		<div class="fb-right">
			<img src="img/fb-right.png" class="center-img padding-top-gap">
			<p class="body-font center-text">You've earned</p>
			<p class="title-font center-text font-size5"><span class="points-earned"></span> points</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showLastPage();">
		</div>
		<div class="fb-time-up">
			<img src="img/fb-time-up.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">Be quicker next time.</p>
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showLastPage();">
		</div>
		<div class="fb-wrong">
			<img src="img/fb-wrong.png" class="center-img padding-top-gap">
			<p class="center-text font-size3 font-white">That's not right. </p>
	
			<img src="img/btn-ok.png" class="center-img btn-state btn-ok" onclick="showLastPage();">
		</div>
	</div>
	<div class="page-row row-11">
		<div class="final-page">
			<p class="body-font center-text padding-top-gap">You scored</p>
			<p class="title-font center-text font-size5"><span class="totall-points-earned"></span> points</p>
			<p class="body-font center-text">Have you earned a medal?</p>
			<p class="body-font center-text"><strong>Select</strong> your medal level or select  Play Again and improve your score!</p>
			<table>
				<tr class="table-row1"><td><img src="img/level-lock.png" class="level-lock"/><img src="img/level-unlock.png" class="level-unlock"/></td>
					<td><img src="img/level-bronze.png" class="btn-level-bronze btn-state" onclick="showBadgePageRow($('.final-fb-3')); playNewAudio('harp');"/><img src="img/level-bronze.png" class="btn-level-bronze-disabled"/></td>
					<td>1,000 + points</td>
					<td>Bronze medal</td>
				</tr>
				<tr class="table-row2">
					<td><img src="img/level-lock.png" class="level-lock"/><img src="img/level-unlock.png" class="level-unlock"/></td>
					<td><img src="img/level-silver.png" class="btn-level-silver btn-state" onclick="showBadgePageRow($('.final-fb-2')); playNewAudio('harp');"/><img src="img/level-silver.png" class="btn-level-silver-disabled"/></td>
					<td>2,000+ points</td>
					<td>Silver medal</td>
				</tr>
				<tr class="table-row3">
					<td><img src="img/level-lock.png" class="level-lock"/><img src="img/level-unlock.png" class="level-unlock"/></td>
					<td><img src="img/level-gold.png" class="btn-level-gold btn-state" onclick="showBadgePageRow($('.final-fb-1')); playNewAudio('harp');"/><img src="img/level-gold.png" class="btn-level-gold-disabled"/></td>
					
					<td>3,000+ points</td>
					<td>Gold medal</td>
				</tr>
				<tr class="table-row4">
					<td></td>
					<td><img src="img/btn-play-again.png" class="btn-state" onclick="gotoPage('index.html?home-menu=1');"/></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div class="final-fb-3">
			<p class="padding-top-badge"></p>
			<p class="body-font center-text">You've done well. Make sure you go to the discussion forum below and share your score!</p>
			<p class="title-font center-text font-size5"><span class="totall-points-earned"></span> points</p>
			<img src="img/btn-paly-again.png" class="center-img btn-state btn-paly-again" onclick="gotoPage('index.html?home-menu=1');">
			<img src="img/btn-see-you-later.png" class="center-img btn-state btn-ok" onclick="gotoPage('index.html');">
		</div>
		<div class="final-fb-2">
			<p class="padding-top-badge"></p>
			<p class="body-font center-text">Nice work! Make sure you go to the discussion forum below and share your score.</p>
			<p class="title-font center-text font-size5"><span class="totall-points-earned"></span> points</p>
			<img src="img/btn-paly-again.png" class="center-img btn-state btn-paly-again" onclick="gotoPage('index.html?home-menu=1');">
			<img src="img/btn-see-you-later.png" class="center-img btn-state btn-ok" onclick="gotoPage('index.html');">
		</div>
		<div class="final-fb-1">
			<p class="padding-top-badge"></p>
			<p class="body-font center-text">You've made it to the top! Make sure you go to the discussion forum below and share your score. </p>
			<p class="title-font center-text font-size5"><span class="totall-points-earned"></span> points</p>
			<img src="img/btn-paly-again.png" class="center-img btn-state btn-paly-again" onclick="gotoPage('index.html?home-menu=1');">
			<img src="img/btn-see-you-later.png" class="center-img btn-state btn-ok" onclick="gotoPage('index.html');">
		</div>
	</div>
</div>
<script>
var $player =  new MediaElementPlayer('.aplayer', {
	success: function(player, node) {
  }
});


function playNewAudio(audioFile){
	$player.setSrc('media/'+audioFile+'.mp3');
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

function showPageRowQ(rowClass){
	$('.page-row').hide();
	rowClass.show();
	start();
	playNewAudio('tick-tock');
}

function showLastPage(){
	$('.page-row').hide();
	$('.row-11').show();
	$('#timerDiv').hide();
	$('.totall-points-earned').html(totallScore);
	playNewAudio('bright_star_tick');
	
	if(totallScore>=3000){
		$('.row-11 .table-row3 .level-lock').hide();
		$('.row-11 .table-row3 .level-unlock').show();
		$('.row-11 .btn-level-gold').show();
		$('.row-11 .btn-level-gold-disabled').hide();
	}else if(totallScore>=2000){
		$('.row-11 .table-row2 .level-lock').hide();
		$('.row-11 .table-row2 .level-unlock').show();
		$('.row-11 .btn-level-silver').show();
		$('.row-11 .btn-level-silver-disabled').hide();
	}else if(totallScore>=1000){
		$('.row-11 .table-row1 .level-lock').hide();
		$('.row-11 .table-row1 .level-unlock').show();
		$('.row-11 .btn-level-bronze').show();
		$('.row-11 .btn-level-bronze-disabled').hide();
	}
}

function showBadgePageRow(rowClass){
	$('.final-page').hide();
	rowClass.fadeIn();
}
</script>
</body>
</html>
