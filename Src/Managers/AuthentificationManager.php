<?php
namespace Managers;



/**
 * Manager du système d'authentification
 * 
 * @category Manager
 * @package  Managers
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */




 
class AuthentificationManager
{
    public $request;
    public $database;

    /**
    * @param Request $request Objet Requête actuel
    *
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return AuthentificationManager
    */

    public function __construct($request)
    {
        $this->request = $request;
        $this->database = array(
            'jml' => array(
                'id' => 12,
                'nom' => 'Lecarpentier',
                'prenom' => 'Jean-Marc',
                'mdp' => 'toto',
                'statut' => 'admin'
            ),
            'alex' => array(
                'id' => 5,
                'nom' => 'Niveau',
                'prenom' => 'Alexandre',
                'mdp' => 'toto',
                'statut' => 'admin'
            ),
            'julia' => array(
                'id' => 12,
                'nom' => 'Dupont',
                'prenom' => 'Julia',
                'mdp' => 'toto',
                'statut' => 'redacteur'
            ),
            'test' => array(
                'id' => 12,
                'nom' => 'DuTest',
                'prenom' => 'Testeur',
                'mdp' => 'test',
                'statut' => 'user'
            )
            );
    }
    /**
    * Permet de logger un utilisateur si son mot de passe est bon
    *
    * @param String $username Nom de compte
    * @param String $password Mot de passe
    *
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return Boolean
    */ 

    public function login($username, $password)
    {

        if(isset($this->database[$username])){
            if($this->database[$username]["mdp"] === $password )
            {
                $this->request->saveToSession("username",$username);
                $this->request->saveToSession("statut",$this->database[$username]["statut"]);
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }

    }
    /**
    * Permet de delogger l'utilisateur 
    *
    * @param String $username Nom de compte
    * @param String $password Mot de passe
    *
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return Boolean
    */ 
    public function unlogin()
    {
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, strpos($_SERVER["SERVER_PROTOCOL"], '/'))).'://';

        session_destroy();
        unset($_SESSION['username']);
        header("location:".$protocol.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
        die();
    }
}
