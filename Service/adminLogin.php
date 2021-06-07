<?php 
$filepath = realpath(dirname(__FILE__));
//Session::checkLogin();
include_once($filepath.'/../Utile/dbUtile.php');
include_once($filepath.'/../Utile/commonFunction.php');
 ?>
<?php
/**
 * Adminlogin Class
 */
class adminLogin
{
    private $dbobj;

    public function __construct()
    {
        $this->dbobj = new dbUtile();
    }

    public function adminLogin($email, $adminPass)
    {
        $email = $email;
        $adminPass = $adminPass;

        if (empty($email) || empty($adminPass)) {
            $loginmsg = "Username or Password must not be empty!";
            return $loginmsg;
        } else {
            
            $query = "SELECT * FROM admin WHERE email = '$email' AND pass = '$adminPass'";
            $result = $this->dbobj->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();
                // session are set using 
                commonFuntion::set("adminlogin", true);
                commonFuntion::set("adminId", $value['id']);
                commonFuntion::set("email", $value['email']);
                commonFuntion::set("adminName", $value['username']);
                commonFuntion::set("fullname", $value['fullname']);
                header("Location:productlist.php");
            } else {
                $loginmsg = "$email Username or $adminPass Password not match!";
                return $loginmsg;
            }
        }
    }
}
