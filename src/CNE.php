<?php

namespace Selkis\VenID;

use Selkis\VenID\Exceptions\VenIdException;
use Selkis\VenID\Exceptions\PersonNotFoundException;


class CNE
{
  
  /**
   * Initialize Global Variables
   */
	function __construct(){
  	$this->url = 'http://www.cne.gov.ve/web/registro_electoral/ce.php';
  }

  /**
   * Gets the information of the person
   * @param  String $nac nationality
   * @param  String $ci  Identifier
   * @return Json      Information of the person
   */
  public function getInfo($nac,$ci){

  	try {
    	$response = \Curl::to($this->url)
    	->withData(array( 'nacionalidad' => $nac, 'cedula' =>  $ci))
    	->returnResponseObject()
      ->get();
    } catch (Exception $e) {
  		throw new VenIdException('An error has occurred making the request', 'WS003');
  	}

    if ($response->status != 200) {
    	throw new VenIdException($response->error, $response->status);
    }

    if ($this->isVotante($response->content)) {
      $this->getArrayData($response->content);
    }else{
      throw new PersonNotFoundException();
    }

   	return  $response_json;
  }

  /**
   * Delete HTML tags
   * @param  String $string 
   * @return String Text without HTML tags
   */
  protected function delectTags($string){
    return strip_tags($string);
  }

  /**
   * Clean the line breaks
   * @param  String $string 
   * @return String Text without line breaks
   */
  protected function clear($string){
   	$rempl = array('\n', '\t');
    $r = trim(str_replace($rempl, ' ', $string));
    return str_replace("\r", "", str_replace("\n", "", str_replace("\t", "", $r)));
  }

  /**
   * Indicates whether voter population
   * @param  String  $string 
   * @return boolean         
   */
  protected function isVotante($string){
    return (strpos($string, 'DATOS DEL ELECTOR') === false) ? false:true;
  }

  /**
   * Replaces search criteria
   * @param  string $string 
   * @return string  
   */
  protected function replace($string){
    $rempl = array('Cédula:', 'Nombre:', 'Estado:', 'Municipio:', 'Parroquia:', 'Centro:', 'Dirección:', 'SERVICIO ELECTORAL', 'Mesa:');
    return str_replace($rempl, '|', $string);
  }

  /**
   * Get the array with the data
   * @param  String $string 
   * @return json     
   */
  protected function getArrayData($string){
    $data = explode("|", $this->replace($this->delectTags($this->clear($string))));
    $response['cedula'] = $data[1];
    $response['nombre'] = $data[2];
    $cne['estado'] = $data[3];
    $cne['municipio'] = $data[4];
    $cne['parroquia'] = $data[5];
    $cne['centro_electoral'] = $data[6];

    $response['cne'] = $cne;

    return $response;

  }

}
