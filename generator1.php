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
$pdf->SetTitle('Work Do Next Reoport');
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
		$pdf->Line(10,55,200,55);
		$pdf->Line(10,56,200,56);
		
$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

$url_components = parse_url($CurPageURL);

parse_str($url_components['query'], $params);

// Logic to set the PDF table 

if ($params['search'] != null)
{

    
    $qry = mysqli_query($connection, "SELECT task FROM pdf_views ") or die("select query fail" . mysqli_error($connection));
    while($row= mysqli_fetch_assoc($qry)){
        $task = strtolower($row['task']);
		$len = strlen($params['search']);
    	if (substr($task, 0, $len) == strtolower($params['search']))
		{	

            $data = $row['task'];
            $qry1 = mysqli_query($connection, "SELECT * FROM pdf_views WHERE task='$data' ") or die("select query fail" . mysqli_error($connection));
            $count = 0;
			$result=mysqli_query($connection,"SELECT count(*) as total from pdf_views WHERE task='$data' ");
			$data=mysqli_fetch_assoc($result);
			$row_count = $data['total'];
			while($row= mysqli_fetch_assoc($qry1))
			{
				$count++;
				if ($count==1)
				{
					$pdf->Ln(6);
					date_default_timezone_set('Asia/Kolkata');
					$date = date('(d/m/y - g:i A)');
					$pdf->Ln(2);
					$pdf->SetFont('times','B',9);
					$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
					$pdf->Ln(10);

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
					$qry2 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
				
					$report_row = mysqli_fetch_assoc($qry2);
					$report_to = $report_row['report_to'];
					if ($report_to !=0){
						$report_to_code = $app_code_obj->getName($report_to); 
						$report_to_name = $app_code_obj->get_User_role($report_to);
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
					}
					else{
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
					}

					$pdf->Ln(3);
					$concern = $row['task'];
					$assign_by = $row['assignby'];
					$work_assign_date = strtotime($row['work_assign_date']);
					$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
					$work_due_date = strtotime($row['work_due_date']);
					$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
					$work_com_date = strtotime($row['work_com_date']);
					if ($work_due_date != '' && $work_com_date != null){
						$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
					}
					else{
						$work_com_date = '';
					}
					

					$status = $row['status'];
					date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
					///
					
					if ($row['remark'] != '' && $row['remark'] != null ){
						$remark=  $row['remark'];
						}
						else{
							$remark= 'NA';
						}

					if (isset($row['Achievements']) != ''){
						// $achievements=  $row['Achievements'];
						$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
						}
						else{
							$achievements= 'NA';
						}

						if (isset($row['Benefits']) != ''){
							$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
						}
						else{
						$benefits = 'NA';
						}

					$pdf->SetFont('helvetica', 'B',10); 
					$htl='
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
							
					<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
						</tr>
					</table>';
				
					$pdf->SetFont('helvetica', 'B',10); 
					$html ='<table border="1" cellpadding="2" cellspacing="2">
					<tr>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
					</tr>
					<tr>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
					</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$rmk='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
						</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$htlm='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
						</tr>
						<tr>

						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
						</tr>
					</table>';

					$page_break = '<br pagebreak="true">';				
				
					$pdf->Ln(4);
					$pdf->WriteHTML($htl);
					$pdf->Ln(5);
					$pdf->WriteHTML($html);
					$pdf->Ln(3);
					$pdf->writeHtml($rmk);
					$pdf->Ln(5);
					$pdf->writeHtml($htlm);		
					$flag = 1;
					if ($row_count == 1)			
					{
						$pdf->Ln(10);
						$pdf->SetFont('times','i',10);
						$pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. 
						This act as  proof of the Do Next task they completed. While for the company, 
						it serves as a copy for work completion and remark Thank You. ',0,'C',0,1,'','',true);
						$pdf->Ln(12);
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
	
						break;
					}
					$pdf->writeHtml($page_break);
				}

				elseif($count==$row_count)
				{
					date_default_timezone_set('Asia/Kolkata');
					$date = date('(d/m/y - g:i A)');
					// $pdf->Ln(2);
					$pdf->SetFont('times','B',9);
					$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
					$pdf->Ln(10);

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
					$qry2 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
				
					$report_row = mysqli_fetch_assoc($qry2);
					$report_to = $report_row['report_to'];
					if ($report_to !=0){
						$report_to_code = $app_code_obj->getName($report_to); 
						$report_to_name = $app_code_obj->get_User_role($report_to);
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
					}
					else{
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
					}

					$pdf->Ln(3);
					$concern = $row['task'];
					$assign_by = $row['assignby'];
					$work_assign_date = strtotime($row['work_assign_date']);
					$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
					$work_due_date = strtotime($row['work_due_date']);
					$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
					$work_com_date = strtotime($row['work_com_date']);
					if ($work_due_date != '' && $work_com_date != null){
						$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
					}
					else{
						$work_com_date = '';
					}
					

					$status = $row['status'];
					date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
					///
					
					if ($row['remark'] != '' && $row['remark'] != null ){
						$remark=  $row['remark'];
						}
						else{
							$remark= 'NA';
						}

					if (isset($row['Achievements']) != ''){
						// $achievements=  $row['Achievements'];
						$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
						}
						else{
							$achievements= 'NA';
						}

						if (isset($row['Benefits']) != ''){
							$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
						}
						else{
						$benefits = 'NA';
						}

					$pdf->SetFont('helvetica', 'B',10); 
					$htl='
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
							
					<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
						</tr>
					</table>';
				
					$pdf->SetFont('helvetica', 'B',10); 
					$html ='<table border="1" cellpadding="2" cellspacing="2">
					<tr>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
					</tr>
					<tr>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
					</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$rmk='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
						</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$htlm='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
						</tr>
						<tr>

						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
						</tr>
					</table>';

					$page_break = '<br pagebreak="true">';				
				
					$pdf->Ln(4);
					$pdf->WriteHTML($htl);
					$pdf->Ln(5);
					$pdf->WriteHTML($html);
					$pdf->Ln(3);
					$pdf->writeHtml($rmk);
					$pdf->Ln(5);
					$pdf->writeHtml($htlm);	
					
					$pdf->Ln(10);
					$pdf->SetFont('times','i',10);
					$pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. 
					This act as  proof of the Do Next task they completed. While for the company, 
					it serves as a copy for work completion and remark Thank You. ',0,'C',0,1,'','',true);
					$pdf->Ln(12);
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

					break;

				}
				else
				{
					date_default_timezone_set('Asia/Kolkata');
					$date = date('(d/m/y - g:i A)');
					// $pdf->Ln(2);
					$pdf->SetFont('times','B',9);
					$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
					$pdf->Ln(10);

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
					$qry2 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
				
					$report_row = mysqli_fetch_assoc($qry2);
					$report_to = $report_row['report_to'];
					if ($report_to !=0){
						$report_to_code = $app_code_obj->getName($report_to); 
						$report_to_name = $app_code_obj->get_User_role($report_to);
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
					}
					else{
						$pdf->SetFont('helvetica', 'B',10); 
						$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
					}

					$pdf->Ln(3);
					$concern = $row['task'];
					$assign_by = $row['assignby'];
					$work_assign_date = strtotime($row['work_assign_date']);
					$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
					$work_due_date = strtotime($row['work_due_date']);
					$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
					$work_com_date = strtotime($row['work_com_date']);
					if ($work_due_date != '' && $work_com_date != null){
						$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
					}
					else{
						$work_com_date = '';
					}
					

					$status = $row['status'];
					date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
					///
					
					if ($row['remark'] != '' && $row['remark'] != null ){
						$remark=  $row['remark'];
						}
						else{
							$remark= 'NA';
						}

					if (isset($row['Achievements']) != ''){
						// $achievements=  $row['Achievements'];
						$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
						}
						else{
							$achievements= 'NA';
						}

						if (isset($row['Benefits']) != ''){
							$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
						}
						else{
						$benefits = 'NA';
						}

					$pdf->SetFont('helvetica', 'B',10); 
					$htl='
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
							
					<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
						</tr>
					</table>';
				
					$pdf->SetFont('helvetica', 'B',10); 
					$html ='<table border="1" cellpadding="2" cellspacing="2">
					<tr>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
						<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
					</tr>
					<tr>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
						<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
					</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$rmk='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
						</tr>
						<tr>
							<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
						</tr>
					</table>';

					$pdf->SetFont('helvetica', 'B',10); 
					$htlm='<table border="1" cellpadding="2" cellspacing="2">
						<tr>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
							<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
						</tr>
						<tr>

						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
						<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
						</tr>
					</table>';

					$page_break = '<br pagebreak="true">';				
				
					$pdf->Ln(4);
					$pdf->WriteHTML($htl);
					$pdf->Ln(5);
					$pdf->WriteHTML($html);
					$pdf->Ln(3);
					$pdf->writeHtml($rmk);
					$pdf->Ln(5);
					$pdf->writeHtml($htlm);		
					$pdf->writeHtml($page_break);
				}	
			}
			break;
		}
    }
}

