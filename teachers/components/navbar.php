<style>
    .gt_selector {
        border: 1px solid var(--secondary-text-color);
        background: none;
        padding: .2em;
        color: var(--primary-text-color);
    }
    .notifictaion-popup{
        position: absolute;
        width: 300px;
        max-height: 200px;
        overflow-y: auto;
        right: 10px;
        display: none;
        border-radius: .2em;
        z-index: 3;
    }
    .notification-img{
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
    .notification-content{
        > h6{
            font-size: 15px;
            margin: 0;
        }
        > p{
            font-size: 12px;
            margin: 0;
        }
    }
</style>

<nav class="d-flex justify-content-between align-items-center bg--primary  px-4">
    <h2 class="fw-bold">Teacher Dashboard</h2>
    <ul class="d-flex justify-content-between mt-2 me-4 gap-4 align-items-center">
         <li>
            <div class="gtranslate_wrapper border border-dark rounded"></div>
            <script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","fr","ar","fa","ps"],"wrapper_selector":".gtranslate_wrapper"}</script>
            <!-- <script src="https://cdn.gtranslate.net/widgets/latest/dropdown.js" defer></script> -->
            <script src="../assets/plugins/g-translate.js" defer></script>
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


<script>
    // Function to update direction based on lang attribute
    function updateDirection() {
        const lang = document.documentElement.getAttribute("lang"); // Get the current lang attribute
        
        if (["ar", "fa", "ps"].includes(lang)) {
            document.documentElement.setAttribute("dir", "rtl");
        } else {
            document.documentElement.setAttribute("dir", "ltr");
        }
    }

    // Create a MutationObserver to watch for changes in the lang attribute
    const observer = new MutationObserver(() => {
        updateDirection(); // Call function when lang changes
    });

    // Start observing changes in the lang attribute of the <html> tag
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ["lang"] // Only watch for lang attribute changes
    });

    // Initial direction setup in case the page starts with a different language
    updateDirection();
     // notification popup
     const notifyContainer = document.querySelector(".notify");
    const notification = document.querySelector(".notification");
    const notificationPopup = document.querySelector(".notifictaion-popup");
    notification.addEventListener("mouseenter", function() {
        // alert("You have a new notification");
        notificationPopup.style.display = "block";
    });
    notifyContainer.addEventListener("mouseleave", function() {
        notificationPopup.style.display = "none" ;
    });
</script>

