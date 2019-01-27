<?php
if(isset($_POST['Login']))
{error_reporting(1);
mysql_connect("localhost","root","");
mysql_select_db("saurabh");

$user=$_POST['username'];
$pass=$_POST['password'];

$que1=mysql_query("select * from users where Email='$user' and Password='$pass'");
$count1=mysql_num_rows($que1);

if($count1>0)
{
    session_start();
    $_SESSION['temp_user']=$user;
    $que6=mysql_query("select * from users where Email='$user'");
    $rec6=mysql_fetch_array($que6);
    $userid=$rec6[0];
    
    $que2=mysql_query("select * from user_profile_pic where user_id=$userid");
    $count2=mysql_num_rows($que2);
    
    if($count2>0)
    {
        $que3=mysql_query("select * from user_secret_quotes where user_id=$userid");
        $count3=mysql_num_rows($que3);
        if($count3>0)
        {
            $que4=mysql_query("select * from user_secret_quotes where user_id=$userid");
            
            while($rec=mysql_fetch_array($que4))
            {
                $que2=$rec[3];
                $ans2=$rec[4];
            }
            if($que2=="" && $ans2=="")
            {
                header("location:files/step/step3/Secret_Question2.php");
            }
            else
            {
                
                session_start();
                $_SESSION['user']=$user;
                $query1=mysql_query("select * from users where Email='$user'");
                $rec1=mysql_fetch_array($query1);
                $userid=$rec1[0];
                mysql_query("update user_status set status='Online' where user_id='$userid'");
                header("location:files/home/Home.php");
            }
            
        }
        else
        {
            header("location:files/step/fstep2/Secret_Question1.php");
        }
    }
    else
    {
        while($rec=mysql_fetch_array($que1))
        {
            $Gender=$rec[4];
        }
        if($Gender=="Male")
        {
            header("location:files/step/step1/Male.php");
        }
        else
        {
            header("location:files/step/step1/Female.php");
        }
    }
}
else
{
    $que5=mysql_query("select * from users where Email='$user'");
    $count5=mysql_num_rows($que5);
    
    if($count5>0)
    {
        header("location:files/forgot_invalid/Invalid_Password.php");
    }
    else
    {
        header("location:files/forgot_invalid/Invalid_Username.php");
    }
}
}
?>
