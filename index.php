<?php

use data\DataAccess;
include_once('data/DataAccess.php');

use control\{Controllers, Presenter};
include_once('control/Controllers.php');
include_once('control/Presenter.php');

use service\AnnoncesChecking;
include_once('service/AnnoncesChecking.php');

use gui\{Layout, ViewLogin, ViewAnnonces, ViewPost};
include_once('gui/Layout.php');
include_once('gui/ViewLogin.php');
include_once('gui/ViewAnnonces.php');
include_once('gui/ViewPost.php');

$data = null;
try {
    $data = new DataAccess(new PDO(
        'mysql:host=mysql-archlog.alwaysdata.net;dbname=archlog_db',
        'archlog',
        'd4pB2j4gF6AMxLRF7X53'
    ));
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    die();
}

$controller = new Controllers();
$annoncesCheck = new AnnoncesChecking();
$presenter = new Presenter($annoncesCheck);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ('/annonces/' == $uri || '/annonces/index.php' == $uri) {
    $viewLogin = new ViewLogin(new Layout('gui/layout.html'));
    $viewLogin->display();
} else if (
    '/annonces/index.php/annonces' == $uri
    && isset($_POST['LOGIN']) && isset($_POST['PASSWORD'])
) {
    $controller->annoncesAction($_POST['LOGIN'], $_POST['PASSWORD'], $data, $annoncesCheck);
    $vueAnnonces = new ViewAnnonces(new Layout('gui/layout.html'), $_POST['LOGIN'], $presenter);
    $vueAnnonces->display();
} else if (
    '/annonces/index.php/post' == $uri
    && isset($_GET['ID'])
) {
    $controller->postAction($_GET['ID'], $data, $annoncesCheck);
    $vuePost = new ViewPost(new Layout('gui/layout.html'), $presenter);
    $vuePost->display();
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>My Page Not Found</h1></body></html>';
}

?>