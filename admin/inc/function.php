<?php
function connect()
{
    // Create a new MySQLi object and establish 
    // a connection using the defined constants from 
    // the config file.
    $mysqli = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

    // Check if there is a connection error.
    if ($mysqli->connect_errno != 0) {

        // If an error occurs, retrieve the error details.
        $error = $mysqli->connect_error;
        // Get the current date and time in 
        // a human-readable format.
        $error_date = date("F j, Y, g:i a");

        // Create a message combining the error and the date.
        $message = "{$error} | {$error_date} \r\n";

        // Append the error message to a log file 
        // named 'db-log.txt'.
        file_put_contents("db-log.txt", $message, FILE_APPEND);
        // Return false to indicate a connection failure.
        return false;
    } else {
        // If the connection is successful, 
        // set the character set to "utf8mb4" which 
        // supports a wider range of characters. 
        $mysqli->set_charset("utf8mb4");

        // Return the MySQLi object, indicating 
        // a successful connection.
        return $mysqli;
    }
}

function registerUser($email, $username, $contact, $user_role, $password, $confirm_password)
{
    // Establish a database connection.
    $mysqli = connect();

    // Trim whitespace from input values.
    $email = trim($email);
    $username = trim($username);
    $password = trim($password);
    $contact = trim($contact);
    $confirm_password = trim($confirm_password);
    $user_role = trim($user_role);

    // Check if any field is empty.
    $args = func_get_args();
    foreach ($args as $value) {
        if (empty($value)) {
            // If any field is empty, return an error message.
            return "All fields are required";
        }
    }

    // Check for disallowed characters (< and >).
    foreach ($args as $value) {
        if (preg_match("/([<|>])/", $value)) {
            // If disallowed characters are found, return an error message.
            return "< and > characters are not allowed";
        }
    }

    // Validate email format.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If email is not valid, return an error message.
        return "Email is not valid";
    }

    // Check if the email already exists in the database.
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If email already exists, return an error message.
        return "Email already exists";
    }
    $stmt = $mysqli->prepare("SELECT email FROM admin_request WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If email already exists, return an error message.
        return "Email already exists";
    }

    // Check if the username is too long.
    if (strlen($username) > 100) {
        // If username is too long, return an error message.
        return "Username is too long";
    }

    // Check if the username already exists in the database.
    $stmt = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If username already exists, return an error message.
        return "Username already exists, please use a different username";
    }

    // Check if the Phone number already exists in the database.
    $stmt = $mysqli->prepare("SELECT contact FROM users WHERE contact = ?");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If username already exists, return an error message.
        return "Contact number already exists, please use a different contact number";
    }
    // Check if the username already exists in the database.
    $stmt = $mysqli->prepare("SELECT username FROM admin_request WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If username already exists, return an error message.
        return "Username already exists, please use a different username";
    }

    // Check if the Phone number already exists in the database.
    $stmt = $mysqli->prepare("SELECT contact FROM admin_request WHERE contact = ?");
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    if ($stmt->get_result()->num_rows > 0) {
        // If username already exists, return an error message.
        return "Contact number already exists, please use a different contact number";
    }

    if (strlen($password) > 255) {
        // If password is too long, return an error message.
        return "Password is too long";
    }

    if ($password != $confirm_password) {
        // If passwords don't match, return an error message.
        return "Passwords don't match";
    }

    if ($user_role == "Select Role") {
        return "Please select the role";
    }
    // Hash the password for security.
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // $user_role = "voter";

    // Insert user data into the 'users' table.
    if ($user_role == "cadmin") {
        $stmt = $mysqli->prepare("INSERT INTO users (username,contact, password, email,user_role) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("sssss", $username, $contact, $hashed_password, $email, $user_role);
        $stmt->execute();
        // Check if the insertion was successful.
        if ($stmt->affected_rows != 1) {
            return "An error occurred. Please try again";
        } else {
            // If successful, return a success message.
            return "adminsuccess";
        }
    } else {
        $stmt = $mysqli->prepare("INSERT INTO users (username,contact, password, email,user_role) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("sssss", $username, $contact, $hashed_password, $email, $user_role);
        $stmt->execute();

        // Check if the insertion was successful.
        if ($stmt->affected_rows != 1) {
            return "An error occurred. Please try again";
        } else {
            // If successful, return a success message.
            return "success";
        }
    }
    $mysqli->close();
}


function loginUser($email, $password)
{
    // Establish a database connection.
    $mysqli = connect();

    // Trim leading and trailing whitespaces from email and password.
    $email = trim($email);
    $password = trim($password);

    // Check if either email or password is empty.
    if ($email == "" || $password == "") {
        return "Both fields are required";
    }

    // Sanitize email and password to prevent SQL injection.
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    // Prepare SQL statement to select email and password from users table.
    $sql = "SELECT email, password, user_role, username FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);

    // Bind the email parameter to the prepared statement.
    $stmt->bind_param("s", $email);

    // Execute the prepared statement to query the database.
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    // Check if the email exists in the database.
    if ($data == NULL) {
        return "Wrong username or password";
    }
    // Verify the provided password against the hashed password in the database.
    if (password_verify($password, $data["password"]) === FALSE) {
        return "Wrong email or password";
    } else {
        // If authentication is successful, set the user session and redirect to account page.

        session_start();
        $_SESSION["user_role"] = $data['user_role'];
        $_SESSION["username"] = $data['username'];
        if ($data['user_role'] == "admin") {
            $_SESSION['Key'] = "AdminKey";
            header('Location: ../administrator/admin_welcome.php');
            exit();
        } elseif($data['user_role'] == "voter") {
            $_SESSION['Key'] = "VoterKey";
            header('Location: ../voter/member_welcome.php');
            exit();
        }elseif($data['user_role'] == "suadmin"){
            $_SESSION['Key'] = "SuAdminKey";
            header('Location: ../hero/index.php');
            exit();
        }
    }
    $mysqli->close();
}

function logoutUser()
{
    session_destroy();
    header("location: login.php");
    exit();
}

function validateInput($data)
{
    // Trim whitespace from input values.
    $data = trim($data);
    $data = stripslashes($data);
    $args = func_get_args();
    foreach ($args as $value) {
        if (preg_match("/([<|>])/", $value)) {
            // If disallowed characters are found, return an error message.
            return false;
        }
    }
    $filteredInput = filter_var($data, FILTER_SANITIZE_STRING);
    return $filteredInput;
    return true;
}

function getStatus($starting_date, $ending_date)
{
    $currentDate = date('Y-m-d');

    if ($currentDate >= $starting_date && $currentDate <= $ending_date) {
        return 'Active';
    } elseif ($currentDate < $starting_date) {
        return 'Pending';
    } else {
        return 'Inactive';
    }
}

function winner()
{
    $mysqli = connect();
    $stmt = $mysqli->prepare('SELECT MAX(vote) FROM candidate;');
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    return $data;
}
