<?php
   $host        = "host = 172.16.12.130";
   $port        = "port = 5432";
   $dbname      = "dbname = landtax";
   $credentials = "user = deploy password=deploy";

   $db = pg_connect( "$host $port $dbname $credentials"  );
   if(!$db) {
      echo "Error : Unable to open database\n";
   } else {
     //echo "Opened database successfully\n";
   }
?>