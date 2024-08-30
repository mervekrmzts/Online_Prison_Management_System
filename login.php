

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .login-container {
            width: 300px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
            background:transparent;
            backdrop-filter:blur(5px);
            text-align: center;
            font-family: Arial, sans-serif;
            
        }   
         .login-container h2{
            color:#8b795e;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #fff; 
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #8b795e;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color:#cdb38b;
        }
    </style>
    
</head>
<body>

    <div class="login-container">
        <h2>LOG IN</h2>
        <form action="login_process.php" method="post">
            <label for="username">User Name:</label>
            <input type="text" name="username" >
            <input type="hidden" name="submit" value="1">
            <label for="password">Password:</label>
            <input type="password" name="password">

            <button type="submit">Log In</button>

        </form>
    </div>
    </body>
</html>



