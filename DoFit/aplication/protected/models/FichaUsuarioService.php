<?php
class FichaUsuarioService
{
    
    public function isnumber($val){
        $mensaje = "Ingrese un valor numerico";
        if(is_numeric($val)){
            return true;
        }else{
            return $mensaje;
        }
    }
    public function istext($val){
        $mensaje = "No es posible ingresar numeros";
        if(!is_numeric($val)){
            return true;
        }else{
            return $mensaje;
        }
    }
    public function minmax($val){
        $mensaje = "Ingrese de 5 a 20 caracteres";
        if((strlen($val) >= 5 ) && (strlen($val)<=20)){
            return true;
        }else{
            return $mensaje;
        }
    }
    public function sincaracteres($val){
        $mensaje = "Ingrese letras a-z o numeros de 0-9";
        if (!preg_match("/^[a-zA-Z0-9 ]*$/",$val)) {
             return $mensaje;
        }else{
            return true;
        }
        
    }
    
    
    public function telfijo($val){        
        if(($this->isnumber($val))==1){
            if(($this->minmax($val))==1){
                 return "ok";    
            }else{
               return $this->minmax($val); 
            }
        }else{
            return $this->isnumber($val); 
        } 
    }

    public function cel($val){
        if(($this->isnumber($val))==1){
            if(($this->minmax($val))==1){
                 return "ok";    
            }else{
               return $this->minmax($val); 
            }
        }else{
            return $this->isnumber($val); 
        } 
    }
    public function contemer($val){
        if(($this->sincaracteres($val))==1){
            if(($this->istext($val))==1){
                if(($this->minmax($val))==1){
                    return "ok";
                }else{
                    return $this->minmax($val);
                }
            }else{
                return $this->istext($val);
            }
        }else{
            return $this->sincaracteres($val);
        }
    }
    public function telemer($val){
        if(($this->isnumber($val))==1){
            if(($this->minmax($val))==1){
                return "ok";    
            }else{
                return $this->minmax($val); 
            }
        }else{
            return $this->isnumber($val); 
        } 
    }
    public function direccion($val){
        if(($this->sincaracteres($val))==1){
            if(($this->istext($val))==1){
                if(($this->minmax($val))==1){
                     return "ok";                   
                }else{
                    return $this->minmax($val);
                }
            }else{
               return $this->istext($val);
            }
        }else{
          return $this->sincaracteres($val);
        }
    }
    
    public function piso($val){
        if($val==""){
            return "ok";    
        }else{
            if(($this->sincaracteres($val))==1){
                    return "ok";
                if(($this->minmax($val))==1){
                    return "ok";
                }else{
                   return $this->minmax($val);
                }
            }else{
                return $this->sincaracteres($val);
            }
        }
    }
       
    
    public function depto($val){
        if($val==""){
            return "ok";    
        }else{
            if(($this->sincaracteres($val))==1){
                    return "ok";
                if(($this->minmax($val))==1){
                    return "ok";
                }else{
                   return $this->minmax($val);
                }
            }else{
                return $this->sincaracteres($val);
            }
        }
    }
    

}

?>