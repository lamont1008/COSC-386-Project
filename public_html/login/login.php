<html>

<head>
    <title>Salisbury Club Database</title>
    <meta charset="UTF-8">
    <!-- jQuery library for the javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() { //this script runs tests the user's submission to see if its in the database

            $("form").on("submit", function(event) {
                event.preventDefault();
                var login_values = $(this).serialize();

                $.post("login_attempt.php", login_values, function(data) {
                    //      alert(data);
                    data = JSON.parse(data);
                    //     alert(data);   //this is what gets echoed in login_attempt.php it is a json string
                    //thie email
                    //alert(result);
                    //alert(id_email);      debugging purposes
                    if (data[0] === 0) { //valid email load into homepage
                        $("#result").html("valid login");
                        $.post("session_write.php", {
                            email: data[1]
                        })
                        window.location.href = "../SQL.php";


                    } else { //invalid display invalid
                        //              alert("invalid");
                        $("#result").html("invalid login");
                    }
                });
            });
        });
    </script>
</head>
<link rel="stylesheet" href="../SQL.css" type="text/css" />
<div class="header"><a href="../SQL.php">Salisbury Club Database</a></div>
<div class="header2"><a href="login.php">Login</a></div>
<center>
    <h1 style="border-style:block; background-color:white;"> Admin Login Form </h1>
</center>

<body class="login">
<img src="../images/logo.png" alt="Bury Logo" style="width:250px; height:420px; position: absolute; right: 100px; -webkit-transform: scaleX(-1);  transform: scaleX(-1);">
<img src="../images/logo.png" alt="Bury Logo" style="width:250px; height:420px; position: absolute; left: 100px;">
    <pre style = "background-color: white; border-style: none; "><p class = "login"><form class = "lform" action="login.php" style = "margin:auto;">
    <div class="container">            <label>Username: </label>
            <input type="text2" placeholder="Enter Email" name="email" required>
            <label>Password: </label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <button type="submit">Login</button>
            <div id="result"></div>
    </div>
    </form>
        </p></pre>
</body>
<footer>
    <p class="foot"><sub>&copy;2021</sub></p>
</footer>

</html>