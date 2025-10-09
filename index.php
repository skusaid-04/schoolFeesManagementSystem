<?php
include 'backend.php';
include 'get_data/system_info.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Al-Nadi-Ul-Falah English High School</title>
  <!-- For basic usage with plain HTML -->
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- access jquery -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://kit.fontawesome.com/b85f5b7745.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="image/x-icon" href="assets/logoh.png">
  <style>
    body {
      overflow-x: hidden;
    }
  </style>
  <style>
    #loader-wrapper {
      z-index: 1050;
      /* higher than modals */
    }

    #loader-wrapper.fade-out {
      opacity: 0;
      visibility: hidden;
      transition: all 0.5s ease;
    }

    #loader {
      max-width: 120px;
      /* adjust size if needed */
    }
  </style>

</head>

<body>
  <div id="loader-wrapper"
    class="d-flex justify-content-center align-items-center bg-white position-fixed top-0 start-0 w-100 h-100">
    <img src="assets/loader.gif" alt="Loading..." id="loader" class="img-fluid">
  </div>
  <div class="d-flex">
    <!-- Sidebar -->
    <?php
    include "includes/sidebar.php";
    ?>

    <!-- Page content -->
    <div class="flex-grow-1" style="margin-left: 200px;">
      <div
        class="header position-fixed z-3 d-flex justify-content-between align-items-center px-4 py-2 bg-white border-bottom gap-2"
        style="width: -webkit-fill-available;">
        <?php include "includes/header.php"; ?>
      </div>
      <main id="view-panel" style="display: none;">
        <?php
        // 🧩 Regular page rendering
        if (isset($page) && file_exists("{$page}.php")) {
          include "{$page}.php";
        } else {
          include 'dashboard.php'; // fallback or show a 404 page
        }
        ?>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener('load', function () {
      const loaderWrapper = document.getElementById('loader-wrapper');
      const mainContent = document.getElementById('view-panel');

      loaderWrapper.classList.add('fade-out');

      setTimeout(() => {
        loaderWrapper.style.display = 'none';
        if (mainContent) {
          mainContent.style.display = 'block';
        } else {
          console.warn('Element with id "main-content" not found.');
        }
      }, 500);
    });

    // function anchorButton(){

    // }
    const links = document.querySelectorAll(".smart-link");

    // console.log("Smart links initialized:", links);

    links.forEach(link => {
      const originalHref = link.getAttribute("href");

      // Store href in data attribute
      link.setAttribute("data-href", originalHref);

      // On hover: remove href so browser doesn't show it
      link.addEventListener("mouseover", () => {
        link.removeAttribute("href");
      });

      // On mouseout: restore href
      link.addEventListener("mouseout", () => {
        requestAnimationFrame(() => {
          link.setAttribute("data-href", originalHref);
        });
      });

      // On click: manually redirect using JS (still clickable)
      link.addEventListener("click", (e) => {
        e.preventDefault(); // prevent broken link if href is removed
        const url = link.getAttribute("data-href");
        if (url) {
          window.location.href = url;
        }
      });
    });

  </script>

</body>


</html>