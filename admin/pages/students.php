<?php 
// include('check_access.php');
// include('../includes/db_connection.php');



// $user_id = $_SESSION['user_id'];

if(isset($_POST['input'])){
    $output = $_POST['input'];
    $searchQuery = "SELECT * FROM students WHERE name LIKE '%$output%' OR lastname LIKE '%$output%' OR father_name LIKE '%$output%' OR asas_num LIKE '%$output%' OR tazkira_num LIKE '%$output%'";
    $result = $conn->query($searchQuery);
    if($result->num_rows > 0){?>

            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">FirstName</th>
                    <th scope="col">LastName</th>
                    <th scope="col">Father Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Asas #</th>
                    <th scope="col">Tazkira #</th>
                    <th scope="col">Class</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_assoc()) { 
                    ?>
                    <tr>
                    <th scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['father_name']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['asas_num']; ?></td>
                    <td><?php echo $row['tazkira_num']; ?></td>
                    <td><?php echo $row['class_name']; ?></td>
                    <td>
                        <a href=""><i class="fa fa-eye"></i></a>
                    </td>
                    
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
<?php 
    }else{
        echo "<p class='text-danger text-center mt-3'>No Data Found</p>";
    }

}


?>

<style>
    body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }

        .container-wrapper{
            height: 100vh;
            width: 70vw;
            position: relative;
            top: 2rem;
            left: 20rem;
        }

        .search-bar{
            position: relative;
            /* left: 5rem; */
            box-shadow: 0 0 40px rgba(51, 51, 51, .1);
            margin-bottom: 2rem;
       }

       .search-bar input{
            height: 60px;
            text-indent: 25px;
            border: 2px solid #d6d4d4;
       }
       .search-bar input:focus{
            box-shadow: none;
            border: 2px solid blue;
       }

        .search-bar button{
            position: absolute;
            top: 5px;
            right: 5px;
            height: 50px;
            width: 110px;
        }

</style>


<div class="container-fluid mt-4">
    <h1 class="h3">Current Students</h1>
    <div class="container">
            <div class="d-flex gap-1 ">
                <input type="text" class="form-control" id="searchTextbox" placeholder="Search Any Student ...">
                <div class="input-group-append"><button class="btn btn-outline-info"><i class="bi bi-search"></i></button></div>
            </div>
        <div class="input-group mb-5">
		</div>
        <div class="fetched-data">
            <div class="fetch-search-data"></div>
            <div class="d-flex justify-content-end">
                <a href="add_student.php" class="btn btn-outline-info end"><i class="bi bi-plus-circle"></i> Add New Student</a>
            </div>
            <div class="table-responsive">
                <table class="table table-info border table-hover">
                    <thead class="table-info">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">Father Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Asas #</th>
                        <th scope="col">Tazkira #</th>
                        <th scope="col">Class</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">FirstName</td>
                        <td scope="col">LastName</td>
                        <td scope="col">Father Name</td>
                        <td scope="col">Gender</td>
                        <td scope="col">Asas #</td>
                        <td scope="col">Tazkira #</td>
                        <td scope="col">Class</td>
                        <td scope="col">Action</td>
                    </tr>
                    <tr>
                        <td scope="col">#</td>
                        <td scope="col">FirstName</td>
                        <td scope="col">LastName</td>
                        <td scope="col">Father Name</td>
                        <td scope="col">Gender</td>
                        <td scope="col">Asas #</td>
                        <td scope="col">Tazkira #</td>
                        <td scope="col">Class</td>
                        <td scope="col">Action</td>
                    </tr>
                        <?php 
                        $select = "SELECT * FROM students INNER JOIN classes ON students.class_id = classes.id";
                        $query = mysqli_query($conn, $select);
                        while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['lastname']; ?></td>
                            <td><?php echo $row['father_name']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['asas_num']; ?></td>
                            <td><?php echo $row['tazkira_num']; ?></td>
                            <td><?php echo $row['class_name']; ?></td>
                            <td>
                                <button class="btn btn-outline-success"><i class="fa fa-eye" data-toggle="modal" data-target="#view-student-modal<?php echo $row['id']; ?>"></i></button>
    
                                <div class="modal fade" id="view-student-modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title ID taken: <?php echo $row['id'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                            <button type="button" class="btn btn-outline-primary"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
    
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#edit-student-modal<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></button>
    
                                <div class="modal fade" id="edit-student-modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Student Record</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                            <button type="button" class="btn btn-outline-primary"><i class="fa fa-print"></i> Print</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
    
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#searchTextbox').keyup(function(){
            let output = $(this).val();
            if(output !=""){
                $.ajax({
                    url: "students.php",
                    method: "POST",
                    data: {input: input},
                    success: function(response){
                        $('#fetch-search-data').html(response);
                    }
                });
            }else{
                $("#fetch-search-data").css("display", "none");
            }
        });

    });
</script>



