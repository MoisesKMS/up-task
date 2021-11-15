<?php

namespace Controllers;

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
        

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        }

        //Muestra la vista
        $router->render('auth/olvide', [
            'titulo' => 'Olvide mi Contraseña'
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
        
        $router->render('auth/confirmar', [
            'titulo' => 'Confirmar cuenta'
        ]);

    }
}