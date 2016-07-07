$ = jQuery;


$(document).ready(function(){
    var avg_price = $('[name=naba_avg-price]');

    $('#post').on('submit',function(){
        var place_type=$('[name=naba_place-type]:checked').val();
        var pin = $('[name=naba_place-pin]').val();
        var image = $('[name="naba_menu-image"]').val();

        if(pin == ""){
            alert('Не указана точка на карте!');
            return false;
        }
        if(image == 0){
            alert('Не указано изображение в меню!');
            return false;
        }


        if(typeof place_type === 'undefined'){
            alert('Не указан тип места!');
            return false;
        }

    });

    function disable(el){
        if(el.is(':checked')){
            avg_price.prop('disabled',true);
        }else{
            avg_price.prop('disabled',false);
        }
    }

    $('[name=naba_place-free]').change(function(){
        disable($(this));
    });

    disable($('[name=naba_place-free]'));
});