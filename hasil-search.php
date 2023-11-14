<?php
include 'tata_letak/navbar.php';

require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/Graph.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/GraphStore.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
\EasyRdf\RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');

$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');

$getAnimal = "";
if(isset($_GET['searchAnimal'])):
    $getAnimal = $_GET['searchAnimal'];
    $words = explode(' ', $getAnimal);
    $getAnimal2 = ucfirst(strtolower($words[0]));

    for ($i = 1; $i < count($words); $i++) {
        $getAnimal2 .= ' ' . strtolower($words[$i]);
    }
endif;
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
    if (isset($_GET['searchAnimal']) && $_GET['searchAnimal'] != "") :
    $sparql_query = 'SELECT DISTINCT * WHERE {
        ?animal rdfs:label ?name.
        ?animal rdfs:comment ?comment.
        ?animal dbo:thumbnail ?img.
        ?animal dbp:taxon ?taxon.
        FILTER langMatches (lang(?name), "EN") .
        FILTER langMatches (lang(?comment), "EN") .
        FILTER langMatches (lang(?taxon), "EN") .
        FILTER regex (?name, "'. $getAnimal2 .'", "i") .
        } ORDER BY DESC(STRSTARTS(UCASE(?name), UCASE("' . $getAnimal2 . '"))) LIMIT 15';

    $result = $sparql->query($sparql_query);

    if (COUNT($result) > 0):
        foreach ($result as $row):
            $detail = [
                "nama" => $row->name ?? null,
                "comment" => $row->comment ?? null,
                "img" => $row->img ?? null,
            ];
        ?>

    <div class="card my-5 border-2 rounded-4">
        <div class="card-body rounded-4" style="background-color: #F6EFE5;">
            <div class="row">
                <div class="col-2">
                    <img src="<?= $detail['img'] ?>" alt="thumbnail" class="rounded-4 pe-3"
                        style="width: 200px; height: 200px;">
                </div>
                <div class="col-10">
                    <h4 class="card-title">
                        <?= $detail['nama'] ?>
                    </h4>
                    <p class="card-text">
                        <?= $detail['comment'] ?>
                    </p>

                    <div class="mt-4">
                        <a href="/" class="btn btn-warning browse-by-type" style="color: #5B4608;">
                            <b>See Detail</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else : 
        echo '
        <div class="text-center my-5 py-5">
        <b class="fs-2 text-danger text-center">Data tidak ditemukan, mohon masukkan kata kunci lain.</b>
        </div>';
    endif; ?>
    <?php else:
        echo '
        <div class="text-center my-5 py-5">
        <b class="fs-2 text-danger text-center">Silakan masukkan kata kunci terlebih dahulu.</b>
        </div>';
    endif; ?>
</div>

<?php
include 'tata_letak/footer.php';
?>