<?php

namespace Controllers;

/**
 * Controller permettant de construire l'arborescence logique en fonction de la rêquete passée
 *
 * @category Controller
 * @package  ControllerDefault
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @link     Zelda
 */
class FrontController
{

    public $router;

    /**
    * constructeur
    *
    * @param Router $router Router Principal du site
    *  
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return FrontController
    */ 

    public function __construct($router)
    {
        
        $this->router = $router;

    }

    /**
    * Fonction pricipale permettant de rediriger le trafic en fonction de la requête fournie 
    * et de fournir la page à afficher
    * @param Router $router Router Principal du site
    *  
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return FrontController
    */ 

    public function main(){


        if($this->router->request->getPOST("accueil")){
            $this->router->sendHome();
        }

        if( $this->router->request->getPOST("username") != NULL &&  $this->router->request->getPOST("mdp") != NULL )
        {    
            if($this->router->authentificationManager->login($this->router->request->getPOST("username"),$this->router->authentificationManager->request->getPOST("mdp")))
            {

                $this->router->request->saveToSession("username",$this->router->request->getPOST("username"));
                $this->router->request->saveToSession("status",$this->router->request->getPOST("status"));

            }
        }
        elseif($this->router->request->getPOST("unlogin") != NULL)
        {
            
            $this->router->authentificationManager->unlogin();
            
        }


        $controller = $this->router->getController();
        $action = $this->router->getAction();
        
        $this->router->response->send($controller->execute());

    }
}