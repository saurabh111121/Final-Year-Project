
<?php
if(isset($_POST['signup']))
{
error_reporting(1);
	mysql_connect("localhost","root","");
	mysql_select_db("saurabh");
	
	$Email=$_POST['email'];

	$que1=mysql_query("select * from users where Email='$Email'");
	$count1=mysql_num_rows($que1);

	if($count1>0)
	{
		echo "<script>
				alert('There is an existing account associated with this email.');
			</script>";
	}
	else
	{
		$Name=$_POST['first_name'].' '.$_POST['last_name'];
		$Password=$_POST['password'];
		$Gender=$_POST['sex'];
		$Birthday_Date=$_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$Join_Date=$_POST['join_time'];
		
		$day=intval($_POST['day']);
		$month=intval($_POST['month']);
		$year=intval($_POST['year']);
		if(checkdate($month,$day,$year))
		{
			$que2=mysql_query("insert into users(Name,Email,Password,Gender,Birthday_Date,Join_Date) values('$Name','$Email','$Password','$Gender','$Birthday_Date','$Join_Date')");

			session_start();
			$_SESSION['temp_user']=$Email;
		
		
			if($Gender=="Male")
			{
				header("location:files/step/step1/Male.php");
			}
			else
			{
				header("location:sfiles/step/step1/Female.php");
			}
		}
		else
		{
			echo "<script>
				alert('The selected date is not valid.');
			</script>";
		}
	}
}
?>
