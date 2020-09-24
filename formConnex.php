<?php
        if(isset($_GET['register'])){
            echo "<div class='success'>Vous êtes bien enregistré sur le site! connectez-vous! </div>";
        }
    ?>
    <form action="index.php" method="POST">
        <div>
            <label for="login">Login: </label>
            <input type="text" id="login" name="login">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <input type="submit" value="Connexion">
        </div>
        <?php
            if(isset($error)){
                echo "<div class='error'>".$error."</div>";
            }
        ?>
    </form>
    <div>
        <a href="inscription.php">Pas encore inscrit?</a>
    </div>