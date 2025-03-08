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
         require_once 'preloader.php';
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
   
      <!-- offcanvas area end -->

      <main>

        <!-- faq breadcrumb start -->
        <section class="tp-breadcrumb__area pt-60 pb-60 p-relative z-index-1 fix">
        <div><br>   <br>   <br>        </div>
         <div class="tp-breadcrumb__bg" data-background="assets/img/breadcrumb/breadcrumb-bg.jpg"></div>
         <div class="container">
            <div class="row align-items-center">
               <div class="col-sm-12">
                  <div class="tp-breadcrumb__content">
                     <div class="tp-breadcrumb__list">
                        <span><a href="index.html"><svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z" fill="currentColor"/>
                        </svg></a></span>
                        <span>Pages</span>
                        <span class="color">Frequently Asked Questons</span>
                     </div>
                     <h3 class="tp-breadcrumb__title white">Frequently Asked Questons </h3>
                  </div>
               </div>
            </div>
         </div>
        </section>
        <!-- faq breadcrumb end -->


        <!-- faq area start -->
        <section class="tp-faq-area tp-faq-p pt-50 pb-120">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="tp-instructor-become-tab">
                     
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row">
                              <div class="col-lg-4">
                                 <div class="tp-faq-wrap">
                                    <div class="tp-faq-search">
                                       <div class="tp-header-2-search">
                                         
                                       </div>
                                    </div>
                                    <div class="tp-faq-sidebar">
                                    <h4 class="tp-faq-sidebar-title"><b>Featured Courses</b></h4>
                                    <ul>
                                    <ul>
    <?php
    require_once 'connect.php';
    // Fetch featured courses with their durations from the database
    $featured_sql = "SELECT course_id, course_name, duration FROM courses WHERE home_featured = 1";
    $featured_result = $conn->query($featured_sql);

    // Check if any featured courses were found
    if ($featured_result && $featured_result->num_rows > 0) {
        // Loop through each featured course
        while ($course = $featured_result->fetch_assoc()) {
            echo '<li><a href="course-details.php?id=' . htmlspecialchars($course['course_id']) . '">';
            echo htmlspecialchars($course['course_name']). '<b>' . ' (' . htmlspecialchars($course['duration']);
            echo 'Weeks</b>) </a></li>';
            echo '<hr>';
        }
    } else {
        echo '<li>No featured courses available.</li>';
    }
    ?>
</ul>

                                       <div class="tp-faq-sidebar-btn">
                                          <a class="tp-btn-inner w-100 text-center" href="course.php">View All Courses Us</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="tp-faq-box">
                                 <?php
// Include your database connection
include 'connect.php';

// Fetch FAQs from the database
$sql = "SELECT * FROM faq ORDER BY faq_id ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0): ?>
    <div class="tpd-accordion">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php
            $counter = 1;
            while ($row = $result->fetch_assoc()): 
                $faq_id = $row['faq_id'];
                $question = htmlspecialchars($row['question']);
                $answer = htmlspecialchars($row['answer']);
                $collapseId = "flush-collapse" . $counter;
                $isExpanded = ($counter === 1) ? 'true' : 'false';
                $showClass = ($counter === 1) ? 'show' : '';
                $collapsedClass = ($counter === 1) ? '' : 'collapsed';
            ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button faq-expend <?php echo $collapsedClass; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $isExpanded; ?>" aria-controls="<?php echo $collapseId; ?>">
                        <?php echo $question; ?>
                        <span class="accordion-btn"></span>
                    </button>
                </h2>
                <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $showClass; ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body"><?php echo $answer; ?></div>
                </div>
            </div>
            <?php
            $counter++;
            endwhile;
            ?>
        </div>
    </div>
<?php else: ?>
    <p>No FAQs available at the moment.</p>
<?php endif; ?>

<?php
// Close the database connection
$conn->close();
?>

                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                           <div class="row">
                              <div class="col-lg-4">
                                 <div class="tp-faq-wrap">
                                    <div class="tp-faq-search">
                                       <div class="tp-header-2-search">
                                          <form action="#">
                                             <input type="text" placeholder="Search...">
                                             <button class="tp-header-2-search-btn" type="submit">
                                                <span>
                                                   <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                      <path d="M13.3994 13.4004L16.9995 17.0005" stroke="#031F42" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                      <path d="M15.3999 8.20019C15.3999 4.22363 12.1763 1 8.1997 1C4.22314 1 0.999512 4.22363 0.999512 8.20019C0.999512 12.1767 4.22314 15.4004 8.1997 15.4004C12.1763 15.4004 15.3999 12.1767 15.3999 8.20019Z" stroke="#031F42" stroke-width="1.5" stroke-linejoin="round"/>
                                                   </svg>
                                                </span>
                                             </button>
                                          </form>
                                       </div>
                                    </div>
                                    <div class="tp-faq-sidebar">
                                       <h4 class="tp-faq-sidebar-title">Related Topics</h4>
                                       <ul>
                                          <li><a href="#">Account/Profile (1)</a></li>
                                          <li><a href="#">Course Taking (2)</a></li>
                                          <li><a href="#">Getting Started (1)</a></li>
                                          <li><a href="#">Mobile (1)</a></li>
                                          <li><a href="#">Purchase/Refunds (3)</a></li>
                                          <li><a href="#">Troubleshooting (2)</a></li>
                                       </ul>
                                       <div class="tp-faq-sidebar-btn">
                                          <a class="tp-btn-inner w-100 text-center" href="#">Contact Us</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-8">
                                 <div class="tp-faq-box">
                                    <div class="tpd-accordion">
                                       <div class="accordion accordion-flush" id="accordionFlushDemo">
                                          <div class="accordion-item">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button faq-expend collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-one" aria-expanded="false" aria-controls="flush-one">
                                                What is Emeritus Education System?
                                                <span class="accordion-btn"></span>
                                              </button>
                                            </h2>
                                            <div id="flush-one" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                            </div>
                                          </div>
                                          <div class="accordion-item">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button faq-expend collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-two" aria-expanded="false" aria-controls="flush-two">
                                                Can I get a refund for my Premium Membership payment?
                                                <span class="accordion-btn"></span>
                                              </button>
                                            </h2>
                                            <div id="flush-two" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                            </div>
                                          </div>
                                          <div class="accordion-item">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button faq-expend collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-three" aria-expanded="false" aria-controls="flush-three">
                                                How does th Affiliate Program work?
                                                <span class="accordion-btn"></span>
                                              </button>
                                            </h2>
                                            <div id="flush-three" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                            </div>
                                          </div>
                                          <div class="accordion-item">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button faq-expend collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-four" aria-expanded="false" aria-controls="flush-four">
                                                What is included in Standard membership plan?
                                                <span class="accordion-btn"></span>
                                              </button>
                                            </h2>
                                            <div id="flush-four" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                            </div>
                                          </div>
                                          <div class="accordion-item">
                                            <h2 class="accordion-header">
                                              <button class="accordion-button faq-expend collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-five" aria-expanded="false" aria-controls="flush-five">
                                                How to choose the right class for me?
                                                <span class="accordion-btn"></span>
                                              </button>
                                            </h2>
                                            <div id="flush-five" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                              <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                      </div>
                  </div>
               </div>
            </div>
         </div>
        </section>
        <!-- instructor area end -->


      </main>

      <!-- footer-area-start -->
      <footer>
         <div class="tp-footer-main tp-footer-inner pt-80 pb-55">
         <?php
         require_once 'footer.php';
          ?> 
         </div>
      </footer>
      <!-- footer-area-end -->

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
