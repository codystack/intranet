
<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en" >
    <head>
        <title>Vineyard Intranet&trade;</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="shortcut icon" href="https://i.imgur.com/ElAvRTS.png"/>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>

        <link href="./assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
        <link href="./assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
    </head>

    <body  id="kt_body"  class="app-blank app-blank" >
        <script>
            var defaultThemeMode = "light";
            var themeMode;

            if ( document.documentElement ) {
                if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
                    themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
                } else {
                    if ( localStorage.getItem("data-bs-theme") !== null ) {
                        themeMode = localStorage.getItem("data-bs-theme");
                    } else {
                        themeMode = defaultThemeMode;
                    }			
                }

                if (themeMode === "system") {
                    themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
                }

                document.documentElement.setAttribute("data-bs-theme", themeMode);
            }            
        </script>

        
        <div class="d-flex flex-column flex-root" id="kt_app_root">

            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center video-background-wrapper position-relative" style="background-image: url('./assets/media/login-bg.jpeg');">
                    <video autoplay muted loop playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1" aria-hidden="true">
                        <source src="https://res.cloudinary.com/dzow7ui7e/video/upload/v1759064176/7534589-uhd_2160_4096_25fps_zxizzz.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
                    
                    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                        
                        <div class="w-lg-500px p-10">
                            
                            <form class="form w-100" id="kt_sign_in_form" data-kt-redirect-url="dashboard" action="#" method="POST">

                                <div class="text-center mb-11">
                                    <h1 class="text-gray-900 fw-bolder mb-3">
                                        Welcome Back
                                    </h1>
                                    
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Login using the correct credentials.
                                    </div>
                                </div>

                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="Email" name="email" autocomplete="on" class="form-control bg-transparent" required/> 
                                </div>

                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" required/>
                                </div>
                                
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>

                                    <a href="forgot-password" class="link-primary">
                                        Forgot Password ?
                                    </a>
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-danger">
                                        <span class="indicator-label">Sign In</span>
                                        
                                        <span class="indicator-progress">
                                            Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <script src="./assets/plugins/global/plugins.bundle.js"></script>
        <script src="./assets/js/scripts.bundle.js"></script>
        <script src="./assets/js/custom/authentication/sign-in/general.js"></script>

    </body>
</html>