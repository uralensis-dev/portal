<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Header -->


<style type="text/css">
	.checked_chk ul{
		border:1px solid #dddddd;
	}
	.checked_chk ul li{
		border-bottom:1px solid #dddddd;
		padding: 3px 10px 0;
	}
	.checked_chk ul li:last-child{
		border-bottom:0px;
	}
	.checked_chk ul li label{
		margin-bottom: 0px;
	}
	.custom-table-search tr td{
		text-transform: capitalize;
	}
	.cinput input{
		width: 20px;
		height: 20px;
	}

	.qucikSearch{
	    list-style: none;
	    padding: 0;
	    margin: 0;
		overflow: hidden;
		width: 100%;
	}
	.qucikSearch li{
		padding:0 1px 5px;
		float: left;
		width: 33%;
	}
	.specimen_list li{position: relative;}
	.specimen_list li:not(:last-child){margin-right: 2px;}
	.specimen_list li a {
	    border: 1px solid #ccc;
	    color: #000;
	    display: inline-block;
	    width: 40px;
	    height: 40px;
	    text-align: center;
	    line-height: 2.2;
	    border-radius: 20px;
	}
	.specimen_list li.last-child a{
		/*border:0;*/
		/*background: transparent;*/
	}
	.specimen_list_inners {
	    display: none;
	    position: absolute;
	    min-width: 140px;
	    right: 0;
	    padding-top: 5px;
	    /*width: 100%;*/
	}

	.specimen_list li.last-child a{
		padding: 0 5px;
		box-sizing: border-box;
	}
	.specimen_list li.last-child a img{width: 100%; height: auto}
	.specimen_list li.last-child a.white{
		display: none;
	}
	.specimen_list li:hover .specimen_list_inners{display: block;}
	.specimen_list li.last-child:hover a.white{
		display: block;
	}
	.specimen_list li.last-child:hover a.blk{
		display: none;
	}
	.specimen_list li img{
		width: 39px;
		height: 38px;
	}
	.specimen_list li a:hover, .specimen_list li a:focus, .specimen_list li a.active{
		background-color: #009efb;
    	border: 1px solid #009efb;
    	color: #fff;
	}
	/*.specimen_list li.last-child a:hover,.specimen_list li.last-child a:focus,*/
	/*.specimen_list li.last-child a.active{background-color: unset; border:unset;}*/
	.qucikSearch li a{font-size: 14px; padding: 4px;}

	.qucikSearch li label{margin-bottom: 0px;}
	@media screen and (min-width: 1500px) {
		.qucikSearch li{width: 33%;}
		.qucikSearch li a{font-size: 16px;}
	}
	@media screen and (min-width: 1800px) {
		.qucikSearch li{width: calc(100%/5);padding: 2px;}
	}
	@media print{
		body, .page-wrapper{background:#fff!important; margin: 0 !important}
		.header, .sidebar,.card,.page-header,.print_button{display: none;}
		.card.print_section{border:0px; box-shadow: unset; display: block; width: 100%;}
		.card-header{border-bottom: 0px;}
		#print_section{display: block; width: 100%;}


	}

</style>
<div class="page-header">
	<div class="row align-items-center">
		<div class="col">
			<h3 class="page-title">Requestor</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Requestor</li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6 col-xl-7">
		<div class="card">
			<div class="card-body">
				<div class="col-lg-12 form-group">
					<div class="row">
						<div class="col-lg-2 form-group nopadding">
							<label for="" style="margin-top: 10px;">Intials: <span>MRP</span></label>
						</div>
						<div class="col-lg-5 form-group">
							<input type="text" name="" class="form-control" placeholder="Lab No.">
						</div>
						<div class="col-lg-5 form-group">
							<ul class="list-inline text-right specimen_list">
							    <li class="list-inline-item s_list" data-text="Specimen 1">
							    	<a href="javascript:;" class="">S1</a>
							    	<ul class="list-inline specimen_list_inners">
							    		<li class="list-inline-item" data-text="Specimen 2">
									    	<a href="javascript:;" class="">S2</a>
									    </li>
									    <li class="list-inline-item" data-text="Specimen 3">
									    	<a href="javascript:;" class="">S3</a>
									    </li>
									    <li class="list-inline-item" data-text="Specimen 4">
									    	<a href="javascript:;" class="">S4</a>
									    </li>
							    	</ul>
							    </li>
							    <li class="list-inline-item b_list">
							    	<a href="javascript:;" class="">B1</a>
							    	<ul class="list-inline specimen_list_inners">
							    		<li class="list-inline-item">
									    	<a href="javascript:;" class="">B2</a>
									    </li>
									    <li class="list-inline-item">
									    	<a href="javascript:;" class="">B3</a>
									    </li>
									    <li class="list-inline-item">
									    	<a href="javascript:;" class="">B4</a>
									    </li>
							    	</ul>
							    </li>
							    <li class="list-inline-item last-child">
							    	<a href="javascript:;" class="blk"><img src="<?php echo base_url();?>assets/icons/Urgent-wb.png" style="max-width: 40px;"></a>
							    	<a href="javascript:;" class="white"><img src="<?php echo base_url();?>assets/icons/Urgent-wb-white.png" style="max-width: 40px;"></a>
							    </li>
							</ul>
						</div>
						<div class="clearfix"></div>
						
					</div>
					<br>
				</div>
				<div class="clearfix"></div>
				<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
					<li class="nav-item"><a class="nav-link active" href="#solid-rounded-tab1" data-toggle="tab">Routine & Specials</a></li>
					<li class="nav-item"><a class="nav-link" href="#solid-rounded-tab2" data-toggle="tab">Immunochemistry</a></li>
					<li class="nav-item" style="margin-left: auto;">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search" id="quickBox">
							<div class="input-group-append">
						      <button class="btn btn-success" type="button">
						        <i class="fa fa-search"></i>
						      </button>
						    </div>
						</div>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane show active" id="solid-rounded-tab1">
						<div class="form-group">
							<ul class="qucikSearch">
								<li><a href="javascript:;" class="btn btn-info btn-block">Alcian Blue</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AB PAS</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AB DPAS</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Congo Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">EVG</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Formalin Pig Removal</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Giemsa</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Gram</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Gram Twort</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Grocott</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Hales</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MSB</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Mason Fontana</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Oil Red O</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P.A. Silver</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PAS</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PAS +D</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Perl's</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Thick Perl's</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Retic</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Rhodanine</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Shikata</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Von Kossa</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">ZN</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Mod ZN</a></li>
							</ul>
						</div>
						<div class="form-group mb-0">
							<h4>Levels</h4>
							<hr>

							<div class="row">
								<div class="col-sm-6 form-group">
									<label>Number of Levels</label>
									<input type="number" name="" class="form-control">
								</div>
								<div class="col-sm-6 form-group">
									<label>Last Previous Level</label>
									<input type="number" name="" class="form-control">
								</div>
								<div class="col-sm-12 form-group">
									<ul class="list-inline cinput">
										<li class="list-inline-item">
											<input id="Shallow" type="radio" name="levels" value="Shallow">
											<label for="Shallow">Shallow</label>
										</li>
										<li class="list-inline-item">
											<input id="Normal" type="radio" name="levels" value="Normal">
											<label for="Normal">Normal</label>
										</li>
										<li class="list-inline-item">
											<input id="Deep" type="radio" name="levels" value="Deep">
											<label for="Deep">Deep</label>
										</li>
										<li class="list-inline-item">
											<input id="Serial_HB" type="radio" name="levels" value="Serial (HB)">
											<label for="Serial_HB">Serial (HB)</label>
										</li>
										<li class="list-inline-item">
											<input id="Deeper_Section" type="radio" name="levels" value="Deeper Section">
											<label for="Deeper_Section">Deeper Section</label>
										</li>
									</ul>
								<hr>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
					<div class="tab-pane table-responsive" id="solid-rounded-tab2">
						<div class="form-group">
							<ul class="qucikSearch">
								<li><a href="javascript:;" class="btn btn-info btn-block">34BE12</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">IHC 1	A-1-AT</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AE1/AE3</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AFP</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">ALK1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AMACR</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Amyloid A</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Amyloid P</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">AR</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">B-Catenin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">BAP1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">BCL-2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">BCL-6</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Ber-EP4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">BRAF V600E</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CA 125</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Ca 19.9</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Calcitonin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Caldesmon (h)</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Calponin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Calretinin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 1a</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 3</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 5</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 6</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 7</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 8 </a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 9</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 10</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 15</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 20 </a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 21</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 23</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 25</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 30</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 31</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 34</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 44</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 56</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 61</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 68</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 79a</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 99</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 117</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CD 138</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CDK 4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CDX 2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CEA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">C-erb B2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CGA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK (MNF-116)</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 5</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 7</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 8/18</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 14</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 17</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CK 20</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">CMV</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">c-Myc</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Cyclin D1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">D2 40</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Desmin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">DOG1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">EBER</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">E-Cadherin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">EMA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">ER</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">ERG</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Factor 8</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Factor 13</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Gastrin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">GATA3</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">GCDFP-15</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">GFAP</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Glycophorin A</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Granzyme B</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HCG</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Hepatocyte</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Hep B CA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Hep B SA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HHV8</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HLO</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HMB 45 - Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HMB 45 - Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">HSV 1 & 2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">lgA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">lgG</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">lgG4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">lgG4-Renal</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">lgM</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">IMP3</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Inhibin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">K/L B IHC</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">K/L P ISH</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Ki-67</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">LCA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Mamma</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MCT Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MCT Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Mel A Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Mel A Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MITF Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MITF Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MSI Markers</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MUC 1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MUC 2</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MUC 4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MUC 5AC</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">MUM 1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Myo D1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Myogenin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Myoglobin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Myosin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Myeloperoxidase</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Napsin A</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">NFP</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">NSE</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">OCT 3/4</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P16 - Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P16 - Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P40</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P53</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P57</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">P63</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Parathyroid</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Parvovirus</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PAX 8</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PLAP</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PNC (PCP)</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PR</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">PSA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">RCC</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Renals Panel</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">S-100 Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">S-100 Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">SMA</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">SMM-HC</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">SOX10 Brown</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">SOX10 Red</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Spirochete</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">STAT6</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Synapto</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">TdT</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Thrombo</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Thyroglob</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">TTF-1</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">Vimentin</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">VS38c</a></li>
								<li><a href="javascript:;" class="btn btn-info btn-block">WT-1</a></li>
							</ul>
						</div>
					</div>
					
				</div>

				<div class="row">
					<div class="col-lg-12 form-group">
						<label>Reason for Request</label>
						<div class="clearfix"></div>
						<!-- <input type="text" class="form-control select2"  id="myInput" value=""> -->
						<select class="form-control select2" id="myInput" multiple>
							<option>Green</option>
							<option>Green</option>
							<option>Green</option>
							<option>Green</option>
							<option>Green</option>
							<option>Green</option>
							<option>Green</option>
						</select>
					</div>
					<div class="col-lg-12 form-group">
						<label>Comments</label>
						<input type="text" class="form-control" id="myInput2" value="">
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-xl-5">
		<div id="editor"></div>
		<div class="card print_section" style="width: 100%">
			<div id="print_section" style="overflow: hidden; width: 100%">
				<div class="card-header">
					<div class="card-title mb-0">
						<div class="row">
							<div class="col-sm-12">
								Request List
								<span class="pull-right" style="float: right;">
									<strong>Date:</strong> 08-22-2020
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								Requestor Name : Tim Kilman
								<span class="pull-right"  style="float: right;">
									<strong>Time:</strong> 06:40 PM
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive form-group">
						<table class="table table-stripped custom-table custom-table-search" style="width: 100%;">
							<thead>
								<tr>
									<th>Lab No.</th>
									<th>Patient Intials</th>
									<th>Test</th>
									<th>Specimen</th>
									<th>Block</th>
									<th class="text-right">Cost</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col-lg-12 form-group">
							<label>Reason for Request</label>
							<p id="divID"></p>
						</div>

						<div class="col-lg-12 form-group">
							<label>Comments</label>
							<p id="divID2"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<div class="row">
					<div class="col-lg-12 form-group">
						<button class="btn btn-primary print_button" onclick="print()"> <i class="fa fa-print"></i> Print </button>
						<button class="btn btn-primary print_button" onclick="generatePDF2()"><i class="fa fa-file-pdf-o"></i> Save as PDF</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12" style="display: none;">
		<div id="editor2"></div>
		<div class="row" id="print_section_new">
			<div class="col-sm-6">
				<div class="card print_section2">
					<div class="card-header">
						<div class="card-title mb-0 text-right">*18S29657*</div>
					</div>
					<div class="card-body">
						
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<label>Lab No.</label>
										<p>18S29657</p>
									</td>
									<td>
										<label>Blocks</label>
										<p>1</p>
									</td>
									<td>
										<label>Patient Name</label>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<label for="">Requesting Path</label>
										<p>IHC	</p>
									</td>
									<td colspan="2">
										<label for="">Date & Time</label>
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label>Levels</label>
										<p>Level 1</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>18S29657</p>
									</td>
									<td>
										<p>1</p>
									</td>
									<td>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<p>IHC	</p>
									</td>
									<td colspan="2">
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Specials</strong></label>
										<ul class="list-unstyled">
											<li>Von Kosa</li>
											<li>Retic</li>
										</ul>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Other Requests</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Free Text) </label>
										<p></p>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card print_section2">
					<div class="card-header">
						<div class="card-title mb-0 text-right">*18S29657*</div>
					</div>
					<div class="card-body" style="min-height: 706px">
						
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>
										<label>Lab No.</label>
										<p>18S29657</p>
									</td>
									<td>
										<label>Blocks</label>
										<p>1</p>
									</td>
									<td>
										<label>Patient Name</label>
										<p>Taqi Raza</p>
									</td>
								</tr>
								<tr>
									<td>
										<label for="">Requesting Path</label>
										<p>Pandey	</p>
									</td>
									<td colspan="2">
										<label for="">Date & Time</label>
										<p>11/10/2020 11:17	</p>
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<label><strong>Immuno</strong></label>
										<ul class="list-unstyled">
											<li>S-100 - Brown</li>
											<li>Melan A - Brown</li>
											<li>Desmin</li>
											<li>CD 34</li>
										</ul>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
