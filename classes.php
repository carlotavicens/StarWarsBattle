<?php
class Casa_estelar { //Creamos la clase casa estelar donde heredaran tanto XWING como TIEFIGHTER
    public $numero_serie;
    public $fabricant;
    public $vida;
    public $vida_max;
    public $forsa_atac;

    public function __construct ($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac){
        $this->numero_serie = $numero_serie;
        $this->fabricant = $fabricant;
        $this->vida = $vida;
        $this->vida_max = $vida_max;
        $this->forsa_atac = $forsa_atac;
    }
    

    public function getNumSerie (){
        return $this->numero_serie;
    }

    public function setNumSerie($numero_serie){
        return $this->numero_serie = $numero_serie;
    }

    public function getVida (){
        return $this->vida;    
    }

    public function setVida($vida){
        $this->vida=$vida;
    }
  
    public function disparar ($casa_estelar){  //Función disparar.
        $classname = (get_class($casa_estelar));
        if ($classname === 'X_Wing'){
            $casa_estelar->estat_escut = $casa_estelar->estat_escut - $this->forsa_atac*(rand(1,10));
            if ($casa_estelar->estat_escut <= 0){
                $vidas = $casa_estelar->getVida();
                $vidas = $vidas + $casa_estelar->estat_escut;
                $casa_estelar->setVida($vidas);

                if ($casa_estelar->getVida() < 0) {
                    $casa_estelar->setVida(0);
                }

                if ($casa_estelar->getEscut() < 0) {
                    $casa_estelar->setEscut(0);
                }
            }        
        } else {
            $vidas= $casa_estelar->getVida();
            $vidas = $vidas - $this->forsa_atac*(rand(1,5));
            $casa_estelar->setVida($vidas);

            if ($casa_estelar->getVida() < 0) {
                $casa_estelar->setVida(0);
            }
        }
    }
}


class X_Wing extends Casa_estelar{
    public $R2D2_Incorporat;
    public $escut_maxim=100;
    public $estat_escut;
    
    public function __construct($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac, $R2D2_Incorporat,  $escut_maxim, $estat_escut){
        $this->R2D2_Incorporat = $R2D2_Incorporat;
        $this->escut_maxim = $escut_maxim;
        $this->estat_escut = $estat_escut;
        parent::__construct ($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac);

    }

    public function getEscut (){
        return $this->estat_escut;    
    }

    public function getR2d2 (){
        return $this->R2D2_Incorporat;    
    }

    public function setR2d2($R2D2_Incorporat){
        $this->R2D2_Incorporat=$R2D2_Incorporat;
    }

    public function setEscut($estat_escut){
        $this->estat_escut=$estat_escut;
    }

    public function getVida (){
        return $this->vida;    
    }

    public function setVida($vida){
        $this->vida=$vida;
    }

    public function reparar(){ //Función reparar que solo funciona si disponemos de R2D2
        if($this->R2D2_Incorporat == 'true'){
            $vidas= $this->getVida();
            if ($vidas<$this->vida_max){
                $vidas= $vidas+ rand(1,20);
                if($vidas + $this->getVida() > $this->vida_max) {
                    $this->setVida(20);
                } else {
                    $this->setVida($vidas);
                }
            } else {
                $escut = $this->getEscut();
                $escut = $escut + (5);
                if ($escut + $this->getEscut() > $this->escut_maxim) { //Si la reparación supera el máximo de nuestro escudo se asignara el máximo. 
                    $this->setEscut(30);
                } else {
                    $this->setEscut($escut);
                }
            }
        }
    }
}

class TIE_Fighter extends Casa_estelar{
    public function __construct($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac){
        parent:: __construct($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac);
    }

    public function reparar(){
        $vida = $this->getVida();
            if ($vida<$this->vida_max){
                $this->vida = $this->vida + 5;
            }
    }

    public function escollir_accio($enemy){ //Función aleatoria que realiza el enemigo en base a nuestris movimientos. 
        $randomACtion = rand(0,1);          // Siempre que disparemos o reparemos se llamará a esta función.

        if ($randomACtion == 1 ){ 
            $this->reparar();
        }else{
            $this->disparar($enemy);
        }
    }
}

?>