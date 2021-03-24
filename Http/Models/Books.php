<?php

require_once 'config.php';
require_once 'db.php';

class Books{

    public $defaultPictureName = '150x212.png';
    public $tempFileName = '';


    public function addBook(){
        $this->title = $_POST['add_title'];
        $this->authors = $_POST['add_authors'];
        $this->category = $_POST['add_category'];
        $this->picture = $_FILES['add_picture'];
        $this->description = $_POST['add_description'];
      
          if(isset($_FILES['add_picture']) && strlen($this->title) >=3 ){
              $linkPozaUpload = '../../../public/images/user_books_covers/' . basename($_FILES['add_picture']['name']);

              $linkPozaUpload2 =basename($_FILES['add_picture']['name']);


              if (move_uploaded_file($_FILES['add_picture']['tmp_name'], $linkPozaUpload)) {
    
                $picture_message = "The book was submitted successfully!";
                $alert_add_color = 'success';
              } else{
                
                $picture_message = "A default cover has been assigned!";
                $alert_add_color = 'warning';
                $linkPozaUpload2 = $this->defaultPictureName;
              }
      
           
              $mysqli3 = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli3));
      
              $mysqli3->query("INSERT INTO books (id, title, authors, category, picture, description) VALUES(NULL,'$this->title','$this->authors','$this->category','$linkPozaUpload2','$this->description') ") or die($mysqli3->error());


      
          }else{
              $picture_message = "The book was not submitted! Add at least a title with 3 characters long and a cover picture that has .jpg or .jpeg extension!";
              $alert_add_color = 'danger';
          }
      
          $_SESSION['message'] = $picture_message;
          $_SESSION['msg_type'] =  $alert_add_color;
      
         header("location: ../../../resources/views/adminarea/admin.php?admin_add_new=Add+New+Book&admin_edit=Edit+Book");
    }


    public function editBookTarget(){

        $mysqli2 = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli2));
        
        if(isset($_REQUEST['admin_edit']) ){
            $this->id = $_REQUEST['admin_edit'];

            if($this->result = $mysqli2->query("SELECT * FROM books WHERE id= $this->id") or die($mysqli2->error())){
                    
                $this->row = $this->result->fetch_array();
                $this->title = $this->row['title'];
                $this->authors = $this->row['authors'];
                $this->category = $this->row['category'];
                $this->picture = $this->row['picture'];
                $this->description = $this->row['description'];
            }
        }

    }


    public function editBook(){

        $mysqli3 = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli3));

        $this->id = $_POST['id'];

        $this->title = $_POST['edit_title'];
        $this->authors = $_POST['edit_authors'];
        $this->category = $_POST['edit_category'];
        $this->picture = $_FILES['edit_picture'];
        $this->description = $_POST['edit_description'];
        $tempPicturePath;

        if(isset($_FILES['edit_picture']) &&  isset($_POST['edit_title'])){
            
            //saving user pictures destination and add in the variable the moving operation.
            $updatePath = '../../../public/images/user_books_covers/' . basename($_FILES['edit_picture']['name']);
            $moveUploaded = move_uploaded_file($_FILES['edit_picture']['tmp_name'], $updatePath);

            //grab user picture name (to be renamed and verified!)
            $updatePathLink = basename($_FILES['edit_picture']['name']);


            //to interogate database over the selected 
            $queryResult = $mysqli3->query("SELECT * FROM books WHERE id=$this->id");
            $resultedRows = $queryResult->fetch_array();
            $fetchedLink = $resultedRows['picture'];
            $fetchedFileName = basename($fetchedLink);


            if ($moveUploaded) {
                $this->tempFileName =  $updatePathLink; //prepares the user picture name for DB
                $this->picture_message = "<br>The new cover picture has been submitted successfully!";
                $this->alert_update_color = 'success';
            }elseif(!str_contains($fetchedFileName, '150x212.png') && file_exists("C:/xampp/htdocs/books.andreibasturescu/public/images/user_books_covers/" .$fetchedFileName)){
                clearstatcache();
                $this->tempFileName =  $fetchedFileName; //prepares the user picture name for DB
                $this->picture_message = "<br>The text has been updated!";
                $this->alert_update_color = 'success';
            }else{
                $this->tempFileName = $this->defaultPictureName; //prepares the DEFAULT picture name for DB
                $this->picture_message = "<br>A default cover picture has been assigned!";
                $this->alert_update_color = 'warning';
            }
        }

       $mysqli3->query("UPDATE books SET title='$this->title', authors='$this->authors', category='$this->category', picture='$this->tempFileName', description='$this->description'  WHERE id=$this->id") ;
    
        $_SESSION['message'] = "The book has been updated!" .  $this->picture_message;
        $_SESSION['msg_type'] = $this->alert_update_color;

        $url = "../../../resources/views/adminarea/admin.php?admin_edit=$this->id";
        $url = str_replace(PHP_EOL, '', $url);
    
        header("location: $url");

        return $tempPicturePath;
    }
    


    public function deleteBook(){

        $id = $_POST['id'];
        $picture_snatched_path =  $_POST['picturePath'];
    
        $exploded_path = basename($picture_snatched_path);
        $exploded_path_string = "C:/xampp/htdocs/books.andreibasturescu/public/images/user_books_covers/" . $exploded_path;
        
        if(file_exists($exploded_path_string)){
            unlink($exploded_path_string);
        }

        $_SESSION['message'] = "The book has been deleted!";
    
        $mysqli = new mysqli("localhost","root","","books.app") or die(mysqli_error($mysqli));
    
        $mysqli->query("DELETE FROM books WHERE id= $id") or die($mysqli->error());
        $mysqli->query("ALTER TABLE books AUTO_INCREMENT=1") or die($mysqli->error());
    
        $_SESSION['msg_type'] = "danger";
    
        header("location: ../../../resources/views/adminarea/admin.php?admin_manage=Manage+Books&admin_edit=Edit+Book");

    }

    
}