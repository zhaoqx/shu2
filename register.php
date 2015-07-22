<?php 
    require_once ("Includes/simplecms-config.php"); 
    require_once  ("Includes/connectDB.php");
    include("Includes/header.php"); 

    function check_invite($invite_code, $old_user, $username) {
        global  $databaseConnection;
        $query_check = "UPDATE invite_code SET new_user = ?, status = ? WHERE old_user = ? and invite_code = ? and status = 0";
        $statement_check = $databaseConnection->prepare($query_check);
        $statement_check->bind_param('sdss', $username, $status_check, $old_user, $invite_code);
        $status_check = 1;
        $statement_check->execute();
        $statement_check->store_result();

        if ($statement_check->error)
        {
            die('Database query failed: ' . $statement->error);
        }

        $updateWasSuccessful = $statement_check->affected_rows == 1 ? true : false;
        if (!$updateWasSuccessful)
        {
            exit("验证码校验错误");
        }
    }

    if (isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $old_user = $_POST['old_user'];
        $invite_code = $_POST['invite_code'];

        //校验验证码
        check_invite($invite_code, $old_user, $username);

        $query = "INSERT INTO users (username, password) VALUES (?, SHA(?))";

        $statement = $databaseConnection->prepare($query);
        $statement->bind_param('ss', $username, $password);
        $statement->execute();
        $statement->store_result();

        $creationWasSuccessful = $statement->affected_rows == 1 ? true : false;
        if ($creationWasSuccessful)
        {
            $userId = $statement->insert_id;

            $addToUserRoleQuery = "INSERT INTO users_in_roles (user_id, role_id) VALUES (?, ?)";
            $addUserToUserRoleStatement = $databaseConnection->prepare($addToUserRoleQuery);

            // TODO: Extract magic number for the 'user' role ID.
            $userRoleId = 2;
            $addUserToUserRoleStatement->bind_param('dd', $userId, $userRoleId);
            $addUserToUserRoleStatement->execute();
            $addUserToUserRoleStatement->close();

            $_SESSION['userid'] = $userId;
            $_SESSION['username'] = $username;
            header ("Location: index.php");
        }
        else
        {
            echo "Failed registration";
        }
    }
?>
<div id="main">
    <h2>Register an account</h2>
        <form action="register.php" method="post">
            <fieldset>
                <legend>Register an account</legend>
                <ol>
                    <li>
                        <label for="username">Username:</label> 
                        <input type="text" name="username" value="" id="username" />
                    </li>
                    <li>
                        <label for="password">Password:</label>
                        <input type="password" name="password" value="" id="password" />
                    </li>
                    <li>
                        <label for="old_user">推荐人:</label> 
                        <input type="text" name="old_user" value="" id="old_user" />
                        <label for="invite_code">邀请码:</label> 
                        <input type="text" name="invite_code" value="" id="invite_code" />
                    </li>
                </ol>
                <input type="submit" name="submit" value="Submit" />
                <p>
                    <a href="index.php">Cancel</a>
                </p>
            </fieldset>
        </form>
     </div>
</div> <!-- End of outer-wrapper which opens in header.php -->
<?php
    include ("Includes/footer.php");
?>