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
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');

$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');

$getAnimal = "";
if (isset($_GET['searchAnimal'])):
    $getAnimal = $_GET['searchAnimal'];
    $words = explode(' ', $getAnimal);
    $getAnimal2 = ucfirst(strtolower($words[0]));

    for ($i = 1; $i < count($words); $i++) {
        $getAnimal2 .= ' ' . strtolower($words[$i]);
    }
endif;
?>

<div style="background: linear-gradient(360deg, rgba(119, 89, 45, 0.70) 0%, rgba(119, 89, 45, 0.46) 77%)">
<div class="d-flex justify-content-center">
<form method="GET" action="" class="p-4 w-75" id="form">
        <div class="input-group mt-5">
            <input type="text" class="form-control rounded-start-5 ps-4 border-0 py-2" placeholder="Search Animal"
                aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?= $getAnimal ?>"
                name="searchAnimal" id="speechToText">
            <button class="input-group-text bg-white rounded-end-5 me-2 ps-4 border-0 py-2" type="submit" >
                <i class="fa-solid fa-magnifying-glass" style="color: #5B4608;" id="basic-addon2"></i>
            </button>
            <div class="input-group-text bg-white rounded-circle border-0" style="padding-inline: 14px; cursor: pointer;" onclick="recordSearch()">
                <i class="fa-solid fa-microphone-lines" style="color: #5B4608;"></i>
            </div>
        </div>
    </form>
</div>    

    <p class="text-center text-light text-bold pb-4 fs-4"><span class="fs-5">Pencarian:</span> <b>
            <?= $getAnimal ?>
        </b></p>
</div>

<div class="container">

    <?php
    if (isset($_GET['searchAnimal']) && $_GET['searchAnimal'] != ""):
        $sparql_query = 'SELECT DISTINCT *
        WHERE {
          ?animal rdfs:label ?name.
          ?animal rdfs:comment ?comment.
          ?animal foaf:isPrimaryTopicOf ?wikped. 
          FILTER langMatches(lang(?name), "EN").
          FILTER langMatches(lang(?comment), "EN").
          FILTER (?name = "'.$getAnimal2.'"@en) .
          OPTIONAL {
            ?animal dbo:thumbnail ?img.
          }
        }';

        $result = $sparql->query($sparql_query);

        if (COUNT($result) > 0):
            foreach ($result as $row):
                $detail = [
                    "link" => $row->animal ?? null,
                    "nama" => $row->name ?? null,
                    "comment" => $row->comment ?? null,
                    "img" => $row->img ?? null,
                    "wikped" => $row->wikped ?? null,
                ];

        if(!empty($detail['wikped']))
        {
            \EasyRdf\RdfNamespace::setDefault('og');
            $wikped= \EasyRdf\Graph::newAndLoad($detail['wikped']);
            $thumbnail = $wikped->image;
            if ($thumbnail == null){
                $thumbnail = $detail['img'];
            }
        }
        else {
            $thumbnail = "img/defaul.jpg";
        }
            
                ?>

            <div class="overflow-auto">
                <div class="tab mt-4">
                    <button class="searchTab activeTab fw-medium" onclick="openTab('showTab_hasil')">Results</button>
                    <button class="searchTab fw-medium" onclick="openTab('showTab_gallery')">Gallery</button>
                </div>

                <div id="showTab_hasil" class="hasilsearch rounded-bottom-2">
            
                <div class="card mb-5 mt-2 border-2 rounded-4">
                    <div class="card-body rounded-4" style="background-color: #F6EFE5;">
                        <div class="row gap-4">
                            <div class="col-3 border-0 img-thumbnail" style="width: 200px; height: 200px; background: none;">
                                <img src="<?=$thumbnail?>" alt="thumbnail" class="rounded-4 me-3 border-0"
                                    style="width: 200px; height: 200px; background: none;">
                            </div>
                            <div class="col-9">
                                <h4 class="card-title">
                                    <?= $detail['nama'] ?>
                                </h4>
                                <p class="card-text">
                                    <?= $detail['comment'] ?>
                                </p>

                                <div class="mt-4" id="buttonDetail">
                                    <a href="detail.php?link=<?= $detail['link'] ?>" class="btn text-light px-5" id="animalDetail"
                                    style="background-color: #5B4608;">
                                    Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
                <div id="showTab_gallery" class="hasilsearch rounded-bottom-2">
                    <div id="gallery-animal" class="my-3 mb-5 d-flex justify-content-between">

                    </div>
                </div>
            </div>

        <?php else:
            echo '
        <div class="text-center my-5 py-5">
        <b class="fs-2 text-danger text-center">Data not found, please enter another keyword.</b>
        </div>';
        endif; ?>
    <?php else:
        echo '
        <div class="text-center my-5 py-5">
        <b class="fs-2 text-danger text-center">Please enter the keyword first.</b>
        </div>';
    endif; ?>
</div>

<script>
    function openTab(showTabID) {
        var i, hasilsearch, searchTabs;

        hasilsearch = document.getElementsByClassName("hasilsearch");
        for (i = 0; i < hasilsearch.length; i++) {
            hasilsearch[i].style.display = "none";
        }

        searchTabs = document.getElementsByClassName("searchTab");
        for (i = 0; i < searchTabs.length; i++) {
            searchTabs[i].classList.remove("activeTab");
        }

        document.getElementById(showTabID).style.display = "block";
        event.currentTarget.classList.add("activeTab");
    }

    document.addEventListener("DOMContentLoaded", function () {
        openTab('showTab_hasil');
    });
</script>

<?php
include 'tata_letak/footer.php';
?>