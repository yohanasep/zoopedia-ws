<?php
include 'tata_letak/navbar.php';

require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/Graph.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/GraphStore.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
\EasyRdf\RdfNamespace::set('animal', 'https://example.org/schema/animals');

$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');

if(isset($_GET['link'])):
    $getLink = $_GET['link'];
    $sparql_query = 'SELECT * WHERE { ' .
        '<' . $getLink .'> ' . 'rdfs:label ?name.' .
        '<' . $getLink .'> ' . 'dbo:abstract ?abstract.' .
        '<' . $getLink .'> ' . 'dbo:thumbnail ?img.' .
        '<' . $getLink .'> ' . 'foaf:isPrimaryTopicOf ?wikped.' .
        'FILTER langMatches (lang(?name), "EN") .' .
        'FILTER langMatches (lang(?abstract), "EN") .' .
        'OPTIONAL {<' . $getLink .'>  dbp:species ?species} .' .
        'OPTIONAL {<' . $getLink .'>  dbp:parent ?parent} .' .
        'OPTIONAL {<' . $getLink .'>  dbp:taxon ?taxon} .' .
        'OPTIONAL {<' . $getLink .'>  dbp:genus ?genus} .' .
        'OPTIONAL {<' . $getLink .'>  dbp:subdivision ?subdivision} .' .
        '}';   

    $result = $sparql->query($sparql_query);
    
    if (COUNT($result) > 0):
        foreach ($result as $row):
        $detail = [
            "nama" => $row->name ?? null,
            "abstract" => $row->abstract ?? null,
            "img" => $row->img ?? null,
            "species" => $row->species ?? null,
            "parent" => $row->parent ?? null,
            "taxon" => $row->taxon ?? null,
            "genus" => $row->genus ?? null,
            "subdivision" => $row->subdivision ?? null,
            "wikped" => $row->wikped ?? null,
        ];

        if(!empty($detail['wikped']))
        {
            \EasyRdf\RdfNamespace::setDefault('og');
            $wikped= \EasyRdf\Graph::newAndLoad($detail['wikped']);
            $thumbnail = $wikped->image;
            $thumbnail = $wikped->image;

            if ($thumbnail == null) {
                $thumbnail = $detail['img'];
            } 
        } else {
            $thumbnail = "img/default.png";
        }

    endforeach; endif;
?>
<div class="container mb-5 pb-5">
    <div class="d-flex mt-4">
        <button onclick="goBack()" class="border-0 bg-transparent">
        <i class="fa-solid fa-arrow-left rounded-circle p-2"
            style="background-color: #5B4608; color: #F6EFE5;"></i>
        </button>
        <p class="fs-3 fw-medium mt-3 ms-3" style="font-family: 'poppins', sans-serif;">Details</p>
    </div>

    <div class="text-center mt-4">
        <img src="<?= $thumbnail ?>" alt="thumbnail"
            class="w-25 rounded-4 rounded-bottom-0">
        <center>
            <div class="p-2 rounded-5 rounded-top-0 mb-5" style="width: 450px; background-color: #F09306; color: #F6EFE5;">
                <b><?= $detail['nama']  ?></b>
            </div>
        </center>
    </div>

    <div style="text-align: justify; text-justify: inter-word;">
        <p class="fw-semibold fs-5 mt-4">Abstract</p>
        <p><?= $detail['abstract']; ?></p>
    </div>

    <hr>

    <?php
    if(!empty($detail['species']) && $detail['species'] != NULL){
        echo '
        <div class="mt-2">
        <p><span class="fw-semibold">Species</span>: ' . $detail['species'] .'</p> 
        </div>
        ';
    }
    if(!empty($detail['taxon']) && $detail['taxon'] != NULL){
        echo '
        <div class="mt-2">
        <p><span class="fw-semibold">Taxon</span>: ' . $detail['taxon'] .'</p> 
        </div>
        ';
    }
    if(!empty($detail['genus']) && $detail['genus'] != NULL){
        echo '
        <div class="mt-2">
        <p><span class="fw-semibold">Genus</span>: ' . $detail['genus'] .'</p> 
        </div>
        ';
    }
    if(!empty($detail['parent']) && $detail['parent'] != NULL){
        echo '
        <div class="mt-2">
        <p><span class="fw-semibold">Parent</span>: ' . $detail['parent'] .'</p> 
        </div>
        ';
    }
    if(!empty($detail['subdivision']) && $detail['subdivision'] != NULL){
        echo '
        <div class="mt-2">
        <p><span class="fw-semibold">Subdivision</span>: ' . $detail['subdivision'] .'</p> 
        </div>
        ';
    }
    ?>

    <hr>
    <div class="fw-semibold mt-4">
        <p style="font-size: 18px;">Baca Selengkapnya</p> 
        <ul>
            <li>DBPedia: <a href="<?= $getLink ?>"><?= $getLink ?></a></li>
            <li>Wikipedia: <a href="<?= $detail['wikped'] ?>"><?= $detail['wikped'] ?></a></li>
        </ul>
    </div>

</div>
<?php endif;?>

<?php
include 'tata_letak/footer.php'
    ?>