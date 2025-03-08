<?php
// Include database connection
include 'connect.php';

$course_data = null; // Variable to hold course data

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Initialize variables
   $course_id = $_POST['course_id'] ?? null;
   $course_name = $_POST['course_name'] ?? null;
   $description = $_POST['description'] ?? null;
   $prerequisites = $_POST['prerequisites'] ?? null;
   $level = $_POST['level'] ?? null;
   $duration = $_POST['duration'] ?? null;
   $price = $_POST['price'] ?? null;
   $discount_percentage = $_POST['discount_percentage'] ?? null;
   $mode = $_POST['course_mode'] ?? null;
   $registration_deadline = $_POST['registration_deadline'] ?? null;
   $session_duration = $_POST['session_duration'] ?? null;
   //$timezone = $_POST['timezone'] ?? null;
   $training_days = isset($_POST['training_days']) ? implode(',', $_POST['training_days']) : null;
   $daily_start_time = $_POST['daily_start_time'] ?? null;
   $start_datetime = $_POST['course_start_date'] ?? null;
   $category_id = $_POST['course_category'] ?? null;
   $status = "Draft";


   $intro_video = null;
   $course_image = null;

   // Validate required fields
   if (!$course_name || !$description || !$level || !$price || !$mode || !$category_id) {
      echo "Error: All required fields must be filled!";
      exit;
   }

   // Handle intro video upload
   if (!empty($_FILES['intro_video']['tmp_name'])) {
      $video_dir = "videos/";
      $video_file = basename($_FILES['intro_video']['name']); // Extract only the file name

      // Create directory if it doesn't exist
      if (!is_dir($video_dir)) {
         mkdir($video_dir, 0777, true);
      }

      // Move uploaded file
      if (move_uploaded_file($_FILES['intro_video']['tmp_name'], $video_dir . $video_file)) {
         $intro_video = $video_file; // Store only the file name
      } else {
         echo "Error: Failed to upload the video.";
         exit;
      }
   }

   // Handle course image upload
   if (!empty($_FILES['course_image']['tmp_name'])) {
      $image_dir = "assets/uploads/courses/";
      $image_file = basename($_FILES['course_image']['name']); // Extract only the file name

      // Create directory if it doesn't exist
      if (!is_dir($image_dir)) {
         mkdir($image_dir, 0777, true);
      }

      // Move uploaded file
      if (move_uploaded_file($_FILES['course_image']['tmp_name'], $image_dir . $image_file)) {
         $course_image = $image_file; // Store only the file name
      } else {
         echo "Error: Failed to upload the course image.";
         exit;
      }
   }

   // Correct assignment of variables
   $timezone = $_POST['timezone'] ?? null; // Separate the timezone variable properly

   // Insert data into the database
   $sql = "INSERT INTO courses (course_name, description, prerequisites, level, duration, price, discount_percentage, mode, registration_deadline, session_duration, timezone, training_days, daily_start_time, start_datetime, category_id, status, instructor_id, intro_video_url, course_image_url)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

   $stmt = $conn->prepare($sql);
   $stmt->bind_param(
      "ssssddsssssssssssss", // Correct number of types
      $course_name,
      $description,
      $prerequisites,
      $level,
      $duration,
      $price,
      $discount_percentage,
      $mode,
      $registration_deadline,
      $session_duration,
      $timezone,
      $training_days,
      $daily_start_time,
      $start_datetime,
      $category_id,
      $status,
      $instructor_id,
      $intro_video,
      $course_image
   );

   if ($stmt->execute()) {
      $course_id = $stmt->insert_id;

      // Fetch the inserted course data
      $fetch_sql = "SELECT * FROM courses WHERE course_id = ?";
      $fetch_stmt = $conn->prepare($fetch_sql);
      $fetch_stmt->bind_param("i", $course_id);
      $fetch_stmt->execute();
      $result = $fetch_stmt->get_result();
      $course_data = $result->fetch_assoc();

      echo "<script>alert('Course Content uploaded successfully!');</script>";
   } else {
      echo "Error: " . $stmt->error;
   }

   $stmt->close();
}
// Pre-fill form if course data exists
?>


