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
    
    private function comprobarIdUsuario($idUsuario)
    {
        $estatus = "0";
        $this->db->where('idUsuario', $idUsuario);
        $usuario =  $this->db->get('usuario')->result_array();
        if(count($usuario) > 0){
            $estatus = "1";
        }
        return $estatus;

    }

    public function obtenerUsuario($usuario)
    {
        $this->db->where('correo', $usuario['correo']);
        $this->db->where('contrasena', $usuario['contrasena']);
        return $this->db->get('usuario')->result_array();
    }


    
    
    
    public function iniciarSesion($datos)
    {
        $usuario = array();
        $this->db->where('correo', $datos['correo']);
        $this->db->where('contrasena', $datos['contrasena']);
        $alumno = $this->db->get('alumno');

        if(count($alumno->result_array())){
            $usuario = $alumno->result_array();
        }else{
            $this->db->where('correo', $datos['correo']);
            $this->db->where('contrasena', $datos['contrasena']);
            $coordinador = $this->db->get('coordinador');
            if(count($coordinador->result_array())){
                $usuario = $coordinador->result_array();
            }
        }


        return $usuario;

    }


}