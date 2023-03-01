<?php 
class Post{
    static function upload(string $tempFileName){
        //Deklarujemy folder do zapisu obrazów
        $targetDir = "/img";
        $imginfo = @getimagesize($tempFileName);
//jesli imginfo nie jest tablca to nie jest obrzem
        if (!is_array($imginfo)) {
            die("nie jest obrazek");
            //sprawdz czy mamy doczynienia z obrazem
        }
        //losowy ciag znakow z dokaldnoscia do ms
        $randomNumber = rand(10000,99999) . hrtime(true);
        //tworzymy docelowy url pliku graficznego na serwerze
          //wygeneruj hash - nową nazwę pliku
          $hash = hash("sha256", $randomNumber);
        $newFileName = $targetDir . $hash . ".webp";
        if (file_exists($newFileName)) {
            die("JEST PLIK");
        }
        $imageString = file_get_contents($tempFileName);
        //generujemy obraz jako obiekt klasy img
        $gdImage = @imagecreatefromstring($imageString);
        imagewebp($gdImage, $tempFileName);
//uzyj globalnego połączenia
global $db;
$dateTime = date("Y-m-d H:i:s");
        $query = $db->prepare("INSERT INTO post VALUES(NULL, ?, ?)");
        $dbTimestamp = date("Y-m-d H:i:s");
        //zapisz dane do bazy
        $query->bind_param("ss", $dbTimestamp, $newFileName);
        if(!$query->execute()){
            die("Błąd zapisu do bazy danych");
}
    }
}


?>