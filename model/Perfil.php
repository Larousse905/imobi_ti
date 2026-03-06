<?php 

class Perfil{
    private ?int $id;
    private string $nome;

    public function __construct(?int $id = 0, string $nome){
        $this->id = $id; 
        $this->nome = $nome;
    }

    public function __get(string $prop){ 
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
        throw new Exception("Propriedade {$prop} não existe");
    }

    public function __set(string $prop, $valor){
        switch ($prop) {
            case "id":
                $this->id = (int)$valor;
                break;
            case "nome":
                $this->nome = trim($valor);
                break;
            default:
                throw new Exception("Propriedade {$prop} não permitida");
        }
    }
}
?>