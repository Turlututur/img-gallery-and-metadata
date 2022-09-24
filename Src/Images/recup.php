<?php

/**
 * Fichier permettant de récupérer une image provenant d'une requête AJAX d'un utilisateur du site
 * 
 * @category Recupération
 * @package  Images
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

    
    /**
     * 
     * Fichier permettant le logging de l'activité d'upload sur le site
     * 
     */

    $log  =" ".var_dump($_POST)."  ".var_dump($_FILES);
    file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
    
    /**
     *  
     * Si un image est présente, alors la décode et l'enregistre dans le dossier local
     * 
     */

    if (isset($_POST['image'])) {
        $data = $_POST["image"];

        $rand = uniqid();
        
        $img = $_POST['image'];
        $img = str_replace('data:image/gif;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        
        $filename = "./$rand.jpg";
        if (!is_file($filename)) {
            //Some simple example content.
            $contents = 'This is a test!';
            //Save our content to the file.
            file_put_contents($filename, $data, FILE_APPEND);
        }
    }
