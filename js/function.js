function gotoPage(pageName){
	window.location=pageName;
}

function showPageRow(rowClass){
	$('.page-row').hide();
	rowClass.show();
}

var isIOS;

if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {  
	isIOS=true;
}else{
	isIOS=false;
}
