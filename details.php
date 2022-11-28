<?php


require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/html_tag_helpers.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/Graph.php";
require_once __DIR__ . "/vendor/easyrdf/easyrdf/lib/GraphStore.php";


// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
\EasyRdf\RdfNamespace::set('geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');






$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');
?>



<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title></title>
  <meta name="description" content="" />

  <link rel="stylesheet" href="./public/css/global.css" />
  <link rel="stylesheet" href="./public/css/index.css" />
  <link rel="stylesheet" href="./public/css/output.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

     
 <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
</head>

<body>
  <?php
    $univ=str_replace(' ', '_',(trim($_POST['nama_univ'])));


  $q = 'SELECT DISTINCT    ?nama ?descs ?rector ?motto ?wiki ?lat ?long   WHERE {' .
    '  dbr:'.$univ.' rdf:type dbo:University;' .
    '   dbo:abstract ?descs ;' .
    '   rdfs:label ?nama .' .
    'FILTER langMatches (lang(?descs),"EN")' .
    'FILTER langMatches (lang(?nama),"EN")' .

    'OPTIONAL{ dbr:'.$univ.' foaf:isPrimaryTopicOf ?wiki .
        dbr:'.$univ.' dbp:motto ?motto .
         dbr:'.$univ.' dbp:rector ?rector .
         dbr:'.$univ.' geo:lat ?lat .
         dbr:'.$univ.' geo:long ?long .
        } '.
    '} LIMIT 1 ';


  $results = $sparql->query($q);
  $details = [];
  echo $q;
  foreach ($results as $row) {
      
        $details = [
          "nama" => $row->nama,
          
          "rector" => $row->rector ?? null,
          "desc"=>$row->descs??null,
          "motto"=>$row->motto ??null,
          "wiki"=>$row->wiki ??null ,
          "lat"=>$row->lat??null,
          "long"=>$row->long ?? null,

         
        ];
        break;
      }
    

  
  if(!empty($details['wiki']))
  {
    \EasyRdf\RdfNamespace::setDefault('og');
    $wiki= \EasyRdf\Graph::newAndLoad($details['wiki']);
    $foto_url =$wiki->image;
  }
  else
    $foto_url="public/default.png"

  
 


  ?>
  <div class="descriptionpage-div">
    <div class="navigation-bar-div">
      <div class="innernavbar-div">
        <div class="logo-div" id="logoContainer">
          <img class="logo-icon" alt="" src="public/logo.svg" />
          <div class="unisearch-div">
            <span>Uni</span><span class="search-span">Search</span>
          </div>
          <img class="logo-icon1" alt="" src="public/logo1.svg" />
        </div>
        <div class="menu-right-div">
          <div class="linkscontainer-div">
            <div class="linkscontainer-div">
              <div class="search-around-the-world " id="searchAroundThe">
                Search Around the World
              </div>
              <div class="search-around-the-world" id="searchInIndonesia">
                Search in Indonesia
              </div>
            </div>
            <div class="menu-div">
              <img class="vector-icon" alt="" src="public/vector.svg" /><img class="vector-icon" alt="" src="public/vector1.svg" /><img class="vector-icon" alt="" src="public/vector1.svg" />
            </div>
          </div>
          <div class="button-variant-div" id="buttonVariantContainer">
            <div class="button-div">Search</div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-div" data-scroll-to="mainContainer">
      <div class="innermain-div">
        <div class="searchresult-div">
          <div class="search-div">
            <img class="search-icon" alt="" src="public/search.svg" />
          </div>
          <div class="show-results-for-university-n">
            Show Results for <?=$details['nama']?>
          </div>
        </div>
        <div class="maininfo-div">
          <div class="universityname-div">
            <b class="harvard-university-b"><?=$details['nama']?></b>
            <div class="rectangle-div"></div>
          </div>
          <div class="frame-div">
            <div class="maindesc-div text-xl">
              <div class="harvard-university-is-a-privat ">
                <p >
                  <?= $details['desc'] ?>
                </p>
              
             
              </div>
            </div>
            <div class="details-div">
              <div class="innerdetails-div">
                <img class="image-1-icon" alt="" src="<?=$foto_url?>" />
                <div class="detailssection-div">
                  <div class="universityname-div">
                    <div class="harvard-university-div">
                      <?=$details['nama']?>
                    </div>
                    <div class="rectangle-div1"></div>
                  </div>
                
                  <div class="body-div">
                  <?php if(!is_null($details['rector'])) : ?>
                    <div class="row1-div">
                      <div class="show-results-for-university-n">
                        President
                      </div>
                      <div class="frame-div1">
                        <div class="show-results-for-university-n">:</div>
                        <div class="show-results-for-university-n">
                          <?=$details['rector']?>
                        </div>
                      </div>
                    </div>
                    <?php endif;?>
                    <?php if(!is_null($details['motto'])) : ?>
                    <div class="row1-div">
                      <div class="show-results-for-university-n">Motto</div>
                      <div class="frame-div1">
                        <div class="show-results-for-university-n">:</div>
                        <div class="show-results-for-university-n">
                          <?=$details['motto']?>
                        </div>
                      </div>
                    </div>
                    <?php endif;?>
                    <div class="row1-div">
                      <div class="show-results-for-university-n">Country</div>
                      <div class="frame-div1">
                        <div class="show-results-for-university-n">:</div>
                        <div class="show-results-for-university-n"><?= $_POST['nama_negara']?></div>
                      </div>
                    </div>
                   
                  </div>
                  <div id="map" class=" h-[300px] w-[100%]"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-div">
      <div class="innernavbar-div">
        <div class="brandname-div">
          <div class="unisearch-div1">UniSearch</div>
          <img class="logo-icon2" alt="" src="public/logo2.svg" />
        </div>
        <div class="links-div1">
          <div class="about-div">
            <div class="about-us-div">About Us</div>
            <div class="kelompok-3-web-semantik">Kelompok 3 Web Semantik</div>
            <div class="kelompok-3-web-semantik">Contact Us</div>
          </div>
          <div class="about-div">
            <div class="about-us-div">Quick Links</div>
            <div class="search-around-the-world" id="searchUniversityAround">
              Search University Around The World
            </div>
            <div class="search-around-the-world" id="searchUniversityIn">
              Search University in Indonesia
            </div>
          </div>
          <div class="more-div">
            <div class="kelompok-3-web-semantik">More</div>
            <div class="frame-div6">
              <div class="kelompok-3-web-semantik">
                Kenzie Fubrianto | 211402139
              </div>
              <div class="kelompok-3-web-semantik">
                Steven Valentino | 211402127
              </div>
              <div class="kelompok-3-web-semantik">
                M. Ariyo Syahraza | 211402055
              </div>
              <div class="kelompok-3-web-semantik">
                Nadya Zahra | 211402019
              </div>
              <div class="kelompok-3-web-semantik">
                Raihan Jamilah R. Hasibuan | 211402022
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var logoContainer = document.getElementById("logoContainer");
    if (logoContainer) {
      logoContainer.addEventListener("click", function() {
        var anchor = document.querySelector("[data-scroll-to='mainContainer']");
        if (anchor) {
          anchor.scrollIntoView({
            block: "start",
            behavior: "smooth"
          });
        }
      });
    }

    var searchAroundThe = document.getElementById("searchAroundThe");
    if (searchAroundThe) {
      searchAroundThe.addEventListener("click", function(e) {
        window.location.href = "./";
      });
    }

    var searchInIndonesia = document.getElementById("searchInIndonesia");
    if (searchInIndonesia) {
      searchInIndonesia.addEventListener("click", function(e) {
        window.location.href = "./indonesia-univ-page.php";
      });
    }

    var buttonVariantContainer = document.getElementById("buttonVariantContainer");
    if (buttonVariantContainer) {
      buttonVariantContainer.addEventListener("click", function(e) {
        window.location.href = "./";
      });
    }

    var searchUniversityAround = document.getElementById("searchUniversityAround");
    if (searchUniversityAround) {
      searchUniversityAround.addEventListener("click", function(e) {
        window.location.href = "./";
      });
    }

    var searchUniversityIn = document.getElementById("searchUniversityIn");
    if (searchUniversityIn) {
      searchUniversityIn.addEventListener("click", function(e) {
        window.location.href = "./indonesia-univ-page.php";
      });
    }
  </script>
  <script>
    var map = L.map('map');
    /* map.setView([$details['lat'],$details['long']], 13); */
    map.setView([<?=$details['lat']?>,<?=$details['long']?>], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([<?=$details['lat']?>,<?=$details['long']?>]).addTo(map);
  </script>
</body>

</html>