<?php
include './includes/data_base_save_update.php';
require_once('TCPDF-main/tcpdf.php');

if (isset($_GET['data'])) {
    $search = $_GET['data'];
	echo $search;
}

class PDF extends TCPDF
{
	//Page border Code All Side.
    protected $processId = 0;
    protected $header = '';
    protected $footer = '';
    static $errorMsg = '';
    public function Header()
    {

       $this->writeHTMLCell($w='', $h='', $x='', $y='', $this->header, $border=0, $ln=0, $fill=0, $reseth=true, $align='L', $autopadding=true);
       $this->SetLineStyle( array( 'width' => 0.40, 'color' => array(0, 0, 0)));

       $this->Line(5, 5, $this->getPageWidth()-5, 5); 

       $this->Line($this->getPageWidth()-5, 5, $this->getPageWidth()-5,  $this->getPageHeight()-5);
       $this->Line(5, $this->getPageHeight()-5, $this->getPageWidth()-5, $this->getPageHeight()-5);
       $this->Line(5, 5, 5, $this->getPageHeight()-5);
       //Page border Code All Side End.

       //Image Logo Code of the header
        $imageFile = K_PATH_IMAGES.'logo png.png';
		$this->Image($imageFile, 40, 10, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//Image Logo Code of the header end.

		//Address code of the header.
		$this->Ln(0);
		$this->SetFont('helvetica', 'B',15); 
		$this->Cell(189, 5, 'Aelea Commodities Pvt Ltd', 0, 1, 'C');
		$this->SetFont('helvetica', '',9); 
		// $this->Cell(189, 3, 'Ahfajo House, Office No.9, 2nd Floor,', 0, 1,'C');
		// $this->Cell(189, 3, '22 Rustom Shidwa Marg,', 0, 1,'C');
		// $this->Cell(189, 3, 'next to Residency Hotel & Ballard Estate,', 0, 1,'C');
		// $this->Cell(189, 3, 'Fort, Mumbai, Maharashtra 400001.', 0, 1,'C');
		$this->Cell(189, 3, 'OFFICE PHONE - +91 022 66340989', 0, 1,'C');
		$this->Cell(189, 3, 'EMAIL - marketing@aeleacommodities.com', 0, 1,'C');
		$this->SetFont('helvetica', 'B',15); 
		$this->SetFont('helvetica', 'U',15); 
		$this->Ln(4);
		$this->Cell(189, 3, 'Work Submission Report ', 0, 1,'C');
		//Address code of the header End.	

    }
}


/**
 * 
 */
// class PDF extends TCPDF
// {
// 	public function Header(){
// 		$this->Ln(6);
// 		//Set Font 
// 		$this->SetFont('helvetica','I',8);
// 		//page number
// 		date_default_timezone_set("Asia/Kolkata");
// 		$today = date("F j, Y/ g:i A", time());

// 		$this->Cell(25,5,'Ganeration Date/Time: '.$today,0,0,'L');
// 		$this->Cell(164,5,'Page'.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,false,'R',0,'',0,false,'T','M');

// 		// $imageFile = K_PATH_IMAGES.'logo.jpg';
// 		// $this->Image($imageFile, 40, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
// 	}
// }


// 	public function Footer(){
		
// 	}
	
// }



// create new PDF document
//portrait or landscape
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Rahil Shaikh');
$pdf->SetTitle('Work Concern Reoport');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}



//set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);



// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
     
     /*This is only one page border get and doubble border get code
	$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
	$pdf->Rect(4, 4, 202, 289, 'D'); */

		//write fetching database code and Fetching body of the reoprt here .....




		//write fetching Fetching body of the reoprt End ...................




		//This method is for footer
		// $pdf->SetY(-72);
		// $pdf->Ln(5);
		// $pdf->SetFont('times','B',11);
		// // $pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. For the users, this act as verification and proof of the To Do "s" and Concern task they complete. While for the company, it serves as a copy for work completion and remark Thank You. ',0,'L',0,1,'','',true);
		// $pdf->Ln(6);
		// $pdf->Cell(20,1,'__________________',0,0);
		// $pdf->Cell(118,1,'',0,0);
		// $pdf->Cell(51,1,'______________________',0,1);
		// $pdf->Ln(2);
		// $pdf->Cell(20,5,'Autherize Signatrue',0,0);
		// $pdf->Cell(118,5,'',0,0);
		// $pdf->Cell(51,5,'User/Empolyee Signature ',0,1);
		// $pdf->Cell(181,5,'(Office Used Only)',0,1);
		// $pdf->Cell(8,1,'',0,0);

		//This method is for footer
		
	
// Close and output PDF document
$pdf->Output('example_001.pdf', 'I');







