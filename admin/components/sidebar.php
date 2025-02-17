
<ul class="navbar-nav side-bar">
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/index.php"><span><i class="bi bi-speedometer h4"></i> </span><span class="side-text">Dashboard</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/students.php"><span><i class="bi bi-person-video3 h4"></i> </span><span class="side-text">Students</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/attendance.php"><span><i class="bi bi-calendar2-check h4"></i> </span><span class="side-text">َAttendance</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/classes.php"><span><i class="bi bi-border-all h4"></i> </span><span class="side-text">Classes</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/subjects.php"><span><i class="bi bi-journals h4"></i> </span><span class="side-text">Subject</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/teacher.php"><span><i class="bi bi-person-lines-fill h4"></i> </span><span class="side-text">Teacher</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/letters.php"><span><i class="bi bi-send h4"></i> </span><span class="side-text">Letters</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/referrals.php"><span><i class="bi bi-person-gear h4"></i> </span><span class="side-text">Referrals</span></a></li>
</ul>


<script>
        document.addEventListener("DOMContentLoaded",function(){
            const currentPage = window.location.hash.split("#")[1]
            document.querySelectorAll("#sidebarButton").forEach( el => {
                if(el.getAttribute("data-target").split("/")[1] === currentPage){
                    el.classList.add("active")
                }
            })
        })
</script>