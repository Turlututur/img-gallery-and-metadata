<?php

namespace Controllers;

/**
 * Controller permettant de construire la page par default
 *
 * @category   Controller
 * @package    ControllerDefault
 * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @link     Zelda
 */
class ControllerDefault
{
    private $view;
    private $accessRequired;
    private $accessManager;
    private $template;

    /**
    * Constructeur
    *
    * @param View $view                   Vue par défault
    * @param String $access               Required Niveau d'access requis
    * @param AccessManager $accessManager Manager d'access
    * @param Template $template           Template de la page   
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return ControllerDefault
    */ 
    public function __construct($accessManager)
    {
        $this->template = new \Templates\DefaultTemplateInstance();
        $this->view = new \Views\DefaultView($this->template);
        $this->accessRequired = "admin";
        $this->accessManager = $accessManager;
    }

    /**
    *
    * Permet de afficher la par par défault
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function showPage()
    {
        $access = $this->accessManager->grantAccess($this->accessRequired);

        if (!$access) {
            return $this->view->render();
        } elseif ($access) {
            //$content = "<p>Il Faut être loggé pour voir la page par défaut</p>";
            return $this->view->render();
        }
    }

    /**
    *
    * Permet d'appeler l'affichage de la page par défault
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function execute()
    {
        return $this->showPage();
    }
}
