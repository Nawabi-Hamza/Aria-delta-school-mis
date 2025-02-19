

<nav class="d-flex justify-content-between align-items-center bg--primary  px-4 pt-1">
    <h2 class="fw-bold">SuperAdmin Dashboard</h2>
    <ul class="d-flex justify-content-between mt-2 me-4 gap-4 align-items-center">
         <li>
            <div class="gtranslate_wrapper border border-black rounded"></div>
         </li>
        <li>
            <a href="#notification" class="notify m-0 bg-light rounded-circle px-1 nav-link  position-relative" id="sidebarButton" data-target="pages/notification.php">
                <div class="notification position-relative">
                    <i class="bi bi-bell-fill h3"></i>
                    <?php 
                        $notification = true;
                        if($notification){
                    ?>  
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    <?php } ?>
                </div>
                <div class="notifictaion-popup p-1 bg-white shadow">
                    <?php 
                        if($notification){
                    ?>
                    <div class="card px-2 mb-2">
                        <div class="card-body d-flex gap-2 align-items-start p-2">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQX_XAKqFiXUPYKF2qXPFZcDmzQ7SoDJj_OiQ&s"  class="notification-img" alt="">
                            <div class="notification-content">
                                <h6>Hamza</h6>
                                <p>salam khob asti</p>
                            </div>
                        </div>
                    </div>
                    <div class="card px-2 mb-2">
                        <div class="card-body d-flex gap-2 align-items-start p-2">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHBlcnNvbiUyMGljb258ZW58MHx8MHx8fDA%3D"  class="notification-img" alt="">
                            <div class="notification-content">
                                <h6>Shafi Noori</h6>
                                <p>salam khob asti Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odio maxime beatae reiciendis a? Error nobis quaerat perspiciatis id consectetur excepturi cumque! Ducimus qui ex necessitatibus, magnam voluptates consequuntur temporibus nihil!</p>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                       no message yet
                    <?php } ?>
                </div>  
            </a><span class="badge badge-danger"></span>
        </li>
        <li class="d-none d-md-block"><a href="" class="nav-link"><i class="bi bi-person-circle h3"></i></a></li>
    </ul>
</nav>

