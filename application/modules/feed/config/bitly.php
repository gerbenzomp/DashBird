<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * bitly
 *
 * bit.ly API configuration
 *
 * @author Simon Emms <simon@simonemms.com>
 * @link https://bitly.com/a/your_api_key/
 */

$config['bitly']['login'] = 'dslrfilmmaker'; /* Get this from the link above */
$config['bitly']['apiKey'] = 'R_36610be22a92920035ea21e343d152c8'; /* Get this from the link above */
$config['bitly']['format'] = 'txt';
$config['bitly']['url'] = 'http://api.bitly.com/v3/shorten?';

$config['bitly']['cache_file'] = 'bitly';
?>
