<?php

function get_col($tag,$sub){
    for ($i=0; $i < count($tag) ; $i++) { 
        if($tag[$i]=="008"){
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

            $sql[$i][0] = "Date_file,Type_date,Start_date,End_date,Location_make,Frequency,Regularity,Type_resource,Form_original,Form_item,Nature_entire_work,Nature_contents,Goverment_pub,Conference_pub,Original_alphabet,Entry_convention,Language,Modified_record,Cataloging_source";
            $sql[$i][1] = "'$date_file','$type_date','$start_date','$end_date','$location_make','$frequency','$regularity','$type_resource','$form_original','$form_item','$nature_entire_work','$nature_contents','$goverment_pub','$conference_pub','$original_alphabet','$entry_convention','$language','$modified_record','$cataloging_source'";
        }
        elseif ($tag[$i]=="010"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LibraryofCongressControlNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="013"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PatentControlInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="015"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalBibliographyNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="016"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalBibliographicAgencyControlNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="017"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CopyrightorLegalDepositNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="018"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CopyrightArticle_FeeCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="020"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "InternationalStandardBookNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="022"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "InternationalStandardSerialNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="024"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OtherStandardIdentifier";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="025"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OverseasAcquisitionNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="026"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FingerprintIdentifier";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="027"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "StandardTechnicalReportNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="028"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PublisherorDistributorNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="030"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CODENDesignation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="031"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MusicalIncipitsInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="032"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PostalRegistrationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="033"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Date_TimeandPlaceofanEvent";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="034"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CodedCartographicMathematicalData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="035"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SystemControlNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="036"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OriginalStudyNumberforComputerDataFiles";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="037"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SourceofAcquisition";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="038"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "RecordContentLicensor";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="040"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CatalogingSource";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="041"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LanguageCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="042"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AuthenticationCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="043"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GeographicAreaCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="044"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CountryofPublishing_ProducingEntityCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="045"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TimePeriodofContent";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="046"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SpecialCodedDates";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="047"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormofMusicalCompositionCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="048"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NumberofMusicalInstrumentsorVoicesCodes";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="050"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LibraryofCongressCallNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="051"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LibraryofCongressCopy_Issue_OffprintStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="052"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GeographicClassification";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="055"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ClassificationNumbersAssignedinCanada";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="060"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalLibraryofMedicineCallNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="061"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalLibraryofMedicineCopyStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="066"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CharacterSetsPresent";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="070"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalAgriculturalLibraryCallNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="071"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NationalAgriculturalLibraryCopyStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="072"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectCategoryCode";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="074"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GPOItemNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="080"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "UniversalDecimalClassificationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="082"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DeweyDecimalClassificationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="083"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AdditionalDeweyDecimalClassificationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="084"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OtherClassificationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="085"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SynthesizedClassificationNumberComponents";
            $sql[$i][1] = $res_tag;
        }elseif ($tag[$i]=="086"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GovernmentDocumentClassificationNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="088"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ReportNumber";
            $sql[$i][1] = $res_tag;
        }
        elseif (strpos(substr($tag[$i],0,2),'09') !== false){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LocalCallNumbers";
            $sql[$i][1] = $res_tag;
        }



        elseif ($tag[$i]=="100"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PersonalName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="110"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CorporateName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="111"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MeetingName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="130"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MainUniformTitle";
            $sql[$i][1] = $res_tag;
        }



        elseif ($tag[$i]=="210"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AbbreviatedTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="222"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "KeyTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="240"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "UniformTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="242"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TranslationofTitlebyCatalogingAgency";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="243"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CollectiveUniformTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="245"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TitleStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="246"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "VaryingFormofTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="247"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitle";
            $sql[$i][1] = $res_tag;
        }



        elseif ($tag[$i]=="250"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "EditionStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="251"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "VersionInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="254"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MusicalPresentationStatement";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="255"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CartographicMathematicalData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="256"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ComputerFileCharacteristics";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="257"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CountryofProducingEntity";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="258"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PhilatelicIssueData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="260"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Publication_Distribution";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="263"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ProjectedPublicationDate";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="264"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Production_PublicationandCopyrightNotice";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="270"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Address";
            $sql[$i][1] = $res_tag;
        }




        elseif ($tag[$i]=="300"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PhysicalDescription";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="306"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PlayingTime";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="307"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Hours";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="310"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CurrentPublicationFrequency";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="321"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerPublicationFrequency";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="336"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ContentType";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="337"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MediaType";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="338"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CarrierType";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="340"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PhysicalMedium";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="341"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AccessibilityContent";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="342"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GeospatialReferenceData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="343"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PlanarCoordinateData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="344"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SoundCharacteristics";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="345"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ProjectionCharacteristicsofMovingImage";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="346"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "VideoCharacteristics";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="347"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DigitalFileCharacteristics";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="348"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormatofNotatedMusic";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="351"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OrganizationandArrangementofMaterials";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="352"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DigitalGraphicRepresentation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="355"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SecurityClassificationControl";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="357"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OriginatorDisseminationControl";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="362"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DatesofPublicationandorSequentialDesignation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="363"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NormalizedDateandSequentialDesignation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="365"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TradePrice";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="366"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TradeAvailabilityInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="370"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AssociatedPlace";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="377"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AssociatedLanguage";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="380"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormofWork";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="381"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OtherDistinguishingCharacteristicsofWorkorExpression";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="382"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MediumofPerformance";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="383"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NumericDesignationofMusicalWork";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="384"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Keyss";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="385"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AudienceNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="386"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CreatorContributor";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="388"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TimePeriodofCreation";
            $sql[$i][1] = $res_tag;
        }


        


        elseif ($tag[$i]=="500"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GeneralNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="501"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "WithNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="502"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DissertationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="504"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Bibliography_Note";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="505"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormattedContentsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="506"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "RestrictionsonAccessNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="507"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ScaleNoteforGraphicMaterial";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="508"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Creation_ProductionCreditsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="510"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Citation_ReferencesNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="511"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ParticipantorPerformerNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="513"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TypeofReportandPeriodCoveredNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="514"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DataQualityNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="515"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NumberingPeculiaritiesNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="516"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TypeofComputerFileorDataNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="518"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Date_TimeandPlaceofanEventNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="520"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Summary";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="521"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TargetAudienceNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="522"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "GeographicCoverageNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="524"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PreferredCitationofDescribedMaterialsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="525"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SupplementNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="526"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "StudyProgramInformationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="530"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AdditionalPhysicalFormavailableNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="532"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AccessibilityNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="533"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ReproductionNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="534"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OriginalVersionNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="535"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LocationofOriginals_DuplicatesNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="536"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FundingInformationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="538"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SystemDetailsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="540"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TermsGoverningUseandReproductionNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="541"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ImmediateSourceofAcquisitionNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="542"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "InformationRelatingtoCopyrightStatus";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="544"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LocationofOtherArchivalMaterialsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="545"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "BiographicalorHistoricalData";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="546"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LanguageNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="547"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitleComplexityNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="550"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IssuingBodyNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="552"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "EntityandAttributeInformationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="555"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CumulativeIndex_FindingAidsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="556"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "InformationAboutDocumentationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="561"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OwnershipandCustodialHistory";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="562"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CopyandVersionIdentificationNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="563"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "BindingInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="565"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CaseFileCharacteristicsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="567"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MethodologyNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="580"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LinkingEntryComplexityNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="581"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PublicationsAboutDescribedMaterialsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="583"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ActionNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="584"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AccumulationandFrequencyofUseNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="585"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ExhibitionsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="586"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AwardsNote";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="588"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SourceofDescription";
            $sql[$i][1] = $res_tag;
        }
        elseif (strpos(substr($tag[$i],0,2),'59') !== false){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LocalNotes";
            $sql[$i][1] = $res_tag;
        }





        elseif ($tag[$i]=="600"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_PersonalName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="610"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_CorporateName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="611"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_MeetingName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="630"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_UniformTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="647"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_NamedEvent";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="648"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_ChronologicalTerm";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="650"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_TopicalTerm";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="651"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_GeographicName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="653"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IndexTerm_Uncontrolled";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="654"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_FacetedTopicalTerms";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="655"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IndexTerm_Genre_Form";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="656"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IndexTerm_Occupation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="657"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IndexTerm_Function";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="658"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IndexTerm_CurriculumObjective";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="662"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubjectAddedEntry_HierarchicalPlaceName";
            $sql[$i][1] = $res_tag;
        }
        elseif (strpos(substr($tag[$i],0,2),'69') !== false){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "LocalSubjectAccessFields";
            $sql[$i][1] = $res_tag;
        }


        

        elseif ($tag[$i]=="700"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_PersonalName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="710"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_CorporateName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="711"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_MeetingName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="720"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_UncontrolledName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="730"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_UniformTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="740"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_UncontrolledRelated_AnalyticalTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="751"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_GeographicName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="752"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_HierarchicalPlaceName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="753"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SystemDetailsAccesstoComputerFiles";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="754"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AddedEntry_TaxonomicIdentification";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="758"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ResourceIdentifier";
            $sql[$i][1] = $res_tag;
        }




        
        elseif ($tag[$i]=="760"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "MainSeriesEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="762"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SubseriesEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="765"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OriginalLanguageEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="767"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TranslationEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="770"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Supplement_SpecialIssueEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="772"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SupplementParentEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="773"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "HostItemEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="774"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ConstituentUnitEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="775"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OtherEditionEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="776"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AdditionalPhysicalFormEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="777"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "IssuedWithEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="780"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "PrecedingEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="785"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SucceedingEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="786"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DataSourceEntry";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="787"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "OtherRelationshipEntry";
            $sql[$i][1] = $res_tag;
        }





        elseif ($tag[$i]=="800"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SeriesAddedEntry_PersonalName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="810"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SeriesAddedEntry_CorporateName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="811"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SeriesAddedEntry_MeetingName";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="830"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "SeriesAddedEntry_UniformTitle";
            $sql[$i][1] = $res_tag;
        }





        elseif ($tag[$i]=="841"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "HoldingsCodedDataValues";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="842"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TextualPhysicalFormDesignator";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="843"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "NameofUnit";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="844"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TermsGoverningUseandReproduction";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="845"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "HoldingInstitution";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="850"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Location";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="852"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CaptionsandPattern_BasicBibliographicUnit";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="853"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CaptionsandPattern_SupplementaryMaterial ";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="854"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "CaptionsandPattern_Indexes";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="855"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ElectronicLocationandAccess";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="856"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "EnumerationandChronology_BasicBibliographicUnit";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="863"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "EnumerationandChronology_SupplementaryMaterial";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="864"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "EnumerationandChronology_Indexes";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="865"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TextualHoldings_BasicBibliographicUnit";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="866"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TextualHoldings_SupplementaryMaterial";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="867"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "TextualHoldings_Indexes";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="868"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ItemInformation_BasicBibliographicUnit";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="876"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ItemInformation_SupplementaryMaterial";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="877"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ItemInformation_Indexes";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="878"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "AlternateGraphicRepresentation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="880"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "ReplacementRecordInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="882"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "Machine_generatedMetadataProvenance";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="883"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "DescriptionConversionInformation";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="884"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="885"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="885"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitle";
            $sql[$i][1] = $res_tag;
        }
        elseif ($tag[$i]=="887"){
            $res_tag = str_replace("$","#",$sub[$i]);                                                      
            $sql[$i][0] = "FormerTitle";
            $sql[$i][1] = $res_tag;
        }
        
    }
}


?>