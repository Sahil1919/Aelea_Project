<?php
include './includes/db.php';

// $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
$CurPageURL = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  

$url_components = parse_url($CurPageURL);

parse_str($url_components['query'], $params);

// Logic to set the PDF table 
if ($params['search'] != null)
{

    $qry = mysqli_query($connection, "SELECT emp_code FROM pdf_views ") or die("select query fail" . mysqli_error());

    while($row= mysqli_fetch_assoc($qry)){

        if (strtolower($row['emp_code']) == strtolower($params['search'])){
            $data = $row['emp_code'];
            echo $data;
            $qry1 = mysqli_query($connection, "SELECT * FROM pdf_views WHERE emp_code='$data' ") or die("select query fail" . mysqli_error());
            while($row1= mysqli_fetch_assoc($qry1)){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('d-m-y g:i:s A');
                // echo $date;
                $emp_id = $row['emp_code'];
                echo $emp_id;
                $emp_name = $row['emp_name'];
                $role_type = $row['user_role'];
                $email_id = $row['email_id'];
                $emp_mob = $row['emp_mob'];
                $concern = $row['task'];
                $assign_by = $row['assignby'];
                $work_assign_date = $row['work_assign_date'];
                $work_due_date = $row['work_due_date'];
                $work_com_date = $row['work_com_date'];
                $status = $row['status'];
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

                if (isset($row['remark']) != ''){
                        $remark = $row['remark'];
                }
                else{
                    $remark = '';
                }

                if (isset($row['Achievements']) != ''){
                    $achievements=  $row['Achievements'];
                    }
                    else{
                        $achievements= '';
                    }

                    if (isset($row['Benefits']) != ''){
                        $benefits =  $row['Benefits'];
                    }
                    else{
                    $benefits = '';
                    }
                    }
            break;
        }
    }

    $qry = mysqli_query($connection, "SELECT emp_name FROM pdf_views ") or die("select query fail" . mysqli_error());
    while($row= mysqli_fetch_assoc($qry)){
        // $name = strtolower($row['emp_name']);
        if (str_starts_with(strtolower($row['emp_name']),strtolower($params['search']))){

            $data = $row['emp_name'];
            echo $data;
            $qry1 = mysqli_query($connection, "SELECT * FROM pdf_views WHERE emp_name='$data' ") or die("select query fail" . mysqli_error());
            while($row1= mysqli_fetch_assoc($qry1)){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('d-m-y g:i:s A');
                // echo $date;
                $emp_id = $row['emp_code'];
                echo $emp_id;
                $emp_name = $row['emp_name'];
                $role_type = $row['user_role'];
                $email_id = $row['email_id'];
                $emp_mob = $row['emp_mob'];
                $concern = $row['task'];
                $assign_by = $row['assignby'];
                $work_assign_date = $row['work_assign_date'];
                $work_due_date = $row['work_due_date'];
                $work_com_date = $row['work_com_date'];
                $status = $row['status'];
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

                if (isset($row['remark']) != ''){
                        $remark = $row['remark'];
                }
                else{
                    $remark = '';
                }

                if (isset($row['Achievements']) != ''){
                    $achievements=  $row['Achievements'];
                    }
                    else{
                        $achievements= '';
                    }

                    if (isset($row['Benefits']) != ''){
                        $benefits =  $row['Benefits'];
                    }
                    else{
                    $benefits = '';
                    }
                    }
            break;
        }
    }

    $qry = mysqli_query($connection, "SELECT task FROM pdf_views ") or die("select query fail" . mysqli_error());
    while($row= mysqli_fetch_assoc($qry)){
        $task = strtolower($row['task']);
        if (str_starts_with($task,strtolower($params['search']))){

            $data = $row['task'];
            echo $data;
            $qry1 = mysqli_query($connection, "SELECT * FROM pdf_views WHERE task='$data' ") or die("select query fail" . mysqli_error());
            while($row1= mysqli_fetch_assoc($qry1)){
                date_default_timezone_set('Asia/Kolkata');
                $date = date('d-m-y g:i:s A');
                // echo $date;
                $emp_id = $row['emp_code'];
                echo $emp_id;
                $emp_name = $row['emp_name'];
                $role_type = $row['user_role'];
                $email_id = $row['email_id'];
                $emp_mob = $row['emp_mob'];
                $concern = $row['task'];
                $assign_by = $row['assignby'];
                $work_assign_date = $row['work_assign_date'];
                $work_due_date = $row['work_due_date'];
                $work_com_date = $row['work_com_date'];
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

                if (isset($row['remark']) != ''){
                        $remark = $row['remark'];
                }
                else{
                    $remark = '';
                }

                if (isset($row['Achievements']) != ''){
                    $achievements=  $row['Achievements'];
                    }
                    else{
                        $achievements= '';
                    }

                    if (isset($row['Benefits']) != ''){
                        $benefits =  $row['Benefits'];
                    }
                    else{
                    $benefits = '';
                    }
                    }
            break;
        }
    }
}


else
{

    $qry = mysqli_query($connection, "SELECT * FROM pdf_views ") or die("select query fail" . mysqli_error());
    while ($row = mysqli_fetch_assoc($qry)) 
    {        
		date_default_timezone_set('Asia/Kolkata');
        $date = date('d-m-y g:i:s A');

        $concern = $row['task'];
        $assign_by = $row['assignby'];
        $work_assign_date = $row['work_assign_date'];
        $work_due_date = $row['work_due_date'];
        $work_com_date = $row['work_com_date'];
        $status = $row['status'];
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

        echo $due_status;
        if (isset($row['remark']) != ''){
                $remark = $row['remark'];
        }
        else{
            $remark = '';
        }

        if (isset($row['Achievements']) != ''){
            $achievements=  $row['Achievements'];
            }
            else{
                $achievements= '';
            }

            if (isset($row['Benefits']) != ''){
                $benefits =  $row['Benefits'];
            }
            else{
            $benefits = '';
            }
    }  
 }


    


