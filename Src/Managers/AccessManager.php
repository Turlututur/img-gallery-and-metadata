<?php

namespace Managers;

/**
 * Manager gérant les droits d'acces au page
 * 
 * @category Manger
 * @package  Managers
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */

class AccessManager
{
    /**
    * Constructeur
    *
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return AccessManager
    */ 
    public function __construct()
    {
    }

    /**
    * Permet de comparer le statut de l'utilisateur actuel avec le niveau d'acces requis de la page et de renvoyer un booléen donnant l'authorisation
    *
    * @param String $elementAcceslevel Niveau d'access requis pour acceder à la page
    *
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return Boolean
    */ 
    public function grantAccess($elementAccesLevel)
    {

    //var_dump($_SESSION);

        if (isset($_SESSION["statut"])) {
            if ($_SESSION["statut"] === "admin") {
                return true;
            } elseif ($_SESSION["statut"] === "user") {
                if ($elementAccesLevel === "rédacteur" or $elementAccesLevel === "admin") {
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
