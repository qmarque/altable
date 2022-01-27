<?php
require_once('RepositoryModel.php');
class PlatManager extends RepositoryModel{

    public function getPlats(){
        return $this->getAll('plat', 'Plat');
    }

}