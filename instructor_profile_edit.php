<?php
session_start();
if (!isset($_SESSION['instructor_logged_in']) || $_SESSION['instructor_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

?>
<?php
// Get the instructor ID from the session
$instructor_id = $_SESSION['instructor_id'];
?>
 <!-- Update code start -->
 <?php
// Include database connection
include('connect.php'); // Ensure this file contains your DB connection logic

// echo "Script started"; // Debug message to ensure the script is running

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   // echo "Form submitted"; // Debug message to confirm form submission

    // Get form data and sanitize it
    $instructor_id = $_POST['instructor_id'];
    $instructor_name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $phone = $_POST['phone'];
    $role = $_POST['current_role'];
    $gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $bank_account_details = $_POST['bank_account_details'];

    //echo "Instructor ID: $instructor_id"; // Debug message to confirm instructor ID received

    // Handle file upload
    $profile_pic = $_FILES['profile_pic']['name'];
    $target_dir = "assets/uploads/instructors/";
    $target_file = $target_dir . basename($profile_pic);
    $upload_success = true;

    if (!empty($profile_pic)) {
        // Check if the file is an image
        $check = getimagesize($_FILES['profile_pic']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
                $upload_success = true;
              //  echo "File uploaded successfully"; // Debug message for successful file upload
            } else {
                $upload_success = false;
                echo "<script type='text/javascript'>alert('Error uploading the file.');</script>";
               // echo "Error: File upload failed"; // Additional debug message
            }
        } else {
            $upload_success = false;
            echo "<script type='text/javascript'>alert('File is not an image.');</script>";
          //  echo "Error: File is not an image"; // Additional debug message
        }
    }

    // Proceed with the update only if the upload was successful
    if ($upload_success) {
        // Construct base SQL query with backticks for column names
        $update_query = "UPDATE instructors SET 
            `instructor_name` = ?, 
            `email` = ?, 
            `location` = ?, 
            `phone_number` = ?, 
            `current_role` = ?, 
            `gender` = ?, 
            `bio` = ?, 
            `bank_account_details` = ?";

        // Add profile picture if a new one was uploaded
        if (!empty($profile_pic)) {
            $update_query .= ", `profile_picture` = ?";
        }

        $update_query .= " WHERE `instructor_id` = ?";
       // echo "Update Query: $update_query"; // Debug message to print the SQL query

        // Prepare statement
        if ($stmt = mysqli_prepare($conn, $update_query)) {
            // Bind parameters dynamically based on whether the profile picture is included
            if (!empty($profile_pic)) {
                mysqli_stmt_bind_param($stmt, 'sssssssssi', $instructor_name, $email, $location, $phone, $role, $gender, $bio, $bank_account_details, $profile_pic, $instructor_id);
            } else {
                mysqli_stmt_bind_param($stmt, 'ssssssssi', $instructor_name, $email, $location, $phone, $role, $gender, $bio, $bank_account_details, $instructor_id);
            }

           // echo "Prepared statement created"; // Debug message to confirm statement creation

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<script type='text/javascript'>alert('Profile updated successfully.');</script>";
            } else {
                echo "<script type='text/javascript'>console.error('Error executing statement: " . mysqli_stmt_error($stmt) . "'); alert('Error updating profile, please check the console for details.');</script>";
              //  echo "Error executing statement: " . mysqli_stmt_error($stmt); // Additional debug message
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<script type='text/javascript'>console.error('Error preparing the statement: " . mysqli_error($conn) . "');</script>";
           // echo "Error preparing statement: " . mysqli_error($conn); // Additional debug message
        }
    } else {
        echo "<script type='text/javascript'>console.error('File upload failed or file was not an image.');</script>";
       // echo "File upload failed or was not an image"; // Additional debug message
    }
}

//echo "Script ended"; // Final debug message to confirm script execution completed
?>

                      <!-- Update code wnd -->




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
   <style>
  .file-upload {
    display: none;
  }

  .custom-upload-label {
    display: inline-block;
    cursor: pointer;
  }

  .custom-upload-label svg {
    vertical-align: middle;
  }
</style>
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
    $email = $instructor['email'];
    $location = $instructor['location'];
    $phone = $instructor['phone_number'];
    $role = $instructor['current_role'];
    $gender = $instructor['gender'];
    $bank_account_details = $instructor['bank_account_details'];
    $bio = $instructor['bio'];
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
                     
                      <!-- profile start -->
                      <div class="">

