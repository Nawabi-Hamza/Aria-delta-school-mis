<?php

// include('check_access.php');
// include('../includes/db_connection.php');
// $user_id = $_SESSION['user_id'];

// if(isset($_POST['btn-insert'])){

//     $subject = $_POST['subjectName'];
//     $pages = $_POST['pages'];
//     $unites = $_POST['unites'];
//     $class_id = $_POST['class_id'];
//     $teacher_id = $_POST['teacher_id'];

//     $insertSubject = $conn->query("INSERT INTO subjects(subject_name, page_info, unites, class_id, teacher_id, staff_id) VALUES('$subject', '$pages', '$unites', '$class_id', '$teacher_id', '$user_id')");
//     if($insertSubject){
//         header("Location: subjects.php");
//     }else{
//         die('Error In Your Query: '. $conn->connect_error);
//     }
// $conn.close();
// }

// if(isset($_POST['btn-update'])){


// }

?>


    <div class="container-fluid mt-4">
        <div class="">
            <div class="d-flex justify-content-between">
                <h1 class="dashboard-title">My Subjects</h1>
                <a id="btn-insert" class="btn btn-outline-info d-flex align-items-center gap-2" data-toggle="modal" data-target="#subject-modal"><i class="bi bi-plus-circle"></i> <span>Add New Subject</span></a>
            </div>
            <!-- Modal -->
            <div class="modal bg-none fade" id="subject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="subjects.php" method="POST" id="subjectForm">
                            <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="exampleModalLabel"><b>Please Enter Subject's Complete Details</b></h5>
                                <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subjectName"><b>Subject</b></label>
                                            <input type="text" class="form-control" name="subjectName" placeholder="subject's name...">
                                            <div class="error-message" id="subjectNameError">Subject name is required.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pages"><b>Pages Amount</b></label>
                                            <input type="number" class="form-control" name="pages" placeholder="pages...">
                                            <div class="error-message" id="pagesError">Pages amount is required.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="unites"><b>Unites</b></label>
                                            <input type="number" class="form-control" name="unites" placeholder="unites...">
                                            <div class="error-message" id="unitesError">Unites amount is required.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="class"><b>Class</b></label>
                                            <select name="class_id" class="form-control">
                                                <option value="">please select class...</option>
                                                <?php
                                                // Example of fetching classes from the database
                                                // if($selectClass->num_rows > 0){
                                                //     while($row = $selectClass->fetch_assoc()){
                                                //         echo "<option value='" . $row['id'] . "'>" . $row['class_name'] . "</option>";
                                                //     }
                                                // }else{
                                                //     echo "<option value=''>No options available</option>";
                                                // }
                                                ?>
                                            </select>
                                            <div class="error-message" id="classError">Class selection is required.</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="teacher"><b>Teacher</b></label>
                                        <select name="teacher_id" class="form-control">
                                            <option value="">please select teacher...</option>
                                            <?php
                                            // Example of fetching teachers from the database
                                            // if($selectTeacher->num_rows > 0){
                                            //     while($row = $selectTeacher->fetch_assoc()){
                                            //         echo "<option value='" . $row['id'] . "'>" . $row['teacherName'] . "</option>";
                                            //     }
                                            // }else{
                                            //     echo "<option value=''>No options available</option>";
                                            // }
                                            ?>
                                        </select>
                                        <div class="error-message" id="teacherError">Teacher selection is required.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="bi bi-times"></i> Close</button>
                                <button type="submit" class="btn btn-outline-info" value="btn-insert"><i class="bi bi-save"></i> Save</button>
                            </div>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById('subjectForm').addEventListener('submit', function(event) {
                                    let isValid = true;
                                    let firstEmptyField = null;

                                    const requiredFields = [{
                                            id: 'subjectName',
                                            errorId: 'subjectNameError'
                                        },
                                        {
                                            id: 'pages',
                                            errorId: 'pagesError'
                                        },
                                        {
                                            id: 'unites',
                                            errorId: 'unitesError'
                                        },
                                        {
                                            id: 'class_id',
                                            errorId: 'classError'
                                        },
                                        {
                                            id: 'teacher_id',
                                            errorId: 'teacherError'
                                        }
                                    ];

                                    requiredFields.forEach(field => {
                                        const input = document.getElementsByName(field.id)[0];
                                        const error = document.getElementById(field.errorId);

                                        // Hide error message on input focus
                                        input.addEventListener('focus', function() {
                                            if (error.style.visibility === 'visible') {
                                                error.style.visibility = 'hidden';
                                                input.classList.remove('error');
                                            }
                                        });

                                        // Check if the field is empty or has the default value for selects
                                        if (!input.value || (input.tagName === 'SELECT' && input.value === "")) {
                                            error.style.visibility = 'visible';
                                            input.classList.add('error');
                                            isValid = false;

                                            if (!firstEmptyField) {
                                                firstEmptyField = input;
                                            }
                                        } else {
                                            error.style.visibility = 'hidden';
                                            input.classList.remove('error');
                                        }

                                        // Clear error on input change
                                        input.addEventListener('input', function() {
                                            if (error.style.visibility === 'visible') {
                                                error.style.visibility = 'hidden';
                                                input.classList.remove('error');
                                            }
                                        });
                                    });

                                    if (!isValid) {
                                        event.preventDefault();
                                        if (firstEmptyField) {
                                            firstEmptyField.focus();
                                        }
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <table class="table table-hover table-info border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Pages</th>
                            <th scope="col">Unites</th>
                            <th scope="col">Class</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <tr>
                            <td scope="col">#</td>
                            <td scope="col">Subject</td>
                            <td scope="col">Pages</td>
                            <td scope="col">Unites</td>
                            <td scope="col">Class</td>
                            <td scope="col">Teacher</td>
                            <td scope="col">Action</td>
                        </tr>
                        <?php
                        // $fetchSubjects = $conn->query("SELECT * FROM subjects 
                        //     INNER JOIN teachers ON subjects.teacher_id = teachers.id
                        //     INNER JOIN classes ON subjects.class_id = classes.id WHERE subjects.staff_id = $user_id");
    
                        // while ($row = $fetchSubjects->fetch_assoc()) {
                        ?>
                            <!-- <tr>
                                <th scope="row"><?php echo $row['id']; ?></th>
                                <td><?php echo $row['subject_name']; ?></td>
                                <td><?php echo $row['page_info']; ?></td>
                                <td><?php echo $row['unites']; ?></td>
                                <td><?php echo $row['class_name']; ?></td>
                                <td><?php echo $row['teacherName']; ?></td> -->
                                <!-- <td>
                                    <a data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pencil"></i></a>
    
                                    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="" method="POST">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Please Enter Subject's Complete Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                                        <button type="submit" class="btn btn-outline-success" value="btn-update"><i class="fa fa-refresh"></i> Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td> -->
                            </tr>
                        <?php
                            // $i++;
                        // }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  
    <!-- jQuery and Bootstrap JS -->
     
    <!-- script for bootstrap modal -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // Function to load page content into the main content area
        function loadPageContent(pageUrl) {
            $.ajax({
                url: pageUrl,
                type: 'GET',
                success: function(response) {
                    $('#main-content').html(response);
                },
                error: function() {
                    $('#main-content').html('<p>Error loading page.</p>');
                }
            });
        }

        // Sidebar click event listener
        $(document).ready(function() {
            $('#sidebar a').on('click', function(e) {
                e.preventDefault(); // Prevent default action (navigation)

                var pageUrl = $(this).attr('href'); // Get the link's href (the page URL)
                loadPageContent(pageUrl); // Load the content dynamically
            });
        });
    </script>

