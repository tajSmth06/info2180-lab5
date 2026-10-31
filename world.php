<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", 'lab5_user', 'password123');
$country= isset($_GET['country']) ? trim($_GET['country']): '';
$lookup = isset($_GET['lookup']) ? trim($_GET['lookup']) : '';
$lookupcities= isset($_GET['lookupcities']) ? $_GET['lookupcities'] : '';

if($lookupcities == 'cities'){
  $stmt = $conn->prepare("SELECT cities.name AS name, cities.district AS district, cities.population AS population
  FROM cities
  JOIN countries ON cities.country_code = countries.code 
  WHERE countries.name LIKE :country ");

  $stmt->execute(['country' => '%' . $country . '%']);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>District</th>
        <th>Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $row): ?>
      <tr>
        <td><?= $row['name']; ?></td>
        <td><?= $row['district']; ?></td>
        <td><?= $row['population']; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php
  }
  else{
    if($country !== ''){
      $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country ");
      $stmt->execute(['country'=> '%' . $country . '%']);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      }else{       
        $stmt = $conn->query("SELECT * FROM countries");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        ?>
        <table>
          <thead>
            <tr> 
              <th>Name</th>
              <th>Continent</th>
              <th>Independence</th>
              <th> Head of State </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($results as $row): ?>
              <tr>
                <td> <?= $row['name']; ?></td>
                
                <td> <?= $row['continent']; ?> </td>
      
                <td> <?= $row['independence_year']; ?> </td>
      
                <td> <?=$row['head_of_state']; ?> </td>
    
              </tr>
              <?php endforeach; ?>
    
            </tbody>

        </table>
        <?php
  }
  ?>
