<form action="upload_course.php" method="post" enctype="multipart/form-data">
    <label for="course_name">Course Name:</label>
    <input type="text" id="course_name" name="course_name" required>

    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <!-- Populate options dynamically -->
    </select>

    <label for="description">Description:</label>
    <textarea id="description" name="description"></textarea>

    <label for="price">Price:</label>
    <input type="number" step="0.01" id="price" name="price">

    <label for="discount_percentage">Discount Percentage:</label>
    <input type="number" step="0.01" id="discount_percentage" name="discount_percentage" value="0.00">

    <label for="course_image_url">Course Image:</label>
    <input type="file" id="course_image_url" name="course_image_url">

    <label for="intro_video_url">Intro Video URL:</label>
    <input type="text" id="intro_video_url" name="intro_video_url">

    <label for="duration">Duration (in weeks/hours):</label>
    <input type="number" id="duration" name="duration">

    <label for="prerequisites">Prerequisites:</label>
    <textarea id="prerequisites" name="prerequisites"></textarea>

    <label for="level">Level:</label>
    <select id="level" name="level">
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
    </select>

    <label for="home_featured">Home Featured:</label>
    <input type="checkbox" id="home_featured" name="home_featured" value="1">

    <label for="banner_featured">Banner Featured:</label>
    <input type="checkbox" id="banner_featured" name="banner_featured" value="1">

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Draft">Draft</option>
        <option value="Published">Published</option>
    </select>

    <label for="instructor_id">Instructor:</label>
    <select id="instructor_id" name="instructor_id">
        <!-- Populate options dynamically -->
    </select>

    <label for="mode">Mode:</label>
    <select id="mode" name="mode">
        <option value="Virtual">Virtual</option>
        <option value="Physical">Physical</option>
        <option value="Recorded">Recorded</option>
    </select>

    <label for="registration_deadline">Registration Deadline:</label>
    <input type="date" id="registration_deadline" name="registration_deadline">

    <button type="submit">Upload Course</button>
</form>
