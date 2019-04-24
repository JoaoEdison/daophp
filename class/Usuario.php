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
            
            $row = $resultado[0];
            
            $this->setIdusuario($row['idusuario']);
            $this->setLogin($row['deslogin']);
            $this->setSenha($row['dessenha']);
            $this->setData(new DateTime($row['dtcadastro']));
            
        }
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