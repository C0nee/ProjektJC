<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action=""method="post" enctype="multipart/form-data">

    
        <label for="uploadedFileInput"></label>
        <input type="file"name="uploaded file" id="uploadedFileInput"><br>
        <input type="submit" value="Wyślij Plik">
    </form>
        <?php
        if(isset($POST['submit'])){
           // echo "witaj świat";
           // var_dump(($_FILES));
           $sourceFileName = $_FILES['uploadedFile']['name'];
           $tempURL = $_FILES['uploadedFile']['tmp_name'];
           $targetDir = "img/";
           $targetURL = $targetDir . $sourceFileName;
           move_uploaded_file($tempURL,$targetURL);

        }
?>
    
</body>
</html>