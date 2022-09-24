<?php

namespace Controllers;
/**
 * Controller permettant de construire la page de showcase 
 *
 * @category Controller
 * @package  ControllerDefault
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @link     Zelda
 */
class ControllerShowcase
{
    protected $photoURL;
    protected $view;
    protected $accessManager;
    protected $template;
    /**
    * Constructeur
    *
    * @param View $view                   Vue showcase
    * @param String $access               Required Niveau d'access requis
    * @param AccessManager $accessManager Manager d'access
    * @param Template $template           Template de la page   
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return ControllerShowcase
    */ 

    public function __construct($accessManager, String $photo)
    {
        $this->accessRequired = "user";
        $this->accessManager = $accessManager;
        $this->photoURL = $photo;

        $this->template = new \Templates\ShowcaseMetadataTemplateInstance($this->photoURL);
        $this->view = new \Views\ViewShowcase($this->template);
    }

    
    /**
    *
    * Permet de afficher la de showcase
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
            $content = "<p>Page User</p>";
            
            return $this->view->render();
        } elseif ($access) {
        
            //$content = "<p>Il Faut être loggé pour voir la page par défaut</p>";
            return $this->view->render();
            echo $content;
        }
        $this->view->setPart('content', $content);
    }
    /**
    *
    * Permet d'appeler l'affichage de la page de showcase
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
