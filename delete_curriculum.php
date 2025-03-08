<?php
require_once('connect.php');

$curriculum_id = $_POST['curriculum_id'];
$query = "DELETE FROM course_curriculum WHERE curriculum_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $curriculum_id);

echo $stmt->execute() ? 'success' : 'error';
