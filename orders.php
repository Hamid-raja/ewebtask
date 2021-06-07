<?php include 'header.php'; ?>
<?php 
$login = commonFuntion::get("userlogin");
if ($login == false) {
    header("Location:login.php");
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
        margin-left: 37px;
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

 <style type="text/css">
 	.tblone  tr td{text-align: justify;}
 </style>
 <div class="main pd-5">
    <div class="content">
    		<div class="section group">
    			<div class="order">
    				<h2>Your Ordered Details</h2>
    				<table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Image</th>								
								<th>Quantity</th>
								<th>Price</th>
							</tr>
							<?php
                            $userid = $_COOKIE['userid']; //commonFuntion::get("userid");
                            $getOrder = $cartobj->getOrderProduct($userid);
                            if ($getOrder) {
                                $i=0;
                                while ($result = $getOrder->fetch_assoc()) {
                                    $i++; ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productname']; ?></td>
								<td><img src="Admin/<?php echo $result['image']; ?>" height="100px" width="100px" alt=""/></td>
								<td style="text-align:center;"><?php echo $result['qty'].""; ?></td>
								
								<td>$<?php echo number_format($result['price']).".00"; ?></td>
                                
                                						
							</tr>
							
							<?php
                                }
                            } ?>
						</table>
    			</div>
    		</div>
       <div class="clear"></div>
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
