<?php
session_start();
include('../includes/db_connection.php');
 

?>


<div class="bg-white animate__animated animate__fadeInUp animate__delay-0.5s mb-4 rounded rounded-3 shadow">
        <div class="container p-4">
            <div class="top-title">
                <h3>Current Enrolled Students</h3><hr>
            </div>
            <div class="table-responsive">
                <table class="table border table-primary">
                    <thead>
                        <tr>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Father</th>
                            <th>Gender</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Age</th>
                            <th>Current Class</th>
                            <th>Asas Number</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        
                    </thead>
                    <tbody class="table-light">
                        <tr>
                            <th>FirstName</th>
                            <th>LastName</th>
                            <th>Father</th>
                            <th>Gender</th>
                            <th>Grade</th>
                            <th>Status</th>
                            <th>Age</th>
                            <th>Current Class</th>
                            <th>Asas Number</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        
                        <?php
                         $query = "SELECT *, class_name FROM students INNER JOIN classes ON students.class_id  = classes.id ";
                        $fetchStudents = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($fetchStudents)) {
                            ?>
                        <tr>
                            <td>
                                <td><?php  echo $row['name'];?></td>
                                <td><?php  echo $row['lastname'];?></td>
                                <td><?php  echo $row['father_name'];?></td>
                                <td><?php  echo $row['gender'];?></td>
                                <td>class name</td>
                                <td><?php  echo $row['status'];?></td>
                                <td><?php  echo $row['age'];?></td>
                                <td><?php  echo $row['class_name'];?></td>
                                <td><?php  echo $row['asas_num'];?></td>
                                <td><img id="student-img" src=""  alt="staff img"></td>
                                <td>
                                    
                                    <a href=""><i class="fa fa-eye"></i></a> 

                                    <a href=""><i class="fa fa-pencil"></i></a>
                                </td>
                            </td>
                        </tr>
                        <?php
                         }
                        ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
