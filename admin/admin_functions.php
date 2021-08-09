<?php 

	function escape($string) {
		global $connection;
		return mysqli_real_escape_string($connection, trim($string));
	}

	function confirm($result) {
		global $connection;
		if (!$result) {
      		die("Query Failed "  . mysqli_error($connection));
    	}
	}

	function redirect($location) {
		global $connection;
		header("Location:" . $location);
		exit;
	}

	function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;
    }
    	return false;
	}

	function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;
    }
   		return false;
	}

	function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

	}

	function users_online() {
		global $connection;
		
		$session = session_id();
        $time = time();
        $time_out_in_seconds = 05;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session' ";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, ttime) VALUES ('$session', '$time')");
        } else {
            mysqli_query($connection, "UPDATE users_online SET ttime = '$time' WHERE session = '$session' ");
        }

        $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE ttime > '$time_out' ");
       return $count_users = mysqli_num_rows($users_online);
	}

	function insert_categories(){

		global $connection;
		 if (isset($_POST['submit'])) {
	        # code...
	        $cat_title = $_POST['cat_title'];

	        if ($cat_title == "" || empty($cat_title)) {
	            # code...
	            echo "<h1 class='text-center text-danger'>This field can not be blank!!</h1>";
	        } else {

	        	// This code is working but I preferably use the prepare statement for security purpose

	            // $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
	            // $createCategoryQuery = mysqli_query($connection, $query);

	            // if (!$createCategoryQuery) {
	            //     # code...
	            //     die("Query Failed" . mysqli_error($connection));
	            // }

	            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");

        		mysqli_stmt_bind_param($stmt, 's', $cat_title);

        		mysqli_stmt_execute($stmt);
	        }
	    }
	}

	function insert_aboutus(){

		global $connection;
		 if (isset($_POST['submit'])) {
	        $aboutus_content = $_POST['aboutus_content'];

	        if ($aboutus_content == "" || empty($aboutus_content)) {
	            # code...
	            echo "<h1 class='text-center text-danger'>This field can not be blank!!</h1>";
	        } else {

	            $stmt = mysqli_prepare($connection, "INSERT INTO about(about_content) VALUES(?) ");

        		mysqli_stmt_bind_param($stmt, 's', $aboutus_content);

        		mysqli_stmt_execute($stmt);
	        }
	    }
	}	

	function findAllCategories() {
		global $connection;
		$query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selectCategories)) {
            # code...
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
            echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "</tr>";
        }
	}

	function displayAboutus() {
		global $connection;
		$query = "SELECT * FROM about";
        $selectabout = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($selectabout)) {
            # code...
            $about_id = $row['about_id'];
            $about_content = $row['about_content'];

            echo "<tr>";
            echo "<td>{$about_id}</td>";
            echo "<td>{$about_content}</td>";
            echo "<td><a class='btn btn-info' href='about.php?edit={$about_id}'>Edit</a></td>";
            echo "</tr>";
        }
	}

	function deleteCategories() {
		global $connection;
		if (isset($_GET['delete'])) {
            $theCatId = $_GET['delete'];

            $query = "DELETE FROM categories WHERE cat_id = {$theCatId} ";
        $deleteQuery = mysqli_query($connection, $query);
        header("Location: categories.php ");
        }
	}

	// These codes takes effect in the admin.php panel
	function recordCount($table) {
		global $connection;

		$query = "SELECT * FROM " . $table;
	    $selectPost = mysqli_query($connection, $query);
	    
	    $result = mysqli_num_rows($selectPost);
	    confirm($result);

	    return $result;
	}

	function checkStatus($table, $colunm, $status) {
		global $connection;

		$query = "SELECT * FROM $table WHERE $colunm = '$status' ";
	    $select_published_post = mysqli_query($connection, $query);

	    $result = mysqli_num_rows($select_published_post);
	    // confirm($result);

	    return $result;
	}

	// Login functions below

	function is_admin($username) {

	    global $connection; 

	    $query = "SELECT user_role FROM users WHERE username = '$username'";
	    $result = mysqli_query($connection, $query);
	    confirm($result);

	    $row = mysqli_fetch_array($result);


	    if($row['user_role'] == 'admin'){

	        return true;

	    }else {


	        return false;
	    }

	}



	function username_exists($username){

	    global $connection;

	    $query = "SELECT username FROM users WHERE username = '$username'";
	    $result = mysqli_query($connection, $query);
	    confirm($result);

	    if(mysqli_num_rows($result) > 0) {

	        return true;
	    } else {

	        return false;
	    }
	}



	function email_exists($email){

	    global $connection;

	    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
	    $result = mysqli_query($connection, $query);
	    confirm($result);

	    if(mysqli_num_rows($result) > 0) {

	        return true;

	    } else {

	        return false;
	    }
	}


	function register_user($first_name, $last_name, $email, $password){

	    global $connection;

	    $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);
	    $email    = mysqli_real_escape_string($connection, $email);
	    $password = mysqli_real_escape_string($connection, $password);

	    $password = password_hash( $password, PASSWORD_BCRYPT, array('cost' => 12));
	        
	        
	    $query = "INSERT INTO users(user_firstname, user_lastname, user_email, user_password, user_role) VALUES('{$first_name}', '{$last_name}', '{$email}', '{$password}', 'subscriber')";
	    $register_user_query = mysqli_query($connection, $query);

	    confirm($register_user_query);
	}

	function login_user($email, $password){

		global $connection;

		$email = trim($email);
		$password = trim($password);

		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);


		$query = "SELECT * FROM users WHERE user_email = '{$email}' ";
		$select_user_query = mysqli_query($connection, $query);
		if (!$select_user_query) {

		    die("QUERY FAILED" . mysqli_error($connection));
		}


	 	while ($row = mysqli_fetch_array($select_user_query)) {

	     $db_user_id = $row['user_id'];
	     $db_user_email = $row['user_email'];
	     $db_user_password = $row['user_password'];
	     $db_user_firstname = $row['user_firstname'];
	     $db_user_lastname = $row['user_lastname'];
	     $db_user_role = $row['user_role'];

		// password encryption for login
	     if (password_verify($password,$db_user_password)) {

	         $_SESSION['email'] = $db_user_email;
	         $_SESSION['firstname'] = $db_user_firstname;
	         $_SESSION['lastname'] = $db_user_lastname;
	         $_SESSION['user_role'] = $db_user_role;



	         redirect("admin/");
	     	} else {
	         return false;
	    	}
	 	}

	 	return true;
	}
?>