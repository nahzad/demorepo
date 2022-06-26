<!DOCTYPE html>
<html lang="en">
<?php
include 'head_source.php';
require 'db_config.php';
?>

<body>

    <?php include "main_nav.php"; ?>
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main">
                <div class="sidebar-content">

                    <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="category-content">
                            <div class="media">
                                <a href="#" class="media-left"><img src="assets/images/placeholder.jpg"
                                        class="img-circle img-sm" alt=""></a>
                                <div class="media-body">
                                    <span class="media-heading text-semibold">Victoria Baker</span>
                                    <div class="text-size-mini text-muted">
                                        <i class="icon-pin text-size-small"></i> &nbsp;Santa Ana, CA
                                    </div>
                                </div>

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a href="#"><i class="icon-cog3"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user menu -->
                    <?php include "navigation.php"; ?>

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
                <div class="page-header">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb">
                            <li><a href="our_clients_view.php"><i class="icon-brifcase position-left"></i> Our
                                    Clients</a>
                            </li>

                            <li class="active">Create</li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">

                    <!-- Basic datatable -->
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h5 class="panel-title">Our Clients Create</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a href="our_clients_create.php" class="btn btn-primary add-new">Add
                                            New</a></li>
                                    <!-- <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal mt-10" action="our_clients_control.php" method="POST"
                                enctype="multipart/form-data">
                                <fieldset class="content-group">
                                    <?php

                                    if (isset($_GET['msg'])) {
                                    ?>
                                    <div class="alert alert-success no-border">
                                        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                                                class="sr-only">Close</span></button>
                                        <span class="text-semibold"><?php echo $_GET['msg']; ?></span>
                                    </div>
                                    <?php } ?>



                                    <div class="form-group">
                                        <label class="control-label col-lg-2" for="clients_name">Clients Name</label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" id="clients_name"
                                                name="clients_name">
                                        </div>
                                    </div>
                                    <?php
                                    require 'db_config.php';
                                    $option_select_query = "SELECT * FROM designations WHERE active_status=1";
                                    $designations_list = mysqli_query($db_con, $option_select_query);
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2" for="designation_id">Designation
                                            Name</label>
                                        <div class="col-lg-10">
                                            <select name="designation_id" class="form-control" id="designation_id">
                                                <option value="">Select Designation</option>
                                                <?php
                                                if (!empty($designations_list)) {

                                                    foreach ($designations_list as $designation) {
                                                ?>
                                                <option value="<?php echo $designation['id']; ?>">
                                                    <?php echo $designation['designation_name']; ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label class="control-label col-lg-2" for="client_image">Client Image</label>
                                        <div class="col-lg-10">
                                            <input name="client_image" type="file" class="form-control"
                                                id="client_image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2" for="client_review">Client Review</label>
                                        <div class="col-lg-10">
                                            <textarea rows="5" cols="5" class="form-control"
                                                placeholder="Your Messages Here " id="client_review"
                                                name="client_review"></textarea>
                                        </div>
                                    </div>


                                </fieldset>
                                <div class="text-right">
                                    <input type="submit" value="Save Data" name="save_our_clients"
                                        class="btn btn-primary">

                                    <a href="our_clients_view.php" class="btn btn-info">Back To View</a>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- /basic datatable -->

                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2015. <a href="#">Limitless Web App Kit</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
    <?php include "script.php"; ?>
</body>

</html>