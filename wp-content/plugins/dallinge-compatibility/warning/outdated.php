<!doctype html>
<html>
<head>
    <title>Outdated browser</title>
    <style>

        body {
            font-family: sans-serif;
            font-size: 1.1em;
            padding-left: 8%;
            padding-top: 5%;
            padding-right: 8%;
        }

        a {
            outline: none;
            text-decoration: none;
            border:0;
        }

        a img {
            border: 0;
        }

        .message{
            max-width: 700px;
        }

        .browsers {
            padding-top:50px;
            text-align: center;
        }

        .browsers .browser {
            height:200px;
            width:200px;
            float:left;
        }
    </style>



</head>
<body>

<?php
$available_languages = array("en", "fr", "it", "de");

$langs = dallinge_compatibility_prefered_language($available_languages, $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
?>


<?php if (array_key_exists('fr', $langs)): ?>

    <div class="message ">
        <h2><?php echo get_bloginfo('name'); ?> ne peut pas être affiché. </h2>

        <p>Votre navigateur est trop vieux pour afficher ce site correctement. Veuillez s'il vous plaît le mettre à jour
            ou
            télécharger un des navigateurs suivants. Merci !</p>
    </div>
<?php elseif (array_key_exists('de', $langs)): ?>

    <div class="message ">
        <h2><?php echo get_bloginfo('name'); ?> kann nicht angezeigt werden</h2>
        <p>Ihr Browser ist zu alt, um diese Seite korrekt anzuzeigen. Bitte aktualisieren Sie ihn oder laden Sie einen der folgenden Browser herunter. Danke.</p>
    </div>
<?php elseif (array_key_exists('it', $langs)): ?>

    <div class="message ">
        <h2><?php echo get_bloginfo('name'); ?> non può essere visualizzato</h2>
        <p>Il tuo browser è troppo vecchio per visualizzare correttamente questo sito. Si prega di aggiornarlo o
            scaricare
            uno dei seguenti browser. Grazie!</p>
    </div>
<?php else: ?>
    <div class="message ">
        <h2><?php echo get_bloginfo('name'); ?> can not be displayed. </h2>
        <p>Your browser is too old to display this site correcly. Please update it or download one of the following
            browsers.
            Thank you!</p>
    </div>
<?php endif; ?>


<div class="browsers">
    <div class="browser">
        <a href="https://www.google.fr/chrome/" alt="chrome">
            <img height="100" width="100" src="<?php echo plugin_dir_url(__FILE__) . 'imgs/firefox.png'; ?>"  alt="Firefox" />
            <br/>
            <a target="_blank" href="https://www.google.fr/chrome/" alt="chrome">Firefox</a>
    </div>
    <div class="browser">
        <a target="_blank" href="https://www.google.fr/chrome/" alt="chrome"> <img height="100" width="100"
                                                                   src="<?php echo plugin_dir_url(__FILE__) . 'imgs/chrome.png'; ?>"
                                                                   alt="Chrome" /></a>
        <br/>
        <a target="_blank" href="https://www.google.fr/chrome/" alt="chrome">Chrome</a>
    </div>
    <div class="browser">
        <a target="_blank" href="https://www.opera.com/fr" alt="opera"><img height="100" width="100"
                                                            src="<?php echo plugin_dir_url(__FILE__) . 'imgs/opera.png'; ?>"
                                                            alt="Opera"></a>
        <br/>
        <a target="_blank" href="https://www.opera.com/fr" alt="opera">Opera</a>
    </div>
</div>
</body>
</html>