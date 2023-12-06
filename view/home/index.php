<?php require_once("../../config/conexion.php")  ?>


<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <title>Avicola | macarena</title>
    <?php require_once("../html/head.php")  ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

    <?php require_once("../html/header.php")  ?>
        <!-- ========== App Menu ========== -->
        <?php require_once("../html/menu.php")  ?>
       

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            
        </div>
        <!-- end main content-->
        <?php require_once("../html/footer.php")  ?>
    </div>
    <!-- END layout-wrapper -->

    <?php require_once("../html/js.php")  ?>

</body>

</html>