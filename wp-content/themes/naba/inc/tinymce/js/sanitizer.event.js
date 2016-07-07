$ = jQuery;


$(document).ready(function(){
    var avg_price = $('[name=naba_avg-price]');

    $('#post').on('submit',function(){
        var date=$('[name=naba_date-event]').val();
        var image = $('[name="naba_inner-image"]').val();
        if(date == ""){
            alert('Не указана дата начала события!');
            return false;
        }
        if(image == 0){
            alert('Не указано изображение фоновое изображение заголовка!');
            return false;
        }
        if($('[name=naba_is-cycle]:checked').val()==='1'){
            if(typeof $('[name="naba_cycle-days[]"]:checked').val() === 'undefined'){
                alert('Не указаны дни недели события!');
                return false;
            }
            if($('[name="naba_time-event"]').val() == ''){
                alert('Не указано время события!');
                return false;
            }
        }
    });

});