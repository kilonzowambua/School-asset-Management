<?php

require_once '../config/config.php';
require_once '../config/codeGen.php';
require_once('../vendor/autoload.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
#Asset Report
if (isset($_POST['asset_report'])) {
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $doc_type = $_POST['doc_type'];

    #Check if Doc type is Pdf
    if ($doc_type == 'Pdf') {
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));

        $html = '
        <!DOCTYPE html>
        <html>
    
            <head>
                <meta name="" content="XYZ,0,0,1" />
                <style type="text/css">
                    table {
                        font-size: 12px;
                        padding: 4px;
                    }
    
                    tr {
                        page-break-after: always;
                    }
    
                    th {
                        text-align: left;
                        padding: 4pt;
                    }
    
                    td {
                        padding: 5pt;
                    }
    
                    #b_border {
                        border-bottom: dashed thin;
                    }
    
                    legend {
                        color: #0b77b7;
                        font-size: 1.2em;
                    }
    
                    #error_msg {
                        text-align: left;
                        font-size: 11px;
                        color: red;
                    }
    
                    .header {
                        margin-bottom: 20px;
                        width: 100%;
                        text-align: left;
                        position: absolute;
                        top: 0px;
                    }
    
                    .footer {
                        width: 100%;
                        text-align: center;
                        position: fixed;
                        bottom: 5px;
                    }
    
                    #no_border_table {
                        border: none;
                    }
    
                    #bold_row {
                        font-weight: bold;
                    }
    
                    #amount {
                        text-align: right;
                        font-weight: bold;
                    }
    
                    .pagenum:before {
                        content: counter(page);
                    }
    
                    /* Thick red border */
                    hr.red {
                        border: 1px solid red;
                    }
                    .list_header{
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    }
                </style>
            </head>
    
            <body style="margin:1px;">
                <div class="footer">
                    <hr>
                    <i>Assets   Report. Generated On ' . date('d M Y') . '</i>
                </div>
    
                <div class="list_header" align="center">
                   
                    <br>
                    <h1>Assets Report </h1>
                    <hr style="width:100%" , color=black>
                    <h5>Asset From  ' . $start . ' To ' . $end . ' </h5>
                </div>
                <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:100%">Asset Tag</th>
                        <th style="width:100%">Asset Name</th>
                        <th style="width:50%">Date Of Puchase</th>
                        <th style="width:50%">Price</th>
                       
                    </tr>
                </thead>
                ';
        $ret = "SELECT * FROM `assets` ORDER BY `assets`.`asset_date_of_purchase` DESC";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($asset = $res->fetch_object()) {

            $html .=
                '
                        <tr>
                            <td>' . $asset->asset_tag . '</td>
                            <td>' . $asset->asset_name . '</td>
                            <td>' . formatDateTime($asset->asset_date_of_purchase) . '</td>
                            <td>Ksh  ' . number_format($asset->asset_price, 2)  . '</td>
                        </tr>
                        ';
        }
        $html .= '
        </table>
            </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Assets From ' . $start . ' To ' . $end, array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($doc_type == 'Excel') {
        /* Filter Excel Data */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Assets Report.xls";

        /* Excel Column Name */
        $fields = array('Asset Tag', 'Asset Name', 'Date Of Puchase', 'Price');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM `assets` ORDER BY `assets`.`asset_date_of_purchase` DESC");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {

                /* Hardwire This Data Into .xls File */
                $lineData = array($row['asset_tag'],  $row['asset_name'], $row['asset_name'], $row['asset_date_of_purchase'], 'Ksh' . ' ' . $row['asset_price']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'Asset Records Available...' . "\n";
        }

        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
    }
}

