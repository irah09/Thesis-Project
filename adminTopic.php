<?php 

session_start();
include 'connection.php';

if (!isset($_SESSION["uid"])) 
  {
    header('Location:index.php');
  }


if(isset($_POST['insertdata']))
{
    $signup_topicname = $_POST['signup_topicname'];
    $signup_month= $_POST['signup_month'];
    $signup_year= $_POST['signup_year'];

 
        $query="INSERT INTO topic_table (`topic_name`,`month`,`year`) VALUES ('$signup_topicname','$signup_month'
        ,'$signup_year')";
        $query_run = mysqli_query($conn, $query);
        if($query_run)
        {
           
     

            echo "<script>alert('Topic Successfully Added!.');</script>";
            
      
            
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
        }
    
}

if(isset($_POST['updatedata']))
{   
    $upid = $_POST['update_id'];
    
    $topicname= $_POST['topicname'];
    $month = $_POST['month'];
    $year = $_POST['year'];
   


    $query="UPDATE topic_table SET `topic_name`='$topicname',`month`='$month',`year`='$year' WHERE `tid`='$upid'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Topic Data Updated"); </script>';
        
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

       $query = "DELETE FROM topic_table WHERE tid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Topic Deleted"); </script>';
      
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
        <div class="modal fade" id="topicaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminTopic.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="signup_topicname" class="form-control" placeholder="Enter Topic Name">
                        </div>
                        <div class="form-group">
                        <select name="signup_month" id="month" class="form-control" >
                        <option value="">Choose month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                        </select>
                        </div>

                        <div class="form-group">
                       
                            <input type="text" name="signup_year" class="form-control" placeholder="Enter Year ">
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
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Question Name </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminTopic.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <input type="text" name="topicname" id="topicname" class="form-control" placeholder="Enter Topic Name">
                        </div>
                        <div class="form-group">
                        <select name="month" id="month" class="form-control" >
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                        </select>
                        </div>


                        <div class="form-group">
                            <input type="text" name="year" id="year" class="form-control" placeholder="Enter Year ">
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

                <form action="adminTopic.php" method="POST">

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

                <form action="studentAction.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="view_id" id="view_id">

                        <!-- <p id="fname"> </p> -->
                        <h4 id="fname"> <?php echo ''; ?> </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                        <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                    </div>
                </form>

            </div>
        </div>
    </div>


              <div class="container">
           
                
                  <div class="card">
                      <div class="card-body">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#topicaddmodal">
                              ADD TOPIC
                          </button>
                        <center><h4>List of Topics</h4></center>

                      </div>
                  </div>

                  <div class="card">
                      <div class="card-body">

                          <?php
                   

                      $query = "SELECT * FROM topic_table";
                      $query_run = mysqli_query($conn, $query);
                      $stmt = $conn->prepare($query);
                      $stmt->execute();
                      $result = $stmt->get_result();
                  ?>
                          <table id="datatableid" class="table table-bordered table-light">
                              <thead>
                                  <tr>
                                      <th scope="col"> ID</th>
                                      <th scope="col">Topic Name</th>
                                      <th scope="col">Month</th>
                                      <th scope="col">Year</th>
                                      <th scope="col">Action</th>
                                  
                                     
                                  </tr>
                              </thead>
                              <tbody >
                              <?php while ($row = $result->fetch_assoc()) { ?>
                                  <tr>
                                      <td> <?php echo $row['tid']; ?> </td>
                                      <td> <?php echo $row['topic_name']; ?> </td>
                                      <td> <?php echo $row['month']; ?> </td>
                                      <td> <?php echo $row['year']; ?> </td>
                            
                                      <td>
                                          <a href="adminViewQuestion.php?adminViewQuestion=<?php echo $row['tid']; ?> " class="btn btn-primary"> VIEW </a>
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

                $('.viewbtn').on('click', function () {
                    $('#viewmodal').modal('show');
                    $.ajax({ //create an ajax request to display.php
                        type: "GET",
                        url: "display.php",
                        dataType: "html", //expect html to be returned                
                        success: function (response) {
                            $("#responsecontainer").html(response);
                            //alert(response);
                        }
                    });
                });

            });
        </script>


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
                    $('#topicname').val(data[1].trim());
                    $('#month').val(data[2].trim());
                    $('#year').val(data[3].trim());
             
          
                });
            });
        </script>

        </main>
      </div>

</body>
</html>
