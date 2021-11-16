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

    // Valida una contraseña
    public function validarPassword($password){
        if(!$this->password) self::$alertas['error'][] = 'Ingresa una contraseña';
        if(strlen($this->password) < 6) self::$alertas['error'][] = 'La contraseña de contener al menos 6 caracteres';

        if($this->password !== $this->password2) self::$alertas['error'][] = 'Las contraselas no coinciden';

        return self::$alertas;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = md5(uniqid());
    }

    public function validarEmail(){
        
        if(!$this->email) self::$alertas['error'][] = 'El correo es obligatorio';

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = 'Ingresa un correo valido';
        }

        return self::$alertas;
    }
}