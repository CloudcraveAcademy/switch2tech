<!doctype html>
<html class="no-js" lang="zxx">

   <head>
      <?php
         require_once 'head.php';
      ?>
   </head>

   <body>

      <!-- pre loader area start -->
      <?php
      //   require_once 'preloader.php';
      ?>  
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


      <!-- search area start -->
      <?php
         require_once 'top_search.php';
      ?>
      <!-- search area end -->

      
      <!-- cart mini area start -->
      <?php
         require_once 'mini_cart.php';
      ?>
      <!-- cart mini area end -->


      <!-- header-area-start -->
      <?php
         require_once 'header.php';
      ?>
      <!-- header-area-end -->


      <!-- offcanvas area start -->
      <?php
         require_once 'off_canvas.php';
      ?>
      <!-- offcanvas area end -->

      <main>

         <!-- hero-area-start -->
         <div class="tp-hero-area lightblue-bg tp-hero-2-bg">
            <div class="container custom-container">
               <div class="tp-hero-2-wrap">
                  <div class="row align-items-end">
                     <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-12">
                        <div class="tp-hero-2-content">
                           <span class="tp-hero-2-subtitle wow fadeInUp" data-wow-delay=".3s">Make the switch to a tech career</span>
                           <h2 class="tp-hero-2-title wow fadeInUp" data-wow-delay=".5s">enroll in our 
                               <span>virtual classes <img class="wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/hero-2-svg-1.svg" alt=""></span> 
                               today! </h2>
                           <p class=" wow fadeInUp" data-wow-delay=".7s">Are you looking to transition into a tech career  <br>or enhance your existing tech skills?</p>
                           <div class="tp-hero-2-btn wow fadeInUp" data-wow-delay=".9s">
                              <a class="tp-btn-border" href="course.php">Get started 
                                 <span>
                                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M8.71533 1L13 5.28471L8.71533 9.56941" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M1 5.28473H12.88" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="offset-xxl-4 col-xxl-3 offset-xl-2 col-xl-4 col-lg-5 col-md-6">
                        <!-- start fetch featured banner Course -->
                        <?php
include 'connect.php';


// Set the number of results per page
$results_per_page = 10; 

// Find the total number of results in your courses table
$total_query = "SELECT COUNT(*) AS total FROM courses";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_results = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_results / $results_per_page);

// Get the current page from the URL, if it's not set default to page 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the OFFSET for the SQL query
$offset = ($current_page - 1) * $results_per_page;

// Calculate the start and end numbers
$start_result = ($current_page - 1) * $results_per_page + 1;
$end_result = min($start_result + $results_per_page - 1, $total_results);

$sql = "SELECT 
    c.course_id,
    c.course_name,
    c.description,
    c.price,
    c.discount_percentage AS discount,
    c.course_image_url,
    c.intro_video_url,
    c.duration,
    c.prerequisites,
    c.level,
    c.created_at,
    c.updated_at,
    c.banner_featured,
    c.status,
    cc.category_name AS course_category,
    i.instructor_name,
    i.profile_picture,
    COALESCE(COUNT(e.enrollment_id), 0) AS student_count 
FROM 
    courses c 
LEFT JOIN 
    course_categories cc ON c.category_id = cc.category_id
LEFT JOIN 
    instructors i ON c.instructor_id = i.instructor_id
LEFT JOIN 
    enrollments e ON c.course_id = e.course_id
WHERE c.banner_featured = 1 AND c.status = 'Approved'  
GROUP BY 
    c.course_id, c.course_name, c.description, c.price, c.discount_percentage,
    c.course_image_url, c.intro_video_url, c.duration, c.prerequisites, c.level,
    c.created_at, c.updated_at, c.status, cc.category_name, i.instructor_name, i.profile_picture
LIMIT $results_per_page OFFSET $offset;";

$result = $conn->query($sql);
 $row = $result->fetch_assoc(); 
