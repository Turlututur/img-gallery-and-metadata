<?php 

/**
 * Template de la vue par défaut
 * 
 * @category Template
 * @package  DefaultTemplate
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
    <link href="Src/Styles/GallerieStyle.css" rel="stylesheet">
    <link href="Src/Styles/GlobalStyle.css" rel="stylesheet">
</head>
</body>
    
    <div id="menu-form">
        <form method="POST">
            <button class="home"
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
                <input type=\"password\" 
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
        $content .= "<h1>Voici une jolie gallerie d'images</h1>";
        echo $content;
        ?>
    </div>

    <?php

            
            $content = "<div class='gallerie'> ";
            $files = scandir('Src/Images');
            
            $protocol = strtolower(
                substr(
                    $_SERVER["SERVER_PROTOCOL"], 
                    0, 
                    strpos(
                        $_SERVER["SERVER_PROTOCOL"], 
                        '/'
                    )
                )
            ).'://';

            foreach ($files as $file) {
                $file_parts = pathinfo($file);
                if ($file_parts['extension'] === "jpg" 
                    || $file_parts['extension'] === "png" 
                    || $file_parts['extension'] === "jpeg" 
                    || $file_parts['extension'] === "gif"
                ) {
                    $content .=  "<div>";
                        $content .= "<a href=".$protocol. 
                        $_SERVER['SERVER_NAME'].
                        $_SERVER["REQUEST_URI"].
                        "?showcase=$file>";
                    $content .= "<figure>";
                    $content .= "<img src='Src/Images/$file' alt='Du texte'></img>";
                    $content .= "<figcaption>$file</figcaption>" ;
                    $content .= "</figure>";
                    $content .= "</a>";
                    $content .= "<span>Description lambda</span>";
                    $content .= "</div>";
                }
            }

            $content .= "</div>";
            ?>

        <?php
        //header("Location: ?page=page1");
        //die();

        if (isset($_SESSION["username"])) {
            $content .=
                    "<form method=\"POST\">
            <input type=\"file\" id=\"image\" accept=\"image/png, image/jpeg\">
            <input type=\"submit\" value=\"Submit\">
        </form>

        <script>function createProgress(){
            let progress_bar = document.createElement(\"progress\");
            document.body.appendChild(progress_bar);  
        }
        createProgress();


        function load(){
            console.log(document.forms);
            document.forms[3].addEventListener(\"submit\", (event) => {
                console.log(\"click\");
                event.preventDefault();
        
                let formElement = document.forms[3];
                console.log(formElement.children[0].files[0]);
                let formData = new FormData();
                formData.append(\"image\",formElement);
                console.log(formData.get(\"image\"));

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 
                \"https://dev-21806332.users.info.unicaen.fr/devoir-idc2021/Src/Images/recup.php\"
                );
                xhr.setRequestHeader(
                    \"Content-type\",
                    \"application/x-www-form-urlencoded\"
                );


                xhr.addEventListener(\"progress\",(event) => { 
                    let progress = document.getElementsByTagName(\"progress\")[0];
                    progress.value = event.loaded;
                    progress.total = event.total;
                    if(xhr.readyState == 4 && xhr.status==200)
                    {
                       console.log(xhr.responseText);
                    }
                });

                let blob = new Blob(
                    [formElement.children[0].files[0]], 
                    {type :\"image/gif\",encodage:\"base64\"}
                );
                let file_reader = new FileReader();
    
                file_reader.addEventListener(\"load\",(event) => {
                    console.log(file_reader.result);
                    xhr.send('image='+file_reader.result);
                });
    
                //file_reader.readAsText(blob);
                let data_url = file_reader.readAsDataURL(blob);
                let blob_url = window.URL.createObjectURL(blob);

            
                });

        }
        </script>";

            $content .= "<script> load()</script>";
        }
        
            

        echo $content;
        echo "<br>";
        ?>

</body>


</html>


