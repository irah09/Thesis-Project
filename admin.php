<?php 

session_start();
include 'connection.php';

if (!isset($_SESSION["uid"])) 
  {
    header('Location: index.php');
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Wordlab School Inc.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
  <script src ="script.js"></script>
  
  
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
          <div class="cards">
            <div class="card-single">
              <div>
                  <?php $userCountQuery = "SELECT COUNT(CASE WHEN userlevel = 'Student' THEN 1 END) AS RegisteredStudent,COUNT(CASE WHEN userlevel = 'Teacher' THEN 1 END) AS RegisteredTeacher  FROM user_table";
                  $stmt=$conn->prepare($userCountQuery);
                  $stmt->execute();
                  $result=$stmt->get_result();
                  $row=$result->fetch_assoc();

                  $registeredStudent = $row['RegisteredStudent'];
                  $registeredTeacher = $row['RegisteredTeacher'];

                  $topicCountQuery = "SELECT COUNT(tid) AS RegisteredTopic FROM topic_table";
                  $stmt=$conn->prepare($topicCountQuery);
                  $stmt->execute();
                  $result=$stmt->get_result();
                  $topicRowCount=$result->fetch_assoc();

                  $registeredTopic = $topicRowCount['RegisteredTopic'];
                  ?>                
                  <h1><?= $registeredStudent; ?></h1>
                  <span>Registered Student</span>
              </div>
              <div>
                <span class="fa fa-users"></span>
              </div>
            </div>
            <div class="card-single">
              <div>
                  <h1><?= $registeredTeacher; ?></h1>
                  <span>Registered Teacher</span>
              </div>
              <div>
                <span class="fa fa-users"></span>
              </div>
            </div>
            <div class="card-single">
              <div>
                  <h1><?= $registeredTopic; ?></h1>
                  <span>Topics</span>
              </div>
              <div>
                <span class="fa fa-book"></span>
              </div>
            </div>
          </div>
          <div class="table-grid">
              <div class="card">
                  <div class="card-header">
                    <label class="input-group-text" for="inputGroupSelect01">Topic name</label>
                    <select class="custom-select" id="select_tpn">
                        <option value="">Choose...</option>
                    </select>
                    
                    <button id="filter" class="btn btn-sm btn-outline-light">Filter</button>
                    <button id="reset" class="btn btn-sm btn-outline-light">Reset</button>
                  </div>
                  <div id="chart_wrap">
                    <table>
                        <div class="chart" id="chart_area"></div>
                    </table>
                  </div>
              </div>
          </div>
        </main>
      </div>


</body>
</html>

<script src="https://code.jquery.com/jquery-3.5.0.min.js"
        integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/r-2.2.3/datatables.min.js"></script>

    <!-- Moment Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback();

function fetch_tpn() {
        $.ajax({
            url: "fetch_std.php",
            type: "post",
            dataType: "json",
            success: function(data) {
                var tpnBody = "";
                for (var key in data) {
                tpnBody += `<option value="${data[key]['tid']},${data[key]['year']}">${data[key]['topic_name']}, ${data[key]['year']}</option>`;                }
                $("#select_tpn").append(tpnBody);
            }
        });
    }
    fetch_tpn();



    function fetch(tpn) {
        $.ajax({
            url: "records.php",
            type: "post",
            data: {
                tpn: tpn
            
              
               
               
                
            },
            dataType: "json",
            cache: false,
            success: function(data) {
                drawMonthwiseChart(data);
                
            }
        });
    }
    fetch();



    function drawMonthwiseChart(data, chart_main_title)
{
  window.onload = function() {
	if(!window.location.hash) {
		window.location = window.location + '#loaded';
		window.location.reload();
	}
}

    var jsonData = data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Month');
    data.addColumn('number', 'Pass');
    data.addColumn('number', 'Fail');
    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var scount = jsonData.scount;
        var PASS = parseFloat($.trim(jsonData.PASS));
        var FAIL = parseFloat($.trim(jsonData.FAIL));
        var pasado = parseFloat($.trim(jsonData.pasado));
        var bagsak= parseFloat($.trim(jsonData.bagsak));
        data.addRows([[month  +"\n Enrolled: "+scount+"\n Pass: "+pasado+" Fail: "+bagsak+"",PASS,FAIL]]);
        
        var monthOrder = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
        ];
      
    });

    var options = {
        title:chart_main_title,
        width: '100%',
        height: '500px',
        colors: ['turquoise','red'],
       
      
        
        hAxis: {
            title: "Months"
          
            
        },
        vAxis: {
            
            minValue: 0,
            maxValue: 100,
            format: '#\'%\''
            
            
        }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);

   
  var monthOrder = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];


  var rows = month.getSortedRows([{column: 0}]);
  rows.sort(function (a, b) {
    var monthA = month.getValue(a, 0);
    var monthB = month.getValue(b, 0);
    return monthOrder.indexOf(monthA) - monthOrder.indexOf(monthB);
  });



  var view = new google.visualization.DataView(month);
  view.setRows(rows);

  var chartSort = new google.visualization.ColumnChart(document.getElementById('chart_area'));
  chartSort.draw(view,options);

  

}


    // Filter

    $(document).on("click", "#filter", function(e) {
        e.preventDefault();

        var tpn= $("#select_tpn").val();
   
        

        if (tpn !== "" )  {
          
            $('#record_table').DataTable().destroy();
            fetch(tpn);
        } else {
            $('#record_table').DataTable().destroy();
            fetch();
        }
    });

 


    // Reset

    $(document).on("click", "#reset", function(e) {
        e.preventDefault();

        $("#select_tpn").html(`<option value="">Choose...</option>`);


        $('#record_table').DataTable().destroy();
        fetch();
        fetch_tpn();
       
       
    });


    $(window).resize(function(){
      drawMonthwiseChart();
    });
    </script>
</script>


          <script>
            
          if(document.querySelector("small-id") == "Admin")
          {
            document.getElementById("teacherpage").style.display = 'none';
          } 
          </script>

