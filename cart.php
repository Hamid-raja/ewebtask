<?php
session_start();

include ("./Controller/cartController.php");
include("./Controller/productController.php");
include("Utile/commonFunction.php");

$cartobj = new cartController();


// delete product in cart
if (isset($_GET['delpro'])) {
    $delProId = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delProduct = $cartobj->delProductByCart($delProId);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $cartobj->updateCartQuantity($cartId, $quantity);
    if ($quantity <= 0) {
        $delProduct = $cartobj->delProductByCart($cartId);
    }
}
?>

<?php

// $login = commonFuntion::get("userlogin");
// if ($login == false) {
//     header("Location:login.php");
// }

// cart class obj

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addcart'])) {
    $quantity = $_POST['quantity'];
    $proid = $_POST['proid'];
    //add to cart product
    $addCart = $cartobj->addToCart($quantity, $proid);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">EWEBTASK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <button class="btn btn-outline-dark" type="submit">
                       <a href="cart.php" ><i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">
                            <?php

                            // cart section display the amount using session
                            $getData = $cartobj->checkCartItem();
                            if ($getData) {
                                // $sum = commonFuntion::get("gTotal");
                                // $qty = commonFuntion::get("qty");
                                     $sum = 0; // fro total 
                                     $qty = 0; // quantity
                                     while ($result = $getData->fetch_assoc()){
                                        $total =  $result['price'] * $result['quantity'];
                                        $qty = $qty + $result['quantity'];
                                        $sum = $sum + $total;
                                     }
                                echo "$" . number_format($sum) . ".00" . " | Qty: " . $qty;
                            } else {
                                echo '(Empty)';
                            }

                            ?>
                        </span></a>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage </p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <div class="main">
        <div class="content">
            <div class="cartoption">
                <div class="cartpage p-5">
                    <h2>Your Cart</h2>
                    <?php
                    
                    //message display here

                    if (isset($updateCart)) {
                        echo $updateCart;
                    }
                    if (isset($delProduct)) {
                        echo $delProduct;
                    }
                    ?>
                    <table class="tblone ">
                        <tr>
                            <th width="5%">Sl</th>
                            <th width="30%">Product Name</th>
                            <th width="10%">Image</th>
                            <th width="15%">Price</th>
                            <th width="15%">Quantity</th>
                            <th width="15%">Total Price</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                        // list cart products
                        $getPro = $cartobj->getCartProduct();
                        if ($getPro) {
                            $i = 0; // for no 
                            $sum = 0; // fro total 
                            $qty = 0; // quantity
                            while ($result = $getPro->fetch_assoc()) {
                                $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['productname']; ?></td>
                                    <td><img src="Admin/<?php echo $result['image'];?>" height="50px" alt="" /></td>
                                    <td >$<?php echo $result['price'] . ".00"; ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="cartId" value="<?php echo $result['id']; ?>" />
                                            <input type="number" class="col-4" name="quantity" value="<?php echo $result['quantity']; ?>" />
                                            <input type="submit" name="submit" value="Update" />
                                        </form>
                                    </td>
                                    <td>$<?php
                                            $total =  $result['price'] * $result['quantity'];
                                            echo number_format($total) . ".00"; ?></td>
                                    <td><a onclick="return confirm('Are you sure to delete?');" href="?delpro=<?php echo $result['id']; ?>">X</a></td>
                                </tr>
                                <?php
                                $qty = $qty + $result['quantity'];
                                $sum = $sum + $total;
                                $_SESSION["gTotal"] = $sum;
                                $_SESSION["qty"] = $qty;
                            //    setcookie("qty",$qty);
                               commonFuntion::set("qty", $qty); ?>
                        <?php
                            }
                        } ?>
                    </table>
                    <?php

                    // get all cart item and get total
                    $getData = $cartobj->checkCartItem();
                    if ($getData) {
                    ?>
                        <table style="float:right;text-align:left;" width="50%">
                            <tr>
                                <th width="60%">Sub Total : </th>
                                <td>$<?php echo number_format($sum) . ".00"; ?></td>

                            </tr>
                            <tr>
                                <th width="60%">VAT 10% : </th>
                                <td><?php
                                    $vat = $sum * 0.1;
                                    echo "$" . number_format($vat) . ".00"; ?></td>
                            </tr>
                            <tr>
                                <th width="60%">Grand Total :</th>
                                <td>$<?php
                                        $gTotal = $sum + $vat;
                                        commonFuntion::set("gTotal", $gTotal);
                                        echo number_format($gTotal) . ".00"; ?></td>
                            </tr>
                        </table>
                    <?php
                    } else {

                        echo "<script>window.location = 'home.php';</script>";

                        // echo 'Cart Empty ! Please shop now.';
                    } ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="d-flex w-100">
            <div class="col-6">
                <a href="home.php"> <img class="p-5" src="image/shop.png" alt="" /></a>
            </div>
            <div class="col-6">
                <div class=" text-right"> 
                <a class="ml-5" href="payment.php"> <img class="p-5" src="image/check.png" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="d-flex"> 
        <a class="ml-5" href="index.php"> <img src="image/shop.png" alt="" /></a>
        <a class="ml-5" href="payment.php"> <img src="image/check.png" alt="" /></a>        
    </div> -->
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; EWEBTASK 2021</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>