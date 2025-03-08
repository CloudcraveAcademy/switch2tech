 <!-- my-course-area-start -->
                         <section class="tp-dashboard-course-wrapper">
                           <div class="row">
                              <div class="col-8">
                                 <div class="tp-dashboard-section">
                                    <h2 class="tp-dashboard-title">My Courses and Earnings</h2>
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
                                                <span>Total Enrollements</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>Total Earnings</span>
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>&nbsp; </span>
                                             </div>
                                          </div>
                                       </li>
                                       <?php
// Include the database connection
include 'connect.php';

// Replace 'your_instructor_id' with the actual instructor ID or a variable representing the logged-in instructor
//$instructor_id = 1; // Example value; use a dynamic value as needed

// SQL query to get course details, total enrollments, and earnings for a specific instructor
$query = "
    SELECT 
        c.course_id,
        c.course_name,
        COUNT(e.enrollment_id) AS total_enrollments,
        ROUND(
            SUM(
                IFNULL(
                    (c.price - (c.price * (c.discount_percentage / 100))) * 0.40 * IF(e.enrollment_id IS NOT NULL, 1, 0), 
                    0
                )
            ), 
            2
        ) AS total_earnings
    FROM 
        courses c
    LEFT JOIN 
        enrollments e ON c.course_id = e.course_id
    WHERE 
        c.instructor_id = ?
    GROUP BY 
        c.course_id
    ORDER BY 
        c.course_name"; // Order by course name for better readability

// Prepare the statement
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $instructor_id); // Bind the instructor ID parameter
$stmt->execute();
$result = $stmt->get_result();

// Check if any records are found
if ($result->num_rows > 0):
    // Loop through and display the results
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
                                             <span><?php echo $course['total_enrollments']; ?></span> <!-- Display total enrollments -->
                                             </div>
                                             <div class="tp-dashboard-course-rating">
                                                <span>$<?php echo number_format($course['total_earnings'], 2); ?></span> <!-- Display total earnings -->
                                             </div>
                                             <div class="tpd-badge sucess">
                                             <a href="course_update.php">
                                             <a href="course_update.php?id=<?php echo $course['course_id']; ?>">Details</a>
                                                  
                                                </a>
                                             </div>
                                          </div>
                                       </li>


<?php
    endwhile;
else:
    // Display a message if no records are found
    echo "<li>No records found</li>";
endif;

// Close the statement and connection
$stmt->close();
//$conn->close();
?>
                                       
                                     
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </section>
                        <!-- my-course-area-end -->
<!-- My Payouts area -->
<?php
// Establish the database connection ($conn should already be set up)

// Fetch upcoming payouts
$instructor_id = $_SESSION['instructor_id']; // Assuming instructor ID is stored in the session
$upcomingPayoutsQuery = "SELECT payout_date, amount, payment_method 
                         FROM payouts 
                         WHERE instructor_id = $instructor_id AND status = 'Pending' 
                         ORDER BY payout_date ASC";
$upcomingResult = $conn->query($upcomingPayoutsQuery);

// Fetch payout history
$payoutHistoryQuery = "SELECT payout_date, amount, payment_method, status, transaction_reference 
                       FROM payouts 
                       WHERE instructor_id = $instructor_id AND status = 'Completed' 
                       ORDER BY payout_date DESC";
$historyResult = $conn->query($payoutHistoryQuery);

// Display in the provided HTML structure
?>

<section class="tp-dashboard-course-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="tp-dashboard-section">
                <h2 class="tp-dashboard-title">Upcoming Payouts</h2>
            </div>
            <div class="tp-dashboard-course-list">
                <ul>
                    <li class="active">
                        <div class="tp-dashboard-course-item">
                            <div class="tp-dashboard-course-name"><h5>Payout Date</h5></div>
                            <div class="tp-dashboard-course-enroll"><span>Amount</span></div>
                            <div class="tp-dashboard-course-rating"><span>Payment Method</span></div>
                        </div>
                    </li>
                    <?php if ($upcomingResult && $upcomingResult->num_rows > 0): ?>
                        <?php while ($row = $upcomingResult->fetch_assoc()): ?>
                            <li>
                                <div class="tp-dashboard-course-item">
                                    <div class="tp-dashboard-course-name"><h6><?php echo htmlspecialchars($row['payout_date']); ?></h6></div>
                                    <div class="tp-dashboard-course-enroll"><span>$<?php echo number_format($row['amount'], 2); ?></span></div>
                                    <div class="tp-dashboard-course-rating"><span><?php echo htmlspecialchars($row['payment_method']); ?></span></div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li><div class="tp-dashboard-course-item"><span>No upcoming payouts found.</span></div></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-12">
            <div class="tp-dashboard-section"><br><br>
                <h2 class="tp-dashboard-title">Payout History</h2>
            </div>
            <div class="tp-dashboard-course-list">
                <ul>
                    <li class="active">
                        <div class="tp-dashboard-course-item">
                            <div class="tp-dashboard-course-name"><h5>Payout Date</h5></div>
                            <div class="tp-dashboard-course-enroll"><span>Amount</span></div>
                            <div class="tp-dashboard-course-rating"><span>Payment Method</span></div>
                            <div class="tp-dashboard-course-rating"><span>Status</span></div>
                            <div class="tp-dashboard-course-rating"><span>Transaction Ref</span></div>
                        </div>
                    </li>
                    <?php if ($historyResult && $historyResult->num_rows > 0): ?>
                        <?php while ($row = $historyResult->fetch_assoc()): ?>
                            <li>
                                <div class="tp-dashboard-course-item">
                                    <div class="tp-dashboard-course-name"><h6><?php echo htmlspecialchars($row['payout_date']); ?></h6></div>
                                    <div class="tp-dashboard-course-enroll"><span>$<?php echo number_format($row['amount'], 2); ?></span></div>
                                    <div class="tp-dashboard-course-rating"><span><?php echo htmlspecialchars($row['payment_method']); ?></span></div>
                                    <div class="tp-dashboard-course-rating"><span><?php echo htmlspecialchars($row['status']); ?></span></div>
                                    <div class="tp-dashboard-course-rating"><span><?php echo htmlspecialchars($row['transaction_reference'] ?: 'N/A'); ?></span></div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <li><div class="tp-dashboard-course-item"><span>No payout history found.</span></div></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
?>

<!-- End My Payouts area -->
                        <?php
                       // require_once'payouts.php';                      
                        ?>
   <!-- My Earnings -->