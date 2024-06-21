<?php
namespace Routes;

use Database\DBconnexion;

class Route{

    private string $path;
    private string $action;
    private $matches;


    public function __construct(string $path,string $action)
    {
        $this->path=trim($path,'/');
        $this->action=$action;
    }

    public function matches(string $url)
    {
        //JE VAIS REMPLACER LE : par des carac alpha num , et remplacer par non / dans $this-path
        $path=preg_replace('#:([\w]+)#','([^/]+)',$this->path);

        $pathToMatch="#^$path$#";

        if(preg_match($pathToMatch,$url,$matches))
        {
            $this->matches=$matches;

           return true;
        }else{
            return false;
        }
    }


    public function execute()
    {

        //elimener le @ et transfoormer en une sorte de array


        $params=explode('@',$this->action);

      
    
        //L indice 0 , c est le controller et l indice 1 c est la methode
        $controller=new $params[0](new DBconnexion("fokontany","localhost","root",""));

        $method=$params[1];

        //SI LA TABLEAUX MATCHES SE 1 existe donc il ya un parametre
        isset($this->matches[1])? $controller->$method($this->matches[1]) : $controller->$method();

    }
}




    // public function execute()
    // {
    //     $params=explode('@',$this->action);

    //     ///JE PREND L INDEX 0 EST JE LE TRANSFORME EN CLASS

    //     $controller=new $params[0](new DBconnexion('blogmvc5h','localhost','root',''));
    //     $method=$params[1];


    //     //SI LE TABLEAU D INDEX 1 EXISTE
    //    isset($this->matches[1])? $controller->$method($this->matches[1]) : $controller->$method();
    
    // }

    
