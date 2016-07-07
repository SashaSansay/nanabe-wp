(function() {
    tinymce.PluginManager.add('image_organizer_plugin', function( editor, url ) {
        var image = '';
        editor.addButton('image_organizer_plugin', {
            text: 'Добавить организатора',
            icon: 'image',
            onclick: function() {
                var image = '';
                editor.windowManager.open( {
                    title: 'Добавить организатора',
                    body: [
                        {
                            type: 'button',
                            name: 'image_button',
                            label: 'Изображение',
                            library: { type: 'image' },
                            text: 'Выбрать изображениt',
                            onclick: function(){
                                var frame = wp.media({
                                        title: 'Выберите изображение',
                                        button: {
                                            text: 'Выбрать'
                                        },
                                        multiple: false
                                    })
                                    .on('select',function(){
                                        var selection = frame.state().get('selection').first().toJSON();
                                        image = selection.url;
                                    })
                                    .open();
                            }
                        },
                        {
                            type: 'textbox',
                            name: 'title',
                            label: 'Имя организатора'
                        },
                        {
                            type: 'textbox',
                            name: 'subline',
                            label: 'Описание'
                        },
                        {
                            type: 'textbox',
                            name: 'phone',
                            label: 'Телефон организатора'
                        },
                        {
                            type: 'textbox',
                            name: 'url',
                            label: 'URL адрес организатора'
                        }
                    ],
                    onsubmit: function( e ) {
                        var img_content = '<h4>Организатор:</h4>';
                        img_content += '<figure class="image--organizer"><span class="image__wrap"><img src="'+image+'" class="img--float-left" alt=""></span>';
                        img_content += '<figcaption class="image__title image__title--organizer">'+ e.data.title+'<span class="grey">'+ e.data.subline+'</span>';
                        img_content += e.data.phone+'<br>'+ e.data.url +'</figcaption></figure><br>';
                        editor.insertContent(img_content);
                    }
                });
            }
        });
    });
})();