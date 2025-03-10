<?php
session_start();
require 'connect.php'; // Include your database connection file

if (isset($_SESSION['instructor_logged_in']) && $_SESSION['instructor_logged_in'] === true) {
   header('Location: instructor_dashboard.php');
   exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Prepare and execute a query to check if the instructor exists and is approved
   $stmt = $conn->prepare("SELECT instructor_id, password, status FROM instructors WHERE email = ?");
   $stmt->bind_param("s", $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      $instructor = $result->fetch_assoc();

      // Check if the instructor is approved
      if ($instructor['status'] !== 'approved') {
         $error_message = 'Your account is not approved yet. Please contact the administrator.';
      } elseif (password_verify($password, $instructor['password'])) {
         // Password matches, set session
         $_SESSION['instructor_logged_in'] = true;
         $_SESSION['instructor_id'] = $instructor['instructor_id']; // Optional for tracking instructor ID
         header('Location: instructor_dashboard.php');
         exit;
      } else {
         $error_message = 'Invalid email or password. Please try again.';
      }
   } else {
      $error_message = 'Invalid email or password. Please try again.';
   }

   $stmt->close();
   $conn->close();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Instructor Login</title>
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
                        <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round">
                        </circle>
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
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
               stroke-linejoin="round" />
         </svg>
      </button>
   </div>
   <!-- back to top end -->


   <main>

      <!-- login area start -->
      <section class="tp-login-area">
         <div class="tp-login-register-box d-flex align-items-center">
            <div class="tp-login-register-banner-box p-relative" data-background="assets/img/login/login-register-bg.jpg">
               <div class="tp-login-register-logo tp-header-logo">
                  <a href="index.html"><img src="assets/img/logo/logo-white.png" alt=""></a>
               </div>
               <div class="tp-login-register-heading">
                  <h3 class="tp-login-register-title">Discover world <br> best online courses here.</h3>
                  https://www.canva.com/design/DAGaBmGqNhc/ccCC7V64uemYdmko4Wge2A/watch
               </div>
               <div class="tp-login-register-shape">
                  <div class="shape-1">
                     <img src="assets/img/login/login-register-shape-2.png" alt="">
                  </div>
                  <div class="shape-2">
                     <img src="assets/img/login/login-register-shape-1.png" alt="">
                  </div>
                  <div class="shape-3">
                     <img src="assets/img/login/login-register-shape-3.png" alt="">
                  </div>
               </div>
            </div>
            <div class="tp-login-register-wrapper d-flex justify-content-center align-items-center">
               <div class="tp-login-from-box">
                  <div class="tp-login-from-heading text-center">
                     <h4 class="tp-login-from-title">Instructor Login</h4>


                     <?php if (!empty($error_message)) {
                        echo "<p style='color:red;'>$error_message</p>";
                     } ?>


                     <p>Enter the login detail you received in your <a href="#">Welcome email</a></p>
                  </div>
                  <form method="POST" action="login.php">
                     <div class="tp-login-input-form">
                        <div class="row">
                           <div class="col-12">
                              <div class="tp-login-input p-relative">
                                 <label for="username">Username:</label>
                                 <input type="email" name="email" id="email" placeholder="Enter your email registered address" required>
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="tp-login-input p-relative">
                                 <label for="password">Password:</label>
                                 <div class="password-input p-relative">
                                    <input type="password" name="password" id="password" placeholder="Enter your registered Password" required><br>
                                    <div class="tp-login-input-eye password-show-toggle">
                                       <span class="open-eye open-eye-icon">
                                          <svg width="18" height="14" viewBox="0 0 18 14" fill="none">
                                             <path d="M1 6.77778C1 6.77778 3.90909 1 9 1C14.0909 1 17 6.77778 17 6.77778C17 6.77778 14.0909 12.5556 9 12.5556C3.90909 12.5556 1 6.77778 1 6.77778Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M9.00018 8.94466C10.2052 8.94466 11.182 7.97461 11.182 6.77799C11.182 5.58138 10.2052 4.61133 9.00018 4.61133C7.79519 4.61133 6.81836 5.58138 6.81836 6.77799C6.81836 7.97461 7.79519 8.94466 9.00018 8.94466Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                          </svg>
                                       </span>
                                       <span class="open-close close-eye-icon">
                                          <svg width="19" height="18" viewBox="0 0 19 18" fill="none">
                                             <path d="M6.8822 11.7457C6.72311 11.7457 6.56402 11.6871 6.43842 11.5615C5.7518 10.8749 5.375 9.9622 5.375 8.99926C5.375 6.99803 6.99943 5.3736 9.00066 5.3736C9.9636 5.3736 10.8763 5.7504 11.5629 6.43701C11.6801 6.55424 11.7471 6.71333 11.7471 6.8808C11.7471 7.04827 11.6801 7.20736 11.5629 7.32459L7.32599 11.5615C7.20039 11.6871 7.0413 11.7457 6.8822 11.7457ZM9.00066 6.6296C7.69442 6.6296 6.631 7.69302 6.631 8.99926C6.631 9.41793 6.73986 9.81985 6.94082 10.1715L10.1729 6.93941C9.82125 6.73845 9.41933 6.6296 9.00066 6.6296Z" fill="#1C274C" />
                                             <path opacity="0.5" d="M3.63816 14.4503C3.49582 14.4503 3.3451 14.4001 3.22787 14.2996C2.33192 13.5376 1.52808 12.5998 0.841463 11.5112C-0.0461127 10.1296 -0.0461127 7.87721 0.841463 6.48723C2.88456 3.28861 5.8571 1.44647 8.99711 1.44647C10.8393 1.44647 12.6563 2.08285 14.2472 3.28024C14.5235 3.48957 14.5821 3.88312 14.3728 4.15944C14.1635 4.43576 13.7699 4.49437 13.4936 4.28504C12.1204 3.24674 10.5629 2.70248 8.99711 2.70248C6.29252 2.70248 3.70515 4.32691 1.89651 7.16547C1.2685 8.14516 1.2685 9.85332 1.89651 10.833C2.52451 11.8127 3.24462 12.6584 4.04009 13.345C4.29966 13.5711 4.33315 13.9646 4.10707 14.2326C3.98984 14.3749 3.814 14.4503 3.63816 14.4503Z" fill="#1C274C" />
                                             <path opacity="0.5" d="M9.00382 16.552C7.89017 16.552 6.80163 16.3259 5.75496 15.8821C5.43678 15.7482 5.28606 15.3797 5.42003 15.0616C5.554 14.7434 5.92243 14.5927 6.24062 14.7266C7.12819 15.1034 8.05764 15.296 8.99545 15.296C11.7 15.296 14.2874 13.6716 16.0961 10.833C16.7241 9.85333 16.7241 8.14517 16.0961 7.16548C15.8365 6.75519 15.5518 6.36164 15.2503 5.99321C15.0326 5.72527 15.0745 5.33172 15.3425 5.10564C15.6104 4.88793 16.0039 4.92142 16.23 5.19775C16.5566 5.59967 16.8748 6.03508 17.1595 6.48724C18.047 7.86885 18.047 10.1213 17.1595 11.5113C15.1164 14.7099 12.1438 16.552 9.00382 16.552Z" fill="#1C274C" />
                                             <path d="M9.58061 12.5747C9.28754 12.5747 9.01959 12.3654 8.96098 12.0639C8.89399 11.7206 9.12007 11.3941 9.46338 11.3355C10.3845 11.168 11.1548 10.3976 11.3223 9.47657C11.3893 9.13327 11.7158 8.91556 12.0591 8.97417C12.4024 9.04116 12.6285 9.36772 12.5615 9.71103C12.2936 11.1596 11.1381 12.3068 9.69783 12.5747C9.65597 12.5663 9.62247 12.5747 9.58061 12.5747Z" fill="#1C274C" />
                                             <path d="M0.625908 18.0007C0.466815 18.0007 0.307721 17.9421 0.18212 17.8165C-0.0607068 17.5736 -0.0607068 17.1717 0.18212 16.9289L6.43702 10.674C6.67984 10.4312 7.08177 10.4312 7.32459 10.674C7.56742 10.9168 7.56742 11.3188 7.32459 11.5616L1.0697 17.8165C0.944096 17.9421 0.785002 18.0007 0.625908 18.0007Z" fill="#1C274C" />
                                             <path d="M11.122 7.50881C10.9629 7.50881 10.8038 7.45019 10.6782 7.32459C10.4354 7.08177 10.4354 6.67984 10.6782 6.43702L16.9331 0.182121C17.1759 -0.0607068 17.5779 -0.0607068 17.8207 0.182121C18.0635 0.424948 18.0635 0.826869 17.8207 1.0697L11.5658 7.32459C11.4402 7.45019 11.2811 7.50881 11.122 7.50881Z" fill="#1C274C" />
                                          </svg>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12">
                              <div class="tp-login-from-remeber">
                                 <div class="row">
                                    <div class="col-6">
                                       <div class="tp-contact-input-remeber login">
                                          <input id="remeber" type="checkbox">
                                          <label for="remeber">Save account</label>
                                       </div>
                                    </div>
                                    <div class="col-6">
                                       <div class="tp-login-input-remeber text-end">
                                          <a href="#">Forgot Password?</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="tp-login-from-btn">

                                 <button type="submit" class="tp-btn-inner w-100 text-center">Login</button>
                              </div>
                  </form>


               </div>
            </div>
         </div>
         </div>
         </div>
         </div>
      </section>
      <!-- login area end -->

   </main>


   <!-- JS here -->
   <script src="assets/js/vendor/jquery.js"></script>
   <script src="assets/js/vendor/waypoints.js"></script>
   <script src="assets/js/bootstrap-bundle.js"></script>
   <script src="assets/js/swiper-bundle.js"></script>
   <script src="assets/js/slick.js"></script>
   <script src="assets/js/range-slider.js"></script>
   <script src="assets/js/magnific-popup.js"></script>
   <script src="assets/js/nice-select.js"></script>
   <script src="assets/js/purecounter.js"></script>
   <script src="assets/js/countdown.js"></script>
   <script src="assets/js/wow.js"></script>
   <script src="assets/js/isotope-pkgd.js"></script>
   <script src="assets/js/imagesloaded-pkgd.js"></script>
   <script src="assets/js/flatpickr.js"></script>
   <script src="assets/js/ajax-form.js"></script>
   <script src="assets/js/main.js"></script>

</body>

</html>