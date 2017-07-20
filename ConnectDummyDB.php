<?php
//header("Content-type: application/x-javascript");

function dummyReturnPoint (){
        
    $array = array();

    $p1 = array(
        'destination' => 1,
        'roomID' => 1,
        'longitude' => 132.7842127,
        'latitude' => 33.8520594,
        'delflg' => 0,
        );
    array_push($array, $p1);

    $p2 = array(
        'destination' => 2,
        'roomID' => 2,
        'longitude' => 132.7633459,
        'latitude' => 33.8455768,
        'delflg' => 0,
        );
    array_push($array, $p2);

    $enc = json_encode($array);

   return $enc;
            
}

function NomalJson(){
    return dummyReturnPoint();    
}

function funcjson($name){
    $cus = $name. '('. dummyReturnPoint() . ' )';
    return $cus;
}



$JSON;
header('Content-type: application/json');
if( isset($_GET['callback']) ){
   echo  $JSON = funcjson($_GET['callback']);
}else{
   echo  $JSON = NomalJson();
}


?>