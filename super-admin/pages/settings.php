<?php
// Start the session to access session variables


// Include the check_access.php file to validate session or access
include('check_access.php');

// Include the database connection file
include('../includes/db_connection.php');

$id = $user_id;
// Handle the form submission for roles
if (isset($_POST['btn-roles'])) {
    $changedRole = $_POST['role'];

    foreach ($changedRole as $newRole) {
        // Use parameterized queries to avoid SQL injection
        $updateRole = $conn->prepare("UPDATE pages SET role = ? WHERE id = ?");
        $updateRole->bind_param('si', $newRole, $id); // 'si' means string for role and integer for id
        $updateRole->execute();
    }

    if ($updateRole) {
        // Redirect to the current page if the update is successful
        header('Location: ./');
    } else {
        // Error handling
        die('Error in the query: ' . $conn->error);
    }

    $conn->close();
}

// Handle the privileges update
if (isset($_POST['update-privileges'])) {
    // Your privileges update code here
}
?>


    <style>
        /* html, body {
            background-color: #f5f5f5;
        } */
        
        #teacher-img{
            width: 30px;
            height: 30;
            border-radius: 50%;
        }

        
        #end-line{
            border-top: 2px solid black;
            margin: 7% 0;
            width: 100%;
        }
      
        #top-row{
            border: 1px solid black;
            height: 25vh;
        }

        .modal-dialog {
            margin: auto; 
        }

        .modal-header {
            border-bottom: 2px solid black;
        }

        .close {
            padding: 0.5rem 1rem; 
            background: transparent; 
            border: none; 
            transition: color 0.3s;
            font-size: 2rem;
        }

        .close:hover {
            color: #dc3545;
        }

        .modal-footer {
            border-top: 2px solid black;
        }

        @media(max-width: 767px) {
            .content-wrapper .container .main-content-one, 
            .content-wrapper .container .main-content-two {
                width: 100%;
                margin: 0%;
            }

            h3 {
                font-size: medium;
            }

            th, td {
                font-size: smaller;
            }
        }
    </style>

<title>Super Admin | Settings</title>


<div class="bg-white mb-4 rounded rounded-3 shadow animate__animated animate__fadeInUp animate__delay-0.5s">
        <div class="container p-4">
            <div class="below">
                <div class="top-title">
                    <h3> Current assigned Roles for Staff</h3>
                    <div class="main-content-one">
                        <table class="table table-primary table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Current Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-light">
                                <tr>
                                    <td>#</td>
                                    <td>FirstName</td>
                                    <td>LastName</td>
                                    <td>Current Role</td>
                                    <td>Action</td>
                                </tr>
                                <?php 
                                    $fetchUser = "SELECT id, username, last_name, `role` from staff"; 
                                    $fetch = mysqli_query($conn, $fetchUser);
                                    while ($row = mysqli_fetch_assoc($fetch)) {
                                        ?>
                                 <tr>
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $row['username'];?></td>
                                    <td><?php echo $row['last_name'];?></td>
                                    <td title="change role"><span class="label label-primary"><?php echo $row['role']; ?></span></td>
                                    <td>
                                        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#update-Role-Modal<?php echo $row['id'];?>"><i class="fa fa-pencil"></i></a>
                                       
                                        <div class="modal fade" id="update-Role-Modal<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="" method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Please Change Role for Selected Staff Member</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            taken ID:     <input type="text" name="id" value="<?php echo htmlspecialchars($id); ?>">>
                                                            <div class="row" id="top-row">
                                                                <div class="col-md-6">

                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Admin">
                                                                            <label class="form-check-label" for="chk-test"> Admin</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="CRM">
                                                                            <label class="form-check-label" for="chk-test"> CMR</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Finance">
                                                                            <label class="form-check-label" for="chk-test"> Finance</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Operational Manager">
                                                                            <label class="form-check-label" for="chk-test"> Operational Manager</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Head Teacher">
                                                                            <label class="form-check-label" for="Header Teacher"> Head Teacher</label>
                                                                    </div>
                                                            
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Teacher">
                                                                            <label class="form-check-label" for="chk-test"> Teacher</label>
                                                                    </div>
                                                                    
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test" value="Librarian">
                                                                            <label class="form-check-label" for="chk-test"> Librarian</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test">
                                                                            <label class="form-check-label" for="chk-test"> chk-Test</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" name="role[]" type="checkbox" id="chk-test">
                                                                            <label class="form-check-label" for="chk-test"> chk-Test</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i> Close</button>
                                                            <button type="submit" name="btn-roles" class="btn btn-primary"><i class="fa fa-refresh"></i> Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr> 
                                <?php
                                }
                             ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br><hr id="end-line">

            <div class="top-title">
                <h3 class="py-5"> Current assigned Roles for Staff</h3>
                <div class="main-content-one">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Current Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // $fetchUser = "SELECT id, username, last_name, `role` from staff"; 
                            //$fetch = mysqli_query($conn, $fetchUser);
                            //while ($row = mysqli_fetch_assoc($fetch)) {?>
                            <tr>
                                <td><?php //echo $row['id'];?></td>
                                <td><?php //echo $row['username'];?></td>
                                <td><?php //echo $row['last_name'];?></td>
                                <td title="change role"><span class="label label-primary"><?php //echo $row['role']; ?></span></td>
                                
                                Test Data! delete after confirmation
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td>Test</td>
                                    <td title="change role"><span class="label label-primary">Test</span></td>
                                <td>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateRoleModal<?php echo $row['id'];?>"><i class="fa fa-pencil"></i></button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="updateRoleModal<?php //echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Please Change Role for Selected Staff Member</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        &times;
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        <i class="fa fa-times-circle"></i> Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">
                                                        <i class="fa fa-refresh"></i> Save changes
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?PHP // } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="end-line"></div>

    <div class="container">
        <div class="top-title">
            <div class="container">
            <h3 class="pb-5">Select Any Staff to Assign Privileges and Access Pages</h3>
