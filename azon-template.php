<?php defined('ABSPATH') or die;

/*
Plugin Name: Azonpress templates
Description: Azonpress - templates plugin.
Version: 1.0.0
Author: manageninja
Author URI: https://wpmanageninja.com
Plugin URI: https://wpmanageninja.com/azonpress
License: GPLv2 or later
Text Domain: azonpress
Domain Path: /resources/languages
*/


define('AZONPRESS_TEMPLATE_PATH', plugin_dir_path(__FILE__));

class AzonpressTemplates
{
    public $template = "";
    public $myTemplates = ["custom"];
    //[azonpress template="custom" asin=""]
    public function boot()
    {
        $this->adminHooks();
    }

    public function adminHooks()
    {
        foreach ($this->myTemplates as $temp) {
            $templates[] = [
                "name" => $temp,
                "title" => ucwords($temp),
                "preview" => ""
            ];
        }

        add_filter('azonpress_templates', function ($masterTemp) use ($templates) {
            $masterTemp = array_merge($masterTemp, $templates);
            return $masterTemp;
        }, 10, 1);

        foreach ($this->myTemplates as $temp) {
            add_action('azonpress_product_display_'. $this->template, array($this, "renderer"), 10, 2);
        }
    }


    public function renderer($items, $atts)
    {
        $processor = new Azonpress\Classes\Shortcode\ProductRenderer;
        $data = array(
            'products' => $items,
            'atts' => $atts,
            'wrapper_class' => $processor::getWrapperCssClass($atts),
            'hide_price' => $processor::isHidePrice(),
            'last_updated_at' => $processor::getLastUpdateTime($items)
        );
        $this->render($atts['template'], $data);
    }

    public function make($path, $data = [])
    {
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        $file = AZONPRESS_TEMPLATE_PATH."{$path}/".$path.'.php';
        ob_start();
        extract($data);
        include $file;
        return ob_get_clean();
    }

    public function render($path, $data = [])
    {
        echo $this->make($path, $data);
    }
}

add_action('plugins_loaded', function () {
    if (defined('AZONPRESS_PLUGIN_VERSION')) {
        (new AzonpressTemplates())->boot();
    }
});
