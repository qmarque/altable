<?php
require_once('./repository/PlatManager.php');
class PlatController{

    private $_platManager;
    private $_view;

    public function __construct($url){
        if(isset($url[1]) && ($url[1] != null)){
            var_dump($url);
        }else{
            $this->plats();
        }
    }
        
    private function plats(){
        $this->_platManager = new PlatManager;
        $plats = $this->_platManager->getPlats();
    }
}