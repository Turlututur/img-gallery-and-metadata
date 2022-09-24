<?php

/**
 * Template de ShwocaseMetadatas
 *
 * @category Template
 * @package  ShowcaseMetadataTemplate
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


?>
<!DOCTYPE HTML PUBLIC >

<head>
    <meta charset="UTF-8">
    <meta property="og:type" content="image"/>
    <meta property="og:url" content= 
    <?php 
    echo(
        isset(
            $_SERVER['HTTPS']
        ) 
            && $_SERVER['HTTPS'] === 'on' 
            ? "https" : "http") 
            . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?> />
    <meta property="og:title" content= <?php echo $this->photo; ?> />
    <meta property="og:image" content= 
    <?php 
    echo "https://dev-21701890.users.info.unicaen.fr/M1_DM_Web/Src/Images/"
    .$this->photo 
    ?> />

    <link href="Src/Styles/GlobalStyle.css" rel="stylesheet">

</head>
<body>
    <title>Précision sur la photo </title>
        <?php 
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
        ?>
    
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

    <?php

    if (!isset($_SESSION["username"])) {
        $content = "<p>Utilisateur non loggé</p>";
    } else {
        $content = "<p> Bienvenue : ".$_SESSION["username"]."</p>";
    }
        
        echo $content;
        echo "<br>";
        
    ?>


    <h1 class="titreGallerie" itemprop="<?php echo $this->photo;?>"> 
    Précision sur la 
    <?php echo $this->photo; ?></h1>
    
    <div class="gallerie"> 
        <div itemscope itemtype="https://schema.org/image">  
            <figure>
                <img itemprop="abstract" src="Src/Images/<?php echo $this->photo; ?>"
                 alt="Du texte"></img>
            </figure>
        </div>
    </div>


    <?php
    $photoPath = "Src/Images/" . $this->photo;
    exec("exiftool -n -Orientation=1". " " . $photoPath);
    


  

    echo "<h1>Une descritpion de l'image selon les métadonnées</h1>";



    if (explode(".", $this->photo)[1] == "jpg") {
        $exif = exif_read_data($photoPath, 0, true);
        foreach ($exif as $key => $section) {
            if (is_array($section)) {
                foreach ($section as $name => $val) {
                    if ($name == "ImageDescription") {
                        $description = $val;
                        echo "<p>$val</p>";
                    }
                }
            }
        }
    } else {
        echo "<p>Le format n'est pas supporté, 
        il faut un fichier de type 'jpg'.</p>";
    }
    


    /*Fonction qui permet de récupérer les coordonnées gps d'une image
    Source : 
    https://www.codexworld.com/get-geolocation-latitude-longitude-from-image-php/
    */

    /**
     * Fonction de récuperation des coordonnées
     *
     * @param String $image Le path de l'image
     * 
     * @return Array Un tableau des coordonnées gps
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    function Get_Image_location($image = '')
    {
        $exif = exif_read_data($image, 0, true);
        if ($exif && isset($exif['GPS'])) {
            $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
            $GPSLatitude    = $exif['GPS']['GPSLatitude'];
            $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
            $GPSLongitude   = $exif['GPS']['GPSLongitude'];
            
            $lat_degrees = count($GPSLatitude) > 0 ? gps2Num($GPSLatitude[0]) : 0;
            $lat_minutes = count($GPSLatitude) > 1 ? gps2Num($GPSLatitude[1]) : 0;
            $lat_seconds = count($GPSLatitude) > 2 ? gps2Num($GPSLatitude[2]) : 0;
            
            $lon_degrees = count($GPSLongitude) > 0 ? gps2Num($GPSLongitude[0]) : 0;
            $lon_minutes = count($GPSLongitude) > 1 ? gps2Num($GPSLongitude[1]) : 0;
            $lon_seconds = count($GPSLongitude) > 2 ? gps2Num($GPSLongitude[2]) : 0;
            
            $lat_direction = (
                $GPSLatitudeRef == 'W' 
                or $GPSLatitudeRef == 'S'
                ) ? -1 : 1;
            $lon_direction = (
                $GPSLongitudeRef == 'W' 
                or $GPSLongitudeRef == 'S'
                ) ? -1 : 1;
            
            $latitude = $lat_direction * (
                $lat_degrees + (
                    $lat_minutes / 60
                    ) + (
                        $lat_seconds / (60*60)
                    )
                );
            $longitude = $lon_direction * (
                $lon_degrees + (
                    $lon_minutes / 60
                    ) + (
                        $lon_seconds / (60*60)
                    
                    )
                );
    
            return array('latitude'=>$latitude, 'longitude'=>$longitude);
        } else {
            return false;
        }
    }

    /**
     * Fonction de conversion de coordonnées 
     *
     * @param String $coordPart Nos coordonnées
     * 
     * @return Float Les coordonnées au format supporté par Google Maps
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    function gps2Num($coordPart)
    {
        $parts = explode('/', $coordPart);
        if (count($parts) <= 0) {
            return 0;
        }
        if (count($parts) == 1) {
            return $parts[0];
        }
        return floatval($parts[0]) / floatval($parts[1]);
    }


    if (isset($exif['GPS'])) {
        $imgLocation = Get_Image_location($photoPath);
    } else {
        $imgLocation = array('latitude'=>'null', 'longitude'=>'null');
    }
        

    



    ?>
    <div id="partMap">

        <h1>Le lieu de la photographie</h1>
        <div 
        id='map' style='width:900px;height:900px;margin-left: auto; margin-right: auto;' >
    </div>
        
    </div>

    <script>
        let map;
        let latitude = <?php echo $imgLocation['latitude']; ?>;
        console.log(latitude);
        let longitude = <?php echo $imgLocation['longitude']; ?>;

        if(latitude == null) {
            document.getElementById('partMap').style.display = "none";
        }
    
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), { center: {lat: latitude, lng: longitude},zoom: 10, 
            styles: [
                    { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
                    { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                    {
                        featureType: "administrative.locality",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "poi",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "geometry",
                        stylers: [{ color: "#263c3f" }],
                    },
                    {
                        featureType: "poi.park",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#6b9a76" }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [{ color: "#38414e" }],
                    },
                    {
                        featureType: "road",
                        elementType: "geometry.stroke",
                        stylers: [{ color: "#212a37" }],
                    },
                    {
                        featureType: "road",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#9ca5b3" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry",
                        stylers: [{ color: "#746855" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "geometry.stroke",
                        stylers: [{ color: "#1f2835" }],
                    },
                    {
                        featureType: "road.highway",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#f3d19c" }],
                    },
                    {
                        featureType: "transit",
                        elementType: "geometry",
                        stylers: [{ color: "#2f3948" }],
                    },
                    {
                        featureType: "transit.station",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#d59563" }],
                    },
                    {
                        featureType: "water",
                        elementType: "geometry",
                        stylers: [{ color: "#17263c" }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.fill",
                        stylers: [{ color: "#515c6d" }],
                    },
                    {
                        featureType: "water",
                        elementType: "labels.text.stroke",
                        stylers: [{ color: "#17263c" }],
                    },
                    ],
    
    });
            map.gMap = map;    
        

        new google.maps.Marker({
            position: {lat: latitude, lng: longitude},
            map,
            title: "Carte",
        });
    }
        </script>
    
    <script src="https://maps.googleapis.com/maps/api/js?key=yourApiyinitMap&output=embed" async defer></script>
    



             <?php

                if (isset($_SESSION["username"])) {
                    echo "<div id=\'metadataOverwrite\'>";
                    echo "<h2>
                    Vous pouvez modifier les métadonnées si vous le souhaitez.
                    </h2>";
                    echo "<form method='post'>";

                    if (isset($exif)) {
                        foreach ($exif as $key => $section) {
                            if (is_array($section)) {
                                foreach ($section as $name => $val) {
                                    if (is_array($val)) {
                                        echo " $key <br>";
                                    } else {
                                        echo "$name => <input 
                                        type=\"text\" 
                                        name=\"$name\" 
                                        id=\"$val\" 
                                        value =\"$val\" > 
                                        <br>";
                                    }
                                }
                            }
                        }
                    } else {
                        echo "<p>Pas de métadonnées</p>";
                    } ?>
                <input type="submit" name="modifier" value="Modifier">

            </form>

                    <?php
            
                    if (isset($_POST['modifier'])) {
                        foreach ($_POST as $key => $val) {
                            exec(
                                "exiftool -n -$key=" 
                                . "\"$val\"" 
                                . " " 
                                . $photoPath
                            );
                        }
                        echo "<meta http-equiv='refresh' content='0'>";
                    }
                }
                ?>

        </div>

        <?php
        

        if (isset($_SESSION["username"])) {
            $bottom = "<h2>Supprimer cette image et sa page ?</h2>";

            $bottom .=
            "<form method='post'>
                <input type='submit' name='buttonsupr' value='Suppression'/>
            </form>";

            echo $bottom;
            if (isset($_POST['buttonsupr'])) {
                //exec("rm " . $photoPath);
                unlink($photoPath);
                $this->sendHome();
            }
        }



        //echo "<br/>" . shell_exec("exiftool '" . $photoPath . "'");

        ?>

</body>

</html>
