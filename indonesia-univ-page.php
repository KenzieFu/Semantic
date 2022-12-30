<?php


require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/html_tag_helpers.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('univ', 'https://example.org/schema/univ');
\EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');




$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');
$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/Universitas/sparql');
?>




<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="initial-scale=1, width=device-width" />
  <title></title>
  <meta name="description" content="" />

  <link rel="stylesheet" href="./public/css/global.css" />
  <link rel="stylesheet" href="./public/css/indonesia-univ-page.css" />
  <link rel="stylesheet" href="./public/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" />
</head>

<body>
  <div class="indonesiaunivpage-div">
    <div class="navigation-bar-div1" data-scroll-to="navigationBarContainer">
      <div class="innernavbar-div1">
        <button class="logo-button" id="logoButton">
          <img class="logo-icon3" alt="" src="public/logo.svg" />
          <div class="unisearch-div2">
            <span class="uni-span">Uni</span><span class="search-span1">Search</span>
          </div>
          <img class="logo-icon4" alt="" src="public/logo4.svg" />
        </button>
        <div class="menu-right-div1">
          <div class="menu-right-div1">
            <div class="menu-right-div1">
              <div class="search-around-the-world1 " id="searchAroundThe">
                Search Around the World
              </div>
              <div class="activelink-div">
                <div class="search-in-indonesia1">Search in Indonesia</div>
                <div class="rectangle-div2"></div>
              </div>
            </div>
            <div class="menu-div1">
              <img class="vector-icon3" alt="" src="public/vector.svg" /><img class="vector-icon3" alt="" src="public/vector1.svg" /><img class="vector-icon3" alt="" src="public/vector1.svg" />
            </div>
          </div>
          <button class="button-variant" id="buttonVariant">
            <div class="button-div1">Search</div>
          </button>
        </div>
      </div>
    </div>
    <div class="hero-div" data-scroll-to="heroContainer">
      <div class="herosection-div" data-scroll-to="heroSectionContainer">
        <div class="herocta-div">
          <div class="copywriting-div">
            <div class="rectangle-div3"></div>
            <div class="rectangle-div4"></div>
            <b class="discover-your-favourite-univer ">Discover Your Favourite University</b>
            <div class="lets-help-you-to-know-more-ab text-white">
              Let’s Help You To Know More About Your Favourite University
            </div>
            <div class="indonesia-div">(Indonesia)</div>
          </div>
      
        </div>
        <img class="woman-image-icon" alt="" src="public/pict.png" />
      </div>
  <?php

  $q='SELECT DISTINCT   *  WHERE {
    ?u rdf:type univ:ind;
       rdfs:label ?name;
       univ:abstract ?desc;
       univ:city     ?city;
       univ:established ?est;
       univ:rector ?rector.
     
       }';




  $result=$sparql_jena->query($q);
  
  
  ?>



      <div class="my-5  block mx-auto w-[90%] " >
        <h1 class=" font-bold">List Of University</h1>
        <div class="grid grid-cols-5 gap-5 mx-2 my-2">
          <?php foreach($result as $res) :?>
            <form action="./details.php" method="POST">
            <div class="w-[300px] h-[300px] border rounded-lg shadow-lg group" style="padding:5px ; ">
            <button  class="text-[25px] font-bold m-5"> <?=$res->name?></button>
            <div class="  m-5">
              <span class="text-bold text-xl block "><?=$res->city?></span>
              <span class="text-bold text-xl block"><?=$res->est?></span>
              <input type="hidden" name="nama_negara" value="Indonesia" >
              <input type="hidden" name="nama_univ" value="<?=$res->u ?>">
              
            </div>
            
          </div>
            </form>
            <?php endforeach;?>

        </div>
      </div>

    </div>





    <div class="brands-div">
      <div class="logo-div1">
        <img class="logo-icon3" alt="" src="public/logo5.svg" />
        <div class="unisearch-div3 ">UniSearch</div>
        <img class="logo-icon4" alt="" src="public/logo6.svg" />
      </div>
    </div>













    <?php
    ///////
    $all_univ = $sparql->query(
      'SELECT DISTINCT (COUNT(*) AS ?res)   WHERE {' .
        '  ?univ rdf:type dbo:University .' .
        '  ?univ dbo:abstract ?desc .' .
        ' ?univ dbp:country ?country .' .
        ' ?univ dbp:name ?nama .' .
        'FILTER langMatches (lang(?desc),"EN")' .
        'FILTER langMatches (lang(?nama),"EN")' .
        '}'
    );

    foreach ($all_univ as $res) {
      $all_univ = $res->res;
    }
    ////////////////////
    $indo_univ = $sparql->query(
      'SELECT DISTINCT   (COUNT(*) AS ?res)    WHERE {' .
        '  ?univ rdf:type dbo:University .' .
        '  ?univ dbo:abstract ?desc .' .
        '  ?univ dbp:name ?nama .' .
        ' ?univ dbp:country dbr:Indonesia .' .
        ' dbr:Indonesia dbp:commonName ?country .' .
        'FILTER langMatches (lang(?desc),"EN")' .
        'FILTER langMatches (lang(?nama),"EN")' .
        'FILTER langMatches (lang(?country),"EN")' .

        '}'
    );

    foreach ($indo_univ as $res) {
      $indo_univ = $res->res;
    }

    ?>









    <div class="totaluniversity-div">
      <div class="inner-div1">
        <div class="how-many-data-do-we-have-in-un">
          How many data do we have in UniSearch?
        </div>
        <div class="count-div">
          <div class="dataworld-div">
            <b class="b"><?= $all_univ ?></b>
            <div class="universities-data-around-the">
              Universities’ Data Around The World
            </div>
          </div>
          <div class="dataworld-div">
            <b class="b"><?= $indo_univ ?></b>
            <div class="universities-data-around-the">
              Universities’ Data in Indonesia
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-div1">
      <div class="innernavbar-div1">
        <div class="brandname-div1">
          <div class="unisearch-div4">UniSearch</div>
          <img class="logo-icon7" alt="" src="public/logo7.svg" />
        </div>
        <div class="links-div3">
          <div class="about-div1">
            <div class="about-us-div1">About Us</div>
            <div class="search-in-indonesia1">Kelompok 3 Web Semantik</div>
            <div class="search-in-indonesia1">Contact Us</div>
          </div>
          <div class="about-div1">
            <div class="about-us-div1">Quick Links</div>
            <a class="search-university-around-the-w1" href="./home-page.php" id="searchUniversityAround">Search University Around The World </a><a class="search-university-around-the-w1" id="searchUniversityIn">Search University in Indonesia</a>
          </div>
          <div class="more-div2">
            <div class="search-in-indonesia1">More</div>
            <div class="frame-div10">
              <div class="search-in-indonesia1">
                Kenzie Fubrianto | 211402139
              </div>
              <div class="search-in-indonesia1">
                Steven Valentino | 211402127
              </div>
              <div class="search-in-indonesia1">
                M. Ariyo Syahraza | 211402055
              </div>
              <div class="search-in-indonesia1">Nadya Zahra | 211402019</div>
              <div class="search-in-indonesia1">
                Raihan Jamilah R. Hasibuan | 211402022
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var logoButton = document.getElementById("logoButton");
    if (logoButton) {
      logoButton.addEventListener("click", function() {
        var anchor = document.querySelector("[data-scroll-to='heroContainer']");
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

    var buttonVariant = document.getElementById("buttonVariant");
    if (buttonVariant) {
      buttonVariant.addEventListener("click", function() {
        var anchor = document.querySelector(
          "[data-scroll-to='heroSectionContainer']"
        );
        if (anchor) {
          anchor.scrollIntoView({
            block: "start",
            behavior: "smooth"
          });
        }
      });
    }

    var buttonSearch = document.getElementById("buttonSearch");
    if (buttonSearch) {
      buttonSearch.addEventListener("click", function(e) {
        window.location.href = "./indonesia-univ-page.php";
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
      searchUniversityIn.addEventListener("click", function() {
        var anchor = document.querySelector(
          "[data-scroll-to='navigationBarContainer']"
        );
        if (anchor) {
          anchor.scrollIntoView({
            block: "start",
            behavior: "smooth"
          });
        }
      });
    }
  </script>
</body>

</html>