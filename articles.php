<?php

ini_set('display_errors', true);
session_start();

require_once('db.php');

if (isset($_POST['content'])) {
    if (isset($_GET['updated_id'])) {
        $request = 'UPDATE articles SET content="' . $_POST['content'] . '", titre="' . $_POST['titre'] . '" WHERE id=' . $_GET['updated_id'] . ';';
        $message = 'Votre article a été mise à jour !';
    } else {
        $request = 'INSERT INTO articles (content, titre, user_id) VALUES ("' . $_POST['content'] . '","' . $_POST['titre'] . '","' . $_SESSION['user_id'] . '");';
        $message = 'Votre article a été ajouté !';
    }
    $mysqli->query($request);
}

if (isset($_GET['delete_id'])) {
    $request_read = 'DELETE FROM articles WHERE id="' . $_GET['delete_id'] . '";';
    $mysqli->query($request_read);
}

$request_read = 'SELECT * FROM articles WHERE user_id="' . $_SESSION['user_id'] . '";';
$results = $mysqli->query($request_read);

?>

<?php if (isset($_SESSION['is_connected'])) : ?>
    <h1>Voici la page des articles !</h1>
    <?php if (isset($message)) : ?>
        <p class="success"><?= $message ?></p>
    <?php endif; ?>
    <form action="articles.php" method="post">
        <p><input name="titre" type="text" placeholder="titre" /></p>
        <p><textarea name="content" rows="20" cols="40" placeholder="Écrivez ici..."></textarea></p>
        <p><input type="submit" value="Envoyer" /></p>
    </form>

    <h2>Mes articles déjà écrits :</h2>
    <ul>
        <?php foreach ($results as $row) : ?>
            <li><a href="article.php?id=<?= $row['id'] ?>"><?= $row['titre'] ?></a> <a href=" articles.php?delete_id=<?= $row['id'] ?>">X</a></li>
        <?php endforeach; ?>
    </ul>

<?php else : ?>
    <a href="login.php">Connectez-vous</a>
<?php endif; ?>