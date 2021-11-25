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
        $this->password_actual = $args['password_actual'] ?? '';
        $this->password_nuevo = $args['password_nuevo'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? 0;
    }
    
    //Validar login de usuarios
    public function validarLogin(){
        if(!$this->email) self::$alertas['error'][] = 'Ingresa un Email';
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) self::$alertas['error'][] = 'Ingresa un correo valido';
        if(!$this->password) self::$alertas['error'][] = 'Ingresa una contraseña';

        return self::$alertas;
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

    public function validar_perfil(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre el Obligatrio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El Email el Obligatrio';
        }

        return self::$alertas;
    }

    public function nuevo_password() : array{
        if(!$this->password_actual){
            self::$alertas['error'][] = 'La contraseña actual no puede ir vacia';
        }
        if(!$this->password_nuevo){
            self::$alertas['error'][] = 'La nueva contraseña no puede ir vacia';
        }
        if(strlen($this->password_nuevo) < 6){
            self::$alertas['error'][] = 'La nueva contraseña debe tener como minio 6 caracteres';
        }

        return self::$alertas;
    }

    //
    public function comprobarPassword() : bool {
        return password_verify($this->password_actual, $this->password);
    }

    public function hashPassword() : void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() : void{
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