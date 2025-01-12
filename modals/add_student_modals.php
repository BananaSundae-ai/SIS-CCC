<!-- add_student_modal.php -->

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
  Add Student
</button>



<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
    <!-- Upload CSV Button -->

    <div class="modal-dialog">
        <form action="../includes/add_student.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Name</label>
                        <input type="text" name="name" id="studentName" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentYear" class="form-label">Year</label>
                        <input type="text" name="year" id="studentYear" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentCourse" class="form-label">Course</label>
                        <input type="text" name="course" id="studentCourse" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentEmail" class="form-label">Email</label>
                        <input type="email" name="email" id="studentEmail" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
     
                    <button type="submit" class="btn btn-primary">Add Student</button>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadCSVModal">
  Upload CSV
</button>
                </div>
            </div>
        </form>
    </div>
</div>
