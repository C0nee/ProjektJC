<?php
require_once('./../src/config.php');

use Steampixel\Route;

Route::add('/', function(){
    //zapisywanie obrazków
    global $twig;
    $postArray = Post::getPage();
    $twigData = array("postArray" => $postArray,
                        "pageTitle" =>"strona główna");
    $twig->display("index.html.twig",$twigData);
});
Route::add('/upload', function(){
    //strona do wgrywania
    global $twig;
    $twigData = array("pageTitle" => "Wgraj mema");
    $twig->display("upload.html.twig",$twigData);
});
Route::add('/upload',function(){
    global $twig;
    if(isset($_POST['submit']))  {
        Post::upload($_FILES['uploadedFile']['tmp_name']);
    };
    //TODO: zmienić na ścieżkę względną
    header("Location: http://localhost/ProjektJC/pub");
},'post');

Route::run('/ProjektJC/pub')
?>