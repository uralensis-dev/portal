<!DOCTYPE html>
<html>
<head>
    <title>External Pathology Opinion. Hopi stay and lab number</title>
</head>
<body>
<div>Dear Dr <?php echo $rec_name;?> <br />
</div>
<div>
    <p>I would appreciate your opinion on this following case <br />
    </p>
    <p>
        <strong>Lab number:</strong> <?php echo $request_lab_no;?> <br />
        <strong>Patient initials:</strong> <?php echo $request_patient_initials;?> <br />
        <strong>Age:</strong> <?php echo $request_age;?> <br />
        <strong>DOB:</strong> <?php echo $request_dob;?> <br />
    </p>
    <?php $counter =1;foreach ($slides_data as $slide){
        $get_clinical_history = $this->Doctor_model->select_where("*","specimen",array("specimen_id"=>$slide['specimen_id']))->row();
        $clinical_history = $get_clinical_history->specimen_clinical_history;
        ?>
        <p><strong>Specimen</strong> - <?php echo "Specimen ".$counter++;?><br />
            <strong>Clinical history:</strong>
            <br />
            <?php echo $clinical_history;?>
        </p>
        <p><strong>Link to case</strong> <br />
        </p>
        <ol>
            <?php foreach ($slide['slides'] as $index=>$data) {  ?>
                <li><a href="<?php echo $data?>" target="_blank"><?php echo $data?></a><br /></li>
            <?php } ?>
        </ol>
    <?php }?>
    <p>
        <strong>Comment on case:</strong> <br />

        <?php echo $opinion_comment;?><br />
    </p>
</div>
<div>
    <p>If you could let me know if you can provide an opinion and a rough estimate of when I would hope to get this back. <br />
    </p>
    <p>Yours sincerely</p>
</div>


</body>
</html>


