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
                            texto: 'No has llenado todos los campos',
                            confirmButtonText: 'Aceptar'
                        })
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
                                texto: 'El usuario no coincide con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            })
                        </script>
                    ";
                }else{
                    if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave)){
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Ocurrió un error inesperado',
                                texto: 'La clave no coincide con el formato solicitado',
                                confirmButtonText: 'Aceptar'
                            })
                        </script>
                    ";
                    }else{
                        
                    }
                }
            }



        }



    }