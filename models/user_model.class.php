<?php
//Matthew Carter
//I211
//This is a SUPER glorified version of the Guestbook application.
class UserModel {
    
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblUser;
    //the constructor. It initializes two data members.
    
    public function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblUser = $this->db->getUserTable();
        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars. 
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars 
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }
    
    //static method to ensure there is just one MovieModel instance
    public static function getUserModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new UserModel();
        }
        return self::$_instance;
    }
    
    public function view_user($id) {
        $sql = "SELECT * FROM ". $this->tblUser ." WHERE user_id = $id";
        
        $query = $this->dbConnection->query($sql);
        
        if ($query && $query->num_rows > 0){
            $query_row = $query->fetch_assoc();
            $user = new User($query_row['username'], $query_row['firstname'], $query_row['lastname'], $query_row['email'], $query_row['password'], $query_row['role']);
        
            $user->setId($query_row['user_id']);
            
            return $user;
        }
        return false;
    }
    
    //the update_user method updates an existing user in the database. Details of the user are posted in a form. Return true if succeed; false otherwise.
    public function update_user($id) {
        //if the script did not received post data, display an error message and then terminite the script immediately
        if (!filter_has_var(INPUT_POST, 'username') ||
                !filter_has_var(INPUT_POST, 'firstname') ||
                !filter_has_var(INPUT_POST, 'lastname') ||
                !filter_has_var(INPUT_POST, 'email') ||
                !filter_has_var(INPUT_POST, 'password')) {

            return false;
        }

        //retrieve data for the new book; data are sanitized and escaped for security.
        $username = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)));
        $firstname = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
        $lastname = $this->dbConnection->real_escape_string(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        $email = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
        $password = $this->dbConnection->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));

        //query string for update 
        $sql = "UPDATE " . $this->tblUser .
                " SET username='$username', firstname='$firstname', lastname='$lastname', password='$password', "
                . "email='$email' WHERE user_id='$id'";

        //execute the query
        return $this->dbConnection->query($sql);
    }
    
    public function verify_user($username, $password) {
        if ($username && $password) {
            $sql = "SELECT user_id FROM " . $this->tblUser . " WHERE username = '$username' AND password = '$password'";
            $query = $this->dbConnection->query($sql);
            
            if ($query && $query->num_rows > 0) {
                $query_row = $query->fetch_assoc();
                return $this->view_user($query_row['user_id']);
            } else {
                return false;
            }
        }
    }
    public function register_user() {
         try {
            //receive the inputs and see if they are set
            $firstname = isset($_POST['firstname']) && ($_POST['firstname'] != "") ? $_POST['firstname'] : null;
            $lastname = isset($_POST['lastname']) && ($_POST['lastname'] != "") ? $_POST['lastname'] : null;
            $username = isset($_POST['username']) && ($_POST['username'] != "") ? $_POST['username'] : null;
            $email = isset($_POST['email']) && ($_POST['email'] != "") ? $_POST['email'] : null;
            $password = isset($_POST['password']) && ($_POST['password'] != "") ? $_POST['password'] : null;
            $confirm_password = isset($_POST['confirm_password']) && ($_POST['confirm_password'] != "") ? $_POST['confirm_password'] : null;

            //validate input; if invalid throw exceptions
            if (empty($firstname) || empty($lastname) || empty($username) || empty($password) || empty($email) || empty($confirm_password)) {
                throw new DataMissingException("All fields are required.");
            } elseif(!Utilities::validatepassword($password, $confirm_password)) {
                throw new PasswordConfirmationException("The passwords entered do not match each other.");
            } elseif(!Utilities::checkemail($email)) {
                 throw new EmailException("The email you entered is invalid.");
            }

            //sql statement and query to insert inputs into database
            $sql = "INSERT INTO " . $this->tblUser . " (user_id, role, firstname, lastname, username, password, email) VALUES (NULL, '1', '$firstname', '$lastname', '$username', '$password', '$email');";
            $query = $this->dbConnection->query($sql);
            
            //if query failed, throw exception
            if (!$query) {
                throw new DatabaseException("Failed to insert account into database.");
            }
            
            //if successful in inserting, return the information for user details page
            //sql statement and query to selecting user info
            $sql2 = "SELECT * FROM " . $this->tblUser . " WHERE firstname = '$firstname' AND lastname = '$lastname' AND username = '$username' AND email = '$email' AND password = '$password'";
            $query2 = $this->dbConnection->query($sql2);
            
            //retrieve info just stored
            if ($query2 && $query2->num_rows > 0){
                $query_row = $query2->fetch_assoc();
                $user = new User($query_row['username'], $query_row['firstname'], $query_row['lastname'], $query_row['email'], $query_row['password'], $query_row['role']);
                $user->setId($query_row['user_id']);
                return $user;
            } elseif (!$query2){
                throw new DatabaseException("Inserted into database incorrect. Please try again.");
            }
             
            
        } catch (DataMissingException $e) {
            return $e->getDetails();
        } catch (PasswordConfirmationException $e) {
            return $e->getDetails();
        } catch (EmailException $e) {
            return $e->getDetails();
        } catch (DatabaseException $e) {
            return $e->getDetails();
        } catch (Exception $e) {
            return $e->getMessage();
        }
         
    }
}
