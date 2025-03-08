<?php
require_once('connect.php');

$course_id = $_GET['course_id'];
$query = "SELECT curriculum_id, title, description FROM course_curriculum WHERE course_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
   echo '<li>';
   echo '<strong>' . htmlspecialchars($row['title']) . '</strong>: ' . htmlspecialchars($row['description']);
   echo ' <a href="#" class="edit-curriculum" data-id="' . $row['curriculum_id'] . '" data-title="' . htmlspecialchars($row['title']) . '" data-description="' . htmlspecialchars($row['description']) . '">Edit</a>';
   echo ' | <a href="#" class="delete-curriculum" data-id="' . $row['curriculum_id'] . '">Delete</a>';
   echo '</li>';
}
