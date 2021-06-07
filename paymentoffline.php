<?php include 'header.php'; ?>
<?php
$login = commonFuntion::get("userlogin");
if ($login == false) {
    header("Location:login.php");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
    $userId = $_COOKIE['userid']; //commonFuntion::get("userid");
    // echo $userId;
    $insertOrder = $cartobj->orderProduct($userId);

    $delData = $cartobj->delUserCart();
    header("Location:orders.php");
}
?>
<style type="text/css">
    .division {
        width: 50%;
        /* float: left; */
    }
    .content {
    padding: 20px 0;
    background: #FFF;
}
table.tblone tr:nth-child(2n+1) {
    background: #fff;
    height: 30px;
}
    .tblone {
        width: 95%;
        margin-right: 15px;
        border: 2px solid #ddd;
    }

    .tblone tr td {
        text-align: justify;
    }

    .tbltwo {
        float: right;
        text-align: left;
        width: 40%;
        border: 2px solid #ddd;
        margin-right: 14px;
        margin-top: -4px;
        margin-right: 38px;
    }

    .tbltwo tr td {
        text-align: justify;
        padding: 5px 10px;
    }

    /* .ordernow {} */

    .ordernow a {
        width: 200px;
        margin: 20px auto 0;
        text-align: center;
        padding: 5px;
        font-size: 30px;
        display: block;
        background: #3C3B40;
        color: white;
        border-radius: 3px;
    }
</style>

<div class="main p-5">
    <div class="content">
        <div class="section group d-flex">
            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    // get all product in cart
                    $getPro = $cartobj->getCartProduct();
                    if ($getPro) {
                        $i = 0;
                        $sum = 0;
                        $qty = 0;
                        while ($result = $getPro->fetch_assoc()) {
                            $i++; ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $result['productname']; ?></td>
                                <td>$<?php echo $result['price'] . ".00"; ?></td>
                                <td><?php echo $result['quantity'] . ".00"; ?></td>
                                <td>$<?php
                                        $total =  $result['price'] * $result['quantity'];
                                        echo number_format($total) . ".00"; ?></td>
                            </tr>
                            <?php
                            $qty = $qty + $result['quantity'];
                            $sum = $sum + $total; ?>
                    <?php
                        }
                    } ?>
                </table>

                <!-- Total bill amount are here -->
                <table class="tbltwo mt-2">
                    <tr>
                        <td>Sub Total</td>
                        <td>:</td>
                        <td>$<?php echo number_format($sum) . ".00"; ?></td>
                    </tr>
                    <tr>
                        <td>VAT 10%</td>
                        <td>:</td>
                        <td><?php
                            $vat = $sum * 0.1;
                            echo "$" . number_format($vat) . ".00"; ?></td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>:</td>
                        <td>$<?php
                                $gTotal = $sum + $vat;
                                commonFuntion::set("gTotal", $gTotal);
                                echo number_format($gTotal) . ".00"; ?></td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>:</td>
                        <td><?php echo $qty; ?></td>
                    </tr>
                </table>
            </div>
            <div class="division">
                <?php

                /** 
                 * get current user login
                 */
                $id = $_COOKIE['userid'];//commonFuntion::get("userid");
                $getData = $usrobj->getUserData($id);
                if ($getData) {
                    while ($result = $getData->fetch_assoc()) {
                ?>
                        <table class="tblone">
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <h2>Your Profile Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">Name</td>
                                <td width="5%">:</td>
                                <td><?php echo $result['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $result['phoneno']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $result['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $result['address']; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center; font-size: 22px;">
                                <a style="color: green;" href="editprofile.php">Update Details</a></td>
                            </tr>
                        </table>
                <?php
                    }
                } ?>
            </div>
        </div>
        <div class="ordernow">
            <a href="?orderid=order">Order</a>
        </div>
    </div>
</div>
</div> 
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