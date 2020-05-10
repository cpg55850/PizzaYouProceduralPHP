<?php
    include_once("header.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = '';
        if (empty($_POST['email'])) {
            $emailError = 'Please add your email';
        } else {
            $email = trim(htmlspecialchars($_POST['email']));
        }
    }

    if(isset($_POST['submit'])){        
        $email = trim(htmlspecialchars($_POST['email']));
        $pwd = trim(htmlspecialchars($_POST['pwd']));
        
        //Error handlers
        //Check if inputs are empty
        if(empty($email) || empty($pwd)){
                echo("<div class='container'>Empty fields.</div>");
            } else {
                $sql = "SELECT * FROM PIZZA_YOU_users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                if($resultCheck < 1){
                    echo("<div class='container'>No user under that name.</div>");
                } else {
                    if($row = mysqli_fetch_assoc($result)){
                        //De-hashing the password
                        $enteredPwdHashed = sha1($pwd);
                        if($enteredPwdHashed != $row['password']){
                            echo("<div class='container'>Wrong e-mail or password.</div>");
                        } elseif($enteredPwdHashed == $row['password']){
                            //Log in the user here
                            $_SESSION['customer_id'] = $row['customer_id'];
                            $_SESSION['u_name'] = $row['username'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['user_type'] = $row['user_type'];
                            header("Location: ./");
                            exit();
                        }
                    }
                }
            }
        }
?>

<div class="container">
    <h2>Log in form</h2>

    <form id="login_form" method="POST" action="">
        <p>
            <label for="email">E-mail:
                <input type="email" name="email" id="form_email" placeholder="Enter your email"
                    value="<?php if(isset($email)) echo $email; ?>">
            </label>
        </p>
        <span class="error-form" id="email-error"></span>
        <p>
            <label for="pwd">Password:
                <input type="password" name="pwd" id="form_pwd" placeholder="Enter your password">
            </label>
        </p>
        <span class="error-form" id="pwd-error"></span>
        <p>
            <input type="submit" name="submit"></input>
        </p>
    </form>

    <br>

    <p><a href="register.php">Register</a></p>
    <p><a href="logout.php">Logout</a></p>

</div>

<script src="script.js"></script>

<?php
    include_once("footer.php");
?>