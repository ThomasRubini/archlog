    <?php

use data\DataAccess;
include_once('data/DataAccess.php');

use control\{Controllers, AnnoncesCheckingPresenter, CommentsPresenter};
include_once('control/Controllers.php');
include_once('control/AnnoncesCheckingPresenter.php');
include_once('control/CommentsPresenter.php');

use service\{Login, AnnoncesChecking, Comments};
include_once('service/Login.php');
include_once('service/AnnoncesChecking.php');
include_once('service/Comments.php');

use gui\{Layout, ViewComment, ViewCommentSubmitted, ViewLogin, ViewAnnonces, ViewPost, ViewMyComments, ViewAnswerSubmitted};

include_once('gui/Layout.php');
include_once('gui/ViewLogin.php');
include_once('gui/ViewComment.php');
include_once('gui/ViewCommentSubmitted.php');
include_once('gui/ViewAnnonces.php');
include_once('gui/ViewPost.php');
include_once('gui/ViewMyComments.php');
include_once('gui/ViewAnswerSubmitted.php');

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

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

session_start();

if(isset($_POST["LOGIN"]) && isset($_POST["PASSWORD"])){
    $loginService = new Login();
    if( $loginService->authenticate($_POST["LOGIN"], $_POST["PASSWORD"], $data) ) {
        $_SESSION["LOGIN"] = $_POST["LOGIN"];
    }else{
        header("refresh:5;url=/annonces/index.php");
        echo 'Erreur de login et/ou de mot de passe (redirection automatique dans 5 sec.)';
        exit();
    }
}else if(!isset($_SESSION["LOGIN"]) && !('/annonces/' == $uri || '/annonces/index.php' == $uri)){
    header("refresh:5;url=/annonces/index.php");
    echo "Vous n'êtes pas authentifié. Redirection vers la page de login dans 5 secondes";
    exit();
}

if ('/annonces/' == $uri || '/annonces/index.php' == $uri) {
    $viewLogin = new ViewLogin(new Layout('gui/layout.html'));
    $viewLogin->display();
} else if (
    '/annonces/index.php/annonces' == $uri
) {
    $annoncesCheck = new AnnoncesChecking();
    $presenter = new AnnoncesCheckingPresenter($annoncesCheck);

    $controller->annoncesAction($data, $annoncesCheck);
    $vueAnnonces = new ViewAnnonces(new Layout('gui/layout.html'), $_SESSION['LOGIN'], $presenter);
    $vueAnnonces->display();
} else if (
    '/annonces/index.php/post' == $uri
    && isset($_GET['ID'])
) {
    $annoncesCheck = new AnnoncesChecking();
    $presenter = new AnnoncesCheckingPresenter($annoncesCheck);

    $controller->postAction($_GET['ID'], $data, $annoncesCheck);
    $vuePost = new ViewPost(new Layout('gui/layout.html'), $presenter);
    $vuePost->display();
} else if (
    '/annonces/index.php/comment' == $uri
    && isset($_GET['ID_ANNONCE'])
) {
    $viewComment = new ViewComment(new Layout('gui/layout.html'), $_GET["ID_ANNONCE"]);
    $viewComment->display();
} else if (
    '/annonces/index.php/submitComment' == $uri
    && isset($_POST["ANNONCE_ID"])
    && isset($_POST["TEXT"])
) {
    $comments = new Comments();

    $controller->commentSubmittedAction($_POST["ANNONCE_ID"], $_SESSION["LOGIN"], $_POST["TEXT"], $data, $comments);
    $viewComment = new ViewCommentSubmitted(new Layout('gui/layout.html'));
    $viewComment->display();
} else if (
    '/annonces/index.php/myComments' == $uri
) {
    $comments = new Comments();
    $commentsPresenter = new CommentsPresenter($comments);

    $controller->myCommentsAction($_SESSION["LOGIN"], $data, $comments);
    $viewComment = new ViewMyComments(new Layout('gui/layout.html'), $commentsPresenter);
    $viewComment->display();
} else if (
    '/annonces/index.php/submitAnswer' == $uri
    && isset($_POST["COMMENT_ID"])
    && isset($_POST["ANSWER_TEXT"])
) {
    $comments = new Comments();
    $commentsPresenter = new CommentsPresenter($comments);

    $controller->submitAnswerAction($_POST["COMMENT_ID"], $_POST["ANSWER_TEXT"], $data, $comments);
    $viewComment = new ViewAnswerSubmitted(new Layout('gui/layout.html'));
    $viewComment->display();
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>My Page Not Found</h1></body></html>';
}

?>