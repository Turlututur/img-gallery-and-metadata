<?php
/**
 * Template de la page d'implementations
 * 
 * @category Templates
 * @package  TechnicalPageTemplate
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

?>

<!DOCTYPE HTML PUBLIC >

<head>
    <title>Gallerie en ligne</title>
    <link href="Src/Styles/GlobalStyle.css" rel="stylesheet">
    <link href="Src/Styles/GallerieStyle.css" rel="stylesheet">

    <meta property="og:type" content="image"/>
    <meta property="og:url" content= <?php echo(
        isset(
            $_SERVER['HTTPS']
        ) 
            && $_SERVER['HTTPS'] === 'on' 
            ? "https" : "http"
            ) 
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?> />

</head>

    </body>

    <div id="menu-form">
        <form method="POST">
            <button 
            class="home"
            type="submit" 
            value="accueil" 
            value="true" 
            name="accueil"> 
                Accueil 
            </button>
        </form>

        <form method="POST">
            <button 
            class="tech" 
            type="submit" 
            value="technicalpage" 
            value="true" 
            name="technicalpage"> 
            Implementation 
        </button>
        </form>

        <?php
        if (!isset($_SESSION["username"])) {
            $content = "<form method=\"POST\">
                <label>Nom d'utilisateur : </label> 
                <input 
                type=\"text\" 
                placeholder=\"Entrez votre nom\" 
                name=\"username\" required> 
                <label>Mot de passe : </label> 
                <input 
                type=\"password\" 
                placeholder=\"Entrez votre mot de passe\" 
                name=\"mdp\" required> 
            
            <button type=\"submit\">Se connecter</button>  
        </form>";
        } else {
            $content = "<form method=\"POST\" >
                <button 
                class=\"exit\" 
                type=\"submit\" 
                placeholder=\"Unlogin\" 
                value=\"true\" 
                name=\"unlogin\"> 
                Se déconnecter 
                </button>
            </form>";
        }

        echo $content;
        ?>
    </div>

    </div>


    <h1>  Page sur l'implémentation  </h1>
    <p>Devoir réalisé par 
        Alexandre PIGNARD 21701890 et 
        Arthur BOCAGE 21806332</p>
    <p>Afin d'experimenter toutes les fonctionnalités du site, 
        un compte vous est fourni : 'jml', 
        son mot de passe est 'toto'.</p>
    </br>
    <h1>Répartition du travail</h1>
    <h2>Alexandre Pignard</h2>
        <ul>
            <li><p>Architecture du site</p></li>
            <li><p>Ajout d'images AJAX via requête XHTML.</p></li>
            <li><p>Authentification.</p></li>
            <li><p>Première implémentation de la carte google</p></li>
            <li><p>CSS et styles du site.</p></li>
        </ul>
    <h2>Arthur Bocage</h2>

    <ul>
        <li><p>Mise en forme de la grille.</p></li>
        <li><p>Ajout d'images (sans AJAX, retiré par la suite).</p></li>
        <li><p>Lecture et affichage des métadonnées.</p></li>
        <li><p>Gestion des erreurs dans le cas où une image n'a pas de métadonnées 
            ou dans le cas où son format n'est pas pris en charge.</p></li>
        <li><p>Formulaire de modification des métadonnées.</p></li>
        <li><p>Amélioration de l'implémentation de la carte Google.</p></li>
        <li><p>Suppression des images.</p></li>
        <li><p>CSS et styles du site.</p></li>
    </ul>

    </body>

</html>