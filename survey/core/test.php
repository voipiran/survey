<?php

include 'jdf.php';
include 'config/db.php';
$year = 1397;
for($i=1 ; $i<=12 ; $i++){
    $j = $i;
    $j++;
    $y = $year;
    if($j == 13){
        $y++;
        $j = 01;
    }
    $ts=jmktime(00,00,00,$j,1,$y)-86400; //روز آخر ماه در تاریخ دلخواه
    $jalali_months_days[$i] =  jdate('d' , $ts , '' , 'asia/tehran' ,'en');
}
for($i=1 ; $i<=12 ; $i++) {
    (strlen($i))== 1 ? $j='0'.$i : $j=$i;
    $first_of_months[$i] = $year.'-'.$j.'-01';
    $end_of_months[$i]   = $year.'-'.$j.'-'.$jalali_months_days[$i];
    $from[$i]  = jalali_to_gregorian( $year ,  $j , 01                      , '-' );
    $to[$i]    = jalali_to_gregorian( $year ,  $j , $jalali_months_days[$i]  , '-' );
}

for($i=1 ; $i<=12 ; $i++) {
    $sql = "
            SELECT  survey_location              ,
             SUM(survey_value) as total_survey   , 
             AVG(survey_value) as average_survey , 
             COUNT(agent_number) as count_survey
            FROM survey
            WHERE date_time >= '$from[$i]' AND date_time <= '$to[$i]'
            GROUP BY  survey_location
            ";
//    echo $sql.'<br><br>';
    $month[$i]  =  $conn->query($sql);
}
//$result  =  $conn->query($sql[8]);
if ($month[8]->num_rows > 0) {
    // output data of each row
    while($row = $month[8]->fetch_assoc()) {
        echo "total_survey: " . $row["total_survey"]."<br>";
        echo "average_survey: " . $row["average_survey"]."<br>";
        echo "count_survey: " . $row["count_survey"]."<br>";
        echo "survey_location: " . $row["survey_location"]."<br>";
    }
} else {
    echo "0 results <br>";
}
echo '<br>';
echo $month[8]->num_rows;
echo '<br>';
var_dump($month[8]);
return '<br>fin';