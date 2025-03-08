<?php
// require_once 'connect.php';

// SQL query to fetch a course with price zero
$sql = "
    SELECT 
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
        cc.category_name AS course_category,  -- Course category
        i.instructor_name,
        i.profile_picture,
        i.current_role  
    FROM 
        courses c
    LEFT JOIN 
        instructors i ON c.instructor_id = i.instructor_id
    LEFT JOIN 
        course_categories cc ON c.category_id = cc.category_id  -- Join with course_categories
    WHERE 
        c.price = 0 AND c.status = 'Approved' 
    LIMIT 1
";


// Execute the query
$result_course = $conn->query($sql);

// Fetch and display the course data if available
if ($result_course && $row_course = $result_course->fetch_assoc()) {
    ?>

<section class="live-area lightblue-bg pt-95 pb-140">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-10">
                     <div class="tp-section text-center mb-65">
                        <h5 class="tp-section-3-subtitle">Upcoming Courses</h5>
                        <h3 class="tp-section-3-title">Sign up for our upcoming free  
                           <span>virtual
                              <img class="tp-underline-shape-7 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/live-2-svg-1.svg" alt="">
                           </span>
                           Courses
                        </h3>
                     </div>
                  </div>
               </div>

              <!-- Free Section -->
              <div class="row justify-content-center">
                  <div class="col-xl-10">
                     <div class="tp-live-bg wow fadeInUp" data-wow-delay=".2s">
                        <div class="row align-items-center">
                           <div class="col-lg-6 col-md-4">
                              <div class="tp-live-thumb p-relative">
                                 <img src="assets/uploads/courses/<?php echo htmlspecialchars($row_course['course_image_url']); ?>" alt="" width='440px'>
                                 <div class="tp-live-thumb-video">
                                    <img src="assets/img/teacher/live-2-video.png" alt="">
                                 </div>
                                 <div class="tp-live-thumb-text">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                       <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M8 3.7998V7.9998L10.8 9.3998" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                     </svg><?php echo htmlspecialchars($row_course['duration']); ?> Hours</span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-8">
                              <div class="tp-live-content">
                                 <span class="tp-live-tag"><?php echo htmlspecialchars($row_course['course_category']); ?></span>
                                 <div class="tp-live-teacher">
                                    <div class="tp-live-teacher-info d-flex align-items-center">
                                       <div class="tp-live-teacher-thumb">
                                          <img src="assets/uploads/instructors/<?php echo htmlspecialchars($row_course['profile_picture']); ?>" alt="<?php echo htmlspecialchars($row_course['instructor_name']); ?>">
                                       </div>
                                       <div class="tp-live-teacher-text">
                                          <span><?php echo htmlspecialchars($row_course['instructor_name']); ?></span>
                                          <h4 class="tp-live-teacher-title"><?php echo htmlspecialchars($row_course['current_role']); ?></h4>
                                       </div>
                                       
                                    </div>
                                    <!-- <div class="tp-live-rating">
                                      
                                      
                                    </div> -->
                                 </div>
                                 <h4 class="tp-live-title"><?php echo htmlspecialchars($row_course['course_name']); ?> <span class="tp-live-tag"> You need to join our  <a target='blank' href="https://chat.whatsapp.com/InDQVaZ3CvmFST3hl3oGjT">WhatsApp community </a> to attend.</span>
                                  </h4>
                                 
                                 <div class="tp-live-total">
                                    <div class="tp-live-join">
                                       <a class="tp-btn-border" target='blank' href="https://chat.whatsapp.com/InDQVaZ3CvmFST3hl3oGjT">
                            Join & attend
                                       </a>
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <!-- end free section -->

            </div>
            
         </section>

      <?php
} else {
   ?>


            <div class="container">
               <div class="row justify-content-center">
                <p>  </p>
  </div>
  </div> 
    <?php
}
?>
    


  
