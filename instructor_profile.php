<?php
session_start();
if (!isset($_SESSION['instructor_logged_in']) || $_SESSION['instructor_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
// Get the instructor ID from the session
$instructor_id = $_SESSION['instructor_id'];
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Instructor Dashboard</title>
   <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Place favicon.ico in the root directory -->
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.png">

   <!-- CSS here -->
   <link rel="stylesheet" href="assets/css/bootstrap.css">
   <link rel="stylesheet" href="assets/css/animate.css">
   <link rel="stylesheet" href="assets/css/swiper-bundle.css">
   <link rel="stylesheet" href="assets/css/slick.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <link rel="stylesheet" href="assets/css/flatpickr.min.css">
   <link rel="stylesheet" href="assets/css/font-awesome-pro.css">
   <link rel="stylesheet" href="assets/css/spacing.css">
   <link rel="stylesheet" href="assets/css/main.css">
   
</head>

   <body>
   
      <!-- pre loader area start -->
      <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <!-- loading content here -->
               <div class="tp-preloader-content">
                  <div class="tp-preloader-logo">
                     <div class="tp-preloader-circle">
                        <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                           <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                        </svg>
                     </div>
                     <img src="assets/img/logo/preloader/preloader-icon.png" alt="">
                  </div>
                  <p class="tp-preloader-subtitle">Loading...</p>
               </div>
            </div>
         </div>
      </div>
      <!-- pre loader area end -->
   
      <!-- back to top start -->
      <div class="back-to-top-wrapper">
         <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
         </button>
      </div>
      <!-- back to top end -->
   


   
   


       <!-- header-area-start -->
       <header class="header-area">
         <div class="tp-header-2 tp-header-new-course">
            <div class="container-fluid">
               <div class="row align-items-center">
                  <div class="col-2">
                     <div class="tp-header-2-right d-flex align-items-center">
                        <div class="logo tp-header-logo">
                           <a href="index.html">
                              <img src="assets/img/logo/logo-black.png" alt="logo">
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-10">
                     <div class="tp-header-new-course-right d-flex justify-content-end">
                        <div class="tp-header-new-course-option d-none d-sm-block">
                           <a class="draft" href="logout.php">Logout</a>
                       </div>
                        <span>
                           <a href="logout.php"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M15 1L1 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                           <path d="M1 1L15 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                         </svg></a>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header-area-end -->


      <!-- offcanvas area start -->
      <!-- offcanvas area end -->
   
      <main class="tp-dashboard-body-bg">

       <!-- dashboard-banner-area-start -->
   <?php
      
include_once 'connect.php';

// Ensure instructor_id is in the session
if (!isset($_SESSION['instructor_id'])) {
    die("Instructor ID is not set in the session.");
}

$instructor_id = $_SESSION['instructor_id'];

// SQL query to fetch profile details
$query = "SELECT * FROM instructors WHERE instructor_id = $instructor_id";

// Execute the query
$result = $conn->query($query);

// Check if the query executed successfully
if ($result && $result->num_rows > 0) {
    // Fetch the data
    $instructor = $result->fetch_assoc();
    
    $instructor_name = $instructor['instructor_name'];
    $location = $instructor['location'];
    $profile_picture = $instructor['profile_picture'];
    $role = $instructor['current_role'];
} else {
    // Handle error or case where instructor is not found
    $instructor_name = "Unknown Instructor";
    $location = "Not Assigned";
    $profile_picture = "default.jpg"; // default image in case no image is set
}
?>
         <section class="tp-dashboard-banner-wrap">
            <div class="tp-dashboard-banner-shape"><img src="assets/img/dashboard/bg/dashboard-bg-shape-1.jpg" alt=""></div>
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-dashboard-banner-bg mt-30" data-background="assets/img/dashboard/bg/dashboard-bg-1.jpg">
                        <div class="tp-instructor-wrap d-flex justify-content-between">
                           <div class="tp-instructor-info d-flex">
                              <div class="tp-instructor-avatar">
                                 <img src="assets/uploads/instructors/<?php echo $profile_picture; ?>" alt=""  class="circular-image" width=120>
                              </div>
                              <div class="tp-instructor-content">
                                 <h4 class="tp-instructor-title"><?php echo $instructor_name; ?>  </h4>
                                 <div class="tp-instructor-rate  d-flex align-items-center">
                                    <span> <?php echo htmlspecialchars($role); ?> </span>
                                    <!-- <span>Joined : 12 July, 2021</span> -->
                                 </div>
                                 <div class="tp-instructor-rate  d-flex align-items-center">
                                    <span>Location : <?php echo htmlspecialchars($location); ?>  </span>
                                    <!-- <span>Joined : 12 July, 2021</span> -->
                                 </div>

                              </div>
                           </div>
                           <div class="tp-instructor-course-btn">
                              <a class="tp-btn-add-course" href="create_course.php"><i class="fa-regular fa-plus"></i> Create a New Course</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- dashboard-banner-area-end -->

         <!-- dashboad-content-box-area-start -->
         <section class="tpd-main pb-75">
            <div class="container">
               <div class="row">
                  <div class="col-lg-3">

                     <!-- dashboard-menu-area-start -->
                     <?php
         require_once 'instructor_menu.php';
                          ?>    
                     <!-- dashboard-menu-area-end -->

                  </div>
                  <div class="col-lg-9">

                     <!-- dashboard-content-area-start -->
                      <!-- profile strnat -->
                      <div class="">

<div class="tpd-course-area">
   <div class="row">
      <div class="col-12">
         <div class="tp-dashboard-tab mb-25">
            <h2 class="tp-dashboard-tab-title">My Profile</h2>
            <div class="tp-dashboard-tab-list">
               <ul>
               <li>
                     <a class="active" href="instructor_profile.php"> Profile</a>
                  </li>
                  <li>
                     <a href="instructor_profile_edit.php">Edit Profile</a>
                  </li>
                  <!-- <li>
                     <a href="instructor_password_reset.php">Reset Password</a>
                  </li> -->
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
     
   </div>
</div></div>
                      <!-- profile end -->
                     <div class="tpd-content-layout">
                        
                     <?php
// Include database connection
include('connect.php'); // Replace with your actual connection file

// Fetch instructor details
$query = "SELECT * FROM instructors WHERE instructor_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $instructor_id);
$stmt->execute();
$result = $stmt->get_result();
$instructor = $result->fetch_assoc();

if ($instructor):
?>
<!-- profile-area-start -->
<div class="tp-profile-wrapper">
    
               <div class="tp-profile-box">
                
                <div class="tp-profile-wrap">
                    <ul> 
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Registration Date</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo date('F d, Y H:i a', strtotime($instructor['created_at'])); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Full Name</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['instructor_name']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Email</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['email']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Phone Number</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['phone_number']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Skill/Occupation</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['current_role']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Location</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['location']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Gender</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['gender']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Registration Status</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['status']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Bank Account Details</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span><?php echo htmlspecialchars($instructor['bank_account_details']); ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tp-profile-info d-flex">
                                <div class="tp-profile-info-tag">
                                    <span>Biography</span>
                                </div>
                                <div class="tp-profile-info-details">
                                    <span class="details-zone"><?php echo nl2br(htmlspecialchars($instructor['bio'])); ?></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- profile-area-end -->
<?php
else:
    echo "<p>Instructor not found.</p>";
endif;

// Close statement and connection
$stmt->close();
$conn->close();
?>

   

                        

                  </div>
               </div>
            </div>
         </section>
         <!-- dashboad-content-box-area-end -->

      </main>
   
       <!-- footer-area-start -->
       <footer>
        
        <div class="tp-footer-bottom tpd-dashboard-footer-bottom">
           <div class="container">
              <div class="row">
                 <div class="col-lg-12">
                    <div class="tp-footer-copyright text-center">
                       <span>© <?php echo date("Y"); ?> <a href="#">Cloudcrave Academy</a>. All rights reserved.</span>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </footer>
     <!-- footer-area-end -->
      <!-- JS here -->
      <script src="assets/js/vendor/jquery.js"></script>
      <script src="assets/js/vendor/waypoints.js"></script>
      <script src="assets/js/bootstrap-bundle.js"></script>
      <script src="assets/js/swiper-bundle.js"></script>
      <script src="assets/js/slick.js"></script>
      <script src="assets/js/magnific-popup.js"></script>
      <script src="assets/js/nice-select.js"></script>
      <script src="assets/js/select2.min.js"></script>
      <script src="assets/js/purecounter.js"></script>
      <script src="assets/js/wow.js"></script>
      <script src="assets/js/isotope-pkgd.js"></script>
      <script src="assets/js/imagesloaded-pkgd.js"></script>
      <script src="assets/js/flatpickr.js"></script>      
      <script src="assets/js/ajax-form.js"></script>
      <script src="assets/js/main.js"></script>

   </body>

</html>