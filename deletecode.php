<?php

$conn=mysqli_connect("localhost","root","","todocrud");

if(isset($_POST['deletedata'])){
    $id=$_POST['delete_id'];
    $query="DELETE FROM todo WHERE userid='$id'";
    $result=mysqli_query($conn,$query);

    if($result){
        echo "<script>alert('Data Deleted');</script>";
        header("Location:index.php");
    }
    else{
        echo '<script>alert("Data Not Deleted");</script>';
    }

}

?>