<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath ."/../Utile/dbUtile.php");
class cartController{

    private $dbObj;

    public function __construct()
    {
        $this->dbObj = new dbUtile();
    }

    /**
     * adding product to cart
     */
    public function addToCart($quantity, $proId)
    {
        $quantity = $quantity;
        $proId = $proId;
        $uId = $_COOKIE["userid"]; //commonFuntion::get("userId");; //user id

        // check cart product
        $chquery = "SELECT * FROM cart WHERE productid = '$proId' AND userid = '$uId'";
        $getPro = $this->dbObj->select($chquery);

        if ($getPro) {
            $msg = "<div class='alert alert-danger' role='alert'>Product Already Added</div>";
            return $msg;
        } else {

            // select product details
            $squery = "SELECT * FROM product WHERE id = '$proId'";
            $result = $this->dbObj->select($squery)->fetch_assoc();
            $productName = $result['productname'];
            $price = $result['price'];
            $image = $result['image'];


            // echo "$uId $productName";
            //insert cart table 
            $query = "INSERT INTO cart VALUES(NULL,'$uId', '$proId','$productName','$quantity','$price','$image')";
            $inserted_row = $this->dbObj->insert($query);
            if ($inserted_row) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    /**
     * getting all cart product using user login
     */
    public function getCartProduct()
    {
        $uId = $_COOKIE['userid']; //ession_id(); // user id
        $query = "SELECT * FROM cart WHERE userid = '$uId'";
        $result = $this->dbObj->select($query);
        return $result;
    }

   /**
    * Delete product from cart table 
    */ 
    public function delProductByCart($delProId)
    {
        $delProId   = $delProId;
        $query = "DELETE FROM cart WHERE id = '$delProId'";
        $deldata = $this->dbObj->delete($query);
        if ($deldata) {
            echo "<script>window.location = 'cart.php'; </script>";
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Product Not Deleted!</div>";
            return $msg;
        }
    }

    /**
     * check cart items 
     */
    public function checkCartItem()
    {
        $uId = $_COOKIE['userid'];//session_id();
        $query = "SELECT * FROM cart WHERE userid = '$uId'";
        $result = $this->dbObj->select($query);
        return $result;
    }

    /**
     * delete cart item from 
     */
    public function delUserCart()
    {
        $uId = $_COOKIE['userid'];//session_id();
        $query = "DELETE FROM cart WHERE userid = '$uId'";
        $this->dbObj->delete($query);
    }


    /**
     * order placed 
     */
    public function orderProduct($userId)
    {
        $uId = $_COOKIE['userid'];//session_id();
        $query = "SELECT * FROM cart WHERE userid = '$uId'";
        $getPro = $this->dbObj->select($query);
        if ($getPro) {
            while ($result = $getPro->fetch_assoc()) {
                $productId      = $result['productid'];
                $productName    = $result['productname'];
                $quantity       = $result['quantity'];
                $price          = $result['price'] * $quantity;
                $image          = $result['image'];

                // print_r($result);
                $query = "INSERT INTO  tblorder VALUES(NULL,'$uId', '$productId', '$productName', '$quantity', '$price', '$image')";
                $inserted_row = $this->dbObj->insert($query);
                if($inserted_row){
                    return "<div class='alert alert-success' role='alert'>order comfirm</div>";
                }else{
                    return "<div class='alert alert-danger' role='alert'>Oreder error</div>";
                }
            }
        }
    }

    /**
     * update cart quantity
     */
    public function updateCartQuantity($cartId, $quantity)
    {
        $cartId     =  $cartId;
        $quantity   = $quantity;
        $query = "UPDATE cart
            SET
            quantity = '$quantity'
            WHERE id = '$cartId'";
        $updated_row = $this->db->update($query);
        if ($updated_row) {
            header("Location:cart.php");
        } else {
            $msg = "<span class='error'>Quantity Not Updated.</span>";
            return $msg;
        }
    }

    /**
     * payable amount from order table
     */

    public function payableAmount($userId)
    {
        $query = "SELECT price FROM tblorder WHERE userd = '$userId' AND date = now()";
        $result = $this->dbObj->select($query);
        return $result;
    }

    /**
     * Get ordered products
     */
    public function getOrderProduct($userId)
    {
        $query = "SELECT * FROM tblorder WHERE userid = '$userId'";
        $result = $this->dbObj->select($query);
        return $result;
    }

    /**
     * Check order s
     */
    public function checkOrder($userId)
    {
        $query = "SELECT * FROM tblorder WHERE userid = '$userId'";
        $result = $this->dbObj->select($query);
        return $result;
    }

    /**
     * Get ALL product in order
     */
    public function getAllOrderProduct()
    {
        $query = "SELECT * FROM tblorder ORDER BY date DESC";
        $result = $this->dbObj->select($query);
        return $result;
    }

}

?>