<?php
$insert=false;
//connect to database
$servername="localhost";
$username="root";
$password="";
$database="todocrud";
        
//create a connection 
$conn=mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Sorry we failed to connect:".mysqli_connect_error());
}

//echo $_SERVER['REQUEST_METHOD'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $title=$_POST['title'];
    $description=$_POST['description'];

    $sql="INSERT INTO `todo`(`todotitle`,`tododescription`) VALUES ('$title','$description')";
    $result=mysqli_query($conn,$sql);

    if($result){
        // echo "The record has been inserted successfully!<br>";
        $insert=true;
    }
    else{
        echo "The record was not inserted successfully ---->".mysqli_error($conn);
    }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" 
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    
    <title>TODO LIST USING PHP CRUD</title>
    <!-- <script>
        document.getElementsByClassName('edit');
    </script> -->
  </head>
  <body>

    
     <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="updatecode.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="update_id" id="update_id">

                        <div class="form-group">
                            <label for="title">Title </label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea class="form-control" id="desc" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
     <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
     <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">TODO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact US</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <?php
       if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Your note has been inserted successfully.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
       }
    ?>

    <div class="container my-5">
        <h2>TODO APP</h2>
        <form action="/todocrud/index.php" method="post">
            <div class="form-group">
                <label for="title">Title </label>
                <input type="text" class="form-control" id="title" name="title" >
            
            </div>
            <div class="form-group">
                <label for="desc">Description</label>
                <textarea class="form-control" id="desc" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-5">
        <?php
        //    $sql="SELECT * FROM `todo`";
        //    $result=mysqli_query($conn,$sql);

        //    while($row=mysqli_fetch_assoc($result)){
        //   //  echo $row['userid'].")"."Title".$row["todotitle"]."Description".$row["tododescription"];
        //     echo "<br>";
        //    }
        ?>
        <table class="table" id="myTable">
            <thead>
                <tr>
                <th scope="col">S.NO</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
        <tbody>
    <?php

    $sql="SELECT * FROM `todo`";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>
        <td scope='row'>".$row['userid']."</td>
        <td>".$row['todotitle']."</td>
        <td>".$row['tododescription']."</td>
        <td> <button class='editbtn btn btn-sm btn-primary'>Edit</button> 
             <button class='deletebtn btn btn-sm btn-danger'>Delete</button>
            
        </td>
        </tr>";
    }
    ?>
    
    </tbody>
    </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" 
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> -->

    <!-- DataTables CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let table = new DataTable('#myTable');

        // $(document).ready(function(){
        //     //Datatable
        //     $('.editbtn').on('click',function(){

        //       //  $('#editmodal').modal('show');
        //         var id=$(this).data('id');

        //         $.ajax({
        //             url:'updatecode.php',
        //             method:'POST',
        //             data:{id:id},
        //             success:function(response){
        //                 // alert("Welcome to datatables");
        //                 if(response.status==1){
                          
        //                    $('#title').val(response.data.title);
        //                    $('#desc').val(response.data.desc);

        //                    table.ajax.reload();
        //                 }
        //                 // else{
        //                 //     alert("Invalid ID");
        //                 // }

        //             }
        //         });
        //     });

        // })
    </script>

    <script>
        $(document).ready(function () {
            // let table = new DataTable('#myTable');

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#title').val(data[1]);
                $('#desc').val(data[2]);
                // $('#course').val(data[3]);
                // $('#contact').val(data[4]);
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

  </body>
</html>