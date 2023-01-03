<?php
//require 'db.php';
require_once('TCPDF-main/tcpdf.php');
include './includes/db.php';
include './includes/App_Code.php';
$app_code_obj=new App_Code();

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

	   date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y g:i:s A');
		$this->Ln(2);
		$this->SetFont('times','B',9);
		$this->Cell(325,3,'Report on - '.$date,0,1,'C');

       //Image Logo Code of the header
	   	
		//Address code of the header End.	

    }
}

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
		$pdf->Ln(1);
        $imageFile = K_PATH_IMAGES.'logo png.png';
		$pdf->Image($imageFile, 40, 10, 28, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//Image Logo Code of the header end.

		//Address code of the header.
		$pdf->Ln(1);
		$pdf->SetFont('helvetica', 'B',15); 
		$pdf->Cell(189, 5, 'Aelea Commodities Pvt Ltd', 0, 1, 'C');
		$pdf->SetFont('helvetica', '',9); 
		$pdf->Ln(1);
		$pdf->Cell(189, 3, 'Ahfajo House, Office No.9, 2nd Floor,', 0, 1,'C');
		$pdf->Cell(189, 3, '22 Rustom Shidwa Marg,', 0, 1,'C');
		$pdf->Cell(189, 3, 'next to Residency Hotel & Ballard Estate,', 0, 1,'C');
		$pdf->Cell(189, 3, 'Fort, Mumbai, Maharashtra 400001.', 0, 1,'C');
		$pdf->Cell(189, 3, 'OFFICE PHONE - +91 022 66340989', 0, 1,'C');
		$pdf->Cell(189, 3, 'EMAIL - marketing@aeleacommodities.com', 0, 1,'C');
		$pdf->SetFont('helvetica', 'B',15); 
		$pdf->SetFont('helvetica', 'U',15); 
		$pdf->Ln(2);
		$pdf->Cell(189, 3, 'Work Submission Report ', 0, 1,'C');

$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

$url_components = parse_url($CurPageURL);

parse_str($url_components['query'], $params);

// Logic to set the PDF table 

if ($params['search'] != null)
{

    
    $qry = mysqli_query($connection, "SELECT task FROM pdf_views ") or die("select query fail" . mysqli_error());
    while($row= mysqli_fetch_assoc($qry)){
        $task = strtolower($row['task']);
        if (str_starts_with($task,strtolower($params['search']))){

            $data = $row['task'];
            echo $data;
            $qry1 = mysqli_query($connection, "SELECT * FROM pdf_views WHERE task='$data' ") or die("select query fail" . mysqli_error());
            while($row= mysqli_fetch_assoc($qry1)){
                $pdf->Ln(15);

		$emp_name = $row['emp_name'];
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(130, 5, 'Mr/Ms/Mrs - '.$emp_name, 0, 0);
        $emp_id = $row['emp_code'];       
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(59, 5, 'Employee Number - '.$emp_id, 0, 1);
		
		$pdf->Ln(3);
		$email_id = $row['email_id'];     
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(130, 5, 'Email ID - '.$email_id, 0, 0);
		$role_type = $row['user_role']; 
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(189, 5, 'Role Type - '.$role_type, 0, 1);
        
		$pdf->Ln(3);
        $emp_mob = $row['emp_mob'];
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(59, 5, 'Mobile No - '.$emp_mob, 0, 1);

		$pdf->Ln(3);
        $concern = $row['task'];
        $assign_by = $row['assignby'];
        $work_assign_date = strtotime($row['work_assign_date']);
        $work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
		$work_due_date = strtotime($row['work_due_date']);
        $work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
		$work_com_date = strtotime($row['work_com_date']);
		if ($work_com_date!='' && $work_com_date != null){
			$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
		}
        else{
			$work_com_date = '';
		}

        $status = $row['status'];
		date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y g:i:s A');
        if($work_com_date && $status!='WIP')
        {

                if($work_due_date >= $date){
                    $due_status = "DUE";
                }

                elseif($work_com_date <= $work_due_date){
                    $due_status = "DUE";
                }

                else{
                    $due_status = "OVERDUE";
                }
        }
        elseif($work_due_date >= $date){
            $due_status = "DUE";
        }
        else{
            $due_status = "OVERDUE";
        }

		$pdf->Ln(3);
		$pdf->SetFillColor(224,235,255);
		$pdf->MultiCell(180,5,'Concern',1,0,'C',1);
		$pdf->MultiCell(180,4,$concern,1,0);

		$pdf->Ln(8);
		$pdf->SetFont('helvetica', 'B',9); 
		$pdf->Cell(25,5,'Assigned By',1,0,'C',1);
		$pdf->Cell(35,5,"Assign Date",1,0,'C',1);
		$pdf->Cell(35,5,'Due Date',1,0,'C',1);
		$pdf->Cell(35,5,'Completed on',1,0,'C',1);
		$pdf->Cell(20,5,'Status',1,0,'C',1);
		$pdf->Cell(25,5,'Due Status',1,0,'C',1);

		$pdf->Ln(5);
		$pdf->Cell(25,4,$assign_by,1,0,'C',0);
		$pdf->Cell(35,4,$work_assign_date,1,0,'C',0);
		$pdf->Cell(35,4,$work_due_date,1,0,'C',0);
		$pdf->Cell(35,4,$work_com_date,1,0,'C',0);
		$pdf->Cell(20,4,$status,1,0,'C',0);
		$pdf->Cell(25,4,$due_status,1,0,'C',0);

		$pdf->Ln(10);
		$pdf->SetFont('helvetica', 'B',9); 
		if (isset($row['remark']) != ''){
            $remark=  $row['remark'];
            }
            else{
                $remark= 'NA';
            }
		
			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Remark',1,0,'C',1);
			$pdf->MultiCell(180,4,$remark,1,0);

			$pdf->Ln(3);
        if (isset($row['Achievements']) != ''){
            $achievements=  $row['Achievements'];
            }
            else{
                $achievements= '';
            }

			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Achievements',1,0,'C',1);
			$pdf->MultiCell(180,4,$achievements,1,0);

			$pdf->Ln(3);
            if (isset($row['Benefits']) != ''){
                $benefits =  $row['Benefits'];
            }
            else{
            $benefits = '';
            }
			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Benefits',1,0,'C',1);
			$pdf->MultiCell(180,4,$benefits,1,0);
            }
            break;
        }
    }
}

else
{
	$id = $params['id'];
	echo $id;
    $qry = mysqli_query($connection, "SELECT * FROM pdf_views WHERE emp_id='$id' ") or die("select query fail" . mysqli_error());
    while ($row = mysqli_fetch_assoc($qry)) 
    {        
		$pdf->Ln(18);

		$emp_name = $row['emp_name'];
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(130, 5, 'Mr/Ms/Mrs - '.$emp_name, 0, 0);
        $emp_id = $row['emp_code'];       
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(59, 5, 'Employee Number - '.$emp_id, 0, 1);
		
		$pdf->Ln(3);
		$email_id = $row['email_id'];     
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(130, 5, 'Email ID - '.$email_id, 0, 0);
		$role_type = $row['user_role']; 
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(189, 5, 'Role Type - '.$role_type, 0, 1);
        
		$pdf->Ln(3);
        $emp_mob = $row['emp_mob'];
		$pdf->SetFont('helvetica', 'B',10); 
		$pdf->Cell(59, 5, 'Mobile No - '.$emp_mob, 0, 1);

		$pdf->Ln(3);
        $concern = $row['task'];
        $assign_by = $row['assignby'];
        $work_assign_date = strtotime($row['work_assign_date']);
        $work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
		$work_due_date = strtotime($row['work_due_date']);
        $work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
		$work_com_date = strtotime($row['work_com_date']);
        if ($work_com_date!='' && $work_com_date != null){
			$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
		}
        else{
			$work_com_date = '';
		}

        $status = $row['status'];
		date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y g:i:s A');
        if($work_com_date && $status!='WIP')
        {

                if($work_due_date >= $date){
                    $due_status = "DUE";
                }

                elseif($work_com_date <= $work_due_date){
                    $due_status = "DUE";
                }

                else{
                    $due_status = "OVERDUE";
                }
        }
        elseif($work_due_date >= $date){
            $due_status = "DUE";
        }
        else{
            $due_status = "OVERDUE";
        }

		$pdf->Ln(3);
		$pdf->SetFillColor(224,235,255);
		$pdf->MultiCell(180,5,'Concern',1,0,'C',1);
		$pdf->MultiCell(180,4,$concern,1,0);

		$pdf->Ln(8);
		$pdf->SetFont('helvetica', 'B',9); 
		$pdf->Cell(25,5,'Assigned By',1,0,'C',1);
		$pdf->Cell(35,5,"Assign Date",1,0,'C',1);
		$pdf->Cell(35,5,'Due Date',1,0,'C',1);
		$pdf->Cell(35,5,'Completed on',1,0,'C',1);
		$pdf->Cell(20,5,'Status',1,0,'C',1);
		$pdf->Cell(25,5,'Due Status',1,0,'C',1);

		$pdf->Ln(5);
		$pdf->Cell(25,4,$assign_by,1,0,'C',0);
		$pdf->Cell(35,4,$work_assign_date,1,0,'C',0);
		$pdf->Cell(35,4,$work_due_date,1,0,'C',0);
		$pdf->Cell(35,4,$work_com_date,1,0,'C',0);
		$pdf->Cell(20,4,$status,1,0,'C',0);
		$pdf->Cell(25,4,$due_status,1,0,'C',0);

		$pdf->Ln(10);
		$pdf->SetFont('helvetica', 'B',9); 
		if (isset($row['remark']) != ''){
            $remark=  $row['remark'];
            }
            else{
                $remark= 'NA';
            }
		
			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Remark',1,0,'C',1);
			$pdf->MultiCell(180,4,$remark,1,0);

			$pdf->Ln(3);
        if (isset($row['Achievements']) != ''){
            $achievements=  $row['Achievements'];
            }
            else{
                $achievements= '';
            }

			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Achievements',1,0,'C',1);
			$pdf->MultiCell(180,4,$achievements,1,0);

			$pdf->Ln(3);
            if (isset($row['Benefits']) != ''){
                $benefits =  $row['Benefits'];
            }
            else{
            $benefits = '';
            }
			$pdf->Ln(3);
			$pdf->SetFillColor(224,235,255);
			$pdf->MultiCell(180,5,'Benefits',1,0,'C',1);
			$pdf->MultiCell(180,4,$benefits,1,0);
    }
 }

		$pdf->Ln(12);
		$pdf->SetFont('times','i',9);
		$pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. This act as  proof of the To Do "s" and Concern task they completed. While for the company, it serves as a copy for work completion and remark Thank You. ',0,'L',0,1,'','',true);
		$pdf->Ln(8);
		$pdf->SetFont('times','B',10);
		$pdf->Cell(20,1,'__________________',0,0);
		$pdf->Cell(118,1,'',0,0);
		$pdf->Cell(51,1,'______________________',0,1);
		$pdf->Ln(2);
		$pdf->SetFont('times','B',10);
		$pdf->Cell(20,5,'Autherize Signatrue',0,0);
		$pdf->Cell(118,5,'',0,0);
		$pdf->Cell(51,5,'User/Empolyee Signature ',0,1);
		$pdf->Cell(181,5,'(Office Used Only)',0,1);
		$pdf->Cell(8,1,'',0,0);

		//This method is for footer
		
	
// Close and output PDF document
ob_end_clean();
date_default_timezone_set('Asia/Kolkata');
$date = strval(date('d-m-y g:i:s A'));
$report_name = 'Work_Concern_Report_'. $date;
$pdf->Output($report_name, 'I');


?>




