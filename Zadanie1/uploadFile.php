<?php
require "config.php";

if(isset($_POST["submit"])) {

    $fileNameOriginal = basename($_FILES["selectedFile"]["name"]);
    $fileNameNew = ($_POST["saveAs"]) ? $_POST["saveAs"] : pathinfo($fileNameOriginal)['filename'];
    $fileNameType = pathinfo($fileNameOriginal)['extension'];

    $fileNameFull = $defaultPath . $fileNameNew . '.' . $fileNameType;

    //ak existuje subor s rovnakym nazvom, prida sa k jeho nazvu poradove cislo (napr text.txt -> text (1).txt)
    if (file_exists($fileNameFull)) {
        $existingFiles = glob($defaultPath . $fileNameNew ."*".$fileNameType);
        $existingFilesCount = sizeof($existingFiles);
        $fileNameFull = $defaultPath . $fileNameNew . ' (' . $existingFilesCount .')' . '.'. $fileNameType;
        $fileNameToPrint = $fileNameNew . ' (' . $existingFilesCount .')' . '.'. $fileNameType;
    }
    else {
        $fileNameToPrint = $fileNameNew . '.' . $fileNameType;
    }

    //uspesne nahranie, presmerovanie na index.php
    if (move_uploaded_file($_FILES["selectedFile"]["tmp_name"], $fileNameFull)) {
        echo "Súbor '" . $fileNameToPrint . "' bol úspešne nahraný.";
        header( "refresh:2; url=index.php" );
    }
    //neuspesne nahranie, presmerovanie na stranku upload.php
    else {
        echo "Nepodarilo sa nahrať súbor.";
        header( "refresh:2; url=upload.php" );
    }
}

?>