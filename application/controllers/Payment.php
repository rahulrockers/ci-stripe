<?php
Class Payment extends CI_Controller{

	public function __construct(){
		parent::__construct();

		$params = array('api_key' => 'sk_test_U66JkoMt5RzIFpJgPiFFp0PD');
		$stripe = $this->load->library('stripepayment',$params);
	}

	function stripe_pay(){

		$myCard = array('number' => '4242424242424242', 'exp_month' => 8, 'exp_year' => 2018);
		//charege by token
		//$this->chargeByToken($myCard);

		//charge card directly
		//$this->chargeCardDirectly($myCard);

		//charge card directly
		//$this->retriveCharge();

		/*capture charge card, if you do not capture it in 7 days it will be refunded.*/ 
		//$this->captureCharge();

		//retrive latest charges
		//$this->getLatestCharges();

		//get reccuring customers
		$this->getCustomers();
		//my first change from home

	}

	private function retriveCharge(){
		$response = $this->stripepayment->retriveCharge();
		echo $response;
	}
	private function chargeByToken($myCard){
		$token = $this->stripepayment->createToken($myCard);
		$response = $this->stripepayment->chargeToken($token);
		echo $response;
	}

	private function chargeCardDirectly($myCard){
		$response = $this->stripepayment->chargeCustomer($myCard);
		echo $response;
	}

	private function captureCharge(){
		$response = $this->stripepayment->captureCharge();
		echo $response;
	}

	private function getLatestCharges(){
		$response = $this->stripepayment->getLatestCharges();
		echo $response;
	}

	private function getCustomers(){
		$response = $this->stripepayment->listAllReccuringCustomers();
		echo $response;
	}



}