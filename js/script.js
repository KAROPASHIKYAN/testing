$(document).ready(function(){

var current = $('.quiz').index() +1;
var total = $('.quiz').length;	

$('.quiz').each(function(index, value){
	console.log(index);
});

$('.active input').on('change', function(){
	
	
	$('.btn-next').prop('disabled', false);
	

	
});
		
$('.btn-next').on('click', function(){
	$('.quiz.active').removeClass('active').addClass('inactive');
	$('.quiz').eq($(this).parents('.quiz').index() +1).addClass('active').removeClass('inactive');
	$(this).eq($(this).index() +1).prop('disabled', true);
	$('.quiz-indicator').text(current++ + '/' + total);
	$('.btn-next').prop('disabled', true);
	$('.active input').on('change', function(){
	$('.btn-next').prop('disabled', false);
		});

	});
		

});