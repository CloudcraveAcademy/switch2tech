<!doctype html>
<html class="no-js" lang="zxx">

<head>
      <?php
         require_once 'head.php';
      ?>
       <style>
        .circular-image {
            width: 150px; /* Adjust size as needed */
            height: 150px; /* Make sure width and height are equal */
            border-radius: 50%; /* Makes the image a circle */
            overflow: hidden; /* Ensures content stays within the circle */
            object-fit: cover; /* Ensures the image fits within the circle */
        }
    </style>
   </head>

   <body>

      <!-- pre loader area start -->
      <?php
       //  require_once 'preloader.php';
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
      
      <?php
// Include database connection
include 'connect.php'; // Adjust the path as necessary

// Get course ID from the URL
if (isset($_GET['id'])) {
    $course_id = intval($_GET['id']); // Sanitize input
} else {
    // Redirect to courses page or show an error
    header("Location: courses.php");
    exit();
}

// Fetch course details from the database
$query = "SELECT 
    c.course_id,
    c.course_name,
    c.description AS course_description,
    c.price,
    c.discount_percentage,
    c.course_image_url,
    c.intro_video_url,
    c.duration AS course_duration,
    c.prerequisites,
    c.level,
    c.created_at AS course_created_at,
    c.updated_at AS course_updated_at,
    c.home_featured,
    c.banner_featured,
    c.status,
    c.mode,
    c.registration_deadline,
    c.start_datetime,
    c.training_days,
    c.daily_start_time,
    c.timezone,
    i.instructor_name,
    i.profile_picture,
    i.bio,
    i.current_role,
    cat.category_name
FROM 
    courses c
LEFT JOIN 
    instructors i ON c.instructor_id = i.instructor_id
LEFT JOIN 
    course_categories cat ON c.category_id = cat.category_id
WHERE 
    c.course_id = ?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $course = $result->fetch_assoc();
} else {
    // Redirect or show error if no course found
    header("Location: courses.php");
    exit();
}

// Fetch curriculum and lessons related to the course
$curriculum_query = "SELECT 
    cur.curriculum_id,
    cur.title AS curriculum_title,
    cur.description AS curriculum_description,
    cur.order_number AS curriculum_order,
    l.lesson_id,
    l.lesson_title,
    l.lesson_content,
    l.video_url AS lesson_video_url,
    l.duration AS lesson_duration,
    l.created_at AS lesson_created_at,
    l.updated_at AS lesson_updated_at
FROM 
    course_curriculum cur
LEFT JOIN 
    course_lessons l ON cur.curriculum_id = l.curriculum_id
WHERE 
    cur.course_id = ?
ORDER BY cur.order_number, l.lesson_order";

$curriculum_stmt = $conn->prepare($curriculum_query);
if (!$curriculum_stmt) {
    die("Curriculum prepare failed: " . $conn->error);
}
$curriculum_stmt->bind_param("i", $course_id);
$curriculum_stmt->execute();
$curriculum_result = $curriculum_stmt->get_result();

// Store curriculums and lessons in a structured array
$curriculums = [];
while ($row = $curriculum_result->fetch_assoc()) {
    $curriculum_id = $row['curriculum_id'];
    
    // Initialize the curriculum if not already added
    if (!isset($curriculums[$curriculum_id])) {
        $curriculums[$curriculum_id] = [
            'curriculum_title' => $row['curriculum_title'],
            'curriculum_description' => $row['curriculum_description'],
            'lessons' => []
        ];
    }
    
    // Add lesson to the curriculum's lessons array if a lesson is available
    if (!empty($row['lesson_id'])) {
        $curriculums[$curriculum_id]['lessons'][] = [
            'lesson_id' => $row['lesson_id'],
            'lesson_title' => $row['lesson_title'],
            'lesson_content' => $row['lesson_content'],
            'lesson_video_url' => $row['lesson_video_url'],
            'lesson_duration' => $row['lesson_duration'],
            'lesson_created_at' => $row['lesson_created_at'],
            'lesson_updated_at' => $row['lesson_updated_at']
        ];
    }
}

// Close the statements and connection
$stmt->close();
$curriculum_stmt->close();
//$conn->close();

// Output course details and curriculums/lessons

// Format the price with commas
$price = number_format($course['price']);

$discounted_price = ($course['price'] * (1 - $course['discount_percentage'] / 100));

?>

