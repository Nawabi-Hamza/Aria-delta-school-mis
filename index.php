<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/bootstrap/bs.min.css">
    <title>Parent Page</title>
    <style>
        .hero-section {
            position: relative;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            /* background-image: url(https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8c2Nob29sfGVufDB8fDB8fHww); */
            background-image: url(https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fHNjaG9vbHxlbnwwfHwwfHx8MA%3D%3D);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <section class="hero-section">
        <div class="container hero-content h-100 d-flex flex-column justify-content-center align-items-center">
        <h1 class="display-3 text-white fw-bold">Learn More, Achieve More</h1>
        <p class="text-white-50 fs-5">Start our platform and take your work easy.</p>
            <div class="d-flex justify-content-center gap-2">
                <a href="./login.php" class="btn btn-light ">Get Started <i class="bi bi-arrow-right-circle"></i></a>
            </div>
        </div>
    </section>
</body>
</html> 