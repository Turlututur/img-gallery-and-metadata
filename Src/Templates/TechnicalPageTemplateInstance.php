<?php

/**
 * Instance reliée à la vue d'implémentation
 * 
 * @category Template
 * @package  TechnicalPageTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


namespace Templates;
/**
 * Création de la classe
 * 
 * @category Template
 * @package  DefaultTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */
class TechnicalPageTemplateInstance
{

    /**
     * Constructeur (vide)
     * 
     * @return 'null'
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function __construct()
    {
    }
    /**
     * Instance reliée à la vue d'implémentation
     * 
     * @return 'null'
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function render()
    {
        include "TechnicalPageTemplate.php";
    }
}
