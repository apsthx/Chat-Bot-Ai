<?php

/*
 * Class pdf.php 
 * Created By : Sakchai Kantada
 * Created Date : 9:40 10/11/2014
 */

class PDF {

    public function pdf() {
        $CI = & get_instance();
        include_once APPPATH . 'third_party/fpdf/fpdf.php';
    }

    public function load($param = NULL) {
        return new FPDF($param);
    }

    public function loadPDF() {
        return new FPDF('P', 'mm', array(153,203));
    }
    
    public function loadPDFA4() {
        return new FPDF('P', 'mm', 'A4');
    }
    
    public function loadPDFA4L() {
        return new FPDF('L', 'mm', 'A4');
    }
    public function loadPDFA5() {
        return new FPDF('P', 'mm', array(95,135));
    }

}