<!-- Course Details Section -->
<section class="tp-breadcrumb__area pt-25 pb-55 p-relative z-index-1 fix">
    <div class="tp-breadcrumb__bg" data-background="assets/img/breadcrumb/breadcrumb-bg-2.jpg"></div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="tp-breadcrumb__content">
                    <div class="tp-breadcrumb__list course-details mb-70">
                        <span><a href="index.html"><svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z" fill="currentColor"></path>
                            </svg></a></span>
                    </div>

                    <div class="tp-course-details-2-header">
                        <span class="tp-course-details-2-category"><?php echo htmlspecialchars($course['category_name']); ?></span>
                        <h3 class="tp-course-details-2-title"><?php echo htmlspecialchars($course['course_name']); ?></h3>
                        <div class="tp-course-details-2-meta-wrapper d-flex align-items-center flex-wrap">
                            <div class="tp-course-details-2-meta ">
                                <div class="tp-course-details-2-author d-flex align-items-center">
                                    <div class="tp-course-details-2-author-avater">
                                        <img src="assets/uploads/instructors/<?php echo htmlspecialchars($course['profile_picture']); ?>" class="circular-image" alt="">
                                    </div>
                                    <div class="tp-course-details-2-author-content">
                                        <span class="tp-course-details-2-author-designation">Instructor</span>
                                        <h3 class="tp-course-details-2-meta-title"><a href="#"><?php echo htmlspecialchars($course['instructor_name']); ?></a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="tp-course-details-2-meta">
                                <span class="tp-course-details-2-meta-subtitle">Lectures Mode</span>
                                <h3 class="tp-course-details-2-meta-title"><?php echo htmlspecialchars($course['mode']); ?></h3>
                            </div>
                            <div class="tp-course-details-2-meta">
                                <span class="tp-course-details-2-meta-subtitle">Registration Deadline</span>
                                <h3 class="tp-course-details-2-meta-title"><?php echo htmlspecialchars($course['registration_deadline']); ?></h3>
                            </div>
                            <div class="tp-course-details-2-meta">
                                <span class="tp-course-details-2-meta-subtitle">Start Date</span>
                                <h3 class="tp-course-details-2-meta-title"><?php echo htmlspecialchars($course['start_datetime']); ?></h3>
                            </div>
                            <!-- <div class="tp-course-details-2-meta">
                                <span class="tp-course-details-2-meta-subtitle">Training Days</span>
                                <h3 class="tp-course-details-2-meta-title"><?php echo htmlspecialchars($course['training_days']); ?></h3>
                            </div> -->
                         
                        </div>
                    </div>

                    <!-- Curriculum and Lessons Section -->
                     
                    <!-- Curriculum and Lessons Section -->
                </div>
            </div>
        </div>
    </div>
</section>




         <!-- course details area start -->
         <section class="tp-course-details-2-area pt-50 pb-80">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8">
                     <div class="tp-course-details-2-main-inner pr-70">
                        <div class="tp-course-details-2-nav d-flex align-items-center">
                           <nav>
                              <ul id="course_details2_nav">
                                 <li class="current"><a href="#info">Course Info</a></li>
                                 <li class=""><a href="#curriculum">Curriculum</a></li>
                                 <li class=""><a href="#instructors">Instructors / Reviews</a></li>
                                 <!-- <li class=""><a href="#reviews">Reviews</a></li> -->
                              </ul>
                           </nav>
                        </div>

                        <div class="tp-course-details-2-content">
                           <div id="info">
                              <h4 class="tp-course-details-2-main-title">About Course</h4>
                              <div class="tp-course-details-2-text mb-60">
                                 <div class="content">
                                    <p>
                                       <?php echo htmlspecialchars($course['course_description']); ?>
                                    </p>
                                 </div>
                                 <a class="tp-course-details-showmore show-more-button"><span class="svg-icon">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M6 1V11" stroke="#3C66F9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                      <path d="M1 6H11" stroke="#3C66F9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                  </span> Show more</a>
                              </div>
                              <h4 class="tp-course-details-2-main-title">Course Prerequisites</h4>
                              <div class="tp-course-details-2-list">
                                 <?php echo htmlspecialchars($course['prerequisites']); ?>
                              </div>
                           </div>

                           <div id="curriculum" class="pt-70">
                              <h4 class="tp-course-details-2-main-title">Course Curriculum</h4>
                              <div class="tp-course-details-2-faq">
                                 <div class="accordion" id="accordionPanelsStayOpenExample">
                                   <!-- accordion one-->
                              <!-- Output Section Here -->
