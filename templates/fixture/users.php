<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body{
        padding: 5px
    }
    </style>
</head>
<body>
    <h1>Ajout de users</h1>

    <?php
    if(isset($success)):
    ?>
    <div class="alert alert-success">
        <?php echo $success; ?>
    </div>
    <?php
        unset($success);
        endif
    ?>

</body>
</html>
