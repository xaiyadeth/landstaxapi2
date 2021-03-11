<?php

include 'DBconfig.php';

if(isset($_POST['search']))
{
    if(!empty($_POST['valueToSearch'])){
        
    // ຈະເຮັດວຽກຕອນທີ່ມີການພິມຂໍ້ມູນໃສ່ ປ່ອງ search
    $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,lands.*
    FROM lands
    INNER JOIN province
    ON lands.address_province=province.id_province
    INNER JOIN district
    ON lands.address_district=district.id_district and lands.address_province=district.id_province
    INNER JOIN village
    ON lands.address_village=village.id_village and lands.address_district=village.id_district and lands.address_province=village.id_province
    Where id=".$_POST['valueToSearch'].""; 
    $result = pg_query($db,$query);
    }else{
        // ຈະເຮັດວຽກຕອນທີ່ ບໍ່ມີການພິມຂໍ້ມູນໃສ່ ປ່ອງ search
        $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,lands.*
        FROM lands
        INNER JOIN province
        ON lands.address_province=province.id_province
        INNER JOIN district
        ON lands.address_district=district.id_district and lands.address_province=district.id_province
        INNER JOIN village
        ON lands.address_village=village.id_village and lands.address_district=village.id_district and lands.address_province=village.id_province
        "; 
        $result = pg_query($db,$query); 
    }
   
}else{
    
    // ຈະເຮັດວຽກໃນຕອນ ໂຫຼດໜ້າຟອມ ເທື່ອທຳອິດ
    $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,lands.*
    FROM lands
    INNER JOIN province
    ON lands.address_province=province.id_province
    INNER JOIN district
    ON lands.address_district=district.id_district and lands.address_province=district.id_province
    INNER JOIN village
    ON lands.address_village=village.id_village and lands.address_district=village.id_district and lands.address_province=village.id_province
    "; 
    $result = pg_query($db,$query);
}




?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme" disabled>
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme">


    <script src="js/jquery.min.js"></script>
    


  </head>
    <body>
        
        <form action="tabletest.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
            <!-- <input type="submit" name="search" value="Filter"><br><br> -->
            <button type="submit" name="search" class="btn btn-primary fe fe-search fe-16">  ຄົ້ນຫາ</button>
            
            <table class="table datatables" id="dataTable-1">
            <thead>
                <tr>
                <th>dtype</th>
                <th>id</th>
                <th>created at</th>
                <th>updated at</th>
                <th>ແຂວງ</th>
                <th>ເມືອງ</th>
                <th>ບ້ານ</th>
                <th>date issued</th>
                <th>land area number</th>
                <th>land map number</th>
                <th>owner id</th>
                <th>total land area m2</th>
                <th>tax paid</th>
                </tr>
            </thead>
            <tbody >

      <!-- populate table from mysql database -->
                <?php while($row = pg_fetch_assoc($result)):?>
                <tr>
                    <td><?php echo $row['dtype'];?></td>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['created_at'];?></td>
                    <td><?php echo $row['updated_at'];?></td>
                    <td><?php echo $row['name_province_la'];?></td>
                    <td><?php echo $row['name_district_la'];?></td>
                    <td><?php echo $row['name_village_la'];?></td>
                    <td><?php echo $row['date_issued'];?></td>
                    <td><?php echo $row['land_area_number'];?></td>
                    <td><?php echo $row['land_map_number'];?></td>
                    <td><?php echo $row['owner_id'];?></td>
                    <td><?php echo $row['total_land_area_m2'];?></td>
                    <td><?php echo $row['tax_paid'];?></td>
                </tr>
                <?php endwhile;?>
            </tbody>
            </table>
        </form>
          
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src='js/jquery.dataTables.min.js'></script>
    <script src='js/dataTables.bootstrap4.min.js'></script>

    <!-- ໃຊ້ໄວ້ສຳຫຼັບ datetimepicker -->
    <script src='js/select2.min.js'></script>
    <script src='js/daterangepicker.js'></script>
    <!-- --------- -->
   
    
    
    

    <script>
      $('#dataTable-1').DataTable(
      {
        autoWidth: false,
        "lengthMenu": [
          [5, 16, 32, 64, -1],
          [5, 16, 32, 64, "All"]
        ]
      });
    </script>

    <script src="js/apps.js"></script>
    

    </body>
</html>
