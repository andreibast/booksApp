<?php

class Books{

    public $defaultPictureName = '150x212.png';
    public $tempFileName = '';

    protected $db;

    public function __construct($database){
        $this->db = $database;
    }

    public function insertNewBook($passedLink){

        try{
            $openConn = $this->db->openConnection();
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
        $this->db->closeConnection($openConn);
        
    }

    public function getBookValues($id){     
        try{

            $openConn = $this->db->openConnection();

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
        $this->db->closeConnection($openConn);
    }


    public function getBookPictureLink($id){
        try{
            $openConn = $this->db->openConnection();

            $sql1 = $openConn->prepare("SELECT * FROM books WHERE id=$id");
            $sql1->execute();

            $resultedRows = new RecursiveArrayIterator($sql1->fetchAll());
            $fetchedLink = $resultedRows[0]['picture'];
            
            return $fetchedFileName = basename($fetchedLink);
            echo $fetchedFileName;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function updateBookValues($passedId, $passedPictureName){
        try{
            $openConn = $this->db->openConnection();

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
        $this->db->closeConnection($openConn);
    }

    public function getFetchedFileName(){
        return $this->fetchedFileName;
    }

    public function deleteSelectedBook($passedId){
        try{
            $openConn = $this->db->openConnection();
    
            $sql1 = "DELETE FROM books WHERE id= $passedId";
            $sql2 = "ALTER TABLE books AUTO_INCREMENT=1";

            $openConn->exec($sql1);
            $openConn->exec($sql2);

        }catch(PDOException $e){
            echo $e->getMessage();
        }

        $this->model->closeConnection($openConn);
    }

    public function getAllBooks(){
        try{
            $openConn = $this->db->openConnection();

            $selectBooks = $openConn->query('SELECT * FROM books');
            
            $books = array();

            while($row = $selectBooks->fetch(PDO::FETCH_ASSOC)){
                $books[] = $row;
            }

            return $books;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function getAllCategories(){
        try{
            $openConn = $this->db->openConnection();

            $selectCategories = $openConn->query("SELECT DISTINCT category FROM books");

            $categories = array();

            while($row = $selectCategories->fetch(PDO::FETCH_ASSOC)){
                $categories[] = $row;
            }

            return $categories;


        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function getSearchedBooks($searchKey){
        try{
            $openConn = $this->db->openConnection();

            $searchBooks = $openConn->query("SELECT * FROM books WHERE title LIKE '%$searchKey%'");

            $searched_books = array();

            while($row = $searchBooks->fetch(PDO::FETCH_ASSOC)){
                $searched_books[] = $row;
            }

            return $searched_books;


        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function insertNewFavorite($current_user_id, $current_book_id){

        try{
            $openConn = $this->db->openConnection();

            $sql = "INSERT INTO favorites (id_user, id_book) VALUES($current_user_id, $current_book_id)";
            $statement = $openConn->prepare($sql);
                $statement->execute();

        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $this->db->closeConnection($openConn);
        
    }

    public function checkDuplicateFavorite($current_user_id, $current_book_id){
        try{
            $openConn = $this->db->openConnection();

            $sql_verif = "SELECT * FROM favorites WHERE id_user = '$current_user_id' AND id_book = '$current_book_id'";
            $statement_ver = $openConn->prepare($sql_verif);
            $statement_ver->execute();

            if($statement_ver->rowCount() > 0){
                return false;
            }else{
                return true;
            }
            
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function getFilteredBooks($booksFiltered){
        try{
            $openConn = $this->db->openConnection();
            $booksFilteredSanitized = trim($booksFiltered);

            $searchFilteredBooks = $openConn->query("SELECT * FROM books WHERE category ='$booksFilteredSanitized'");

            $filtered_books = array();

            while($row = $searchFilteredBooks->fetch(PDO::FETCH_ASSOC)){
                $filtered_books[] = $row;
            }
            return $filtered_books;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);
    }

    public function getUserFavorites($current_user_id){

        try{
            $openConn = $this->db->openConnection();

            $searchFavoriteBooks = $openConn->query("SELECT books.id, title, authors, category, picture, description, favorites.id_user, favorites.id_book
            FROM books, favorites 
            WHERE 
                favorites.id_user = $current_user_id 
                AND favorites.id_book = books.id
            ");

            $user_favorite_books = array();

            while($row = $searchFavoriteBooks->fetch(PDO::FETCH_ASSOC)){
                $user_favorite_books[] = $row;
            }

            return $user_favorite_books;


        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $this->db->closeConnection($openConn);

    }

    public function deleteUserFavorite($current_del_book){
        try{
            $openConn = $this->db->openConnection();
    
            $sql1 = "DELETE FROM favorites WHERE id_book =$current_del_book";
            
            $openConn->exec($sql1);
    
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        $this->db->closeConnection($openConn);
    }
}