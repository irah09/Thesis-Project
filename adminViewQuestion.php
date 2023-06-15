<?php 

session_start();
include 'connection.php';

if (!isset($_SESSION["uid"])) 
  {
    header('Location:index.php');
  }

if(isset($_POST['insertdata']))
{
    $tid= $_POST['signup_tid'];
    $signup_question= $_POST['signup_question'];
    $signup_answer= $_POST['signup_answer'];
    $signup_choice1= $_POST['signup_choice1'];
    $signup_choice2= $_POST['signup_choice2'];
    $signup_choice3= $_POST['signup_choice3'];
    $signup_gradinglvl= $_POST['signup_gradinglvl'];
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    

 
        $query= "INSERT INTO question_table(tid,question,answer,choice_one,choice_two,choice_three,grading_level)VALUES('$tid','$signup_question','$signup_answer','$signup_choice1','$signup_choice2','$signup_choice3','$signup_gradinglvl')";
        $query_run = mysqli_query($conn, $query);
        if($query_run)
        {
           
     

            echo "<script>alert('Question Successfully Added!.');</script>";
        
      
            
        }
        else
        {
            echo '<script> alert("Data Not Saved"); </script>';
        }
    
}



if(isset($_POST['updatedata']))
{   
    $id = $_POST['update_id'];

    $tid=$_POST['tid'];
    $question= $_POST['question'];
    $answer= $_POST['answer'];
    $choice1= $_POST['choice1'];
    $choice2= $_POST['choice2'];
    $choice3= $_POST['choice3'];
    $gradinglvl= $_POST['gradinglvl'];
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);


    $query = "UPDATE question_table SET tid='$tid', question='$question', answer='$answer', choice_one='$choice1', choice_two='$choice2', choice_three='$choice3', grading_level='$gradinglvl' WHERE qid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Data Updated"); </script>';
     
    }
    else
    {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);

    $query = "DELETE FROM question_table WHERE qid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
       
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
              <span>Question</span></a>
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
        <div class="modal fade" id="questionaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminViewQuestion.php" method="POST">
                     <?php
                          
                         
                          $tid= $_GET['adminViewQuestion'];
    
                          $query = "SELECT * FROM question_table WHERE tid = '$tid'";
                          $query_run = mysqli_query($conn, $query);
                      ?>

                    <div class="modal-body">
                        <div class="form-group">
                        <input type="hidden" name="signup_tid" value='<?php echo $tid ?>'>
                        </div>
                        <div class="form-group">
                            <input type="text" name="signup_question" class="form-control" placeholder="Enter Question">
                        </div>
                        <div class="form-group">
                            <input type="text" name="signup_answer" class="form-control" placeholder="Enter Answer">
                        </div>
                        <div class="form-group">
                            <input type="text" name="signup_choice1" class="form-control" placeholder="Enter Choice One">
                        </div>
                        <div class="form-group">
                            <input type="text" name="signup_choice2" class="form-control" placeholder="Enter Choice Two">
                        </div>
                        <div class="form-group">
                            <input type="text" name="signup_choice3" class="form-control" placeholder="Enter Choice Three">
                        </div>
                        <div class="form-group">
                        <select name="signup_gradinglvl" id="signup_gradinglvl" class="form-control" >
                        <option value="1st Grading">1st Grading</option>
                        <option value="2nd Grading">2nd Grading</option>
                        <option value="3rd Grading">3rd Grading</option>
                        <option value="4th Grading">4th Grading</option>
                        </select>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="adminViewQuestion.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">
                        <input type="hidden" name="tid" value='<?php echo $tid ?>'>
                        </div>
                        <div class="form-group">
                        <label> Question </label>
                            <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question">
                        </div>
                        <div class="form-group">
                        <label> Answer </label>
                            <input type="text" name="answer" id="answer" class="form-control" placeholder="Enter Answer">
                        </div>
                        <div class="form-group">
                        <label> Choice 1 </label>
                            <input type="text" name="choice1" id="choice1" class="form-control" placeholder="Enter Choice One">
                        </div>
                        <div class="form-group">
                        <label> Choice 2 </label>
                            <input type="text" name="choice2" id="choice2" class="form-control" placeholder="Enter Choice Two">
                        </div>
                        <div class="form-group">
                        <label> Choice 3 </label>
                            <input type="text" name="choice3" id="choice3" class="form-control" placeholder="Enter Choice Three">
                        </div>
                        <div class="form-group">
                        <label> Grading level</label>
                        <select name="gradinglvl" id="gradinglvl" class="form-control">
                        <option value="1st Grading">1st Grading</option>
                        <option value="2nd Grading">2nd Grading</option>
                        <option value="3rd Grading">3rd Grading</option>
                        <option value="4th Grading">4th Grading</option>
                        </select>
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

                <form action="adminViewQuestion.php" method="POST">

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





              <div class="container">
           
                
                  

                  <div class="card">
                      <div class="card-body">

                          <?php
                          
                      
                      $tid= $_GET['adminViewQuestion'];

                      $query = "SELECT * FROM question_table WHERE tid = '$tid'";
                      $stmt = $conn->prepare($query);
                      $stmt->execute();
                      $result = $stmt->get_result();
                  ?>
                  <div class="card">
                      <div class="card-body">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionaddmodal">
                              ADD QUESTION
                          </button>
                          <center>
                          <?php echo $tid; ?><h4>Questions</h4>

                        </center>
                      </div>
                  </div>
                          <table id="datatableid" class="table table-bordered table-light">
                              <thead>
                                  <tr>
                                      <th scope="col"> ID</th>
                                      <th scope="col">Topic ID</th>
                                      <th scope="col">Question</th>
                                      <th scope="col">Answer</th>
                                      <th scope="col">Choice 1</th>
                                      <th scope="col">Choice 2</th>
                                      <th scope="col">Choice 3</th>
                                      <th scope="col">Grading level</th>
                                      <th scope="col">Action</th>
                                  
                                     
                                    </tr>
                              </thead>
                              <tbody >
                              <?php while ($row = $result->fetch_assoc()) { ?>
                                  <tr>
                                      <td> <?php echo $row['qid']; ?> </td>
                                      <td> <?php echo $row['tid']; ?> </td>
                                      <td> <?php echo $row['question']; ?> </td>
                                      <td> <?php echo $row['answer']; ?> </td>
                                      <td> <?php echo $row['choice_one']; ?> </td>
                                      <td> <?php echo $row['choice_two']; ?> </td>
                                      <td> <?php echo $row['choice_three']; ?> </td>
                                      <td> <?php echo $row['grading_level']; ?> </td>
                            
                                      <td>
                                         
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
                    $('#tid').val(data[1].trim());
                    $('#question').val(data[2].trim());
                    $('#answer').val(data[3].trim());
                    $('#choice1').val(data[4].trim());
                    $('#choice2').val(data[5].trim());
                    $('#choice3').val(data[6].trim());
                    $('#gradinglvl').val(data[7].trim());
            
             
             
          
                });
            });
        </script>

        </main>
      </div>

</body>
</html>
