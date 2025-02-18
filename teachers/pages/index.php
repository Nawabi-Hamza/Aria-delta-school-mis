<style>
    .card-index {
        background-color: #fff;
        padding: 20px;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        transition: .5s;
        border-radius: .4em;
        height: 180px;
        > h3 {
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.4em;
        }
        > p {
                font-size: 16px;
                margin-bottom: 20px;
            }
    }
    .card-index:hover{
        transform: translateY(-5px);
        box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }
</style>
<div class="container">
    <h2 class="text-center pb-5">Teacher Portal Dashboard</h2>
    <div class="card-container row justify-content-between">
        <div class="col-md-6 col-xl-3 mb-2">
            <div class="card-index">
                <h3>Classes</h3>
                <p>Manage all the classes you teach</p>
                <a href="classes.php" class="btn-custom">View Classes</a>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-2">
            <div class="card-index">
                <h3>Assignments</h3>
                <p>Review and grade student assignments</p>
                <a href="add_assignment.php" class="btn-custom">View Assignments</a>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-2">
            <div class="card-index">
                <h3>Timetable</h3>
                <p>Check your teaching schedule</p>
                <a href="timetable.php" class="btn-custom">View Timetable</a>
            </div>
        </div>
        <div class="col-md-6 col-xl-3 mb-2">
            <div class="card-index">
                <h3>Announcements</h3>
                <p>Post and view class announcements</p>
                <a href="announcements.php" class="btn-custom">Manage Announcements</a>
            </div>
        </div>
    </div>
</div>