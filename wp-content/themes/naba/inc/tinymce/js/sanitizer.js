$ = jQuery;

$(document).ready(function(){
    $('#post').on('submit',function(){
        var post_type = $('[name="naba_post-type"]').val();
        var tile_image = $('[name="naba_main-image"]').val();
        var color_pallet = $('[name="naba_color-pallet"]:checked').val();
        var icon = $('[name="naba_icon-pallet"]:checked').val();
        if(post_type=="") {
            alert('Не указан типа поста!');
            return false;
        }
        if(typeof color_pallet === 'undefined'){
            alert('Не указана цветовая палитра!');
            return false;
        }
        //if($('#tile_image').val()==0){
        //    if(typeof icon === 'undefined'){
        //        alert('Не указан текст в заголовке поста!');
        //        return false;
        //    }
        //}
        if($('#naba_preview-text').val()==""){
            alert('Не указан текст в заголовке поста!');
            return false;
        }
        if(post_type == "post_half" || post_type == "post_full"){
            if(tile_image == 0){
                alert('Не указано изображение для плитки!');
                return false;
            }
        }
        if(post_type == "post_icon"){
            if(typeof icon === 'undefined'){
                alert('Не указана иконка для поста!');
                return false;
            }
        }
    });
});
