(function() {
    tinymce.PluginManager.add('speech_plugin', function( editor, url ) {
        var image = '';
        editor.addButton('speech_plugin', {
            text: 'Прямая речь',
            icon: 'blockquote',
            onclick: function() {
                var image = '';
                editor.windowManager.open( {
                    title: 'Вставить блок прямой речи',
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
                                        var selection = frame.state().get('selection').first().toJSON();
                                        image = selection.url;
                                    })
                                    .open();
                            }
                        },
                        {
                            type: 'textbox',
                            name: 'text',
                            multiline: true,
                            label: 'Текст прямой речи'
                        },
                        {
                            type: 'textbox',
                            name: 'title',
                            label: 'Имя респондента'
                        },
                        {
                            type: 'textbox',
                            name: 'subline',
                            label: 'Подпись респондента'
                        }
                    ],
                    onsubmit: function( e ) {
                        var img_content = '<figure class="speech"><span class="speech__top">&nbsp;</span>';
                        img_content +='<span class="speech__bottom">&nbsp;</span>';
                        if(typeof image === "string" && image != ""){
                            img_content += '<span class="speech__img"><img src="'+image+'" alt=""></span>';
                        }
                        if(e.data.title!=""){
                            img_content += '<span class="speech__big">'+ e.data.title+'</span>';
                        }
                        if(e.data.subline!=""){
                            img_content += '<span class="speech__small">'+ e.data.subline+'</span>';
                        }
                        img_content += '<p>'+e.data.text+'</p>';
                        img_content += '<span class="clear"></span>';
                        img_content += '</figure><br>';
                        editor.insertContent(img_content);
                    }
                });
            }
        });
    });
})();