?>

                        <div class="tp-course-item p-relative fix mb-30">
                            <div class="tp-course-teacher mb-15">
                                <span><img src="assets/uploads/instructors/<?php echo htmlspecialchars($row['profile_picture']); ?>" alt=""><?php echo htmlspecialchars($row['instructor_name']); ?></span>
                                <?php if ($row['discount'] > 0): ?>
                                    <span class="discount">-<?php echo $row['discount']; ?>%</span>
                                <?php endif; ?>
                            </div>
                            <div class="tp-course-thumb">
                                <a href="course-details.php?id=<?php echo htmlspecialchars($row['course_id']); ?>"><img class="course-thumb" src="assets/uploads/courses/<?php echo htmlspecialchars($row['course_image_url']); ?>" alt=""></a>
                            </div>
                            <div class="tp-course-content">
                                <div class="tp-course-tag mb-10">
                                    <span><?php echo htmlspecialchars($row['course_category']); ?></span>
                                </div>
                                <div class="tp-course-meta">
                                    <span><i class="fa-solid fa-book"></i> <?php echo htmlspecialchars($row['duration']); ?> Weeks</span>
                                    <span><i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($row['student_count']); ?> Students</span>
                                </div>
                                <h4 class="tp-course-title">
                                    <a href="course-details.php?id=<?php echo htmlspecialchars($row['course_id']); ?>"><?php echo htmlspecialchars($row['course_name']); ?></a>
                                </h4>
                                <div class="tp-course-rating d-flex align-items-end justify-content-between">
                                             <div class="tp-course-rating-star">
                                                <p>Share<span> Course</span></p>
                                                <div class="tp-blog-details-user-social">
                           <div class="tp-postbox-details-social text-end">
                              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                              <a href="#"><i class="fa-brands fa-twitter"></i></a>
                              <a href="#"><i class="fa-solid fa-link"></i></a>
                           </div>
                        </div>
                                             </div>
                                             <div class="tp-course-pricing">
                                    <?php if ($row['discount'] > 0): ?>
                                        <del>$<?php echo htmlspecialchars(number_format($row['price'])); ?></del>
                                        <span>$<?php echo htmlspecialchars(number_format($row['price'] * (1 - $row['discount'] / 100), 2)); ?>
                                        </span>
                                    <?php else: ?>
                                        <span>$<?php echo htmlspecialchars(number_format($row['price'])); ?></span>
                                    <?php endif; ?>
                                </div>
                                          </div>
                                      


                               
                            </div>


                            <div class="tp-course-btn">
                                <a href="course-details.php?id=<?php echo htmlspecialchars($row['course_id']); ?>">Preview this Course</a>
                            </div>
                        </div>
                  
                        <!-- end fetch featured banner course -->
                       
                     </div>
                  </div>
                  <div class="tp-hero-2-thumb">
                     <img src="assets/img/hero/hero-2-thumb-1.png" alt="">
                  </div>
               </div>
            </div>
            <div class="tp-hero-2-shape">
               <!-- <div class="tp-hero-2-shape-1">
                  <span>
                     <svg xmlns="http://www.w3.org/2000/svg" width="846" height="579" viewBox="0 0 846 579" fill="none">
                        <path class="line-2" d="M212.745 593.864C358.949 649.758 822.546 792.326 466.431 560.525C110.316 328.724 477.436 405.184 743.017 461.029C1008.6 516.874 193.087 -40.2421 69.0387 93.5502C-55.0097 227.343 493.91 431.765 484.946 51.9085" stroke="url(#paint0_linear_311_1041)" stroke-width="100" stroke-linecap="square"/>
                        <defs>
                          <linearGradient id="paint0_linear_311_1041" x1="769.255" y1="703.159" x2="-110.567" y2="48.8101" gradientUnits="userSpaceOnUse">
                          </linearGradient>
                        </defs>
                      </svg>
                  </span>
               </div> -->
               <div class="tp-hero-2-shape-2">
                  <img src="assets/img/hero/hero-2-shape-2.png" alt="">
               </div>
               <div class="tp-hero-2-shape-3">
                  <img src="assets/img/hero/hero-2-shape-3.png" alt="">
               </div>
               <div class="tp-hero-2-shape-4">
                  <img src="assets/img/hero/hero-2-shape-4.png" alt="">
               </div>
            </div>
         </div>
         <!-- hero-area-end -->

         <!-- category-area-start -->
        
         <!-- category-area-end -->

         <!-- funfact-area-start -->
        
         <!-- funfact-area-end -->

         <!-- course-area-start -->
         <?php
         require_once 'course_area.php';
        ?>
             

         <!-- course-area-end -->
 
         <!-- live-area-start -->
         <?php
         require_once 'free_course.php';
        ?>
         <!-- live-area-end -->

         <?php
         require_once 'testimonial_area.php';
          ?>

         <!-- team-area-start -->

         
         <?php
         require_once 'team_area.php';
          ?>
         <!-- team-area-end -->

         <!-- brand-area-start -->
         <?php
         // require_once 'brand_area.php';
          ?>
         <!-- brand-area-end -->

         <!-- bannner-area-start -->
         <!-- <section class="banner-area pb-60">
            <div class="container">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="tp-banner-sm-2-wrap mb-60 wow fadeInUp" data-wow-delay=".3s">
                        <h3 class="tp-banner-sm-2-title">Earn a <br> 
                           <span>Certificate
                              <img class="tp-underline-shape-11 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/banner-2-svg-1.svg" alt="">
                           </span>
                        </h3>
                        <div class="tp-banner-sm-2-btn">
                           <a href="contact.html">View Programs</a>
                        </div>
                        <div class="tp-banner-sm-2-shape-1">
                           <img src="assets/img/banner/banner-2-thumb-1.png" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tp-banner-sm-2-wrap tp-banner-sm-2-bg-2 mb-60 wow fadeInUp" data-wow-delay=".3s">
                        <h3 class="tp-banner-sm-2-title">Best <br>Rated 
                           <span>Courses
                              <img class="tp-underline-shape-11 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/banner-2-svg-2.svg" alt="">
                           </span>
                        </h3>
                        <div class="tp-banner-sm-2-btn">
                           <a href="course-with-filter.html">View Programs</a>
                        </div>
                        <div class="tp-banner-sm-2-shape-1">
                           <img src="assets/img/banner/banner-2-thumb-2.png" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->
         <!-- bannner-area-end -->

         <!-- cta-area-start -->
         <section class="cta-area tp-cta-2-bg">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-lg-10">
                     <div class="tp-cta-2-wrapper text-center">
                        <h2 class="tp-cta-2-title">Subscribe to our 
                           <span> newsletter
                              <img class="tp-underline-shape-12 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/cta-2-svg-1.svg" alt="">
                           </span> 
                         </h2>
                        <p>get insights, updates, and valuable resources to support your journey in the tech industry! <br>

                        <?php
