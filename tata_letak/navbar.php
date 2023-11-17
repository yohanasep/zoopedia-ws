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

    .img-container img {
      filter: grayscale(.4);
      transition: 1s;
    }

    .img-container img:hover {
      filter: grayscale(0);
      transform: scale(1.3);
    }

    .browse-by-type {
      transition: transform 0.3s ease;
    }

    .browse-by-type:hover {
      transform: scale(1.05);
    }

    .navbar-brand:hover {
      font-weight: 600;
    }

    .img-thumbnail {
      transition: transform 0.3s ease-out;
    }

    .img-thumbnail:hover {
      transform: scale(1.02);
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
/* 
    *{
      border: 2px solid red;
    } */
  </style>
</head>

<body class="min-vh-100"
  style="background: linear-gradient(180deg, rgba(246, 239, 229, 0.87) 0%, rgba(246, 239, 229, 0.77) 63%, rgba(246, 239, 229, 0.39) 100%)">
  <nav class="navbar bg-none container border-bottom border-3">
    <a class="navbar-brand" href="landing-page.php">
      <img src="img/lion.png" alt="Logo" width="50" height="60" class="d-inline-block align-text">
      ZOOPEDIA
    </a>
    <div class="text-navbar">
      <a class="navbar-brand" href="landing-page.php">HOME</a>
      <a class="navbar-brand" href="about.php">ABOUT</a>
    </div>
  </nav>