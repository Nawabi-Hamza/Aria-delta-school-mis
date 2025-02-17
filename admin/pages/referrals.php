<?php

// include('../includes/db_connection.php');

// Query to fetch customer data along with the staff name (JOIN query)
// $sql = "SELECT c.id, c.name, c.purpose, c.gender, c.mobile, c.create_At, c.staff_id, s.username 
//         FROM customers c
//         LEFT JOIN staff s ON c.staff_id = s.id";
// $result = $conn->query($sql);

// Fetch the results
// $customers = [];
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         $customers[] = $row;
//     }
// } else {
//     $customers = [];
// }

// $conn->close();
?>


<script type="text/javascript">
    // Function to refresh the page every 30 seconds
    setTimeout(function(){
        location.reload();
    }, 30000); // 30000ms = 30 seconds

    // Function to filter the table based on the search query
    function searchReferral() {
        var input = document.getElementById("searchInput");
        var filter = input.value.toLowerCase();
        var table = document.getElementById("referralTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var tdName = tr[i].getElementsByTagName("td")[1];
            var tdPurpose = tr[i].getElementsByTagName("td")[2];
            var tdStaff = tr[i].getElementsByTagName("td")[3];

            if (tdName || tdPurpose || tdStaff) {
                var nameText = tdName.textContent || tdName.innerText;
                var purposeText = tdPurpose.textContent || tdPurpose.innerText;
                var staffText = tdStaff.textContent || tdStaff.innerText;

                if (nameText.toLowerCase().indexOf(filter) > -1 || 
                    purposeText.toLowerCase().indexOf(filter) > -1 || 
                    staffText.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>



<div class="container mt-4 border border-1 p-4 bg-white rounded">
    <h1 class="text-info">Referral Information</h1>
    <p>Here are the latest referrals:</p>
    
    <!-- Search Box -->
    <div class="search-box">
        <input type="text" class="form-control my-3 w-50" id="searchInput" onkeyup="searchReferral()" placeholder="Search by name, purpose, or staff..." />
    </div>
    <div class="table-responsive">
        <!-- Table -->
        <table class=" table table-info">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Purpose</th>
                    <th>Referred by Staff</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php // if (count($customers) > 0): ?>
                    <?php // foreach ($customers as $customer): ?>
                        <tr>
                            <!-- <td><?php echo $customer['id']; ?></td>
                            <td><?php echo $customer['name']; ?></td>
                            <td><?php echo $customer['purpose']; ?></td>
                            <td><?php echo $customer['username']; ?></td>
                            <td>
                                <a href="add_student.php?id=<?php echo $customer['id']; ?>">[Edit]</a>
                            </td> -->
                        </tr>
                    <?php // endforeach; ?>
                <?php // else: ?>
                    <tr>
                        <td colspan="5">No referrals found.</td>
                    </tr>
                <?php // endif; ?>
            </tbody>
        </table>
    </div>

    <p class="refresh-text">Page will refresh every 30 seconds.</p>
</div>

