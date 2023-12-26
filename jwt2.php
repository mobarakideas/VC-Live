<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Creadentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json*');
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");
use Firebase\JWT\JWT;

$con=mysqli_connect('localhost','root','','student') or die('mysql not connected');

$sql="Select * from vcstudent";
$exc=mysqli_query($con,$sql);
$count=mysqli_num_rows($exc);
$row=mysqli_fetch_array($exc);
if($count>0)
{
    // NAME	ID	EMAIL	SEMESTER	COURCE	PAPER	SESSION	UNIT	PPT	FILE	TOPIC	SECTION	QUESTION	TITLE	LINK	DEPARTMENT	DATE	
    $key = "test123";
    $payload = array(
        "NAME"=>$row['NAME'],
        "ID"=>$row['ID'],
        "EMAIL"=>$row['EMAIL'],
        "SEMESTER"=>$row['SEMESTER'],
        "COURSE"=>$row['COURSE'],
        "PAPER"=>$row['PAPER'],
        "SESSION"=>$row['SESSION'],
        "UNIT"=>$row['UNIT'],
        "PPT"=>$row['PPT'],
        "FILE"=>$row['FILE'],
        "TOPIC"=>$row['TOPIC'],
        "SECTION"=>$row['SECTION'],
        "QUESTION"=>$row['QUESTION'],
        "TITLE"=>$row['TITLE'],
        "LINK"=>$row['LINK'],
        "DEPARTMENT"=>$row['DEPARTMENT'],
        "DATE"=>$row['DATE'],
        
    );
    $jwt=JWT::encode($payload,$key);
    $myarr['NAME']=$row['NAME'];
    $myarr['ID']=$row['ID'];
    $myarr['EMAIL']=$row['EMAIL'];
    $myarr['SEMESTER']=$row['SEMESTER'];
    $myarr['COURSE']=$row['COURSE'];
    $myarr['PAPER']=$row['PAPER'];
    $myarr['SESSION']=$row['SESSION'];
    $myarr['UNIT']=$row['UNIT'];
    $myarr['PPT']=$row['PPT'];
    $myarr['FILE']=$row['FILE'];
    $myarr['TOPIC']=$row['TOPIC'];
    $myarr['SECTION']=$row['SECTION'];
    $myarr['QUESTION']=$row['QUESTION'];
    $myarr['TITLE']=$row['TITLE'];
    $myarr['LINK']=$row['LINK'];
    $myarr['DEPARTMENT']=$row['DEPARTMENT'];
    $myarr['DATE']=$row['DATE'];
    $myarr['jwt']=$jwt;

    $arr1=['msg'=>'data given','status'=>101,'Data'=>$myarr];
    echo json_encode($arr1);
}
//echo json_encode($myarr);

?>