<?php

/**
 * Objet permettant d'envoyer une réponse au serveur.
 * 
 * @category Commmunication
 * @package  Dialog
 * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
 * @author   Arthur Bocage <arthur.bocage@gmail.com>
 * @license  https://unlicense.org/ Unlicense
 * @version  SVN: $Id$
 * @link     Zelda
 */


namespace Dialog;

class Response
{
    private $headers = array();
    /**
    * Rajoute un header à executer plus tard
    *
    * @param Header $headerValue Hearder
    *
    * @author   Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return ControllerDefault
    */ 
    public function addHeader($headerValue)
    {
        $this->headers[] = $headerValue;
    }

    /**
    * Permet d'envoyer tout les Headers présents.
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function sendHeaders()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
    }

    /**
    * Permet d'envoyer le contenu à afficher
    *  
    * @author     Alexandre Pignard <alexandre.pignard@outlook.fr> 
    * @author   Arthur Bocage <arthur.bocage@gmail.com>
    *
    * @return null
    */ 
    public function send($content)
    {
        $this->sendHeaders();
        //echo $content;
    }

}
