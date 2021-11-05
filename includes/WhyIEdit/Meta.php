<?php
/**
 * Meta Settings
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
 * Meta Settings
 *
 * @category Class
 * @package  WhyIEdit
 * @author   Sam <sam@theresnotime.co.uk>
 * @license  <https://opensource.org/licenses/MIT> MIT
 * @link     #
 * @since    Class available since 1.0.0
 */
class Meta
{
    public array $settings;
    public array $localise;
    public string $site_url;
    public string $site_name;
    public string $site_desc;
    public string $puzzle_img;
    public array $languages;
    public array $apiActions;
    public string $quoteLocation;

    /**
     * Construct
     * 
     * @param $lang Language code
     */
    function __construct(string $lang)
    {
        try {
            $this->settings = json_decode(
                file_get_contents(
                    __DIR__ . '/../../config/settings.json'
                ),
                true
            );

            $this->localise = json_decode(
                file_get_contents(
                    __DIR__ . "/../../lang/$lang.json"
                ),
                true
            );
    
            // Set from config file
            $this->site_name = $this->localise['meta']['site_name'];
            $this->site_desc = $this->localise['meta']['site_desc'];
            $this->site_url = $this->localise['meta']['site_url'];
            $this->puzzle_img = $this->site_url . 
                $this->settings['static']['puzzle_img'];
            $this->languages = $this->settings['languages'];
            $this->apiActions = $this->settings['api']['valid_actions'];
            $this->quoteLocation = $this->settings['api']['quote_location'];
    
            return $this;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}