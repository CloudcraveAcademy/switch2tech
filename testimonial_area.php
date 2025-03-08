<?php
// Database connection (replace with your actual connection details)
include 'connect.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch course reviews with student details, including their pictures
$sql = "
SELECT 
    cr.review_id,
    cr.course_id,
    cr.student_id,
    cr.rating,
    cr.comment,
    cr.created_at,
    cr.status,
    s.name,
    s.student_status,
    s.picture
FROM 
    course_reviews cr
JOIN 
    students s ON cr.student_id = s.student_id
WHERE status = 'approved'
ORDER BY 
    cr.created_at DESC
";

$result = $conn->query($sql);
?>

<!-- testimonial-area-start -->
<section class="testimonial-area lightblue-bg pb-85">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-8">
                <div class="tp-testimonial-section">
                    <div class="tp-section text-center mb-40">
                        <h5 class="tp-section-3-subtitle"><br>Success Stories</h5>
                        <h3 class="tp-section-3-title">Discover  
                            <span>our
                                <img class="tp-underline-shape-8 wow bounceIn" data-wow-duration="1.5s" data-wow-delay=".4s" src="assets/img/unlerline/testimonial-2-svg-1.svg" alt="">
                            </span>
                            success stories!
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-8">
                    <div class="tp-testimonial-2-avatar-active">
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="tp-testimonial-2-avatar-item">
                                <img src="assets/uploads/students/<?php echo htmlspecialchars($row['picture']); ?>" alt="avatar">
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="tp-testimonial-2-active">
                        <?php
                        // Reset result pointer and fetch the reviews again for detailed display
                        $result->data_seek(0);
                        while ($row = $result->fetch_assoc()): ?>
                            <div class="tp-testimonial-2-item text-center">
                                <div class="tp-testimonial-2-avatar-info">
                                    <h4 class="tp-testimonial-2-avatar-title"><?php echo htmlspecialchars($row['name']); ?></h4>
                                    <span><?php echo htmlspecialchars($row['student_status']); ?> </span>
                                </div>
                                <div class="tp-testimonial-2-content p-relative">
                                    <p><?php echo htmlspecialchars($row['comment']); ?></p>
                                    <div class="tp-testimonial-2-shape">
                                        <div class="shape-1"><img src="assets/img/testimonial/testimonial-shape-1.png" alt=""></div>
                                        <div class="shape-2"><img src="assets/img/testimonial/testimonial-shape-3.png" alt=""></div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">No reviews found.</p>
        <?php endif; ?>

    </div>
</section>
<!-- testimonial-area-end -->

<?php $conn->close(); ?>

