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

$targetDir = "img/";
$sourceFileName =  $_FILES['uploadedFile']['name'];
$tempURL = $_FILES['uploadedFile']['tmp_name'];
$targetURL = $targetDir . $sourceFileName;

if(file_exists($targetURL)){
    die("JEST PLIK");
}
//sprawdz czy mamy doczynienia z obrazem
$imginfo = getimagesize($tempURL);
if(!is_array($imginfo)){
    die("nie jest obrazek");
}





move_uploaded_file($tempURL , $targetURL);
}



?>


</body>
</html>
