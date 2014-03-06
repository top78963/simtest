<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Template
 * @author lojorider
 * @copyright educasy.com
 */
class Template {

    var $CI;
    /* head */
    var $og_image;
    var $link_tag;
    var $script_tag;
    var $script_var;
    var $title;
    var $keyword;
    var $description;
    var $prefix_description = '|';
    /* body */
    var $top_menu;
    var $content;
    var $footer;
    /* var */
    var $temmplate_name;
    var $template_url;
    var $tag_value_prevent_search = array('"');
    var $tag_value_prevent_replace = array('');
    var $my_house_link;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->config('template');
        $this->load_jquery();
        $this->load_jquery_ui();
        $this->site_name = $this->CI->config->item('site_name');
        $this->temmplate_name = $this->CI->config->item('template_name');
    }

    public function meta_description($description) {

        $data = array('name' => 'description', 'content' => $description);
        $this->meta($data);
    }

    public function meta_keywords($keyword) {
        $data = array('name' => 'keywords', 'content' => $keyword);
        $this->meta($data);
    }

    private function meta($value = array()) {
        $str = '';
        foreach ($value as $k => $v) {
            $str .= $k . '="' . $v . '" ';
        }
        $str = '<meta ' . $str . '/>';
    }

    function link($href = '', $rel = 'stylesheet', $type = 'text/css', $title = '', $media = '', $index_page = FALSE) {
        $link = '<link ';

        if (is_array($href)) {
            foreach ($href as $k => $v) {
                if ($k == 'href' AND strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $link .= 'href="' . $this->CI->config->site_url($v) . '" ';
                    } else {
                        $link .= 'href="' . $this->CI->config->slash_item('base_url') . $v . '" ';
                    }
                } else {
                    $link .= "$k=\"$v\" ";
                }
            }

            $link .= "/>";
        } else {
            if (strpos($href, '://') !== FALSE) {
                $link .= 'href="' . $href . '" ';
            } elseif ($index_page === TRUE) {
                $link .= 'href="' . $this->CI->config->site_url($href) . '" ';
            } else {
                $link .= 'href="' . $this->CI->config->slash_item('base_url') . $href . '" ';
            }

            $link .= 'rel="' . $rel . '" type="' . $type . '" ';

            if ($media != '') {
                $link .= 'media="' . $media . '" ';
            }

            if ($title != '') {
                $link .= 'title="' . $title . '" ';
            }

            $link .= '/>';
        }


        $this->link_tag .= $link;
    }

    function application_script($file) {
        if (end(explode('.', $file)) == 'css') {
            $this->link('assets/application/' . $file);
        } else {
            $this->script('assets/application/' . $file);
        }
    }

    private function script($file) {
        $tmp = parse_url($file);
        if (!isset($tmp['scheme'])) {
            $file = base_url($file);
        }
        $this->script_tag .= "\n" . '<script type="text/javascript" src="' . $file . '"></script>';
    }

    public function script_var($script_var) {
        $script_text = '';
        if ($script_var) {
            foreach ($script_var as $script_k => $script_v) {
                if (is_array($script_v)) {
                    $script_text .= "\n" . 'var ' . $script_k . '=' . $script_v['value'] . ';';
                } else {
                    $script_text .= "\n" . 'var ' . $script_k . '="' . $script_v . '";';
                }
            }
        }
        $this->script_var = '<script>' . $script_text . '</script>';
    }

    /**
     * เขียน Content ลงตำแหน่งที่ต้องการของ Tempalte
     * @param String $view <p>ที่อยู่ของ View </p>
     * @param Array $data <p>ข้อมูล Array ที่ส่งให้ View </p>
     * @param String $region <p>สามารถเป็นได้หลายอย่าง เช่น <b>"content"</b> หรือ <b>"footer"</b></p>
     */
    public function write_view($view, $data = array(), $region = 'content') {

        $data['is_login'] = $this->CI->auth->is_login();
        switch ($region) {
            case 'content':
                $region = &$this->content;
                break;
            case 'footer':
                $region = &$this->footer;
                break;

            default:
                break;
        }

        $region = $this->CI->parser->parse($view, $data, TRUE);
    }

    public function write($content, $region = 'content') {
        switch ($region) {
            case 'content':
                $region = &$this->content;
                break;
            case 'footer':
                $region = &$this->footer;
                break;

            default:
                break;
        }
        $region = $content;
    }

    function og_image($image_url) {
        $this->og_image = $image_url;
    }

    function description($description) {
        $description = $this->prefix_description . '  ' . $description;
        $this->description = str_replace($this->tag_value_prevent_search, $this->tag_value_prevent_replace, $description);
    }

    function title($title) {
        $title = $title . '  ' . $this->prefix_description;
        $this->title = str_replace($this->tag_value_prevent_search, $this->tag_value_prevent_replace, $title);
    }

    function temmplate_name($temmplate_name = '') {
        if ($temmplate_name == '') {
            return $this->temmplate_name;
        }
        $this->temmplate_name = $temmplate_name;
    }

    /**
     * เพื่อแสดงออกทางหน้าจอ
     * @param type $return
     * @return type 
     */
    public function render($return = FALSE) {
        if ($this->og_image == '') {
            $this->og_image = base_url('themes/' . $this->temmplate_name . '/logo.png');
        }
        if ($this->title == '') {
            $this->title = $this->CI->config->item('default_title');
        }
        $data = array(
            'filepath' => './themes/' . $this->temmplate_name . '/page.php',
            'site_name' => $this->site_name,
            'title' => $this->title,
            //'top_menu' => $this->CI->auth->get_top_menu(),
            'content' => $this->content,
            'footer' => $this->footer,
            'script' => $this->script_tag . $this->script_var,
            'link' => $this->link_tag,
            'is_login' => $this->CI->auth->is_login(),
            'template_url' => base_url('themes/' . $this->temmplate_name) . '/',
            'og_image' => $this->og_image,
            'description' => $this->description,
            'display_name' => $this->CI->auth->get_display_name()
        );

        return $this->CI->parser->parse('_template', $data);
    }

    /**
     * คำสั่งโหลด script ต่างๆ 
     */
    private function load_jquery() {
        $this->script(base_url() . 'assets/jquery/jquery-1.8.3.min.js');
    }

    private function load_jquery_ui() {
        $this->script(base_url() . 'assets/jquery-ui/jquery-ui-1.9.2.custom.min.js');
        $this->script(base_url() . 'assets/jquery-ui/jquery.ui.datepicker-th.js');
        $this->link('assets/jquery-ui/ui-start/jquery-ui-1.9.2.custom.min.css');
    }

    public function load_swfupload() {
        $this->script(base_url() . 'assets/swfupload/swfupload.js');
        $this->link('assets/swfupload/swfupload.css');
    }

    public function load_fileuploader() {
        $this->script(base_url() . 'assets/fileuploader/fileuploader.min.js');
        $this->link('assets/fileuploader/fileuploader.css');
    }

    public function load_typeonly() {
        $this->script(base_url() . 'assets/lojo/lojo.typeonly.js');
    }

    public function load_swfobject() {
        
    }

    public function load_google_chart() {
        $this->script('https://www.google.com/jsapi');
    }

    public function load_meio_mask() {
        $this->script(base_url() . 'assets/jquery/jquery.meio.mask.min.js');
    }

    public function load_flowplayer() {
        $this->script(base_url() . 'assets/flowplayer/flowplayer-3.2.11.min.js');
        $this->script(base_url() . 'assets/flowplayer/flowplayer.playlist-3.2.10.min.js');
    }

    public function load_flexgrid() {
        $this->script(base_url() . 'assets/flexgrid/flexigrid.js');
        $this->script(base_url() . 'assets/flexgrid/flexigrid.pack.th.js');
        $this->link('assets/flexgrid/flexigrid.pack.css');
        $this->link('assets/flexgrid/style.css');
    }

    public function load_showloading() {
        $this->script(base_url() . 'assets/showloading/js/jquery.showLoading.min.js');
        $this->link('assets/showloading/css/showLoading.css');
    }

    public function load_markitup_bbcode() {
        $this->script(base_url() . 'assets/markitup/jquery.markitup.js');
        $this->script(base_url() . 'assets/markitup/sets/bbcode/set.js');
        $this->link('assets/markitup/skins/nt/style.css');
        $this->link('assets/markitup/sets/bbcode/style.css');
    }

    public function load_markitup_xelatex() {
        $this->script(base_url() . 'assets/markitup/jquery.markitup.js');
        $this->script(base_url() . 'assets/markitup/sets/xelatex/set.js');
        $this->link('assets/markitup/skins/nt/style.css');
        $this->link('assets/markitup/sets/xelatex/style.css');
    }

    public function load_coin_slider() {
        $this->script(base_url() . 'assets/coin-slider/coin-slider.min.js');
        $this->link('assets/coin-slider/coin-slider-styles.css');
    }

    public function load_jquery_timepicker_addon() {
        $this->script(base_url() . 'assets/jquey-timepicker-addon/jquery-ui-timepicker-addon.js');
        //$this->script(base_url() . 'assets/jquey-timepicker-addon/localization/jquery-ui-timepicker-th.js.js');
        $this->script(base_url() . 'assets/jquey-timepicker-addon/jquery-ui-sliderAccess.js');
        $this->link('assets/jquey-timepicker-addon/jquery-ui-timepicker-addon.css');
    }

    public function load_buzz() {
        $this->script(base_url() . 'assets/buzz/buzz.min.js');
        
    }

}

/* End of file template.php */
