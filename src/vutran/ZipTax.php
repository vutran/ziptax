<?php

namespace vutran;

/**
 * A PHP wrapper for the zip-tax.com API.
 *
 * @package ZipTax
 * @version 1.0.0
 * @link https://github.com/vutran/ziptax
 * @author Vu Tran <vu@vu-tran.com>
 * @website http://vu-tran.com/
 */
class ZipTax {

  /**
   * @access private
   * @var string
   */
  private $_key = '';

  /**
   * @access private
   * @var string
   */
  private $_endpoint = 'http://api.zip-tax.com';

  /**
   * @access private
   * @var string
   */
  private $_action = 'request';

  /**
   * @access private
   * @var string
   */
  private $_version = 'v20';

  /**
   * @access private
   * @var string
   */
  private $_format = 'JSON';

  /**
   * @access private
   * @var object|bool
   */
  private $_lastRequest = false;

  /**
   * Instantiates a new instance
   *
   * @param string $key             Your assigned Zip-Tax API key
   */
  public function __construct($key) {
    $this->_key = $key;
  }

  /**
   * Runs a curl request to the API
   *
   * @access private
   * @param array $params
   * @link http://www.zip-tax.com/documentation
   * @return object
   */
  private function _call($params) {
    $queryString = http_build_query($params);
    $requestEndpoint = sprintf('%s/%s/%s?%s', $this->_endpoint, $this->_action, $this->_version, $queryString);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $requestEndpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    if($res) {
      $json = json_decode($res);
      $this->_lastRequest = $json;
    }
    return $this->_lastRequest;
  }

  /**
   * Request the API for a rate by a given postal code
   *
   * @access public
   * @param string $postalCode
   * @return object
   */
  public function request($postalCode) {
    $params = array(
      'key' => $this->_key,
      'postalcode' => $postalCode,
      'format' => $this->_format
    );
    $res = $this->_call($params);
    return $res;
  }

}

?>
