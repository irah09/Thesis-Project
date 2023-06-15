<?php 

session_start();
include 'connection.php';

if (!isset($_SESSION["uid"])) 
  {
    header('Location:index.php');
  }


if(isset($_POST['insertdata']))
{
    $username = $_POST['signup_username'];
    $password = $_POST['signup_password'];
    $firstname = $_POST['signup_firstname'];
    $middlename = $_POST['signup_middlename'];
    $lastname = $_POST['signup_lastname'];
    $userlevel ="Student";
    $images = $_FILES["signup_image"]['name'];
    $token = md5(rand());

     
    
    if(file_exists("userImage/" .$_FILES["signup_image"]['name']))
    {
        
       echo "<script>alert('Image already Exist!')</script>";

    }
    else
    {

        $query = "INSERT INTO user_table (`username`,`password`,`first_name`,`middle_name`,`last_name`,`userlevel`,`photo`,`session_login`) VALUES ('$username','$password','$firstname','$middlename','$lastname','$userlevel','$images','$token')";
        $query_run = mysqli_query($conn, $query);       
    
      
        if ($query_run) {
           
            move_uploaded_file($_FILES["signup_image"]["tmp_name" ], "userImage/".$_FILES["signup_image"]["name" ]);
             echo "<script>alert('Student Successfully added!');</script>";;
            
	      
            
        } else {
            echo "<script>alert('Student Unsuccessfully added!');</script>";
            echo  $conn->error;
        }
    }
    
}

if(isset($_POST['updatedata']))
{   
    $id = $_POST['update_id'];
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];



    $query = "UPDATE user_table SET username='$username', password='$password', first_name='$firstname', middle_name='$middlename', last_name='$lastname' WHERE uid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
 
     echo '<script> alert("Student Data Updated"); </script>';
   
     
   
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM user_table WHERE uid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Student Data Deleted"); </script>';
        
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wordlab School Inc.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  
  
