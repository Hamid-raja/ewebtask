<?php
    include ('header.php');
?>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Profile </h3>
                    <div class="row mb-3">
                        <div class="col-lg-4">
                            <div class="card mb-3">
                                <div class="card-body text-center shadow">
                                    <img class="rounded-circle mb-3 mt-4" src="../assets/img/abc.jpeg" width="160" height="160">
                                    <!-- <div class="mb-3"><button class="btn btn-primary btn-sm" type="button">Change Photo</button></div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow mb-3">
                                        <div class="card-header py-3">
                                            <p class="text-primary m-0 font-weight-bold">User Settings  (not work)</p>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group"><label for="name"><strong>Name</strong></label>
                                                        <input class="form-control" type="text" placeholder="Someone" name="name"></div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group"><label for="email"><strong>Email Address</strong></label><input class="form-control" type="email" placeholder="user@example.com" name="email"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group"><label for="phone"><strong>Phone Number</strong></label><input class="form-control" type="text" placeholder="1234567890" name="phone"></div>
                                                <div class="form-group"><label for="address"><strong>Address</strong></label><input class="form-control" type="text" placeholder="addresss......" name="address"></div>
                                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
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
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="../assets/js/theme.js"></script>
</body>

</html>