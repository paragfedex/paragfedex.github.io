<?PHP
	if (isset($_POST["txt_username"]))
	{
	$user_id = $_POST['txt_username'];
	}
	if (isset($_POST["pswd_password"]))
	{
	$password = $_POST['pswd_password'];
	}
	$connection = @mysqli_connect("localhost", "root", "","leavesystemphp") or die(mysqli_error());
	$sql = "SELECT * FROM leavesystemphp.login WHERE user_id = '".$user_id."' AND password = '".$password."'";
	$result = mysqli_query($sql, $connection);
	if(mysql_num_rows($result))
	{
		while($row = mysql_fetch_array($result))
		{
			$user_type = $row['user_type'];x
			$db_password = $row['password'];
			
			if((!(strcmp($db_password, $password))) && $user_type == "admin")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				//Opens add_staff page if username and password matches
				header("Location: admin/index.php");
			}
			else if((!(strcmp($db_password, $password))) && $user_type == "Staff")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				$_SESSION['staff_id'] = $user_id;
				echo
				//Opens add_staff page if username and password matches
				header("Location: staff/index.php");
				//echo "staff";
			}
			else if((!(strcmp($db_password, $password))) && $user_type == "PC")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				$_SESSION['pc_id'] = $user_id;
				header("Location: pc/index.php");
				//Opens add_staff page if username and password matches
				//header("Location: admin/add_staff.php");
			}
		}
	}
	else
	{
		echo	"<script>
			alert(\"Incorrect Username and Password Match.\");
			window.location=\"index.php\";</script>";
	}
?>