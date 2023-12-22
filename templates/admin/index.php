<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<body>
    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-start">
            <a href="/PHP/portfolio/add" class="btn btn-outline-success me-2" >Nouvel article</a>
            <a href="/PHP/portfolio/logout" class="btn btn-sm btn-outline-secondary me-2" >Déconnexion</a>
            <a href="/PHP/portfolio/" class="btn btn-outline-success me-2" > Acceuil </a>
        </form>
    </nav>
    <div class="container mx-auto p-5">
    <?php if ($isLoggedIn):?>
            <div class="alert alert-success">
                Bonjour <?php echo $_SESSION['user']->getUsername(); ?> !
        </div>
        <?php endif;?>
        <h1 class="pb-5">Mon coin admin</h1>
        <div class="articles p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>CREATED DATE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tboddy>
                    <?php foreach($projects as $project): ?>
                    <tr>
                        <td>
                            <?php echo $project->getId(); ?>
                        </td>
                        <td>
                            <?php echo $project->getTitle(); ?>
                        </td>
                        <td>
                            <?php echo $project->getCreatedAt()->format('d.m.Y'); ?>
                        </td>
                        <td>
                            <a href="/PHP/portfolio/edit?id=<?php echo $project->getId(); ?>" class="btn btn-light btn-sm">Editer</a> -
                            <a href="/PHP/portfolio/delete?id=<?php echo $project->getId(); ?>" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>