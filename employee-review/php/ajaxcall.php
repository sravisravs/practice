<?php
    SESSION_START();
    $username="root";
    $password="";
    $conn=mysqli_connect('localhost',$username,$password);
    mysqli_select_db($conn,'empreview');
    if(isset($_POST['search']))
    {
        $name = $_POST['search'];
        $con = "select e.employee_name,r.employeeid,r.average from employee_details as e
                        INNER JOIN reviewdetails as r on r.employeeid=e.employee_id and employee_name like '$name%'";
    }
    if(isset($_POST['searcht']))
    {
        $name = $_POST['searcht'];
        $teamlead=$_SESSION['username'];

        $con = "select e.employee_name,r.employeeid,r.average,e.employee_id from employee_details as e
                            INNER JOIN reviewdetails as r on r.employeeid=e.employee_id where teamlead='$teamlead' and employee_name like '$name%'";
    }
    $res=mysqli_query($conn,$con);
?>
		<div align="center" style="height:auto;position:relative;">
            <table border=1 class='table table-hover' style="background-color:white;margin-top:50px">
                <tr>
                    <th>Employee Name</th>
                    <th>Employee Id</th>
                    <th>Average rating</th>
                    <th>Edit</th>
                </tr>
                <?php
                while($i=mysqli_fetch_array($res))
                {
                    ?>
                    <tr>
                        <td><?php echo $i['employee_name']; ?></td>
                        <td><?php echo $i['employeeid']; ?></td>
                        <td><?php echo $i['average']; ?></td>
                        <td>
                            <button type="submit" name="editdetails" value="<?php echo $i['employeeid']; ?>">Edit
                            </button>
                        </td>
                        <td>
                            <button type="submit" name="printdetails" value="<?php echo $i['employeeid']; ?>">Print
                            </button>
                        </td>
                    </tr>
                    <?php
                }


                ?>
</table>
		</div>
