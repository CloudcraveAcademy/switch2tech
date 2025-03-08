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
                     <div class="tpd-content-layout">
                        <!-- my-course-area-start -->
                        <section class="tp-dashboard-course-wrapper">
                           <div class="row">
                              <div class="col-8">
                                 <div class="tp-dashboard-section">
                                    <h2 class="tp-dashboard-title">My Enrollments</h2>
                                 </div>
                              </div>
                              
                           </div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="tp-dashboard-course-list">
                                    <ul>
                                       <li class="active">
                                          <div class="tp-dashboard-course-item">
                                             <div class="tp-dashboard-course-name">
                                                <h5 class="tp-dashboard-course-name-title">Course Name</h5>
                                             </div>
                                             <div class="tp-dashboard-course-enroll">
                                                <span>Total Enrollements</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>Total Earnings</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>&nbsp; </span>
                                             </div>
                                          </div>
                                       </li>
                                       <?php
// Include the database connection
include 'connect.php';

// Replace 'your_instructor_id' with the actual instructor ID or a variable representing the logged-in instructor
//$instructor_id = 1; // Example value; use a dynamic value as needed

// SQL query to get course details, total enrollments, and earnings for a specific instructor
$query = "
    SELECT 
        c.course_id,
        c.course_name,
        COUNT(e.enrollment_id) AS total_enrollments,
        ROUND(
            SUM(
                IFNULL(
                    (c.price - (c.price * (c.discount_percentage / 100))) * 0.30 * IF(e.enrollment_id IS NOT NULL, 1, 0), 
                    0
                )
            ), 
            2
        ) AS total_earnings
    FROM 
        courses c
    LEFT JOIN 
        enrollments e ON c.course_id = e.course_id
    WHERE 
        c.instructor_id = ?
    GROUP BY 
        c.course_id
    ORDER BY 
        c.course_name"; // Order by course name for better readability

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $instructor_id); // Bind the instructor ID parameter
$stmt->execute();
$result = $stmt->get_result();

// Check if any records are found
if ($result->num_rows > 0):
    // Loop through and display the results
    while ($course = $result->fetch_assoc()):
?>
      

                                      <li>
                                          <div class="tp-dashboard-course-item">
                                             <div class="tp-dashboard-course-name">
                                                <h5 class="tp-dashboard-course-name-title">
                                                <a href="course_update.php?id=<?php echo $course['course_id']; ?>">
                            <?php echo htmlspecialchars($course['course_name']); ?>
                        </a>
                                                </h5>
                                             </div>
                                             <div class="tp-dashboard-course-enroll">
                                             <span><?php echo $course['total_enrollments']; ?></span> <!-- Display total enrollments -->
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>$<?php echo number_format($course['total_earnings'], 2); ?></span> <!-- Display total earnings -->
                                             </div>
                                             <div class="tpd-badge sucess">
                                             <a href="course_update.php">
                                             <a href="instructor_enroll-details.php?c_id=<?php echo $course['course_id']; ?>">Details</a>
                                                  
                                                </a>
                                             </div>
                                          </div>
                                       </li>


<?php
    endwhile;
else:
    // Display a message if no records are found
    echo "<li>No records found</li>";
endif;

// Close the statement and connection
$stmt->close();
//$conn->close();
?>
                                       
                                     
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <!-- my-course-area-end --> 
                    
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