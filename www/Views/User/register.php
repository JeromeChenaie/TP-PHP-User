<?php
    if (!empty($errors)):
        echo '<ul>';
        foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach;
        echo '</ul>';
    endif;
?>

<form method="POST" action="">
    <label for="firstname">Prénom</label> <br>
    <input type="text" name="firstname" value="<?= $lastData['firstname'] ?? ''; ?>"> <br>
    <label for="lastname">Nom</label> <br>
    <input type="text" name="lastname" value="<?= $lastData['lastname'] ?? ''; ?>"> <br>
    <label for="email">E-mail</label> <br>
    <input type="email" name="email" value="<?= $lastData['email'] ?? ''; ?>"> <br>
    <label for="password">Mot de passe</label> <br>
    <input type="password" name="password"> <br>
    <label for="passwordConfirm">Confirmation du mot de passe</label> <br>
    <input type="password" name="passwordConfirm"> <br>
    <label for="country">Pays</label> <br>
    <select name="country">
        <option value="">Choisissez votre pays...</option>
        <option value="fr">France</option>
        <option value="de">Allemagne</option>
        <option value="us">États-Unis</option>
        <option value="gb">Royaume-Uni</option>
        <option value="it">Italie</option>
    </select> <br>
    <br>

    <button>S'inscrire</button>
</form>