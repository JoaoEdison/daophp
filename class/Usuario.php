<?php

class Usuario {
    
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    public function getIdusuario(){
        return $this->idusuario;
    }
    
    public function getSenha(){
        return $this->dessenha;
    }
    
    public function getLogin(){
        return $this->deslogin;
    }
    
    public function getData(){
        return $this->dtcadastro;
    }
    
    
    public function setIdusuario($value){
       $this->idusuario = $value;
    }
    
    public function setSenha($value){
       $this->dessenha = $value;
    }
    
    public function setLogin($value){
       $this->deslogin = $value;
    }
    
    public function setData($value){
       $this->dtcadastro = $value;
    }
    
    
    public function loadById($id){
        $sql = new SQL();
        
        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        if (count($resultado) > 0){
            
            $this->setInfo($resultado[0]);
                        
        }
    }
    
    public static function getList(){
        
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
        
    }
    
    public static function search($login){
        
        $sql = new SQL();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%$login%"
        ));
        
    }
    
    public function login($login, $password){
        $sql = new SQL();
        
        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
            ":LOGIN"=>$login,
            ":PASS"=>$password
        ));
        
        if (count($resultado) > 0){
            
            $this->setInfo($resultado[0]);
            
        } else {
            
            throw new Exception("Login e/ou senha inválidos.");
            
        }       
    }
    
    public function setInfo($dados){
        
            $this->setIdusuario($dados['idusuario']);
            $this->setLogin($dados['deslogin']);
            $this->setSenha($dados['dessenha']);
            $this->setData(new DateTime($dados['dtcadastro']));
        
    }
    
    public function insert(){
        
        $sql = new SQL();
        $resultado = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(
            ':LOGIN'=>$this->getLogin(),
            ':SENHA'=>$this->getSenha()
        ));

        if(count($resultado) > 0){
            $this->setInfo($resultado[0]);
        }
        
    }
    
    public function update($login, $password){
        
        $this->setLogin($login);
        $this->setSenha($password);
                
        $sql = new SQL;
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuario = :ID", array(
            ":LOGIN"=>$this->getLogin(),
            ":SENHA"=>$this->getSenha(),
            ":ID"=>$this->getIdusuario()           
        ));
        
    }
    
    public function deletar(){
        
        $sql = new SQL;
        
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$this->getIdusuario()
        ));
        
        
        $this->setIdusuario(0);
        $this->setLogin("");
        $this->setSenha("");
        $this->setData(new DateTime(""));
        
    }

    public function __toString() {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getLogin(),
            "dessenha"=>$this->getSenha(),
            "dtcadastro"=>$this->getData()->format("d/m/Y H:i:s")
        ));
    }
    
}

?>