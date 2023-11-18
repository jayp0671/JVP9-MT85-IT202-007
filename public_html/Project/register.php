<?php
require_once(__DIR__ ."/../../partials/nav.php");
?>
<form onsubmit="return validate(this)" method="POST">
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required />
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <div>
        <label for="confirm">Confirm</label>
        <input type="password" name="confirm" required minlength="8" />
    </div>
    <input type="submit" value="Register" />
</form>
<script>
    function validate(form) {
        //TODO 1: implement JavaScript validation
        //ensure it returns false for an error and true for success

        return true;
    }
</script>
<?php
 //TODO 2: add PHP Code
 if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm"])) {
    $email = se($_POST, "email", "", false); //$_POST["email"];
    $password = se($_POST, "password", "", false); //$_POST["password"];
    $confirm = se($_POST, "confirm", "", false); //$_POST["user"];
    //TODO 3
    $hasError = false;
    if(empty($email)) {
        echo "Email must not be empty <br>";
        $hasError = true;
    }
    // SANITIZE
    // $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = sanitize_email($email);
    /*if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email <br>";
        $hasError = true;
    }*/
    if(!is_valid_email($email)) {
        echo "Please enter a valid email <br>";
        $hasError = true;
    }
    if(empty($password)) {
        echo "Password must not be empty <br>";
        $hasError = true;
    }
    if(empty($confirm)) {
        echo "Confirm Password must not be empty <br>";
    }
    if(strlen($password) < 8) {
        echo "Password is too short <br>";
    }
    if(strlen($password) > 0 && $password !== $confirm) {
        echo "Passwords must match <br>";
        $hasError = true;
    }
    if(!$hasError) {
        echo "Welcome, $email";
    }
 }
?>