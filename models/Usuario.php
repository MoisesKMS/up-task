<?php	

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //validacion para cuetas nuevas
    public function validarNuevaCuenta(){
        if(!$this->nombre) self::$alertas['error'][] = 'Ingresa un Nombre';
        if(!$this->email) self::$alertas['error'][] = 'Ingresa un Email';

        return self::$alertas;
    }
}