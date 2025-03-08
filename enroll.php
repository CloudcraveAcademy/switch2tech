<?php
// Get course ID from the URL
if (isset($_GET['id']) && isset($_GET['course'])) {
    $c_id = intval($_GET['id']); // Sanitize input
} else {
    // Redirect to courses page or show an error
    header("Location: courses.php");
    exit();
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?php
    require_once 'head.php';
    ?>
    <!-- Add these lines in the <head> section of your HTML -->
    <!-- Include jQuery -->
    <!-- Include jQuery-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>

    <!-- Include stable Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize form validation on the enrollment form
            $("form").validate({
                // Define validation rules
                rules: {
                    firstName: {
                        required: true,
                        minlength: 2
                    },
                    lastName: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phoneNumber: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    city: {
                        required: true
                    },
                    countryDropdown: {
                        required: true
                    },
                    educationLevel: {
                        required: true
                    }
                },
                // Define custom messages for each field
                messages: {
                    firstName: {
                        required: "Please enter your first name",
                        minlength: "First name must be at least 2 characters"
                    },
                    lastName: {
                        required: "Please enter your last name",
                        minlength: "Last name must be at least 2 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    phoneNumber: {
                        required: "Please enter your phone number",
                        digits: "Only numbers are allowed",
                        minlength: "Phone number must be at least 10 digits",
                        maxlength: "Phone number can be up to 15 digits"
                    },
                    city: {
                        required: "Please enter your city"
                    },
                    countryDropdown: {
                        required: "Please select your country"
                    },
                    educationLevel: {
                        required: "Please select your highest level of education"
                    }
                },
                // Customize error placement
                errorPlacement: function(error, element) {
                    error.insertAfter(element); // Place the error message below each input
                },
                // Highlight invalid fields
                highlight: function(element) {
                    $(element).addClass("error");
                },
                unhighlight: function(element) {
                    $(element).removeClass("error");
                }
            });
        });
    </script>


</head>

