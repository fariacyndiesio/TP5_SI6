 <html>
    <head>
        <meta charset="UTF-8">
        <title>TP5</title>
    </head>
    <body>
        <table border="5px">
            <tr>
                <td>
                    <?php
                        /**
                         * Si la session existe alors on affiche un message de bienvenue et l'auteur
                         * peut créer un article et/ou se déconnecter.
                         * Il y a des url différents, d'une part si l'utilisateur est connecté on utilise:
                         * view/ et vue/ mais s'il n'est pas connecté alors on utilise articles/view/ et
                         * articles/vue/ sinon il y a une répétition dans l'url ce qui nous redirige vers 404 not found.
                         * 
                         * L'utilisateur connecté peut écrire un article ou se déconnecter et 
                         * l'utilisateur déconnecté peut s'inscrire ou se connecter.
                         */
                        if (isset($_SESSION['id_utilisateur'])){
                            echo"Bienvenue sur votre espace personnel";
                            echo '<td>'.'<a href="create"> Créer un article</a>'.'</td>';
                            echo '<td>'.'<a href=logout/> Déconnexion </a>'.'</td>';?>
                            
                            <tr>
                            <?php echo '<td>'.'<h4>'."Les themes :".'</h4>'.'</td>';
                            foreach ($theme as $theme): ?>
                                <td><?php echo $theme['nom'] ?>
                                <p><a href="view/<?php echo $theme['idTheme'] ?>">Voir les articles</a></p></td>
                            <?php endforeach ?>
                            </tr>
                            <tr>
                            <?php echo '<td>'.'<h4>'."Les auteurs : ".'</h4>'.'</td>';
                            foreach ($utilisateurs as $utilisateurs): ?>
                                <td><?php echo $utilisateurs['nom']." ".$utilisateurs['prenom']?>
                                <p><a href="vue/<?php echo $utilisateurs['id_utilisateur'] ?>">Voir les articles</a></p></td>
                            <?php endforeach ?> 
                            </tr>
                            <?php }
                            else {
                            echo"Vous n'êtes pas connecté"; ?>
                            <td><a href="articles/inscription/"> S'inscrire</a></td>
                            <td><a href="articles/connexion/"> Se connecter</a></td>
                            <tr>
                                <?php echo '<td>'.'<h4>'."Les themes :".'</h4>'.'</td>';
                                foreach ($theme as $theme): ?>
                                    <td><?php echo $theme['nom'] ?>
                                    <p><a href="articles/view/<?php echo $theme['idTheme'] ?>">Voir les articles</a></p></td>
                                <?php endforeach ?>
                            </tr>
                            <tr>
                                <?php echo '<td>'.'<h4>'."Les auteurs : ".'</h4>'.'</td>';
                                foreach ($utilisateurs as $utilisateurs): ?>
                                    <td><?php echo $utilisateurs['nom']." ".$utilisateurs['prenom']?>
                                    <p><a href="articles/vue/<?php echo $utilisateurs['id_utilisateur'] ?>">Voir les articles</a></p></td>
                                <?php endforeach ?> 
                            </tr>
                        <?php } ?>
                </td>               
            </tr>
        </table>
    </body>
</html>
