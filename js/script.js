$(document).ready(function(){

//var index = $('div .quiz').index();	

$('.quiz').each(function(index, value){
	console.log(index);
});

$('.active input').on('change', function(){
	$('.btn-next').removeAttr('disabled');
	
});
	

	
		$('.btn-next').on('click', function(){
			$('.quiz.active').removeClass('active').addClass('inactive');
			$('.quiz').eq($(this).parents('.quiz').index() +1).addClass('active').removeClass('inactive');
		});
		

});