<div class="accordion-item">
   <h2 class="accordion-header">
      <button class="accordion-button tpd-new-course-heading-title" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
         Course Info
      </button>
   </h2>
   <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
      <div class="accordion-body">
         <form id="create-course-form" action="create_course.php" method="POST" enctype="multipart/form-data">
            <!-- Course Basic Details Section -->
            <div class="tpd-new-course-box-1">
               <!-- Course Title -->
               <div class="tpd-input">
                  <label for="course-title">Course Title</label>
                  <input id="course-title" name="course_name" type="text" placeholder="Enter course title" value="<?php echo $course_data['course_name'] ?? ''; ?>" required>
               </div>

               <!-- About Course -->
               <div class="tpd-input about-height">
                  <label for="about-course">About Course</label>
                  <textarea id="about-course" name="description" placeholder="Provide details about the course" required><?php echo $course_data['description'] ?? ''; ?></textarea>
               </div>

               <!-- Course Prerequisites -->
               <div class="tpd-input">
                  <label for="course-prerequisites">Course Prerequisites</label>
                  <textarea id="course-prerequisites" name="prerequisites" placeholder="List prerequisites (one per line)"><?php echo $course_data['prerequisites'] ?? ''; ?></textarea>
               </div>

               <!-- Difficulty Level -->
               <div class="tpd-new-course-categories">
                  <div class="tpd-input">
                     <label for="course-difficulty">Course Difficulty Level</label>
                     <div class="tpd-select">
                        <select id="course-difficulty" name="level" required>
                           <option value="beginner">Beginner</option>
                           <option value="intermediate">Intermediate</option>
                           <option value="advanced">Advanced</option>
                        </select>
                     </div>
                  </div>
               </div>

               <!-- Course Duration -->
               <div class="tpd-input-box d-flex">
                  <div class="tpd-input">
                     <label for="course-duration">Course Duration (Weeks)</label>
                     <input id="course-duration" name="duration" type="number" value="<?php echo $course_data['duration'] ?? ''; ?>" placeholder="e.g., 4" required>
                  </div>
               </div>
            </div>

            <!-- Course Mode -->
            <div class="tpd-input">
               <label>Course Mode</label>
               <div class="tpd-order-filter tpd-radio-style tmy-tab">
                  <ul class="nav nav-tabs" id="course-mode" role="tablist">
                     <!-- Virtual Mode -->
                     <li class="nav-item p-relative" role="presentation">
                        <input
                           type="radio"
                           class="tpd-radio-input"
                           id="virtual-mode"
                           name="course_mode"
                           value="Virtual"
                           checked
                           style="display: none;">
                        <label for="virtual-mode" class="nav-link active">
                           <span class="tpd-radio-style-span"></span>
                           <span>Virtual</span>
                        </label>
                     </li>

                     <!-- Physical Mode (Disabled) -->
                     <li class="nav-item p-relative" role="presentation">
                        <input
                           type="radio"
                           class="tpd-radio-input"
                           id="physical-mode"
                           name="course_mode"
                           value="Physical"
                           disabled
                           style="display: none;">
                        <label for="physical-mode" class="nav-link" style="color: gray; background-color: #e0e0e0; cursor: not-allowed;">
                           <span class="tpd-radio-style-span"></span>
                           <span>Physical</span>
                        </label>
                     </li>

                     <!-- Recorded Mode (Disabled) -->
                     <li class="nav-item p-relative" role="presentation">
                        <input
                           type="radio"
                           class="tpd-radio-input"
                           id="recorded-mode"
                           name="course_mode"
                           value="Recorded"
                           disabled
                           style="display: none;">
                        <label for="recorded-mode" class="nav-link" style="color: gray; background-color: #e0e0e0; cursor: not-allowed;">
                           <span class="tpd-radio-style-span"></span>
                           <span>Recorded</span>
                        </label>
                     </li>
                  </ul>
               </div>
            </div>

      </div>

      <!-- Course Categories -->
      <div class="tpd-new-course-box-3">
         <div class="tpd-new-course-categories">
            <div class="tpd-new-course-select2">
               <div class="tpd-input">
                  <label for="course-category">Choose a Category</label>
                  <select id="course-category" name="course_category" class="tpd-select2 form-select" multiple required>
                     <?php
                     // Include database connection
                     //require 'db_connection.php';

                     // Fetch categories from the database
                     $sql = "SELECT category_id, category_name FROM course_categories";
                     $result = $conn->query($sql);

                     $categories = [];
                     if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                           $categories[] = $row; // Store fetched categories in an array
                        }
                     }
                     ?>


                     <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['category_id']); ?>">
                           <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                     <?php endforeach; ?>


                  </select>
               </div>
            </div>

            <!-- Course Pricing -->
            <div class="tpd-input">
               <label>Course Price (Price and discount are subject to review)</label>
               <div class="tpd-order-filter tpd-radio-style tmy-tab">
                  <ul class="nav nav-tabs" id="course-price-type" role="tablist">
                     <li class="nav-item p-relative" role="presentation">
                        <button class="nav-link" id="free-price-tab" data-bs-toggle="tab" type="button" value="0" role="tab">
                           <span class="tpd-radio-style-span"></span>
                           <span>Free</span>
                        </button>
                     </li>
                     <li class="nav-item p-relative" role="presentation">
                        <button class="nav-link active" id="paid-price-tab" data-bs-toggle="tab" type="button" value="1" role="tab" aria-selected="true">
                           <span class="tpd-radio-style-span"></span>
                           <span>Paid</span>
                        </button>
                     </li>
                  </ul>
               </div>
            </div>

            <!-- Price and Discount -->
            <div class="tpd-input-box d-flex">
               <div class="tpd-input">
                  <label for="regular-price">Regular Price ($)</label>
                  <input id="regular-price" name="price" value="<?php echo $course_data['price'] ?? ''; ?>" type="text" placeholder="Enter course price" required>
               </div>
               <div class="tpd-input">
                  <label for="discount">Percentage Discount (%)</label>
                  <input id="discount" name="discount_percentage" value="<?php echo $course_data['discount_percentage'] ?? ''; ?>" type="number" placeholder="e.g., 10">
               </div>
            </div>

            <!-- Course Thumbnail -->
            <div class="tpd-input course-file">
               <label for="course-thumbnail">Course Thumbnail</label>
               <div class="tpd-new-course-file-content text-center">
                  <div class="tpd-new-course-file-thumb mb-15">
                     <img src="assets/img/dashboard/bg/select-file-icon.png" alt="Select File Icon">
                  </div>
                  <span class="upload-btn">
                     <input class="upload-btn" title="Upload Now" for="course-thumbnail" id="course-thumbnail" name="course_image" type="file" accept="image/png, image/jpeg" required>
                     <?php if (!empty($course_data['course_image_url'])): ?>
                        <p>Uploaded Image: <?php echo $course_data['course_image_url']; ?></p>
                     <?php endif; ?>
                     <!-- <label for="course-thumbnail">Upload Course Image</label> -->
                  </span>
                  <p>Size: 700x430 pixels</p>
               </div>
            </div>

            <!-- Intro Video -->
            <div class="tpd-input course-file">
               <label for="intro-video">Intro Video</label>
               <div class="tpd-new-course-file-content text-center">
                  <div class="tpd-new-course-file-thumb mb-15">
                     <img src="assets/img/dashboard/bg/select-file-icon.png" alt="Select File Icon">
                  </div>
                  <span class="upload-btn">
                     <input id="intro-video" name="intro_video" type="file" accept="video/*">
                     <br>
                     <?php if (!empty($course_data['intro_video_url'])): ?>
                        <p>Uploaded Video: <?php echo $course_data['intro_video_url']; ?></p>
                     <?php endif; ?>

                     <!-- <label for="intro-video">Upload a 3-Minute Intro Video</label> -->
                  </span>
                  <p>Please upload a high-quality and well-optimized video for best performance.</p>
               </div>
            </div>

            <!-- Registration Deadline -->
            <div class="tpd-input">
               <label for="registration-deadline">Registration Deadline:</label>
               <input type="text" id="registration-deadline" name="registration_deadline" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="tpd-input upload-btn tpd-new-course-file-content text-center">
               <button type="submit" class="btn btn-primary">Save & Continue</button>
               <p>Go on to create the course curriculum</p>
            </div>


         </div>

      </div>


      </form>
   </div>
</div>
<!-- HTML Form for Course Creation -->