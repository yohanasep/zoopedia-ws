<?php
include 'tata_letak/navbar.php';

require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/Graph.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/GraphStore.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
\EasyRdf\RdfNamespace::set('animal', 'https://example.org/schema/animals');

$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');
$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/hewan/sparql');

$getAnimal = $_GET['searchAnimal'];
$getAnimal2 = str_replace(' ', '_', ucwords($getAnimal));
?>

<div style="background: linear-gradient(360deg, rgba(119, 89, 45, 0.70) 0%, rgba(119, 89, 45, 0.46) 77%)">
    <form method="GET" action="" class="p-5">
        <div class="input-group">
            <input type="text" class="form-control rounded-start-5 ps-4 border-0 py-2" placeholder="Search Animal"
                aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $getAnimal ?>"
                name="searchAnimal">
            <button class="input-group-text bg-warning rounded-end-5 px-4 border-0">
                <i class="fa-solid fa-lg fa-magnifying-glass" style="color: white;" id="basic-addon2"></i>
            </button>
        </div>
    </form>

    <p class="text-center text-light text-bold pb-4 fs-4"><span class="fs-5">Pencarian:</span> <b>
            <?= $getAnimal ?>
        </b></p>
</div>

<div class="container">

    <?php
    $sparql_query = 'SELECT * WHERE {
    ?animal rdf:type animal:Description;
        rdfs:name ?nama;
        animal:comment ?comment;
        animal:image ?img;
        animal:id ?id;
        FILTER(?nama = "' . $getAnimal2 . '").
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
                    <div class="row">
                        <div class="col-2">
                            <img src="<?=$detail['img']?>" alt="thumbnail"
                                class="rounded-4 pe-3" style="width: 200px; height: 200px;">
                        </div>
                        <div class="col-10">
                            <h4 class="card-title">
                                <?= $detail['nama'] ?></h4>
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
        <?php endforeach;?>
    <?php endif; ?>

</div>

<?php
include 'tata_letak/footer.php';
?>