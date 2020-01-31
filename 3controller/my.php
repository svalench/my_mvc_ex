<?php
require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';
print_r("this my.php file!!!!");
print_r($_GET);

$loader = new \Twig\Loader\ArrayLoader([
    'index' => 'Hello {{ name }}!',
]);
$twig = new \Twig\Environment($loader);

echo $twig->render('index', ['name' => 'Fabien']);
?>