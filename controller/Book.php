<?php
class Book{

    private $model = '';

    public function __construct($model){
        $this->model = $model;
    }

    public $defaultPictureName = '150x212.png';
    private const USER_PIC_PATH = "C:/xampp/htdocs/books.andreibasturescu/public/images/user_books_covers/";
    public $tempFileName = '';

    public function addBook(){

        if(strlen($_POST['add_title']) >=3 ){
            $linkPozaUpload = '../public/images/user_books_covers/' . basename($_FILES['add_picture']['name']);

            $this->pictureName = basename($_FILES['add_picture']['name']);

            if (move_uploaded_file($_FILES['add_picture']['tmp_name'], $linkPozaUpload)) {
                $picture_message = "The book was submitted successfully!";
                $alert_add_color = 'success';
            } else{
                $this->pictureName = $this->defaultPictureName;
                $picture_message = "A default cover has been assigned!" . $pictureName;
                $alert_add_color = 'warning';
            }
        
            $this->model->insertNewBook($this->pictureName);

        }else{
            $picture_message = "The book was not submitted! Add at least a title with 3 characters long and a cover picture that has .jpg or .jpeg extension!";
            $alert_add_color ='danger';
        }
    
        $_SESSION['message'] = $picture_message;
        $_SESSION['msg_type'] = $alert_add_color;
    
        header("location: ../view/adminarea/admin.php?admin_add_new=Add+New+Book&admin_edit=Edit+Book");
    }
    
    public function editBookTarget(){
        if(isset($_REQUEST['admin_edit']) ){
            $this->id = $_REQUEST['admin_edit'];
            $this->model->getBookValues($this->id);
        }
    }

    public function editBook(){

        $this->id = $_POST['id'];

        if(isset($_FILES['edit_picture']) &&  isset($_POST['edit_title'])){
            
            $updatePath = '../public/images/user_books_covers/' . basename($_FILES['edit_picture']['name']);
            $moveUploaded = move_uploaded_file($_FILES['edit_picture']['tmp_name'], $updatePath);
            $this->pictureName = basename($_FILES['edit_picture']['name']);
            $picDbName = $this->model->getBookPictureLink($this->id);

            if ($moveUploaded) {
                $this->tempFileName =  $this->pictureName;
                $this->picture_message = "<br>The new cover picture has been submitted successfully!";
                $this->alert_update_color = 'success';
            }elseif(!str_contains($picDbName, '150x212.png') && isset($picDbName) && file_exists(self::USER_PIC_PATH.$picDbName)){
                $this->tempFileName = $picDbName;
                $this->picture_message = "<br>The text has been updated!";
                $this->alert_update_color = 'success';
            }else{
                $this->tempFileName = $this->defaultPictureName; 
                $this->picture_message = "<br>The default cover picture is assigned!";
                $this->alert_update_color = 'warning';
            }
        }

        $this->model->updateBookValues($this->id, $this->tempFileName);

        $_SESSION['message'] = "The book has been updated!" .  $this->picture_message;
        $_SESSION['msg_type'] = $this->alert_update_color;

        $url = "../view/adminarea/admin.php?admin_edit=$this->id";
        $url = str_replace(PHP_EOL, '', $url);
    
        header("location: $url");
    }

    public function deleteBook(){
        $id = $_POST['id'];
        
        $picture_snatched_path =  $_POST['picturePath'];
    
        $exploded_path = basename($picture_snatched_path);
        $exploded_path_string = self::USER_PIC_PATH . $exploded_path;
        
        if(file_exists($exploded_path_string)){
            unlink($exploded_path_string);
        }

        $this->model->deleteSelectedBook($id);

        $_SESSION['message'] = "The book has been deleted!";
        $_SESSION['msg_type'] = "danger";
    
        header("location: ../view/adminarea/admin.php?admin_manage=Manage+Books&admin_edit=Edit+Book");
    }

    public function displayBooks(){
        return $books = $this->model->getAllBooks();
    }

    public function displayCategories(){
        return $categories = $this->model->getAllCategories();
    }

    public function displaySearchedBooks($searchKey){
        return $searchedBooks = $this->model->getSearchedBooks($searchKey);
    }

    public function displayFilteredBooks($booksFiltered){
        return $booksFiltered = $this->model->getFilteredBooks($booksFiltered);
    }

    public function addToFavorites($current_user_id, $current_book_id){
        $this->model->insertNewFavorite($current_user_id, $current_book_id);
    }

    public function checkFavorite($current_user_id, $current_book_id){
        return $this->model->checkDuplicateFavorite($current_user_id, $current_book_id);
    }

    public function displayFavoriteBooks($current_user_id){
        return $favoriteBooks = $this->model->getUserFavorites($current_user_id);
    }

    public function deleteFavoriteBook($current_del_book){
        $this->model->deleteUserFavorite($current_del_book);
    }
}

// $obj = new Book();

// if(isset($_POST['add_book'])){
//     $obj->addBook();
// }

// if(isset($_POST['edit_book']) ){
//     $obj->editBookTarget();
//     $obj->editBook();
// }

// if(isset($_POST['delete'])){
//     $obj->deleteBook();
// }

// unset($obj);