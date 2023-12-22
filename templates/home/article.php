<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
    <body>

    <div class="text-center pt-5">
        <h1>Mon fabuleux article</h1>
    </div>
    <div class="articles p-5">       
                <article class="pb-5">
                    <!-- Titre de l'article -->
                    <h1><?php echo $article->getTitle(); ?></h1>

                    <!-- Informations sur l'article -->
                    <small class="d-block text-secondary pb-2">
                        Posté le <?php echo $article->getCreatedAt()->format('d.m.Y'); ?>
                    </small>

                    <!-- Image de couverture -->
                        <img
                            src="<?php echo $article->getFolderPreview(); ?>"
                            alt="<?php echo $article->getTitle(); ?>"
                            class="img-fluid rounded"
                        >

                    <!-- Contenu tronqué de l'article -->
                    <p><?php echo $article->getDescription(); ?></p>

                </article>
    </div>
    </body>
</html>