<?php
include 'tata_letak/navbar.php';
?>

<div
  style="background-image: url('img/back_search.jpg'); background-repeat: no-repeat; background-size: cover; width: 100%;">
  <div class="p-5"
    style="background: linear-gradient(270deg, rgba(119, 89, 45, 0.70) 12%, rgba(119, 89, 45, 0.42) 100%)">

    <div class="p-5">
      <h1 class="fs-2 fw-bold text-center text-light">ZOOPEDIA</h1>
      <p class="text-center text-light fs-5">
        Learn, Explore, Value the magnificent diversity of the animal kingdom
      </p>

      <form method="GET" action="hasil-search.php" class="p-4">
        <div class="input-group m-4">
          <input type="text" class="form-control rounded-start-5 ps-4 border-0 py-2" placeholder="Search Animal"
            aria-label="Recipient's username" aria-describedby="basic-addon2" name="searchAnimal" id="speechToText">
          <button class="input-group-text bg-white pe-3 me-2 border-0 rounded-end-5" type="submit">
            <i class="fa-solid fa-magnifying-glass" style="color: #5B4608;" id="basic-addon2"></i>
          </button>
          <div class="input-group-text bg-white rounded-circle border-0" style="padding-inline: 14px; cursor: pointer;">
            <i class="fa-solid fa-microphone-lines" style="color: #5B4608;" onclick="recordSearch()"></i>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <center>
    <p class="fs-2 mt-5"><b>Browse by types</b></p>
    <p class="fs-5 mb-5">Dive into the diverse world of browsing! explore and enjoy!</p>
  </center>

  <div class="d-flex justify-content-between px-5 mx-5">
    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Mamals" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/mamals.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Mamals</b></p>
          <p style="width: 250px; font-size: 14px;">Warm-blooded, fur-covered, milk-producing animals that give birth to
            live young</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>

    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Amphibia" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/amphibia.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Amphibia</b></p>
          <p style="width: 250px; font-size: 14px;">Cold-blooded, typically moist-skinned vertebrates undergo water-to-land metamorphosis</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>

    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Pisces" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/pisces.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Pisces</b></p>
          <p style="width: 250px; font-size: 14px;">Aquatic vertebrates characterized by gills, fins for movement, and
            typically covered in scales.</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>


  </div>

  <div class="d-flex justify-content-between mb-5">
    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Aves" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/aves.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Aves</b></p>
          <p style="width: 250px; font-size: 14px;">Warm-blooded, feathered vertebrates with beaks, wings for flight,
            and lay hard-shelled eggs.</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>

    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Reptile" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/reptile.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Reptile</b></p>
          <p style="width: 250px; font-size: 14px;">Cold-blooded, scaly-skinned vertebrates that lay eggs and have lungs
            for breathing air</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>

    <div class="card mb-5 shadow">
      <a href="browse-by-types.php?type=Invertebrata" class="text-decoration-none text-dark h-100"
        style="background-color: #F6EFE5;">
        <div class="card-body rounded">
          <div class="img-container">
            <img src="img/invertebrates.jpg" alt="hewan.jpg" class="rounded-2" style="width: 250px; height: 170px;">
          </div>
          <p class="fs-4 pt-3" style="font-family: 'Poppins', sans-serif;"><b>Invetebrates</b></p>
          <p style="width: 250px; font-size: 14px;">Backbone-free animals like insects, mollusks, and arachnids, known for diverse body structures</p>
          <p class="btn text-light w-100 py-2" style="background-color: #5B4608;">Search me!</p>
        </div>
      </a>
    </div>
  </div>
</div>

<?php include 'tata_letak/footer.php' ?>