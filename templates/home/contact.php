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
    <h1>Contactez-nous!</h1>

    <?php
    if(isset($error)):
    ?>
    <div class="alert alert-danger">
        <?php echo $error; ?>
    </div>
    <?php
        unset($error);
        endif
    ?>

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
    <form method="post">
        <div class="mb-3">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name = "email">
                <div id="emailHelp" class="form-text mb-3">We'll never share your email with anyone else.</div>
            
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="content" name="content"></textarea>
                <label for="content">Deliver your message here</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>
