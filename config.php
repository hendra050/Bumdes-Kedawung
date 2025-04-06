<?php

if (!defined('BASE_URL')) {
    define('BASE_URL', '/BUMDES-KEDAWUNG/'); 
}

// Path untuk asset
if (!defined('ASSETS_URL')) {
    define('ASSETS_URL', BASE_URL . 'assets/');
}

if (!defined('IMG_URL')) {
    define('IMG_URL', BASE_URL . 'gambar/'); 
}

if (!defined('CSS_URL')) {
    define('CSS_URL', ASSETS_URL . 'css/');
}

if (!defined('JS_URL')) {
    define('JS_URL', ASSETS_URL . 'js/');
}

//path untuk page
if (!defined('MANAJEMEN_URL')) {
    define('MANAJEMEN_URL', BASE_URL . 'manajemen/');
}
if (!defined('PERTASHOP_URL')) {
    define('PERTASHOP_URL', BASE_URL . 'pertashop/');
}
if (!defined('PETERNAKAN_URL')) {
    define('PETERNAKAN_URL', BASE_URL . 'peternakan/');
}
if (!defined('ADMIN_URL')) {
    define('ADMIN_URL', BASE_URL . 'admin/');
}
if (!defined('BELUM_URL')) {
    define('BELUM_URL', BASE_URL . 'belum_login/');
}