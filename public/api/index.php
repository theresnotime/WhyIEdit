<?php
/**
 * API file
 * 
 * PHP version 8
 *
 * @category  API
 * @package   WhyIEdit
 * @author    Sam <sam@theresnotime.co.uk>
 * @copyright 2021 Sam
 * @license   <https://opensource.org/licenses/MIT> MIT
 * @version   GIT: 1.0.0
 * @link      #
 * @since     File available since 1.0.0
 */
declare(strict_types=1);
require_once __DIR__ . '/../../vendor/autoload.php';
$meta = new WhyIEdit\Meta();
$api = new WhyIEdit\API(true);
?>