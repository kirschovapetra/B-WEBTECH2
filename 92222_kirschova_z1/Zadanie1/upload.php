<!DOCTYPE html>
<html lang="sk">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Upload</title>
    </head>
    <body>
        <header>
            <h1>ZADANIE 1 - NAHRANIE SÚBORU</h1>
            <nav>
                <ul>
                    <li class="menu-item1">
                        <a href="index.php">Zobraziť súbory</a>
                    </li>
                    <li class="menu-item2">
                        <a href="upload.php">Nahrať súbor</a>
                    </li>
                </ul>
            </nav>
        </header>
        <section id="main-section">
            <!--upload suboru podla W3Schools: https://www.w3schools.com/php/php_file_upload.asp -->
            <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                <div class="form-item">
                    <label for="selectedFile">Vyberte súbor<br></label>
                    <input type="file" name="selectedFile" id="selectedFile">
                    <label for="saveAs"><br>Uložiť ako<br></label>
                    <input type="text" name="saveAs" id="saveAs">
                </div>
                <div class="submit-item">
                    <input type="submit" value="Nahrať" name="submit">
                </div>
            </form>
        </section>
        <footer>
            Copyright &copy; 2020 Petra Kirschová<br>
            Fakulta elektrotechniky a informatiky Slovenskej technickej univerzity v Bratislave
        </footer>
    </body>
</html>













