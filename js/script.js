$(document).ready(function(){

var index = $('body').index();	

$('.active input').on('change', function(){
	$('.btn-next').removeAttr('disabled');
	console.log(index);
});
	
$('.btn-next').on('click', function(){
	$('body').each(function(i){
		$('.quiz').removeClass('active').addClass('inactive');
		$('.quiz').eq(index).addClass('active').removeClass('inactive');
		console.log(index);

	});
	


});
});