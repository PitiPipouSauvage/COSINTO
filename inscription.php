<?php include 'connect_db.php'; ?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Inscription</title>
            <meta charset="utf-8">
            <link rel="stylesheet" href="inscription.css">
        </head>
        <body>
            <script>
                function start_process() {
                    console.log("helloworld");
                } 

                function end_process() {
                    console.log("helloworld");
                } 

                function password_match() {
                    var first_password = document.getElementById('password');
                    var confirmation_password = document.getElementById('confirm_password');

                    if (first_password !== confirmation_password) {
                        document.getElementById("no_match").innerHTML = "The two passwords don't match !";
                        document.getElementById("inscription_form").reset();
                        return false;
                    } 

                    first_password = null;
                    confirmation_password = null;
                    return true;
                }
            </script>

            <?php if (isset($_POST)): ?>
                <script> start_process(); </script>
                <?php 
                    $query = $mysqli->prepare("SELECT id FROM ? WHERE username=? AND password=?");
                    $query->bind_param("sss", $config["users_table"], $_POST["username"], $_POST["password"]);
                    $query->execute();
                    $is_taken = $query->fetch();
                    // $query->closeCursor();
                    if ($is_taken == 0): ?>
                        <script> end_process(); </script>
                    <?php else : ?>
                        <?php 
                            $query = $mysqli->prepare("INSERT INTO ? VALUES(?, ?) ");
                            $query->bind_param("sss", $config["users_table"], $_POST["username"], $_POST["password"]);
                            $query->execute();
                            // $query->closeCursor();
                        ?>
                    <?php endif; ?>
                
            <?php endif; ?>

            <fieldset>
                <form id="inscription_form" method="post" action="inscription.php">
                    <p>
                        <label for="username"> Username </label> : <input type="text" name="username" id="username" placeholder="username" required autofocus />
                    </p>
                    <p>
                        <label for="password"> Password </label> : <input type="password" name="password" id="password" minlength="16" required />
                    </p>
                    <p>
                        <label for="confirm_password"> Confirm password </label> : <input type="password" name="confirm_password" id="confirm_password" minlength="16" required />
                        <label id="no_match"></label>
                    </p>
                    <p>
                        <input type='submit' action="password_match" name="Submmit" />
                    </p>
                </form>
            </fieldset>
        </body>
    </html>
