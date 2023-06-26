<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if(!isset($_SESSION['user_id'])){
    header('location: ../../Auth');exit();}
    require_once "../../Auth/Dbcon.php";
	require_once 'dbconn.php';
    $query = "SELECT * FROM `users` WHERE `user_id`= '$_SESSION[user_id]'";
    $result = mysqli_query($db, $query);
    $row = $result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    $_SESSION['category']=$row['category'];
    $_SESSION['title']=$row['title'];
    $_SESSION['status']= $row['status'];
    $_SESSION['access_roles'] = $row['Accessrole'];
    $_SESSION['office'] =$row['office']; $_SESSION['succ']='wertyytr';
   
    
    
$query = "SELECT * FROM links WHERE link_id='$_GET[id]'";
$result = mysqli_query($dbDMS,  $query);
if (mysqli_num_rows($result) == 0) {
    header('location:index.php');
    exit();
}
?>
<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/logo.jpg" type="image/jpg" />
	<!--plugins-->
    <link rel="stylesheet" href="assets/plugins/notifications/css/lobibox.min.css" />
	<link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<link href="assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="assets/css/dark-theme.css" />
	<link rel="stylesheet" href="assets/css/semi-dark.css" />
	<link rel="stylesheet" href="assets/css/header-colors.css" />
   
    <title>Link Results</title>
</head>

<body <?php if(isset($_SESSION['succ'])){ echo 'onload="round_success_noti();"';}elseif(isset($_SESSION['err'])){ echo 'onload="round_error_noti();"';}?>>
    
    <div class="wrapper">
         <!--sidebar wrapper --><?php include "../nav.php";?>
    
		<?php include "navinn.php"; ?>
        
		<?php include "../nav2.php"; ?>
        <script>
		<?php if(isset($_SESSION['succ'])){ ?>function round_success_noti() {
	Lobibox.notify('success', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		icon: 'bx bx-check-circle',
		delayIndicator: false,
		continueDelayOnInactiveTab: false,
		position: 'top center',
		msg: '<?php echo $_SESSION['succ']; unset($_SESSION['succ']);?>'
	});}
	<?php }?>
	<?php if(isset($_SESSION['err'])){ ?>
		function round_error_noti() {
	Lobibox.notify('error', {
		pauseDelayOnHover: true,
		size: 'mini',
		rounded: true,
		delayIndicator: false,
		icon: 'bx bx-x-circle',
		continueDelayOnInactiveTab: false,
		position: 'top center',
		msg: '<?php echo $_SESSION['err']; unset($_SESSION['err']);?>'
	});}

	<?php }?>
	</script>


        <div class="page-wrapper">
            <div class="page-content">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">


                </div>
                <!--end row-->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example2" class="table table-striped table-bordered">
                                <center>
                                    <h3>Link Results</h3>
                                </center>
                                <hr>
                                <thead>
                                    <tr>
                                        <th scope="col1">User ID</th>
                                        <th scope="col2">First Name</th>
                                        <th scope="col3">Last Name </th>
                                        <th scope="col4">Country Code</th>
                                        <th scope="col5">Phone Number</th>
                                        <th scope="col6">Email</th>
                                        <th scope="col7">Country</th>
                                        <th scope="col8">County</th>
                                        <th scope="col9">Date Created</th>
                                        <th scope="col9">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM results WHERE link_id=$_GET[id]";
                                    $result = mysqli_query($dbDMS, $query);
                                    if (mysqli_num_rows($result) >= 1) {
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <th scope="row1"><?php echo $row['user_id']; ?></th>
                                                <td><?php echo $row['fname']; ?></td>
                                                <td><?php echo $row['lname']; ?> </td>
                                                <td><?php echo $row['country_code']; ?> </td>
                                                <td><?php echo $row['phone']; ?> </td>
                                                <td><?php echo $row['email']; ?> </td>
                                                <td> <?php echo $row['country']; ?></td>
                                                <td> <?php echo $row['county']; ?></td>
                                                <td> <?php echo $row['date_created']; ?></td>
                                                <td><a href="server.php?deleteRESULTS=<?php echo $row['user_id']; ?>&id=<?php echo $_GET['id'];?>"><button type="button" 
                                                class="btn btn-outline-danger mt-2"><i class="bx bx-trash me-0 btn-sm"></i></button></a></td>
                                            </tr>
                                    <?php }
                                    } else {
                                        echo 'no data';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include "modals.php"; ?>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <div class="switcher-wrapper">
        <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
        </div>
        <div class="switcher-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
                <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
            </div>
            <hr />
            <h6 class="mb-0">Theme Styles</h6>
            <hr />
            <div class="d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                    <label class="form-check-label" for="lightmode">Light</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                    <label class="form-check-label" for="darkmode">Dark</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                    <label class="form-check-label" for="semidark">Semi Dark</label>
                </div>
            </div>
            <hr />
            <div class="form-check">
                <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
                <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
            </div>
            <hr />
            <h6 class="mb-0">Header Colors</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator headercolor1" id="headercolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor2" id="headercolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor3" id="headercolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor4" id="headercolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor5" id="headercolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor6" id="headercolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor7" id="headercolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator headercolor8" id="headercolor8"></div>
                    </div>
                </div>
            </div>

            <hr />
            <h6 class="mb-0">Sidebar Backgrounds</h6>
            <hr />
            <div class="header-colors-indigators">
                <div class="row row-cols-auto g-3">
                    <div class="col">
                        <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                    </div>
                    <div class="col">
                        <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script src="assets/js/index.js"></script>
    <!--app JS-->
    
    <script src="assets/js/table-datatable.js"></script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>

</body>

</html>