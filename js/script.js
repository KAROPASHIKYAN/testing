$(document).ready(function(){

var current = $('.quiz').index();
var total = $('.quiz').length;	

$('.quiz').each(function(index, value){
	console.log(index);
});

$('.active input').on('change', function(){
	
	
	$('.btn-next').prop('disabled', false);
	

	
});
		//BTN NEXT
		//START
$('.btn-next').on('click', function(){
	$('.quiz.active').removeClass('active').addClass('inactive');
	$('.quiz').eq($(this).parents('.quiz').index() +1).addClass('active').removeClass('inactive');
	$(this).eq($(this).index() +1).prop('disabled', true);
	$('.quiz-indicator').text(2 + current++ + '/' + total);
		if(2 + current > total){
			$('.quiz-indicator').text(total + '/' + total);
	}
		if(1 + current>total){
			$('.result').addClass('active').removeClass('inactive');
			$('.btn-reset').addClass('active').removeClass('inactive');
		}
		if(current > 0){
			$('.btn-prev').addClass('active').removeClass('inactive');
		}else{
			$('.btn-prev').addClass('inactive').removeClass('active');
		}if($('.active input').prop('checked')){
			$('.btn-next').prop('disabled', false);
		}

	$('.btn-next').prop('disabled', true);
	$('.active input').on('change', function(){
	$('.btn-next').prop('disabled', false);
		});
	}); //END

//BTN PREV
//START
$('.btn-prev').on('click', function(){
	$('.btn-next').prop('disabled', false);
	$('.quiz.active').removeClass('active').addClass('inactive');
	$('.quiz').eq($(this).parents('.quiz').index() -1).addClass('active').removeClass('inactive');
	$('.quiz-indicator').text(current-- + '/' + total);
		if(2 + current > total){
			$('.quiz-indicator').text(total + '/' + total);
	}
		if(1 + current>total){
			$('.result').addClass('active').removeClass('inactive');
		}
		if(current > 0){
			$('.btn-prev').addClass('active').removeClass('inactive');
		}else{
			$('.btn-prev').addClass('inactive').removeClass('active')
		}

	});
	//END
});