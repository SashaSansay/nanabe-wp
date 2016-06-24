(function() {
    tinymce.PluginManager.add('blockqoute_plugin', function( editor, url ) {
        editor.addButton('blockqoute_plugin', {
            text: 'Цитата',
            icon: 'blockquote',
            onclick: function() {
                var image = '';
                editor.windowManager.open( {
                    title: 'Вставить цитату',
                    body: [
                        {
                            type: 'textbox',
                            name: 'quote',
                            label: 'Цитата',
                            multiline: true
                        },
                        {
                            type: 'textbox',
                            name: 'caption',
                            label: 'Подпись к цитате'
                        }
                    ],
                    onsubmit: function( e ) {
                        var cap = '';
                        if(e.data.caption!=''){
                            cap = '<span class="blockquote__title">'+e.data.caption+'</span>';
                        }
                        editor.insertContent('<blockquote><span class="blockqoute__text">'+e.data.quote+'</span>'+cap+'</blockquote><br>');
                    }
                });
            }
        });
    });
})();