#Asset type Report
if (isset($_POST['asset_type_report'])) {

    $doc_type = $_POST['doc_type'];

    #Check if Doc type is Pdf
    if ($doc_type == 'Pdf') {


        $html = '
            <!DOCTYPE html>
            <html>
        
                <head>
                    <meta name="" content="XYZ,0,0,1" />
                    <style type="text/css">
                        table {
                            font-size: 12px;
                            padding: 4px;
                        }
        
                        tr {
                            page-break-after: always;
                        }
        
                        th {
                            text-align: left;
                            padding: 4pt;
                        }
        
                        td {
                            padding: 5pt;
                        }
        
                        #b_border {
                            border-bottom: dashed thin;
                        }
        
                        legend {
                            color: #0b77b7;
                            font-size: 1.2em;
                        }
        
                        #error_msg {
                            text-align: left;
                            font-size: 11px;
                            color: red;
                        }
        
                        .header {
                            margin-bottom: 20px;
                            width: 100%;
                            text-align: left;
                            position: absolute;
                            top: 0px;
                        }
        
                        .footer {
                            width: 100%;
                            text-align: center;
                            position: fixed;
                            bottom: 5px;
                        }
        
                        #no_border_table {
                            border: none;
                        }
        
                        #bold_row {
                            font-weight: bold;
                        }
        
                        #amount {
                            text-align: right;
                            font-weight: bold;
                        }
        
                        .pagenum:before {
                            content: counter(page);
                        }
        
                        /* Thick red border */
                        hr.red {
                            border: 1px solid red;
                        }
                        .list_header{
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        }
                    </style>
                </head>
        
                <body style="margin:1px;">
                    <div class="footer">
                        <hr>
                        <i>Asset types  Report. Generated On ' . date('d M Y') . '</i>
                    </div>
        
                    <div class="list_header" align="center">
                       
                        <br>
                        <h1>Asset Types Report </h1>
                        <hr style="width:100%" , color=black>
                        <h5>Asset Types </h5>
                    </div>
                    <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                    <thead>
                        <tr>
                           
                            <th style="width:100%">Asset Name</th>
                            <th style="width:50%">No of Assets</th>
                            
                           
                        </tr>
                    </thead>
                    ';
        $ret = "SELECT a_t.asset_type_id,a_t.asset_type_name,COUNT(a_s.asset_id) AS total_assets FROM asset_types AS a_t 
            INNER JOIN assets AS a_s ON a_t.asset_type_id=a_s.asset_type_id GROUP BY a_t.asset_type_id; ";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($asset = $res->fetch_object()) {

            $html .=
                '
                            <tr>
                                <td>' . $asset->asset_type_name . '</td>
                                <td>' . $asset->total_assets . '</td>
                             
                            </tr>
                            ';
        }
        $html .= '
            </table>
                </body>
            </html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Asset types Report ', array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($doc_type == 'Excel') {
        /* Filter Excel Data */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Asset types Report.xls";

        /* Excel Column Name */
        $fields = array('Asset Type Name', 'No of Assets');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT a_t.asset_type_id,a_t.asset_type_name,COUNT(a_s.asset_id) AS total_assets FROM asset_types AS a_t 
        INNER JOIN assets AS a_s ON a_t.asset_type_id=a_s.asset_type_id GROUP BY a_t.asset_type_id; ");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {

                /* Hardwire This Data Into .xls File */
                $lineData = array($row['asset_type_name'], $row['total_assets']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'Asset type Records Available...' . "\n";
        }

        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
    }
















    #Disposal report

    if (isset($_POST['asset_disposal_report'])) {
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));
        $doc_type = $_POST['doc_type'];

        #Check if Doc type is Pdf
        if ($doc_type == 'Pdf') {
            $start = date('Y-m-d', strtotime($_POST['start']));
            $end = date('Y-m-d', strtotime($_POST['end']));

            $html = '
                <!DOCTYPE html>
                <html>
            
                    <head>
                        <meta name="" content="XYZ,0,0,1" />
                        <style type="text/css">
                            table {
                                font-size: 12px;
                                padding: 4px;
                            }
            
                            tr {
                                page-break-after: always;
                            }
            
                            th {
                                text-align: left;
                                padding: 4pt;
                            }
            
                            td {
                                padding: 5pt;
                            }
            
                            #b_border {
                                border-bottom: dashed thin;
                            }
            
                            legend {
                                color: #0b77b7;
                                font-size: 1.2em;
                            }
            
                            #error_msg {
                                text-align: left;
                                font-size: 11px;
                                color: red;
                            }
            
                            .header {
                                margin-bottom: 20px;
                                width: 100%;
                                text-align: left;
                                position: absolute;
                                top: 0px;
                            }
            
                            .footer {
                                width: 100%;
                                text-align: center;
                                position: fixed;
                                bottom: 5px;
                            }
            
                            #no_border_table {
                                border: none;
                            }
            
                            #bold_row {
                                font-weight: bold;
                            }
            
                            #amount {
                                text-align: right;
                                font-weight: bold;
                            }
            
                            .pagenum:before {
                                content: counter(page);
                            }
            
                            /* Thick red border */
                            hr.red {
                                border: 1px solid red;
                            }
                            .list_header{
                                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            }
                        </style>
                    </head>
            
                    <body style="margin:1px;">
                        <div class="footer">
                            <hr>
                            <i>Asset disposal   Report. Generated On ' . date('d M Y') . '</i>
                        </div>
            
                        <div class="list_header" align="center">
                           
                            <br>
                            <h1>Asset disposal Report </h1>
                            <hr style="width:100%" , color=black>
                            <h5>Asset disposal From  ' . $start . ' To ' . $end . ' </h5>
                        </div>
                        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                        <thead>
                            <tr>
                                <th style="width:100%">Asset Tag</th>
                                <th style="width:100%">Asset Name</th>
                                <th style="width:70%">Disposed By</th>
                                <th style="width:70%">Method</th>
                                <th style="width:100%">Reason</th>
                                <th style="width:70%">Date</th>
                               
                            </tr>
                        </thead>
                        ';
            $ret = "SELECT * FROM assets AS ast
                INNER JOIN  assetdisposes AS astd ON ast.asset_id=astd.assetdispose_asset_id
                INNER JOIN staffs AS stf ON astd.assetdispose_by_id=stf.staff_id
                ORDER BY ast.asset_date_of_purchase DESC";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($asset = $res->fetch_object()) {

                $html .=
                    '
                                <tr>
                                    <td>' . $asset->asset_tag . '</td>
                                    <td>' . $asset->asset_name . '</td>
                                    <td>' . $asset->staff_first_name . ' ' . $asset->staff_last_name . '</td>
                                    <td>' . $asset->assetdispose_method . '</td>
                                    <td>' . $asset->assetdispose_reason . '</td>
                                    <td>' . formatDateTime($asset->assetdispose_date) . '</td>
                                    
                                </tr>
                                ';
            }
            $html .= '
                </table>
                    </body>
                </html>';

            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('Asset disposal report From ' . $start . ' To ' . $end, array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        } elseif ($doc_type == 'Excel') {
            /* Filter Excel Data */
            function filterData(&$str)
            {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            }

            /* Excel File Name */
            $fileName = "Asset disposal Report.xls";

            /* Excel Column Name */
            $fields = array('Asset Tag', 'Asset Name', 'Disposed By First Name', 'Disposed By Last Name', 'Method', 'Reason', 'Date');


            /* Implode Excel Data */
            $excelData = implode("\t", array_values($fields)) . "\n";

            /* Fetch All Records From The Database */
            $query = $mysqli->query("SELECT * FROM assets AS ast
            INNER JOIN  assetdisposes AS astd ON ast.asset_id=astd.assetdispose_asset_id
            INNER JOIN staffs AS stf ON astd.assetdispose_by_id=stf.staff_id
            ORDER BY ast.asset_date_of_purchase DESC");
            if ($query->num_rows > 0) {
                /* Load All Fetched Rows */
                while ($row = $query->fetch_assoc()) {
                    #Full Name

                    /* Hardwire This Data Into .xls File */
                    $lineData = array($row['asset_tag'], $row['asset_name'], $row['staff_first_name'], $row['staff_last_name'], $row['assetdispose_method'], $row['assetdispose_reason'], formatDateTime($row['assetdispose_date']));
                    array_walk($lineData, 'filterData');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";
                }
            } else {
                $excelData .= 'Asset disposals Records Available...' . "\n";
            }

            /* Generate Header File Encodings For Download */
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$fileName\"");

            /* Render  Excel Data For Download */
            echo $excelData;

            exit;
        }
    }
}

