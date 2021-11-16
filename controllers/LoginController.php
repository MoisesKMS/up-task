<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }


        //render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
        ]);
    }

    public static function logout(){
        echo 'Desde Logout';

    }

    public static function crear(Router $router){
        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear la contraseña   
                    $usuario->hashPassword();

                    //eliminar password 2
                    unset($usuario->password2);

                    // Generar Token
                    $usuario->crearToken();

                    //Crear un nuevo Usuario
                    $resultado = $usuario->guardar();

                    // Enviar Email
                    $email =  new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email->enviarConfirmacion();

                    if($resultado) {
                        header('Location: /mensaje');
                    }

                }
            }
        }
         //render a la vista
         $router->render('auth/crear', [
            'titulo' => 'Crea tu Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                //Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado) {
                    // GENEAR NUEVO TOKEN
                    $usuario->crearToken();
                    unset($usuario->password2);

                    // ACTUALIZAR EL USUARIO
                    $usuario->guardar();

                    //ENVIAR EL EMAIL

                    //IMPRIMIR LA ALERTA
                    Usuario::setAlerta('exito', 'Enviamos las instrucciones a tu Correo Electronico');
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no esta confirmado');
                }
            }

        }

        $alertas = Usuario::getAlertas();

        //Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Contraseña',
            'alertas' => $alertas
        ]);
    }

    public static function reestablecer(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        //muestra la visra
        $router->render('auth/reestablecer', [
            'titulo' => 'Reestablecer Contraseña'
        ]);
    }

    public static function mensaje(Router $router){
        
        $router->render('auth/mensaje', [
            'titulo' => 'Cuenta Creada Exitosamente'
        ]);
    }

    public static function confirmar(Router $router){
        
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        //Encontrar al Usuario con este Token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)) {
            //no se encontro el usuario
            Usuario::setAlerta('error', 'El token no es valido');
        } else {
            //confirmar la cuenta
            $usuario->confirmado = 1;
            $usuario->token = null;
            unset($usuario->password2);
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Tu cuenta ha sido confirmada');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar cuenta',
            'alertas' => $alertas
        ]);

    }
}