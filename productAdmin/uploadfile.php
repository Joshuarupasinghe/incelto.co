<?php
$ftemp = $_FILES ["file1"] ["tmp_name"];
$name = $_FILES ["file1"]["name"];
$type = $_FILES ["file1"]["type"];
$size = $_FILES ["file1"]["size"];

echo "<b>File Name: </b>".$name."<br>";
echo "<b>File type: </b>".$type."<br>";
echo "<b>File Size: </b>".$size."<br>";

$flag=  move_uploaded_file($ftemp,"C:/$name");
if($flag){
    echo "File moved successfully";
}else{
    echo "Sorry Couldn't move";
}
?>