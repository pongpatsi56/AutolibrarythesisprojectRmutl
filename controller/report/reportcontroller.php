<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/lib/model/reportmodel.php';
$getdate = $_GET['start_date'];

if (isset($_SESSION['data_report'])) {
    unset($_SESSION['data_report']);
    unset($_SESSION['report_type']);
    unset($_SESSION['datereport']);
} // clear session ก่อน get data
if (isset($_GET['fil_report'])) {
    switch ($_GET['fil_report']) {
        case 'br_res_All':
        $datas = array();
        $getlibdata = get_data_report("SELECT * FROM librarian JOIN borrowandreturn ON librarian.Username = borrowandreturn.Librarian GROUP BY borrowandreturn.Librarian");
            foreach ($getlibdata as $key) {
                $getlibID = $key['Librarian'];
                $getmemdata = get_data_report("SELECT * FROM Member JOIN borrowandreturn ON Member.ID = borrowandreturn.Member WHERE borrowandreturn.librarian = '$getlibID'
            GROUP BY borrowandreturn.Member ");
                $libdata = array(
                    'Librarian' => $key['Librarian'],
                    'FName' => $key['FName'],
                    'LName' => $key['LName'],
                    'submem' => array()
                );
                foreach ($getmemdata as $key1) {
                    $getID = $key1['Member'];
                    $getbookdata = get_data_report("SELECT *,CONCAT(databibliography.title,' / ',databibliography.author) AS NameBooks FROM borrowandreturn LEFT JOIN databibliography ON  borrowandreturn.Book = databibliography.Barcode
                    WHERE borrowandreturn.Member = '$getID' AND borrowandreturn.Borrow = '$getdate' ");
                    $memdata = array(
                        'Member' => $key1['Member'],
                        'FName' => $key1['FName'],
                        'LName' => $key1['LName'],
                        'subbook' => $getbookdata
                    );
                    if (count($getbookdata) > 0) {
                        array_push($libdata['submem'],$memdata);
                    }
                    
                }
                if (count($libdata['submem']) > 0) {
                    array_push($datas,$libdata);
                }
                
            }
            $_SESSION['report_type'] = $_GET['fil_report'];
            $_SESSION['datereport'] = $getdate;
            $_SESSION['data_report'] = $datas;
            break;
        case 'br_res_byuser':
            # code...
            break;
        case 'fine_byuser':
        $_SESSION['data_report'] = get_data_report("SELECT finebook.ID AS ReceiptNO,Member.ID,CONCAT(Member.FName,' ',Member.LName) AS MemFullName , finebook.Payment 
        FROM finebook   LEFT JOIN borrowandreturn ON  finebook.Borrow_ID = borrowandreturn.ID
                        LEFT JOIN Member ON  borrowandreturn.Member = Member.ID
        WHERE finebook.day = '$getdate'");
        $_SESSION['report_type'] = $_GET['fil_report'];
        $_SESSION['datereport'] = $getdate;
            break;
        case 'fine_day_bylib':
            # code...
            break;
        case 'index_journal':
            # code...
            break;
        case 'rec_all_res':
            # code...
            break;
        case 'list_res':
            # code...
            break;
        case 'list_res_bylib':
            # code...
            break;

        default:
            # code...
            break;
    }

}

header("refresh: 1; url= /lib/view/report/reporting.php ");
