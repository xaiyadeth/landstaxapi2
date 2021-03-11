<?php 
// Include the database config file 
include_once 'DBconfig.php'; 
 
if(!empty($_POST["id_province"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM district WHERE id_province = ".$_POST['id_province']." "; 
    $result = pg_query($db,$query); 
     
    // Generate HTML of state options list 
    if(pg_num_rows($result) > 0){ 
        echo '<option value="">ກະລຸນາເລືອກເມືອງ</option>'; 
        while($row = pg_fetch_assoc($result)){  
            echo '<option value="'.$row['id_district'].'">'.$row['name_district_la'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">ກະລຸນາເລືອກແຂວງກ່ອນ</option>'; 
    } 
}

if(!empty($_POST["data2"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM village WHERE id_district = ".$_POST['data2']." AND id_province = ".$_POST['data1'].""; 
    // $query = "SELECT * FROM village WHERE id_province = ".$_POST['id_province']." "; 
    // $query = "SELECT * FROM village WHERE id_district = ".$_POST['id_district'].""; 
    $result = pg_query($db,$query);  
     
    // Generate HTML of city options list 
    if(pg_num_rows($result) > 0){ 
        echo '<option value="">ກະລຸນາເລືອກບ້ານ</option>'; 
        while($row = pg_fetch_assoc($result)){  
            echo '<option value="'.$row['id_village'].'">'.$row['name_village_la'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">ກະລຸນາເລືອກເມືອງກ່ອນ</option>'; 
    } 
} 

if(!empty($_POST["search"])){ 
    
                          
                          
                          
}
?>