<body>

    <!-- pre loader area start -->
    <?php
    // require_once 'preloader.php';
    ?>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->

    <!-- search area start -->
    <?php
    require_once 'top_search.php';
    ?>
    <!-- search area end -->


    <!-- cart mini area start -->
    <?php
    require_once 'mini_cart.php';
    ?>
    <!-- cart mini area end -->


    <!-- header-area-start -->
    <?php
    require_once 'header.php';
    ?>

    <!-- header-area-end -->


    <!-- offcanvas area start -->

    <!-- offcanvas area end -->

    <main>

        <!-- faq breadcrumb start -->
        <section class="tp-breadcrumb__area pt-60 pb-60 p-relative z-index-1 fix">
            <div><br> <br> <br> </div>
            <div class="tp-breadcrumb__bg" data-background="assets/img/breadcrumb/breadcrumb-bg.jpg"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="tp-breadcrumb__content">
                            <div class="tp-breadcrumb__list">
                                <span><a href="index.html"><svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.07207 0C8.19331 0 8.31107 0.0404348 8.40664 0.114882L16.1539 6.14233L15.4847 6.98713L14.5385 6.25079V12.8994C14.538 13.1843 14.4243 13.4574 14.2225 13.6589C14.0206 13.8604 13.747 13.9738 13.4616 13.9743H2.69231C2.40688 13.9737 2.13329 13.8603 1.93146 13.6588C1.72962 13.4573 1.61597 13.1843 1.61539 12.8994V6.2459L0.669148 6.98235L0 6.1376L7.7375 0.114882C7.83308 0.0404348 7.95083 0 8.07207 0ZM8.07694 1.22084L2.69231 5.40777V12.8994H13.4616V5.41341L8.07694 1.22084Z" fill="currentColor" />
                                        </svg></a></span>
                                <span>Pages</span>
                                <span class="color">Enroll</span>
                            </div>
                            <h3 class="tp-breadcrumb__title white">Enrollment form </h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- faq breadcrumb end -->


        <!-- faq area start -->
        <section class="tp-faq-area tp-faq-p pt-50 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tp-instructor-become-tab">

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="tp-faq-wrap">

                                                <div class="tp-faq-sidebar">
                                                    <h3 class="tp-faq-sidebar-title"> <b>Course Information</b></h3>
                                                    <ul>
                                                        <?php
                                                        require_once 'connect.php';

                                                        // Fetch featured courses with their durations from the database
                                                        $featured_sql = "SELECT * FROM courses WHERE course_id = '$c_id'";
                                                        $featured_result = $conn->query($featured_sql);

                                                        // Check if any featured courses were found
                                                        if ($featured_result && $featured_result->num_rows > 0) {
                                                            $course = $featured_result->fetch_assoc();
                                                        } else {
                                                            echo '<li>No featured courses available.</li>';
                                                        }
                                                        $discounted_price = ($course['price'] * (1 - $course['discount_percentage'] / 100));
                                                        ?>
                                                    </ul>
                                                    <div class="tp-course-details-2-widget-list-item-wrapper">

                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <b> <?php echo htmlspecialchars($course['course_name']); ?></span> - $<?php echo htmlspecialchars(number_format($discounted_price)); ?></b>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8 15C11.866 15 15 11.866 15 8C15 4.13401 11.866 1 8 1C4.13401 1 1 4.13401 1 8C1 11.866 4.13401 15 8 15Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M8 3.80005V8.00005L10.8 9.40005" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Duration</span>
                                                            <span><?php echo htmlspecialchars($course['duration']); ?> Weeks</span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.5 13V5.5" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10 13V1" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M1 13V10" stroke="#4F5158" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Skill Level</span>
                                                            <span><?php echo htmlspecialchars($course['level']); ?></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M8 15.5C11.866 15.5 15 12.366 15 8.5C15 4.63401 11.866 1.5 8 1.5C4.13401 1.5 1 4.63401 1 8.5C1 12.366 4.13401 15.5 8 15.5Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M1 8.5H15" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M7.99727 1.5C9.74816 3.41685 10.7432 5.90442 10.7973 8.5C10.7432 11.0956 9.74816 13.5832 7.99727 15.5C6.24637 13.5832 5.25134 11.0956 5.19727 8.5C5.25134 5.90442 6.24637 3.41685 7.99727 1.5Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Language</span>
                                                            <span>English</span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Registration Deadline</span>
                                                            <span><?php echo htmlspecialchars($course['registration_deadline']); ?></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Start Date </span>
                                                            <span><?php echo htmlspecialchars($course['start_datetime']); ?></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Daily Start Time </span>
                                                            <span><?php echo htmlspecialchars($course['daily_start_time']); ?></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Timezone </span>
                                                            <span><?php echo htmlspecialchars($course['timezone']); ?></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.4" d="M1.06836 6.18286H13.5451" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 8.91675H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 8.91675H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 8.91675H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M10.4102 11.6375H10.4194" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M7.30273 11.6375H7.312" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M4.1875 11.6375H4.19676" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M10.1289 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path d="M4.47656 1V3.30355" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10.2668 2.10535H4.33967C2.28399 2.10535 1 3.2505 1 5.35547V11.6902C1 13.8283 2.28399 14.9999 4.33967 14.9999H10.2603C12.3225 14.9999 13.6 13.8481 13.6 11.7432V5.35547C13.6065 3.2505 12.329 2.10535 10.2668 2.10535Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Training Days</span>
                                                            <span><?php 
