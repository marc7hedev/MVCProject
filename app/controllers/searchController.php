<?php
    
    namespace app\controllers;
    use app\models\mainModel;

    class searchController extends mainModel{

        /*----------  CONTROLADOR módulos de búsquedas  ----------*/
        public function modulosBusquedaControlador($modulo){

            $listaModulos = ['userSearch'];

            if(in_array($modulo, $listaModulos)){
                return false;
            }else{
                return true;
            }

        }

        /*----------  CONTROLADOR iniciar búsquedas  ----------*/
        public function iniciarBuscadorControlador(){

            $url=$this->limpiarCadena($_POST['modulo_url']);
            $texto=$this->limpiarCadena($_POST['txt_buscador']);

            if($this->modulosBusquedaControlador($url)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"No se pudo procesar la petición en este momento",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();

            }

            if($texto==""){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"No ha ingresado nada en el campo de búsqueda",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            if ($this->verificarDatos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,30}", $texto)) {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrió un error inesperado",
                    "texto" => "El termino de busqueda no coincide con el formato solicitado",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }

            $_SESSION[$url]=$texto;

            $alerta = [
                "tipo"=>"redireccionar",
                "url"=>APP_URL.$url."/"
            ];

            return json_encode($alerta);
                
        }

        /*----------  CONTROLADOR eliminar busquedas  ----------*/
        public function eliminarBuscadorControlador(){

            $url=$this->limpiarCadena($_POST['modulo_url']);

            if($this->modulosBusquedaControlador($url)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrió un error inesperado",
                    "texto"=>"No se pudo procesar la petición en este momento",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }

            unset($_SESSION[$url]);

            $alerta = [
                "tipo"=>"redireccionar",
                "url"=>APP_URL.$url."/"
            ];

            return json_encode($alerta);

        }

    }