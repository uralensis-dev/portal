<style type="text/css">
    .page-wrapper.sidebar-patient {
        padding: 75px 30px 0;
    }
    .page-header .breadcrumb {
        font-size: 16px;
    }
    .profile-widget{
        padding: 50px 15px;

    }
    .profile-img{
        width: auto;
        height: auto;
        margin-bottom: 20px;
    }

    .card-body {
        height: 70vh;
        position: relative;
    }

    .danger-text { 
        color: red;
    }

    #speciality-container {
        display: flex;
        flex-wrap: wrap;
    }

    .speciality-box {
        min-width: 200px;
        margin-right: 20px;
        padding: 20px 25px;
        border-radius: 12px;
        margin-bottom: 50px;
        box-shadow: 5px 5px 20px rgba(200, 200, 200, 0.7);
        cursor: pointer;
    }

    .selected-speciality {
        background-color: lightblue;
    }

    #next-button {
        position:absolute;
        bottom: 0;
        right: 10px;
        display: none;
    }

</style>

<div class="page-wrapper patient-doctor no-sidebar">
    <!-- Page Content -->
    <div class="content container-fluid">
        
        <div class="row">
            <div class="col-md-6">
                <h2>Booking In</h2>
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">New Record</a></li>
                                <li class="breadcrumb-item active">Booking In</li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="list-inline sessions_info text-right">
                    <li class="list-inline-item">
                        <a href="javascript:;" data-toggle="tooltip" title="Create Session">
                            <img src="<?php echo base_url();?>/assets/institute/img/Create-session-b.png" class="img-fluid" style="max-width: 50px">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:;"  data-toggle="tooltip" title="View Session">
                            <img src="<?php echo base_url();?>/assets/institute/img/View-session-b.png" class="img-fluid" style="max-width: 50px">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <section>
            <div class="row">
                <div class="col-12 mb-2"><strong>Lab: </strong>  <p>Andrew Patterson</p> <button class="btn btn-primary btn-sm ml-5">Change</button></div>
                <div class="col-12 mb-2"><strong>Specialty: </strong> Histopathology  <button class="btn btn-primary btn-sm ml-4">Change</button></div>
            </div>
            <div class="col-md-8 mx-auto">
                <div class="row mb-3">
                    <div class="col-sm-6 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">
                                
                                
                                 <a href="javascript:;" class="avatar" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>uploads/person-male.png"
                                         alt="">
                                </a>

                            </div>
                            
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">By Patient</a></h4>
                            
                        </div>
                    </div>
                    <div class="col-sm-6 user-card">
                        <div class="profile-widget">

                            <div class="profile-img">
                                <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>uploads/person-male.png"
                                         alt="">
                                </a>
                                 <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>uploads/person-male.png"
                                         alt="">
                                </a>
                                 <a href="javascript:;" class="avatar" onclick="showupload()" style="max-width: 50px; max-height: 50px;">
                                    <img src="<?php echo base_url();?>uploads/person-male.png"
                                         alt="">
                                </a>
                            </div>
                            
                            <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#" onclick="showupload()">Batch Entry</a></h4>
                            
                        </div>
                    </div>
                </div>
                
                <div style="display:none" class="profile-widget" id="dis_data">
                <div><a style="float:right" href="#" onclick="hideupload()">X</a></div>
            <form action="<?php echo base_url('institute/eximportcsv'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <label class="control-label">Upload CSV</label>
                      <div class="input-group">
                       <input type="file" name="image" id="image" />
                       <input type="hidden" name="hospital_id" value="5465465" />
                      </div>       
                      <br />           
<input class="btn btn-primary submitBtn" type="submit" name="submit" value="Upload" />
                 
           </form> 
           </div>
                
                <div class="row mb-3">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group form-focus">
                            <input type="text" class="form-control floating">
                            <label class="focus-label">Search/Add Record</label>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
        <!-- <section class="provider_information form-group text-uppercase">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <select class="select2 form-control" id="lab-select">
                            <?php if (empty($lab)): ?>
                                <option value="" disabled selected>--Select Lab--</option>
                            <?php else: ?>
                                <option value="" disabled>--Select Lab--</option>
                            <?php endif; ?>
                            <?php foreach ($labs as $l) : ?>
                                <?php if (!empty($lab)): ?>
                                    <option <?php echo $lab === $l['group_id'] ? 'selected': ''; ?> value="<?php echo $l['group_id'] ?>"><?php echo $l['description']; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $l['group_id'] ?>"><?php echo $l['description']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p id="lab-message"></p>
                    <div id="speciality-container">-->
                        <!-- These box will be generated from javascript bookingin.js -->
                        <!-- To edit this box go to the script find function updateLab -->
                        <!--<div class="speciality-box" style="display: none;">
                            Speciality
                        </div>
                    </div>

                    <button class="btn btn-primary" id="next-button">Next</button>
                </div>
            </div>
        </section> -->
    </div>
</div>
<script>

function showupload()
{
	$("#dis_data").show();
}

function improt_csv() 
{
	var year = '2010';

	var photo = document.getElementById("image");
	var file = photo.files[0];
		alert(photo);

      data = new FormData();

      if(photo.files[0]){
        data.append('file', file);
      }else{
        alert('upload csv file to further proceed it');
        return false;
      }
      data.append('year', year);
     
      $.ajax({
            type:'POST',
            url:'<?php echo base_url() ?>institute/eximportcsv/'+year,
            data: data,
            enctype: 'multipart/form-data',
            processData: false,  
            contentType: false,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
             window.location = '<?php echo base_url('appadmin/expense/list')?>';
               
            },
            error: function () {
                 $('#group_type_msg1').html('<span class="alert alert-danger col-sm-12 top10">Error! Announcement is not saved.</span>');
            }
        });
  }
</script>