(function() {
    tinymce.PluginManager.add('image_full_plugin', function( editor, url ) {
        editor.addButton('image_full_plugin', {
            text: 'Изображение во всю ширину',
            icon: 'image',
            onclick: function() {
                var image = '';
                editor.windowManager.open( {
                    title: 'Вставить изображение во всю ширину',
                    body: [
                        {
                            type: 'button',
                            name: 'image_button',
                            label: 'Изображение',
                            library: { type: 'image' },
                            text: 'Выбрать изображение',
                            onclick: function(){
                                var frame = wp.media({
                                        title: 'Выберите изображение',
                                        button: {
                                            text: 'Выбрать'
                                        },
                                        multiple: false
                                    })
                                    .on('select',function(){
                                        var attachment = frame.state().get('selection').first().toJSON();
                                        //document.getElementById('mceu_67').val(attachment.url);
                                        image = attachment.url;
                                    })
                                    .open();
                            }
                        },
                        {
                            type: 'textbox',
                            name: 'caption',
                            label: 'Подпись к фотографии'
                        }
                    ],
                    onsubmit: function( e ) {
                        var cap = '';
                        if(e.data.caption!=''){
                            cap = '<figcaption>'+e.data.caption+'</figcaption>';
                        }
                        editor.insertContent('<figure class="image image--full"><div class="image__wrap"><img src="'+image+'" alt=""></div>'+cap+'</figure><br>');
                    }
                });
            }
        });
    });
})();