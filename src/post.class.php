<?php 
class Post{
    private int $id;
    private string $fileName;
    private string $timeStamp;

    function __construct(int $i, string $f, string $t)
    {
        $this ->id = $i;
        $this ->fileName = $f;
        $this->timeStamp = $t;
    }
    public function getFilename(): string{
        return $this->fileName;
    }
    public function getTimeStamp() : string{
        return $this->timeStamp;
    }
    static function getLast(): Post {
        //odwołuje sie do bazy danych
         global $db;
         //przygotuj kwerende do bazy danych
         $query = $db->prepare("SELECT * FROM post ORDER BY timeStamp DESC LIMIT 1");
         //wykonaj kwerende
         $query->execute();
         //pobierz wynik
         $result = $query->get_result();
         //przetwarzanie - bez petni bo bedzie tylko jeden
         $row = $result->fetch_assoc();
         //tworzenie obiektu
         $p = new Post($row['id'],$row['fileName'],$row['timeStamp']);
         //zwracanie obiektu
         return $p;
    }
static function getPage(int $pageNumber = 1 ,int $postsPerPage = 10){
    global $db;
    $query = $db->prepare("SELECT * FROM post ORDER BY TimeStamp DESC LIMIT ? OFFSET ?");
    $offset = ($pageNumber-1)*$postsPerPage;
    $query -> bind_param('ii',$postsPerPage, $offset);
    $query->execute();
    $result = $query->get_result();
    $postsArray = array();
    while($row = $result->fetch_assoc()){
        $post = new Post($row['ID'],$row['FileName'],$row['TimeStamp']);
        array_push($postsArray,$post);
    }
    return $postsArray;
}
    static function upload(string $tempFileName) {
        //deklarujemy folder do którego będą zaczytywane obrazy
        $targetDir = "img/";
        //sprawdź czy mamy do czynienia z obrazem
        $imgInfo = getimagesize($tempFileName);
        //jeżeli $imgInfo nie jest tablicą to nie jest to obraz
        if(!is_array($imgInfo)) {
            die("BŁĄD: Przekazany plik nie jest obrazem!");
        }
        //generujemy losową liczbę w formie
        //5 losowych cyfr + znacznik czasu z dokładnością do ms
        $randomNumber = rand(10000, 99999) . hrtime(true);
        //wygeneruj hash - nową nazwę pliku
        $hash = hash("sha256", $randomNumber);
        //tworzymy docelowy url pliku graficznego na serwerze
        $newFileName = $targetDir . $hash . ".webp";
        //sprawdź czy plik przypadkiem już nie istnieje
        if(file_exists($newFileName)) {
            die("BŁĄD: Podany plik już istnieje!");
        }
        //zaczytujemy cały obraz z folderu tymczasowego do stringa
        $imageString = file_get_contents($tempFileName);
        //generujemy obraz jako obiekt klasy GDImage
        //@ przed nazwa funkcji powoduje zignorowanie ostrzeżeń
        $gdImage = @imagecreatefromstring($imageString);
        //zapisujemy w formacie webp
        imagewebp($gdImage, $newFileName);

        //użyj globalnego połączenia
        global $db;
        //stwórz kwerendę
        $query = $db->prepare("INSERT INTO post VALUES(NULL, ?, ?)");
        //przygotuj znacznik czasu dla bazy danych
        $dbTimestamp = date("Y-m-d H:i:s");
        //zapisz dane do bazy
        $query->bind_param("ss", $dbTimestamp, $newFileName);
        if(!$query->execute())
            die("Błąd zapisu do bazy danych");

    }

  
}


?>