<div class="main-content-two">
    <div class="role-list">
    <h5>Select Role to Assign Pages</h5>
<?php
// Define roles and pages with their URLs
$roles_pages = [
    'CRM' => [
        'Customer Management' => ['School/crm/add_customer.php', 'School/crm/manage_customer.php']
    ],
    'HR' => [
        'Employee Management' => ['School/hr/manage_employees.php', 'School/hr/employee_details.php']
    ],
    'Admin' => [
        'Admin Dashboard' => ['School/admin/dashboard.php', 'School/admin/settings.php']
    ]
];

// Display roles
foreach ($roles_pages as $role => $pages) {
    echo "<button class='btn btn-primary role-button' data-role='{$role}'>{$role}</button>";
}
?>

<div class="pages-list" style="display:none;">
    <h5>Assign Pages to Role: <span id="role-name"></span></h5>
    <form action="assign_privileges.php" method="POST">
        <input type="hidden" name="role" id="role-input">
        <div id="pages-checkboxes">
            <!-- Pages will be dynamically loaded here based on selected role -->
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Selected Pages</button>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // When a role button is clicked
        $('.role-button').click(function() {
            var role = $(this).data('role'); // Get role name
            $('#role-name').text(role); // Display selected role name
            $('#role-input').val(role); // Set the role input field value

            // Define the pages for each role with associated URLs
            var rolePages = {
                'CRM': {
                    'Customer Management': ['School/crm/add_customer.php', 'School/crm/manage_customer.php']
                },
                'HR': {
                    'Employee Management': ['School/hr/manage_employees.php', 'School/hr/employee_details.php']
                },
                'Admin': {
                    'Admin Dashboard': ['School/admin/dashboard.php', 'School/admin/settings.php']
                }
            };

            // Generate checkboxes for the selected role
            var pagesHtml = '';
            $.each(rolePages[role], function(pageName, urls) {
                pagesHtml += '<div><input type="checkbox" name="pages[]" value="' + pageName + '"> ' + pageName + '</div>';
            });

            $('#pages-checkboxes').html(pagesHtml); // Add checkboxes to the page
            $('.pages-list').show(); // Show pages section
        });
    });
</script>


<br><br><br><br>