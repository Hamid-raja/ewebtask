<?php
include("header.php");
include("../Controller/productController.php");

$productObj = new productController();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    //print_r($_FILES);
    $insertProduct = $productObj->productInsert($_POST, $_FILES);
}


?>
<?php
if (isset($insertProduct)) {
    echo $insertProduct;
}
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Add new Product</h3>
    <div class="row mb-3">

        <div class="col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Product details</p>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="pname"><strong>Product Name</strong></label>
                                            <input class="form-control" type="text" placeholder="prodcut" name="productname">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="category"><strong>Category</strong></label>
                                            <input class="form-control" type="text" placeholder="category" name="category">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="price"><strong>Price</strong></label><input class="form-control" type="text" placeholder="Price" name="price"></div>
                                <div class="form-group">
                                    <label for="image"><strong>Image</strong></label>
                                    <input class="form-control" type="file" name="image">

                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" name="submit" type="submit">Save Product</button></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © ECOMWEB 2021</span></div>
    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/theme.js"></script>
</body>

</html>