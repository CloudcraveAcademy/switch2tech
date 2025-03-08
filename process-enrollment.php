<?php
require_once 'connect.php'; // Include the database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $phone = trim($_POST['phoneNumber']);
    $gender = trim($_POST['gender']);
    $city = trim($_POST['city']);
    $stateProvince = trim($_POST['stateProvince']);
    $country = trim($_POST['countryDropdown']);
    $education = trim($_POST['educationLevel']);
    $fieldStudy = trim($_POST['fieldStudy']);
    $currentJobTitle = trim($_POST['currentJobTitle']);
    $employerName = trim($_POST['employerName']);
    $specialRequirements = trim($_POST['specialRequirements']);
    $howDidYouHear = trim($_POST['howDidYouHear']);
    $agreeToTerms = isset($_POST['agreeToTerms']) ? 1 : 0;
    $courseId = intval($_POST['course_id']);

    if (!$email) {
        die("Invalid email address.");
    }

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Check if the student email already exists
        $stmt = $conn->prepare("SELECT student_id FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Student exists, get their student_id
            $row = $result->fetch_assoc();
            $studentId = $row['student_id'];
        } else {
            // Insert new student
            $stmt = $conn->prepare("
                INSERT INTO students (
                    name, email, created_at, student_status, picture, phone, gender, city, 
                    state_province, country, education, field_study, current_job_title, 
                    employer_name, special_requirements, how_did_you_hear_about_us, agree_to_terms
                ) VALUES (
                    ?, ?, NOW(), 'Current Student', 'assets/img/default-avatar.png', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )
            ");
            $studentName = $firstName . " " . $lastName;
            $stmt->bind_param(
                "ssssssssssssss", // Make sure the placeholders match the number of parameters
                $studentName, $email, $phone, $gender, $city, $stateProvince, $country, $education,
                $fieldStudy, $currentJobTitle, $employerName, $specialRequirements, $howDidYouHear, $agreeToTerms
            );            
            $stmt->execute();
            $studentId = $stmt->insert_id;
        }
        $stmt->close();

        // Fetch course details
        $stmt = $conn->prepare("
            SELECT course_name, description, price, discount_percentage, duration, mode, level, prerequisites
            FROM courses
            WHERE course_id = ?
        ");
        $stmt->bind_param("i", $courseId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Course not found.");
        }

        $course = $result->fetch_assoc();
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Calculate the discounted price
        $discountedPrice = $course['price'] * (1 - $course['discount_percentage'] / 100);

        // Prepare email content
        $emailSubject = "Enrollment Confirmation for " . $course['course_name'];
        $emailBody = "
            Dear $firstName $lastName,

            Thank you for enrolling in our course! Below are the details of your enrollment:

            Course Name: {$course['course_name']}
            Description: {$course['description']}
            Level: {$course['level']}
            Duration: {$course['duration']} hours
            Mode: {$course['mode']}
            Price: \$" . number_format($course['price'], 2) . "
            Discounted Price: \$" . number_format($discountedPrice, 2) . "
            Prerequisites: {$course['prerequisites']}

            We are excited to have you onboard and look forward to helping you achieve your learning goals.

            If you have any questions, please don't hesitate to contact us.

            Best regards,
            CloudCrave Academy Team
        ";

        // Send the email
        $headers = "From: CloudCrave Academy <no-reply@cloudcrave.com>\r\n";
        $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($email, $emailSubject, $emailBody, $headers)) {
            echo "Enrollment successful! A confirmation email has been sent to $email.";
        } else {
            echo "Enrollment successful, but we couldn't send a confirmation email.";
        }
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        die("Error: " . $e->getMessage());
    }
}
?>