<div class="curriculum-section">
    <!-- <h4>Curriculum</h4> -->
    <?php if (!empty($curriculums)): ?>
        <div class="accordion" id="curriculumAccordion">
            <?php 
            $accordionIndex = 0; // Index for accordion items
            
            foreach ($curriculums as $curriculum_id => $curriculum): 
                $accordionIndex++;
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?php echo $accordionIndex; ?>">
                        <button class="accordion-button collapsed d-flex justify-content-between" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $accordionIndex; ?>" aria-expanded="true" aria-controls="collapse<?php echo $accordionIndex; ?>">
                            <?php echo htmlspecialchars($curriculum['curriculum_title']); ?>
                            <span class="lesson"> <?php foreach ($curriculum['lessons'] as $lesson): ?>  <?php endforeach; ?> <?php echo count($curriculum['lessons']); ?> Lessons  </span>
                            <span class="accordion-btn"></span>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $accordionIndex; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $accordionIndex; ?>" data-bs-parent="#curriculumAccordion">
                        <div class="accordion-body">
                            <p><?php  echo htmlspecialchars($curriculum['curriculum_description']); ?></p>

                            <?php if (!empty($curriculum['lessons'])): ?>
                                <h6>Lessons:</h6>
                                <ul>
                                    <?php foreach ($curriculum['lessons'] as $lesson): ?>
                                        <li><?php echo htmlspecialchars($lesson['lesson_title']); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No lessons found for this curriculum.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No curriculum found for this course.</p>
    <?php endif; ?>
</div>

                                    <!-- end accordion one -->
                                   
                                    
                                  </div>
                              </div>
                           </div>

                           <div id="instructors" class="pt-100">
                              <h4 class="tp-course-details-2-main-title">Your Instructor</h4>
                              <div class="tp-course-details-2-instructor d-flex">
                                 <div class="tp-course-details-2-instructor-thumb mr-40">
                                    <img src="assets/uploads/instructors/<?php echo htmlspecialchars($course['profile_picture']); ?>" alt=""  class="circular-image" width=120>
                                 </div>
                                 <div class="tp-course-details-2-instructor-content"> 
                                    <h5><?php echo htmlspecialchars($course['instructor_name']); ?></h5>
                                    <b> <?php echo htmlspecialchars($course['current_role']); ?> </b>
                                    <!-- <div class="tp-course-details-2-instructor-sub d-flex">
                                       <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M11.9376 8.84884C11.7434 9.03675 11.6541 9.3085 11.6984 9.57502L12.365 13.2583C12.4213 13.5705 12.2893 13.8864 12.0276 14.0668C11.7711 14.254 11.4299 14.2764 11.1502 14.1267L7.82888 12.3974C7.7134 12.336 7.58517 12.303 7.45393 12.2993H7.25071C7.18022 12.3098 7.11123 12.3322 7.04824 12.3667L3.72617 14.1042C3.56194 14.1866 3.37597 14.2158 3.19374 14.1866C2.7498 14.1027 2.45359 13.6805 2.52633 13.2351L3.19374 9.55181C3.23798 9.28305 3.14875 9.0098 2.95452 8.8189L0.246625 6.19868C0.0201542 5.97933 -0.0585855 5.64993 0.044901 5.35273C0.145388 5.05627 0.401854 4.83991 0.711564 4.79125L4.43858 4.25149C4.72204 4.22229 4.97101 4.0501 5.09849 3.79557L6.74078 0.434207C6.77977 0.359344 6.83001 0.29047 6.89076 0.232076L6.95825 0.179672C6.99349 0.140743 7.03399 0.108552 7.07898 0.0823496L7.16072 0.0524043L7.2882 0H7.60391C7.88588 0.0291967 8.13409 0.197639 8.26383 0.44918L9.92786 3.79557C10.0478 4.04037 10.2811 4.21031 10.5503 4.25149L14.2773 4.79125C14.5922 4.83617 14.8555 5.05327 14.9597 5.35273C15.0579 5.65293 14.9732 5.98233 14.7422 6.19868L11.9376 8.84884Z" fill="#FFB21D" />
                                        </svg> 4.4 Rating</span>
                                        <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M5.61133 7.50075V6.53875C5.61133 5.29725 6.48883 4.79675 7.56133 5.41425L8.39333 5.89525L9.22533 6.37625C10.2978 6.99375 10.2978 8.00775 9.22533 8.62525L8.39333 9.10625L7.56133 9.58725C6.48883 10.2048 5.61133 9.69775 5.61133 8.46275V7.50075Z" stroke="#6C7275" stroke-width="1.2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                          <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> 58 Courses</span>
                                        <span><svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M6.5711 7.5C8.36215 7.5 9.81407 6.04493 9.81407 4.25C9.81407 2.45507 8.36215 1 6.5711 1C4.78005 1 3.32812 2.45507 3.32812 4.25C3.32812 6.04493 4.78005 7.5 6.5711 7.5Z" stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                          <path d="M12.1429 14C12.1429 11.4845 9.64577 9.44999 6.57143 9.44999C3.49709 9.44999 1 11.4845 1 14" stroke="#6C7275" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> 45 Student</span>
                                    </div> -->
                                    <div class="tp-course-details-2-instructor-text">
                                       <p><?php echo htmlspecialchars($course['bio']); ?></p>
                                    </div>
                                   
                                 </div>
                              </div>
                           </div>

                         

                           <h4 class="tp-course-details-2-main-title"><br><br>Alumni Review</h4>
                           <div class="tp-course-details-2-review-reply-wrap">
