<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
				<div class="pull-left">
				<h3 class="page-title">Welcome Admin!</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Dashboard</a></li>
					<li class="breadcrumb-item active">CW Data</li>
				</ul>
			</div>
			<div class="pull-right">
				<ul class="list-inline pull-right">
					<li class="list-inline-item">
		                <input type="text" class="form-control input-lg" placeholder="Text">
					</li>
					<li class="list-inline-item">
						<button class="btn btn-success btn-lg btn-block newbtn" type="submit" style=""> Search </button>
					</li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-trans adv-search btn-lg collapsed" data-toggle="collapse" data-target="#collapse_adv_search" aria-expanded="false"><i class="fa fa-cog fa-2x"></i></button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="collapse" id="collapse_adv_search">
	<form class="tg-formtheme tg-advancesearch" action="<?php echo base_url()?>index.php/doctor/search_request" method="post">
    	<div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
        	<div class="row card-body">
                <div class="col-md-3">
                    <input class="form-control" type="text" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="col-md-3 ">
                    <input class="form-control" type="text" id="sur_name" name="sur_name" placeholder="Last Name">
                </div>
                <div class="col-md-3">
                    <input class="form-control" type="text" id="hospital_number" name="hospital_number" placeholder="Hospital Number">
                </div>
                <div class="col-md-3">
                    <i class="lnr lnr-calendar-full"></i>
                    <input type="text" name="dob" id="adv_dob" class="form-control unstyled" placeholder="DOB">
                </div>
                <!-- <div class="col-md-1">
                    <select data-placeholder="Gender" name="gender" class="form-control">
                        <option value="">Gender</option>
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                    </select>
                </div> -->
                <!-- <div class="col-md-2 form-group">
                    <button type="submit" class="btn btn-success btn-search">Advance Search</button>
                </div> -->
        	</div>
    	</div>
    </form>
</div>

<div class="row">
	<div class="col-md-12">
		<script type="text/javascript" src="https://uralensis.formstack.com/forms/js.php/data_items"></script><noscript><a href="https://uralensis.formstack.com/forms/data_items" title="Online Form">Online Form - Table 1: Scenario 1a to 1g</a></noscript><div style="text-align:right; font-size:x-small;"><a href="http://www.formstack.com?utm_source=jsembed&utm_medium=product&utm_campaign=product+branding&fa=h,3970592" title="Powered by Formstack">Powered by Formstack</a></div>
		
	</div>
</div>
