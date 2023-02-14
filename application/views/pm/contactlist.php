
<style>
body{
    margin-top:20px;
    background-color: #edf0f0;    
}
.btn-primary, 
.btn-primary:hover, 
.btn-primary:focus, 
.btn-primary:active, 
.btn-primary.active, 
.btn-primary.focus, 
.btn-primary:active, 
.btn-primary:focus, 
.btn-primary:hover, 
.open>.dropdown-toggle.btn-primary {
    background-color: #3bc0c3;
    border: 1px solid #3bc0c3;
}
.p-t-10 {
    padding-top: 10px !important;
}
.media-main a.pull-left {
    width: 100px;
}
.thumb-lg {
    height: 84px;
    width: 84px;
}
.media-main .minfo {
    overflow: hidden;
    color: #000;
}
.media-main .minfo h4 {
    padding-top: 10px;
    margin-bottom: 5px;
}
.social-links li a {
    background: #EFF0F4;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    display: inline-block;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    color: #7A7676;
}
.container{
    margin:4px, 4px; 
               
               
                height:600px; 
                overflow-x: hidden; 
                overflow-x: auto; 
                text-align:justify; 

}
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey;
  border-radius: 10px;
}
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippet">
    <!--  <div class="row">
      <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body p-t-0">
                    <div class="input-group">
                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <div class="row" id="usernames">

    <?php foreach($getContacts as $rec){ ?>
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-body p-t-10">
                    <div class="media-main">
                        <a class="pull-left" href="#">
                            <img class="thumb-lg img-circle bx-s" src="https://bootdey.com/img/Content/user_1.jpg" alt="">
                        </a>
                        <div class="pull-right btn-group-sm">
                      
                          <input type="checkbox"  id="musers_<?php echo $rec->id ?>"  value="<?php echo $rec->username;?>" onclick = "GetSelected()" />
                        </div>
                        <div class="mminfo">
                            <h4><?php echo $rec->first_name." ".$rec->last_name; ?></h4>
                            <p class="text-muted"><?php echo $rec->company; ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <ul class="social-links list-inline p-b-10">
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Message"><i class="fa fa-envelope-o"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
        
</div>
<script>
function GetSelected()
{
  


           //Create an Array.
           var selected = new Array();

//Reference the Table.
var tblFruits = document.getElementById("usernames");

//Reference all the CheckBoxes in Table.
var chks = tblFruits.getElementsByTagName("INPUT");

//Loop and push the checked CheckBox value in Array.
for (var i = 0; i < chks.length; i++) {
    if (chks[i].checked) {
        selected.push(chks[i].value);
    }
}

//Display the selected CheckBox values.
if (selected.length > 0) {
    $("#recipients").val(selected.join(";"));
   // alert("Selected values: " + selected.join(";"));
}




}


</script>