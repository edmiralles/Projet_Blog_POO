
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
    <body>

    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-start">
            <a href="/PHP/portfolio/add" class="btn btn-outline-success me-2" >Nouvel article</a>
            <a href="/PHP/portfolio/logout" class="btn btn-sm btn-outline-secondary me-2" >Déconnexion</a>
            <a href="/PHP/portfolio/admin" class="btn btn-outline-success me-2" > admin </a>
        </form>
    </nav>
    <div class="container mx-auto p-5">
        <h1 class="pb-5">Mon merveilleux blog</h1>
        <?php if ($isLoggedIn):?>
            <div class="alert alert-success">
                Bonjour <?php echo $_SESSION['user']->getUsername(); ?> !
        </div>
        <?php endif;?>
        <div class="articles p-5">
                <?php foreach($projects as $project): ?>
                    <article class="pb-5">
                        <!-- Titre de l'article -->
                        <h1><?php echo $project->getTitle(); ?></h1>

                        <!-- Informations sur l'article -->
                        <small class="d-block text-secondary pb-2">
                            Posté le <?php echo $project->getCreatedAt()->format('d.m.Y'); ?>
                        </small>

                        <!-- Image de couverture -->
                            <img
                                src="<?php echo $project->getFolderPreview(); ?>"
                                alt="<?php echo $project->getTitle(); ?>"
                                class="img-fluid rounded"
                            >

                        <!-- Contenu tronqué de l'article -->
                        <p><?php echo mb_strimwidth($project->getDescription(), 0, 75, '...'); ?></p>

                        <a href="/PHP/portfolio/article?id=<?php echo $project->getId(); ?>" class="btn btn-sm btn-primary">
                            Lire la suite...
                        </a>
                    </article>
                <?php endforeach; ?>
        </div>
    </div>
    </body>
</html>