</head>
<body>

          
         
      <input type="checkbox" id="nav-toggle">
      <div class="sidebar">
      <div class="sidebar-brand">
       
       <h1><span><img src="assets/image/wordlabmainlogo.png" width="40px" height="35px" alt="">WordLab</span></h1>
     </div>

        <div class="sidebar-menu">
          <ul>
              <li>
                <a href="admin.php" class="active"><span class="fa fa-bar-chart"></span>
              <span>Topic Statistic</span></a>
              </li>
              <li>
                <a href="adminStudent.php"><span class="fa fa-graduation-cap"></span>
              <span>Students</span></a>
              </li> 
              <li>
                <a id="teacherpage" href="adminTeacher.php"><span class="fa fa-users"></span>
              <span>Teachers</span></a>
              </li> 
              <li>
                <a href="adminTopic.php"><span class="fa fa-question-circle"></span>
              <span>Topic list</span></a>
              </li>  
          </ul>
        </div>
      </div>

      <div class="main-content">
        <header>
          <h2>
            <label for="nav-toggle">
              <span class="fa fa-bars"></span>
            </label>
              Dashboard
          </h2>
        

          <div class="user-wrapper">
          <?php
            $sql = "SELECT * FROM user_table WHERE uid='{$_SESSION["uid"]}'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <img src="userImage/<?php echo $row["photo"]; ?>" width="30px" height="30px" alt="">
            <div>
              <h4><?php echo $_SESSION['first_name']; ?><span> <?php echo $_SESSION['last_name']; ?></span></h4>
              <small><?php echo $_SESSION['userlevel']; ?></small>
              <?php if ($_SESSION['userlevel'] == "Teacher"){ ?>  
                <script>
                    document.getElementById("teacherpage").style.display = 'none';

                </script>
                <?php } ?>

                <a href="logout.php" class=""><span><i class="fa fa-power-off" onclick="return confirm('Are you sure you want to logout?');"></i></span></a>

                <?php
                }
            }

            ?>
            </div>
          </div>
        </header>

        <main>
        <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminStudent.php" method="POST" enctype="multipart/form-data"> 

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="signup_username" class="form-control" placeholder="Enter Username">
                        </div>


                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="signup_password" class="form-control" placeholder="Enter Password ">
                        </div>

                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="signup_firstname" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Middle Name </label>
                            <input type="text" name="signup_middlename" class="form-control" placeholder="Enter Middle Name">
                        </div>
                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="signup_lastname" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                           
                            <input type="file" name="signup_image" id="signup_image" class="form-control" required>
                       
                        </div>
                        
                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminStudent.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Username </label>
                            <input type="text" name="username" id="uname" class="form-control" placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                            <label> Password </label>
                            <input type="text" name="password" id="password" class="form-control" placeholder="Enter Password ">
                        </div>

                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="first_name" id="fname" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Middle Name </label>
                            <input type="text" name="middle_name" id="mname" class="form-control" placeholder="Enter Middle Name">
                        </div>
                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="last_name" id="lname"  class="form-control" placeholder="Enter Last Name">
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

                <form action="adminStudent.php" method="POST">

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


    <!-- VIEW POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="viewmodal-body">

                       

   
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                    </div>
            </div>
        </div>
    </div>

              <div class="container">
           
                
                  <div class="card">
                      <div class="card-body">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                              ADD STUDENT
                          </button>
                          <center><h4>List of Students</h4></center>
                      </div>
                  </div>

          
                  <div class="card">
                      <div class="card-body">
                          <?php
                    

                            $query = "SELECT uid,username,password,first_name,middle_name,last_name,photo FROM user_table WHERE userlevel = 'Student'";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                          ?>      
                        
                          <table id="datatableid" class="table table-bordered table-light">
                              <thead>
                                  <tr>
                                      <th scope="col"> ID</th>
                                      <th scope="col">Username</th>
                                      <th scope="col">Password</th>
                                      <th scope="col">First Name </th>
                                      <th scope="col">Middle Name </th>
                                      <th scope="col">Last Name</th>
                                      <th scope="col"> Action </th>
                                   
                                  </tr>
                              </thead>
                              <tbody >
                              <?php while ($row = $result->fetch_assoc()) { ?>
                                  <tr>
                                      <td> <?php echo $row['uid']; ?> </td>
                                      <td> <?php echo $row['username']; ?> </td>
                                      <td> <?php echo $row['password']; ?> </td>
                                      <td> <?php echo $row['first_name']; ?> </td>
                                      <td> <?php echo $row['middle_name']; ?> </td>
                                      <td> <?php echo $row['last_name']; ?> </td>
                                      <td>
                                          <button data-id='<?php echo $row['uid']; ?>' class="viewbtn btn btn-primary"> VIEW </button>
                                    
                                          <button type="button" class="btn btn-primary editbtn"> EDIT </button>
                                   
                                          <button type="button" class="btn btn-primary deletebtn"> DELETE </button>
                                      </td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                          </table>
                          </div>
                  </div>


           
          </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

        <script>
            $(document).ready(function () {

                $('#datatableid').DataTable({
                    "pagingType": "full_numbers",
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    responsive: true,
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search Your Data",
                    }
                });

            });
        </script>


        <script type="text/javascript">
            $(document).ready(function () {
                $('.viewbtn').click(function(){
                    var userid = $(this).data('id');
                   $.ajax({
                        url: 'ajaxviewstudent.php',
                        type: 'post',
                        data: {userid: userid},
                        success: function(response){
                            $('.viewmodal-body').html(response);
                            $('#viewmodal').modal('show');
                        }



                   });
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

        <script>
            $(document).ready(function () {

                $('.editbtn').on('click', function () {

                    $('#editmodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[0].trim());
                    $('#uname').val(data[1].trim());
                    $('#password').val(data[2].trim());
                    $('#fname').val(data[3].trim());
                    $('#mname').val(data[4].trim());
                    $('#lname').val(data[5].trim());
                    $('#signup_image').val(data[6].trim());
          
                });
            });
        </script>

        </main>
      </div>

</body>
</html>
