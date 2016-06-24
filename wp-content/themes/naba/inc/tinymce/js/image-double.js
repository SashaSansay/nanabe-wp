(function() {
    tinymce.PluginManager.add('image_double_plugin', function( editor, url ) {

        editor.addButton('image_double_plugin', {
            text: 'Два изображения',
            icon: 'image',
            onclick: function() {
                var image1 = '';
                var image2 = '';
                editor.windowManager.open( {
                    title: 'Вставить два изображения',
                    body: [
                        {
                            type: 'button',
                            name: 'image_button',
                            label: 'Изображение левое',
                            library: { type: 'image' },
                            text: 'Выбрать левое изображение',
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
                                        image1 = attachment.url;
                                    })
                                    .open();
                            }
                        },
                        {
                            type: 'button',
                            name: 'image_button',
                            label: 'Изображение правое',
                            text: 'Выбрать правое изображение',
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
                                        image2 = attachment.url;
                                    })
                                    .open();
                            }
                        }
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent('<figure class="image image--half"><img src="'+image1+'"><img src="'+image2+'"></figure><br>');
                    }
                });
            }
        });
    });
})();