<?php
	session_start();

	function logged_in() {
		if(isset($_SESSION['id'])) {
			return true;
		} else {
			return false;
		}
	}

	function userdata($username) {
		global $connect;
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$query = $connect->query($sql);
		$result = $query->fetch_assoc();
		if($query->num_rows == 1) {
			return $result;
		} else {
			return false;
		}
	
		$connect->close();
		// close the database connection
	}
	
	function login($username, $password) {
		global $connect;
		$userdata = userdata($username);
	
		if($userdata) {
			$makePassword = makePassword($password, $userdata['salt']);
			$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$makePassword'";
			$query = $connect->query($sql);
	
			if($query->num_rows == 1) {
				return true;
			} else {
				return false;
			}
		}
	
		$connect->close();
		// close the database connection
	}

	function logout() {
		if(logged_in() === TRUE){
			// remove all session variable
			session_unset();
	
			// destroy the session
			session_destroy();
	
			header('location: index.php');
		}
	}
	
	function getUserDataByUserId($id) {
		global $connect;
	
		$sql = "SELECT * FROM users WHERE id = $id";
		$query = $connect->query($sql);
		$result = $query->fetch_assoc();
		return $result;
	
		$connect->close();
	}

	function userExists($username) {
        global $connect;

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = $connect->query($sql);
        if($query->num_rows == 1) {
            return true;
        } else {
            return false;
        }

        $connect->close();
	}
	
	function salt($length) {
		return random_bytes($length);
	}
	
	function makePassword($password, $salt) {
		return hash('sha256', $password.$salt);
	}

	function registerUser() {

		global $connect;
	
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$salt = salt(32);
		$newPassword = makePassword($password, $salt);
		if($newPassword) {
			$sql = "INSERT INTO users (firstname, lastname, username, password, salt, active) VALUES ('$fname', '$lname', '$username', '$newPassword', '$salt' , 1)";
			$query = $connect->query($sql);
			if($query === TRUE) {
				return true;
			} else {
				return false;
			}
		}
	
		$connect->close();
	}
?>