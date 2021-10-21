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
    public string $site_name;
    public string $site_desc;
    public array $languages;
    public array $apiActions;

    /**
     * Construct
     */
    function __construct()
    {
        try {
            $this->settings = json_decode(
                file_get_contents(
                    __DIR__ . '/../../config/settings.json'
                ),
                true
            );
    
            // Set from config file
            $this->site_name = $this->settings['meta']['site_name'];
            $this->site_desc = $this->settings['meta']['site_desc'];
            $this->languages = $this->settings['languages'];
            $this->apiActions = $this->settings['api']['valid_actions'];
    
            return $this;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}