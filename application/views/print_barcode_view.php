<link href="https://fonts.cdnfonts.com/css/verdana" rel="stylesheet">
<?php
if (!empty($records)) { ?>
    <style>
        .main {
            text-align: left;
           
            width: 155px !important;
            overflow: hidden !important;
        }

        table {
            font-family: 'Verdana';
            font-weight: Bold;
            font-size: 10px !important;
        }

        td {
            line-height: 13px;
        }

        .barcode_wrap {
            /* border: 1px solid #777; */
            padding: 2px;
            border-radius: 5px;
        }

        #barcode_img {
            max-width: 55px !important;
        }

        .qrlogo {
            max-width: 50px !important;
            max-height: 50px !important;
            object-fit: cover;
            /* mix-blend-mode: multiply; */
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: space-around;
        }
    </style>

    <?php
    $specimenIndex = 0;
    foreach ($records as $key => $row) {
        $patientName = explode(" ", $row['patient_name']);
        $patientInfo = '';
        foreach($patientName as $pkey => $pname){
            if($pkey == 0){
                $patientInfo .= substr($pname, 0, 1).".";
            }else{
                if($pkey == 1){
                    $patientInfo .= $pname;
                }else{
                    $patientInfo .= " ".$pname;
                }
                
            }
        }
        $patientInfo = rtrim($patientInfo);
        $img = base_url().'/barcodes/' . $row['barcode_image'];
        if ($barcode_image) {
            $img = $barcode_image;
        }
        if (trim($row['testName']) == '')
            $row['testName'] = "H&E";
        if ($row['testName'] != '') {
            $tests = explode(",",  $row['testName']);
            foreach ($tests as $key => $test) {
                $block_name = '';
                // if($action_type != ""){
                $testInfo = explode("_", $test);
                $sp_data = explode(",", $row['sp_id']);
                $specimenIndex = array_search($testInfo[1], $sp_data);
                $specimenIndex = $specimenIndex + 1;
                $test = $testInfo[0];
                $block_name = $testInfo[2];
                // }
                //if ($test != '') {
    ?>
                <div class='main' style="padding-right:12px; padding-top:2px">
                    <center class='center_class'>
                        <div class="barcode_wrap">
                            <center>
                                
                                <table>
                                    <tbody>
                                         <tr>
                                                <td class="text-center">
                                                   <div class="d-flex">
                                    <img src="<?=$img; ?>" id="barcode_img" class="imgWrap" alt="Barcode">
                                    <img src="<?php echo base_url()."assets/img/qrLogo.png";?>" class="qrlogo" alt="Barcode">
                                </div>
                                                </td>
                                            </tr> 
                                        <?php if($barcodeType != 'sp_pot'){ ?>
                                        <tr>
                                            <td class="text-center">
                                                <center><?php echo $row['lab_number']."-".$row['testBlockName']; ?></center>
                                            </td>
                                        </tr>
                                        <?php }else { ?> 
                                            <tr>
                                            <td class="text-center">
                                                <center><?php echo $row['lab_number']; ?></center>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <?php if($barcodeType != 'request' && $barcodeType != 'sp_pot'){ ?>
                                            <?php //if($barcodeType != "barcode"){ ?>
                                            <tr>
                                                <td class="text-center">
                                                    <center><?= $patientInfo; ?></center>
                                                </td>
                                            </tr>
                                            <?php //} ?>
                                            <?php if($barcodeType == 'barcode'){ ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <center><?= ($test != '') ? $test : "H&E"; ?></center>
                                                    </td>
                                                </tr>
                                            <?php } else {
                                                if($row['pathologist'] != ''){?>
                                                <tr>
                                                    <td class="text-center">
                                                        <center><?= $row['pathologist']; ?></center>
                                                    </td>
                                                </tr>
                                            <?php 
                                            } } ?>
                                        <?php } ?>
                                        
                                        <?php if ($a_type != 'request') { ?>
                                            <tr style="display:none">
                                                <td class="text-center">
                                                    <center><?= ($test != '') ? $test . " " . $row['testBlockName'] : "H&E" . " " . $row['testBlockName']; ?></center>
                                                </td>
                                            </tr>
                                            <?php if ($action_type != "" && $action_type == 'sp_pot') { ?>
                                                <tr style="display:none">
                                                    <td class="text-center">
                                                        <center>Specimen <?= $specimenIndex ?></center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </center>
                        </div>
                    </center>
                </div>
               
            <?php
                //} 
            } ?>
        <?php } else { ?>
            <div class='main' style="">
                <center class='center_class'>
                    <div class="barcode_wrap">
                        <center><img src="<?= $img; ?>" id="barcode_img" alt="Barcode">
                        <table>
                                    <tbody>
                                        <!-- <tr>
                                                <td class="text-center">
                                                    <center><?= $row['digi_number']; ?></center>
                                                </td>
                                            </tr> -->
                                        <tr>
                                            <td class="text-center">
                                                <center><?php echo $row['lab_number']."-".$block_name; ?></center>
                                            </td>
                                        </tr>
                                        <?php if($barcodeType != 'request'){ ?>
                                            <?php if($barcodeType != "barcode"){ ?>){ ?>
                                            <tr>
                                                <td class="text-center">
                                                    <center><?= $patientInfo; ?></center>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if($barcodeType == 'barcode'){ ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <center><?= ($test != '') ? $test : "H&E"; ?></center>
                                                    </td>
                                                </tr>
                                            <?php } else {
                                                if($row['pathologist'] != ''){?>
                                                <tr>
                                                    <td class="text-center">
                                                        <center><?= $row['pathologist']; ?></center>
                                                    </td>
                                                </tr>
                                            <?php 
                                            } } ?>
                                        <?php } ?>
                                        
                                        <?php if ($a_type != 'request') { ?>
                                            <tr style="display:none">
                                                <td class="text-center">
                                                    <center><?= ($test != '') ? $test . " " . $block_name : "H&E" . " " . $block_name; ?></center>
                                                </td>
                                            </tr>
                                            <?php if ($action_type != "" && $action_type == 'sp_pot') { ?>
                                                <tr style="display:none">
                                                    <td class="text-center">
                                                        <center>Specimen <?= $specimenIndex ?></center>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </center>
                    </div>
                </center>
            </div>
           
        <?php } ?>


<?php
    }
}
?>