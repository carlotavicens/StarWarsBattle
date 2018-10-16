<?php
class Casa_estelar {
    private $numero_serie;
    private $fabricant;
    private $vida;
    private $vida_max;
    private $forsa_atac;

    public function __construct ($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac){
        $this->numero_serie = $numero_serie;
        $this->fabricant = $fabricant;
        $this->vida = $vida;
        $this->vida_max = $vida_max;
        $this->forsa_atac = $forsa_atac;
    }
    
    public function getVida (){
        return $this->vida;    
    }

    public function setVida($vida){
        $this->vida=$vida;
    }
  
    public function disparar ($casa_estelar){
        $classname = (get_class($casa_estelar));
        if ($classname === 'X_Wing'){
            $casa_estelar->estat_escut = $casa_estelar->estat_escut - $this->forsa_atac*(rand(1,10));
            if ($casa_estelar->estat_escut < 0){
                $vidas = $casa_estelar->getVida();
                $vidas = $vidas + $casa_estelar->estat_escut;
                $casa_estelar->setVida($vidas);
            }
            if ($casa_estelar->vida <=0){
                echo "Game Over";
            }          
        } else {
            $vidas= $casa_estelar->getVida();
            $vidas = $vidas - $this->forsa_atac*(rand(1,10));
            $casa_estelar->setVida($vidas);
            if ($casa_estelar->vida <=0){
                echo "Winner";
            }
        }
    }
}


class X_Wing extends Casa_estelar{
    protected $R2D2_Incorporat;
    protected $escut_maxim=100;
    protected $estat_escut;
    
    public function __construct($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac, $R2D2_Incorporat,  $escut_maxim, $estat_escut){
        $this->R2D2_Incorporat = $R2D2_Incorporat;
        $this->escut_maxim = $escut_maxim;
        $this->estat_escut = $estat_escut;
        parent::__construct ($numero_serie, $fabricant, $vida, $vida_max, $forsa_atac);

    }

    public function getEscut (){
        return $this->estat_escut;    
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

    public function reparar(){
        if($this->R2D2_Incorporat == 'true'){
            $vidas= $this->getVida();
            if ($vidas<$this->vida_max){
                $vidas= $vidas+ rand(1,200);
                if ($vidas>$this->vida_max){
                    $this->setVida($vida_max);
                    $escut = $this->getEscut();
                    $escut = $escut + ($vidas-$vida_max);
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
        $vidas= $this->getVida();
            if ($vidas<$this->vida_max){
                $vidas= $vidas+rand(1,200);
            }
    }

    public function escollir_accio(){

    }

}

$X = new X_Wing (1,'Res', 20, 20, 2, 'true', 100, 100);
$T = new TIE_Fighter(1,'Res', 20, 20, 2);

$X->reparar();
$T->reparar();


?>