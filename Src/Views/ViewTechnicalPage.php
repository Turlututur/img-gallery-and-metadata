<?php

/**
 * Vue de la page implementation
 * 
 * @category Gallerie
 * @package  Src
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


namespace Views;

/**
 * Classe ViewTechnicalPage
 * 
 * @category View
 * @package  ViewTechnicalPage
 * @author   Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */
class ViewTechnicalPage
{
    protected $parts;
    protected $template;

    /**
     * Constructeur
     * 
     * @param String $template
     * @param Array $parts
     * 
     * @return 'null'
     * 
     * @category Views
     * @package  ViewTechnicalPage
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function __construct($template, $parts = array())
    {
        $this->template = $template;
        $this->parts = $parts;
    }

    /**
     * Fonction de rendu 
     * 
     * 
     * @return String $data
     * 
     * @category Views
     * @package  ViewTechnicalPage
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function render()
    {
        ob_start();
            
        $this->template->render();
        echo $this->getPart('title');
        echo $this->getPart('content');
        echo $this->getPart('menu');

        $data = ob_get_flush();

        return $data;
    }

    /**  
    *Permet de stter les parties de la page
    * 
    * 
    * @return 'null'
    * 
    * @category Views
    * @package  ViewTechnicalPage
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    * @license  https://unlicense.org/ Unlicense
    * @version  SVN: $Id$
    * @link     Zelda
    */
    public function setPart($key, $content)
    {
        $this->parts[$key] = $content;
    }

    /**
     * Permet de recup une partie de la page 
     * 
     * 
     * @return 'null'
     * 
     * @category Views
     * @package  ViewTechnicalPage
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function getPart($key)
    {
        if (isset($this->parts[$key])) {
            return $this->parts[$key];
        } else {
            return null;
        }
    }
}
