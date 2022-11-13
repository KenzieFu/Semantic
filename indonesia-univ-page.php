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

    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
    />
  </head>
  <body>
    <div class="indonesiaunivpage-div">
      <div class="navigation-bar-div1" data-scroll-to="navigationBarContainer">
        <div class="innernavbar-div1">
          <button class="logo-button" id="logoButton">
            <img class="logo-icon3" alt="" src="public/logo.svg" />
            <div class="unisearch-div2">
              <span class="uni-span">Uni</span
              ><span class="search-span1">Search</span>
            </div>
            <img class="logo-icon4" alt="" src="public/logo4.svg" />
          </button>
          <div class="menu-right-div1">
            <div class="menu-right-div1">
              <div class="menu-right-div1">
                <div class="search-around-the-world1" id="searchAroundThe">
                  Search Around the World
                </div>
                <div class="activelink-div">
                  <div class="search-in-indonesia1">Search in Indonesia</div>
                  <div class="rectangle-div2"></div>
                </div>
              </div>
              <div class="menu-div1">
                <img class="vector-icon3" alt="" src="public/vector.svg" /><img
                  class="vector-icon3"
                  alt=""
                  src="public/vector1.svg"
                /><img class="vector-icon3" alt="" src="public/vector1.svg" />
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
              <b class="discover-your-favourite-univer"
                >Discover Your Favourite University</b
              >
              <div class="lets-help-you-to-know-more-ab">
                Let’s Help You To Know More About Your Favourite University
              </div>
              <div class="indonesia-div">(Indonesia)</div>
            </div>
            <div class="searchform-div">
              <div class="frame-div7">
                <div class="frame-div8">
                  <div class="frame-div9">
                    <div class="search-div1">
                      <img
                        class="search-icon1"
                        alt=""
                        src="public/search1.svg"
                      />
                    </div>
                    <div class="seach-your-favourite-universit">
                      Seach Your Favourite University
                    </div>
                  </div>
                  <button class="buttonsearch" id="buttonSearch">
                    <div class="search-div1">
                      <img
                        class="search-icon1"
                        alt=""
                        src="public/search2.svg"
                      />
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <img class="woman-image-icon" alt="" src="public/image-11@2x.png" />
        </div>
      </div>
      <div class="brands-div">
        <div class="logo-div1">
          <img class="logo-icon3" alt="" src="public/logo5.svg" />
          <div class="unisearch-div3">UniSearch</div>
          <img class="logo-icon4" alt="" src="public/logo6.svg" />
        </div>
      </div>
      <div class="totaluniversity-div">
        <div class="inner-div1">
          <div class="how-many-data-do-we-have-in-un">
            How many data do we have in UniSearch?
          </div>
          <div class="count-div">
            <div class="dataworld-div">
              <b class="b">2.000</b>
              <div class="universities-data-around-the">
                Universities’ Data Around The World
              </div>
            </div>
            <div class="dataworld-div">
              <b class="b">20</b>
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
              <a
                class="search-university-around-the-w1"
                href="./home-page.php"
                id="searchUniversityAround"
                >Search University Around The World </a
              ><a
                class="search-university-around-the-w1"
                id="searchUniversityIn"
                >Search University in Indonesia</a
              >
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
        logoButton.addEventListener("click", function () {
          var anchor = document.querySelector("[data-scroll-to='heroContainer']");
          if (anchor) {
            anchor.scrollIntoView({ block: "start", behavior: "smooth" });
          }
        });
      }
      
      var searchAroundThe = document.getElementById("searchAroundThe");
      if (searchAroundThe) {
        searchAroundThe.addEventListener("click", function (e) {
          window.location.href = "./home-page.php";
        });
      }
      
      var buttonVariant = document.getElementById("buttonVariant");
      if (buttonVariant) {
        buttonVariant.addEventListener("click", function () {
          var anchor = document.querySelector(
            "[data-scroll-to='heroSectionContainer']"
          );
          if (anchor) {
            anchor.scrollIntoView({ block: "start", behavior: "smooth" });
          }
        });
      }
      
      var buttonSearch = document.getElementById("buttonSearch");
      if (buttonSearch) {
        buttonSearch.addEventListener("click", function (e) {
          window.location.href = "/";
        });
      }
      
      var searchUniversityAround = document.getElementById("searchUniversityAround");
      if (searchUniversityAround) {
        searchUniversityAround.addEventListener("click", function (e) {
          window.location.href = "./home-page.php";
        });
      }
      
      var searchUniversityIn = document.getElementById("searchUniversityIn");
      if (searchUniversityIn) {
        searchUniversityIn.addEventListener("click", function () {
          var anchor = document.querySelector(
            "[data-scroll-to='navigationBarContainer']"
          );
          if (anchor) {
            anchor.scrollIntoView({ block: "start", behavior: "smooth" });
          }
        });
      }
      </script>
  </body>
</html>