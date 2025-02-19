<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/school-logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/bs.min.css">
    <script src="../assets/bootstrap/bs.min.js"></script>
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/loading.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>School | Teachers</title>
</head>
<body class="bg-light">
    <?php include "../assets/components/loading.php" ?>
    <header>
        <?php include "./components/navbar.php" ?>
    </header>
    <section class="main-section d-flex">
        <aside class="animate__animated animate__bounceInLeft animate__delay-.2s">
            <?php include "./components/sidebar.php" ?>
        </aside>
        <main class="content-wrapper bg-light">
            <div class="container-fluid toggle--btn my-2" onclick="toggleSideBar()"><i class="bi bi-list h3"></i></div>
            <div id="dynamic-content" class="dynamic-content container-fluid">

            </div>
        </main>
    </section>
    <script src="../assets/plugins/script.js"></script>
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