<style>
    .active{
        background-color: #F8F9FA ;
        color: black !important;
        border-radius:1em 0em 0em 1em;
        margin-left: 10px;
    }
</style>

<ul class="navbar-nav side-bar mt-2">
    <li class="side-item d-md-none"><a href="#" id="sidebarButton" data-target="pages/profile.php"><span><i class="bi bi-person-circle h4"></i> </span><span>Profile</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/index.php"><span><i class="bi bi-house h4"></i> </span><span>Home</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/assignments.php"><span><i class="bi bi-people-fill h4"></i> </span><span>Assignments</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/attendance.php"><span><i class="bi bi-person-workspace h4"></i> </span><span>Attendance</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/finance.php"><span><i class="bi bi-cash-coin h4"></i> </span><span>Finance</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/signout.php"><span><i class="bi bi-lock h4"></i> </span><span>Logout</span></a></li>
</ul>

<script>
    document.addEventListener("DOMContentLoaded",function(){
        const currentPage = window.location.hash.split("#")[1]
        // console.log(currentPage)
        document.querySelectorAll("#sidebarButton").forEach( el => {
            if(el.getAttribute("data-target").split("/")[1] === currentPage){
                el.classList.add("active")
            }
        })
    })
</script>