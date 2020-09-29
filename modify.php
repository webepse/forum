<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header("LOCATION:index.php");
    }

    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
    }else{
        header("LOCATION:index.php");
    }

    require "connexion.php";
    $post = $bdd->prepare("SELECT * FROM post WHERE id=?");
    $post->execute([$id]);
    if($donPost = $post->fetch()){
        // test si le message appartient à notre utilisateur connecté
        if($_SESSION['id']!=$donPost['id_login']){
            header("LOCATION:index.php");
        }
    }else{
        header("LOCATION:index.php");
    }

    if(isset($_POST['message'])){
        if(!empty($_POST['message'])){
            $message=htmlspecialchars($_POST['message']);
            $update = $bdd->prepare("UPDATE post SET message=:mess WHERE id=:myid");
            $update->execute([
                ":mess"=>$message,
                ":myid"=>$id
            ]);
            $update->closeCursor();
            header("LOCATION:index.php?update=success");
        }else{
            header("LOCATION:modify.php?id=".$id);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>modifier</h1>
    <form action="modify.php?id=<?= $donPost['id'] ?>" method="POST">
        <div class="form-group">
            <textarea name="message" id="message" cols="30" rows="10"><?= $donPost['message'] ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="Modifier">
        </div>
    </form>
</body>
</html>