  <!-- team-area-start -->
  <section class="team-area pt-100 mb-100">
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-lg-6 col-md-8">
                     <div class="tp-section mb-45">
                        <h5 class="tp-section-3-subtitle">Our Team</h5>
                        <h3 class="tp-section-3-title">Meet Our 
                           <span>Instructors
                              <img class="tp-underline-shape-9 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/team-2-svg-1.svg" alt="">
                           </span>
                        </h3>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-4">
                     <div class="tp-team-2-arrow d-flex align-items-center justify-content-md-end mb-55">
                        <div class="tp-team-2-prev">
                           <span>
                              <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M6 11L1 6L6 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </span>
                        </div>
                        <div class="tp-team-2-next">
                           <span>
                              <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="swiper tp-team-2-active wow fadeInUp" data-wow-delay=".5s">
                  <div class="swiper-wrapper align-items-end">


                     <!-- -->


                     <?php
// Include the database connection
include 'connect.php';  // Make sure the path to 'connect.php' is correct

// Fetch instructors from the database using mysqli
$query_ins = "SELECT * FROM instructors WHERE status = 'approved'";
$result_ins = $conn->query($query_ins);  // Execute the query

// Check if there are results
if ($result_ins->num_rows > 0):
?>


    <?php while ($instructor_ins = $result_ins->fetch_assoc()): ?>
      
                   <div class="swiper-slide">
                        <div class="tp-team-2-item">
                            <div class="tp-team-2-thumb">
                             <img src="assets/uploads/instructors/<?php echo htmlspecialchars($instructor_ins['profile_picture']); ?>" alt="<?php echo htmlspecialchars($instructor_ins['instructor_name']); ?>">
                           </div>
                           <div class="tp-team-2-content">
                              <h4 class="tp-team-2-title"><a href="my-profile.html">  <?php echo htmlspecialchars($instructor_ins['instructor_name']); ?></a></h4>
                              <span> <?php echo htmlspecialchars($instructor_ins['current_role']); ?></span>
                           </div>
                        </div>
                     </div>
                  
    <?php endwhile; ?>


<?php
else:
    echo "<p>No instructors found.</p>";
endif;

// Close the connection
$conn->close();
?>


                  </div>
               </div>
            </div>
         </section>
         <!-- team-area-end -->