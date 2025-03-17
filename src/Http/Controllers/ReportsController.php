<?php

namespace Bishopm\Hub\Http\Controllers;

use Bishopm\Hub\Classes\tFPDF;
use stdClass;

class ReportsController extends Controller
{
    public $pdf, $title, $subtitle, $page, $logo, $widelogo;

    public function __construct(){
        $this->pdf = new tFPDF();
        $this->pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
        $this->pdf->AddFont('DejaVu', 'B', 'DejaVuSans-Bold.ttf', true);
        $this->pdf->AddFont('DejaVu', 'I', 'DejaVuSans-Oblique.ttf', true);
        $this->pdf->AddFont('DejaVuCond','','DejaVuSansCondensed.ttf',true);
        $this->pdf->AddFont('DejaVuCond', 'B', 'DejaVuSansCondensed-Bold.ttf', true);
        $this->title="";
        $this->subtitle="";
        $this->page=0;
        $this->logo=url('/') . "/public/church/images/blacklogo.png";
        $this->widelogo=url('/') . "/public/church/images/bwidelogo.png";
    }
    
}
