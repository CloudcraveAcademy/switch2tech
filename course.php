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


      <!-- filter area start -->
     
      <!-- filter area end -->


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

<?php
require_once 'connect.php';
?>

<?php
// Set the number of results per page
$results_per_page = 10; 

// Find the total number of results in your courses table
$total_query = "SELECT COUNT(*) AS total FROM courses WHERE status = 'Approved' AND price != 0";
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
WHERE c.status = 'Approved' AND c.price != 0
GROUP BY 
    c.course_id, c.course_name, c.description, c.price, c.discount_percentage,
    c.course_image_url, c.intro_video_url, c.duration, c.prerequisites, c.level,
    c.created_at, c.updated_at, c.status, cc.category_name, i.instructor_name, i.profile_picture
LIMIT $results_per_page OFFSET $offset;";

$result = $conn->query($sql);
?>
      
         <!-- course filter start -->
         <section class="tp-course-filter-area tp-course-filter-bg p-relative pt-180 pb-220">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-breadcrumb__content-filter mb-50">
                        <div class="tp-breadcrumb__list">
                           <span><a href="index.html"><svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z" fill="currentColor"/>
                           </svg></a></span>
                           <span class="color">All Courses</span>
                        </div>
                        <h3 class="tp-breadcrumb__title">All Courses</h3>
                        <p>We currently have a total collection of <span><?php echo $total_results; ?></span> tech courses</p>
                     </div>
                     <div class="tp-course-filter-wrap p-relative">
                        <div class="row">
                           <div class="col-lg-6">
                              <div class="tp-course-filter-top-left d-flex align-items-center">
                                 <div class="tp-course-filter-top-tab tp-tab mb-20">
                                    <ul class="nav nav-tabs" id="filterTab" role="tablist">
                                       <li class="nav-item" role="presentation">
                                         <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                           <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M5.66667 1H1V5.66667H5.66667V1Z" stroke="#031F42" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M12.9997 1H8.33301V5.66667H12.9997V1Z" stroke="#031F42" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M12.9997 8.33337H8.33301V13H12.9997V8.33337Z" stroke="#031F42" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M5.66667 8.33337H1V13H5.66667V8.33337Z" stroke="#031F42" stroke-linecap="round" stroke-linejoin="round" />
                                           </svg>
                                           Grid
                                         </button>
                                       </li>
                                       <li class="nav-item" role="presentation">
                                         <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                             <svg width="14" height="14" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15 7.11108H1" stroke="#031F42" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15 1H1" stroke="#031F42" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15 13.2222H1" stroke="#031F42" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"></path>
                                             </svg>
                                             List
                                         </button>
                                       </li>
                                     </ul>
                                 </div>
                                 <div class="tp-course-filter-top-result mb-20">
                                 <p>Showing <?php echo $start_result; ?>–<?php echo $end_result; ?> of <?php echo $total_results; ?> results</p>

                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6">
                              <div class="tp-course-filter-top-right d-flex align-items-center justify-content-start justify-content-lg-end">
                                 <div class="tp-course-filter-top-right-search d-none d-lg-block mb-20">
                                    <form action="#">
                                       <input type="text" placeholder="Search for Courses...">
                                       <button class="tp-course-filter-top-right-search-btn" type="submit">
                                          <span>
                                             <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.625 12.625L16 16" stroke="#8B8B8B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14.5 7.75C14.5 4.02208 11.4779 1 7.75 1C4.02208 1 1 4.02208 1 7.75C1 11.4779 4.02208 14.5 7.75 14.5C11.4779 14.5 14.5 11.4779 14.5 7.75Z" stroke="#8B8B8B" stroke-width="1.5" stroke-linejoin="round"></path>
                                             </svg>
                                          </span>
                                       </button>
                                    </form>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- course filter end -->


         <!-- course filter area start -->
         <section class="tp-filter-mt-2">
            <div class="container">
         
            <!-- Start course dbase query -->



<section class="tp-filter-mt-2">
    <div class="container">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6">
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
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $conn->close(); ?>

            <!-- end course dbase query -->

               <div class="row">
                  <div class="col-lg-12">
                    
                  <div class="tp-event-inner-pagination pb-100">
    <div class="tp-dashboard-pagination pt-20">
        <div class="tp-pagination">
            <nav>
                <ul class="justify-content-center">
                    <?php if ($current_page > 1): ?>
                    <li>
                        <a href="course.php?page=<?php echo $current_page - 1; ?>">
                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.00017 6.77879L14 6.77879" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M6.24316 11.9999L0.999899 6.77922L6.24316 1.55762" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li>
                            <?php if ($i == $current_page): ?>
                                <span class="current"><?php echo $i; ?></span>
                            <?php else: ?>
                                <a href="course.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>

                    <?php if ($current_page < $total_pages): ?>
                    <li>
                        <a href="course.php?page=<?php echo $current_page + 1; ?>" class="next page-numbers">
                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.9998 6.77883L1 6.77883" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M8.75684 1.55767L14.0001 6.7784L8.75684 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>


               </div>
            </div>
         </section>
         <!-- course filter area end -->


         <!-- bannner-area-start -->
         <section class="banner-area pb-40">
            <div class="container">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="tp-banner-sm-2-wrap mb-60">
                        <h3 class="tp-banner-sm-2-title">Earn a <br> 
                           <span>Certificate
                              <img class="tp-underline-shape-11 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/banner-2-svg-1.svg" alt="">
                           </span>
                        </h3>
                        <div class="tp-banner-sm-2-btn">
                           <a href="course-with-filter.html">View Programs</a>
                        </div>
                        <div class="tp-banner-sm-2-shape-1">
                           <img src="assets/img/banner/banner-2-thumb-1.png" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-6">
                     <div class="tp-banner-sm-2-wrap tp-banner-sm-2-bg-2 mb-60">
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
         </section>
         <!-- bannner-area-end -->
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
