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
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }

    //validacion para cuetas nuevas
    public function validarNuevaCuenta(){
        if(!$this->nombre) self::$alertas['error'][] = 'Ingresa un Nombre';
        if(!$this->email) self::$alertas['error'][] = 'Ingresa un Email';

        if(!$this->password) self::$alertas['error'][] = 'Ingresa una contraseña';
        if(strlen($this->password) < 6) self::$alertas['error'][] = 'La contraseña de contener al menos 6 caracteres';

        if($this->password !== $this->password2) self::$alertas['error'][] = 'Las contraselas no coinciden';

        return self::$alertas;
    }
}