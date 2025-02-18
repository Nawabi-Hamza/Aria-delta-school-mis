
<ul class="navbar-nav side-bar ">
    <li class="side-item d-md-none"><a href="#" id="sidebarButton" data-target="pages/index.php"><span><i class="bi bi-person-circle h4"></i> </span><span>Profile</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/index.php"><span><i class="bi bi-speedometer h4"></i> </span><span class="side-text">Dashboard</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/classes.php"><span><i class="bi bi-border-all h4"></i> </span><span class="side-text">Classes</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/assignments.php"><span><i class="bi bi-person-video3 h4"></i> </span><span class="side-text">Assignments</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/timetable.php"><span><i class="bi bi-calendar2-check h4"></i> </span><span class="side-text">Timetable</span></a></li>
    <li class="side-item"><a href="#" id="sidebarButton" data-target="pages/signout.php"><span><i class="bi bi-journals h4"></i> </span><span class="side-text">Logout</span></a></li>
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