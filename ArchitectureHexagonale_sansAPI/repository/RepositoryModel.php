<?php
require_once('Plat.php');

abstract class RepositoryModel{
    private static $_bdd;
    private static function setBDD(){
        self::$_bdd = new PDO("mysql:host=localhost;dbname=altable;charset=utf8", 'koliva', 'koliva');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }

    protected function getBDD(){
        if(self::$_bdd == null){
            $this->setBDD();

            return self::$_bdd;
        }
    }

    protected function getAll($table, $object){
        $var = [];
        $requette = $this->getBDD()->prepare('SELECT * FROM ' .$table. ' ORDER BY id DESC');
        $requette->execute();

        $tableauPlats = [];
        $tableauPlats['plat'] = [];

        while($data = $requette->fetch(PDO::FETCH_ASSOC)){
            // $var[] = new $object($data);

            extract($data);

            var_dump($data);
            // return $var;

            $requette->closeCursor();
        }
    }
}