#Allocation report
if (isset($_POST['allocation_reports'])) {

    #Declare variables
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $doc_type = $_POST['doc_type'];
    $department_id = $_POST['department_id'];
    $staff_id =$_POST['staff_id'];

    if ($doc_type == 'Pdf' && $department_id == 'All') {
        #ALL departments in pdf
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));

        $html = '
                <!DOCTYPE html>
                <html>
            
                    <head>
                        <meta name="" content="XYZ,0,0,1" />
                        <style type="text/css">
                            table {
                                font-size: 12px;
                                padding: 4px;
                            }
            
                            tr {
                                page-break-after: always;
                            }
            
                            th {
                                text-align: left;
                                padding: 4pt;
                            }
            
                            td {
                                padding: 5pt;
                            }
            
                            #b_border {
                                border-bottom: dashed thin;
                            }
            
                            legend {
                                color: #0b77b7;
                                font-size: 1.2em;
                            }
            
                            #error_msg {
                                text-align: left;
                                font-size: 11px;
                                color: red;
                            }
            
                            .header {
                                margin-bottom: 20px;
                                width: 100%;
                                text-align: left;
                                position: absolute;
                                top: 0px;
                            }
            
                            .footer {
                                width: 100%;
                                text-align: center;
                                position: fixed;
                                bottom: 5px;
                            }
            
                            #no_border_table {
                                border: none;
                            }
            
                            #bold_row {
                                font-weight: bold;
                            }
            
                            #amount {
                                text-align: right;
                                font-weight: bold;
                            }
            
                            .pagenum:before {
                                content: counter(page);
                            }
            
                            /* Thick red border */
                            hr.red {
                                border: 1px solid red;
                            }
                            .list_header{
                                font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                            }
                        </style>
                    </head>
            
                    <body style="margin:1px;">
                        <div class="footer">
                            <hr>
                            <i>Assetallocations   Report. Generated On ' . date('d M Y') . '</i>
                        </div>
            
                        <div class="list_header" align="center">
                           
                            <br>
                            <h1>Asset allocation Report </h1>
                            <hr style="width:100%" , color=black>
                            <h5>Asset allocation From  ' . $start . ' To ' . $end . ' </h5>
                        </div>
                        <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                        <thead>
                            <tr>
                                <th style="width:100%">Asset Tag</th>
                                <th style="width:100%">Asset Name</th>
                                <th style="width:70%">Allocated to</th>
                                <th style="width:70%">Date</th>
                               
                            </tr>
                        </thead>
                        ';
        $ret = "SELECT * FROM allocations AS al
                INNER JOIN  staffs AS stf ON al.allocation_request_by_id=stf.staff_id
                INNER JOIN departments AS dep ON stf.staff_department_id=dep.department_id  
                INNER JOIN assets AS ast ON  al.allocation_asset_id=ast.asset_id WHERE al.allocation_status='APPROVED' AND allocation_date BETWEEN '$start' AND '$end'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($asset = $res->fetch_object()) {

            $html .=
                '
                                <tr>
                                    <td>' . $asset->asset_tag . '</td>
                                    <td>' . $asset->asset_name . '</td>
                                    <td>' . $asset->department_name . ' </td>
                                    <td>' . formatDateTime($asset->allocation_date) . '</td>
                                    
                                </tr>
                                ';
        }
        $html .= '
                </table>
                    </body>
                </html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Asset allocations report From ' . $start . ' To ' . $end, array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($doc_type == 'Excel' && $department_id == 'All') {
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));
        #ALL departments in Excel
        /* Filter Excel Data */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Asset allocations Report.xls";

        /* Excel Column Name */
        $fields = array('Asset Tag', 'Asset Name', 'Allocate to', 'Date');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM allocations AS al
 INNER JOIN  staffs AS stf ON al.allocation_request_by_id=stf.staff_id
 INNER JOIN departments AS dep ON stf.staff_department_id=dep.department_id  
 INNER JOIN assets AS ast ON  al.allocation_asset_id=ast.asset_id WHERE al.allocation_status='APPROVED' AND al.allocation_date BETWEEN '$start' AND '$end';");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                #Full Name

                /* Hardwire This Data Into .xls File */
                $lineData = array($row['asset_tag'], $row['asset_name'], $row['department_name'], $row['allocation_date']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'Asset allocations Records Available...' . "\n";
        }
        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
       
    } elseif ($doc_type == 'Pdf' && $department_id != 'All') {
        #Selected Department in Pdf
        $html = '
            <!DOCTYPE html>
            <html>
        
                <head>
                    <meta name="" content="XYZ,0,0,1" />
                    <style type="text/css">
                        table {
                            font-size: 12px;
                            padding: 4px;
                        }
        
                        tr {
                            page-break-after: always;
                        }
        
                        th {
                            text-align: left;
                            padding: 4pt;
                        }
        
                        td {
                            padding: 5pt;
                        }
        
                        #b_border {
                            border-bottom: dashed thin;
                        }
        
                        legend {
                            color: #0b77b7;
                            font-size: 1.2em;
                        }
        
                        #error_msg {
                            text-align: left;
                            font-size: 11px;
                            color: red;
                        }
        
                        .header {
                            margin-bottom: 20px;
                            width: 100%;
                            text-align: left;
                            position: absolute;
                            top: 0px;
                        }
        
                        .footer {
                            width: 100%;
                            text-align: center;
                            position: fixed;
                            bottom: 5px;
                        }
        
                        #no_border_table {
                            border: none;
                        }
        
                        #bold_row {
                            font-weight: bold;
                        }
        
                        #amount {
                            text-align: right;
                            font-weight: bold;
                        }
        
                        .pagenum:before {
                            content: counter(page);
                        }
        
                        /* Thick red border */
                        hr.red {
                            border: 1px solid red;
                        }
                        .list_header{
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        }
                    </style>
                </head>';
        $sql = "SELECT *FROM departments WHERE department_id='{$department_id}'";
        $result = mysqli_query($mysqli, $sql);
        while ($department = mysqli_fetch_object($result)) {

            $html .= '<body style="margin:1px;">
                    <div class="footer">
                        <hr>
                        <i>Asset allocations to ' . $department->department_name . 'Report. Generated On ' . date('d M Y') . '</i>
                    </div>
        
                    <div class="list_header" align="center">
                       
                        <br>
                        <h1>Asset allocations to ' . $department->department_name . '  Report </h1>
                        <hr style="width:100%" , color=black>
                        <h5>Asset allocations to ' . $department->department_name . '  From  ' . $start . ' To ' . $end . ' </h5>
                    </div>
                    <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                    <thead>
                        <tr>
                            <th style="width:100%">Asset Tag</th>
                            <th style="width:100%">Asset Name</th>
                            <th style="width:70%">Date</th>
                           
                        </tr>
                    </thead>
                    ';

            $ret = "SELECT * FROM allocations AS al
            INNER JOIN  staffs AS stf ON al.allocation_request_by_id=stf.staff_id
            INNER JOIN departments AS dep ON stf.staff_department_id=dep.department_id  
            INNER JOIN assets AS ast ON  al.allocation_asset_id=ast.asset_id WHERE al.allocation_status='Approved' AND al.allocation_date BETWEEN '$start' AND '$end' AND dep.department_id='{$department_id}'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($asset = $res->fetch_object()) {

                $html .=
                    '
                            <tr>
                                <td>' . $asset->asset_tag . '</td>
                                <td>' . $asset->asset_name . '</td>                   
                                <td>' . formatDateTime($asset->allocation_date) . '</td>
                                
                            </tr>
                            ';
            }
            $html .= '
            </table>
                </body>
            </html>';

            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('Asset allocations report From ' . $start . ' To ' . $end, array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        }
    } elseif ($doc_type == 'Excel' && $department_id != 'All') {
        # Selected Department in Excel
        /* Filter Excel Data */
        /* Filter Excel Data */

        $sql = "SELECT *FROM departments WHERE department_id='{$department_id}'";
        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($department = mysqli_fetch_object($result)) {
                function filterData(&$str)
                {
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\r?\n/", "\\n", $str);
                    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
                }

                /* Excel File Name */
                $fileName = "Asset allocations to $department->department_name Report.xls";

                /* Excel Column Name */
                $fields = array('Asset Tag', 'Asset Name', 'Date');


                /* Implode Excel Data */
                $excelData = implode("\t", array_values($fields)) . "\n";

                /* Fetch All Records From The Database */
                $query = $mysqli->query("SELECT * FROM allocations AS al
         INNER JOIN  staffs AS stf ON al.allocation_request_by_id=stf.staff_id
         INNER JOIN departments AS dep ON stf.staff_department_id=dep.department_id  
         INNER JOIN assets AS ast ON  al.allocation_asset_id=ast.asset_id WHERE al.allocation_status='Approved' AND al.allocation_date BETWEEN '$start' AND '$end' AND dep.department_id='{$department_id}'");
                if ($query->num_rows > 0) {
                    /* Load All Fetched Rows */
                    while ($row = $query->fetch_assoc()) {
                        #Full Name

                        /* Hardwire This Data Into .xls File */
                        $lineData = array($row['asset_tag'], $row['asset_name'], formatDateTime($row['allocation_date']));
                        array_walk($lineData, 'filterData');
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                } else {
                    $excelData .= 'No Asset allocations Records Available...' . "\n";
                }

                /* Generate Header File Encodings For Download */
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$fileName\"");

                /* Render  Excel Data For Download */
                echo $excelData;

                exit;
            }
        }
    }
}


