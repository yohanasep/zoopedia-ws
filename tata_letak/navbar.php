<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZOOPEDIA</title>
  <link href="img/lion.png" sizes="16x16 32x32" rel="shortcut icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,600&display=swap" rel="stylesheet">

  <style>
    body {
      display: flex;
      flex-direction: column;
    }

    .img-container {
      overflow: hidden;
    }

    .card:hover .img-container img {
      filter: grayscale(0);
      transform: scale(1.2);
    }

    .img-container img {
      filter: grayscale(.4);
      transition: 0.5s;
    }

    .navbar-brand:hover {
      font-weight: 700;
    }

    .img-thumbnail {
      overflow: hidden;
    }

    .img-thumbnail img {
      filter: grayscale(.2);
      transition: 0.2s;
    }

    .img-thumbnail img:hover {
      filter: grayscale(0);
      transform: scale(1.05);
    }

    .tabcontent {
      display: none;
      border: 1px solid #F09306; 
    }

    .tablink {
      background-color: #F6EFE5;
      padding: 8px 16px;
      border: none;
      cursor: pointer;
    }

    .active {
      background-color: #F09306;
      color: #F6EFE5;
    }

    .hasilsearch {
      height: 100%;
      display: none;
    }

    .searchTab {
      background-color: rgba(246, 239, 229, 0.39);
      padding: 8px 16px;
      border: none;
      cursor: pointer;
    }

    .activeTab {
      border-bottom: 4px solid #F09306;
      color: #F09306;
    }
  </style>
</head>

<body class="min-vh-100"
  style="background: linear-gradient(180deg, rgba(246, 239, 229, 0.87) 0%, rgba(246, 239, 229, 0.77) 63%, rgba(246, 239, 229, 0.39) 100%)">
  <nav class="navbar bg-none container border-bottom border-3">
    <a class="navbar-brand fw-bolder" href="landing-page.php" style="color: #5B4608;">
      <img src="img/lion.png" alt="Logo" width="50" height="60" class="d-inline-block align-text">
      ZOOPEDIA
    </a>
    <div class="text-navbar">
      <a class="navbar-brand" href="landing-page.php">HOME</a>
      <a class="navbar-brand" href="about.php">ABOUT</a>
    </div>
  </nav>