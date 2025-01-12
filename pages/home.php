<?php
include('../header.php');
include('../includes/db_connection.php');
?>

<!-- Student Table -->
<div class="table-container">
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Year</th>
                <th>Course</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentTable">
            <?php
$query = "
SELECT 
    s.student_id, 
    s.first_name, 
    s.last_name, 
    s.email, 
    COALESCE(e.enrollment_year, 'Not Enrolled') as enrollment_year, 
    COALESCE(c.course_name, 'No Course') as course_name, 
    s.student_id as id
FROM students s
LEFT JOIN enrollments e ON e.student_id = s.student_id
LEFT JOIN courses c ON c.course_id = e.course_id
ORDER BY s.student_id DESC";

            $result = $conn->query($query);

            // Checking if there are any results
            if ($result->num_rows > 0) {
                // Loop through each row and display the data
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['student_id']}</td>
                        <td>{$row['first_name']} {$row['last_name']}</td>
                        <td>{$row['enrollment_year']}</td>  <!-- Fixed year column -->
                        <td>{$row['course_name']}</td>      <!-- Corrected column for course -->
                        <td>{$row['email']}</td>            <!-- Display email correctly -->

                        <td>
                            <!-- Corrected href links for Edit and Delete actions -->
                            <a href='update_student.php?id={$row['id']}' class='btn btn-info btn-sm'>Edit</a>
                            <a href='delete_student.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>No students found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Include Add Student Modal -->
<?php include('../modals/add_student_modals.php'); ?>

</body>
</html>
