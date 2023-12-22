<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>page de test</h1>

    <?php
    if(isset($error)){
        echo $error;
    }
    ?>
    <form method="post">
        <label for="name">Nom</label>
        <input type="text" id="name" name="name">
        <label for="avis">avis</label>
        <textarea name="avis" id="avis" rows="6"></textarea>
        <button>envoyer</button>
    </form>
</body>
</html>