<?php
include 'tata_letak/navbar.php';

require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";

\EasyRdf\RdfNamespace::set('animal', 'https://example.org/schema/animals');

$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/hewan/sparql');
?>

<div class="container">

    <button onclick="goBack()" class="border-0 bg-transparent">
        <i class="fa-solid fa-arrow-left mt-5 rounded-circle p-2"
            style="background-color: #5B4608; color: #F6EFE5;"></i></button>

    <?php
    $getType = $_GET['type'];
    $sparql_query = 'SELECT * WHERE {
    ?animal rdf:type animal:Description;
      rdfs:name ?nama;
      animal:comment ?comment;
      animal:detail ?detail;
      animal:image ?img;
      animal:id ?id;
      animal:type ?type;
      animal:taxon ?taxon;
      animal:phylum ?phylum;
      animal:class ?class;
      animal:order ?order;
      animal:family ?family;
      animal:genus ?genus;
    FILTER(?type = "' . $getType . '").
    }';

    $result = $sparql_jena->query($sparql_query);

    if ($result):

        foreach ($result as $animal):
            $detail = [
                'nama' => $animal->nama,
                'comment' => $animal->comment,
                'detail' => $animal->detail,
                'img' => $animal->img,
                'id' => $animal->id,
                'taxon' => $animal->taxon,
                'phylum' => $animal->phylum,
                'class' => $animal->class,
                'order' => $animal->order,
                'family' => $animal->family,
                'genus' => $animal->genus,
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
                                <button onclick="showDetail('show<?= $detail['id'] ?>')" type="button" class="btn text-light px-5"
                                    style="background-color: #5B4608;">
                                    Details
                                </button>
                            </div>

                            <div class="z-2 visually-hidden" style="top: 0; left: 0; overflow: hidden;"
                                id="show<?= $detail['id'] ?>">
                                <div class="position-fixed w-100 h-100 z-3"
                                    style="top: 0; left: 0; backdrop-filter: blur(2px); -webkit-backdrop-filter: blur(2px); background-color: black; opacity: 0.8;">
                                </div>

                                <div class="d-flex grid-col-2 bg-white justify-content-between align-items-start position-absolute rounded-4 overflow-auto float w-100 z-3"
                                    style="top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <div class="position-relative"><img src="<?= $detail['img'] ?>" alt=""
                                            style="width: 650px; height: 400px;"></div>

                                    <div class="position-relative border-primary w-100">
                                        <div class="d-flex justify-content-between align-items-start px-2"
                                            style="background-color: #412702;">
                                            <p class="text-light my-auto fs-3 ps-4">
                                                <b style="font-family: 'Poppins', sans-serif;">
                                                    <?= strtoupper($detail['nama']) ?>
                                                </b>
                                            </p>
                                            <button onclick="showDetail('show<?= $detail['id'] ?>')"
                                                class="bg-transparent border-0 fs-1 pe-3 my-auto"
                                                style="color: white;"><b>&times;</b></button>
                                        </div>

                                        <div class="w-100 h-100 p-2 px-4"
                                            style="background-color:#F6EFE5; color: #5B4608; font-size: 14px;">
                                            <div class="overflow-auto w-100 py-2" style="max-height: 200px;">
                                                <?= $detail['detail'] ?>
                                            </div>
                                        </div>
                                        <div class="overflow-auto w-100 h-100 p-2 px-4" style="background-color:#F6EFE5; color: #5B4608; max-height: 120px;">
                                            <!-- line -->
                                            <div style="height: 1.5px; background-color: #5B4608;"></div>
                                            <!-- line -->

                                            <div class="tab mt-2">
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab1')">Taxon</button>
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab2')">Phylum</button>
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab3')">Class</button>
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab4')">Order</button>
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab5')">Family</button>
                                                <button class="tablink rounded-top-2" onclick="openTab('showTab6')">Genus</button>
                                            </div>

                                            <div id="showTab1" class="tabcontent rounded-bottom-2">
                                            <p class="p-2"><?=$detail['taxon']?></p>
                                            </div>

                                            <div id="showTab2" class="tabcontent rounded-2">
                                            <p class="p-2"><?=$detail['phylum']?></p> 
                                            </div>

                                            <div id="showTab3" class="tabcontent rounded-2">
                                            <p class="p-2"><?=$detail['class']?></p>
                                            </div>

                                            <div id="showTab4" class="tabcontent rounded-2">
                                            <p class="p-2">L<?=$detail['order']?></p>
                                            </div>

                                            <div id="showTab5" class="tabcontent rounded-2">
                                            <p class="p-2"><?=$detail['family']?></p> 
                                            </div>

                                            <div id="showTab6" class="tabcontent rounded-2">
                                            <p class="p-2"><?=$detail['genus']?></p>
                                            </div>

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

    function openTab(showTabID) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }

        document.getElementById(showTabID).style.display = "block";
        event.currentTarget.classList.add("active");
    }

</script>

<?php
include 'tata_letak/footer.php';
?>