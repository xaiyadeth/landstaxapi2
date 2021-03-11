<!DOCTYPE html>
<html>
<head>
  <title>PHP Retrieve Data from MySQL using Drop Down Menu</title>
</head>
<body>

<form>
  City:
  <select>
    <option disabled selected>-- Select City --</option>
    <?php
        include "DBconfig.php";  // Using database connection file here
        $records = pg_query($db, "SELECT * From province");  // Use select query here 

        while($data = pg_fetch_array($records))
        {
            echo "<option value='". $data['name_province_la'] ."'>" .$data['name_province_la'] ."</option>";  // displaying data in option menu
        }	
    ?>  
  </select>
</form>

<?php pg_close($db);  // close connection ?>

</body>
</html>