$(document).ready(function(){

var current = $('.quiz').index(),
	answer = $('input').index(),
    total = $('.quiz').length,	
	quizeArr = {'action': 'quizes'};
	//action = {'action': 'quizes'};






$('.active input').on('change', function(){
	
	
	$('.btn-next').prop('disabled', false);
	

	
});
		//BTN NEXT
		//START
$('.btn-next').on('click', function(){
	$('.quiz.active').removeClass('active').addClass('inactive');
	$('.quiz').eq($(this).parents('.quiz').index() +1).addClass('active').removeClass('inactive');
	$(this).eq($(this).index() +1).prop('disabled', true);
	//console.log(answer);

	$('.quiz-indicator').text(2 + current++ + '/' + total);
		if(2 + current > total){
			$('.quiz-indicator').text(total + '/' + total);
	}
		if(1 + current>total){
			$('.result').addClass('active').removeClass('inactive');
			$('.btn-reset').addClass('active').removeClass('inactive');
			
		$('.quiz ul').each(function(index){
					var id = index;
					var val = $('li input:checked').eq(index).val();
					var quize = {
						'id': id,
						'val': val
					};
					//var quizeStr = {'question' : quize};
					let addProp = (obj, propName, propValue) => {
						obj[propName] = propValue;
											
					};
					addProp(quizeArr, id, val);
					//quizeArr.push(quizeStr);
					//$.extend(true, quizeArr, quizeStr);


			//console.log($('input:checked').eq(index).val() );
					console.log(index);
					console.log(val);
		});
				console.log(quizeArr);
				console.log(jQuery.isPlainObject( quizeArr));
				var data = quizeArr;
				jQuery.get(my_plugin.ajaxurl, data, function(response){

					alert(response);
				});

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