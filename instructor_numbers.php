<?php
// Assume database connection is already established and $conn is the connection object
include 'connect.php';
$instructor_id = $_SESSION['instructor_id']; // Assuming instructor ID is stored in session

// Query to count approved courses
$approvedCoursesQuery = "SELECT COUNT(*) AS approved_count FROM courses WHERE instructor_id = $instructor_id AND status = 'Approved'";
$approvedCoursesResult = $conn->query($approvedCoursesQuery);
$approvedCount = $approvedCoursesResult->fetch_assoc()['approved_count'];

// Query to count published courses
$publishedCoursesQuery = "SELECT COUNT(*) AS published_count FROM courses WHERE instructor_id = $instructor_id AND status = 'Published'";
$publishedCoursesResult = $conn->query($publishedCoursesQuery);
$publishedCount = $publishedCoursesResult->fetch_assoc()['published_count'];

// Query to count total enrollments
$totalEnrollmentsQuery = "SELECT COUNT(*) AS enrollment_count FROM enrollments WHERE course_id IN (SELECT course_id FROM courses WHERE instructor_id = $instructor_id)";
$totalEnrollmentsResult = $conn->query($totalEnrollmentsQuery);
$totalEnrollments = $totalEnrollmentsResult->fetch_assoc()['enrollment_count'];

// Query to count total unique students
$totalStudentsQuery = "SELECT COUNT(DISTINCT student_id) AS student_count FROM enrollments WHERE course_id IN (SELECT course_id FROM courses WHERE instructor_id = $instructor_id)";
$totalStudentsResult = $conn->query($totalStudentsQuery);
$totalStudents = $totalStudentsResult->fetch_assoc()['student_count'];

// Query to calculate total upcoming payouts
$upcomingPayoutsQuery = "SELECT SUM(amount) AS upcoming_total FROM payouts WHERE instructor_id = $instructor_id AND status = 'Pending'";
$upcomingPayoutsResult = $conn->query($upcomingPayoutsQuery);
$upcomingTotal = $upcomingPayoutsResult->fetch_assoc()['upcoming_total'] ?: 0; // Defaults to 0 if no result

// Query to calculate total earned
$totalEarnedQuery = "SELECT SUM(amount) AS total_earned FROM payouts WHERE instructor_id = $instructor_id AND status = 'Completed'";
$totalEarnedResult = $conn->query($totalEarnedQuery);
$totalEarned = $totalEarnedResult->fetch_assoc()['total_earned'] ?: 0; // Defaults to 0 if no result

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>


<section class="tp-fact-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <div class="tp-dashboard-section">
                <h2 class="tp-dashboard-title">Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count"><?php echo htmlspecialchars($approvedCount); ?></h4>
                    <span>Approved Courses</span>
                </div>
                <div class="tp-fact-icon">
                <span class="common-pale-yellow"><img src="assets/img/dashboard/icon/fact/enroll-icon.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count"><?php echo htmlspecialchars($publishedCount); ?></h4>
                    <span>Pending Courses</span>
                </div>
                <div class="tp-fact-icon">
                    <span class="common-pale-yellow"><img src="assets/img/dashboard/icon/fact/enroll-icon.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count"><?php echo htmlspecialchars($totalEnrollments); ?></h4>
                    <span>Total Enrollments</span>
                </div>
                <div class="tp-fact-icon">
                <span><img src="assets/img/dashboard/icon/fact/teacher.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count"><?php echo htmlspecialchars($totalStudents); ?></h4>
                    <span>Total Students</span>
                </div>
                <div class="tp-fact-icon">
                    <span class="common-pale-green"><img src="assets/img/dashboard/icon/fact/students.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count">$<?php echo number_format($upcomingTotal, 0); ?></h4>
                    <span>Upcoming Payouts</span>
                </div>
                <div class="tp-fact-icon">
                    <span class="common-pale-purple"><img src="assets/img/dashboard/icon/fact/card-pos.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="tp-fact-item d-flex align-items-center justify-content-between">
                <div class="tp-fact-content">
                    <h4 class="tp-fact-count">$<?php echo number_format($totalEarned, 0); ?></h4>
                    <span>Total Earned</span>
                </div>
                <div class="tp-fact-icon">
                    <span class="common-pale-blue"><img src="assets/img/dashboard/icon/fact/course-total.svg" alt="fact-icon"></span>
                </div>
            </div>
        </div>
    </div>
</section>