<div class="tpd-course-area">
   <div class="row">
      <div class="col-12">
         <div class="tp-dashboard-tab mb-25">
            <h2 class="tp-dashboard-tab-title">My Profile</h2>
            <div class="tp-dashboard-tab-list">
               <ul>
               <li>
                     <a  href="instructor_profile.php"> Profile</a>
                  </li>
                  <li>
                     <a class="active" href="instructor_profile_edit.php">Edit Profile</a>
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
   <form action="instructor_profile_edit.php" method="POST" enctype="multipart/form-data">
      <div class="col-12">
         <div class="tpd-setting-box profile">
            <div class="tp-dashboard-banner-bg profile mb-100" data-background="assets/img/dashboard/bg/dashboard-bg-1.jpg">
               <div class="tp-instructor-wrap d-flex justify-content-between">
                  <div class="tp-instructor-info d-flex">
                     <div class="tp-instructor-avatar p-relative profile">
                        <img src="assets/uploads/instructors/<?php echo $profile_picture; ?>" alt="">
                          <span><label for="file-upload" class="custom-upload-label">
                            <svg width="38" height="38" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <circle cx="19" cy="19" r="18" fill="white" stroke="#E6E8F0" />
                           <path d="M23.352 13.5172L23.272 13.3463C23.056 12.9034 22.808 12.3907 22.656 12.0954C22.288 11.3962 21.656 11.0078 20.88 11H17.112C16.336 11.0078 15.712 11.3962 15.344 12.0954C15.184 12.4062 14.912 12.9656 14.688 13.424L14.64 13.5172C14.616 13.5794 14.552 13.6104 14.488 13.6104C12.56 13.6104 11 15.1332 11 16.9978V21.6127C11 23.4772 12.56 25 14.488 25H23.512C25.432 25 27 23.4772 27 21.6127V16.9978C27 15.1332 25.432 13.6104 23.512 13.6104C23.44 13.6104 23.384 13.5716 23.352 13.5172Z" fill="#303651" />
                           <path d="M19.0035 15.9806C19.8435 15.9806 20.6355 16.2992 21.2275 16.8741C21.8195 17.4568 22.1475 18.2259 22.1475 19.0339C22.1395 19.8808 21.7875 20.6421 21.2195 21.1937C20.6515 21.7454 19.8675 22.0872 19.0035 22.0872C18.1635 22.0872 17.3795 21.7687 16.7795 21.1937C16.1875 20.6111 15.8595 19.8497 15.8595 19.0339C15.8515 18.2259 16.1795 17.4646 16.7715 16.8819C17.3715 16.2992 18.1635 15.9806 19.0035 15.9806ZM19.0035 17.146C18.4835 17.146 17.9955 17.3402 17.6195 17.7054C17.2515 18.0628 17.0515 18.5367 17.0595 19.0262V19.0339C17.0595 19.5389 17.2595 20.0128 17.6275 20.3702C17.9955 20.7276 18.4835 20.9218 19.0035 20.9218C20.0755 20.9218 20.9395 20.075 20.9475 19.0339C20.9475 18.5289 20.7475 18.055 20.3795 17.6976C20.0115 17.3402 19.5235 17.146 19.0035 17.146ZM23.4915 15.7942C23.8915 15.7942 24.2195 16.1127 24.2195 16.5012C24.2195 16.8896 23.8915 17.2004 23.4915 17.2004C23.0915 17.2004 22.7715 16.8896 22.7715 16.5012C22.7715 16.1127 23.0915 15.7942 23.4915 15.7942Z" fill="white" />
                         </svg></label><input type="file" id="file-upload" name="profile_pic" class="file-upload"></span>
                     </div>
                  </div>
                  <div class="tp-instructor-course-btn profile">
                    <span><svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                       
                  </div>
               </div>
            </div>
            <div class="tpd-setting-from">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="tpd-input">
                        <label   >Name</label>
                        <input type="text" name="name" value="<?php echo $instructor_name; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tpd-input">
                        <label   >Email(Username)</label>
                        <input type="email" name="email" value="<?php echo $email; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tpd-input">
                        <label   >Location </label>
                        <input type="text" name="location" value="<?php echo $location; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tpd-input">
                        <label   >Phone Number</label>
                        <input type="text" name="phone" value="<?php echo $phone; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tpd-input">
                        <label   >Current Job Role</label>
                        <input type="text" name="current_role" value="<?php echo $role; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tpd-input">
                     <label>Gender</label><br>
                     <input type="text" name="gender" value="<?php echo $gender; ?>" required>
                     </div>
                  </div>
                  <div class="col-lg-12">
                  <div class="tpd-new-course-box-1">
                  <div class="tpd-input">
                        <label   >Bank Account Details</label>
                        <textarea name="bank_account_details" required><?php echo $bank_account_details; ?></textarea>
                        </div> 
                </div>
                     <div class="tpd-input">
                        <label   >About me</label>
                        <textarea name="bio" required><?php echo $bio; ?></textarea>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tpd-setting-cartificate">
            <input type="hidden" name="instructor_id" value="<?php echo $instructor_id; ?>">
               <div class="tpd-setting-cartificate-btn">
                  <button>Save Changes</button>
               </div>
            </div>
         </div>
      </div>
    </form>
   </div>
</div></div>
                      <!-- profile end -->
                     <!-- <div class="tpd-content-layout">
              
                  </div> -->
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