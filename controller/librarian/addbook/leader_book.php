<?php

function leader($leader){
    $logical_record_lengthsubstr = substr($leader,0,5);//ความยาวระเบียนในเชิงตรรกะ (Logical record length)
    $record_status = substr($leader,5,1);//สถานะของรายการ (Record status)
                                            // n = new ระเบียนใหม่
    $type_of_record = substr($leader,6,1);//สถานะของรายการ (Record status)
                                            // a = language ระเบียนบรรณานุกรมที่เป็นวัสดุ/สิ่งพิมพ์ที่เป็นภาษา
                                            // g = project medium ระเบียนของสื่อที่แสดงโดยการฉาย
                                            // i = nonmusical sound record เป็นระเบียนวัสดุที่เป็นแถบ	บันทึกเสียงที่ไม่ใช่เสียงดนตรี
                                            // j = musical sound record เป็นระเบียนที่ใช้สำหรับแถบ	บันทึกเสียงดนตรี
                                            // m = computer file เป็นระเบียนข้อมูล/สื่อที่ต้องใช้คอมพิวเตอร์	ในการประมวลผล
    $bibliographic_level = substr($leader,7,1);//ระดับของบรรณานุกรม (Bibliographic level)
                                            // m = monograph บรรณานุกรมของหนังสือหรือสิ่งพิมพ์
    $bibliographic_level = substr($leader,8,1);//ประเภทของการควบคุมระเบียน (Type of control)
    $character_coding_scheme = substr($leader,9,1);//ประเภทของรหัส (Character coding scheme)
    $indicator_count = substr($leader,10,1);//จำนวนตัวบ่งชี้ในแต่ละเขตข้อมูล (Indicator count) จะเป็นอักขระ 2 เสมอ
    $subfield_code_count = substr($leader,11,1);//ความยาวของรหัสในเขตข้อมูลย่อย (Subfield code count) จะเป็นอักขระ 2 เสมอ
    $base_address_of_data = substr($leader,12,5);//ตำแหน่งเริ่มของระเบียน (Base address of data)
    $encoding_level = substr($leader,17,1);//ระดับการทำรายการ (Encoding level)
    $descriptive_cataloging_form = substr($leader,18,1);//รูปแบบการทำรายการ (Descriptive cataloging form)
    $linked_record_requirement = substr($leader,19,1);//การเชื่อมโยงระเบียน (Linked record requirement)
    $len_field = substr($leader,20,1);//แผนที่ตารางระบุตำแหน่ง มักจะมีค่าเป็น 4
    $len_start = substr($leader,21,1);//แผนที่ตารางระบุตำแหน่ง มักจะมีค่าเป็น 5
    $len_impl = substr($leader,22,1);//แผนที่ตารางระบุตำแหน่ง มักจะมีค่าเป็น 0
    $undefind = substr($leader,23,1);//แผนที่ตารางระบุตำแหน่ง มักจะมีค่าเป็น 0
}



?>