<?php
// Include your database connection setup
include 'connect.php'; // Adjust this as needed

// Query to fetch all course reviews from students with 'Alumni' status
$query = "SELECT cr.comment, cr.rating, cr.created_at, s.name, s.student_status, s.picture 
          FROM course_reviews cr 
          JOIN students s ON cr.student_id = s.student_id 
          WHERE s.student_status = 'Alumni'";

if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are results and output them
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="tp-course-details-2-review-item-reply">
                      <div class="tp-course-details-2-review-top d-flex">
                          <div class="tp-course-details-2-review-thumb">
                              <img src="assets/uploads/students/' . htmlspecialchars($row['picture']) . '" alt="" width=50>
                          </div>
                          <div class="tp-course-details-2-review-content">
                              <h4>' . htmlspecialchars($row['name']) . '</h4>
                              <div class="tp-course-details-2-review-star">
                                  <span class="span"> ' . htmlspecialchars($row['created_at']) . '</span>
                              </div>
                          </div>
                      </div>
                      <p>' . htmlspecialchars($row['comment']) . '</p>
                  </div>';
        }
    } else {
        echo '<p>No reviews found from alumni students.</p>';
    }

    $stmt->close();
} else {
    echo 'Error preparing statement: ' . $conn->error;
}

// Close the connection only at the end of the script
$conn->close();
?>
                           


                              
                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <div class="tp-course-details-2-widget">
                        <div class="tp-course-details-2-widget-thumb p-relative">
                           <img src="assets/uploads/courses/<?php echo htmlspecialchars($course['course_image_url']); ?>" alt="<?php echo htmlspecialchars($course['course_name']); ?>">
                           <a class="popup-video" href="<?php echo htmlspecialchars($course['intro_video_url']); ?>"><span><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0 1.83167C0 1.0405 0.875246 0.562658 1.54076 0.990487L12.6915 8.15882C13.3038 8.55246 13.3038 9.44754 12.6915 9.84118L1.54076 17.0095C0.875246 17.4373 0 16.9595 0 16.1683V1.83167Z" fill="#031F42" />
                            </svg></span></a>
                        </div>
                        <div class="tp-course-details-2-widget-content">
                           <div class="tp-course-details-2-widget-price">
                              <span>$<?php echo htmlspecialchars(number_format($discounted_price)); ?> </span>
                              <del>$<?php echo htmlspecialchars($price); ?></del>
                           </div>
                           <div class="tp-course-details-2-widget-btn">
                              <a class="active" href="enroll.php?id=<?php echo htmlspecialchars($course_id); ?>&&course=<?php echo htmlspecialchars($course['course_name']); ?>">Enroll for this Class</a>
                               <a href="https://wa.me/447904225546"target="_blank">Chat with an Advisor <br> (WhatsApp Only)</a> 
                              <p>30-Day Money-Back Guarantee</p>
                           </div>

                           <div class="tp-course-details-2-widget-list">
                              <h5>Course details:</h5>
                        
                              <div class="tp-course-details-2-widget-list-item-wrapper">
                        
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 1C12.6415 1 16 4.35775 16 8.5C16 12.6423 12.6415 16 8.5 16C4.35775 16 1 12.6423 1 8.5C1 4.35775 4.35775 1 8.5 1Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8692 8.49618C10.8692 7.85581 7.58703 5.80721 7.2147 6.17556C6.84237 6.54391 6.80657 10.4137 7.2147 10.8168C7.62283 11.2213 10.8692 9.13655 10.8692 8.49618Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       </svg> Lectures Mode</span>
                                    <span><?php echo htmlspecialchars($course['mode']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Duration</span>
                                    <span><?php echo htmlspecialchars($course['course_duration']); ?> Weeks</span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M5.5 13V5.5" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10 13V1" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M1 13V10" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Skill Level</span>
                                    <span><?php echo htmlspecialchars($course['level']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M8 15.5C11.866 15.5 15 12.366 15 8.5C15 4.63401 11.866 1.5 8 1.5C4.13401 1.5 1 4.63401 1 8.5C1 12.366 4.13401 15.5 8 15.5Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M1 8.5H15" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M7.99727 1.5C9.74816 3.41685 10.7432 5.90442 10.7973 8.5C10.7432 11.0956 9.74816 13.5832 7.99727 15.5C6.24637 13.5832 5.25134 11.0956 5.19727 8.5C5.25134 5.90442 6.24637 3.41685 7.99727 1.5Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Language</span>
                                    <span>English</span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Registration Deadline</span>
                                    <span><?php echo htmlspecialchars($course['registration_deadline']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Start Date</span>
                                    <span><?php echo htmlspecialchars($course['start_datetime']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Training Days</span>
                                    <span><?php 
echo str_replace(',', '<br>', htmlspecialchars($course['training_days'])); 
?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Training Start Time</span>
                                    <span><?php echo htmlspecialchars($course['daily_start_time']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Timezone Days</span>
                                    <span><?php echo htmlspecialchars($course['timezone']); ?></span>
                                 </div>
                                 <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                    <span> <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M14.721 6.64274C14.721 7.8116 14.3744 8.88373 13.7779 9.77851C12.9073 11.0683 11.5289 11.9792 9.9247 12.2129C9.65063 12.2613 9.36849 12.2855 9.07829 12.2855C8.78809 12.2855 8.50596 12.2613 8.23188 12.2129C6.62773 11.9792 5.24929 11.0683 4.37869 9.77851C3.78217 8.88373 3.43555 7.8116 3.43555 6.64274C3.43555 3.52311 5.95866 1 9.07829 1C12.1979 1 14.721 3.52311 14.721 6.64274Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M16.5341 14.2766L15.2041 14.591C14.9058 14.6636 14.672 14.8893 14.6075 15.1875L14.3254 16.3725C14.1722 17.0174 13.35 17.2109 12.9228 16.703L9.07766 12.2856L5.23253 16.7111C4.80529 17.2189 3.98307 17.0255 3.82991 16.3806L3.54777 15.1956C3.47522 14.8973 3.24145 14.6636 2.95125 14.5991L1.62117 14.2847C1.00853 14.1396 0.790885 13.3738 1.23424 12.9304L4.37806 9.78662C5.24865 11.0764 6.6271 11.9873 8.23125 12.2211C8.50532 12.2694 8.78746 12.2936 9.07766 12.2936C9.36786 12.2936 9.64999 12.2694 9.92407 12.2211C11.5282 11.9873 12.9067 11.0764 13.7773 9.78662L16.9211 12.9304C17.3644 13.3657 17.1468 14.1315 16.5341 14.2766Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                       <path opacity="0.4" d="M9.54557 4.20822L10.0212 5.15942C10.0857 5.2884 10.2549 5.41738 10.4081 5.44156L11.2706 5.58665C11.8188 5.67533 11.9478 6.07838 11.5528 6.47338L10.8837 7.14243C10.7709 7.25529 10.7064 7.47295 10.7467 7.63417L10.9401 8.46446C11.0933 9.11741 10.7467 9.37535 10.1663 9.02872L9.36017 8.55312C9.21507 8.46445 8.97324 8.46445 8.82814 8.55312L8.02203 9.02872C7.44163 9.36728 7.09501 9.11741 7.24817 8.46446L7.44163 7.63417C7.47388 7.48101 7.41745 7.25529 7.3046 7.14243L6.63553 6.47338C6.24054 6.07838 6.36951 5.68339 6.91766 5.58665L7.7802 5.44156C7.9253 5.41738 8.09458 5.2884 8.15907 5.15942L8.63467 4.20822C8.86844 3.69231 9.28762 3.69231 9.54557 4.20822Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                     </svg> Certificate</span>
                                    <span>Yes</span>
                                 </div>

                                 <div class="tp-course-details-2-widget-share d-flex align-items-center justify-content-between">
                                   <a class="share" href="#"><span><svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.5023 5.2C12.6621 5.2 13.6023 4.2598 13.6023 3.1C13.6023 1.9402 12.6621 1 11.5023 1C10.3425 1 9.40234 1.9402 9.40234 3.1C9.40234 4.2598 10.3425 5.2 11.5023 5.2Z" stroke="#5169F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3.1 10.1001C4.2598 10.1001 5.2 9.15994 5.2 8.00014C5.2 6.84035 4.2598 5.90015 3.1 5.90015C1.9402 5.90015 1 6.84035 1 8.00014C1 9.15994 1.9402 10.1001 3.1 10.1001Z" stroke="#5169F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.5023 15C12.6621 15 13.6023 14.0598 13.6023 12.9C13.6023 11.7403 12.6621 10.8 11.5023 10.8C10.3425 10.8 9.40234 11.7403 9.40234 12.9C9.40234 14.0598 10.3425 15 11.5023 15Z" stroke="#5169F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.91406 9.05701L9.69506 11.843" stroke="#5169F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M9.68806 4.15723L4.91406 6.94322" stroke="#5169F1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg></span> Share this course</a>
                                  
                                 </div>
                                 <div class="tp-course-details-2-instructor-social">
                                       <a href="#"><span><svg width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" clip-rule="evenodd" d="M2.26878 7.01266C1.63274 7.01266 1.5 7.13497 1.5 7.721V8.7835C1.5 9.36953 1.63274 9.49183 2.26878 9.49183H3.80635V13.7418C3.80635 14.3279 3.9391 14.4502 4.57514 14.4502H6.11271C6.74875 14.4502 6.88149 14.3279 6.88149 13.7418V9.49183H8.60795C9.09034 9.49183 9.21464 9.40544 9.34716 8.97809L9.67664 7.91559C9.90365 7.18353 9.76376 7.01266 8.93743 7.01266H6.88149V5.24183C6.88149 4.85063 7.22569 4.5335 7.65028 4.5335H9.83836C10.4744 4.5335 10.6071 4.41119 10.6071 3.82516V2.4085C10.6071 1.82247 10.4744 1.70016 9.83836 1.70016H7.65028C5.52734 1.70016 3.80635 3.28582 3.80635 5.24183V7.01266H2.26878Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                        </svg></span></a>
                                       <a href="#"><span>
                                          <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M1.0957 7.65019C1.0957 4.84534 1.0957 3.44291 1.96706 2.57155C2.83842 1.7002 4.24085 1.7002 7.0457 1.7002C9.85056 1.7002 11.253 1.7002 12.1243 2.57155C12.9957 3.44291 12.9957 4.84534 12.9957 7.65019C12.9957 10.4551 12.9957 11.8575 12.1243 12.7288C11.253 13.6002 9.85056 13.6002 7.0457 13.6002C4.24085 13.6002 2.83842 13.6002 1.96706 12.7288C1.0957 11.8575 1.0957 10.4551 1.0957 7.65019Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                             <path d="M9.86145 7.65045C9.86145 9.20702 8.5996 10.4689 7.04303 10.4689C5.48646 10.4689 4.22461 9.20702 4.22461 7.65045C4.22461 6.09388 5.48646 4.83203 7.04303 4.83203C8.5996 4.83203 9.86145 6.09388 9.86145 7.65045Z" stroke="currentColor" stroke-width="1.5" />
                                             <path d="M10.4941 4.20557L10.4852 4.20557" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                           </svg>
                                       </span></a>
                                       <a href="#"><span>
                                          <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M14.2578 1.60544C13.7028 1.99691 13.0884 2.29632 12.438 2.49214C12.089 2.09081 11.6251 1.80636 11.1092 1.67726C10.5932 1.54816 10.05 1.58063 9.55311 1.77029C9.0562 1.95995 8.62952 2.29765 8.33079 2.7377C8.03206 3.17776 7.87568 3.69895 7.88281 4.23078V4.81032C6.86434 4.83673 5.85514 4.61085 4.9451 4.1528C4.03506 3.69474 3.25243 3.01874 2.6669 2.18498C2.6669 2.18498 0.348722 7.40089 5.56463 9.71907C4.37107 10.5293 2.94923 10.9355 1.50781 10.8782C6.72372 13.7759 13.0987 10.8782 13.0987 4.21339C13.0982 4.05196 13.0827 3.89093 13.0524 3.73237C13.6438 3.14905 14.0612 2.41258 14.2578 1.60544Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                           </svg>
                                       </span></a>
                                       <a href="#"><span>
                                          <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M7.27344 12.3997C8.42711 12.3997 9.53344 12.2857 10.5588 12.0767C11.8394 11.8156 12.4798 11.6851 13.0641 10.9338C13.6484 10.1825 13.6484 9.32007 13.6484 7.59517V6.36665C13.6484 4.64175 13.6484 3.77931 13.0641 3.02801C12.4798 2.27672 11.8394 2.14619 10.5588 1.88514C9.53344 1.67613 8.42711 1.56216 7.27344 1.56216C6.11976 1.56216 5.01343 1.67613 3.98812 1.88514C2.70744 2.14619 2.06711 2.27672 1.48277 3.02801C0.898438 3.77931 0.898438 4.64175 0.898438 6.36665V7.59517C0.898438 9.32007 0.898438 10.1825 1.48277 10.9338C2.06711 11.6851 2.70744 11.8156 3.98812 12.0767C5.01343 12.2857 6.11976 12.3997 7.27344 12.3997Z" stroke="currentColor" stroke-width="1.5" />
                                             <path d="M9.80164 7.18071C9.70704 7.56693 9.20365 7.84432 8.19688 8.3991C7.1019 9.00247 6.55441 9.30416 6.11094 9.18793C5.96074 9.14857 5.82241 9.07935 5.70625 8.98544C5.36328 8.70816 5.36328 8.13252 5.36328 6.98125C5.36328 5.82998 5.36328 5.25434 5.70625 4.97706C5.82241 4.88315 5.96074 4.81393 6.11094 4.77457C6.55441 4.65834 7.1019 4.96003 8.19688 5.5634C9.20365 6.11818 9.70704 6.39557 9.80164 6.78179C9.83383 6.9132 9.83383 7.0493 9.80164 7.18071Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                                           </svg>
                                       </span></a>
                                    </div>
                           </div>
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- course details area end -->

         
         <!-- course details area start -->
         <section class="tp-course-details-2-related-area pb-80">
            <div class="container">
               <div class="tp-course-details-2-related-border"></div>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-course-details-2-related-heading pt-80">
                        <h3 class="tp-course-details-2-related-title">Related Courses</h3>
                        <p>10,000+ unique online course list designs</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-lg-4 col-md-6">
                     <div class="tp-course-item p-relative fix mb-30">
                        <div class="tp-course-teacher mb-15">
                           <span><img src="assets/img/teacher/teacher-5.png" alt="">Benjamin Evalent</span>
                           <span class="discount">-25%</span>
                        </div>
                        <div class="tp-course-thumb">
                           <a href="course-details-2.html"><img class="course-pink" src="assets/img/course/course-thumb-5.jpg" alt=""></a>
                        </div>
                        <div class="tp-course-content">
                           <div class="tp-course-tag mb-10">
                              <span>Art & Design</span>
                           </div>
                           <div class="tp-course-meta">
                              <span>
                                 <span>
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 12 Lessons
                              </span>
                              <span>
                                 <span>
                                    <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 45 Student
                              </span>
                           </div>
                           <h4 class="tp-course-title">
                              <a href="course-details-2.html">The complete guide to build <br> restful API application</a>
                           </h4>
                           <div class="tp-course-rating d-flex align-items-end justify-content-between">
                              <div class="tp-course-rating-star">
                                 <p>5.0<span> /5</span></p>
                                 <div class="tp-course-rating-icon">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                 </div>
                              </div>
                              <div class="tp-course-pricing">
                                 <span>Free</span>
                              </div>
                           </div>
                        </div>
                        <div class="tp-course-btn">
                           <a href="course-details-2.html">Preview this Course</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="tp-course-item p-relative fix mb-30">
                        <div class="tp-course-teacher mb-15">
                           <span><img src="assets/img/teacher/teacher-4.png" alt="">Indigo Violet</span>
                           <span class="discount">-25%</span>
                        </div>
                        <div class="tp-course-thumb">
                           <a href="course-details-2.html"><img class="course-sky" src="assets/img/course/course-thumb-4.jpg" alt=""></a>
                        </div>
                        <div class="tp-course-content">
                           <div class="tp-course-tag mb-10">
                              <span>Marketing</span>
                           </div>
                           <div class="tp-course-meta">
                              <span>
                                 <span>
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 12 Lessons
                              </span>
                              <span>
                                 <span>
                                    <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 45 Student
                              </span>
                           </div>
                           <h4 class="tp-course-title">
                              <a href="course-details-2.html">Computer science: mathematical and analytical</a>
                           </h4>
                           <div class="tp-course-rating d-flex align-items-end justify-content-between">
                              <div class="tp-course-rating-star">
                                 <p>5.0<span> /5</span></p>
                                 <div class="tp-course-rating-icon">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                 </div>
                              </div>
                              <div class="tp-course-pricing">
                                 <del>$26.00</del>
                                 <span>$54.00</span>
                              </div>
                           </div>
                        </div>
                        <div class="tp-course-btn">
                           <a href="course-details-2.html">Preview this Course</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4 col-md-6">
                     <div class="tp-course-item p-relative fix mb-30">
                        <div class="tp-course-teacher mb-15">
                           <span><img src="assets/img/teacher/teacher-6.png" alt="">Hanson Deck</span>
                           <span class="discount">-25%</span>
                        </div>
                        <div class="tp-course-thumb">
                           <a href="course-details-2.html"><img class="course-lightblue" src="assets/img/course/course-thumb-6.jpg" alt=""></a>
                        </div>
                        <div class="tp-course-content">
                           <div class="tp-course-tag mb-10">
                              <span>Music</span>
                           </div>
                           <div class="tp-course-meta">
                              <span>
                                 <span>
                                    <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M13.9228 10.0426V2.29411C13.9228 1.51825 13.2949 0.953997 12.5252 1.01445H12.4847C11.1276 1.12529 9.07163 1.82055 7.91706 2.53596L7.80567 2.6065C7.62337 2.71733 7.30935 2.71733 7.11692 2.6065L6.9549 2.50573C5.81046 1.79033 3.75452 1.1152 2.3974 1.00437C1.62768 0.943911 0.999756 1.51827 0.999756 2.28405V10.0426C0.999756 10.6573 1.50613 11.2417 2.12393 11.3122L2.30622 11.3425C3.70386 11.5238 5.87126 12.2392 7.10685 12.9143L7.1372 12.9244C7.30937 13.0252 7.59293 13.0252 7.75498 12.9244C8.99057 12.2393 11.1681 11.5339 12.5758 11.3425L12.7885 11.3122C13.4164 11.2417 13.9228 10.6674 13.9228 10.0426Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M7.46118 2.81787V12.4506" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 12 Lessons
                              </span>
                              <span>
                                 <span>
                                    <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                       <path d="M6.57134 7.5C8.36239 7.5 9.81432 6.04493 9.81432 4.25C9.81432 2.45507 8.36239 1 6.57134 1C4.7803 1 3.32837 2.45507 3.32837 4.25C3.32837 6.04493 4.7803 7.5 6.57134 7.5Z" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                       <path d="M12.1426 14C12.1426 11.4845 9.64553 9.44995 6.57119 9.44995C3.49684 9.44995 0.999756 11.4845 0.999756 14" stroke="#94928E" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                 </span>
                                 45 Student
                              </span>
                           </div>
                           <h4 class="tp-course-title">
                              <a href="course-details-2.html">Machine learning A-Z: <br> hands-on python and java</a>
                           </h4>
                           <div class="tp-course-rating d-flex align-items-end justify-content-between">
                              <div class="tp-course-rating-star">
                                 <p>5.0<span> /5</span></p>
                                 <div class="tp-course-rating-icon">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                 </div>
                              </div>
                              <div class="tp-course-pricing">
                                 <del>$26.00</del>
                                 <span>$84.00</span>
                              </div>
                           </div>
                        </div>
                        <div class="tp-course-btn">
                           <a href="course-details-2.html">Preview this Course</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- course details area end -->


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
      <script src="assets/js/select2.min.js"></script>
      <script src="assets/js/purecounter.js"></script>
      <script src="assets/js/countdown.js"></script>
      <script src="assets/js/wow.js"></script>
      <script src="assets/js/jquery-one-page-nav.js"></script>
      <script src="assets/js/isotope-pkgd.js"></script>
      <script src="assets/js/imagesloaded-pkgd.js"></script>
      <script src="assets/js/flatpickr.js"></script>      
      <script src="assets/js/ajax-form.js"></script>
      <script src="assets/js/main.js"></script>

   </body>

</html>
