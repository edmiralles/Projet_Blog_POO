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
<div class="container p-3">
            <h1>Ajout d'un article</h1>
            <a href="/PHP/portfolio/admin">Retour</a>
            <form method="post" enctype="multipart/form-data">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if(isset($success)): ?>
                <div class="alert alert-success">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>
                <div class="mb-3">
                    <label for="title" class="form-label">titre</label>
                    <input type="text" class="form-control" id="title" name="title"
                        placeholder="ajoutez un titre" required="required">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"
                        placeholder="ajoutez une description" required="required"></textarea>
                </div>
                <div class="mb-3">
                    <label for="preview" class="form-label">Preview</label>
                    <input type="file" class="form-control" id="preview" name="preview" required="required">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
</body>
</html>