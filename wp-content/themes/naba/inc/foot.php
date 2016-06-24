<footer class="footer--main">
    <img src="<?=get_template_directory_uri();?>/build/img/logo.small.svg" alt="">
    <ul class="menu menu--footer">
        <li class="menu__item menu__item--footer">
            <a href="#" class="menu__link menu__link--footer">
                О проекте
            </a>
        </li>
        <li class="menu__item menu__item--footer">
            <a href="#" class="menu__link menu__link--footer">
                Реклама на сайте
            </a>
        </li>
        <li class="menu__item menu__item--footer">
            <a href="<?=get_permalink(169);?>" class="menu__link menu__link--footer">
                <?=get_the_title(169);?>
            </a>
        </li>
    </ul>
    <div class="footer__info">
        Использование материалов разрешено только с предварительного согласия правообладателей.<br>
        Сайт может содержать контент, не предназначенный для лиц младше 18-ти лет.
    </div>
    <a href="https://roky.rocks" target="_blank" class="footer__by">Site by Roky</a>
</footer>
<script>
    var ajaxUrl = '<?=admin_url('admin-ajax.php');?>';
</script>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter38106225 = new Ya.Metrika({ id:38106225, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/38106225" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<?php
wp_footer();
?>