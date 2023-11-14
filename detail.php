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
$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/hewan/sparql');

$getID = $_GET['id'];
if($getID) :
$sparql_query = 'SELECT * WHERE {
?animal rdf:type animal:Description;
    rdfs:name ?nama;
    animal:detail ?detail;
    animal:image ?img;
    animal:taxon ?taxon;
    animal:phylum ?phylum;
    animal:class ?class;
    animal:order ?order;
    animal:family ?family;
    animal:genus ?genus;
    animal:id ?id;
    FILTER(?id = "' . $getID . '").
    }';

$result = $sparql_jena->query($sparql_query);

$row = $result->current();

$nama = $row->nama;
$detail = $row->detail;
$img = $row->img;
$taxon = $row->taxon;
$phylum = $row->phylum;
$class = $row->class;
$order = $row->order;
$family = $row->family;
$genus = $row->genus;
$id = $row->id;

// elseif($_GET['searchAnimal']) :
//     $animal=$_GET['searchAnimal'];
//     $trimmedSearch=trim(substr($animal,28),"/");

//   $q = 'SELECT * WHERE {' .
//     '  dbr:'.$animal.' rdf:type dbo:University;' .
//     '  dbo:abstract ?descs ;' .
//     '   rdfs:label ?nama .' .
//     'FILTER langMatches (lang(?descs),"EN")' .
//     'FILTER langMatches (lang(?nama),"EN")' .

//     'OPTIONAL{ dbr:'.$animal.' foaf:isPrimaryTopicOf ?wiki .}'.
//     'OPTIONAL{ dbr:'.$animal.' dbp:motto ?motto .}'.
//     'OPTIONAL{ dbr:'.$animal.' dbp:rector ?rector .}'.
//       'OPTIONAL{   dbr:'.$animal.' geo:lat ?lat .}'.
//         'OPTIONAL{ dbr:'.$animal.' geo:long ?long .}'.
//     '} LIMIT 1 ';


//   $results = $sparql->query($q);
//   $details = [];

//   foreach ($results as $row) {
      
//         $details = [
//           "nama" => $row->nama??null,
          
//           "rector" => $row->rector ?? null,
//           "desc"=>$row->descs??null,
//           "motto"=>$row->motto ??null,
//           "wiki"=>$row->wiki ??null ,
//           "lat"=>$row->lat??null,
//           "long"=>$row->long ?? null,

         
//         ];
//         break;
//       }
    

//   if(!empty($details['wiki']))
//   {
//     \EasyRdf\RdfNamespace::setDefault('og');
//     $wiki= \EasyRdf\Graph::newAndLoad($details['wiki']);
//     $foto_url =$wiki->image;
//   }
//   else{
//     $foto_url="public/default.png";
//   }
?>
<div class="container">

    <button onclick="goBack()" class="border-0 bg-transparent">
        <i class="fa-solid fa-arrow-left mt-5"></i></button>
    <div class="text-center mt-4">
        <img src="<?= $img ?>" alt="thumbnail"
            class="w-25 rounded-4 rounded-bottom-0">
        <center>
            <div class="p-2 rounded-5 rounded-top-0 bg-warning text-light mb-5" style="width: 450px;">
                <b><?= $nama ?></b>
            </div>
        </center>
    </div>

    <!-- tab -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#detail-tab-pane" type="button"
                aria-controls="detail-tab-pane" aria-selected="true" style="color: #5B4608;">Detail</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#taxonomy-tab-pane" type="button"
                aria-controls="taxonomy-tab-pane" aria-selected="false" style="color: #5B4608;">Taxonomy</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#habitat-tab-pane" type="button"
                aria-controls="habitat-tab-pane" aria-selected="false" style="color: #5B4608;">Habitat</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active mt-3" id="detail-tab-pane" aria-labelledby="detail-tab" tabindex="0">
            <?= $detail?>
        </div>
        <div class="tab-pane fade mt-3" id="taxonomy-tab-pane" aria-labelledby="taxonomy-tab" tabindex="0">
            <ul>
                <li>Taxon : <?= $taxon ?></li>
                <li>Phylum : <?=$phylum?> </li>
                <li>Class : <?=$class?> </li>
                <li>Order : <?=$order?> </li>
                <li>Family : <?=$family?> </li>
                <li>Genus : <?=$genus?> </li>
            </ul>
        </div>
        <div class="tab-pane fade mt-3" id="habitat-tab-pane" aria-labelledby="habitat-tab" tabindex="0">Gaza, Palestina
        </div>
    </div>
</div>
<?php endif;?>

<?php
include 'tata_letak/footer.php'
    ?>