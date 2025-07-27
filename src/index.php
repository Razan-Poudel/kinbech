<?php

require "database.php";


$method=$_SERVER["REQUEST_METHOD"];
$url=$_SERVER["REQUEST_URI"];


//general feed
if ($method=="GET" && strpos($url,"/explore")) {
    echo "hey explorer".$url;
}

//new product add by user
if ($method=="POST" && strpos($url,"/newproduct")) {

    $contact=new stdClass();
    $contact->email = "yadavhemant@123";
    $contact->phone= 98696966;
    $contact->location="yadavtol";



    $obj = new stdClass();
    $obj->seller = 69696;
    $obj->title = "value2";
    $obj->des = "value3";
    $obj->img = "value3";
    $obj->contact = json_encode($contact);
    $obj->price = 100;
    $obj->isnegotiable = true;

    // insertdata($obj);

    // echo (json_encode($obj));

    getdata("post",35653);

    
}


//buyer views the product
if ($method=="GET" && strpos($url,"/viewproduct")) {
    echo "Kya dekh raha h";
}



