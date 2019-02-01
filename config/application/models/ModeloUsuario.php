<?php
class ModeloUsuario extends CI_Model {

    public function registrarUsuario($usuario)
    {
        $idUsuario = $this->rand_chars('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890', 15);
        while($this->comprobarIdUsuario($idUsuario) != "0"){
            $idUsuario = $this->rand_chars('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890', 15);
        }
        $usuario['idUsuario'] = $idUsuario;
        $resultado['respuesta'] =  $this->db->insert('usuario', $usuario); //RETORNA 1 SI ESTA CORRECTO
        $resultado['idUsuario'] = $idUsuario;
        return $resultado;

    }

    private function rand_chars($c, $l, $u = FALSE)
    { 
        if (!$u) for ($s = '', $i = 0, $z = strlen($c)-1; $i < $l; $x = rand(0,$z), $s .= $c{$x}, $i++); 
        else for ($i = 0, $z = strlen($c)-1, $s = $c{rand(0,$z)}, $i = 1; $i != $l; $x = rand(0,$z), $s .= $c{$x}, $s = ($s{$i} == $s{$i-1} ? substr($s,0,-1) : $s), $i=strlen($s)); 
        return $s; 
    } 


    public function obtenerIdUsuario($correo)
    {
        $this->db->where('correoUsuario', $correo);
        $usuario = $this->db->get('usuario')->row_array();
        return $usuario['idUsuario'];
    }
    
    private function comprobarIdUsuario($idUsuario)
    {
        $estatus = "0";
        $this->db->where('idUsuario', $idUsuario);
        $usuario = array();
        $usuario =  $this->db->get('usuario')->row_array();
        if($usuario){
            $estatus = "1";
        }
        return $estatus;

    }

    public function obtenerUsuario($usuario)
    {
        $this->db->where('correoUsuario', $usuario['correo']);
        $this->db->where('contrasenaUsuario', $usuario['contrasena']);
        return $this->db->get('usuario')->row_array();
    }


    public function obtenerCorreoYEstatus($idUsuario)
    {
        $this->db->select('correoUsuario', 'estatusUsuario');
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('usuario')->result_array();
    }

    public function verificarCorreo($correo)
    {
        $estatus= "0";
        $this->db->where('correoUsuario', $correo);
        $usuario = $this->db->get('usuario')->row_array();        
        if($usuario){
            $estatus = "1";
        }
        return $estatus;
    }

    public function modificarUsuario($datosUsuario, $idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $datosUsuario);
        return (bool)($this->db->affected_rows() > 0);
    }

    public function comprobarMismoCorreo($correo, $idUsuario)
    {
        $estatus= "0";
        $this->db->where('idUsuario', $idUsuario);
        $usuario = $this->db->get('usuario')->row_array(); 
        if($usuario['correoUsuario'] == $correo){
            $estatus = "1";
        }
        return $estatus;
    }

    public function obtenerContrasena($idUsuario)
    {
        $this->db->select('contrasenaUsuario');
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('usuario')->row_array();
    }


    public function obtenerEstatus($idUsuario)
    {
        $this->db->select('estatusUsuario');
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('usuario')->row_array();
    }
    
    
   

}