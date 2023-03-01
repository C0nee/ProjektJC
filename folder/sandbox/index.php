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
            <input type="file" name="uploadedFile" id="uploadedFileInput"><br />
            <input type="submit" value="Wyślij Plik" name="submit">
    </form>
    <?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbName = 'projektjc';
    $db = new mysqli($host, $username, $password, $dbName);
    if (isset($_POST['submit'])) {


        //echo"<pre>";
        //var_dump($_FILES);
        $sourceFileName =  $_FILES['uploadedFile']['name'];
        $tempURL = $_FILES['uploadedFile']['tmp_name'];
        $imginfo = @getimagesize($tempURL);

        if (!is_array($imginfo)) {
            die("nie jest obrazek");
            //sprawdz czy mamy doczynienia z obrazem

        }

        $targetDir = "img/";


        //$sourceFileExtension = pathinfo($sourceFileName, PATHINFO_EXTENSION);
        //$sourceFileExtension = strtolower($sourceFileExtension);
        $hash = hash("sha256", $sourceFileName . hrtime(true));
        $newFileName = $hash . ".webp";

        $imageString = file_get_contents($tempURL);
        //generujemy obraz jako obiekt klasy img
        $gdImage = @imagecreatefromstring($imageString);
        $targetURL = $targetDir . $newFileName;
        if (file_exists($targetURL)) {
            die("JEST PLIK");
        }
        imagewebp($gdImage, $targetURL);




        //move_uploaded_file($tempURL, $targetURL);
        $dateTime = date("Y-m-d H:i:s");
        $query = $db->prepare("INSERT INTO post VALUES(NULL, ?, ?)");
        $dbTimestamp = date("Y-m-d H:i:s");
        $query->bind_param("ss", $dbTimestamp, $hash);
        if(!$query->execute()){
            die("Błąd zapisu do bazy danych");
}
        //$query -> bind_param('ss',$dateTime,$hash);


        /*$sqlimage = "SELECT * FROM post ORDER BY TimeStamp ";
$result = mysqli_query($db,$sqlimage);
while($data = mysqli_fetch_assoc($result)){
?>
<img width="500px" height="500px" src="img/<?php echo $data['FileName'];?>">


<?php*/


       // $db->query($sql);
       // $db->close();
    }
    ?>


</body>

</html>