<?php
require_once('connect.php');

$curriculum_id = $_POST['curriculum_id'];
$title = $_POST['title'];
$description = $_POST['description'];

$query = "UPDATE course_curriculum SET title = ?, description = ? WHERE curriculum_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssi", $title, $description, $curriculum_id);

echo $stmt->execute() ? 'success' : 'error';
