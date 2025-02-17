<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bs.min.css">
    <script src="../assets/bootstrap/bs.min.js" ></script>
    <link rel="stylesheet" href="./extra/super-admin.css">
    <title>School | MIS</title>
</head>
<body>
    <header>
        <?php include "./components/navbar.php" ?>
    </header>
    <section class="main-section d-flex">
        <aside class="bg--secondary">
            <?php include "./components/sidebar.php" ?>
        </aside>
        <main class="content-wrapper bg-light">
            <div class="container-fluid toggle--btn my-2" onclick="toggleSideBar()"><i class="bi bi-list h3"></i></div>
            <div class="dynamic-content container-fluid">
            </div>
        </main>
    </section>  
    <!-- Script for load content dynamicaly as component in single page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function loadPageDynamic(directory){
            $.ajax({
                url: directory, 
                method: 'GET',
                success: function(response) {
                    $('.dynamic-content').html(response);
                },
                error: function() {
                    console.log("This page does not exist");
                    loadPageDynamic("pages/index.php")
                }
            });
        }
        $(document).on('click','#sidebarButton', function(e) {
            e.preventDefault(); 
            var targetPage = $(this).data('target');  
            $('#defaultContent').hide();
            window.location.assign('#'+targetPage.split("/")[1])
            // Load page as a component
            loadPageDynamic(targetPage)
            // Add class for active link
            document.querySelectorAll("#sidebarButton").forEach( el => el.classList.remove("active"))
            this.classList.add("active")
            // console.log(this)
        });
    
        document.addEventListener("DOMContentLoaded",function(){
            const currentPage = window.location.hash.split("#")[1]
            loadPageDynamic(`pages/${currentPage}`)
        })
        function toggleSideBar(){
            const as = document.querySelector("aside")
            const ma = document.querySelector("main")
            as.style.display = as.style.display === "none" ? "block" : "none"
            ma.style.width = ma.style.width === "100%" ? "75%" : "100%"
        }
    </script>
</body>
</html>