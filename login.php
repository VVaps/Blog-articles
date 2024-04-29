<?php
// Same as error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();

require_once('db.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $request = 'SELECT * FROM users WHERE email = "' . $_POST['email'] . '" AND password="' . $_POST['password'] . '"';
    $result = $mysqli->query($request);

    if ($result->num_rows == 0) {
        $error = 'Votre combinaison email/mdp est invalide';
    } else {
        $row = $result->fetch_assoc();
        $_SESSION['is_connected'] = true;
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['pseudo'] = $row['pseudo'];
    }
}
?>

<html>
<?php require_once('header.php'); ?>

<body>
    <div class="container">
        <p>Bonjour</p>
        <a href="index.php">Retour</a>

        <?php if (!isset($_SESSION['is_connected'])) : ?>
            <form action="login.php" method="post">
                <div><label>Email <input type="email" name="email" /></label></div>
                <div><label>Password <input type="password" name="password" /></label></div>
                <div><input type="submit" value="valider" /></div>
                <?php if (isset($error)) : ?>
                    <p class="error"><?= $error ?></p>
                <?php endif; ?>
            </form>
        <?php else : ?>
            <p>Vous êtes connecté <?= $_SESSION['pseudo'] ?> !</p>
        <?php endif; ?>
        <a href="signin.php"> Inscrivez-vous ! </a>
        <a href="logout.php"> Déconnectez-vous !</a>
        <a href="articles.php"> Nos articles ! </a>


    </div>
</body>

</html>