echo str_replace(',', '<br>', htmlspecialchars($course['training_days'])); 
?></span></span>
                                                        </div>
                                                        <div class="tp-course-details-2-widget-list-item d-flex align-items-center justify-content-between">
                                                            <span> <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M14.721 6.64274C14.721 7.8116 14.3744 8.88373 13.7779 9.77851C12.9073 11.0683 11.5289 11.9792 9.9247 12.2129C9.65063 12.2613 9.36849 12.2855 9.07829 12.2855C8.78809 12.2855 8.50596 12.2613 8.23188 12.2129C6.62773 11.9792 5.24929 11.0683 4.37869 9.77851C3.78217 8.88373 3.43555 7.8116 3.43555 6.64274C3.43555 3.52311 5.95866 1 9.07829 1C12.1979 1 14.721 3.52311 14.721 6.64274Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M16.5341 14.2766L15.2041 14.591C14.9058 14.6636 14.672 14.8893 14.6075 15.1875L14.3254 16.3725C14.1722 17.0174 13.35 17.2109 12.9228 16.703L9.07766 12.2856L5.23253 16.7111C4.80529 17.2189 3.98307 17.0255 3.82991 16.3806L3.54777 15.1956C3.47522 14.8973 3.24145 14.6636 2.95125 14.5991L1.62117 14.2847C1.00853 14.1396 0.790885 13.3738 1.23424 12.9304L4.37806 9.78662C5.24865 11.0764 6.6271 11.9873 8.23125 12.2211C8.50532 12.2694 8.78746 12.2936 9.07766 12.2936C9.36786 12.2936 9.64999 12.2694 9.92407 12.2211C11.5282 11.9873 12.9067 11.0764 13.7773 9.78662L16.9211 12.9304C17.3644 13.3657 17.1468 14.1315 16.5341 14.2766Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                    <path opacity="0.4" d="M9.54557 4.20822L10.0212 5.15942C10.0857 5.2884 10.2549 5.41738 10.4081 5.44156L11.2706 5.58665C11.8188 5.67533 11.9478 6.07838 11.5528 6.47338L10.8837 7.14243C10.7709 7.25529 10.7064 7.47295 10.7467 7.63417L10.9401 8.46446C11.0933 9.11741 10.7467 9.37535 10.1663 9.02872L9.36017 8.55312C9.21507 8.46445 8.97324 8.46445 8.82814 8.55312L8.02203 9.02872C7.44163 9.36728 7.09501 9.11741 7.24817 8.46446L7.44163 7.63417C7.47388 7.48101 7.41745 7.25529 7.3046 7.14243L6.63553 6.47338C6.24054 6.07838 6.36951 5.68339 6.91766 5.58665L7.7802 5.44156C7.9253 5.41738 8.09458 5.2884 8.15907 5.15942L8.63467 4.20822C8.86844 3.69231 9.28762 3.69231 9.54557 4.20822Z" stroke="#4F5158" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg> Certificate</span>
                                                            <span>Yes</span>
                                                        </div>
                                                    </div>



                                                    <div class="tp-faq-sidebar-btn">
                                                        <a class="tp-btn-inner w-100 text-center" href="https://wa.me/447904225546" target="_blank">Chat with an Advisor (WhatsApp Only)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">


                                            <!-- checkout area start -->
                                            <section class="tp-checkout-area data-bg-color=" #EFF1F5">



                                                <h3 class="tp-checkout-bill-title">Enrollment for '<color><?php echo ($_GET['course']); ?></color>'</h3>



                                                <form action="process-enrollment.php" method="POST">
                                                    <div class="tp-checkout-bill-inner">
                                                        <div class="row">

                                                            <!-- Personal Information -->
                                                            <h4>Personal Information</h4>
                                                            <div class="col-md-6">
                                                                <div class="tp-checkout-input">
                                                                    <label>First Name <span>*</span></label>
                                                                    <input type="text" name="firstName" placeholder="First Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="tp-checkout-input">
                                                                    <label>Last Name <span>*</span></label>
                                                                    <input type="text" name="lastName" placeholder="Last Name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Email Address <span>*</span></label>
                                                                    <input type="email" name="email" placeholder="example@example.com" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Phone Number <span>*</span></label>
                                                                    <input type="text" name="phoneNumber" placeholder="Phone Number" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Gender (Optional)</label>
                                                                    <select name="gender">
                                                                        <option>Select Gender</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                        <option value="Non-Binary">Non-Binary</option>
                                                                        <option value="Prefer not to say">Prefer not to say</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Address Information -->
                                                            <h4>Address Information</h4>
                                                            <div class="col-md-6">
                                                                <div class="tp-checkout-input">
                                                                    <label>City <span>*</span></label>
                                                                    <input type="text" name="city" placeholder="City" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="tp-checkout-input">
                                                                    <label>State/Province</label>
                                                                    <input name="stateProvince" type="text" placeholder="State/Province">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Country <span>*</span></label>
                                                                    <select id="countryDropdown" name="countryDropdown" required style="width: 100%">
                                                                        <option>Select Country</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Eswatini">Eswatini</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Greece">Greece</option>
