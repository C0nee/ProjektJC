<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEM</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="uploadedFileInput">
<input type="file" name="uploadedFile" id="uploadedFileInput"><br/>
<input type="submit" value="Wyślij Plik" name="submit">
</form>
<?php


if(isset($_POST['submit'])){


    //echo"<pre>";
    //var_dump($_FILES);


if(!is_array($imginfo)){
    die("nie jest obrazek");
//sprawdz czy mamy doczynienia z obrazem
$imginfo = getimagesize($tempURL);
}

$targetDir = "img/";
$sourceFileName =  $_FILES['uploadedFile']['name'];
$tempURL = $_FILES['uploadedFile']['tmp_name'];
//$sourceFileExtension = pathinfo($sourceFileName, PATHINFO_EXTENSION);
//$sourceFileExtension = strtolower($sourceFileExtension);
$newFileName = hash("sha256",$sourceFileName).hrtime(true) . "." . "webp";
$imageString= file_get_contents($tempURL);
//generujemy obraz jako obiekt klasy img
$gdImage= imagecreatefromstring($imageString);
$targetURL = $targetDir . $newFileName;
if(file_exists($targetURL)){
    die("JEST PLIK");
}
imagewebp($gdImage,$targetURL);




move_uploaded_file($tempURL , $targetURL);
}



?>


</body>
</html>
