<?php
/**
 * WP File Download
 *
 * @package WP File Download
 * @author  Joomunited
 * @version 1.0
 */

namespace Joomunited\WP_File_Download\Admin\Fields;

use Joomunited\WPFramework\v1_0_5\Field;
use Joomunited\WPFramework\v1_0_5\Factory;

defined('ABSPATH') || die();

/**
 * Class Container end
 */
class Containerend extends Field
{

    /**
     *  Render <input> tag
     *
     * @param array $field Fields
     * @param array $data  Data
     *
     * @return string
     */
    public function getfield($field, $data)
    {
        $attributes = $field['@attributes'];
        $html = '';
        if (!empty($attributes['type'])) {
            if (!empty($attributes['label']) && $attributes['label'] !== '') {
                $html .= '</div>';
            }
        }
        return $html;
    }
}