else
{
	$id = $params['id'];
	// echo $id;
    $qry = mysqli_query($connection, "SELECT * FROM pdf_views where emp_id='$id' ") or die("select query fail" . mysqli_error($connection));
	$count = 0;
	$result=mysqli_query($connection,"SELECT count(*) as total from pdf_views where emp_id='$id' ");
	$data=mysqli_fetch_assoc($result);
	$row_count = $data['total'];
    while ($row = mysqli_fetch_assoc($qry)) 
    {   
		$count++;
		if ($count==1)
		{
			$pdf->Ln(6);
			date_default_timezone_set('Asia/Kolkata');
			$date = date('(d/m/y - g:i A)');
			$pdf->Ln(2);
			$pdf->SetFont('times','B',9);
			$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
			$pdf->Ln(10);

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
			$qry1 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
        
			$report_row = mysqli_fetch_assoc($qry1);
			$report_to = $report_row['report_to'];
			if ($report_to !=0){
				$report_to_code = $app_code_obj->getName($report_to); 
				$report_to_name = $app_code_obj->get_User_role($report_to);
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
			}
			else{
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
			}
			
			
			$pdf->Ln(3);
			$concern = $row['task'];
			$assign_by = $row['assignby'];
			$work_assign_date = strtotime($row['work_assign_date']);
			$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
			$work_due_date = strtotime($row['work_due_date']);
			$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
			$work_com_date = strtotime($row['work_com_date']);
			if ($work_due_date != '' && $work_com_date != null){
				$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
			}
			else{
				$work_com_date = '';
			}
			

			$status = $row['status'];
			date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
			///
			
			if ($row['remark'] != '' && $row['remark'] != null ){
				$remark=  $row['remark'];
				}
				else{
					$remark= 'NA';
				}

			if (isset($row['Achievements']) != ''){
				// $achievements=  $row['Achievements'];
				$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
				}
				else{
					$achievements= 'NA';
				}

				if (isset($row['Benefits']) != ''){
					$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
				}
				else{
				$benefits = 'NA';
				}

			$pdf->SetFont('helvetica', 'B',10); 
			$htl='
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
					
			<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
				</tr>
			</table>';
		
			$pdf->SetFont('helvetica', 'B',10); 
			$html ='<table border="1" cellpadding="2" cellspacing="2">
			<tr>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
			</tr>
			<tr>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
			</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$rmk='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
				</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$htlm='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
				</tr>
				<tr>

				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
				</tr>
			</table>';

			$page_break = '<br pagebreak="true">';				
		
			$pdf->Ln(4);
			$pdf->WriteHTML($htl);
			$pdf->Ln(5);
			$pdf->WriteHTML($html);
			$pdf->Ln(3);
			$pdf->writeHtml($rmk);
			$pdf->Ln(5);
			$pdf->writeHtml($htlm);		
			$flag = 1;
			if ($row_count == 1)
					{
						$pdf->Ln(10);
						$pdf->SetFont('times','i',10);
						$pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. 
						This act as  proof of the Do Next task they completed. While for the company, 
						it serves as a copy for work completion and remark Thank You. ',0,'C',0,1,'','',true);
						$pdf->Ln(12);
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
	
						break;
					}
				$pdf->writeHtml($page_break);
		}

		elseif($count==$row_count)
		{
			date_default_timezone_set('Asia/Kolkata');
			$date = date('(d/m/y - g:i A)');
			// $pdf->Ln(2);
			$pdf->SetFont('times','B',9);
			$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
			$pdf->Ln(10);

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
			$qry1 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
        
			$report_row = mysqli_fetch_assoc($qry1);
			$report_to = $report_row['report_to'];
			if ($report_to !=0){
				$report_to_code = $app_code_obj->getName($report_to); 
				$report_to_name = $app_code_obj->get_User_role($report_to);
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
			}
			else{
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
			}

			$pdf->Ln(3);
			$concern = $row['task'];
			$assign_by = $row['assignby'];
			$work_assign_date = strtotime($row['work_assign_date']);
			$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
			$work_due_date = strtotime($row['work_due_date']);
			$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
			$work_com_date = strtotime($row['work_com_date']);
			if ($work_due_date != '' && $work_com_date != null){
				$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
			}
			else{
				$work_com_date = '';
			}
			

			$status = $row['status'];
			date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
			///
			
			if ($row['remark'] != '' && $row['remark'] != null ){
				$remark=  $row['remark'];
				}
				else{
					$remark= 'NA';
				}

			if (isset($row['Achievements']) != ''){
				// $achievements=  $row['Achievements'];
				$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
				}
				else{
					$achievements= 'NA';
				}

				if (isset($row['Benefits']) != ''){
					$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
				}
				else{
				$benefits = 'NA';
				}

			$pdf->SetFont('helvetica', 'B',10); 
			$htl='
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
					
			<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
				</tr>
			</table>';
		
			$pdf->SetFont('helvetica', 'B',10); 
			$html ='<table border="1" cellpadding="2" cellspacing="2">
			<tr>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
			</tr>
			<tr>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
			</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$rmk='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
				</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$htlm='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
				</tr>
				<tr>

				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
				</tr>
			</table>';

			$page_break = '<br pagebreak="true">';				
		
			$pdf->Ln(4);
			$pdf->WriteHTML($htl);
			$pdf->Ln(5);
			$pdf->WriteHTML($html);
			$pdf->Ln(3);
			$pdf->writeHtml($rmk);
			$pdf->Ln(5);
			$pdf->writeHtml($htlm);	
			
			$pdf->Ln(10);
			$pdf->SetFont('times','i',10);
			$pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. 
			This act as  proof of the Do Next task they completed. While for the company, 
			it serves as a copy for work completion and remark Thank You. ',0,'C',0,1,'','',true);
			$pdf->Ln(12);
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

			break;

		}
		else
		{
			date_default_timezone_set('Asia/Kolkata');
			$date = date('(d/m/y - g:i A)');
			// $pdf->Ln(2);
			$pdf->SetFont('times','B',9);
			$pdf->Cell(325,3,'Date - '.$date,0,1,'C');     
			$pdf->Ln(10);

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
			$qry1 = mysqli_query($connection, "SELECT report_to FROM emp_login where emp_code = '$emp_id' ") or die("select query fail" . mysqli_error($connection));
        
			$report_row = mysqli_fetch_assoc($qry1);
			$report_to = $report_row['report_to'];
			if ($report_to !=0){
				$report_to_code = $app_code_obj->getName($report_to); 
				$report_to_name = $app_code_obj->get_User_role($report_to);
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - '.$report_to_code, 0, 1);
			}
			else{
				$pdf->SetFont('helvetica', 'B',10); 
				$pdf->Cell(189, 5, 'Reporting To - ', 0, 1);
			}

			$pdf->Ln(3);
			$concern = $row['task'];
			$assign_by = $row['assignby'];
			$work_assign_date = strtotime($row['work_assign_date']);
			$work_assign_date = date( 'd-m-y g:i:s A', $work_assign_date );
			$work_due_date = strtotime($row['work_due_date']);
			$work_due_date = date( 'd-m-y g:i:s A', $work_due_date );
			$work_com_date = strtotime($row['work_com_date']);
			if ($work_due_date != '' && $work_com_date != null){
				$work_com_date = date( 'd-m-y g:i:s A', $work_com_date );
			}
			else{
				$work_com_date = '';
			}
			

			$status = $row['status'];
			date_default_timezone_set('Asia/Kolkata');
			$date = date('d-m-y g:i:s A');
			$originalTime = new DateTimeImmutable($date);
			$targedTime = new DateTimeImmutable($work_due_date);
			$interval = $originalTime->diff($targedTime);
			$interval = $interval->format("%a");
						 
			if ($work_com_date=='') { if ($interval>0){
			 	$due_status = "Due";
			 } else { if (strtotime($work_due_date) >= strtotime($date)) 
				 {
					$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 } } } else {
			 if (strtotime($work_com_date) <= strtotime($work_due_date)) { 
				$due_status = "Due";
			 } else {
				$due_status = "Overdue";
			 }}	
			///
			
			if ($row['remark'] != '' && $row['remark'] != null ){
				$remark=  $row['remark'];
				}
				else{
					$remark= 'NA';
				}

			if (isset($row['Achievements']) != ''){
				// $achievements=  $row['Achievements'];
				$achievements = nl2br(htmlentities($row['Achievements'], ENT_QUOTES, 'UTF-8'));
				}
				else{
					$achievements= 'NA';
				}

				if (isset($row['Benefits']) != ''){
					$benefits = nl2br(htmlentities($row['Benefits'], ENT_QUOTES, 'UTF-8'));
				}
				else{
				$benefits = 'NA';
				}

			$pdf->SetFont('helvetica', 'B',10); 
			$htl='
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
					
			<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">DO NEXT</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$concern.'</td>
				</tr>
			</table>';
		
			$pdf->SetFont('helvetica', 'B',10); 
			$html ='<table border="1" cellpadding="2" cellspacing="2">
			<tr>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assigned by</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Assign Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Date</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Completed on</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Status</th>
				<th width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Due Status</th>
			</tr>
			<tr>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$assign_by.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_assign_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_due_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$work_com_date.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$status.'</td>
				<td width="17%" style="text-align:center; vertical-align:middle;font-weight:bold;">'.$due_status.'</td>
			</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$rmk='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="100%" style="vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Remark</th>
				</tr>
				<tr>
					<td width="100%" style="vertical-align:middle;font-weight:bold;">'.$remark.'</td>
				</tr>
			</table>';

			$pdf->SetFont('helvetica', 'B',10); 
			$htlm='<table border="1" cellpadding="2" cellspacing="2">
				<tr>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Achivements</th>
					<th width="51%" style="text-align:center;vertical-align:middle;font-weight:bold;background-color: #00b33c; color: white;">Benifits</th>
				</tr>
				<tr>

				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$achievements.'</td>
				<td width="51%" style="vertical-align:middle;font-weight:bold;">'.$benefits.'</td>
				</tr>
			</table>';

			$page_break = '<br pagebreak="true">';				
		
			$pdf->Ln(4);
			$pdf->WriteHTML($htl);
			$pdf->Ln(5);
			$pdf->WriteHTML($html);
			$pdf->Ln(3);
			$pdf->writeHtml($rmk);
			$pdf->Ln(5);
			$pdf->writeHtml($htlm);		
			$pdf->writeHtml($page_break);
		}	
    }
 }

		// $pdf->Ln(12);
		// $pdf->SetFont('times','i',9);
		// $pdf->MultiCell(189, 15, 'This is a Computerize generated Work Submission Report is an important document for both the company and the users. This act as  proof of the Do Next and Concern task they completed. While for the company, it serves as a copy for work completion and remark Thank You. ',0,'L',0,1,'','',true);
		// $pdf->Ln(8);
		// $pdf->SetFont('times','B',10);
		// $pdf->Cell(20,1,'__________________',0,0);
		// $pdf->Cell(118,1,'',0,0);
		// $pdf->Cell(51,1,'______________________',0,1);
		// $pdf->Ln(2);
		// $pdf->SetFont('times','B',10);
		// $pdf->Cell(20,5,'Autherize Signatrue',0,0);
		// $pdf->Cell(118,5,'',0,0);
		// $pdf->Cell(51,5,'User/Empolyee Signature ',0,1);
		// $pdf->Cell(181,5,'(Office Used Only)',0,1);
		// $pdf->Cell(8,1,'',0,0);

		//This method is for footer
		
	
// Close and output PDF document
ob_end_clean();
date_default_timezone_set('Asia/Kolkata');
$date = strval(date('d-m-y g:i:s A'));
$report_name = 'Work_Concern_Report_'. $date;
$pdf->Output($report_name, 'I');


?>



