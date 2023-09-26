<?php
    require_once('db.php');
    $wrong = 0;
    if(isset($_POST['date'])) {
        $gardenerid = $_POST['gardenerid'];
        $area = $_POST['area'];
        $date = $_POST['date'];
        $table = "roster";

        echo "<br/> $gardenerid $area $date <br/>";

        $sql = "SELECT * FROM information_schema.tables where table_schema = 'TheSchema' and table_name = '$table'";
        $result = mysqli_query($db, $sql);
        if($result->num_rows == 0){
            echo "\n creating table \n";
            $sql = "create table {$table} (date date,area varchar(20),gardenerid int)";
            $result = mysqli_query($db, $sql);
            echo mysqli_error($db);
        }

        $sql = "SELECT * FROM {$table} WHERE date = '$date' and area = '$area'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        
        $cnt = mysqli_num_rows($result);
        echo "<br/> $cnt";
        if($cnt === 0) {
            echo $cnt;
            echo "row inserted <br\>";
            $sql = "insert into {$table}(date,area,gardenerid) values ('$date','$area','$gardenerid')";
            $result = mysqli_query($db, $sql);
            echo " status : $result <br/>";
        }
        else{
            echo $cnt;
            echo "row updated <br\>";
            $sql = "update {$table} set gardenerid = {$gardenerid} where date = '$date' and area = {$area}";
            $result = mysqli_query($db, $sql);
            echo $sql;
            echo " status : {$result} <br/>";
        }
    }

?>
