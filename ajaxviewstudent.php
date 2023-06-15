<?php

include 'connection.php';
$userid = $_POST['userid'];


$query = "select * from user_table where uid =".$userid;
$result = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($result)){
?>
<table border='0' width='100%' >
    <tr>
        <td><img src="userImage/<?php echo $row['photo']; ?>" width="250" height="250">
         <td style="padding: 40px;">
         <p style="font-size:13px;">Name :  <?php echo $row['first_name'];?></h6>
         <p style="font-size:13px;">Middle Name : <?php echo $row['middle_name'];?></p>
         <p style="font-size:13px;">Last Name : <?php echo $row['last_name'];?></p>
         </td>
        </td>
    </tr>
</table>



<?php } ?>



