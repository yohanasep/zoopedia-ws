<?php
include 'tata_letak/navbar.php';

require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";

\EasyRdf\RdfNamespace::set('animal', 'https://example.org/schema/animals');

$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/hewan/sparql');
?>

<div class="container">

    <button onclick="goBack()" class="border-0 bg-transparent">
        <i class="fa-solid fa-arrow-left mt-5"></i></button>

    <?php
    $getType = $_GET['type'];
    $sparql_query = 'SELECT * WHERE {
    ?animal rdf:type animal:Description;
      rdfs:name ?nama;
      animal:comment ?comment;
      animal:image ?img;
      animal:id ?id;
      animal:type ?type;
      FILTER(?type = "' . $getType . '").
      }';

    $result = $sparql_jena->query($sparql_query);

    if ($result):

        foreach ($result as $animal):
            $detail = [
                'nama' => $animal->nama,
                'comment' => $animal->comment,
                'img' => $animal->img,
                'id' => $animal->id,
            ];
            ?>

            <div class="card my-5 border-2 rounded-4">
                <div class="card-body rounded-4" style="background-color: #F6EFE5;">
                    <div class="row p-3">
                        <div class="col-3">
                            <img src="<?= $detail['img'] ?>" alt="thumbnail" style="width: 300px; height: 200px;"
                                class="rounded-4 pe-3">
                        </div>
                        <div class="col-9">
                            <h4 class="card-title">
                                <?= $detail['nama'] ?>
                            </h4>
                            <p class="card-text">
                                <?= $detail['comment'] ?>
                            </p>

                            <div class="mt-4">
                                <button onclick="showDetail('show<?=$detail['id']?>')" type="button"
                                    class="btn btn-warning browse-by-type" style="color: #5B4608;">
                                    <b>See Detail</b>
                                </button>
                            </div>

                            <div class="z-2 visually-hidden" style="top: 0; left: 0; overflow: hidden;" id="show<?=$detail['id']?>">
                                <div class="position-fixed w-100 h-100 z-3"
                                    style="top: 0; left: 0; backdrop-filter: blur(2px); -webkit-backdrop-filter: blur(2px); background-color: black; opacity: 0.8;">
                                </div>

                                <div class="d-flex grid-col-2 bg-white justify-content-between align-items-start position-absolute rounded-4 overflow-auto float w-100 z-3"
                                    style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <div class="position-relative"><img src="<?= $detail['img'] ?>" alt="" style="width: 650px; height: 400px;"></div>

                                    <div class="position-relative border-primary w-100">
                                        <div class="d-flex justify-content-between align-items-start px-2" style="background-color: #412702;">
                                            <p class="text-light my-auto fs-3 ps-4">
                                                <b style="font-family: 'Poppins', sans-serif;"><?= strtoupper($detail['nama']) ?></b>
                                            </p>
                                            <button onclick="showDetail('show<?=$detail['id']?>')" class="bg-transparent border-0 fs-1 pe-3 my-auto"
                                                style="color: white;"><b>&times;</b></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<script>
    const showDetail = (showID) => {
        const modal = document.getElementById(showID);

        if (modal.classList.contains('visually-hidden')) {
            modal.classList.remove('visually-hidden')
        } else {
            modal.classList.add('visually-hidden')
        }
    }
</script>

<?php
include 'tata_letak/footer.php';
?>