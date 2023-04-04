<?php
include('includes/header.php');
if (isset($_GET['licenseplate'])) {
  $licenseplate = $_GET['licenseplate'];
  echo "<h1> $licenseplate </h1>";
} else {
  header('Location: index.php');
}
?>
<p class="centera"><a href="https://tildakallstrom.se/arbetsprov/arbetsprov/">Tillbaka till listning av samtliga rutter &lt;&lt;</a></p>
<div class="total">
  <?php
  $route = new Routes();
  $routelist = $route->getSum();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Den totala distansen för denna bil är: <br>" . $newroute['total'] . " km.</p>";
  }

  $routelist = $route->getSumTime();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Den totala tiden för denna bil är: <br>" . $newroute['totaltime'] . " min.</p>";
  }

  $routelist = $route->getSumLiters();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Den totala bränsleåtgången för denna bil är: <br>" . $newroute['totalliters'] . " liter.</p>";
  }

  $routelist = $route->getSumCost();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Den totala resekostnaden för denna bil är: <br>" . $newroute['totalcost'] . " kr.</p>";
  }

  $routelist = $route->getTjansteresa();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Antal tjänsteresor som gjorts i denna bil: <br>" . $newroute['tjansteresa'] . " st.</p>";
  }

  $routelist = $route->getPrivatresa();
  foreach ($routelist as $newroute) {
    echo "<p class='totalp'>Antal privata resor som gjorts i denna bil: <br>" . $newroute['privatresa'] . " st.</p>";
  }
  ?>
</div>
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
        $routelist = $route->getRoutesFromThisCar();
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
?>