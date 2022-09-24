<?php

namespace Controllers;

/**
 * Controller permettant de construire la page d'implémentation
 *
 * @category Controller
 * @package  ControllerDefault
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr>
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @link     Zelda
 */
class ControllerTechnicalPage
{
    protected $view;
    protected $accesRequired;
    protected $accesManager;
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
    * @return ControllerTechnicalPage
    */ 
    public function __construct($accessManager)
    {
        $this->template = new \Templates\TechnicalPageTemplateInstance();
        $this->view = new \Views\ViewTechnicalPage($this->template);
        $this->accessRequired = "none";
        $this->accessManager = $accessManager;

        $access = $this->accessManager->grantAccess($this->accessRequired);
    }

    public function showPage()
    {
        if ($this->view !== null) {
            return $this->view->render();
        } else {
            return $this->view->makeUnknownPage();
        }
    }

    public function execute()
    {
        return $this->showPage();
    }
}
