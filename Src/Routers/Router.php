<?php

namespace Routers;

/**
 * Permet de gérer les redirection à l'intérieur du site
 * 
 * @category Router
 * @package  Routers
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

 class Router
{   
    public $request;
    public $response;
    public $authentificationManager;
    public \Managers\AccessManager $accessManager;


    /**
    * Constructeur
    *
    * @param Request $request Objet requête actuel 
    * @param Response $response Objet réponse actuel 
    * @param AuthentificationManager $authentificationManager Manager d'authentification
    * @param AccessManager $accessManager authentification Manager D'access


    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return AccessManager
    */ 
    public function __construct($request, $response, $authentificationManager, $accessManager)
    {
        $this->request = $request;
        $this->response = $response;
        $this->authentificationManager = $authentificationManager;
        $this->accessManager = $accessManager;
    }

    /**
    * Permet de renvoyer l'user vers la page d'accueil
    *
    *
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function sendHome()
    {
        unset($_GET['showcase']);
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))).'://';
        $url = $protocol.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        $url = $this->removeGET($url, "showcase");
        header("location:".$url);
        die();
    }
    /**
    * Permet de modifier l'url présent
    *
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    private function removeGET($url, $varname)
    {
        list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars[$varname]);
        $newqs = http_build_query($qsvars);
        return $urlpart ;
    }
    
    /**
    * Permet de retourner le bon controller en fonction de l'url demandé
    *
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function getController()
    {
        if ($this->request->getGET("showcase") !== null) {
            return new \Controllers\ControllerShowcase($this->accessManager, $this->request->get["showcase"]);
        } elseif ($this->request->getPOST("technicalpage") !== null) {
            return new \Controllers\ControllerTechnicalPage($this->accessManager);
        } else {
            return new \Controllers\ControllerDefault($this->accessManager);
        }
    }

    /**
    * Permet de retourner la bonne action en fonction de l'url , non utilisé 
    *
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function getAction()
    {
        if (isset($this->request->get["action"])) {
            if ($this->request->get[""] === "action1") {
                return  ;
            } elseif ($this->request->get["action"] === "action2") {
                return ;
            }
        } else {
            return "default";
        }
    }
}
