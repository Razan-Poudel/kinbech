<?php

require "database.php";


$method=$_SERVER["REQUEST_METHOD"];
$url=$_SERVER["REQUEST_URI"];


//general feed
if ($method=="GET" && strpos($url,"/explore")) {
    getdata("explore",35653);
    
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


    
}


//buyer views the product
if ($method=="GET" && strpos($url,"/viewproduct")) {
    echo $url;
}



if (isset($_GET['id'])) {
    $postid = $_GET['id'];
    // getdata("post",$postid);
    echo "i received data";



}




//this is this


header('Content-Type: application/json');

    $uploadDir = "../img/";
    if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
    }

    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $price = $_POST['price'] ?? null;
    $sellerid = $_POST['sellerid'] ?? null;
    $sellercontact = $_POST['contact'] ?? null;


    $response = [
    'success' => false,
    'message' => '',
    'file' => null,
    'formData' => [
        'title' => $title,
        'description' => $description,
        'price' => $price,
        'sellerid'=>$sellerid,
        'contact'=>$sellercontact
    ]
    ];
    if ($method=="POST") {

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['image']['tmp_name'];
    $originalName = $_FILES['image']['name'];
    $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);
    $safeName = preg_replace("/[^a-zA-Z0-9_-]/", "_", pathinfo($originalName, PATHINFO_FILENAME));
    $uniqueName = $safeName . '_' . uniqid() . '.' . $fileExt;
    $targetPath = $uploadDir . $uniqueName;

    if (move_uploaded_file($tmpName, $targetPath)) {


        //add the name of the file and all details in database
        
    $contact=new stdClass();
    $contact->email = json_decode($sellercontact)->email;
    $contact->phone= json_decode($sellercontact)->phone;
    $contact->location=json_decode($sellercontact)->location;



    $obj = new stdClass();
    $obj->seller = $sellerid;
    $obj->title = $title;
    $obj->des = $description;
    $obj->img = $uniqueName;
    $obj->contact = json_encode($contact);
    $obj->price = $price;
    $obj->isnegotiable = true;
     $mesg=   insertdata($obj);


        $response['success'] = true;
        $response['message'] = 'File uploaded successfully.'.$mesg;
        $response['file'] = [
            'originalName' => json_encode($obj),
            'storedAs' => $uniqueName,
            'path' => $targetPath
        ];
    } else {
        $response['message'] = 'Failed to move uploaded file.';
    }
    } else {
    $response['message'] = 'No file uploaded or upload error.';
    }

    echo json_encode($response);


    }


















