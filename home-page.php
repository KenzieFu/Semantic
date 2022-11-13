<?php


require_once realpath(__DIR__ . '/.') . "/vendor/autoload.php";
require_once __DIR__ . "/html_tag_helpers.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');




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
  <link rel="stylesheet" href="./public/css/home-page.css" />
  <link rel="stylesheet" href="./public/css/output.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" />
</head>

<body>
  <div class="homepage-div">
    <div class="navigation-bar-div2">
      <div class="innernavbar-div2">
        <button class="logo-button1" id="logoButton">
          <img class="logo-icon8" alt="" src="public/logo.svg" />
          <div class="unisearch-div5">
            <span class="uni-span1">Uni</span><span class="search-span2">Search</span>
          </div>
          <img class="logo-icon9" alt="" src="public/logo4.svg" />
        </button>
        <div class="menu-right-div2">
          <div class="menu-right-div2">
            <div class="menu-right-div2">
              <div class="activelink-div1">
                <div class="search-around-the-world2">
                  Search Around The World
                </div>
                <div class="rectangle-div5"></div>
              </div>
              <div class="search-in-indonesia2" id="searchInIndonesia">
                Search in Indonesia
              </div>
            </div>
            <div class="menu-div2">
              <img class="vector-icon6" alt="" src="public/vector.svg" /><img class="vector-icon6" alt="" src="public/vector1.svg" /><img class="vector-icon6" alt="" src="public/vector1.svg" />
            </div>
          </div>
          <button class="button-variant1" id="buttonVariant">
            <div class="button-div2">Search</div>
          </button>
        </div>
      </div>
    </div>
    <div class="hero-div1">
      <div class="herosection-div1">
        <div class="herocta-div1">
          <div class="copywriting-div1">
            <div class="rectangle-div6"></div>
            <div class="rectangle-div7"></div>
            <b class="discover-your-favourite-univer1">Discover Your Favourite University</b>
            <div class="lets-help-you-to-know-more-ab1">
              Let’s Help You To Know More About Your Favourite University
            </div>
          </div>
          <form method="GET" class="searchform">
            <div class="frame-div11">
              <div class="frame-div12">
                <div class="frame-div13">
                  <div class="search-div3">
                    <img class="search-icon3" alt="" src="public/search3.svg" />
                  </div>
                  <div class="seach-your-favourite-universit1">

                    <input name="country" class="focus:outline-none  w-[100%]" type="text">


                  </div>
                </div>
                <button class="buttonsearch1"  id="buttonSearch">
                  <div class="search-div4">
                    <img class="search-icon4" alt="" src="public/search2.svg" />
                  </div>
                </button>
              </div>
            </div>
          </form>
        </div>
        <img class="woman-image-icon1" alt="" src="public/image-11@2x.png" />
      </div>
    </div>


    <?php
      $result="";
    if (isset($_GET['country'])) {
      $getCountry = $_GET['country'];
      $getCountry = str_replace(' ', '_', ucwords($getCountry));
      $result = $sparql->query(
        'SELECT DISTINCT   ?country ?nama   WHERE {' .
          '  ?univ rdf:type dbo:University .' .
          '  ?univ dbo:abstract ?desc .' .
          '  ?univ dbp:name ?nama .' .
          ' ?univ dbp:country dbr:' . $getCountry . ' .' .
          ' dbr:' . $getCountry . ' dbp:commonName ?country .' .
          'FILTER langMatches (lang(?desc),"EN")' .
          'FILTER langMatches (lang(?nama),"EN")' .
          'FILTER langMatches (lang(?country),"EN")' .

          '} ORDER BY ?nama '
      );
    }
    ?>

    <?php 
      if($result):
    ?>
    <div class="my-5 w-[80%] m-auto">
      <table id="example" class="table table-striped text-[25px] " style="width:100%">
        <thead>
          <tr>
            <td>No</td>
            <td>Name</td>

            <td>Country</td>
            <td>Action</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $id = 1;
          foreach ($result as $row) :
            if ($row->nama != "") :
          ?>
              <tr class="p-2">
                <td><?= $id ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->country ?></td>
                <td>
                  <form>
                    <input type="hidden" name="nama_univ" value="<?=$row->nama?>" />
                    <input type="hidden" name="nama_negara" value="<?=$row->country?>" />
                      <button class="bg-green-500 p-2 rounded-lg text-white text-lg"> ACTION</button>
                  </form>
                  
                  </td>
              </tr>
              <?php $id++; ?>
            <?php endif; ?>
          <?php endforeach; ?>


        </tbody>
        <tfoot>
          <tr>
            <td>No</td>
            <td>Name</td>

            <td>Country</td>
            <td>Action</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <?php endif; ?>



    <div class="brands-div1">
      <div class="logo-div2">
        <img class="logo-icon8" alt="" src="public/logo5.svg" />
        <div class="unisearch-div6">UniSearch</div>
        <img class="logo-icon9" alt="" src="public/logo11.svg" />
      </div>
    </div>

    <?php
    ///////
      $all_univ=$sparql->query(
        'SELECT DISTINCT (COUNT(*) AS ?res)   WHERE {' .
          '  ?univ rdf:type dbo:University .' .
          '  ?univ dbo:abstract ?desc .' .
          ' ?univ dbp:country ?country .' .
          ' ?univ dbp:name ?nama .' .
          'FILTER langMatches (lang(?desc),"EN")' .
          'FILTER langMatches (lang(?nama),"EN")' .
          '}'
        );

        foreach($all_univ as $res)
        {
          $all_univ=$res->res;
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

      foreach($indo_univ as $res)
      {
        $indo_univ=$res->res;
      }

    ?>




    <div class="totaluniversity-div1">
      <div class="inner-div3">
        <div class="how-many-data-do-we-have-in-un1">
          How many data do we have in UniSearch?
        </div>
        <div class="count-div1">
          <div class="dataworld-div1">
            <b class="b2"><?=$all_univ ?></b>
            <div class="universities-data-around-the1">
              Universities’ Data Around The World
            </div>
          </div>
          <div class="dataworld-div1">
            <b class="b2"><?=$indo_univ?></b>
            <div class="universities-data-around-the1">
              Universities’ Data in Indonesia
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-div2">
      <div class="innernavbar-div2">
        <button class="brandname-button">
          <div class="unisearch-div7">UniSearch</div>
          <img class="logo-icon12" alt="" src="public/logo7.svg" />
        </button>
        <div class="links-div5">
          <div class="about-div2">
            <div class="about-us-div2">About Us</div>
            <div class="search-around-the-world2">
              Kelompok 3 Web Semantik
            </div>
            <div class="search-around-the-world2">Contact Us</div>
          </div>
          <div class="about-div2">
            <div class="about-us-div2">Quick Links</div>
            <a class="search-university-around-the-w2">Search University Around The World </a><a class="search-university-in-indonesia2" href="./public/css/indonesia-univ-page.php" id="searchUniversityIn">Search University in Indonesia</a>
          </div>
          <div class="more-div4">
            <div class="search-around-the-world2">More</div>
            <div class="frame-div14">
              <div class="search-around-the-world2">
                Kenzie Fubrianto | 211402139
              </div>
              <div class="search-around-the-world2">
                Steven Valentino | 211402127
              </div>
              <div class="search-around-the-world2">
                M. Ariyo Syahraza | 211402055
              </div>
              <div class="search-around-the-world2">
                Nadya Zahra | 211402019
              </div>
              <div class="search-around-the-world2">
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

    var searchInIndonesia = document.getElementById("searchInIndonesia");
    if (searchInIndonesia) {
      searchInIndonesia.addEventListener("click", function(e) {
        window.location.href = "./indonesia-univ-page.php";
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
        window.location.href = "/";
      });
    }

    var searchUniversityIn = document.getElementById("searchUniversityIn");
    if (searchUniversityIn) {
      searchUniversityIn.addEventListener("click", function(e) {
        window.location.href = "./indonesia-univ-page.php";
      });
    }
  </script>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>