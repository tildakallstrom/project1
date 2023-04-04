<?php
include('includes/header.php');
?>
<div class="intro">
  <h1>Mina resor</h1>
  <p>Välkommen till sidan för mina resor. Här kan du klicka på valt registreringsnummer för att se all info om den aktuella bilen. Du kan också välja att söka efter en specifik bil eller se tabellen över information från samtliga bilar.</p>
</div>
<div class="cars">
  <p class="centerp">Klicka på vald bil för att se mer information:</p>
  <ul class="grids">
    <?php
    $route = new Routes();
    $carlist = $route->getLicenseplates();
    foreach ($carlist as $newlicense) {
      echo "
        <li><a href='car.php?licenseplate=" . $newlicense['licensePlate'] . "' class='readmore'>" . $newlicense['licensePlate'] . "</a></li>
     ";
    }
    ?>
  </ul>
</div>
<div class='searchfor'>
  <form method="post" action="#">
    <label for="searchcriteria">Sök efter registreringsnummer: </label><br>
    <input type="text" name="searchcriteria" id="searchcriteria" class="search">
    <input type="submit" value="Sök" name="search" class="btn">
  </form>
</div>
<h2>Rutter:</h2>

<main>
  <div class="pagination">

    <button class="backward" id="first">Första</button>
    <button class="backward" id="prev"> &lt;&lt; </button>
    <button class="forward" id="next"> &gt;&gt; </button>
    <button class="forward" id="last">Sista</button><br>

  </div>
  <div>
    <div class="page-numbers" id="pageNumbers"></div>
  </div>
  <div class="table-wrapper" tabindex="0">
    <table id="paginatedTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Registreringsnummer</th>
          <th>Starttid</th>
          <th>Sluttid</th>
          <th>Distans</th>
          <th>Restid</th>
          <th>Startadress</th>
          <th>Stoppadress</th>
          <th>Restyp</th>
          <th>Liter</th>
          <th>Kostnad</th>
          <th>Start latitud</th>
          <th>Start longitud</th>
          <th>Slut latitud</th>
          <th>Slut longitud</th>
          <th>Odometer start</th>
          <th>Odometer stop</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $route = new Routes();
        if (isset($_POST['search'])) {
          if (!empty($_REQUEST['searchcriteria'])) {

            $routelist = $route->searchCar();
            foreach ($routelist as $newcar) {
              echo "<tbody>
        <tr class='hidden'>
        <td class='numeric'>" . $newcar['routeId'] . "</td>
        <td class='numeric'>" . $newcar['licensePlate'] . "</td>
        <td class='numeric'>" . $newcar['timeStart'] . "</td>
        <td class='numeric'>" . $newcar['timeEnd'] . "</td>
        <td class='numeric'>" . $newcar['distance'] . "</td>
        <td class='numeric'>" . $newcar['travelTime'] . "</td>
        <td class='numeric'>" . $newcar['startAddress'] . "</td>
        <td class='numeric'>" . $newcar['stopAddress'] . "</td>
        <td class='numeric'>" . $newcar['routeType'] . "</td>
        <td class='numeric'>" . $newcar['liters'] . "</td>
        <td class='numeric'>" . $newcar['cost'] . "</td>
        <td class='numeric'>" . $newcar['firstLat'] . "</td>
        <td class='numeric'>" . $newcar['firstLon'] . "</td>
        <td class='numeric'>" . $newcar['lastLat'] . "</td>
        <td class='numeric'>" . $newcar['lastLon'] . "</td>
        <td class='numeric'>" . $newcar['odometerStart'] . "</td>
        <td class='numeric'>" . $newcar['odometerStop'] . "</td>
        </tr>";
            }
          }
        }

        $routelist = $route->getRoutes();
        foreach ($routelist as $newroute) {
          echo "
        <tr class='hidden'>
        <td class='numeric'>" . $newroute['routeId'] . "</td>
        <td class='numeric'>" . $newroute['licensePlate'] . "</td>
        <td class='numeric'>" . $newroute['timeStart'] . "</td>
        <td class='numeric'>" . $newroute['timeEnd'] . "</td>
        <td class='numeric'>" . $newroute['distance'] . "</td>
        <td class='numeric'>" . $newroute['travelTime'] . "</td>
        <td class='numeric'>" . $newroute['startAddress'] . "</td>
        <td class='numeric'>" . $newroute['stopAddress'] . "</td>
        <td class='numeric'>" . $newroute['routeType'] . "</td>
        <td class='numeric'>" . $newroute['liters'] . "</td>
        <td class='numeric'>" . $newroute['cost'] . "</td>
        <td class='numeric'>" . $newroute['firstLat'] . "</td>
        <td class='numeric'>" . $newroute['firstLon'] . "</td>
        <td class='numeric'>" . $newroute['lastLat'] . "</td>
        <td class='numeric'>" . $newroute['lastLon'] . "</td>
        <td class='numeric'>" . $newroute['odometerStart'] . "</td>
        <td class='numeric'>" . $newroute['odometerStop'] . "</td>
        </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</main>
<?php
include('includes/footer.php');