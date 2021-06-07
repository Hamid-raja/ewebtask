<?php include 'header.php'; 

// check user session is start or not
$login = commonFuntion::get("userlogin");
if ($login == false) {
    header("Location:login.php");
}
?>
<style type="text/css">
    .payment {
        width: 80%;
        min-height: 200px;
        text-align: center;
        border: 1px solid #ddd;
        margin: 0 auto;
        padding: 50px;
    }

    .payment h2 {
        border-bottom: 1px solid #ddd;
        margin-bottom: 40px;
        padding-bottom: 10px;
    }

    .payment a {
        background: #3C3B40;
        border-radius: 3px;
        color: #fff;
        font-size: 22px;
        padding: 5px 30px;
    }

    .back a {
        width: 150px;
        margin: 5px auto 0;
        padding: 7px 0;
        text-align: center;
        display: block;
        background: #555;
        border: 1px solid #333;
        color: #fff;
        border-radius: 3px;
        font-size: 25px;
    }
</style>

<div class="main p-5 ">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>Choose Payment Ontion</h2>
                <!--  paymen oprtions -->
                <a href="paymentoffline.php">Cash On Delivery</a>
                <!-- <a href="paymentonline.php">Online Payment</a> -->
            </div>
            <div class="back ">
                <a href="cart.php">Previous</a>
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