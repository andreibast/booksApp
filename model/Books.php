<?php
require_once __DIR__.'/../lib/Database.php';

class Books extends Database{

    public $defaultPictureName = '150x212.png';
    public $tempFileName = '';

    public function insertNewBook($passedLink){

        try{
            $openConn = parent::openConnection();
            $sql = "INSERT INTO books (id, title, authors, category, picture, description) VALUES(NULL, :title, :authors, :category, :picture, :description)";

            $statement = $openConn->prepare($sql);

            $statement->bindParam(':title',  $_POST['add_title']);
            $statement->bindParam(':authors', $_POST['add_authors']);
            $statement->bindParam(':category', $_POST['add_category']);
            $statement->bindParam(':picture', $passedLink);
            $statement->bindParam(':description', $_POST['add_description']);

            $statement->execute();

        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        parent::closeConnection($openConn);
        
    }

    public function getBookValues($id){     
        try{

            $openConn = parent::openConnection();

            $sql = $openConn->prepare("SELECT * FROM books WHERE id= $id");
            $sql->execute();

            $this->row = new RecursiveArrayIterator($sql->fetchAll());
            $this->title = $this->row[0]['title'];
            $this->authors = $this->row[0]['authors'];
            $this->category = $this->row[0]['category'];
            $this->picture = $this->row[0]['picture'];
            $this->description = $this->row[0]['description'];


        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        parent::closeConnection($openConn);
    }


    public function getBookPictureLink($id){
        try{
            $openConn = parent::openConnection();

            $sql1 = $openConn->prepare("SELECT * FROM books WHERE id=$id");
            $sql1->execute();

            $resultedRows = new RecursiveArrayIterator($sql1->fetchAll());
            $fetchedLink = $resultedRows[0]['picture'];
            
            return $fetchedFileName = basename($fetchedLink);
            echo $fetchedFileName;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        parent::closeConnection($openConn);
    }



    public function updateBookValues($passedId, $passedPictureName){
        try{
            $openConn = parent::openConnection();

            $sql = "UPDATE books SET title=:title, authors=:authors, category=:category, picture=:picture, description=:description WHERE id=$passedId";

            $statement = $openConn->prepare($sql);

            $statement->bindParam(':title',  $_POST['edit_title']);
            $statement->bindParam(':authors', $_POST['edit_authors']);
            $statement->bindParam(':category', $_POST['edit_category']);
            $statement->bindParam(':picture', $passedPictureName);
            $statement->bindParam(':description', $_POST['edit_description']);

            $statement->execute();

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        parent::closeConnection($openConn);
    }

    public function getFetchedFileName(){
        return $this->fetchedFileName;
    }


    public function deleteSelectedBook($passedId){
        try{
            $openConn = parent::openConnection();
    
            $sql1 = "DELETE FROM books WHERE id= $passedId";
            $sql2 = "ALTER TABLE books AUTO_INCREMENT=1";

            $openConn->exec($sql1);
            $openConn->exec($sql2);

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        parent::closeConnection($openConn);
    }

    public function getAllBooks(){
        try{
            $openConn = parent::openConnection();

            $selectBooks = $openConn->query('SELECT * FROM books');
            
            $books = array();

            while($row = $selectBooks->fetch(PDO::FETCH_ASSOC)){
                $books[] = $row;
            }

            return $books;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        parent::closeConnection($openConn);
    }

}