<option value="Grenada">Grenada</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Honduras">Honduras</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea">Korea</option>
<option value="Kosovo">Kosovo</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia">Micronesia</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="North Macedonia">North Macedonia</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Qatar">Qatar</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="South Sudan">South Sudan</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Timor-Leste">Timor-Leste</option>
<option value="Togo">Togo</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States">United States</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City">Vatican City</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Initialize Select2 -->
                                                            <!-- Initialize Select2 -->
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#countryDropdown').select2({
                                                                        placeholder: 'Select Country',
                                                                        allowClear: true
                                                                    });
                                                                });
                                                            </script>


                                                            <!-- Educational Background -->
                                                            <h4>Educational Background</h4>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Highest Level of Education Completed <span>*</span></label>
                                                                    <select name="educationLevel" required>
                                                                        <option>Select Education Level</option>
                                                                        <option>High School</option>
                                                                        <option>Associate Degree</option>
                                                                        <option>Bachelor's Degree</option>
                                                                        <option>Master's Degree</option>
                                                                        <option>Doctorate</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Field of Study (If applicable)</label>
                                                                    <input name="fieldStudy" type="text" placeholder="Field of Study">
                                                                </div>
                                                            </div>

                                                            <!-- Employment Information -->
                                                            <h4>Employment Information</h4>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Current Job Title (Optional)</label>
                                                                    <input name="currentJobTitle" type="text" placeholder="Job Title">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Company Name (Optional)</label>
                                                                    <input name="employerName" type="text" placeholder="Company Name">
                                                                </div>
                                                            </div>

                                                            <!-- Additional Information -->
                                                            <h4>Additional Information</h4>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>Special Requirements (Dietary needs, accessibility requirements, etc.)</label>
                                                                    <textarea name="specialRequirements" placeholder="Enter any special requirements"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-input">
                                                                    <label>How Did You Hear About Us?</label>
                                                                    <select name="howDidYouHear">
                                                                        <option>Select Option</option>
                                                                       
<option value="social_media">Social Media</option>
<option value="friend_colleague">Friend or Colleague</option>
<option value="google_search">Google Search</option>
<option value="advertisement">Advertisement</option>
<option value="other">Other</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <!-- Consent and Agreement -->
                                                            <!-- <h4>Consent and Payment</h4> -->
                                                            <div class="tp-checkout-payment-item paypal-payment">
                                                                <input type="radio" id="paypal" name="payment" checked>
                                                                <label for="paypal">PayPal <img src="assets/img/shop/payment-option.png" alt=""> <a href="#">What is PayPal?</a></label>

                                                            </div>
                                                            <hr>
                                                            <style>
                                                                /* Style to make the button appear grayed out */
                                                                .tp-checkout-btn:disabled {
                                                                    background-color: #ccc;
                                                                    /* Light gray background */
                                                                    cursor: not-allowed;
                                                                    /* Change cursor to indicate it’s disabled */
                                                                    color: #666;
                                                                    /* Darker text color for better readability on gray */
                                                                }
                                                            </style>

                                                            <div class="tp-checkout-agree">
                                                                <div class="tp-checkout-option">
                                                                    <input id="read_all" type="checkbox" onclick="toggleSubmitButton()">
                                                                    <label for="read_all">I have read and agree to the <a href="terms.php">Terms and Conditions</a>.</label>
                                                                </div>
                                                            </div>

                                                            <!-- Submit Button -->
                                                            <div class="col-md-12">
                                                                <div class="tp-checkout-btn-wrapper">
                                                                    <button type="submit" class="tp-checkout-btn w-100" id="submitBtn" disabled>Pay Now</button>
                                                                </div>
                                                            </div>

                                                            <script>
                                                                function toggleSubmitButton() {
                                                                    const checkbox = document.getElementById('read_all');
                                                                    const submitBtn = document.getElementById('submitBtn');
                                                                    submitBtn.disabled = !checkbox.checked;
                                                                }
                                                            </script>

                                                        </div>
                                                    </div><input type="hidden" name="course_id" value="<?PHP echo $c_id; ?>">
                                                </form>



                                                <!-- checkout place order -->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </section>
        <!-- instructor area end -->


    </main>

    <!-- footer-area-start -->
    <footer>
        <div class="tp-footer-main tp-footer-inner pt-80 pb-55">
            <?php
            require_once 'footer.php';
            ?>
        </div>
    </footer>
    <!-- footer-area-end -->

    <!-- JS here -->

    <!-- <script src="assets/js/vendor/jquery.js"></script> -->
    <script src="assets/js/vendor/waypoints.js"></script>
    <script src="assets/js/bootstrap-bundle.js"></script>
    <script src="assets/js/swiper-bundle.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/range-slider.js"></script>
    <script src="assets/js/magnific-popup.js"></script>
    <!-- <script src="assets/js/nice-select.js"></script> -->
    <script src="assets/js/purecounter.js"></script>
    <script src="assets/js/countdown.js"></script>
    <script src="assets/js/wow.js"></script>
    <script src="assets/js/isotope-pkgd.js"></script>
    <script src="assets/js/imagesloaded-pkgd.js"></script>
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/js/ajax-form.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- Include jQuery and jQuery Validation Plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>


</body>

</html>