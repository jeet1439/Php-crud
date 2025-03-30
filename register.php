<?php
include "layout/boilerplate.php";
//if user is authenticated he should not get accress of rejister page
if(isset($_SESSION["email"])){
    header("location: /index.php");
    exit;
}


$first_name = $last_name = $email = $phone = $address = $password = $confirm_password = "";
$first_name_error = $last_name_error = $email_error = $phone_error = $address_error = $password_error = $confirm_password_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // First Name Validation
    if (empty($first_name)) {
        $first_name_error = 'First name is mandatory';
        $error = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $first_name)) {
        $first_name_error = 'Only letters and spaces allowed';
        $error = true;
    }

    // Last Name Validation
    if (empty($last_name)) {
        $last_name_error = 'Last name is mandatory';
        $error = true;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $last_name)) {
        $last_name_error = 'Only letters and spaces allowed';
        $error = true;
    }

    // Email Validation
    if (empty($email)) {
        $email_error = 'Email is mandatory';
        $error = true;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Invalid email format';
        $error = true;
    }
    include "tools/db.php";
    $dbConnection = getDatabaseConnection();
    $statement = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    
    $statement->store_result();
    if($statement->num_rows > 0){
        $email_error = "email already used";
        $error = true;
    }

    $statement->close();

    // Phone Validation
    if (empty($phone)) {
        $phone_error = 'Phone number is mandatory';
        $error = true;
    } elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $phone_error = 'Phone number must be 10 digits';
        $error = true;
    }

    // Address Validation
    if (empty($address)) {
        $address_error = 'Address is mandatory';
        $error = true;
    }

    // Password Validation
    if (empty($password)) {
        $password_error = 'Password is mandatory';
        $error = true;
    } elseif (strlen($password) < 6) {
        $password_error = 'Password must be at least 6 characters long';
        $error = true;
    }

    // Confirm Password Validation
    if (empty($confirm_password)) {
        $confirm_password_error = 'Confirm password is mandatory';
        $error = true;
    } elseif ($password !== $confirm_password) {
        $confirm_password_error = 'Passwords do not match';
        $error = true;
    }

    if (!$error) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');

        $statement = $dbConnection->prepare(
            "INSERT INTO users (first_name, last_name, email, phone, address, password, created_at) " .
                 "VALUES(?, ?, ?, ?, ?, ?, ?)"
        );

        $statement->bind_param('sssssss', $first_name, $last_name, $email, $phone, $address, $password, $created_at);
        $statement->execute();
        $insert_id = $statement->insert_id;
        $statement->close();
        
        $_SESSION["id"] = $insert_id;
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["email"] = $email;
        $_SESSION["phone"] = $phone;
        $_SESSION["address"] = $address;
        $_SESSION["created_at"] = $created_at;
        
        echo "<div class='alert alert-success text-center'>Registration successful!</div>";

        header("location: /index.php");
        exit;
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr>
            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                        <span class="text-danger"><?php echo $first_name_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                        <span class="text-danger"><?php echo $last_name_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        <span class="text-danger"><?php echo $email_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                        <span class="text-danger"><?php echo $phone_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?php echo htmlspecialchars($address); ?>">
                        <span class="text-danger"><?php echo $address_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="password">
                        <span class="text-danger"><?php echo $password_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" name="confirm_password">
                        <span class="text-danger"><?php echo $confirm_password_error; ?></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="/index.php" class="btn btn-outline-primary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
