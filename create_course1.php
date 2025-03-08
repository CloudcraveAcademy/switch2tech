<?php
session_start();
if (!isset($_SESSION['instructor_logged_in']) || $_SESSION['instructor_logged_in'] !== true) {
   header('Location: login.php');
   exit;
}
// Get the instructor ID from the session
$instructor_id = $_SESSION['instructor_id'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
   <meta charset="utf-8">
   <meta http-equiv="x-ua-compatible" content="ie=edge">
   <title>Cloudcrave Academy - Create Course Page</title>
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

   

</head>

<body>

   <!-- pre loader area start -->
   <!-- <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
             
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
      </div> -->
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
                        <a class="preview" href="instructor_dashboard.php">Dashboard</a>

                        <a class="draft" href="#">Save as Draft</a>

                        <a class="pulish" href="#">Publish</a>
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



   <main class="tp-dashboard-body-bg p-relative">
      <div class="tpd-dashboard-wrap-bg" data-background="assets/img/dashboard/bg/dashboard-bg-shape-1.jpg">

         <!-- create new course area start -->
         <section class="tpd-new-course-area pt-80 pb-120">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8">
                     <div class="tpd-new-course-wrap">
                        <div class="tpd-new-course-box">

                           <div class="accordion" id="accordionPanelsStayOpenExample">


                              <?php
                              if (isset($_GET['success'])) {
                                 include('create_curriculum.php');
                              }
                              ?>
                              <?php
                              require_once 'create_course_info2.php';


                              //    require_once 'create_curriculum.php';

                              // require_once 'add_instructor.php';
                              ?>
                              <!-- create curriculum -->
                              <div class="accordion-item">
                                 <h2 class="accordion-header">
                                    <button class="accordion-button collapsed tpd-new-course-heading-title " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                       Course Curriculum Builder
                                    </button>
                                 </h2>
                                 <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                       <div class="tpd-new-course-modal-btn">

                                          <!-- modal-announcement-btn -->
                                          <div class="curriculum-intro">
                                             <h3>Curriculum Builder</h3>
                                             <p>
                                                Craft an engaging and structured learning experience for your students by adding a detailed course curriculum.
                                                Use this tool to create sections and lessons that guide students through the course content step by step.
                                             </p>
                                             <h4>📌 How to Get Started:</h4>
                                             <ol>
                                                <li>Click on the <strong>"Add Curriculum"</strong> button to create a new section.</li>
                                                <li>Provide a title and description for the section to outline its purpose.</li>
                                                <li>Add lessons under each section to break down the learning material into manageable chunks.</li>
                                             </ol>
                                             <p><strong>💡 Tip:</strong> A clear and organized curriculum helps students stay on track and boosts their learning experience.</p>
                                          </div>

                                          <Add type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@fat"><span><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path d="M10.5 20C16.0228 20 20.5 15.5228 20.5 10C20.5 4.47715 16.0228 0 10.5 0C4.97715 0 0.5 4.47715 0.5 10C0.5 15.5228 4.97715 20 10.5 20Z" fill="white" />
                                                   <path d="M10.5 6V14" stroke="#556DF5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                   <path d="M6.5 10H14.5" stroke="#556DF5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg></span> Add Curriculum <?php echo "$instructor_id "; ?> </Add Curricubutton>
                                          <!-- modal-Curriculum-btn-end -->

                                          <!-- modal-Curriculum-start -->

                                          <!-- Modal -->
                                          <div class="modal fade tpd-modal-announcement" id="exampleModal2" tabindex="-1" aria-hidden="true">
                                             <div class="modal-dialog">
                                                <div class="modal-content">
                                                   <div class="modal-header">
                                                      <h4 class="tpd-modal-title" id="exampleModalLabel">Add Curriculum</h4>
                                                      <button type="button" class="tpd-modal-btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                         <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                               <path d="M13 1L1 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                               <path d="M1 1L13 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                         </span>
                                                      </button>
                                                   </div>
                                                   <div class="modal-body">
                                                      <form id="add-curriculum-form">
                                                         <div class="tpd-input-white mb-20">
                                                            <label>Curriculum Title</label>
                                                            <input type="text" id="curriculum-title" placeholder="Enter Curriculum Title" required>
                                                         </div>
                                                         <div class="tpd-input-white">
                                                            <label for="curriculum-description" class="col-form-label">Details</label>
                                                            <textarea id="curriculum-description" placeholder="Details..." required></textarea>
                                                         </div>
                                                         <button type="submit" class="tpd-btn-edit ml-10">Add Curriculum</button>
                                                      </form>
                                                      <div class="tpd-input mt-4">
                                                         <h5>Curriculum List</h5>
                                                         <ul id="curriculum-list"></ul>
                                                      </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                      <button type="button" class="tpd-btn-cancel" data-bs-dismiss="modal">Close</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>


                                          <!-- Modal Structure -->



                                       </div>

                                    </div>
                                 </div>
                              </div>
                              <!-- end create curriculum -->



                           </div>

                        </div>
                     </div>
                  </div>
                  <div class="col-lg-4">
                     <!-- my-course-area-start -->
                     <!-- my-course-area-start -->
                     <section class="tp-dashboard-course-wrapper">
                        <div class="row">
                           <div class="col-8">
                              <div class="tp-dashboard-section">
                                 <h2 class="tp-dashboard-title">My Courses - Draft</h2>
                              </div>
                           </div>

                        </div>
                        <div class="row">
                           <div class="col-12">
                              <div class="tp-dashboard-course-list">
                                 <ul>
                                    <li class="active">
                                       <div class="tp-dashboard-course-item">
                                          <div class="tp-dashboard-course-name">
                                             <h5 class="tp-dashboard-course-name-title">Course Name</h5>
                                          </div>
                                          <!-- <div class="tp-dashboard-course-rating">
                                                <span>Category</span>
                                             </div> -->
                                          <!-- <div class="tp-dashboard-course-rating">
                                                <span>Updated</span>
                                             </div> -->
                                          <div class="tp-dashboard-course-rating">
                                             <span>Action</span>
                                          </div>
                                       </div>
                                    </li>
                                    <?php
                                    // Include the database connection
                                    include 'connect.php';  // Make sure the path to 'connect.php' is correct
                                    // Get the instructor ID from the session
                                    //$instructor_id = $_SESSION['instructor_id'];

                                    // Modify the query to include instructor_id
                                    $query = "SELECT c.*, cat.category_name 
          FROM courses c
          LEFT JOIN course_categories cat ON c.category_id = cat.category_id
          WHERE c.status = 'Draft' AND c.instructor_id = $instructor_id 
          ORDER BY c.course_id DESC
          LIMIT 10";
                                    $result = $conn->query($query);  // Execute the query

                                    // Check if there are results
                                    if ($result->num_rows > 0):
                                       // Loop through the results and display them
                                       while ($course = $result->fetch_assoc()):
                                    ?>
                                          <li>
                                             <div class="tp-dashboard-course-item">
                                                <div class="tp-dashboard-course-name">
                                                   <h5 class="tp-dashboard-course-name-title">
                                                      <a href="course_update.php?id=<?php echo $course['course_id']; ?>">
                                                         <?php echo htmlspecialchars($course['course_name']); ?>
                                                      </a>
                                                   </h5>
                                                </div>
                                                <div class="tp-dashboard-course-rating">
                                                   <span></span>
                                                </div>
                                                <!-- <div class="tp-dashboard-course-rating">
                    <span><?php // echo htmlspecialchars($course['updated_at']); 
                           ?></span>
                </div> -->
                                                <div class="tp-dashboard-course-rating tpd-action-inexact-btn">
                                                   <div class="tpd-instructor-qa-action">
                                                      <div class="tpd-action-inexact-btn">
                                                         <button class="click">
                                                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                               <path d="M15 10.5C15.8284 10.5 16.5 9.82843 16.5 9C16.5 8.17157 15.8284 7.5 15 7.5C14.1716 7.5 13.5 8.17157 13.5 9C13.5 9.82843 14.1716 10.5 15 10.5Z" fill="currentColor"></path>
                                                               <path d="M15 16.5C15.8284 16.5 16.5 15.8284 16.5 15C16.5 14.1716 15.8284 13.5 15 13.5C14.1716 13.5 13.5 14.1716 13.5 15C13.5 15.8284 14.1716 16.5 15 16.5Z" fill="currentColor"></path>
                                                               <path d="M15 22.5C15.8284 22.5 16.5 21.8284 16.5 21C16.5 20.1716 15.8284 19.5 15 19.5C14.1716 19.5 13.5 20.1716 13.5 21C13.5 21.8284 14.1716 22.5 15 22.5Z" fill="currentColor"></path>
                                                            </svg>
                                                         </button>
                                                         <div class="tpd-action-click-tooltip">
                                                            <button>
                                                               <span>
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="13" viewBox="0 0 14 13" fill="none">
                                                                     <path d="M8.24422 2.037C8.69134 1.59294 8.91489 1.37092 9.15245 1.24141C9.72565 0.928917 10.4315 0.9192 11.0142 1.21578C11.2557 1.33869 11.4862 1.55447 11.947 1.98602C12.4079 2.41757 12.6383 2.63335 12.7696 2.85951C13.0863 3.40522 13.0759 4.06614 12.7422 4.60289C12.6039 4.82534 12.3668 5.03468 11.8926 5.45336L6.25038 10.4349C5.35173 11.2283 4.9024 11.625 4.34084 11.8261C3.77927 12.0271 3.16192 12.0123 1.92722 11.9827L1.75923 11.9787C1.38334 11.9697 1.1954 11.9652 1.08615 11.8515C0.976902 11.7379 0.991817 11.5624 1.02165 11.2114L1.03785 11.0208C1.1218 10.033 1.16378 9.53902 1.37422 9.09502C1.58466 8.65102 1.94766 8.29051 2.67366 7.56948L8.24422 2.037Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                     <path d="M7.59375 2.09924L11.7938 5.94924" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                                                                     <path d="M8.19531 12L12.9953 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                  </svg>
                                                               </span>
                                                               Edit
                                                            </button>
                                                            <button>
                                                               <span>
                                                                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                                                     <path d="M12 3.09998L11.5869 9.11504C11.4813 10.6519 11.4285 11.4203 11.0005 11.9727C10.7889 12.2458 10.5164 12.4764 10.2005 12.6496C9.56141 13 8.706 13 6.99517 13C5.28208 13 4.42554 13 3.78604 12.6489C3.46987 12.4754 3.19733 12.2445 2.98579 11.9709C2.55792 11.4175 2.5063 10.648 2.40307 9.10907L2 3.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                                     <path d="M13 3.09998H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                                     <path d="M9.70239 3.1L9.24728 2.25504C8.94496 1.69375 8.7938 1.41311 8.53305 1.23808C8.47521 1.19926 8.41397 1.16473 8.34992 1.13482C8.06118 1 7.71465 1 7.02159 1C6.31113 1 5.95589 1 5.66236 1.14047C5.59731 1.1716 5.53523 1.20754 5.47677 1.2479C5.213 1.43002 5.06566 1.72093 4.77098 2.30276L4.36719 3.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                                     <path d="M5.33594 9.70007L5.33594 6.10007" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                                     <path d="M8.66406 9.69998L8.66406 6.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                                  </svg>
                                                               </span>
                                                               Delete
                                                            </button>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </li>
                                    <?php
                                       endwhile;
                                    else:
                                       // If no records are found, display a message
                                       echo "<li>No records found </li>";
                                    endif;

                                    // Close the connection
                                    //$conn->close();
                                    ?>



                                 </ul>
                              </div>
                           </div>
                        </div>
                     </section>
                     <!-- my-course-area-end -->
                     <!-- my-course-area-end -->

                     <div class="">
                        <div class="tpd-course-enroll-list">
                           <?php
                           // Database connection (update with your DB credentials)

                           // Check connection
                           if ($conn->connect_error) {
                              die("Connection failed: " . $conn->connect_error);
                           }

                           // Fetch tips from the database
                           $sql = "SELECT tip_number, tip_text FROM course_tips ORDER BY tip_number ASC";
                           $result = $conn->query($sql);

                           ?>

                           <h2 class="tp-dashboard-title">Course Upload Tips</h2>
                           <ul>
                              <?php
                              if ($result->num_rows > 0) {
                                 // Output each tip
                                 while ($row = $result->fetch_assoc()) {
                                    echo '<li>';
                                    echo '<span>' . $row['tip_number'] . '. </span>';
                                    echo htmlspecialchars($row['tip_text']);
                                    echo '</li>';
                                 }
                              } else {
                                 echo '<li>No tips available.</li>';
                              }
                              ?>
                           </ul>

                           <?php
                           //$conn->close();
                           ?>

                        </div>
                     </div>
                  </div>
               </div>
         </section>
         <!-- create new course area end -->

      </div>
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
   <script src="assets/js/range-slider.js"></script>
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
   <script>
      
      $(document).ready(function() {
         const courseId = <?php echo $course_id; ?>; // Replace with dynamic course ID if needed

         // Fetch and display curriculum list
         function fetchCurriculums() {
            $.ajax({
               url: 'fetch_curriculum.php',
               method: 'GET',
               data: {
                  course_id: courseId
               },
               success: function(response) {
                  $('#curriculum-list').html(response);
               },
               error: function() {
                  alert('Error fetching curriculum list.');
               }
            });
         }

         $('#add-curriculum-form').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission and page reload
            const title = $('#curriculum-title').val();
            const description = $('#curriculum-description').val();

            if (title.trim() === '' || description.trim() === '') {
               alert('Both fields are required.');
               return;
            }

            $.ajax({
               url: 'add_curriculum.php',
               method: 'POST',
               data: {
                  course_id: courseId,
                  title: title,
                  description: description
               },
               success: function(response) {
                  if (response === 'success') {
                     fetchCurriculums(); // Refresh the curriculum list
                     $('#curriculum-title').val('');
                     $('#curriculum-description').val('');
                     alert('Curriculum added successfully.');
                  } else {
                     alert('Error adding curriculum.');
                  }
               },
               error: function() {
                  alert('An error occurred while adding the curriculum.');
               }
            });
         });

         // Delete curriculum
         $(document).on('click', '.delete-curriculum', function() {
            const curriculumId = $(this).data('id');
            if (confirm('Are you sure you want to delete this curriculum?')) {
               $.ajax({
                  url: 'delete_curriculum.php',
                  method: 'POST',
                  data: {
                     curriculum_id: curriculumId
                  },
                  success: function(response) {
                     if (response === 'success') {
                        fetchCurriculums();
                        alert('Curriculum deleted successfully.');
                     } else {
                        alert('Error deleting curriculum.');
                     }
                  },
                  error: function() {
                     alert('Error deleting curriculum.');
                  }
               });
            }
         });

         // Edit curriculum
         $(document).on('click', '.edit-curriculum', function() {
            const curriculumId = $(this).data('id');
            const title = $(this).data('title');
            const description = $(this).data('description');

            const newTitle = prompt('Edit Title:', title);
            const newDescription = prompt('Edit Description:', description);

            if (newTitle !== null && newDescription !== null) {
               $.ajax({
                  url: 'edit_curriculum.php',
                  method: 'POST',
                  data: {
                     curriculum_id: curriculumId,
                     title: newTitle,
                     description: newDescription
                  },
                  success: function(response) {
                     if (response === 'success') {
                        fetchCurriculums();
                        alert('Curriculum updated successfully.');
                     } else {
                        alert('Error updating curriculum.');
                     }
                  },
                  error: function() {
                     alert('Error updating curriculum.');
                  }
               });
            }
         });

         // Initial fetch of curriculums
         fetchCurriculums();
      });
   </script>
   <!-- JavaScript to Refresh Parent Page -->
   <script>
      document.addEventListener("DOMContentLoaded", function() {
         // Add an event listener to the modal close event
         const modal = document.getElementById("exampleModal2");

         modal.addEventListener("hidden.bs.modal", function() {
            // Refresh the parent page when the modal is closed
            location.reload();
         });
      });
   </script>


</body>

</html>