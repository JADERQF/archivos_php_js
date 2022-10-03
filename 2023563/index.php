<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Login</title> 
</head>
<body>  
        <form action="login.php" method="POST" >
           
                <div>
                    <h2>Inicia sesión en DS</h2>
                </div>
                <div class="div-datos">
                    <div>
                        <p>Usuario</p>
                        <input type="text" name="usuario" required>            
                    </div>
                    
                    <div>
                        <p>Contraseña</p>
                        <input type="password" name="clave" required>
                    </div>
                </div>
                <div class="div-submit">
                    <input type="submit" value="Sing in" > 
                    <a href="signup.php">create an account.</a>
                </div>

        </form>

</body>

</html>