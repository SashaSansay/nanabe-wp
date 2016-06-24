(function() {
    tinymce.PluginManager.add('image_slider_plugin', function( editor, url ) {
        var images = [];
        editor.addButton('image_slider_plugin', {
            text: 'Слайдер',
            icon: 'image',
            onclick: function() {
                var image = '';
                editor.windowManager.open( {
                    title: 'Вставить слайдер',
                    body: [
                        {
                            type: 'button',
                            name: 'image_button',
                            label: 'Изображение',
                            library: { type: 'image' },
                            text: 'Выбрать изображения',
                            onclick: function(){
                                var frame = wp.media({
                                        title: 'Выберите изображения',
                                        button: {
                                            text: 'Выбрать'
                                        },
                                        multiple: true
                                    })
                                    .on('select',function(){
                                        images = [];
                                        var selection = frame.state().get('selection');
                                        selection.each(function(attachment) {
                                            images.push(attachment.toJSON().url);
                                        });
                                    })
                                    .open();
                            }
                        }
                    ],
                    onsubmit: function( e ) {
                        var img_content = '';
                        images.forEach(function(img , i){
                           img_content += '<img src="'+img+'" alt="">';
                        });
                        editor.insertContent('<figure class="slider">'+img_content+'</figure><br>');
                        editor.execCommand('mceRepaint');
                    }
                });
            }
        });
    });
})();