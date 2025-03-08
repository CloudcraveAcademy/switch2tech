<?php
session_start(); // This should be the first line in the file
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <?php require_once 'head.php'; ?>
</head>

<body>

   <!-- pre loader area start -->
   <?php require_once 'preloader.php'; ?>
   <!-- pre loader area end -->

   <!-- back to top start -->
   <div class="back-to-top-wrapper">
      <button id="back_to_top" type="button" class="back-to-top-btn">
         <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
         </svg>
      </button>
   </div>
   <!-- back to top end -->

   <!-- search area start -->
   <?php require_once 'top_search.php'; ?>
   <!-- search area end -->

   <!-- cart mini area start -->
   <?php require_once 'mini_cart.php'; ?>
   <!-- cart mini area end -->

   <!-- header-area-start -->
   <?php require_once 'header.php'; ?>
   <!-- header-area-end -->

   <!-- offcanvas area start -->
   <?php require_once 'off_canvas.php'; ?>
   <!-- offcanvas area end -->

   <main>
   <?php

// Include the database connection
include 'connect.php';  // Make sure the path to 'connect.php' is corrects

// Define variables and initialize with empty values
$name = $email = $message = "";
$name_err = $email_err = $message_err = $captcha_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate message
    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter your message.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Validate CAPTCHA
    if (empty(trim($_POST["captcha"])) || $_POST["captcha"] !== $_SESSION["captcha_code"]) {
        $captcha_err = "Invalid CAPTCHA.";
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($message_err) && empty($captcha_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement
            $stmt->bind_param("sss", $name, $email, $message);

            // Execute the statement
            if ($stmt->execute()) {
                echo "Thank you for contacting us, $name! Your message has been submitted.";
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error: Could not prepare the query.";
        }
    }

    // Close the database connection
    $conn->close();
}
?>
      <!-- contact area start -->
      <section class="tp-contact-area tp-contact-p fix p-relative pt-150 pb-125">
         <div class="tp-contact-bg" data-background="assets/img/live/contact-bg.png"></div>
         <div class="tp-contact-shape">
            <span>
               <svg width="1920" height="559" viewBox="0 0 1920 559" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1958.7 6.55286C1332.03 310.106 2369.35 119.238 2232.58 220.873C2018.48 379.976 692.5 607.75 254.5 538.145C-27.1058 493.393 1387 130.595 -280 395.595" stroke="url(#paint0_linear_2756_1168)" stroke-width="14" />
                  <defs>
                     <linearGradient id="paint0_linear_2756_1168" x1="92.1912" y1="171.542" x2="1827.4" y2="294.717" gradientUnits="userSpaceOnUse">
                     </linearGradient>
                  </defs>
               </svg>
            </span>
         </div>
         <div class="tp-contact-shape-2">
            <img src="assets/img/live/contact-shape-2.svg" alt="">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-10">
                  <div class="tp-contact-wrap p-relative">
                     <div class="tp-contact-heading text-center">
                        <h3 class="tp-contact-title">Get in Touch</h3>
                        <p>We are here to answer any question you may have.</p>
                     </div>
                     <div class="tp-contact-from-box">
                        <h3 class="tp-contact-from-title">Send a Message 👍🏻</h3>
                        
                       

                        <form action="contact.php" method="POST">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <span><?php echo $name_err; ?></span>
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>">
            <span><?php echo $email_err; ?></span>
        </div>
        
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message"><?php echo $message; ?></textarea>
            <span><?php echo $message_err; ?></span>
        </div>
        
        <!-- CAPTCHA Image -->
        <div>
            <label for="captcha">Enter the text from the image:</label>
            <img src="captcha.php" alt="CAPTCHA Image">
            <input type="text" id="captcha" name="captcha">
            <span><?php echo $captcha_err; ?></span>
        </div>

        <div>
            <input type="submit" class="tp-btn-inner" value="Submit">
        </div>
    </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- contact area end -->

      <!-- contact info area start -->
      <section class="tp-contact-info-area tp-contact-p pb-90">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-10">
                  <div class="tp-contact-info-wrapper text-center">
                     <h3 class="tp-contact-main-title">Let us know how we can help</h3>
                  </div>
                  <div class="row">
                     <div class="col-lg-4 col-md-6">
                        <div class="tp-contact-info-item mb-30">
                           <div class="tp-contact-info-icon">
                              <!-- Icon SVG here -->
                           </div>
                           <h4 class="tp-contact-info-title">Feedbacks</h4>
                           <p>Speak to our Friendly team.</p>
                           <a href="mailto:Support@gmail.com">Support@gmail.com</a>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="tp-contact-info-item mb-30">
                           <div class="tp-contact-info-icon">
                              <!-- Icon SVG here -->
                           </div>
                           <h4 class="tp-contact-info-title">Call Us</h4>
                           <p>Mon-Fri from 8am to 5pm</p>
                           <a href="tel:555000-0000">+1(555) 000-0000</a>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <div class="tp-contact-info-item mb-30">
                           <div class="tp-contact-info-icon">
                              <!-- Icon SVG here -->
                           </div>
                           <h4 class="tp-contact-info-title">Visit Us</h4>
                           <p>123 Main Street, City</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- contact info area end -->
   </main>

   <!-- footer -->
   <?php require_once 'footer.php'; ?>

     <!-- JS here -->
     <script src="assets/js/vendor/jquery.js"></script>
      <script src="assets/js/vendor/waypoints.js"></script>
      <script src="assets/js/bootstrap-bundle.js"></script>
      <script src="assets/js/swiper-bundle.js"></script>
      <script src="assets/js/slick.js"></script>
      <script src="assets/js/range-slider.js"></script>
      <script src="assets/js/magnific-popup.js"></script>
      <script src="assets/js/nice-select.js"></script>
      <script src="assets/js/select2.min.js"></script>
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
