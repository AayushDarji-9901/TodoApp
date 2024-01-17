<?php

$conn=mysqli_connect("localhost","root","","todocrud");

if(isset($_POST['updatedata']))
{
    $id=$_POST['update_id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    // $query="UPDATE todo SET todotitle='$title' , tododescription='$description' WHERE userid='$id'";
    $query = "UPDATE `todo` SET todotitle='$title', tododescription='$description' WHERE userid='$id'  ";
    $result=mysqli_query($conn,$query);
    if($result){
        echo "<script>alert('Data Updated');</script>";
        header("Location:index.php");

    }
    else{
        echo "<script>alert('Data Not Updated');</script>";

    }

}


?>