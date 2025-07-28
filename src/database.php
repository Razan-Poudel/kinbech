
<?php
$host = "localhost";
$user = "root";   
$pass = "";

//connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}






$conn->select_db("kinbechdb"); // current database


$postings="postings";
$userdata='userdata';

$currenttable="DEMOTABLE"; ///just a demo table for the sql testing 
    












//returns array of multiple data in case of explorea and single data in case of other
function getdata($searchtype,$postid){

    if($searchtype=="explore"){


        $table="postings";
        $sql="SELECT * from ".$table;
    
        $result = $GLOBALS['conn']->query($sql);
    
        
    
        if ($result->num_rows > 0) {
    
            $myarr=[];
            while($row = $result->fetch_assoc()) {

             $info =new stdClass();

              $img='/img/'.$row['img'];


                $info->postid=$row['postid'];
                $info->sellerid=$row['sellerid'];
                $info->title=$row['title'];
                $info->des=$row['description'];
                $info->price=$row['price'];
                $info->img[]=$img;
                $info->contact=$row['contact'];
                $info->isnegotiable=$row['isnegotiable'];
                
                $myarr[]=$info;
            }
            echo json_encode($myarr);
            
    
        } else {
            echo "0";
        }
        
    





    }else{
    $table="postings";
    // $postid=1753513808;
    $sql="SELECT * from ".$table." where postid = ".$postid;

    $result = $GLOBALS['conn']->query($sql);

    $info =new stdClass();
    

    if ($result->num_rows > 0) {
        $myarr=[];

        $row = $result->fetch_assoc();
            $info =new stdClass();
            $img='/img/'.$row['img'];
            $info->postid=$row['postid'];
            $info->sellerid=$row['sellerid'];
            $info->title=$row['title'];
            $info->des=$row['description'];
            $info->price=$row['price'];
            $info->img[]=$img;
            $info->contact=$row['contact'];
            $info->isnegotiable=$row['isnegotiable'];
            
            $myarr[]=$info;
        

        return $info;

    } else {
        echo "0";
    }
    

}





}









function insertdata($data){



  // Check connection
  if ($GLOBALS['conn']->connect_error) {
      die("Connection failed: " . $GLOBALS['conn']->connect_error);
  }

  $GLOBALS['conn']->select_db("kinbechdb");






  $postid=time();
  $GLOBALS['currenttable']='postings'; ///just a demotable for the sql testing 

  $sql = "INSERT INTO ".$GLOBALS['currenttable']." VALUES (".$postid.",".$data->seller.",'".$data->title."','".$data->des."',".$data->price.",'".$data->img."','".$data->contact."',".$data->isnegotiable.")";

  // echo $sql;



  if ($GLOBALS['conn']->query($sql)) {
      return "Data inserted successfully.";
  } else {
      return "Error inserting data" . $GLOBALS['conn']->error;

}



}
// $GLOBALS['conn']->close();
?>