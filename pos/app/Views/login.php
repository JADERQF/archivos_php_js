<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Inicio de sesión </title>
    <link rel="icon" href="<?php echo base_url(); ?>/usericon.png" type="image/png">
    <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="<?php echo base_url(); ?>/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container p-4">
                    <div class="row justify-content-center">
                        <div class="card shadow-lg mt-5">
                            <div class="mt-2 text-center">
                                <img src="<?php echo base_url() ?>/dragon-solid.svg" width="83">
                                <!-- <i class="fas fa-dragon fa-4x"></i> -->
                            </div>
                            <div class="card-body">
                                <h2>Inicio de sesión en DS</h2>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?php echo base_url(); ?>/usuarios/validar">
                                    <div class="form-group">
                                        <label class="mb-2" for="usuario">Usuario</label>
                                        <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Enter nickname" required/>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-2" for="password">Contraseña</label>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required/>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button class="btn btn-primary" type="submit">Ingresar</button>
                                        <a href="<?php echo base_url();?>/usuarios/nuevoUser">create an account?</a>

                                    </div>
                                    <?php if(isset($validation)){ ?> <!-- si existe validation mostrar el alert con listErrors-->
                                        <div class="alert alert-danger mt-3 text-center">
                                            <?php echo $validation-> listErrors(); ?>
                                        </div>
                                        <?php } ?>

                                    <?php if(isset($error)){ ?> <!-- si existe validation mostrar el alert con listErrors-->
                                        <div class="alert alert-danger mt-3 text-center">
                                            <?php echo $error; ?>
                                        </div>
                                        <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; DS <?php echo date("Y"); ?></div>
                        <div>
                            <a href="https://www.facebook.com" target="_blank">Facebook</a>
                            &middot;
                            <a href="https://www.instagram.com" target="_blank">Instagram &mcy;</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url(); ?>/js/scripts.js"></script>
</body>

</html>