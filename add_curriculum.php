<?php
require_once('connect.php');

$course_id = $_POST['course_id'];
$title = $_POST['title'];
$description = $_POST['description'];

$query = "INSERT INTO course_curriculum (course_id, title, description) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $course_id, $title, $description);

echo $stmt->execute() ? 'success' : 'error';
