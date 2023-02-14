	<!-- Footer Template -->
    <footer>

<div class="container">

    <div class="row">

        <div class="col-12">

            <p class="text-center">
                Uralensins inov8 2020 All Rights Reserved
            </p>
        </div>
    </div>

</div>

</footer>

<script src="<?php echo base_url() ?>/assets/js/jquery-3.2.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?php echo base_url() ?>/assets/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="<?php echo base_url() ?>/assets/js/jquery.slimscroll.min.js"></script>

<!-- Chart JS -->



<script src="<?php echo base_url() ?>/assets/js/jquery.smartWizard.js"></script>

<script src="<?php echo base_url() ?>/assets/js/jquery.date-dropdowns.js"></script>


<!-- Datetimepicker JS -->
<script src="<?php echo base_url() ?>/assets/js/moment.min.js"></script>
<script src="<?php echo base_url() ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/filepond.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/filepond-plugin-file-validate-type.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/filepond.jquery.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Custom JS -->
<script src="<?php echo base_url() ?>/assets/js/app.js"></script>

<?php
if(!empty($javascripts)){
    foreach ($javascripts as $value) {
        ?>
        <script src="<?php echo base_url();?>assets/<?php echo $value;?>"></script>
        <?php
    }
}
?>


<script>
$(document).ready(function() {
    tinymce.init({
        menubar: false,
        selector: '.tg-tinymceeditor',

        toolbar: 'undo redo ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
        font_formats: "CircularStd=CircularStd;",
        content_style: "@import url('https://db.onlinewebfonts.com/c/860c3ec7bbc5da3e97233ccecafe512e?family=CircularStd'); body { font-family: CircularStd !important; }"
    });
    tinymce.init({
        selector: '.tinyTextarea',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });


    // TODO: Load all the patient and physician data and make them available for search

    FilePond.registerPlugin(FilePondPluginFileValidateType);
   

    FilePond.setOptions({
        server: '<?php echo base_url(); ?>/upload-file'
    });




    // Multiple Specimens upload
    var currentSpecimen = 0;
   var lastId = 0;
    var specimens = [];
    var firstSpecimen = fetchCaseData();

    $("#upload-inputs").hide();
    firstSpecimen.form = createUploadForm();
   firstSpecimen.id = currentSpecimen;
    $("#upload-container").append(firstSpecimen.form);
    specimens.push(firstSpecimen);
   $("#btn-specimen-0").css("background-color", "#07a8e6");
   $("#btn-specimen-0").val(lastId);
    $("#btn-specimen-0").click(function(event) {
        var spec = fetchCaseData();
        if (validForm(spec)) {
            var s = fetchSpecimenId(currentSpecimen);
            s.clinicalDate = spec.clinicalDate;
            s.rcpath = spec.rcpath;
            s.status = spec.status;
            s.sType = spec.sType;
            s.mskccReceived = spec.mskccReceived;
            s.description = spec.description;
            s.macroDescription = spec.macroDescription;
            s.noSlides = spec.noSlides;
            s.noBlocks = spec.noBlocks;
            s.blockDetail = spec.blockDetail;
            resetForm();


            resetButton();
            $(this).css("background-color", "#07a8e6");
           var id = $(this).val();
            setForm(fetchSpecimenId(id));

            fetchSpecimenId(currentSpecimen).form.hide();
            fetchSpecimenId(id).form.show();
            currentSpecimen = id;
        } else {
            // Show error messages
            return;
        }
    });

    $("#add-specimen").click(function(event) {
        var specimen = fetchCaseData();
        if (validForm(specimen)) {
            lastId++;
           var l = lastId;
            var s = fetchSpecimenId(currentSpecimen);
            s.clinicalDate = specimen.clinicalDate;
            s.rcpath = specimen.rcpath;
            s.status = specimen.status;
            s.sType = specimen.sType;
            s.mskccReceived = specimen.mskccReceived;
            s.description = specimen.description;
            s.macroDescription = specimen.macroDescription;
            s.noSlides = specimen.noSlides;
            s.noBlocks = specimen.noBlocks;
            s.blockDetail = specimen.blockDetail;
            resetForm();
            resetButton();

            var newSpecimen = {id: l};
            newSpecimen.form = createUploadForm();

            newSpecimen.form.show();
            $("#upload-container").append(newSpecimen.form);
            s.form.hide();
            specimens.push(newSpecimen);

            currentSpecimen = l;
            var newButton = $("#btn-specimen-0").clone();
            newButton.attr('id', 'btn-specimen-' + l);
            newButton.html("Specimen " + (l + 1));
           newButton.val(l);
           newButton.css("background-color", "#07a8e6");
            $("#specimens-tab").append(newButton);
            newButton.click(function(event) {
                var specimen = fetchCaseData();
                if (validForm(specimen)) {
                    var s = fetchSpecimenId(currentSpecimen);
                    s.clinicalDate = specimen.clinicalDate;
                    s.rcpath = specimen.rcpath;
                    s.status = specimen.status;
                    s.sType = specimen.sType;
                    s.mskccReceived = specimen.mskccReceived;
                    s.description = specimen.description;
                    s.macroDescription = specimen.macroDescription;
                    s.noSlides = specimen.noSlides;
                    s.noBlocks = specimen.noBlocks;
                    s.blockDetail = specimen.blockDetail;
                    resetForm();
                    resetButton();
                   var id = $(this).val();
                    $(this).css("background-color", "#07a8e6");
                    setForm(fetchSpecimenId(id));

                    fetchSpecimenId(currentSpecimen).form.hide();
                    fetchSpecimenId(id).form.show();
                    currentSpecimen = id;
                }
            });
        } else {
            return;
        }
    });


   $("#delete-specimen").click(function() {
       if (specimens.length == 1) {
           return;
       }
       var newIndex;
       for (let index = 0; index < specimens.length; index++) {
           const element = specimens[index];
           if (element.id == currentSpecimen) {
               continue;
           }else{
               newIndex = element.id;
               break;
           }
       }
       var toBeDeleted = currentSpecimen;
       // Delete the upload form
       var form = fetchSpecimenId(toBeDeleted).form;
       FilePond.destroy(form.find("#slides-"+toBeDeleted).get(0));
       FilePond.destroy(form.find("#documents-"+toBeDeleted).get(0));
       FilePond.destroy(form.find("#media-"+toBeDeleted).get(0));
       form.remove();
       $("#btn-specimen-"+newIndex).trigger('click');
       deleteSpecimenId(toBeDeleted);
       currentSpecimen = newIndex;
       $("#btn-specimen-"+toBeDeleted).remove();
   });

    function resetButton() {
        $("#specimens-tab").children('button').css('background-color', '#1B74CD');
    }

    function createUploadForm() {
        var l = lastId;
        var newForm = $("#upload-inputs").clone();
        newForm.show();
        newForm.attr('id', 'upload-inputs-' + l);
        var slides = newForm.find("#slides").attr('id', 'slides-' + l);
        var documents = newForm.find("#documents").attr('id', 'documents-' + l);
        var media = newForm.find("#media").attr('id', 'media-' + l);


        FilePond.create(slides.get(0));

        // Set allowMultiple property to true
        slides.filepond('allowMultiple', true);

        FilePond.create(documents.get(0), {
            acceptedFileTypes: ['application/pdf']
        });
        // Set allowMultiple property to true
        documents.filepond('allowMultiple', true);

        FilePond.create(media.get(0), {
            acceptedFileTypes: ['image/*', 'video/*']
        });

        // Set allowMultiple property to true
        media.filepond('allowMultiple', true);

        return newForm;
    }

    function fetchCaseData() {
        var specimen = {};
        specimen.clinicalDate = $("#inputClinicalDate").val();
        specimen.rcpath = $("#inputRCPath").val();
        specimen.status = $("#inputStatus").val();
        specimen.sType = $("#inputSpecimenType").val();
        specimen.mskccReceived = $("#inputMSKCCReceived").val();
        specimen.description = tinymce.get("inputDescription").getContent();
        specimen.macroDescription = $("#inputMacroDescription").val();
        specimen.noSlides = $("#inputNoSlides").val();
        specimen.noBlocks = $("#inputNoBlocks").val();
        specimen.blockDetail = $("#inputBlockDetail").val();
        return specimen;
    }

    function setForm(specimen) {
        $("#inputClinicalDate").val(specimen.clinicalDate);
        $("#inputRCPath").val(specimen.rcpath);
        $("#inputStatus").val(specimen.status);
        $("#inputSpecimenType").val(specimen.sType);
        $("#inputMSKCCReceived").val(specimen.mskccReceived);
        tinymce.get("inputDescription").setContent(specimen.description);
        $("#inputMacroDescription").val(specimen.macroDescription);
        $("#inputNoSlides").val(specimen.noSlides);
        $("#inputNoBlocks").val(specimen.noBlocks);
        $("#inputBlockDetail").val(specimen.blockDetail);
    }

    function validForm(specimen) {
        var valid = true;
        if (specimen.clinicalDate == null || specimen.clinicalDate.length == 0) {
            valid = false;
            $("#inputClinicalDate").addClass("is-invalid");
        }
        if (specimen.rcpath == null || specimen.rcpath.length == 0) {
            valid = false;
            $("#inputRCPath").addClass("is-invalid");
        }
        if (specimen.status == null || specimen.status.length == 0) {
            valid = false;
            $("#inputStatus").addClass("is-invalid");
        }
        if (specimen.sType == null || specimen.sType.length == 0) {
            valid = false;
            $("#inputSpecimenType").addClass("is-invalid");
        }
        if (specimen.mskccReceived == null || specimen.mskccReceived.length == 0) {
            valid = false;
            $("#inputMSKCCReceived").addClass("is-invalid");
        }
        if (specimen.noSlides == null || specimen.noSlides.length == 0) {
            valid = false;
            $("#inputNoSlides").addClass("is-invalid");
        }
        if (specimen.noBlocks == null || specimen.noBlocks.length == 0) {
            valid = false;
            $("#inputNoBlocks").addClass("is-invalid");
        }

        if (specimen.blockDetail == null || specimen.blockDetail.length == 0) {
            valid = false;
            $("#inputBlockDetail").addClass("is-invalid");
        }
        return valid;
    }

    function resetForm() {
        $("#inputClinicalDate").removeClass("is-invalid");
        $("#inputRCPath").removeClass("is-invalid");
        $("#inputStatus").removeClass("is-invalid");
        $("#inputSpecimenType").removeClass("is-invalid");
        $("#inputMSKCCReceived").removeClass("is-invalid");
        $("#inputNoSlides").removeClass("is-invalid");
        $("#inputNoBlocks").removeClass("is-invalid");
        $("#inputBlockDetail").removeClass("is-invalid");

        $("#inputClinicalDate").val("");
        $("#inputRCPath").val("");
        $("#inputStatus").val("");
        $("#inputSpecimenType").val("");
        $("#inputMSKCCReceived").val("");
        tinymce.get("inputDescription").setContent("");
        $("#inputMacroDescription").val("");
        $("#inputNoSlides").val("");
        $("#inputNoBlocks").val("");
        $("#inputBlockDetail").val("");
    }

   function fetchSpecimenId(id) {
       for (let index = 0; index < specimens.length; index++) {
           const element = specimens[index];
           if (element.id == id) {
               return element;
           }
       }
   }

   function deleteSpecimenId(id) {
       for (let index = 0; index < specimens.length; index++) {
           const element = specimens[index];
           if (element.id == id) {
               specimens.splice(index, 1);
               return;
           }
       }
   }

   $("#submitForm").click(function() {
       // TODO: Wait for all the files to be uploaded first before submitting
       
       // Fetch all the data and submit using ajax
       var data = {};
       // Fetch patient data
       var patient = {};
       patient.sysNo = $("#inputSysNo").val();
       patient.firstName = $("#inputPatientFirstName").val();
       patient.lastName = $("#inputPatientLastName").val();
       patient.gender = $("#inputGender").val();
       patient.age = $("#inputAge").val();
       patient.dateOfBirth = $("#dateOfBirth").val();
       patient.address1 = $("#inputPatientAddrees1").val();
       patient.address2 = $("#inputPatientAddrees2").val();
       patient.city = $("#inputPatientCity").val();
       patient.state = $("#inputPatientState").val();
       patient.country = $("#inputPatientCountry").val();
       patient.zip = $("#inputPatientZip").val();
       patient.phone = $("#inputPatientPhone").val();
       patient.email = $("#inputPatientEmail").val();
       data.patient = patient;

       // Fetch physician data;
       var physician = {};
       physician.firstName = $("#inputPhysicianFirstName").val();
       physician.lastName = $("#inputPhysicianLastName").val();
       physician.address1 = $("#inputPhysicianAddrees1").val();
       physician.address2 = $("#inputPhysicianAddrees2").val();
       physician.city = $("#inputPhysicianCity").val();
       physician.state = $("#inputPhysicianState").val();
       physician.country = $("#inputPhysicianCountry").val();
       physician.zip = $("#inputPhysicianZip").val();
       physician.phone = $("#inputPhysicianPhone").val();
       physician.email = $("#inputPhysicianEmail").val();

       data.physician = physician;
       
       // Gather specimen data
       for (let index = 0; index < specimens.length; index++) {
           const specimen = specimens[index];
           var slides = specimen.form.find("#slides-"+specimen.id);
           var sFiles = FilePond.find(slides.get(0)).getFiles();
           var slidesObj = [];
           sFiles.forEach(function (file) {
               slidesObj.push(file.filename);
           });

           var documents = specimen.form.find("#documents-"+specimen.id);
           var dFiles = FilePond.find(documents.get(0)).getFiles();
           var dObj = [];
           dFiles.forEach(function (file) {
               dObj.push(file.filename);
           });
           
           var media = specimen.form.find("#media-"+specimen.id);
           var mFiles = FilePond.find(media.get(0)).getFiles();
           var mObj = [];
           mFiles.forEach(function (file) {
               mObj.push(file.filename);
           });

           specimen.files = {};
           specimen.files.slides = slidesObj;
           specimen.files.documents = dObj;
           specimen.files.media = mObj;
           specimen.form = "";
       }
       data.specimens = specimens;
       // Submit using ajax and redirect to all records

       $.post('<?php echo base_url();?>upload-center', data, function(event) {
           window.location.href = "<?php echo base_url();?>all-records";
       });
   });
});
</script>

</body>

</html>