<?php

/**
 * Instance reliée à la vue de Showcase
 * 
 * @category Template
 * @package  ShowcaseMetadataTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


namespace Templates;

/**
 * Classe ShowcaseMetadataTemplateInstance
 * 
 * @category Template
 * @package  DefaultTemplateInstance
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */
class ShowcaseMetadataTemplateInstance
{
    public $photo;
    public $template;
    /**
     * Constructeur
     * 
     * @param String $photo Un string
     * 
     * @return 'Rien'
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    public function __construct($photo)
    {
        $this->photo = $photo;
    }
    /**
     * Fonction de rendu
     * 
     * @return 'Rien'
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
        $this->template = include("ShowcaseMetadataTemplate.php");
    }

    /**
     * Fonction permettant de renvoyer sur la page d'acceuil
     * 
     * @return 'Rien'
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
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
     * Constructeur
     * 
     * @param String $url Notre url
     * @param String $varname
     * 
     * @return 'Rien'
     * 
     * @category Template
     * @package  DefaultTemplateInstance
     * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
     * @author   Arthur Bocage <arthur.bocage@gmail.com>
     * @license  https://unlicense.org/ Unlicense
     * @version  SVN: $Id$
     * @link     Zelda
     */
    private function removeGET($url, $varname)
    {
        list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars[$varname]);
        $newqs = http_build_query($qsvars);
        return $urlpart ;
    }
}
