<?php
    date_default_timezone_set('Europe/Paris');
    Locale::setDefault('fr_FR.utf-8');

    define("SECRET_APP", "aVidaSaoDoisDiasOCarnavalSaoTres");

    define("DB_HOST", "localhost:3306");
    define("DB_NAME", "forum");
    define("DB_USER", "root");
    define("DB_PASS", "");

    define("DEFAULT_CTRL", "home");
    define("DEFAULT_ACTION", "index");

    define("CSS_PATH", "public/css/");
    define("IMG_PATH", "public/img/");
    define("JS_PATH", "public/js/");
    define("VIEW_PATH", "view/");