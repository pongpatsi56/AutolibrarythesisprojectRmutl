<?php
        

////รายงานสถิตการทำรายการทรัพยากร////
function month_year($date, $type)
{
  $str = convert_datethai_monthfull($date);
  $result = explode(' ', $str);
  if ($type == 'byyear') {
    $str = $result[1] . ' ' . $result[2];
  }
  return $str;
};
// echo $start_date . '</br>';
// echo $start_month . '</br>';
// echo $start_year . '</br>';
$title_date = '';
if ($subreporttype == 'byyear') {
  $strsql = "YEAR(log.Day) = " . "'$start_year'" . " GROUP BY month(log.Day)";
  $title_date = 'ปี ' . (543 + $start_year);
} elseif ($subreporttype == 'byperiod') {
  $split = explode('-', $start_month);
  $strsql = "MONTH(log.Day) = " . "'$split[1]'" . " AND YEAR(log.Day) = " . "'$split[0]'" . " GROUP BY log.Day";
  $getsubdate = convert_datethai_monthfull($start_month . '-15');
  $subdate = explode(' ', $getsubdate);
  $title_date = $subdate[1] . ' ' . $subdate[2];
} else {
  $strsql = "log.Day LIKE " . "'%$start_date%'" . " GROUP BY log.Day";
  $title_date = convert_datethai_monthfull($start_date);
}
// echo '<br>' . $strsql;

/// region query data ///
$get_data = get_data_report("SELECT * FROM databib_article JOIN log ON databib_article.ID = log.Item WHERE log.Tables = 'databib_article' AND  $strsql");
/// end region ///
// echo "SELECT * FROM databib_article JOIN log ON databib_article.ID = log.Item WHERE log.Tables = 'databib_article' AND  $strsql";
echo '<h4>' . "รายงานดัชนีบทความวารสาร เมื่อ " . $title_date . '</h4>';
// echo '<pre>';
// print_r($get_data);
// echo "<pre>";
// $sss = "SELECT * FROM databib_article JOIN log ON databib_article.ID = log.Item WHERE log.Tables = 'databib_article' AND $strsql";
// print_r($sss);
// echo "</pre>";
if (count($get_data) > 0) { ?>
  <div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr class="warning">
          <th class="t-cen" colspan="1">ลำดับ</th>
          <th class="t-cen" colspan="6">ดัชนีบทความวารสาร</th>
          <th class="t-cen" colspan="3">วันที่/เวลา</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // echo "<pre>";
        // print_r($get_data);
        // echo "</pre>";


        $stack_Item = "(";
        foreach ($get_data as $key => $value) {
          $stack_Item .= "'{$get_data[$key]['Item']}',";
          $get_data[$key]['Day'] = convthaitimestamp($get_data[$key]['Day']);
        }
        $stack_Item = substr($stack_Item,0,strlen($stack_Item)-1).")";

        $sql = "SELECT * FROM databib_article WHERE ID IN $stack_Item ";
        $data = $conn->query($sql);
        for ($i=0; $i < mysqli_num_rows($data) ; $i++) { 
          $data_temp[$i] = $data->fetch_assoc() ;
        }
        for ($i=0; $i < count($data_temp) ; $i++) { 
          $data_article[$data_temp[$i]['ID']][$data_temp[$i]['Field']] = [ 'inc1' => $data_temp[$i]['Indicator1'] , 'inc2' => $data_temp[$i]['Indicator2'] , 'sub' => $data_temp[$i]['Subfield'] ];
        }
        // echo "<pre>";
        // print_r($data_temp);
        // echo "</pre>";

        function cut_arr($val,$field,$word,$tag){
          $cut = calsub_arr($val,$field);
          return $cut[$word][$tag];
        }

        foreach ($get_data as $key => $value) {
          $stack_word = "";
          $stack_word .= cut_arr($data_article[$get_data[$key]['Item']]['100']['sub'],'100','Author','#a').",";
          $stack_word .= '"'.cut_arr($data_article[$get_data[$key]['Item']]['245']['sub'],'245','Title','#a').'",';
          $stack_word .= '<b>'.cut_arr($data_article[$get_data[$key]['Item']]['773']['sub'],'773','Page','#t').'</b>,<br>';
          $stack_word .= cut_arr($data_article[$get_data[$key]['Item']]['773']['sub'],'773','Page','#g');
          $get_data[$key]['word'] = $stack_word;
        }

        $count_ = 0;
        $stack = "";
        foreach ($get_data as $key => $value) {
          $count_++;
          $stack .= "<tr>";
            $stack .= "<td class='t-cen' colspan='1' > {$count_} </td> ";
            $stack .= "<td class='t-cen' colspan='6' > {$get_data[$key]['word']} </td> ";
            $stack .= "<td class='t-cen' colspan='3' > {$get_data[$key]['Day']} </td> ";
          $stack .= "</tr>";
        }
        echo $stack;
        ?>
      </tbody>
    </table>

    </body>
    <!-- <footer>
          <br/>
          <form target="_blank" action="AllReport/export/FineperUser_Export.php" method="post">
            <input type="hidden" value='<?= json_encode($get_data) ?>' name="report_data">
            <input type="hidden" value='<?= $start_date ?>' name="start_date">
            <input type="submit" value="Export PDF.">
          </form>
        </footer> -->
  <?php
  } else {
    echo ('<h4>ไม่พบข้อมูลรายงาน</h4>');
  } ?>
</div>

</html>
<style>
  .table-report {
    background-color: black;
    color: white;
    margin: 20px;
    padding: 20px;
  }

  .t-cen {
    text-align: center;
  }

  .t-right {
    text-align: right;
  }

  .th-middle {
    vertical-align: middle;
  }
</style>