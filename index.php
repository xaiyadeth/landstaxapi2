<?php session_start();?>
<?php 
 
if (!$_SESSION["username"]){  //check session
 
	  Header("Location: login.php"); //ไม่พบผู้ใช้กระโดดกลับไปหน้า login form 
 
}?>
<?php

include 'DBconfig.php';

if(isset($_POST['search']))
{
    if(!empty($_POST['nameprovince'])){ 
      $nameprovinceshow = $_POST['nameprovince'];
    // ຈະເຮັດວຽກຕອນທີ່ມີການ ເລືອກແຂວງ
    $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
    FROM landtax_api_lands
    INNER JOIN province
    ON landtax_api_lands.address_province=province.id_province
    INNER JOIN district
    ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
    INNER JOIN village
    ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
    Where address_province=".$_POST['nameprovince'].""; 
    $result = pg_query($db,$query);
    
    
    }
    if(!empty($_POST['namedistrict'])){
        
      // ຈະເຮັດວຽກຕອນທີ່ມີການ ເລືອກເມືອງ
      $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
      FROM landtax_api_lands
      INNER JOIN province
      ON landtax_api_lands.address_province=province.id_province
      INNER JOIN district
      ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
      INNER JOIN village
      ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
      Where address_province=".$_POST['nameprovince']." and address_district=".$_POST['namedistrict'].""; 
      $result = pg_query($db,$query);
      }
    if(!empty($_POST['namevillage'])){
        
      // ຈະເຮັດວຽກຕອນທີ່ມີການ ເລືອກບ້ານ
      $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
      FROM landtax_api_lands
      INNER JOIN province
      ON landtax_api_lands.address_province=province.id_province
      INNER JOIN district
      ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
      INNER JOIN village
      ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
      Where address_province=".$_POST['nameprovince']." and address_district=".$_POST['namedistrict']." and address_village=".$_POST['namevillage'].""; 
      $result = pg_query($db,$query);
      }
      if(empty($_POST['nameprovince'])){
        // ຈະເຮັດວຽກຕອນທີ່ ບໍ່ມີການພິມຂໍ້ມູນໃສ່ ປ່ອງ search
        $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
        FROM landtax_api_lands
        INNER JOIN province
        ON landtax_api_lands.address_province=province.id_province
        INNER JOIN district
        ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
        INNER JOIN village
        ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
        "; 
        $result = pg_query($db,$query); 
        }
        if(!empty($_POST['datestart'] and $_POST['datestop'])){                 
          // ຈະເຮັດວຽກຕອນທີ່ມີການ ຄົ້ນຫາຕາມວັນທີ
          $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
          FROM landtax_api_lands
          INNER JOIN province
          ON landtax_api_lands.address_province=province.id_province
          INNER JOIN district
          ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
          INNER JOIN village
          ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
          Where created_at between '".$_POST['datestart']." 00:00:00'  and '".$_POST['datestop']." 23:59:59' "; 
          $result = pg_query($db,$query);
          }
          if(!empty($_POST['datestart'] and $_POST['datestop'] and $_POST['nameprovince'])){                 
            // ຈະເຮັດວຽກຕອນທີ່ມີການ ຄົ້ນຫາຕາມວັນທີ ແລະ ເລືອກແຂວງ
            $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
            FROM landtax_api_lands
            INNER JOIN province
            ON landtax_api_lands.address_province=province.id_province
            INNER JOIN district
            ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
            INNER JOIN village
            ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
            Where created_at between '".$_POST['datestart']." 00:00:00'  and '".$_POST['datestop']." 23:59:59' and address_province=".$_POST['nameprovince'].""; 
            $result = pg_query($db,$query);
            }
            if(!empty($_POST['datestart'] and $_POST['datestop'] and $_POST['nameprovince'] and $_POST['namedistrict'])){                 
              // ຈະເຮັດວຽກຕອນທີ່ມີການ ຄົ້ນຫາຕາມວັນທີ ແລະ ເລືອກແຂວງ + ເມືອງ
              $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
              FROM landtax_api_lands
              INNER JOIN province
              ON landtax_api_lands.address_province=province.id_province
              INNER JOIN district
              ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
              INNER JOIN village
              ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
              Where created_at between '".$_POST['datestart']." 00:00:00'  and '".$_POST['datestop']." 23:59:59' and address_province=".$_POST['nameprovince']." and address_district=".$_POST['namedistrict'].""; 
              $result = pg_query($db,$query);
              }
              if(!empty($_POST['datestart'] and $_POST['datestop'] and $_POST['nameprovince'] and $_POST['namedistrict'] and $_POST['namevillage'])){                 
                // ຈະເຮັດວຽກຕອນທີ່ມີການ ຄົ້ນຫາຕາມວັນທີ ແລະ ເລືອກແຂວງ + ເມືອງ + ບ້ານ
                $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
                FROM landtax_api_lands
                INNER JOIN province
                ON landtax_api_lands.address_province=province.id_province
                INNER JOIN district
                ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
                INNER JOIN village
                ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
                Where created_at between '".$_POST['datestart']." 00:00:00'  and '".$_POST['datestop']." 23:59:59' and address_province=".$_POST['nameprovince']." and address_district=".$_POST['namedistrict']." and address_village=".$_POST['namevillage'].""; 
                $result = pg_query($db,$query);
                }
   
}else{
    
    // ຈະເຮັດວຽກໃນຕອນ ໂຫຼດໜ້າຟອມ ເທື່ອທຳອິດ
    $query = "SELECT province.name_province_la,district.name_district_la,village.name_village_la,landtax_api_lands.*
    FROM landtax_api_lands
    INNER JOIN province
    ON landtax_api_lands.address_province=province.id_province
    INNER JOIN district
    ON landtax_api_lands.address_district=district.id_district and landtax_api_lands.address_province=district.id_province
    INNER JOIN village
    ON landtax_api_lands.address_village=village.id_village and landtax_api_lands.address_district=village.id_district and landtax_api_lands.address_province=village.id_province
    "; 
    $result = pg_query($db,$query);
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Land tax</title>
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
    <script> //ຟັງຊັ້ນສຳລັບດຶງຂໍ້ມູນບ້ານເມືອງແຂວງ
      $(document).ready(function(){
          $('#province').on('change', function(){
              var provinceID = $(this).val();
              if(provinceID){
                  $.ajax({
                      type:'POST',
                      url:'ajaxData.php',
                      data:'id_province='+provinceID,
                      success:function(html){
                          $('#distrist').html(html);                           
                      }
                  }); 
              }else{
                  $('#distristD').html('<option value="">Select province first</option>');
                  
              }
          });
          
          $('#distrist').on('change', function(){ 
            var provinceIDsl = $('#province').val(); //ຖ້າຢາກເອົາຄ່າອື່ນມາໃຊ້ແມ່ນຕ້ອງກຳໜົດຢູ່ໂຕປ່ຽນໃຫ້ໄປຮັບຄ່າຢູ່ ໄອດີຂອງປຸ່ມນັ້ນ     
            var distristID = $(this).val();              
              if(distristID){
                  $.ajax({
                      type:'POST',
                      url:'ajaxData.php',                      
                      data:{data1:provinceIDsl,data2:distristID},
                      success:function(html){
                          $('#village').html(html);
                      }
                  }); 
              }else{
                  $('#village').html('<option value="">Select district first</option>'); 
              }
          });

             
        });
    </script>


  </head>
  <body class="vertical  dark  ">
    <div class="wrapper">
      <?php include 'topnavbar.php'; ?>
      <?php include 'sidebar.php'; ?>
      <form action="index.php" method="post">
        <main role="main" class="main-content">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-12">
                <h2 class="mb-2 page-title">ຂໍ້ມູນການຊໍາລະທີ່ດິນ</h2>
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">ຄົ້ນຫາ</strong>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <center><label for="inputState">ເລືອກແຂວງ</label></center>
                                <?php                              
                                  // Fetch all the country data 
                                  $query_p = "SELECT * FROM province order by id_province ASC"; 
                                  $result_p = pg_query($db,$query_p); 
                                ?>
                              <select name="nameprovince" id="province" class="form-control">
                                  <option value="">ເລືອກແຂວງ</option>
                                  <?php 
                                  if(pg_num_rows($result_p) > 0){ 
                                      while($row_p = pg_fetch_assoc($result_p)){ 
                                          echo '<option name="nameprovinceshow" value="'.$row_p['id_province'].'">'.$row_p['name_province_la'].'</option>'; 
                                  }
                                  }else{ 
                                      echo '<option value="">Country not available</option>'; 
                                  } 
                                
                                  ?>
                              </select>

                            </div>
                            <div class="form-group col-md-4">
                              <center><label for="inputState">ເລືອກເມືອງ</label></center>                           
                              
                              <select name="namedistrict" id="distrist" class="form-control">
                                <option value="">-</option>
                              </select>


                            </div>
                            <div class="form-group col-md-4">
                              <center><label for="inputState">ເລືອກບ້ານ</label></center>
                              <select name="namevillage" id="village" class="form-control">
                                <option value="">-</option>
                              </select>
                            </div>
                          

                            <div class="form-group col-md-4">
                              <center><label for="date-input1">ເລືອກວັນທີ ເລີ່ມຕົ້ນ</label></center>
                              <div class="input-group">
                              <input name="datestart" class="form-control" id="example-date" type="date" name="date" placeholder="dd-mm-yyyy">
                                
                              </div>
                            </div>
                            <div class="form-group col-md-4">
                              <center><label for="date-input1">ເລືອກວັນທີ ສິ້ນສຸດ</label></center>
                              <div class="input-group">
                              <input name="datestop" class="form-control" id="example-date" type="date" name="date">
                                
                              </div>
                            </div>


                          </div>
                          <!-- <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br> -->
                          <button type="submit" name="search" class="btn btn-primary fe fe-search fe-16">  ຄົ້ນຫາ</button>                                
                          <!-- <button type="button" class="btn btn-primary fe fe-search fe-16">  ຄົ້ນຫາ</button> -->
                        </form>
                      </div> <!-- /. card-body -->
                    </div> <!-- /. card -->
                  </div> <!-- /. col -->
                </div> <!-- /. end-section -->            


                
                <div class="row">
                  <!-- Small table -->
                  <div class="col-md-12">
                    <div class="card shadow">
                      <div class="card-body">
                        <!-- table -->
                        
                        <p><?php 
                        // if(empty($nameprovinceshow)){
                        //   echo '' ;
                        // }else{
                        //   echo $nameprovinceshow ;
                        // }
                        ?></p>
                        
                        <h3><p><?php $data = pg_query($db,$query);                                                       
                             $newrow55 = pg_fetch_assoc($data);
                             echo ' ຄົ້ນຫາຕາມແຂວງ : '.$newrow55['name_province_la'].', ';
                             echo ' ເມືອງ : '.$newrow55['name_district_la'].', ';
                             echo ' ບ້ານ : '.$newrow55['name_village_la'].'';
                             
                            ?></p></h3>                                                    
                      </div>
                    </div>
                  </div> <!-- simple table -->
                </div> <!-- end section -->
                <br>

                <div class="col-md-4 mb-4">
                  <div class="card shadow">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <span class="h4 mb-0">ລວມເງິນຄ່າຊໍາລະທັງໝົດ</span>
                          <p class="text-muted mb-0">1,500,000</p>
                        </div>
                        <div class="col-auto">
                          <span class="fe fe-32 fe-clipboard text-muted mb-0"></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                


                <div class="row my-4">
                  <!-- Small table -->
                  <div class="col-md-12">
                    <div class="card shadow">
                      <div class="card-body">
                        <!-- table -->
                        <table  class="table datatables" id="dataTable-1">
                          <thead>
                            <tr>
                              <!-- <th>dtype</th> -->
                              <th>id</th>
                              <th>ວັນທີ່ ຊຳລະ</th>
                              <th>ແຂວງ</th>
                              <th>ເມືອງ</th>
                              <th>ບ້ານ</th>
                              <th>ເລກທີ່</th>
                              <th>ເຈົ້າຂອງ</th>
                              <th>ເນື້ອທີ່</th>
                              <th>ຄ່າປັບໄໝ</th>
                              <th>ຄ່າຊຳລະ</th>
                            </tr>
                          </thead>
                          <tbody >
                              <!-- populate table from mysql database -->
                              <?php while($row = pg_fetch_assoc($result)):?>
                              <tr>
                                  
                                  <td><?php echo $row['id'];?></td>
                                  <td><?php echo $row['created_at'];?></td>
                                  <td><?php echo $row['name_province_la'];?></td>
                                  <td><?php echo $row['name_district_la'];?></td>
                                  <td><?php echo $row['name_village_la'];?></td>
                                  <td><?php echo $row['land_area_number'];?></td>
                                  <td><?php echo $row['fullname'];?></td>
                                  <td><?php echo $row['total_land_area_m2'];?></td>
                                  <td><?php echo $row['penalty'];?></td>
                                  <td><?php echo $row['tax_paid'];?></td>
                              </tr>
                              <?php endwhile;?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> <!-- simple table -->
                </div> <!-- end section -->




                



              </div> <!-- .col-12 -->
            </div> <!-- .row -->
          </div> <!-- .container-fluid -->
        </main> <!-- main -->
      </form>
    </div> <!-- .wrapper -->
    
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
   
    <!-- ໃຊ້ໄວ້ສຳຫຼັບ datetimepicker -->
    
    <script src='https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js'></script>
    <!-- --------- -->
    
    

    <script>
      $('#dataTable-1').DataTable({
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