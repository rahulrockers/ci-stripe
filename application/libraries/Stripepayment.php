<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'third_party/stripe/vendor/autoload.php');

/**
 * A simple to use library to access the stripe.com services
 * 
 * @copyright   Copyright (c) 2011 RahulDev Solutions
 * @author      Rahul Patel <rahulpatel033@gmail.com>
 * @author_url  http://www.facebook.com/rahulpatel033
 */
Class Stripepayment{

	/**
	 * Stripe private key 
	 * 
	 * @var     resource
	 * @access  private
	 */
	private $stripeKey;

	/**
	 * Constructor 
	 * 
	 * @param   String		stripe api key	
	 * @access  private
	 */
	public function __construct($api_key){
		// api key
		$this->stripeKey = $api_key['api_key'];
	}

	/**
	 * charge customer by his/her card information 
	 * 
	 * @param   array		array of credit/debit card information
	 * @return  response in json format
	 */
	function chargeCustomer($myCard){
		$this->setApiKey();
		
		$charge = \Stripe\Charge::create(array('amount' => 2000, 'currency' => 'usd', 'card'=>$myCard));
		return $charge;
	}

	/**
	 * Private function to set api key 
	 * 
	 */
	private function setApiKey(){
		\Stripe\Stripe::setApiKey($this->stripeKey);
	}

	/**
	 * create token by using card information, you can also create via stripe.js 
	 * 
	 * @param   array		array of credit/debit card information
	 * @return  response in json format
	 */
	function createToken($myCard){
		$this->setApiKey();

		// below code for create a token
		$token = \Stripe\Token::create(array("card" => $myCard));
		return $token;
	}

	/**
	 * create token by using card information, you can also create via stripe.js 
	 * 
	 * @param   String		token generated of card information
	 * @return  response in json format
	 */
	function chargeToken($token){
		$this->setApiKey();

		//charge card
		$charge = \Stripe\Charge::create(array('amount' => 2000, 'currency' => 'usd', 'source'=>$token['id']));
		return $charge;
	}

	function retriveCharge(){
		$this->setApiKey();

		$retrive = \Stripe\Charge::retrieve("ch_17QtIaFCflfB1pEyYsmmmFbd");
		return $retrive;
	}

	function captureCharge(){
		$this->setApiKey();

		$charge = \Stripe\Charge::retrieve("ch_17QtQXFCflfB1pEyEMJ3vb4B");
		$captured = $charge->capture();
		return $captured;
	}

	function getLatestCharges(){
		$this->setApiKey();

		$charge = \Stripe\Charge::all(array("limit" => 3));
		return $charge;
	}

	function listAllReccuringCustomers(){
		$this->setApiKey();

		$customers = \Stripe\Customer::all(array("limit" => 3));
		return $customers;
	}

} 

?>