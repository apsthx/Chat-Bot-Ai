<?php

/*
 * Class name : Assets
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 */

class Assets {

    // Assets CSS
    public function css($path_and_filename, $attr = array()) {
        return '<link href="' . base_url() . 'assets/css/' . $path_and_filename . '" rel="stylesheet" type="text/css" ' . $this->conv_to_text($attr) . '/>' . "\r\n\t";
    }

    // Assets CSS Full Path
    public function css_full($path_and_filename, $attr = array()) {
        return '<link href="' . base_url() . 'assets/' . $path_and_filename . '" rel="stylesheet" type="text/css" ' . $this->conv_to_text($attr) . '/>' . "\r\n\t";
    }

    // Assets JS
    public function js($path_and_filename, $attr = array()) {
        return '<script src="' . base_url() . 'assets/js/' . $path_and_filename . '" type="text/javascript" ' . $this->conv_to_text($attr) . '></script>' . "\r\n\t";
    }

    // Assets JS Full Path
    public function js_full($path_and_filename, $attr = array()) {
        return '<script src="' . base_url() . 'assets/' . $path_and_filename . '" type="text/javascript" ' . $this->conv_to_text($attr) . '></script>' . "\r\n\t";
    }

    // Assets Images
    public function img($path_and_filename, $attr = array()) {
        return '<img src="' . base_url() . 'assets/img/' . $path_and_filename . '"' . $this->conv_to_text($attr) . ' />' . "\r\n\t";
    }

    // Assets Images Full Path
    public function img_full($path_and_filename, $attr = array()) {
        return '<img src="' . base_url() . 'assets/' . $path_and_filename . '"' . $this->conv_to_text($attr) . ' />' . "\r\n\t";
    }

    // Full Path
    public function full($path_and_filename) {
        return $path_and_filename . "\r\n\t";
    }

    // Add Attribute
    public function conv_to_text($array) {
        return implode(' ', array_map(function ($value, $key) {
                    return $key . '="' . $value . '"';
                }, $array, array_keys($array)));
    }

    public function meta($property, $content) {
        return '<meta property="' . $property . '" content="' . $content . '" />' . "\r\n\t";
    }

}
