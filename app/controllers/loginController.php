<?php

    namespace app\controllers;

    use app\models\mainModel;

    class loginController extends mainModel{
        
        # CONTROLADOR iniciar sesión #
        public function iniciarSesionControlador(){

            # Almacenando datos en variables #
            $usuario = $this->limpiarCadena($_POST['login_usuario']);
            $clave = $this->limpiarCadena($_POST['login_clave']);

            # Verificando campos obligatorios #
            if ($usuario == "" || $clave == ""){
                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrió un error inesperado',
                            text: 'No has llenado todos los campos',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
            }else{
                # Verificando integridad de los datos #
                if($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)){
                    echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrió un error inesperado',
                                text: 'El usuario no coincide con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>
                    ";
                }else{
                    if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)){
                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error inesperado',
                                    text: 'La clave no coincide con el formato solicitado',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";
                    }else{
                        # Verificando usuario #
                        $check_usuario = $this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_usuario='$usuario'");

                        if($check_usuario->rowCount()==1){
                            $check_usuario = $check_usuario->fetch();

                            if($check_usuario['usuario_usuario']==$usuario
                            && password_verify($clave, $check_usuario['usuario_clave'])){
                                
                                $_SESSION['id'] = $check_usuario['usuario_id'];
                                $_SESSION['nombre'] = $check_usuario['usuario_nombre'];
                                $_SESSION['apellido'] = $check_usuario['usuario_apellido'];
                                $_SESSION['usuario'] = $check_usuario['usuario_usuario'];
                                $_SESSION['foto'] = $check_usuario['usuario_foto'];

                                if(headers_sent()){
                                    echo "
                                        <script>
                                            window.location.href='".APP_URL."dashboard/';
                                        </script>
                                    ";
                                }else{
                                    header("Location: ".APP_URL."dashboard/");
                                }

                            }else{
                                echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrió un error inesperado',
                                        text: 'Usuario o clave incorrectos',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                            ";
                            }

                        }else{
                            echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrió un error inesperado',
                                    text: 'Usuario o clave incorrectos',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";
                        }
                    }
                }
            }



        }

        # CONTROLADOR CERRAR SESIÓN #
        public function cerrarSesionControlador(){

            session_destroy();
            
            if(headers_sent()){
                echo "
                    <script>
                        window.location.href='".APP_URL."login/';
                    </script>
                ";
            }else{
                header("Location: ".APP_URL."login/");
            }

        }



    }