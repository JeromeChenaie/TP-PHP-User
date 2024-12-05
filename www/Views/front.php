<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="<?= $description ?? "Description de la page" ?>">
        <title><?= $title ?? "Titre de la page" ?></title>
    </head>
    <body>
    <h1><?= $title ?? "Titre de la page" ?></h1>
    <?php include "../Views/" . $this->view; ?>
    </body>
</html>