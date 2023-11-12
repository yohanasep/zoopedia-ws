<?php 
include 'tata_letak/navbar.php';

?>

<div
  style="background-image: url('img/back_search.jpg'); background-repeat: no-repeat; background-size: cover; width: 100%;">
  <div class="p-5"
    style="background: linear-gradient(270deg, rgba(119, 89, 45, 0.70) 12%, rgba(119, 89, 45, 0.42) 100%)">

    <div class="p-5">
      <h1 class="text-center text-light">ZOOPEDIA</h1>
      <p class="text-center text-light fs-5">
        Learn, Explore, Value the magnificent diversity of the animal kingdom
      </p>

      <form method="GET" action="hasil-search.php" class="p-4">
        <div class="input-group m-4">
          <input type="text" class="form-control rounded-start-5 ps-4 border-0 py-2" placeholder="Search Animal"
            aria-label="Recipient's username" aria-describedby="basic-addon2" name="searchAnimal">
          <button class="input-group-text bg-warning rounded-end-5 px-4 border-0">
            <i class="fa-solid fa-lg fa-magnifying-glass" style="color: white;" id="basic-addon2"></i>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <p class="fs-3 mt-5"><b>Browse by types</b></p>

  <div class="d-flex">
    
    <div class="browse-by-type card mb-5 w-25">
      <a href="browse-by-types.php?type=Mamals" class="text-decoration-none text-dark">
        <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Mamals</p>
        <img src="img/capibara.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>

    <div class="browse-by-type card mb-5 mx-2 w-25">
    <a href="browse-by-types.php?type=Amphibia" class="text-decoration-none text-dark">  
    <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Amphibia</p>
        <img src="img/amphibians.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>

    <div class="browse-by-type card mb-5 mx-2 w-25">
    <a href="browse-by-types.php?type=Reptile" class="text-decoration-none text-dark">  
    <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Reptile</p>
        <img src="img/komodo.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>

    <div class="browse-by-type card mb-5 mx-2 w-25">
    <a href="browse-by-types.php?type=Aves" class="text-decoration-none text-dark">  
    <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Aves</p>
        <img src="img/bird.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>

    <div class="browse-by-type card mb-5 mx-2 w-25">
    <a href="browse-by-types.php?type=Pisces" class="text-decoration-none text-dark">  
    <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Pisces</p>
        <img src="img/fish.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>

    <div class="browse-by-type card mb-5 mx-2 w-25">
    <a href="browse-by-types.php?type=Invertebrata" class="text-decoration-none text-dark">  
    <div class="card-body rounded" style="background-color: #F6EFE5;">
        <p>Invetebrates</p>
        <img src="img/gurita.jpg" alt="hewan.jpg" class="rounded-2" style="width: 170px; height: 170px;">
      </div>
      </a>
    </div>
  </div>
</div>


<?php include 'tata_letak/footer.php' ?>