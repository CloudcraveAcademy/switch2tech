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
     <?php
         require_once 'off_canvas.php';
      ?>
      <!-- offcanvas area end -->

      <main>

        <!-- become instructor breadcrumb start -->
        <section class="tp-breadcrumb__area pt-60 pb-60 p-relative z-index-1 fix">
        <br>   <br>   <br>  
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
                        <span class="color">Become an Instructor</span>
                     </div>
                     <h3 class="tp-breadcrumb__title white">Become an Instructor</h3>
                  </div>
               </div>
            </div>
         </div>
        </section>
        <!-- become instructor breadcrumb end -->


        <!-- become instructor area start -->
        <section class="tp-instructor-area tp-instructor-p pt-120">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <!-- <div class="tp-instructor-title-wrap text-center mb-40 wow fadeInUp" data-wow-delay=".3s">
                     <h3 class="tp-instructor-main-title">How to Become an Instructor</h3>
                  </div> -->
                  <div class="tp-instructor-become-tab pb-80 wow fadeInUp" data-wow-delay=".5s">
                     <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Overview</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Why Teach with Us?</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Signup Requirements</button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <div class="row">
                              <div class="col-lg-7">
                                 <div class="tp-instructor-become-wrap">
                                    <!-- <h4 class="tp-instructor-become-title">Become an Instructor</h4> -->
                                    <span class="tp-instructor-become-subtitle">Plan your course</span>
                                    <p>Teaching with our platform gives you the opportunity to make a significant impact by sharing your knowledge with a global community of eager learners. We support our instructors by providing comprehensive tools and resources, empowering you to create and deliver high-quality courses from the comfort of your own space. Whether you're an industry expert, an experienced educator, or someone passionate about teaching, our platform makes it simple to reach students worldwide.</p>
                                    <span class="tp-instructor-become-subtitle">How we help you</span>
                                    <p>Neque convallis a cras semper auctor. Libero id faucibus nisl tincidunt egetnvallis a cras semper auctonvallis a cras semper aucto. Neque convallis a cras semper auctor. Liberoe convallis a cras semper atincidunt egeeque convallis a cras semper auctor.</p>
                                 </div>
                              </div>
                              <div class="col-lg-5">
                                 <div class="tp-instructor-become-thumb text-start text-xl-end">
                                    <img src="assets/img/instructor/instructor-thumb.png" alt="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                           <div class="row">
                              <div class="col-lg-7">
                                 <div class="tp-instructor-become-wrap">
                                    <!-- <h4 class="tp-instructor-become-title">Become an Instructor</h4>
                                    <span class="tp-instructor-become-subtitle">Plan your course</span> -->
                                    <p>Joining our platform comes with numerous benefits that set you up for success:
<li> <b>Flexible Schedule</b>:<br> Teach on your terms and set your own hours. You decide when and how much to work, giving you full control over your teaching schedule.
<li><b>Global Reach</b>:<br> Expand your audience by connecting with students from different countries and backgrounds, increasing your influence and reputation.
<li><b>User-Friendly Tools</b>:<br> Access intuitive course-building tools, templates, and resources to help you design engaging and impactful lessons with ease.
<li><b>Professional Growth</b>:<br> Enhance your teaching skills through our continuous support and training resources. Learn from a supportive community of instructors and build a stronger personal brand.
<li><b>Revenue Opportunities</b>:<br> Earn income based on course enrollments and reach. The more impactful your courses, the greater your potential to earn.</p>
                                   
                                 </div>
                              </div>
                              <div class="col-lg-5">
                                 <div class="tp-instructor-become-thumb text-end">
                                    <img src="assets/img/instructor/instructor-thumb.png" alt="">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                           <div class="row">
                              <div class="col-lg-7">
                                 <div class="tp-instructor-become-wrap">
                                   
                                    <p>To become an instructor, we ask that you meet the following requirements to ensure a high standard of education for our students:
                                        <li><b>Educational Background</b>:<br> Hold a relevant degree, certification or a proof on proficiency in the subject area you wish to teach or be ready to .
                                        <li><b>Experience</b>:<br> Have proven teaching experience or significant practical knowledge in your field of expertise.
                                        <li><b>Course Proposal</b>:<br> Prepare and submit a detailed course outline, including the structure, key topics, and learning objectives.
                                        <li><b>Sample Content</b>:<br> Provide a short sample video or lesson plan to demonstrate your teaching style and expertise.
                                        <li><b>Identification</b>:<br> Submit valid identification for verification purposes to maintain the integrity and security of our platform.
  
