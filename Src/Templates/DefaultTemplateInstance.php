<?php

/**
 * Instance de la vue par défaut
 * 
 * @category Templates
 * @package  DefaultTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


namespace Templates;

/**
 * Classe DefautlTemplateInstance
 * 
 * @category Templates
 * @package  DefaultTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  Release: SVN: $Id$
 * @link     Zelda
 * @return   'null'
 */

class DefaultTemplateInstance
{
    /**
     * Constructeur de la classe
     * 
     * @category Templates
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  Release: SVN: $Id$
     * @link     Zelda
     * @return   'null'
     */
    public function __construct()
    {
    }
    /**
     * Fonction de rendu
     * 
     * @category Templates
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  Release: SVN: $Id$
     * @link     Zelda
     * @return   'null'
     */
    public function render()
    {
        $this->template = include "DefaultTemplate.php";
    }
}