#Staff Reports

if (isset($_POST['staff_reports'])) {

    #Declare variables
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $doc_type = $_POST['doc_type'];
    $department_id = $_POST['department_id'];

    if ($doc_type == 'Pdf' && $department_id == 'All') {
        #ALL departments in pdf
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));

        $html = '
        <!DOCTYPE html>
        <html>
    
            <head>
                <meta name="" content="XYZ,0,0,1" />
                <style type="text/css">
                    table {
                        font-size: 12px;
                        padding: 4px;
                    }
    
                    tr {
                        page-break-after: always;
                    }
    
                    th {
                        text-align: left;
                        padding: 4pt;
                    }
    
                    td {
                        padding: 5pt;
                    }
    
                    #b_border {
                        border-bottom: dashed thin;
                    }
    
                    legend {
                        color: #0b77b7;
                        font-size: 1.2em;
                    }
    
                    #error_msg {
                        text-align: left;
                        font-size: 11px;
                        color: red;
                    }
    
                    .header {
                        margin-bottom: 20px;
                        width: 100%;
                        text-align: left;
                        position: absolute;
                        top: 0px;
                    }
    
                    .footer {
                        width: 100%;
                        text-align: center;
                        position: fixed;
                        bottom: 5px;
                    }
    
                    #no_border_table {
                        border: none;
                    }
    
                    #bold_row {
                        font-weight: bold;
                    }
    
                    #amount {
                        text-align: right;
                        font-weight: bold;
                    }
    
                    .pagenum:before {
                        content: counter(page);
                    }
    
                    /* Thick red border */
                    hr.red {
                        border: 1px solid red;
                    }
                    .list_header{
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    }
                </style>
            </head>
    
            <body style="margin:1px;">
                <div class="footer">
                    <hr>
                    <i>Staffs  Report. Generated On ' . date('d M Y') . '</i>
                </div>
    
                <div class="list_header" align="center">
                   
                    <br>
                    <h1>Staffs Report </h1>
                    <hr style="width:100%" , color=black>
                    <h5>Staffs From  ' . $start . ' To ' . $end . ' </h5>
                </div>
                <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:100%">Staff No</th>
                        <th style="width:100%">Staff Name</th>
                        <th style="width:70%">Staff Email</th>
                        <th style="width:70%">Department Name</th>
                        <th style="width:70%">Date</th>
                       
                    </tr>
                </thead>
                ';
        $ret = "SELECT * FROM staffs AS s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_status='Active' AND s.staff_created_on BETWEEN '$start' AND '$end'";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($staff = $res->fetch_object()) {

            $html .=
                '
                        <tr>
                            <td>' . $staff->staff_no . '</td>
                            <td>' . $staff->staff_first_name . '  ' . $staff->staff_last_name   . '</td>
                            <td>' . $staff->staff_email . '</td>
                            <td>' . $staff->department_name . ' </td>
                            <td>' . formatDateTime($staff->staff_created_on) . '</td>
                            
                        </tr>
                        ';
        }
        $html .= '
        </table>
            </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('staffs report From' . $start . ' To ' . $end, array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($doc_type == 'Excel' && $department_id == 'All') {
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));
        #ALL departments in Excel
        /* Filter Excel Data */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Staffs Report.xls";

        /* Excel Column Name */
        $fields = array('Staff No', 'Staff_First_Name', 'Staff_Last_Name', 'Staff_email', 'Department Name', 'Date');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM staffs AS s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_status='Active' AND s.staff_created_on BETWEEN '$start' AND '$end'");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                #Full Name

                /* Hardwire This Data Into .xls File */
                $lineData = array($row['staff_no'], $row['staff_first_name'], $row['staff_last_name'], $row['staff_email'], $row['department_name'], $row['staff_created_on']);
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'No  Staffs Records Available...' . "\n";
        }
        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
    } elseif ($doc_type == 'Pdf' && $department_id != 'All') {
        #Selected Department in Pdf
        $html = '
    <!DOCTYPE html>
    <html>

        <head>
            <meta name="" content="XYZ,0,0,1" />
            <style type="text/css">
                table {
                    font-size: 12px;
                    padding: 4px;
                }

                tr {
                    page-break-after: always;
                }

                th {
                    text-align: left;
                    padding: 4pt;
                }

                td {
                    padding: 5pt;
                }

                #b_border {
                    border-bottom: dashed thin;
                }

                legend {
                    color: #0b77b7;
                    font-size: 1.2em;
                }

                #error_msg {
                    text-align: left;
                    font-size: 11px;
                    color: red;
                }

                .header {
                    margin-bottom: 20px;
                    width: 100%;
                    text-align: left;
                    position: absolute;
                    top: 0px;
                }

                .footer {
                    width: 100%;
                    text-align: center;
                    position: fixed;
                    bottom: 5px;
                }

                #no_border_table {
                    border: none;
                }

                #bold_row {
                    font-weight: bold;
                }

                #amount {
                    text-align: right;
                    font-weight: bold;
                }

                .pagenum:before {
                    content: counter(page);
                }

                /* Thick red border */
                hr.red {
                    border: 1px solid red;
                }
                .list_header{
                    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                }
            </style>
        </head>';
        $sql = "SELECT *FROM departments WHERE department_id='{$department_id}'";
        $result = mysqli_query($mysqli, $sql);
        while ($department = mysqli_fetch_object($result)) {

            $html .= '<body style="margin:1px;">
            <div class="footer">
                <hr>
                <i>Staffs From ' . $department->department_name . 'Report. Generated On ' . date('d M Y') . '</i>
            </div>

            <div class="list_header" align="center">
               
                <br>
                <h1>Staffs From ' . $department->department_name . '  Report </h1>
                <hr style="width:100%" , color=black>
                <h5>Staffs From ' . $department->department_name . '  From  ' . $start . ' To ' . $end . ' </h5>
            </div>
            <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:100%">Staff No</th>
                        <th style="width:100%">Staff Name</th>
                        <th style="width:70%">Staff Email</th>
                        <th style="width:70%">Date</th>
                       
                    </tr>
                </thead>
                ';
            $ret = "SELECT * FROM staffs AS s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_status='Active' AND s.staff_created_on BETWEEN '$start' AND '$end' AND d.department_id='{$department_id}'";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($staff = $res->fetch_object()) {

                $html .=
                    '
                        <tr>
                            <td>' . $staff->staff_no . '</td>
                            <td>' . $staff->staff_first_name . '  ' . $staff->staff_last_name   . '</td>
                            <td>' . $staff->staff_email . '</td>
                            <td>' . formatDateTime($staff->staff_created_on) . '</td>
                            
                        </tr>
                        ';
            }
            $html .= '
        </table>
        </body>
    </html>';

            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('Staffs report From ' . $start . ' To ' . $end, array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        }
    } elseif ($doc_type == 'Excel' && $department_id != 'All') {
        # Selected Department in Excel
        /* Filter Excel Data */
        /* Filter Excel Data */

        $sql = "SELECT *FROM departments WHERE department_id='{$department_id}'";
        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($department = mysqli_fetch_object($result)) {
                function filterData(&$str)
                {
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\r?\n/", "\\n", $str);
                    if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
                }

                /* Excel File Name */
                $fileName = "Staffs from $department->department_name Report.xls";

                /* Excel Column Name */
                $fields = array('Staff No', 'Staff_First_Name', 'Staff_Last_Name', 'Staff_email', 'Date');


                /* Implode Excel Data */
                $excelData = implode("\t", array_values($fields)) . "\n";

                /* Fetch All Records From The Database */
                $query = $mysqli->query("SELECT * FROM staffs AS s INNER JOIN departments d ON s.staff_department_id = d.department_id WHERE s.staff_status='Active' AND s.staff_created_on BETWEEN '$start' AND '$end' AND d.department_id='{$department_id}'");
                if ($query->num_rows > 0) {
                    /* Load All Fetched Rows */
                    while ($row = $query->fetch_assoc()) {
                        #Full Name

                        /* Hardwire This Data Into .xls File */
                        $lineData = array($row['staff_no'], $row['staff_first_name'], $row['staff_last_name'], $row['staff_email'], $row['staff_created_on']);
                        array_walk($lineData, 'filterData');
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                } else {
                    $excelData .= 'No Staffs allocations Records Available...' . "\n";
                }

                /* Generate Header File Encodings For Download */
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"$fileName\"");

                /* Render  Excel Data For Download */
                echo $excelData;

                exit;
            }
        }
    }
}


