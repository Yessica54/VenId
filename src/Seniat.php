<?php

namespace Selkis\VenID;

use Selkis\VenID\Exceptions\VenIdException;


class Seniat
{
    
	/**
   * Initialize Global Variables
   */
	function __construct(){
		$this->url = 'http://contribuyente.seniat.gob.ve/getContribuyente/getrif';
	}

	/**
	 * Gets the information of the person
	 * @param  String $rif Rif of the person
	 * @return Json      
	 */
    public function getInfo($rif){

    	try {
	    	$response = \Curl::to($this->url)
	    	->withData(array( 'rif' => $rif ))
	    	->returnResponseObject()
	        ->get();
	    } catch (Exception $e) {
    		throw new VenIdException('An error has occurred making the request', 'WS003');
    	}

        if ($response->status != 200) {
        	throw new VenIdException($response->error, $response->status);
        }
        
       	$response_json['code']='WS001';
       	$response_json['message']='Successful Response';
       	$response_json['data']=$this->parseXML($response->content,'rif');

       	return  $response_json;
    }

    /**
     * Paser string to XML
     * @param  String $string 
     * @return XML    
     */					
    protected function makeXML($string){
       return simplexml_load_string($string);
    }

    /**
     * Paser XML to Json
     * @param  string $string   Text in xml format
     * @param  string $children Tag identifier
     * @return json          
     */
    protected function parseXML($string,$children){
       	$elements = $this->makeXML($string)->children($children);
       	$json=array();
       	foreach($elements as $indice => $node){
               $index=strtolower($node->getName());
               $json[$index]=(string)$node;
       	}
       	return $json;
    }

}
