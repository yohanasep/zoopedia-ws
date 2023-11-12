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
                        <div class="col-2">
                            <img src="<?= $detail['img'] ?>" alt="thumbnail" style="width: 200px; height: 200px;"
                                class="rounded-4 pe-3">
                        </div>
                        <div class="col-10">
                            <h4 class="card-title">
                                <?= $detail['nama'] ?>
                            </h4>
                            <p class="card-text">
                                <?= $detail['comment'] ?>
                            </p>

                            <div class="mt-4">
                                <a href="detail.php?id=<?= $detail['id'] ?>" type="button"
                                    class="btn btn-warning browse-by-type" style="color: #5B4608;">
                                    <b>See Detail</b>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<?php
include 'tata_letak/footer.php';
?>