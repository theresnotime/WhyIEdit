<?php
/**
 * API
 * 
 * E.g. /api/?action=getQuote&lang=en
 * 
 * PHP version 8
 *
 * @category  Class
 * @package   WhyIEdit
 * @author    Sam <sam@theresnotime.co.uk>
 * @copyright 2021 Sam
 * @license   Copyright - All Rights Reserved
 * @version   GIT: 1.0.0
 * @link      #
 * @since     File available since 1.0.0
 */
declare(strict_types=1);
namespace WhyIEdit;

require_once __DIR__ . '/../../vendor/autoload.php';
use Exception;

/**
 * API
 *
 * @category Class
 * @package  WhyIEdit
 * @author   Sam <sam@theresnotime.co.uk>
 * @license  <https://opensource.org/licenses/MIT> MIT
 * @link     #
 * @since    Class available since 1.0.0
 */
class API
{
    /**
     * Construct
     * 
     * @param bool $validate Validate and run request?
     */
    function __construct(bool $validate = true)
    {
        try {
            if ($validate) {
                if (isset($_GET['action'], $_GET['lang'])) {
                    $action = $_GET['action'];
                    $lang = $_GET['lang'];
                    $settings = new Meta($lang);
    
                    if (in_array($action, $settings->apiActions) 
                        && in_array($lang, $settings->languages)
                    ) {
                        // Language & Action are valid
                        $this->$action($lang);
                    } else {
                        $this->returnError(500, 'Invalid action/language');
                    }
                } else {
                    $this->returnError(500, 'Missing action/language');
                }
            }
            return $this;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    /**
     * Return a JSON error message
     *
     * @param integer $code    Error code
     * @param string  $message Error message
     * 
     * @return void
     */
    public function returnError(int $code, string $message)
    {
        $data = array(
            'success' => false,
            'code' => $code,
            'message' => $message
        );
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    /**
     * Return JSON formatted quote
     *
     * @param string $lang Language code
     * 
     * @return void
     */
    public function getQuote(string $lang)
    {
        try {
            $quotes = json_decode(
                file_get_contents(
                    __DIR__ . "/../../quotes/$lang/quotes.json"
                ),
                true
            );
    
            $user = array_rand($quotes);
            $quote = $quotes[$user];
    
            $data = array(
                'success' => true,
                'action' => 'getQuote',
                'timestamp' => date('U'),
                'user' => $user,
                'quote' => $quote
            );
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } catch (Exception $e) {
            $this->returnError(500, 'Could not get quote');
            throw new Exception($e);
        }
    }

    /**
     * Return all JSON formatted quote
     *
     * @param string $lang Language code
     * 
     * @return void
     */
    public function getAllQuotes(string $lang)
    {
        try {
            $quotes = json_decode(
                file_get_contents(
                    __DIR__ . "/../../quotes/$lang/quotes.json"
                ),
                true
            );
    
            $data = array(
                'success' => true,
                'action' => 'getQuote',
                'timestamp' => date('U'),
                'quotes' => $quotes
            );
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } catch (Exception $e) {
            $this->returnError(500, 'Could not get quotes');
            throw new Exception($e);
        }
    }

    /**
     * Return all localised strings
     *
     * @param string $lang Language code
     * 
     * @return void
     */
    public function getLocalisation(string $lang)
    {
        try {
            $localised = json_decode(
                file_get_contents(
                    __DIR__ . "/../../lang/$lang.json"
                ),
                true
            );
    
            $data = array(
                'success' => true,
                'action' => 'getLocalisation',
                'timestamp' => date('U'),
                'strings' => $localised
            );
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        } catch (Exception $e) {
            $this->returnError(500, 'Could not get localised strings');
            throw new Exception($e);
        }
    }
}