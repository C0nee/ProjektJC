<?php 
require('./../src/config.php');

?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="uploadedFileInput">
            <input type="file" name="uploadedFile" id="uploadedFileInput"><br />
            <input type="submit" value="Wyślij Plik" name="submit">
    </form>
    <?php 
    if (isset($_POST['submit'])) {
        Post::upload($_FILES['uploadedFile']['tmp_name']);
    }
    ?>