// Include database connection file
include 'connect.php'; // Adjust the path as needed

// Handle form submission
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted email
    $email = trim($_POST['email']);

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL statement to insert the email
        $stmt = $conn->prepare("INSERT INTO mailing_list (email) VALUES (?)");

        if ($stmt) {
            $stmt->bind_param('s', $email);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Thank you for subscribing to our newsletter!";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    } else {
        $message = "Invalid email address. Please enter a valid email.";
    }

    // Close the database connection
    $conn->close();
}
?>
<?php if ($message): ?>
  <br> <strong style='color: yellow;'>    <?php echo htmlspecialchars($message); ?> </strong>
   <?php endif; ?>
                        </p>
                        <div class="tp-cta-2-form">
                       



 <form action="" method="POST">
   <span>
      <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M2.2 1.01465H11.8C12.46 1.01465 13 1.55465 13 2.21465V9.41465C13 10.0746 12.46 10.6146 11.8 10.6146H2.2C1.54 10.6146 1 10.0746 1 9.41465V2.21465C1 1.55465 1.54 1.01465 2.2 1.01465Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
         <path d="M13 2.21436L7 6.41436L1 2.21436" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
   </span>
   <input type="email" name="email" placeholder="Enter your email address" required>
   <div class="tp-cta-2-btn">
      <button class="tp-btn-round" type="submit">Subscribe!</button>
   </div>
</form>



                        </div>
                        <div class="tp-cta-2-info-list">
                           <span>
                              <span>
                                 <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.6" d="M13 1.01465L4.75 9.26465L1 5.51465" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </span>
                              Easy to Access
                           </span>
                           <span>
                              <span>
                                 <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.6" d="M13 1.01465L4.75 9.26465L1 5.51465" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </span>
                              No Credit card
                           </span>
                           <span>
                              <span>
                                 <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.6" d="M13 1.01465L4.75 9.26465L1 5.51465" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </span>
                              350+ student onboard with us
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta-area-end -->

      </main>

      <!-- footer-area-start -->
      <footer>
         <div class="tp-footer-2">
            <div class="tp-footer-main pt-70 pb-55">
            <?php
         require_once 'footer.php';
          ?> 
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
      <script src="assets/js/purecounter.js"></script>
      <script src="assets/js/wow.js"></script>
      <script src="assets/js/isotope-pkgd.js"></script>
      <script src="assets/js/imagesloaded-pkgd.js"></script>
      <script src="assets/js/flatpickr.js"></script>      
      <script src="assets/js/ajax-form.js"></script>
      <script src="assets/js/main.js"></script>

   </body>

</html>