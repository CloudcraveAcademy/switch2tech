<div class="accordion-item">
                                   <h2 class="accordion-header">
                                     <button class="accordion-button collapsed tpd-new-course-heading-title " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                       Course Curriculum Builder
                                     </button>
                                   </h2>
                                   <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                     <div class="accordion-body">
                                       <div class="tpd-new-course-modal-btn">

                                          <!-- modal-announcement-btn -->
                                          <div class="curriculum-intro">
    <h3>Curriculum Builder</h3>
    <p>
        Craft an engaging and structured learning experience for your students by adding a detailed course curriculum. 
        Use this tool to create sections and lessons that guide students through the course content step by step.
    </p>
    <h4>📌 How to Get Started:</h4>
    <ol>
        <li>Click on the <strong>"Add Curriculum"</strong> button to create a new section.</li>
        <li>Provide a title and description for the section to outline its purpose.</li>
        <li>Add lessons under each section to break down the learning material into manageable chunks.</li>
    </ol>
    <p><strong>💡 Tip:</strong> A clear and organized curriculum helps students stay on track and boosts their learning experience.</p>
</div>

                                          <Add type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@fat"><span><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                             <path d="M10.5 20C16.0228 20 20.5 15.5228 20.5 10C20.5 4.47715 16.0228 0 10.5 0C4.97715 0 0.5 4.47715 0.5 10C0.5 15.5228 4.97715 20 10.5 20Z" fill="white" />
                                             <path d="M10.5 6V14" stroke="#556DF5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                             <path d="M6.5 10H14.5" stroke="#556DF5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                             </svg></span> Add Curriculum </Add Curricubutton>
                                          <!-- modal-Curriculum-btn-end -->

                                          <!-- modal-Curriculum-start -->

                                          <!-- Modal -->
<div class="modal fade tpd-modal-announcement" id="exampleModal2" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="tpd-modal-title" id="exampleModalLabel">Add Curriculum</h4>
            <button type="button" class="tpd-modal-btn-close" data-bs-dismiss="modal" aria-label="Close">
               <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                     <path d="M13 1L1 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     <path d="M1 1L13 13" stroke="#757C8E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
               </span>
            </button>
         </div>
         <div class="modal-body">
            <form id="add-curriculum-form">
               <div class="tpd-input-white mb-20">
                  <label>Curriculum Title</label>
                  <input type="text" id="curriculum-title" placeholder="Enter Curriculum Title" required>
               </div>
               <div class="tpd-input-white">
                  <label for="curriculum-description" class="col-form-label">Details</label>
                  <textarea id="curriculum-description" placeholder="Details..." required></textarea>
               </div>
               <button type="submit" class="tpd-btn-edit ml-10">Add Curriculum</button>
            </form>
            <div class="tpd-input mt-4">
               <h5>Curriculum List</h5>
               <ul id="curriculum-list"></ul>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="tpd-btn-cancel" data-bs-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

                                       
                                           <!-- Modal Structure -->

                                          

                                       </div>
                                     
                                     </div>
                                   </div>
 </div>
 <script>
        $(document).ready(function () {
   const courseId = 1; // Replace with dynamic course ID if needed

   // Fetch and display curriculum list
   function fetchCurriculums() {
      $.ajax({
         url: 'fetch_curriculum.php',
         method: 'GET',
         data: { course_id: courseId },
         success: function (response) {
            $('#curriculum-list').html(response);
         },
         error: function () {
            alert('Error fetching curriculum list.');
         }
      });
   }

   $('#add-curriculum-form').on('submit', function (e) {
   e.preventDefault(); // Prevent form submission and page reload
   const title = $('#curriculum-title').val();
   const description = $('#curriculum-description').val();

   if (title.trim() === '' || description.trim() === '') {
      alert('Both fields are required.');
      return;
   }

   $.ajax({
      url: 'add_curriculum.php',
      method: 'POST',
      data: { 
         course_id: courseId, 
         title: title, 
         description: description 
      },
      success: function (response) {
         if (response === 'success') {
            fetchCurriculums(); // Refresh the curriculum list
            $('#curriculum-title').val('');
            $('#curriculum-description').val('');
            alert('Curriculum added successfully.');
         } else {
            alert('Error adding curriculum.');
         }
      },
      error: function () {
         alert('An error occurred while adding the curriculum.');
      }
   });
});

   // Delete curriculum
   $(document).on('click', '.delete-curriculum', function () {
      const curriculumId = $(this).data('id');
      if (confirm('Are you sure you want to delete this curriculum?')) {
         $.ajax({
            url: 'delete_curriculum.php',
            method: 'POST',
            data: { curriculum_id: curriculumId },
            success: function (response) {
               if (response === 'success') {
                  fetchCurriculums();
                  alert('Curriculum deleted successfully.');
               } else {
                  alert('Error deleting curriculum.');
               }
            },
            error: function () {
               alert('Error deleting curriculum.');
            }
         });
      }
   });

   // Edit curriculum
   $(document).on('click', '.edit-curriculum', function () {
      const curriculumId = $(this).data('id');
      const title = $(this).data('title');
      const description = $(this).data('description');

      const newTitle = prompt('Edit Title:', title);
      const newDescription = prompt('Edit Description:', description);

      if (newTitle !== null && newDescription !== null) {
         $.ajax({
            url: 'edit_curriculum.php',
            method: 'POST',
            data: { curriculum_id: curriculumId, title: newTitle, description: newDescription },
            success: function (response) {
               if (response === 'success') {
                  fetchCurriculums();
                  alert('Curriculum updated successfully.');
               } else {
                  alert('Error updating curriculum.');
               }
            },
            error: function () {
               alert('Error updating curriculum.');
            }
         });
      }
   });

   // Initial fetch of curriculums
   fetchCurriculums();
});

       </script>