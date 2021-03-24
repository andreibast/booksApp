<?php

class DB {

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    function getData($title, $authors, $category, $linkPoza, $description){

            $query = $this->pdo->prepare("INSERT INTO books (title, authors, category, picture, description) VALUES('$title','$authors','$category','$linkPoza','$description') ");
            $query->execute();
            return $query->fetchAll();
    }
    
}