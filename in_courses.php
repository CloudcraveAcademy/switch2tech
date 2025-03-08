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
                                             <div class="tp-dashboard-course-enroll">
                                                <span>Category</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>Updated</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span></span>
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
          ORDER BY c.course_id DESC";
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
                <div class="tp-dashboard-course-enroll">
                    <span><?php echo htmlspecialchars($course['category_name']); ?></span> <!-- Display category name -->
                </div>
                <div class="tp-dashboard-course-rating">
                    <span><?php echo htmlspecialchars($course['updated_at']); ?></span>
                </div>
                <div class="tp-dashboard-course-rating tpd-action-inexact-btn">
                <div class="tpd-instructor-qa-action">
                                          <div class="tpd-action-inexact-btn">
                                             <button class="click">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 10.5C15.8284 10.5 16.5 9.82843 16.5 9C16.5 8.17157 15.8284 7.5 15 7.5C14.1716 7.5 13.5 8.17157 13.5 9C13.5 9.82843 14.1716 10.5 15 10.5Z" fill="currentColor"></path><path d="M15 16.5C15.8284 16.5 16.5 15.8284 16.5 15C16.5 14.1716 15.8284 13.5 15 13.5C14.1716 13.5 13.5 14.1716 13.5 15C13.5 15.8284 14.1716 16.5 15 16.5Z" fill="currentColor"></path><path d="M15 22.5C15.8284 22.5 16.5 21.8284 16.5 21C16.5 20.1716 15.8284 19.5 15 19.5C14.1716 19.5 13.5 20.1716 13.5 21C13.5 21.8284 14.1716 22.5 15 22.5Z" fill="currentColor"></path>
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
                                                         <path d="M12 3.09998L11.5869 9.11504C11.4813 10.6519 11.4285 11.4203 11.0005 11.9727C10.7889 12.2458 10.5164 12.4764 10.2005 12.6496C9.56141 13 8.706 13 6.99517 13C5.28208 13 4.42554 13 3.78604 12.6489C3.46987 12.4754 3.19733 12.2445 2.98579 11.9709C2.55792 11.4175 2.5063 10.648 2.40307 9.10907L2 3.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M13 3.09998H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M9.70239 3.1L9.24728 2.25504C8.94496 1.69375 8.7938 1.41311 8.53305 1.23808C8.47521 1.19926 8.41397 1.16473 8.34992 1.13482C8.06118 1 7.71465 1 7.02159 1C6.31113 1 5.95589 1 5.66236 1.14047C5.59731 1.1716 5.53523 1.20754 5.47677 1.2479C5.213 1.43002 5.06566 1.72093 4.77098 2.30276L4.36719 3.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                         <path d="M5.33594 9.70007L5.33594 6.10007" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M8.66406 9.69998L8.66406 6.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
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
                        <!-- my-course-area-end -->                          <!-- my-course-area-start -->
                          <section class="tp-dashboard-course-wrapper">
                           <div class="row">
                              <div class="col-8">
                                 <div class="tp-dashboard-section">
                                    <h2 class="tp-dashboard-title">My Courses - Published</h2>
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
                                             <div class="tp-dashboard-course-enroll">
                                                <span>Category</span>
                                             </div>
                                            
                                             <div class="tp-dashboard-course-rating">
                                                <span>Status</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>Updated</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span></span>
                                             </div>
                                          </div>
                                       </li>
   <?php
// Include the database connection
include 'connect.php';  // Make sure the path to 'connect.php' is correct

// Fetch courses with status 'Draft' and join with the course_categories table to get category name
$query = "SELECT c.*, cat.category_name 
          FROM courses c
          LEFT JOIN course_categories cat ON c.category_id = cat.category_id
          WHERE c.status != 'Draft' AND c.instructor_id = $instructor_id
          ORDER BY c.course_id DESC";

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
                <div class="tp-dashboard-course-enroll">
                    <span><?php echo htmlspecialchars($course['category_name']); ?></span> <!-- Display category name -->
                </div>
                <div class="tp-dashboard-course-rating">
                        <span><?php if ($course['status'] == 'Published') { echo 'Pending Approval'; } else { echo htmlspecialchars($course['status']); } ?>
                        </span>
                </div>
                <div class="tp-dashboard-course-rating">
                    <span><?php echo htmlspecialchars($course['updated_at']); ?></span>
                </div>
                <div class="tp-dashboard-course-rating tpd-action-inexact-btn">
                <div class="tpd-instructor-qa-action">
                                          <div class="tpd-action-inexact-btn">
                                             <button class="click">
                                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 10.5C15.8284 10.5 16.5 9.82843 16.5 9C16.5 8.17157 15.8284 7.5 15 7.5C14.1716 7.5 13.5 8.17157 13.5 9C13.5 9.82843 14.1716 10.5 15 10.5Z" fill="currentColor"></path><path d="M15 16.5C15.8284 16.5 16.5 15.8284 16.5 15C16.5 14.1716 15.8284 13.5 15 13.5C14.1716 13.5 13.5 14.1716 13.5 15C13.5 15.8284 14.1716 16.5 15 16.5Z" fill="currentColor"></path><path d="M15 22.5C15.8284 22.5 16.5 21.8284 16.5 21C16.5 20.1716 15.8284 19.5 15 19.5C14.1716 19.5 13.5 20.1716 13.5 21C13.5 21.8284 14.1716 22.5 15 22.5Z" fill="currentColor"></path>
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
                                                         <path d="M12 3.09998L11.5869 9.11504C11.4813 10.6519 11.4285 11.4203 11.0005 11.9727C10.7889 12.2458 10.5164 12.4764 10.2005 12.6496C9.56141 13 8.706 13 6.99517 13C5.28208 13 4.42554 13 3.78604 12.6489C3.46987 12.4754 3.19733 12.2445 2.98579 11.9709C2.55792 11.4175 2.5063 10.648 2.40307 9.10907L2 3.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M13 3.09998H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M9.70239 3.1L9.24728 2.25504C8.94496 1.69375 8.7938 1.41311 8.53305 1.23808C8.47521 1.19926 8.41397 1.16473 8.34992 1.13482C8.06118 1 7.71465 1 7.02159 1C6.31113 1 5.95589 1 5.66236 1.14047C5.59731 1.1716 5.53523 1.20754 5.47677 1.2479C5.213 1.43002 5.06566 1.72093 4.77098 2.30276L4.36719 3.1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                                         <path d="M5.33594 9.70007L5.33594 6.10007" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path><path d="M8.66406 9.69998L8.66406 6.09998" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
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
    echo "<li>No records found</li>";
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