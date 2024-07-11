<?php
    namespace app\controllers;
    use app\models\mainModel;

    class userController extends mainModel{

        # Controlador registrar usuario #
        public function registrarUsuarioControlador(){

            # Almacenando datos #
            $nombre = $this->limpiarCadena($_POST['usuario_nombre']);
            $apellido = $this->limpiarCadena($_POST['usuario_apellido']);
            $usuario = $this->limpiarCadena($_POST['usuario_usuario']);
            $email = $this->limpiarCadena($_POST['usuario_email']);
            $clave1 = $this->limpiarCadena($_POST['usuario_clave_1']);
            $clave2 = $this->limpiarCadena($_POST['usuario_clave_2']);

            # Verificando campos obligatorios #
            if($nombre=="" || $apellido=="" || $usuario=="" || $clave1 == "" || $clave2=""){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                    
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificando integridad de los datos #
            if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El nombre no coincide con el formato solicitado",
                    "icono"=>"error"
                    
                ];
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El apellido no coincide con el formato solicitado",
                    "icono"=>"error"
                    
                ];
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$usuario)){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El usuario no coincide con el formato solicitado",
                    "icono"=>"error"
                    
                ];
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave1) || 
            $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"Las claves no coincide con el formato solicitado",
                    "icono"=>"error"
                    
                ];
                return json_encode($alerta);
                exit();
            }

            # Verificando email #
            if ($email != ""){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $check_email = $this->ejecutarConsulta(
                        "SELECT usuario_email FROM usuario WHERE
                        usuario_email='$email' ");

                        if($check_email->rowCount()>0){
                            $alerta = [
                                "tipo"=>"simple",
                                "titulo"=>"Ocurrió un error inesperado",
                                "texto"=>"El email que ha ingresado
                                ya se encuentra registrado",
                                "icono"=>"error"
                            ];
                            return json_encode($alerta);
                            exit();
                        }

                } else {
                    $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"Ha ingresado un email no válido",
                    "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }

            # Verificando claves #
            if($clave1 != $clave2){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"Las contraseñas que acaba de ingresar no coinciden",
                    "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
            } else {
                $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost"=>10]);
            }

            # Verificando usuario #
            $check_usuario = $this->ejecutarConsulta(
                "SELECT usuario_usuario FROM usuario WHERE
                usuario_usuario='$usuario' ");
            if($check_usuario->rowCount()>0){
                $alerta = [
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"El usuario que ha ingresado
                    ya se encuentra registrado",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            # Directorio de imágenes #
            $img_dir = "../views/fotos/";

            # Comprobar si se ha seleccionado una imagen #
            if($_FILES['usuario_foto']['name'] != "" && 
                $_FILES['usuario_foto']['size'] >0){
                # Creando directorio #
                if(!file_exists($img_dir)){
                    if(!mkdir($img_dir, 0777)){
                        $alerta = [
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrió un error inesperado",
                            "texto"=>"Error al crear el directorio",
                            "icono"=>"error"
                        ];
                        return json_encode($alerta);
                        exit();
                    }
                }

                # Verificando formato de imágenes #
                if(mime_content_type($_FILES['usuario_foto']['tmp_name']) != "image/jpeg" && mime_content_type($_FILES['usuario_foto']['tmp_name']) != "image/png"){
                    $alerta = [
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrió un error inesperado",
                        "texto"=>"La imagen que ha seleccionado es de un formato no permitido",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();

                }

                # Verificando peso de imagen #
                if(($_FILES['usuario_foto']['size']/1024)>5120){
                    $alerta = [
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrió un error inesperado",
                        "texto"=>"La imagen que ha seleccionado excede el límite de 5 MB",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }

                # Nombre de la foto #
                $foto = str_ireplace(" ", "_", $nombre);
                $foto = $foto."_".rand(0, 100);

                # Extensión de la imagen #
                switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
                    case "img/jpeg":
                        $foto=$foto.".jpg";
                    break;
                    case "img/png":
                        $foto=$foto.".png";
                    break;
                }

                # Permisos de lectura y escritura #
                chmod($img_dir, 0777);

                # Moviendo imagen al directorio #
                if (!move_uploaded_file($_FILES['usuario_foto']['tmp_name'], $img_dir.$foto)){
                    $alerta = [
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrió un error inesperado",
                        "texto"=>"No se puede subir la imagen al sistema en este momento",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }



            } else {
                $foto = "";
            }

        

        }


    }


