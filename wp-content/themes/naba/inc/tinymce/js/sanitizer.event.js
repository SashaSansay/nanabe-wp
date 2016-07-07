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
    });

});