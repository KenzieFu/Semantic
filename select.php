<?php
    

    require_once realpath(__DIR__.'/.')."/vendor/autoload.php";
    require_once __DIR__."/html_tag_helpers.php";

    // Setup some additional prefixes for DBpedia
    \EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
    \EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
    \EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
    \EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
    \EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
    \EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');

    
  

    $sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');
?>
<html>
<head>
  <title>EasyRdf Basic Sparql Example</title>
 
 <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<?php
    $result=0;
    $resCountry=$sparql->query(
        'SELECT DISTINCT   ?country   WHERE {'.
        '?country rdf:type yago:WikicatMemberStatesOfTheUnitedNations .'.
        '} ORDER BY ?country '
    );

?>
<body>
<h1>EasyRdf Basic Sparql Example</h1>
<div>
    <h1>List of Countries</h1>
    <form id="" method="GET">
        <select name="country" >
            <?php
                foreach($resCountry as $row):
                    $listCountry=substr($row->country,28);
                    $listCountry=str_replace('_',' ',ucwords($listCountry));
            ?>
            <option value="<?= $listCountry?>"><?= $listCountry?></option>
            <?php endforeach;?>
        </select>
        <input type="submit">
    </form>
</div>


<?php
    if(isset($_GET['country'])){
        $getCountry=$_GET['country'];
        $getCountry=str_replace(' ','_',ucwords($getCountry));
        $result = $sparql->query(
            'SELECT DISTINCT   ?country ?nama   WHERE {'.
            '  ?univ rdf:type dbo:University .'.
            '  ?univ dbo:abstract ?desc .'.
            '  ?univ dbp:name ?nama .'.
            ' ?univ dbp:country dbr:'.$getCountry.' .'.
            ' dbr:'.$getCountry. ' dbp:commonName ?country .'.
            'FILTER langMatches (lang(?desc),"EN")'.
            'FILTER langMatches (lang(?nama),"EN")'.
            'FILTER langMatches (lang(?country),"EN")'.
          
            '} ORDER BY ?nama '
        );
    }
?>

<?php
    if($result):
?>
<h2>List of University</h2>

<h2><?=$getCountry?></h2>


<div class=" mb-3 mt-3" style="width:80% ; margin:auto;">
<table  style="width:100%;  font-weight:bold; " class="table table-striped table-bordered mydatatable">
    <thead style="font-size: 20px;" >
    <tr>
        <td>No</td>
        <td>Name</td>
       
        <td>Country</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
        <?php 
        $id=1;
        foreach ($result as $row):
            if($row->nama !=""):
        ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->nama?></td>
        <td><?=$row->country?></td>
        <td>Action</td>
    </tr>
    <?php $id++;?>
    <?php endif;?>
    <?php endforeach;?>
   
        
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
    <?php else:?>

    <?php endif;?>
</div>




    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script >
        $(".mydatatable").DataTable();
    </script>

</body>
</html>