#Department Report
if (isset($_POST['department_report'])) {
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $doc_type = $_POST['doc_type'];

    #Check if Doc type is Pdf
    if ($doc_type == 'Pdf') {
        $start = date('Y-m-d', strtotime($_POST['start']));
        $end = date('Y-m-d', strtotime($_POST['end']));

        $html = '
        <!DOCTYPE html>
        <html>
    
            <head>
                <meta name="" content="XYZ,0,0,1" />
                <style type="text/css">
                    table {
                        font-size: 12px;
                        padding: 4px;
                    }
    
                    tr {
                        page-break-after: always;
                    }
    
                    th {
                        text-align: left;
                        padding: 4pt;
                    }
    
                    td {
                        padding: 5pt;
                    }
    
                    #b_border {
                        border-bottom: dashed thin;
                    }
    
                    legend {
                        color: #0b77b7;
                        font-size: 1.2em;
                    }
    
                    #error_msg {
                        text-align: left;
                        font-size: 11px;
                        color: red;
                    }
    
                    .header {
                        margin-bottom: 20px;
                        width: 100%;
                        text-align: left;
                        position: absolute;
                        top: 0px;
                    }
    
                    .footer {
                        width: 100%;
                        text-align: center;
                        position: fixed;
                        bottom: 5px;
                    }
    
                    #no_border_table {
                        border: none;
                    }
    
                    #bold_row {
                        font-weight: bold;
                    }
    
                    #amount {
                        text-align: right;
                        font-weight: bold;
                    }
    
                    .pagenum:before {
                        content: counter(page);
                    }
    
                    /* Thick red border */
                    hr.red {
                        border: 1px solid red;
                    }
                    .list_header{
                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                    }
                </style>
            </head>
    
            <body style="margin:1px;">
                <div class="footer">
                    <hr>
                    <i>Departments  Report. Generated On ' . date('d M Y') . '</i>
                </div>
    
                <div class="list_header" align="center">
                   
                    <br>
                    <h1>Departments Report </h1>
                    <hr style="width:100%" , color=black>
                    <h5>Departments From  ' . $start . ' To ' . $end . ' </h5>
                </div>
                <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                <thead>
                    <tr>
                        <th style="width:100%">Department Name</th>
                        <th style="width:70%">No of Members</th>
                        <th style="width:100%">Head of Department</th>
                        <th style="width:70%">Date</th>
                       
                    </tr>
                </thead>
                ';
        $ret = "SELECT dp.department_name, COUNT(st.staff_id) AS staff_count, dp.department_head_id, dp.department_id,dp.department_created_on
        FROM departments AS dp
        INNER JOIN staffs AS st ON dp.department_id = st.staff_department_id
        GROUP BY dp.department_name, dp.department_head_id, dp.department_id;";
        $stmt = $mysqli->prepare($ret);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        while ($department = $res->fetch_object()) {
            $sql = "SELECT staff_id,staff_first_name,staff_last_name FROM staffs WHERE staff_id='{$department->department_head_id}' ORDER BY staff_first_name ASC; ";
            $result2 = mysqli_query($mysqli, $sql);
            if (mysqli_num_rows($result2) > 0) {
                while ($department_head = mysqli_fetch_object($result2)) {
                    $html .=
                        '
                        <tr>
                            <td>' . $department->department_name . '</td>
                            <td>' . $department->staff_count . '</td>
                            <td>' . $department_head->staff_first_name . ' ' . $department_head->staff_last_name . '</td>
                            <td>' . formatDateTime($department->department_created_on) . '</td>
                            
                        </tr>
                        ';
                }
            }
        }
        $html .= '
        </table>
            </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->load_html($html);
        $dompdf->set_paper('A4');
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->render();
        $dompdf->stream('Departments report From ' . $start . ' To ' . $end, array("Attachment" => 1));
        $options = $dompdf->getOptions();
        $options->setDefaultFont('');
        $dompdf->setOptions($options);
    } elseif ($doc_type == 'Excel') {
        /* Filter Excel Data */
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "Departments Report.xls";

        /* Excel Column Name */
        $fields = array('Department Name', 'No of Members', 'Date');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT dp.department_name, COUNT(st.staff_id) AS staff_count, dp.department_head_id, dp.department_id,dp.department_created_on
    FROM departments AS dp
    INNER JOIN staffs AS st ON dp.department_id = st.staff_department_id
    GROUP BY dp.department_name, dp.department_head_id, dp.department_id;");
        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {

                /* Hardwire This Data Into .xls File */
                $lineData = array($row['department_name'], $row['staff_count'], formatDateTime($row['department_created_on']));
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $excelData .= 'Departments Records Available...' . "\n";
        }

        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
    }
} 

