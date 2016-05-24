<?php

namespace core\component\tools;


class REST extends SoapClient {

	const HASH = "md5";
	const SOAP_VERSION = SOAP_1_1;

	protected $_client;
	protected $_wsdl;
	protected $_url;
	protected $_key;
	protected $_password;
	protected $_passphrase;
	protected $_hash;
	protected $_method;
	protected $_datas;

	public function __construct($wsdl = null) {
		$this->_hash = HASH;
		$this->_wsdl = $wsdl;

		return $this;
	}

	public function createClient() {
		$this->_client = new SoapClient($this->_wsdl, array(
			'soap_version' => SOAP_VERSION,
		));
	}

	public function call($method = null, array $datas = null) {
		if(is_null($method))
			$method = $this->_method;

		if(is_null($datas))
			$datas = $this->_datas;

		return $this->__soapCall($method, array($datas));
	}

	public function setHashAuthentificationMethod($hash) {
		$this->_hash = $hash;
	}

	public function setAuthentificationAttributes($key,$pass,$passphrase = null) {
		$this->_key = $key;
		$this->_password = $pass;
		$this->_passphrase = $passphrase;

		return $this;
	}

	public function setWsdl($wsdl) {
		$this->_wsdl = $wsdl;
		return $this;
	}

	public function setUrl($url) {
		$this->_url = $url;
	}

}