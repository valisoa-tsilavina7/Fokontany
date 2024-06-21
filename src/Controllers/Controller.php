<?php
namespace App\Controllers;

use Database\DBconnexion;

abstract class Controller
{
    private string $path;
    protected DBconnexion $bdd;
    public  $message;



    public function __construct(DBconnexion $bdd)
    {
        if(session_status()===PHP_SESSION_NONE)
        {
          session_start();
        }
        $this->bdd=$bdd;
    }

    public function render(string $path,array $params=null)
    {

        ob_start();

        $path=str_replace('.',DIRECTORY_SEPARATOR,$path);

        require VIEWS.$path.'.php';

        if($params){$params=extract($params);}

        $content= ob_get_clean();

        require VIEWS.'layout.php';
    }


    

    public function isAdmin()
    {
      if(isset($_SESSION['auth']) and ($_SESSION['auth']==true))
      {
        return true;
      }else
      {
        return header('Location: /security/connexion');
      }
    }




    public function setMessage(string $message):void
    {
      $this->message=$message;
    }
    public function getMessage():?string
    {
      return $this->message;
    }

    
}