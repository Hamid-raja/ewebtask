<?php
include("header.php");
include("../Controller/productController.php");

$productObj = new productController();

if (isset($_GET['delpro'])) {
    $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delpro']);
    $delPro = $productObj->delProById($id);
}

?>
<?php
if (isset($delPro)) {
    echo $delPro;
}
?>
<div class="container-fluid">
    <h3 class="text-dark mb-4">Product</h3>
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 font-weight-bold">Product List</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch all the product details
                        $getPd = $productObj->getAllProduct();
                        if ($getPd) {
                            $i = 0;
                            while ($result = $getPd->fetch_assoc()) {
                                $i++; ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $result['productname']; ?></td>
                                    <td><?php echo $result['category']; ?></td>
                                    <td>$<?php echo $result['price']; ?></td>
                                    <td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
                                    <td><a href="productedit.php?proid=<?php echo $result['id']; ?>">Edit</a> ||
                                        <a onclick="return confirm('Are you sure to delete this?')" href="?delpro=<?php echo $result['id']; ?>">Delete</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>ID</td>
                            <td><strong>Name</strong></td>
                            <td><strong>Price</strong></td>
                            <td><strong>Category</strong></td>
                            <td><strong>Action</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 1</p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <!-- <li class="page-item"><a class="page-link" href="#">2</a></li> -->
                            <!-- <li class="page-item"><a class="page-link" href="#">3</a></li> -->
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © Brand 2020</span></div>
    </div>
</footer>
</div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="../assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="../assets/js/theme.js"></script>
</body>

</html>