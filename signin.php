<?php

require_once('db.php');

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['pseudo'])) {
    $request = 'INSERT INTO users (email, password, pseudo) VALUES ("' . $_POST['email'] . '", "' . $_POST['password'] . '","' . $_POST['pseudo'] . '");';
    $mysqli->query($request);
}

?>

<html>
<?php require_once('header.php'); ?>

<body>
    <div class="container">
        <p>Bonjour</p>
        <a href="index.php">Retour</a>
        <form action="signin.php" method="post">
            <div><label>Pseudo <input type="pseudo" name="pseudo" /></label></div>
            <div><label>Email <input type="email" name="email" /></label></div>
            <div><label>Password <input type="password" name="password" /></label></div>
            <div><input type="submit" value="valider" /></div>
            <?php if (isset($_POST['email']) && isset($_POST['password'])) : ?>
                <p> Bravo tu as crée un compte !</p>
            <?php endif; ?>

    </div>
</body>

</html>