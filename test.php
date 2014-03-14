<?php 
class A{
	private $variable1;
	private $variable2;

public function tamere(){
	echo "coucou";
}
}   
class B{
	private $variable3;
	private $variable4;
	public $a ;
	function __construct() 
	{ 
		$this->a = new A;
	}

}   

$caca = new B();
$caca->a->tamere();

?>