<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bs.min.css">
    <script src="../assets/bootstrap/bs.min.js" ></script>
    <link rel="stylesheet" href="./assets/admin.css">
    <title>School | MIS</title>
</head>
<body>
    <header>
        <?php include "./components/navbar.php" ?>
    </header>
    <section class="main-section d-flex">
        <aside class="bg--secondary">
            <div class="side-item d-none d-md-flex toggle--btn my-2 text-white justify-content-end align-items-center" id="toggleSidebar" ><span><i class="bi bi-list text-white h4 me-2 me-lg-4"></i></span></div>
            <?php include "./components/sidebar.php" ?>
        </aside>
        <main class="content-wrapper bg-light">
            <div class="container-fluid">
                <div class="dynamic-content">
                </div>
            </div>
        </main>
    </section>  
    <!-- Script for load content dynamicaly as component in single page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
    <script src="../assets/plugins/load-page-dynamic.js" defer></script>
    <script>
        function toggleSideBar(){
            const st = document.querySelectorAll(".side-text")
            const as = document.querySelector("aside")
            const ma = document.querySelector("main")
            as.style.width = as.style.width === "20%" ? "5%" : "20%"
            ma.style.width = ma.style.width === "80%" ? "95%" : "80%"
            st.forEach((el) => el.style.display = el.style.display === "block" ? "none" : "block")
        }
        document.getElementById("toggleSidebar").addEventListener("click", toggleSideBar)
    </script>
</body>
</html>