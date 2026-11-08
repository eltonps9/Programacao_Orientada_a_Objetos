<h2>depositar</h2>

<form action="" method="post">
    <input type='number' id='inputar' name='inputar' placeholder='Digite o valor do deposito' >
    <input type='submit' value='Depositar'>
</form>
<br>
<h2>sacar</h2>

<form action="" method="post">
    <input type='number' id='tirar' name='tirar' placeholder='Digite o valor do saque'>
    <input type='submit' value='Sacar'>
</form>

<?php 

session_start();

if(!isset($_SESSION['saldo'])){
    $_SESSION['saldo']=1000;
}
$inputar = $_POST['inputar'] ?? '';
$tirar = $_POST['tirar'] ?? '';

class Conta{

    private int $saldo;

    public function __construct( int $saldo){
        $this->saldo = $saldo;
    }

    public function sacar(int $valor){
        if( $valor >100){
            echo "<br>Valor de saque excede o limite permitido!";
            return;
        }
        if( $valor<= 0){
            echo "<br>Valor de saque não permitido!";
            return;
        }
        if($valor >1){
            $quantia= "reais ";
        }else{
            $quantia= "real";
        }
        echo "Saque de  R$ ". $valor." ". $quantia. " realizado com sucesso!";

        $this->saldo -= $valor;
    }

    public function depositar(int $valor){
        if( $valor <= 0 || $valor > 230){
            echo "<br>Valor de deposito inválido!";
            return;
        }

        if($valor >1){
            $quantia= "reais ";
        }else{
            $quantia= "real";
        }

        echo "Deposito de R$ ". $valor." ". $quantia." realizado com sucesso!";
        $this->saldo += $valor;
    }

    public function verSaldo(){
        return $this->saldo;
    }
}
// $saldo= $_SESSION['saldo'];
$conta = new Conta($_SESSION['saldo']);
echo "Saldo inicial: ".$conta->verSaldo()."<br>";
if (isset($_POST['tirar'])) {
    $tirar = $_POST['tirar'];

    if ($tirar === '') {
        echo "Informe o valor do saque!";
    } else {
        $conta->sacar((int) $tirar);
    }
}

if (isset($_POST['inputar'])) {
    $inputar = $_POST['inputar'];

    if ($inputar === "") {
        echo "Informe o valor do depósito!";
    } else {
        $conta->depositar((int) $inputar);
    }
}
$_SESSION['saldo'] = $conta->verSaldo();
echo "<br>Saldo após saque: R$".$conta->verSaldo()."<br>";