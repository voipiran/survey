<?php
    include 'jdf.php';
    if(isset($_GET['f'])){
        if(function_exists($_GET['f'])) {
//            var_dump($_GET['f']());
            echo $_GET['f']();
        }
    }

    function index()
    {
        // years to show calculations
        $now = date('Y-m-d' , time());
        $prev = jdate( 'Y' , strtotime($now . " - 6 years") , '' , 'Asia/Tehran' , 'en');
        $years = array();
        for($i=0 ; $i<=5 ; $i++){
            $prev++;
            array_push($years , (int)$prev);
        }
        $years  = json_encode($years);
        $year   = jdate( 'Y' , time() , '' , 'asia/tehran'  , 'en' );
        $res    = [$year , $years];
        return $res;
    }

    function create_bar(){
        include '../config/db.php';
        include_once '../../vendor/autoload.php';
        $year = $_GET['year'];
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
//            echo $sql.'<br><br>';
            $month[$i]  =  $conn->query($sql);
        }

        $i=1;
        $max = 0 ;
        $max_month = 0 ;
        $names = collect();
        foreach ($month as $item)
        {
            if(count($item)>0){
                foreach ($item as $value) {
                    ($names->contains($value['survey_location'])) ? '' : $names->push($value['survey_location']);
                    $month_data[$i] = $value['survey_location'];
                }
            }
            $i++;
        }

        $max = $names->count();

        if($max==0){
            $bar_chart_data = collect([
                'labels'   => ['فروردین' , 'اردیبهشت' , 'خرداد' , 'تیر' , 'مرداد' , 'شهریور' , 'مهر' , 'آبان' , 'آذر' , 'دی' , 'بهمن' , 'اسفند'  ] ,
                'datasets' => [
                    collect([
                        'label' => 'داده ای یافت نشد',
                        'backgroundColor' => 'rgba(120, 180,20, 0.4)',
                        'data' => [0 , 0 , 0 , 0, 0 , 0 , 0, 0 , 0 , 0, 0 , 0],
                    ])
                ]
            ]);
            return $bar_chart_data;
        }

        $i = 0;
        $survey_collection = collect();
        for($y = 1 ; $y<=12 ; $y++){
            if(isset($month[$y])){
                foreach ($month[$y] as $item){
                    $survey_collection->push([
                        'month' => $y,
                        'location' => $item['survey_location'],
                        'average' => $item['average_survey']
                    ]);
                }
            }
        }

        for ($i=0 ; $i<$max ; $i++){
            $color = color($i);
            $dataset[$i] = collect([
                'label' => "صف $names[$i]",
                'backgroundColor' => $color,
                'data' => [
                    dataset(1 , $names[$i] , $survey_collection),
                    dataset(2 , $names[$i] , $survey_collection),
                    dataset(3 , $names[$i] , $survey_collection),
                    dataset(4 , $names[$i] , $survey_collection),
                    dataset(5 , $names[$i] , $survey_collection),
                    dataset(6 , $names[$i] , $survey_collection),
                    dataset(7 , $names[$i] , $survey_collection),
                    dataset(8 , $names[$i] , $survey_collection),
                    dataset(9 , $names[$i] , $survey_collection),
                    dataset(10 , $names[$i] , $survey_collection),
                    dataset(11 , $names[$i] , $survey_collection),
                    dataset(12 , $names[$i] , $survey_collection)
                ],
            ]);
        }
        $bar_chart_data = collect([
            'labels'   => ['فروردین' , 'اردیبهشت' , 'خرداد' , 'تیر' , 'مرداد' , 'شهریور' , 'مهر' , 'آبان' , 'آذر' , 'دی' , 'بهمن' , 'اسفند'  ] ,
            'datasets' => $dataset
        ]);
    return $bar_chart_data;
}

    function create_pie(){
        include '../config/db.php';
        include_once '../../vendor/autoload.php';

        $date_time = $_GET['date_time'];
        if($_GET['date_time'] == 'no_set'){
            $from = jdate('Y/01/01' , time() , '' , 'asia/tehran'  , 'en' );
            $ts=jmktime(00,00,00,1,1,jdate('Y')) - 86400; //روز آخر سال قبل در تاریخ دلخواه

            $esfand_days = jdate('d' , $ts , '' , 'asia/tehran'  , 'en' );
            $to  = jdate("Y/12/$esfand_days" , time() , '' , 'asia/tehran'  , 'en' );
            $date_time = $from.' - '.$to;
        }
        $ex = explode('-' ,  $date_time );
        $from = $ex[0];
        $to = $ex[1];
        $from = str_replace('/' , '-' , $from );
        $to   = str_replace('/' , '-' , $to );
        $from = trim($from);
        $to   = trim($to);
        $from = explode('-' , $from);
        $to   = explode('-' , $to);
        $from = jalali_to_gregorian($from[0] , $from[1] , $from[2] , '-');
        $to   = jalali_to_gregorian($to[0]   , $to[1]   , $to[2]   , '-');

        $sql = "
            SELECT survey_value , COUNT(survey_value) as count_survey
            FROM survey
            WHERE date_time >= '$from' AND date_time <= '$to'
            GROUP BY  survey_value
        ";
        $result =  $conn->query($sql);

        $data = [0,0,0,0,0];
        foreach ($result as $res){
            switch ($res['survey_value']){
                case 1:
                    $data[0] = $res['count_survey'];
                    break;
                case 2:
                    $data[1] = $res['count_survey'];
                    break;
                case 3:
                    $data[2] = $res['count_survey'];
                    break;
                case 4:
                    $data[3] = $res['count_survey'];
                    break;
                case 5:
                    $data[4] = $res['count_survey'];
                    break;
            }
        }
        $empty = 1 ;
        foreach ($data as $val){
            if($val!=0){
                $empty = 0;
            }
        }
        $dataset = collect([
            'chart'     => $data,
            'date_time' => $date_time,
            'empty'     => $empty
        ]);
        return $dataset;
    }

    function get_year(){
        return  jdate( 'Y' , time() , '' , 'asia/tehran'  , 'en' );
    }

    function dataset($month , $location , $in){
        foreach ($in as $item){
            if($item['month']==$month && $item['location']==$location ){
                return $item['average'];
            }
        }
        return 0;
//	    this is with laravel 5.6 and not for this
//        return ($in->where('month' , $month)->where('location' , $location)->pluck('average')->get(0)==null) ? 0 : $in->where('month' , $month)->where('location' , $location)->pluck('average')->get(0);
    }

    function color($i){
        switch ($i)
        {
            case 0 :
                return "rgba(0,255,200,0.6)";
                break;
            case 1 :
                return "rgba(255,0,0,0.6)";
                break;
            case 2 :
                return "rgba(0,255,100,0.6)";
                break;
            case 3 :
                return "rgba(0,0,255,0.6)";
                break;
            case 4 :
                return "rgba(255,228,50,0.6)";
                break;
            case 5 :
                return "rgba(151,255,50.6)";
                break;
            case 6 :
                return "rgba(50,255,200,0.6)";
                break;
            case 7 :
                return "rgba(50,103,255,0.6)";
                break;
            case 8 :
                return "rgba(255,0,0,0.6)";
                break;
            case 9 :
                return "rgba(209,50,255,0.6)";
                break;
            case 10 :
                return "rgba(255,50,180,0.6)";
                break;
            case 11 :
                return "rgba(255,60,0,0.6)";
                break;
            case 12 :
                return "rgba(255,255,0,0.6)";
                break;
        }

    }

?>