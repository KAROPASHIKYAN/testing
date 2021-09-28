$(document).ready(function() {

    var current = 1,
        total = $('.quiz').length,
        quizeArr = {
            'action': 'wl_quizes',
            'data': []
        };


    $('.active input').on('change', function() {
        $('.btn-next').removeClass('disabled');

    });
    //BTN NEXT
    //START
    $('.btn-next').on('click', function() {

       	var quizActive = $('.quiz.active');
        if (quizActive.next().hasClass('quiz')){
            quizActive.toggleClass('active').next().toggleClass('active');
            $('.btn-prev').removeClass('inactive').addClass('active');
            //$('.btn-next').addClass('disabled');
            if (quizActive.next().find('input').is(':checked') === true){
                console.log(quizActive.next().find('input').is(':checked'));
                $('.btn-next').removeClass('disabled');
            }
            else {
                console.log(quizActive.next().find('input').is(':checked'));
                $('.btn-next').addClass('disabled');
            }
        }
        if ((quizActive.next().next().hasClass('quiz')) === false ){
                    $(this).addClass('inactive');
                    $("button").removeClass('d-none');
        }
        //if (quizActive.next().find('input:checked') == true){
                //$('.btn-next').removeClass('disabled');
        //}
        //if (quizActive.find('input:checked') == true){
         //       $('.btn-next').removeClass('disabled');
        //}
        //console.log(quizActive.next().next().hasClass('quiz'));







        }); //END

    //AJAX
    $('#quizes').submit(function(event) {
        $('.result').addClass('active').removeClass('inactive');
        $('.btn-reset').addClass('active').removeClass('inactive');

    	var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                var data = JSON.parse(data);

                // console.log(data);
                if(data.pass === true){
                    console.log(data.file);
                    window.location.replace("/?quiz_result="+data.result_post_id);
                    window.location = window.location.href + "?wl_result="+data.result_post_id;
                    $('.quiz .active').hide();
   
                }
                if(data.fail === true){
                    window.location = window.location.href + "?restart=1&wl_result="+data.result_post_id;
                    $('.quiz .active').hide();

                }   
            }
        });
         event.preventDefault();
    });

    //BTN PREV
    //START
    $('.btn-prev').on('click', function() {
       
        var quizActive = $('.quiz.active');
        if (quizActive.prev().hasClass('quiz')){
            quizActive.toggleClass('active').prev().toggleClass('active');
            $('.btn-prev').removeClass('inactive').addClass('active');
            //$('.btn-next').addClass('disabled');
            if (quizActive.prev().find('input').is(':checked') === true){
                console.log(quizActive.prev().find('input').is(':checked'));
                $('.btn-next').removeClass('disabled');
            }
            else {
                console.log(quizActive.prev().find('input').is(':checked'));
                $('.btn-next').addClass('disabled');
            }
        }
        if ((quizActive.prev().prev().hasClass('quiz')) === false ){
                $(this).addClass('inactive');
                    
        }
        if ((quizActive.last().hasClass('active')) == false){
                $('button').addClass('d-none');
                $('span.btn-next').addClass('active').removeClass('inactive');
        }
        if (quizActive.prev().find('input').is(':checked') == true){
                $('.btn-next').removeClass('disabled');
        }

        console.log(quizActive.prev().prev().hasClass('quiz'));

    });
    //END

    //RESET
    $('.btn-reset').on("click", function(){
       console.log(window.location); 
       window.location = window.location.origin + window.location.pathname;
       console.log(window.location); 
    });
});