</p>
                                    <!-- <span class="tp-instructor-become-subtitle">How we help you</span> -->
                                    <p>These simple requirements help us maintain a top-tier learning environment and give you a strong start as an instructor on our platform.</p>
                                 </div>
                              </div>
                              <div class="col-lg-5">
                                 <div class="tp-instructor-become-thumb text-end">
                                    <img src="assets/img/instructor/instructor-thumb.png" alt="">
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
        <!-- become instructor area end -->


         

         <!-- become instructor contact area start -->
         <section class="tp-instructor-apply-area pt-120 pb-120">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="tp-instructor-apply-box wow fadeInUp" data-wow-delay=".3s">
                        <div class="row">
                           <div class="col-lg-4">
                              <div class="tp-instructor-apply-thumb">
                                 <img src="assets/img/instructor/instructor-thumb-contact.png" alt="">
                              </div>
                           </div>
                           <div class="col-lg-8">
                              <div class="tp-instructor-apply-from">
                              <?php
// Database connection
// Include your database connection
include 'connect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $instructor_name = $conn->real_escape_string($_POST['name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $location = $conn->real_escape_string($_POST['location']);
    $phone = $conn->real_escape_string($_POST['phone']); // Phone collected but not stored in this table
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT); // Secure password hashing
    $bio = $conn->real_escape_string($_POST['bio']);
    $current_role = $conn->real_escape_string($_POST['current_role']);
    $profile_picture_name = '';

    // Handle file upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'assets/uploads/instructors/'; // Ensure this directory exists and is writable
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_path = $upload_dir . time() . '_' . $file_name; // Unique filename with timestamp

        // Check if file is an image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $file_path)) {
                $profile_picture_name = time() . '_' . $file_name; // Only store the file name
            } else {
                echo "<p>Error uploading profile picture.</p>";
            }
        } else {
            echo "<p>File is not an image.</p>";
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO instructors (instructor_name, bio, `current_role`, profile_picture, email, password, gender, location, created_at, phone_number) 
        VALUES ('$instructor_name', '$bio', '$current_role', '$profile_picture_name', '$email', '$password', '$gender', '$location', NOW(), '$phone')";

        if ($conn->query($sql) === TRUE) {
        // Send a welcome email
        $to = $email;
        $subject = "Welcome to Our Teaching Platform!";
        $message = "Dear $instructor_name,\n\nThank you for signing up as an instructor on our platform. We are excited to have you join our community!\n\nBest Regards,\nThe Team";
        $headers = "From: no-reply@academy.com"; // Change as needed

        if (mail($to, $subject, $message, $headers)) {
            echo "<p>Signup successful and welcome email sent!</p>";
        } else {
            echo "<p>Signup successful but email could not be sent.</p>";
        }
    } else {
        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

$conn->close();
?>



<form action="" method="post" enctype="multipart/form-data">
    <div class="tp-instructor-apply-heading">
        <h3 class="tp-instructor-apply-title">Become an Instructor!</h3>
        <p class="tp-instructor-apply-desc">Discover a supportive community of online instructors.</p>
    </div>

    <div class="tp-instructor-apply-form-wrapper">
        <div class="row">
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Name</label>
                    <input type="text" name="name" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Gender</label><br>
                    <select name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Location</label>
                    <input type="text" name="location" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Phone number</label>
                    <input type="text" name="phone" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Email address (Username)</label>
                    <input type="email" name="email" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tp-instructor-apply-input">
                    <label>Current Job Role</label>
                    <input type="text" name="current_role" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tp-instructor-apply-input">
                    <label>Bio</label>
                    <textarea name="bio" required></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tp-instructor-apply-input">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_picture" accept="image/*" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tp-instructor-apply-input-btn">
                    <button class="tp-btn-inner" type="submit" name="submit">Become an Instructor</button>
                </div>
            </div>
        </div>
    </div>
</form>


                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- become instructor contact area end -->

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
