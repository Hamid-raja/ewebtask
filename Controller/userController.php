<?php
// session_start();
include_once("Utile/dbUtile.php");
include_once('Utile/commonFunction.php');
?>
<?php


class userController
{
    private $dbobj;  // for Database class object

    public function __construct()
    {
        $this->dbobj = new dbUtile();
    }

    /**
     * Register user details
     * parameter $data
     */
    public function userRgister($data)
    {
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $pass = md5($data['password']);
        $cpass = md5($data['password_repeat']);

        
        if(empty($name) || empty($email) || empty($phone) || empty($pass) || empty ($cpass)){
            return "<div class='alert alert-danger' role='alert'>Any field does not empty</div>";
        }
        
        if ($this->checkUsersName($name)) {
            return "<div class='alert alert-danger' role='alert'>Name already exists</div>";
        }
        
        if ($this->checkUserEmail($email)) {
            //var_dump( $this->checkUserEmail($email));
            return "<div class='alert alert-danger' role='alert'>Email already exists Please login with your pass</div>";
        }
       
        // print_r($data);
        if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($name))) {
            return "<div class='alert alert-danger' role='alert'>Name can only contain letters, and underscores.</div>";
        }
        if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
            return "<div class='alert alert-danger' role='alert'> Enter valid email like abc@gmail.com </div>";
        }
        if (!preg_match('/^[0-9]{10}+$/', $phone)) {
            $len = strlen($phone);
            return "<div class='alert alert-danger' role='alert'> Enter 10 digit valid number. your no legnth is $len</div>";
        }
        if (strlen($data['password']) < 5) {
            return "<div class='alert alert-danger' role='alert'> Please make password length 5 character </div>";
        }
        if ($pass != $cpass) {
            return "<div class='alert alert-danger' role='alert'>Password and Confirm Password not match</div>";
        }

        // insert query
        $insertQuery = "INSERT INTO user(id,name,email,phoneno,pass) VALUE(NULL,'$name','$email','$phone','$pass')";

        // call database operation 
        $reg_user = $this->dbobj->insert($insertQuery);

        $msg = "No msg ";
        if ($reg_user) {
            $msg = "<div class='alert alert-success' role='alert'>Sign up Process Successfully done</div>";
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Sign up Process Error. Try again</div>";
        }
        return $msg;
    }

    /**
     * user Login
     * parameter array $info 
     */

    public function userLogin($info)
    {
        $email = $info['email'];
        $pass = md5($info['pass']);

        $query = "SELECT * FROM user where email = '$email' and pass= '$pass'";
        $result = $this->dbobj->select($query);
        if (!$result) {
            $msg = "<div class='alert alert-danger' role='alert'>Name or Password not matched!</div>";
            return $msg;
            // echo "abc1";
        } else {
            $value = $result->fetch_assoc();
            // print_r($value);
            setcookie("userid",$value["id"],time()+ 3600);
            commonFuntion::set("userlogin", true);
            commonFuntion::set("userId", $value['id']);
            commonFuntion::set("userName", $value['name']);
            echo "<script>window.location = 'home.php';</script>";
        }
    }

    /**
     * Get all user details
     */
    public function getUsers()
    {
        //select query 
        $selectQuery = "SELECT * from user";

        //execute query
        $selectResult = $this->dbobj->select($selectQuery);
        if ($selectQuery) {
            return $selectResult;
        }
        return false;
    }

    /**
     * Check User name exist or not
     */
    protected function checkUsersName($name)
    {
        //select query 
        $checkQuery = "SELECT * from user where name = '$name'";
        $checkResult = $this->dbobj->select($checkQuery);
        if ($checkResult) {
            return true;
        }
        return false;
    }

    /**
     * check user email is exist or not 
     */
    protected function checkUserEmail($email)
    {
        $checkQuery = "SELECT * from user where email = '$email'";
        $checkEmail = $this->dbobj->select($checkQuery);
        if ($checkEmail) {
            return true;
        }
        return false;
    }

    /**
     * get user data by id for payment
     */
    public function getUserData($id)
    {
        $query = "SELECT * FROM user WHERE id = '$id'";
        $result = $this->dbobj->select($query);
        return $result;
    }
}
