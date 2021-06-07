<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath.'/../Utile/dbUtile.php');
?>
<?php 

class productController
{
    private $db;

    public function __construct()
    {
        $this->db = new dbUtile();
    }

    /**
     * Insert new Product
     */
    public function productInsert($data, $file)
    {
        $productName = $data['productname'];
        $catnm       = $data['category'];
        $price       = $data['price'];

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if (empty($file_name)) {
            echo "<div class='alert alert-danger' role='alert'> $file_name Please Select any Image !</div>";
        } elseif ($file_size >4048567) {
            echo "<div class='alert alert-danger' role='alert'>Image Size should be less then 4MB! </div>";
        } elseif (in_array($file_ext, $permited) === false) {
            echo "<div class='alert alert-danger' role='alert'>You can upload only:-".implode(', ', $permited)."</div>";
        } elseif ($productName == "" || $catnm == "" || $price == "" ) {
            $msg = "<div class='alert alert-danger' role='alert'>Fields must not be empty!</div>";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO product(productname, category, price, image) VALUES('$productName', '$catnm', '$price', '$uploaded_image' )";
            $inserted_row = $this->db->insert($query);
            if ($inserted_row) {
                $msg = "<div class='alert alert-success' role='alert'>Product Inserted Successfully</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger' role='alert'>Product Not Inserted.</div>";
                return $msg;
            }
        }
    }

    /**
     * Get All Product Details
     */
    public function getAllProduct()
    {
        $query = "SELECT * FROM product";
        $detail = $this->db->select($query);
        return $detail;
    }

    /**
     * Get product by id
     */
    public function getProById($proid)
    {
        $query = "SELECT * FROM product WHERE id = '$proid'";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Update Product details
     */
    public function productUpdate($data, $file, $proid)
    {
        $productName = $data['productname'];
        $catnm       = $data['category'];
        $price       = $data['price'];

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if ($productName == "" || $catnm == "" || $price == "") {
            $msg = "<div class='alert alert-danger' role='alert'>Fields must not be empty!</div>";
            return $msg;
        } else {
            if (!empty($file_name)) {
                if ($file_size >4048567) {
                    echo "<div class='alert alert-danger' role='alert'>Image Size should be less then 4MB! </div>";
                } elseif (in_array($file_ext, $permited) === false) {
                    echo "<div class='alert alert-danger' role='alert'>You can upload only:-".implode(', ', $permited)."</div>";
                } else {
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE product
                                SET
                                productname ='$productName',
                                category    ='$catnm',
                                price       ='$price',
                                image       ='$uploaded_image'
                                WHERE productId = '$proid'
                                ";
                    $updated_row = $this->db->update($query);
                    if ($updated_row) {
                        $msg = "<div class='alert alert-success' role='alert'>Product Updated Successfully</div>";
                        return $msg;
                    } else {
                        $msg = "<div class='alert alert-danger' role='alert'>Product Not Updated.</div>";
                        return $msg;
                    }
                }
            } else {
                $query = "UPDATE product
                                SET
                                productName ='$productName',
                                category       ='$catnm',
                                price       ='$price'                              
                                WHERE productId = '$proid'
                                ";
                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $msg = "<div class='alert alert-success' role='alert'>Product Updated Successfully</div>";
                    return $msg;
                } else {
                    $msg = "<div class='alert alert-danger' role='alert'>Product Not Updated.</div>";
                    return $msg;
                }
            }
        }
    }

    /**
     * Delete Product by id
     */
    public function delProById($id)
    {
        $query = "SELECT * FROM product WHERE id = '$id'";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }
        $delquery = "DELETE FROM product WHERE id = '$id'";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "<div class='alert alert-success' role='alert'>Product Deleted Successfully</div>";
            return $msg;
        } else {
            $msg = "<div class='alert alert-danger' role='alert'>Product Not Deleted!</div>";
            return $msg;
        }
    }


    /**
     * Get Latest new Product (linit 4)
     */
    public function getNewProduct()
    {
        $query = "SELECT * FROM product ORDER BY id DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    /**
     * Get signgle product by product id
     */
    public function getSingleProduct($proId)
    {
        $query = "SELECT * FROM product WHERE id = '$proId'";
        
        $result = $this->db->select($query);
        return $result;
    }
}
