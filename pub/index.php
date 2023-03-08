<?php
require_once('./../src/config.php');

use Steampixel\Route;

Route::add('/', function(){
    //zapisywanie obrazków
    global $twig;
    
    $twig->display("index.html.twig");
});
Route::add('/upload', function(){
    //strona do wgrywania
    global $twig;
    $twig->display("upload.html.twig");
});
Route::add('/upload',function(){
    if(isset($_POST['submit']))  {
        Post::upload($_FILES['uploadedFile']['tmp_name']);
    };
},'post');
$twig->display("index.html.twig");
Route::run('/ProjektJC/pub')
?>