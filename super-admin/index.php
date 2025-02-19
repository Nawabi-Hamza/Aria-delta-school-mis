<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bs.min.css">
    <script src="../assets/bootstrap/bs.min.js" ></script>
     <link rel="stylesheet" href="../assets/css/main.css">
     <link rel="stylesheet" href="../assets/css/animate.css">
    <title>School | Super Admin</title>
</head>
<body>
    <header>
        <?php include "./components/navbar.php" ?>
    </header>
    <section class="main-section bg-light d-flex">
        <aside class="animate__animated animate__bounceInLeft animate__delay-.2s">
            <?php include "./components/sidebar.php" ?>
        </aside>
        <main class="content-wrapper">
            <div class="container-fluid toggle--btn my-2 mt-3" ><i onclick="toggleSideBar()" class="bi bi-list h3"></i></div>
            <div class="dynamic-content container-fluid">
            </div>
        </main>
    </section>  
    <!-- Script for load content dynamicaly as component in single page -->
    <script src="../assets/plugins/jquery-3.6.0.min.js" defer></script>
    <script src="../assets/plugins/load-page-dynamic.js" defer></script>
    <!-- Change Page Direction -->
    <script src="../assets/plugins/changeDirectionPage.js" ></script>
    <script src="../assets/plugins/toggleSidebar.js" ></script>
    <!-- G-Translate -->
    <script>window.gtranslateSettings = {"default_language":"en", "native_language_names":true, "detect_browser_language":true, "languages":["en","fr","ar","fa","ps"], "wrapper_selector":".gtranslate_wrapper"}</script>
    <script src="../assets/plugins/g-translate.js" defer></script>
</body>
</html>