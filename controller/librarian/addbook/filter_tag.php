<?php


function filter($tag,$inc1,$inc2,$sub){
for ($i=0; $i < count($tag) ; $i++) { 
    if($tag[$i]=="008"){
        //$num_str = strlen($sub);

        $date_file           = substr($sub[$i],0,5); //วันที่เอาเข้าระเบียน
        $type_date           = substr($sub[$i],6,1); //ประเภทของปีที่พิมพ์/สถานะของสิ่งพิมพ์
        $start_date          = substr($sub[$i],7,4); //ปีที่เริ่มพิมพ์
        $end_date            = substr($sub[$i],11,4); //ปีที่สิ้นสุดการพิมพ์
        $location_make       = substr($sub[$i],15,3); //สถานที่พิมพ์/ผลิต

        $frequency           = substr($sub[$i],18,1); //ความถี่ในการจัดทำ
        $regularity          = substr($sub[$i],19,1); //ความสำเสมอของกำหนดออก
        //20 undefind (ยังไม่ได้กำหนด)
        $type_resource       = substr($sub[$i],21,1); //ประเภทของทรัพยากรต่อเนื่อง
        $form_original       = substr($sub[$i],22,1); //รูปแบบของวัสดุดั้งเดิม
        $form_item           = substr($sub[$i],23,1); //รูปแบบของวัสดุ
        $nature_entire_work  = substr($sub[$i],24,1); //ลักษณะเนื้อหาโดยรวม
        $nature_contents     = substr($sub[$i],25,3); //ลักษณะของเนื้อหา
        $goverment_pub       = substr($sub[$i],28,1); //สิ่งพิมพ์รัฐบาล
        $conference_pub      = substr($sub[$i],29,1); //สิ่งพิมพ์จากการประชุม
        //30-32
        $original_alphabet   = substr($sub[$i],33,1); //ตัวอักษรดั้งเดิมของชื่อเรื่อง

        $entry_convention    = substr($sub[$i],34,1); //การลงรายการหลัก
        $language            = substr($sub[$i],35,3); //ภาษา
        $modified_record     = substr($sub[$i],38,1); //ระเบียบที่มีการแก้ไข
        $cataloging_source   = substr($sub[$i],39,1); //แหล่งที่มาของข้อมูลทางบรรณานุกรม

        // print_r("<br>"."วันที่เอาเข้าระเบียน = ".$date_file);
        // print_r("<br>"."ประเภทของปีที่พิมพ์/สถานะของสิ่งพิมพ์ = ".$type_date);
        // print_r("<br>"."ปีที่เริ่มพิมพ์ = ".$start_date);
        // print_r("<br>"."ปีที่สิ้นสุดการพิมพ์ = ".$end_date);
        // print_r("<br>"."ความถี่ในการจัดทำ = ".$frequency);
        // print_r("<br>"."ความสำเสมอของกำหนดออก = ".$regularity);
        // print_r("<br>"."ประเภทของทรัพยากรต่อเนื่อง = ".$type_resource);
        // print_r("<br>"."รูปแบบของวัสดุดั้งเดิม = ".$form_original);
        // print_r("<br>"."รูปแบบของวัสดุ = ".$form_item);
        // print_r("<br>"."ลักษณะเนื้อหาโดยรวม = ".$nature_entire_work);
        // print_r("<br>"."ลักษณะของเนื้อหา = ".$nature_contents);
        // print_r("<br>"."สิ่งรพิมพ์รัฐบาล = ".$goverment_pub);
        // print_r("<br>"."สิ่งพิมพ์จากการประชุม = ".$conference_pub);
        // print_r("<br>"."ตัวอักษรดั้งเดิมของชื่อเรื่อง = ".$original_alphabet);
        // print_r("<br>"."การลงรายการหลัก = ".$entry_convention);
        // print_r("<br>"."ภาษา = ".$language);
        // print_r("<br>"."ระเบียบที่มีการแก้ไข = ".$modified_record);
        // print_r("<br>"."แหล่งที่มาของข้อมูลทางบรรณานุกรม = ".$cataloging_source);

        $sql[$i][0] = "Date_file,Type_date,Start_date,End_date,Location_make,Frequency,Regularity,Type_resource,Form_original,Form_item,Nature_entire_work,Nature_contents,Goverment_pub,Conference_pub,Original_alphabet,Entry_convention,Language,Modified_record,Cataloging_source";
        $sql[$i][1] = "'$date_file','$type_date','$start_date','$end_date','$location_make','$frequency','$regularity','$type_resource','$form_original','$form_item','$nature_entire_work','$nature_contents','$goverment_pub','$conference_pub','$original_alphabet','$entry_convention','$language','$modified_record','$cataloging_source'";
    }
    elseif ($tag[$i]=="010"){
        $res_tag[$i] = preg_split("/(#a|#b|#z|#8)/",str_replace("$","#",$sub[$i]));  //Library of Congress Control Number
                                                            
                                                            // $a - LC control number (NR) 
                                                            // $b - NUCMC control number (R) 
                                                            // $z - Canceled/invalid LC control number (R) 
                                                            // $8 - Field link and sequence number (R) 
        $sql[$i][0] = "LibraryofCongressControlNumber";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }
    elseif ($tag[$i]=="013"){
        $res_tag[$i] = preg_split("/(#a|#b|#c|#d|#e|#f|#6|#8)/",str_replace("$","#",$sub[$i]));  //Patent Control Information
                                                                
                                                                // $a - Number (NR) 
                                                                // $b - Country (NR) 
                                                                // $c - Type of number (NR) 
                                                                // $d - Date (R) 
                                                                // $e - Status (R) 
                                                                // $f - Party to document (R) 
                                                                // $6 - Linkage (NR) 
                                                                // $8 - Field link and sequence number (R)  
        $sql[$i][0] = "PatentControlInformation";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }
    elseif ($tag[$i]=="015"){
        $res_tag[$i] = preg_split("/(#a|#q|#z|#2|#6|#8)/",str_replace("$","#",$sub[$i]));  //Patent Control Information
        // $a - National bibliography number (R)
        // $q - Qualifying information (R)
        // $z - Canceled/invalid national bibliography number (R)
        // $2 - Source (NR)
        // $6 - Linkage (NR)
        // $8 - Field link and sequence number (R)
        $sql[$i][0] = "NationalBibliographyNumber";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }
    elseif ($tag[$i]=="016"){
        $res_tag[$i] = preg_split("/(#a|#z|#2|#8)/",str_replace("$","#",$sub[$i]));  //Patent Control Information
        // $a - Record control number (NR) 
        // $z - Canceled/invalid control number (R) 
        // $2 - Source (NR) 
        // $8 - Field link and sequence number (R) 
        $sql[$i][0] = "NationalBibliographicAgencyControlNumber";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }
    elseif ($tag[$i]=="017"){
        $res_tag[$i] = preg_split("/(#a|#b|#d|#i|#2|#|#6|#8)/",str_replace("$","#",$sub[$i]));  //Patent Control Information
        // $a - Copyright or legal deposit number (R)
        // $b - Assigning agency (NR)
        // $d - Date (NR)
        // $i - Display text (NR)	$z - Canceled/invalid copyright or legal deposit number (R)
        // $2 - Source (NR)
        // $6 - Linkage (NR)
        // $8 - Field link and sequence number (R)
        $sql[$i][0] = "CopyrightorLegalDepositNumber";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }
    elseif ($tag[$i]=="020"){
        $res_tag[$i] = "ISBN";
        $sql[$i][0] = "InternationalStandardBookNumber";
        $sql[$i][1] = "{$res_tag[$i][0]}";
    }

    elseif ($tag[$i] == "022"){

        if ($inc1[$i] == "0") {
            $res_inc1 = "ISSN_FULL"; //วารสารที่ลงทะเบียนสมบูรณ์ไว้กับเครือข่าย ISSN
        }
        elseif ($inc1[$i] == "1") {
            $res_inc1 = "ISSN_MINI"; //วารสารไม่ใช่ระดับสากล ทะเบียนแบบย่อไว้กับเครือข่าย ISSN
        }
        elseif ($inc1[$i] == NULL||$inc1[$i]==" ") {
            $res_inc1 = "undefined";
        }

        $res_tag = preg_split("/(#a|#y|#z)/",$sub[$i]);
        // #a -> เลขมาตรฐานสากลต่อเนื่อง
        // #y -> เลขมาตรฐานสากลต่อเนื่องไม่ถูกต้อง
        // #z -> เลขมาตรฐานสากลต่อเนื่องที่ยกเลิก

    }

    elseif ($tag[$i] == "041") {
        if ($inc1[$i] == "0") {
            $res_inc = "not_tran"; //บทความที่ไม่ได้เป็นงานแปล/ไม่รวมบทแปล
        }
        elseif ($inc1[$i] == "1") {
            $res_inc="tran"; //บทความที่เป็นงานแปล/รวมบทแปล
        }

        $res_tag = preg_split("/(#a|#b|#h)/",$sub[$i]);
        // #a -> รหัสภาษาบทความ
        // #b -> รหัสภาษาของบทคัดย่อ
        // #h -> รหัสภาษาของบทความเดิม

        // echo '<pre>';
        // print_r($res_tag);
    }
    elseif ($tag[$i] == "082") {
        $res_tag = "DDC)";//Dewey Decimal Call Number
    }
    elseif ($tag[$i] == "100") {
        if($inc1 == "0"){
            $res_inc1 = "forename"; //forename
        }
        elseif($inc1 == "1"){
            $res_inc1 = "surename"; //single surename 
        }
        $res_tag = preg_split("/(#a|#c|#d|#e|#q|#u)/",$sub[$i]); // Main Entry - Personal Name
        // #a -> รหัสภาษาบทความ
        // #c -> ตำแหน่งและคำอื่นๆที่เกี่ยวข้องกับบุคคล
        // #d -> ปีที่เกี่ยวข้องกับชื่อบุคคล
        // #e -> คำที่บอกความสัมพันธ์ระหว่างบุคคล
        // #q -> ชื่อเต็มของบุคคล
        // #u -> หน่วยงานที่สังกัด

        echo '<pre>';
        print_r($res_tag);
    }
    elseif ($tag[$i] == "110") {
            if ($inc1 == "0") {
                $res_inc1 = "inverted name";//ชื่อนิติบุคคลที่ลงรายการแบบกลับคำ
            }
            elseif ($inc1 == "1") {
                $res_inc1 = "jurisdiction";//ชื่อนิติบุคคลที่ลงรายการภายใต้ชื่อประเทศ
            }
            elseif ($inc1 == "2") {
                $res_inc1 = "name_in_direct_order";//ชื่อนิติบุคคลที่ลงรายการโดยตรง
            }
        $res_tag = preg_split("/(#a|#b|#n|#d|#c|#p)/",$sub[$i]); //Main Entry - Corporate Name

    }
    elseif ($tag[$i]=="111") {
            if ($inc1=="2") {
                $res_inc1 = "Meeting-Name";//ชื่อประชุมที่ลงรายการโดยตรง
            }
            $res_tag = preg_split("/(#a|#e|#n|#d|#c)/",$sub[$i]); //Main Entry - Meeting Name
            
    }
    elseif ($tag[$i]=="245") {
            if ($inc1[$i]=="1") {
                if ($inc1[$i]=="0") {
                    $res_inc1[$i]="no_title_add";//Title and Statement of Responsibility
                }
                elseif ($inc1=="1") {
                    $res_inc1[$i]="title_add_entry";//Title and Statement of Responsibility
                }
            }
            // #a - Title (NR) 
            // #b - Remainder of title (NR) 
            // #c - Statement of responsibility, etc. (NR) 
            // #f - Inclusive dates (NR) 
            // #g - Bulk dates (NR) 
            // #h - Medium (NR)	
            // #k - Form (R) 
            // #n - Number of part/section of a work (R) 
            // #p - Name of part/section of a work (R) 
            // #s - Version (NR) 
            // #6 - Linkage (NR) 
            // #8 - Field link and sequence number (R)
            $res_tag[$i] = preg_split('/(#a|#b|#c|#f|#g|#h|#k|#n|#p|#s|#6|#8)/',str_replace("$","#",$sub[$i])); //Title and Statement of Responsibility
            $sql[$i][0] = "TitleStatement";
            $sql[$i][1] = "{$res_tag[$i][0]}";
            echo "<pre>";
            print_r($res_tag[$i]);

    }
    elseif ($tag[$i]=="246") {
       
        if ($inc1=="0") {
            $res_inc1 = "note/no_title";
        }
        elseif ($inc1=="1") {
            $res_inc1 = "note/title";
        }
        elseif ($inc1=="2") {
            $res_inc1 = "no_note/no_title";
        }
        elseif ($inc1=="3") {
            $res_inc1 = "no_note/title";           
        }   
        if ($inc2=="0") {
            $res_inc2 = "portion of title";
        }
        elseif($inc2=="1"){
            $res_inc2 = "parallel title";

        }
        elseif($inc2=="2"){
            $res_inc2 = "distinctive title";
        }
        elseif($inc2=="3"){
            $res_inc2 = "other title";
        }
        elseif($inc2=="4"){
            $res_inc2 = "cover title";
        }
        elseif($inc2=="5"){
            $res_inc2 = "added title page tiltle";
        }
        elseif($inc2=="6"){
            $res_inc2 = "caption title";
        }
        elseif($inc2=="7"){
            $res_inc2 = "running title";
        }
        elseif($inc2=="8"){
            $res_inc2 = "spine title";
        }
        $res_tag = preg_split("/(#i|#a|#b|#n|#p)/",$sub[$i]); //varying form of title
    }
    elseif ($tag[$i]=="250") {
        $res_tag = "Edition-Statement";//การแจ้งฉบับพิมพ์ (Edition Statement)
    }
    elseif ($tag[$i]=="260") {
        $res_tag = "Publication";//พิมพ์ลักษณ์ (Publication, Distribution, Etc.)
    }
    elseif ($tag[$i]=="300") {
        $res_tag = "Physical-Description";//บรรณลักษณ์ (Physical Description)
    }
    elseif ($tag[$i]=="490") {
        $res_tag = "Series";//ชื่อชุด (Series Statement)
    }
    elseif ($tag[$i]=="500") {
        $res_tag = "Note";//หมายเหตุ (Note)
    }
    elseif ($tag[$i]=="505") {
        $res_tag = "Contents-Note";//หมายเหตุสารบัญ (Formatted Contents Note)
    }
    elseif ($tag[$i]=="508") {
        $res_tag = "Subjects_related_to_resources";//คณะ/สาขาวิชาที่เกี่ยวข้องกับทรัพยากรสารสนเทศ
    }
    elseif ($tag[$i]=="600") {
        $res_tag = "Subject_Added_Entry_PName";//รายการเพิ่มหัวเรื่อง – ชื่อบุคคล (Subject Added Entry - personal Name)
        if ($inc1=="0") {
            if ($inc2=="4") {
                $res_tag .= "/th";//ชื่อเรื่องแตกต่างภาษาไทย
            }
        }
        elseif ($inc1=="1") {
            if ($inc2=="4") {
                $res_tag .= "/en";//ชื่อเรื่องแตกต่างภาษาอังกฤษ
            }
        }
    }
    elseif ($tag[$i]=="610") {
        if ($inc1=="2") {
            if ($inc2=="4") {
            $res_tag="List_of_topics_added-Corporate_name";//รายการเพิ่มหัวเรื่อง – ชื่อนิติบุคคล
            }
        }
    }
    elseif ($tag[$i]=="611") {
        if ($inc1=="2") {
            if ($inc2=="4") {
            $res_tag="List_of_topics_added-Meeting_name";//รายการเพิ่มหัวเรื่อง – ชื่อการประชุม
            }
        }
    }
    elseif ($tag[$i]=="650") {
            if ($inc2=="4") {
            $res_tag="Topical_Term";//รายการเพิ่มหัวเรื่อง - หัวเรื่องทั่วไป (Subject Added Entry - Topical Term)
            }
    }
    elseif ($tag[$i]=="651") {
        if ($inc2=="4") {
        $res_tag="Subject_Geographic_Name";//รายการเพิ่มหัวเรื่อง - ชื่อทางภูมิศาสตร์ (Subject Geographic Name)
        }
    }
    elseif ($tag[$i]=="700") {
        if ($inc1=="0") {
            $res_tag="Added_Entry_PName";//รายการเพิ่ม - ชื่อบุคคล (Added Entry - Personal Name)
        }
    }
    elseif ($tag[$i]=="710") {
        if ($inc1=="2") {
            $res_tag="Added_Entry_CName";//รายการเพิ่ม - ชื่อนิติบุคคล (Added Entry - Corporate Name)
        }
    }
    elseif ($tag[$i]=="850") {
            $res_tag="Storage_location";//สถานที่จัดเก็บ
    }
}
return $sql;
}
?>