#Staff asset report
if(isset($_POST['my_assets_report'])){
    #Declare Variables
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $doc_type = $_POST['doc_type'];
    $staff_id =$_POST['staff_id'];

if ($doc_type == 'Pdf' && $staff_id != '') {
      
    #My allocations in Pdf
            #Selected Department in Pdf
            $html = '
            <!DOCTYPE html>
            <html>
        
                <head>
                    <meta name="" content="XYZ,0,0,1" />
                    <style type="text/css">
                        table {
                            font-size: 12px;
                            padding: 4px;
                        }
        
                        tr {
                            page-break-after: always;
                        }
        
                        th {
                            text-align: left;
                            padding: 4pt;
                        }
        
                        td {
                            padding: 5pt;
                        }
        
                        #b_border {
                            border-bottom: dashed thin;
                        }
        
                        legend {
                            color: #0b77b7;
                            font-size: 1.2em;
                        }
        
                        #error_msg {
                            text-align: left;
                            font-size: 11px;
                            color: red;
                        }
        
                        .header {
                            margin-bottom: 20px;
                            width: 100%;
                            text-align: left;
                            position: absolute;
                            top: 0px;
                        }
        
                        .footer {
                            width: 100%;
                            text-align: center;
                            position: fixed;
                            bottom: 5px;
                        }
        
                        #no_border_table {
                            border: none;
                        }
        
                        #bold_row {
                            font-weight: bold;
                        }
        
                        #amount {
                            text-align: right;
                            font-weight: bold;
                        }
        
                        .pagenum:before {
                            content: counter(page);
                        }
        
                        /* Thick red border */
                        hr.red {
                            border: 1px solid red;
                        }
                        .list_header{
                            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                        }
                    </style>
                </head>';
      

            $html .= '<body style="margin:1px;">
                    <div class="footer">
                        <hr>
                        <i>My Asset allocations Report. Generated On ' . date('d M Y') . '</i>
                    </div>
        
                    <div class="list_header" align="center">
                       
                        <br>
                        <h1>My Asset allocations Report </h1>
                        <hr style="width:100%" , color=black>
                        <h5>Asset allocations  From  ' . $start . ' To ' . $end . ' </h5>
                    </div>
                    <table border="1" cellspacing="0" width="98%" style="font-size:9pt">
                    <thead>
                        <tr>
                            <th style="width:100%">Asset Tag</th>
                            <th style="width:100%">Asset Name</th>
                            <th style="width:100%">Allocated by </th>
                            <th style="width:70%">Date</th>
                           
                        </tr>
                    </thead>
                    ';

            $ret = "SELECT * FROM assets AS ast
            INNER JOIN allocations AS al ON ast.asset_id = al.allocation_asset_id
            INNER JOIN staffs AS st ON al.allocation_request_by_id=st.staff_id
            WHERE ast.assetdispose_id IS NULL AND st.staff_id ='{$staff_id}' AND al.allocation_status='Approved'
            GROUP BY ast.asset_id
            ORDER BY ast.asset_date_of_purchase DESC";
            $stmt = $mysqli->prepare($ret);
            $stmt->execute(); //ok
            $res = $stmt->get_result();
            while ($asset = $res->fetch_object()) {
                $sql = "SELECT * FROM staffs WHERE staff_id='{$asset->allocation_allocated_by_id}'";
                                $result2 = mysqli_query($mysqli, $sql);
                                if (mysqli_num_rows($result2) > 0) {
                                    while ($hod = mysqli_fetch_object($result2)) { 

                $html .=
                    '
                            <tr>
                                <td>' . $asset->asset_tag . '</td>
                                <td>' . $asset->asset_name . '</td> 
                               <td> ' .  $hod->staff_first_name .''. $hod->staff_last_name . ' </td>
                                                          
                                <td>' . formatDateTime($asset->allocation_date) . '</td>
                                
                            </tr>
                            ';
            }}}
            $html .= '
            </table>
                </body>
            </html>';

            $dompdf = new Dompdf();
            $dompdf->load_html($html);
            $dompdf->set_paper('A4');
            $dompdf->set_option('isHtml5ParserEnabled', true);
            $dompdf->render();
            $dompdf->stream('My Asset allocations report From ' . $start . ' To ' . $end, array("Attachment" => 1));
            $options = $dompdf->getOptions();
            $options->setDefaultFont('');
            $dompdf->setOptions($options);
        
   
}elseif ($doc_type == 'Excel' && $staff_id != '') {

  
        function filterData(&$str)
        {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
        }

        /* Excel File Name */
        $fileName = "My Asset allocations  Report.xls";

        /* Excel Column Name */
        $fields = array('Asset Tag', 'Asset Name','Allocate by', 'Date');


        /* Implode Excel Data */
        $excelData = implode("\t", array_values($fields)) . "\n";

        /* Fetch All Records From The Database */
        $query = $mysqli->query("SELECT * FROM assets AS ast
        INNER JOIN allocations AS al ON ast.asset_id = al.allocation_asset_id
        INNER JOIN staffs AS st ON al.allocation_request_by_id=st.staff_id
        WHERE ast.assetdispose_id IS NULL AND st.staff_id ='{$staff_id}' AND al.allocation_status='Approved'
        GROUP BY ast.asset_id
        ORDER BY ast.asset_date_of_purchase DESC");

        if ($query->num_rows > 0) {
            /* Load All Fetched Rows */
            while ($row = $query->fetch_assoc()) {
                $sql = "SELECT * FROM staffs WHERE staff_id='{$row['allocation_allocated_by_id']}'";
                $result2 = mysqli_query($mysqli, $sql);
                if (mysqli_num_rows($result2) > 0) {
                    while ($hod = mysqli_fetch_object($result2)) { 

                #Full Name
               $allocateBy = $hod->staff_first_name . ' ' . $hod->staff_last_name;
                /* Hardwire This Data Into .xls File */
                $lineData = array($row['asset_tag'], $row['asset_name'], $allocateBy, formatDateTime($row['allocation_date']));
                array_walk($lineData, 'filterData');
                $excelData .= implode("\t", array_values($lineData)) . "\n";
            }}}
        } else {
            $excelData .= 'No Asset allocated to you...' . "\n";
        }

        /* Generate Header File Encodings For Download */
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        /* Render  Excel Data For Download */
        echo $excelData;

        exit;
    }}
   
 