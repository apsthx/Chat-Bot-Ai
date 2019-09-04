<?php

/*
 * Class name : Ajax_pagination
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 */

class Ajax_pagination {

    var $base_url = '';
    var $total_rows = '';
    var $per_page = 10;
    var $num_links = 0;
    var $cur_page = 0;
    var $uri_segment = 0;
    var $first_link = '&laquo;';
    var $next_link = 'ถัดไป';
    var $prev_link = 'ก่อนหน้า';
    var $last_link = '&raquo;';
    var $full_tag_open = '<ul class="custom-pagination">';
    var $full_tag_close = '</ul>';
    var $first_tag_open = '<li class="custom-pagination-li">';
    var $first_tag_close = '</li>';
    var $last_tag_open = '<li class="custom-pagination-li">';
    var $last_tag_close = '</li>';
    var $cur_tag_open = '<li class="custom-pagination-li"><a class="custom-pagination-item-a active" href="javascript:void(0)">';
    var $cur_tag_close = '</a></li>';
    var $next_tag_open = '<li class="custom-pagination-li">';
    var $next_tag_close = '</li>';
    var $prev_tag_open = '<li class="custom-pagination-li">';
    var $prev_tag_close = '</li>';
    var $num_tag_open = '<li class="custom-pagination-li">';
    var $num_tag_close = '</li>';
    var $js_rebind = '';
    var $div = '';
    var $postVar = '';
    var $additional_param = '';
    var $anchor_class = '';
    var $show_count = true;

    function CI_Pagination($params = array()) {
        if (count($params) > 0) {
            $this->initialize($params);
        }
        log_message('debug', 'Pagination Class Initialized');
    }

    // --------------------------------------------------------------------

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
        // Apply class tag using anchor_class variable, if set.
        if ($this->anchor_class != '') {
            $this->anchor_class = 'class="' . $this->anchor_class . '" ';
        }
    }

    // --------------------------------------------------------------------

    function create_links() {
        // If our item count or per-page total is zero there is no need to continue.
        if ($this->total_rows == 0 || $this->per_page == 0) {
            return '';
        }
        // Calculate the total number of pages
        $num_pages = ceil($this->total_rows / $this->per_page);
        // Is there only one page? Hm... nothing more to do here then.
        if ($num_pages == 1) {
            $info = '<ul class="custom-pagination">แสดงทั้งหมด ' . $this->total_rows . ' รายการ</ul>';
            return $info;
        }
        // Determine the current page number.
        $CI = & get_instance();
        if ($CI->uri->segment($this->uri_segment) != 0) {
            $this->cur_page = $CI->uri->segment($this->uri_segment);
            // Prep the current page - no funny business!
            $this->cur_page = (int) $this->cur_page;
        }
        $this->num_links = (int) $this->num_links;
        if ($this->num_links < 1) {
            show_error('Your number of links must be a positive number.');
        }
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 0;
        }
        if ($this->cur_page > $this->total_rows) {
            $this->cur_page = ($num_pages - 1) * $this->per_page;
        }
        $uri_page_number = $this->cur_page;
        $this->cur_page = floor(($this->cur_page / $this->per_page) + 1);
        $start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
        $end = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
        // Add a trailing slash to the base URL if needed
        $this->base_url = rtrim($this->base_url, '/') . '/';
        $output = '';
        // Render the "First" link
        if ($this->cur_page > $this->num_links) {
            $output .= $this->first_tag_open . $this->getAJAXlink('0', $this->first_link) . $this->first_tag_close;
        }
        // Render the "previous" link
        if ($this->cur_page != 1) {
            $i = $uri_page_number - $this->per_page;
            if ($i == 0) {
                $i = '0';
            }
            $output .= $this->prev_tag_open . $this->getAJAXlink($i, $this->prev_link) . $this->prev_tag_close;
        }
        // Write the digit links
        for ($loop = $start - 1; $loop <= $end; $loop++) {
            $i = ($loop * $this->per_page) - $this->per_page;

            if ($i >= 0) {
                if ($this->cur_page == $loop) {
                    $output .= $this->cur_tag_open . $loop . $this->cur_tag_close; // Current page
                } else {
                    $n = ($i == 0) ? '0' : $i;
                    $output .= $this->num_tag_open . $this->getAJAXlink($n, $loop) . $this->num_tag_close;
                }
            }
        }
        // Render the "next" link
        if ($this->cur_page < $num_pages) {
            $output .= $this->next_tag_open . $this->getAJAXlink($this->cur_page * $this->per_page, $this->next_link) . $this->next_tag_close;
        }
        // Render the "Last" link
        if (($this->cur_page + $this->num_links) < $num_pages) {
            $i = (($num_pages * $this->per_page) - $this->per_page);
            $output .= $this->last_tag_open . $this->getAJAXlink($i, $this->last_link) . $this->last_tag_close;
        }
        $output = preg_replace("#([^:])//+#", "\\1/", $output);
        $output = $this->full_tag_open . $output . $this->full_tag_close;
        return $output;
    }

    function getAJAXlink($count, $text) {
        if ($this->div == '') {
            return '<a class="custom-pagination-item-a" href="' . $this->anchor_class . ' ' . $this->base_url . $count . '">' . $text . '</a>';
        }
        $pageCount = $count ? $count : 0;
        if ($this->additional_param != "") {
            $additional_param = $this->additional_param;
        } else {
            $additional_param = "{'page' : $pageCount}";
        }
        return '<a class="custom-pagination-item-a" href="javascript:void(0);" ' . $this->anchor_class . ' onclick="$.post(\'' . $this->base_url . $count . '\', ' . $additional_param . ', function(data){$(\'#' . $this->div . '\').html(data)' . $this->js_rebind . '; }); return false;">' . $text . '</a>';
    }

}
