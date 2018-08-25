<?php
//Matthew Carter
//I211
//This is the file that creates the user_controller class

class UserController {
   private $user_model;
    
    public function __construct() {
        $this->user_model = new UserModel();
    }
    
    
    public function login(){
        $login = new UserLogin();
        
        $login->display();
    }
    
    public function error($message) {
        //create an object of the Error class
        $error = new UserError();
        //display the error page
        $error->display($message);
    }
    //This function verifies whether a user is new or a returning user.
    public function  verify() {
        
        $username = isset($_POST['username']) && ($_POST['username'] != "") ? $_POST['username'] : null;
        $password = isset($_POST['password']) && ($_POST['password'] != "") ? $_POST['password'] : null;
        
        $returningUser = $this->user_model->verify_user($username, $password);
       //This bit pulls in whether or not the user is new. If they are, new session. If not, return error.
        if(!$returningUser == false) {
            $view = new UserVerify();
       
            @session_start();
            $_SESSION['role'] = $returningUser->getRole();
            $_SESSION['firstname'] = $returningUser->getFirstName();
            $_SESSION['lastname'] = $returningUser->getLastName();
            $_SESSION['user_id'] = $returningUser->getId();
            
            header("Location:". BASE_URL);
            $view->display();
            
        }else
            {
            $message = "Login failed. Please try again";
            $this->error($message);
        }
    }
    
    public function register() {
        try {
            $user = $this->user_model->register_user(); 
            if(!$user) {
                throw new DatabaseException("Registering failed. Please try again later.");
            } elseif (!$user->getUsername() || !$user->getFirstName() || !$user->getLastName() || !$user->getEmail() || !$user->getPassword()){
                throw new DataMissingException("All fields are required. Please fill them in.");
            } else {
                $view = new UserDetail();

                @session_start();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['firstname'] = $user->getFirstName();
                $_SESSION['lastname'] = $user->getLastName();
                $_SESSION['user_id'] = $user->getId();

                $message = "Registration successful!";
                $view->display($user, $message);
            }
        }//else{
           // $message = "Registering failed. Please try again later.";
            //$this->error($message);
        //}
         catch (DatabaseException $e) {
            return $this->error($e->getMessage());
        } catch (DataMissingException $e) {
            return $this->error($e->getMessage());
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
        
    }
    //for the details to display about a user
    public function detail($id) {
        //retrieve a book
        $user = $this->user_model->view_user($id);
        
        if (!$user) {
            //error display
            $message = "There was an error in displaying the user with the id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //retrieve and display the user's details
        $view =  new UserDetail();
        $view->display($user);
    }
    
    //user Editing form
    public function edit($id) {
        //retrieve a user
        $user = $this->user_model->view_user($id);
        
        if(!$user) {
            //error display
            $message = "There was a problem displaying the user with id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        $view = new UserEdit();
        $view->display($user);
    }
    
    //Update user info in the user table of the database
    public function update($id) {
        //update specific user
        $update = $this->user_model->update_user($id);
        
        if(!$update) {
            //error display
            $message = "There was an error when updating the user with id='" . $id . "'.";
            $this->error($message);
            return;
        }
        
        //check that new data updated in database by displaying details
        $confirm = "The user has successfully updated.";
        $user = $this->user_model->view_user($id);
        
        $view = new UserDetail();
        $view->display($user, $confirm);
    }
    
    public function logout() {
        session_start();
        session_destroy();
        session_unset();
        
        $view = new UserLogout();
        $view->display();
    }
    
    //calls the add function for ONLY ADMIN users
    public function add(){
        $view =  new AdminAdd();
        $view->display();
    }
}
?>

