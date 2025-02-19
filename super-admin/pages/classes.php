<?php

include('../includes/db_connection.php');
include('check_access.php');  


$adminId = $user_id; 

?>


    <style>
        /* .content-wrapper .container{
            min-width: 20vw;
            height: 85vh;
            background: #f5f5f5;
        } */
        /* .top-title{
            text-align: center;
            margin-bottom: 20px;
        } */
        #student-img{
            width: 30px;
            height: 30;
            border-radius: 50%;
        }
        h3{
             padding: 20px;
        }
    </style>

<div class="container animate__animated animate__fadeInUp animate__delay-0.5s">
    <div class="bg-white mb-4  rounded-3 ">
            <div class="container p-4 shadow rounded">
                <div class="top-title">
                    <h3>Current Teaching classes</h3><hr>
                </div>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Class Name</th>
                                <th>Grade Level</th>
                                <th>Room</th>
                                <th>Enrolled Students</th>
                                <th>Student Type</th>
                                <th>Time</th>
                                <th>Teacher</th>
                                <th>Fee</th>
                                <th>Subject</th>
                                <th>Teacher Photo</th>
                                <th>Start Date</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <tr>
                                <td>#</td>
                                <td>Class Name</td>
                                <td>Grade Level</td>
                                <td>Room</td>
                                <td>Enrolled Students</td>
                                <td>Student Type</td>
                                <td>Time</td>
                                <td>Teacher</td>
                                <td>Fee</td>
                                <td>Subject</td>
                                <td>Teacher Photo</td>
                                <td>Start Date</td>
                            </tr>
                        <?php
    $query = "
        SELECT 
            classes.*, 
            teachers.teacherName, 
            teachers.photo, 
            GROUP_CONCAT(subjects.subject_name ORDER BY subjects.subject_name) AS subjects_taught 
        FROM 
            classes
        INNER JOIN teachers 
            ON classes.teacher_id = teachers.id
        INNER JOIN staff 
            ON teachers.id = staff.id
        INNER JOIN subjects_teachers 
            ON teachers.id = subjects_teachers.teacher_id
        INNER JOIN subjects 
            ON subjects_teachers.subject_id = subjects.id
        WHERE 
            staff.superadmin_id = $adminId
        GROUP BY 
            classes.id, teachers.id";
    
    
    $fetch = mysqli_query($conn, $query);
    
    if (!$fetch) {
        die('Query failed: ' . mysqli_error($conn));
    }
    
    if (mysqli_num_rows($fetch) > 0) {
        while ($row = mysqli_fetch_assoc($fetch)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['class_name']; ?></td>
                <td><?php echo $row['grade_level']; ?></td>
                <td><?php echo $row['room_num']; ?></td>
                <td><?php echo $row['enrolled_students']; ?></td>
                <td><?php echo $row['timing']; ?></td>
                <td><?php echo $row['teacherName']; ?></td>
                <td><?php echo $row['subjects_taught']; ?></td>
                <td>
                    <?php if (!empty($row['photo'])): ?>
                        <img id="teacher-img" src="path_to_images/<?php echo $row['photo']; ?>" alt="Teacher Image">
                    <?php else: ?>
                        <img id="teacher-img" src="path_to_default_image/default.jpg" alt="Default Image">
                    <?php endif; ?>
                </td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='10'>No results found!</td></tr>";
    }
    ?>
    
    
                           
                        </tbody>
                    </table>
    
                </div>
                
            </div>
        </div>

</div>
