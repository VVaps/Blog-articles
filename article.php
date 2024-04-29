<?php

ini_set('display_errors', true);
session_start();

require_once('db.php');

$request_read = 'SELECT * FROM articles WHERE id="' . $_GET['id'] . '";';
$result = $mysqli->query($request_read);

$article = $result->fetch_assoc();

?>

<h1>Modifier un article</h1>

<form action="articles.php?updated_id=<?= $_GET['id'] ?>" method="post">
    <p><input name="titre" type="text" placeholder="titre" value="<?= $article['titre'] ?>" /></p>
    <p><textarea name="content" rows="20" cols="40" placeholder="Écrivez ici..."><?= $article['content'] ?></textarea></p>
    <p><input type="submit" value="Envoyer" /></p>
</form>