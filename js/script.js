$(document).ready(function(){

var current = $('.quiz').index();
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
	$('.quiz-indicator').text(2 + current++ + '/' + total);
		if(2 + current > total){
		$('.quiz-indicator').text(total + '/' + total);
	}
		if(1 + current>total){
		$('.quiz-results').addClass('active').removeClass('inactive');
		}
	$('.btn-next').prop('disabled', true);
	$('.active input').on('change', function(){
	$('.btn-next').prop('disabled', false);
		});
	});
	
});