<?php

namespace Dialog;
/**
 * Objet Requête permettant de représenter et centraliser les informations arrivantes 
 * 
 * @category Communication
 * @package  Dialog
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */
class Request
{
    public $get;
    private $post;
    private $files;
    private $server;
    /**
    * Constructeur
    *
    * @param Array  $get        Données présentent dans $_GET. 
    * @param Array  $post       Données présentent dans $_POST.
    * @param Array  $files      Données présentent dans $_FILES.
    * @param Arrray $server     Données présentent dans $_SERVER. 
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return ControllerDefault
    */ 
    public function __construct($get, $post, $files, $server)
    {
        $this->get = $get;
        $this->post = $post;
        $this->files = $files;
        $this->server = $server;
    }

    /**
    * Permet d'atteindre une clé spécifique du $_GET.
    *
    * @param String  $key  clé recherchée.
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return String/null
    */ 
    public function getGET($key)
    {
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }
        return null;
    }
    /**
    * Permet d'atteindre une clé spécifique du $_POST.
    *
    * @param String  $key  clé recherchée
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return String/null
    */ 

    public function getPOST($key)
    {
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }
        return null;
    }

    /**
    * Permet d'enregister un couple clé/valeur dans $_SESSION.
    *
    * @param String  $key    clé à enregistrée
    * @param String  $value  valeur à enregistrée
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function saveToSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
