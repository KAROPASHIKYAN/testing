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

       	var parent = $(this).parents('.quiz');
        $(parent).removeClass('active').addClass('inactive');
        $(parent).next().addClass('active').removeClass('inactive');
        console.log($(parent).next());
        $('.quiz-indicator .current').text(++current);
        
        if (current > total) {
            $('.result').addClass('active').removeClass('inactive');
            $('.btn-reset').addClass('active').removeClass('inactive');
            var str = $("form").serialize();
        }
        if (current > 0) {
            $('.btn-prev').addClass('active').removeClass('inactive');
        } else {
            $('.btn-prev').addClass('inactive').removeClass('active');
        }
        if ($('.active input').prop('checked')) {
            $('.btn-next').removeClass('disabled');
        }

        $('.btn-next').addClass('disabled');
        $('.active input').on('change', function() {
            $('.btn-next').removeClass('disabled');
        });
    }); //END
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

                console.log(data);
                if(data.pass == true){
                    
                    //window.location.replace("/?quiz_result="+data.result_post_id);
                    window.location = window.location.href + "?wl_result="+data.result_post_id;
                    

                }    
            }
        });
         event.preventDefault();
    });

    //BTN PREV
    //START
    $('.btn-prev').on('click', function() {
        var parent = $(this).parents('.quiz');
        $('.btn-next').removeClass('disabled');
        $(parent).removeClass('active').addClass('inactive');
        $(parent).prev().addClass('active').removeClass('inactive');
        $('.quiz-indicator .current').text(--current);
        
        if (current > total) {
            $('.result').addClass('active').removeClass('inactive');
        }
        if (current > 0) {
            $('.btn-prev').addClass('active').removeClass('inactive');
        } else {
            $('.btn-prev').addClass('inactive').removeClass('active')
        }

    });
    //END
});