<style type="text/css">
  .page-wrapper>.content {
    padding-top: 0
  }
  .downloadBtn{
    margin: 2px
  }
  .btn.btn-trans {
    line-height: 1.7;
    width: 25px;
    padding: 0;
    height: 25px;
    border: 1px solid #ccc;
    border-radius: 50%;
    position: absolute;
    top: 87px;
    left: 50%;
    margin-left: -13px;
  }

  .clicked .btn-circle {
    border: 2px solid #fbbc34;
  }

  .wrap_it {
    margin: 0;
    padding-top: 0
  }

  .process_label {
    width: 180px;
    line-height: 2;
    background: #56c0ef;
    color: #fff;
    margin: 0 auto
  }

  .border_orange {
    border-color: #fbbc34
  }

  .orange_fill {
    border-color: #fbbc34
  }

  .bg_orange {
    background: #fbbc34;
  }

  .qr_code_area {
    background-color: #fff;
    margin-left: 15px;
  }

  .qr_code_area .image {
    width: 250px;
    margin: 0 auto;
    text-align: center;
  }
  .form-focus .form-control{width: 100%;}

  li.list-item.specimen_no_show {
    font-weight: 700;
  }

  .form-focus,
  .form-control {
    padding: 8px 12px !important;
  }

  .tt-input, /* UPDATE: newer versions use tt-input instead of tt-input */
  .tt-hint {
      /* width: 300px; */
      /* height: 40px; */
      /* padding: 8px 12px; */
      /* font-size: 24px;  */
      /* line-height: 30px; */
      border: 1px solid #ccc;
      /* border-radius: 8px; */
      outline: none;
  }

  .tt-input { /* UPDATE: newer versions use tt-input instead of tt-query */
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  }

  .tt-hint {
      color: #999;
  }
  .tg-searchrecord fieldset .form-group i {
    top: 0;
    right: 0;
    margin: 0;
    width: 35px;
    color: #444;
    font-size: 16px;
    cursor: pointer;
    line-height: 30px;
}
  .tg-inputicon i {
    top: 9px !important;
  }

.tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
    width: 422px;
    margin-top: 12px;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
    padding: 3px 20px;
    font-size: 18px;
    line-height: 24px;
}

  .table td,
  .table th {
    border-top: 0px
  }

  @media screen and (min-width: 2050px) {
    .wrap_it {
      margin: 0 auto;
    }
  }
</style>

<div class="row">
  <div class="col-12">
    <div class="page-header" style="margin-top: 25px">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="page-title">Laboratory Specimen Tracking</h3>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url();?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Specimen Tracking</li>
          </ul>
        </div>
      </div>
    </div>
	
    <div class="row">

        <div class="col-lg-12" id="dv_add_remove_class">

        <div class="wrap_it">

          <table class="table custom-table" id="patient-info-table" style="margin-bottom: 30px; display: none;">
            <tbody>
              <tr style="box-shadow:0px 0px 0px 0px !important;">
                <td>
                  <span>Surname: </span>
                  <span style="display:inline-block; margin-top: 12px;" id="info-table-surname">Jane</span>
                </td>
                <td>
                  <span>First Name: </span>
                  <span style="display:inline-block; margin-top: 12px;" id="info-table-first-name">Jane</span>
                </td>
                <td><span>DOB: <span id="info-table-dob">21-06-1987</span></span></td>
                <td><span>NHS: <span id="info-table-nhs">4606458771</span></span></td>
              </tr>
            </tbody>
          </table>


          <!-- Process -->
          <div class="process">
            <!-- Row 1 -->
            <div class="column1"></div>
            <div class="column2"></div>
            <div class="column3b"></div>
            <div class="column4"></div>
            <div class="column5"></div>
            <div class="column6"></div>
            <div class="column7"></div>
            <div class="process-row">
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Accessioning & registration</li>
                    <li>Electronic order from EMR/CDR/LIS</li>
                    <li>Request forms scanned</li>
                  </ul>

                </div>

                <button id="lab-entry" onclick="select_status('Lab Entry', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="45.5px" height="40.9px" viewBox="0 0 45.5 40.9">
                    <path d="M37.1,28.5v-6.9c-0.1-0.1-0.2-0.1-0.3-0.2c-0.5-0.3-0.7-0.9-0.5-1.4c0.1-0.5,0.6-0.9,1.1-0.9c1.1,0,2.3,0,3.4,0
  c0.5,0,0.9,0.4,1.1,0.9c0.2,0.5,0,1-0.4,1.4c-0.1,0.1-0.2,0.2-0.3,0.3v6.9c1.9,0.7,3.3,2,3.9,4c0.5,1.3,0.5,2.7,0.1,4
  c-0.8,2.3-3.3,4.6-6.7,4.3c-2.8-0.3-5.1-2.4-5.6-5.1C32.3,32.9,33.7,29.7,37.1,28.5 M37.8,29c-1.4,0.3-2.5,1.1-3.4,2.2
  c-0.8,1.2-1.2,2.5-1,3.9c0.4,3,2.6,4.8,5,5c2.7,0.3,5.2-1.3,6-3.9c0.4-1.2,0.4-2.4,0-3.6c-0.7-1.9-2.1-3.1-4-3.7v-7.7
  c0.1,0,0.1-0.1,0.2-0.1c0.5-0.3,0.6-0.6,0.5-1.1c-0.1-0.4-0.4-0.6-0.9-0.6c-0.4,0-0.8,0-1.2,0c-0.5,0-0.9,0-1.4,0
  c-0.5,0.1-0.8,0.4-0.7,0.9c0,0.4,0.3,0.7,0.9,0.8C37.8,21.1,37.8,29,37.8,29z M39,32.2c1.6,0,3,0.4,4.2,1.1c0.9,0.5,1.1,0.9,1,2
  c-0.2,1.2-0.6,2.2-1.4,3c-0.7,0.7-1.5,1.2-2.5,1.4c-1.3,0.3-2.5,0.2-3.6-0.4c-1.7-0.9-2.6-2.3-2.8-4.2c0-0.5,0.1-0.9,0.6-1.2
  c1.1-0.8,2.4-1.3,3.8-1.5C38.5,32.2,38.9,32.2,39,32.2 M38.5,38.3c0.6,0,0.9-0.4,0.9-0.9s-0.4-0.9-0.9-0.9s-1,0.4-1,0.9
  C37.6,37.9,37.9,38.3,38.5,38.3 M41.4,35.9c0-0.4-0.3-0.8-0.7-0.8c-0.5,0-0.8,0.3-0.9,0.7c0,0.5,0.3,0.8,0.8,0.9
  C41,36.7,41.4,36.3,41.4,35.9 M39.4,23.6c0.3,0,0.5,0.3,0.5,0.6c0,0.3-0.3,0.6-0.5,0.6c-0.3,0-0.6-0.3-0.6-0.6
  C38.8,23.9,39.1,23.6,39.4,23.6 M31.5,36.1c0.2,1.1,0.7,2.2,1.4,3.1c-2,0.4-4,0.5-6,0.7c-3.9,0.3-7.8,0.2-11.6,0.1
  c-3.3-0.1-6.6-0.3-9.8-1.1c-1.3-0.3-2.5-0.7-3.6-1.5C1,36.8,0.6,35.9,0.3,35c-0.1-0.2,0-0.4-0.1-0.5c-0.6-2.6,0.5-4.4,2.7-5.7
  c2-1.2,4.1-1.9,6.4-2.4c1.3-0.3,2.6-0.5,3.9-0.7c2.3,2.1,4.4,4.1,6.6,6.2c2.2-2.1,4.4-4.1,6.6-6.2c1,0.2,2.1,0.3,3.2,0.6
  c1.9,0.4,3.7,1,5.4,1.8h0.1C32.4,29.7,30.9,32.9,31.5,36.1 M30.9,11c0.2,5.4-4.2,11.1-11.1,11.1S8.6,16.4,8.6,11
  C8.7,4.9,13.5,0,19.7,0C26.7,0,31,5.7,30.9,11"></path>
                  </svg> </button>

                <div class="process_label">
                  Lab Entry
                </div>
              </div>

              <div class="process-step">
                <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-01.svg" style="width:40px; height:40%; margin:0 auto">
              </div>
              <div class="process-step">

                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Specimen type: determines correct number of cassettes slides & stains</li>
                    <li>Interface auto-printing on demand of labelled cassettes</li>

                  </ul>

                </div>

                <button id="specimen-labelling" onclick="select_status('Specimen Labelling', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="39.2px" height="39.3px" viewBox="0 0 39.2 39.3">
                    <path d="M38.8,12.8L26.4,0.4c-0.5-0.5-1.4-0.6-2,0c-0.6,0.6-0.6,1.4,0,2l1,1l-12,12c-8.5,8.8-12,12.3-12.3,12.7
  c-1.7,2.7-1.4,6.4,0.8,8.8c1,1.1,2.4,1.9,3.8,2.2c0.8,0.2,2.4,0.2,3.1,0c0.9-0.2,1.7-0.5,2.4-1c0.5-0.3,3.2-3,12.6-12.3l11.9-11.9
  l1,1c0.5,0.6,1.4,0.6,2,0c0,0,0,0,0.1-0.1C39.3,14.2,39.3,13.4,38.8,12.8z M21.8,23.7c-9,9-12,11.9-12.4,12.1
  C8.6,36.2,8,36.4,7,36.3c-0.8,0-0.9-0.1-1.6-0.4C4.6,35.5,4,35,3.6,34.3c-0.9-1.4-0.9-2.9-0.2-4.5c0.2-0.4,2.7-3,12.1-12.4
  C22,10.9,27.4,5.5,27.4,5.5C27.6,5.6,29,7,30.6,8.7l3.1,3.1L21.8,23.7z M20.7,18.7h5l-8,8c-5.8,5.8-8.2,8.1-8.6,8.3
  c-0.7,0.4-2,0.5-2.8,0.2c-0.7-0.3-1.6-1.1-2-1.8C4,33,4,32.8,4,31.9c0-0.8,0.1-1.1,0.3-1.5c0.2-0.4,1.5-1.7,5.8-6.1l5.6-5.6H20.7z"></path>
                  </svg> </button>
                <div class="process_label">
                  Specimen Labelling
                </div>
              </div>
              <div class="process-step">
                <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-01.svg" style="width:40px; height:40%; margin:0 auto">
              </div>
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist s-paralist">
                    <li>Pathologist cut-cup of specimen</li>
                    <li>Dictate macro description of specimen, photograph and annotate sections</li>
                  </ul>

                </div>
                <button id="cut-up-grossing" onclick="select_status('Cut up / Grossing', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="38.3px" height="40px" viewBox="0 0 38.3 40">
                    <path d="M21.8,33.6c1-3.6,2.1-7.1,3.1-10.7c2.7,0.3,5.2,1.2,7.4,2.7c2.7,1.8,4.6,4.1,5.5,7.2c0.2,0.8,0.4,1.7,0.4,2.6
  c0.1,1.3,0,2.6,0,3.8c0,0.3,0,0.5,0,0.8H5.3c-0.1,0-0.1-0.1-0.1-0.1c0-2.2-0.3-4.5,0.3-6.7c0.9-3.5,3.1-6.1,6.2-7.9
  c1.9-1.2,4-1.9,6.2-2.3c0.5-0.1,0.7,0,0.8,0.5c0.9,3.2,1.8,6.4,2.8,9.6c0.1,0.2,0.1,0.4,0.2,0.6C21.7,33.7,21.7,33.7,21.8,33.6
   M30.8,4.7c0,0.4,0,0.9,0,1.3c0,0.7,0.1,1.3,0.5,1.9c1.1,1.9,0.3,4.2-1.1,4.9c-0.3,0.2-0.4,0.5-0.6,0.8c-0.7,1.7-1.4,3.5-2.1,5.2
  c-0.2,0.5-0.6,1-0.9,1.5c-1.7,2.6-4.2,3-7.1,2.2c-0.8-0.2-1.4-0.7-2-1.3c-1.3-1.4-2.1-3.1-2.8-4.8c-0.3-0.9-0.6-1.9-1-2.8
  c-0.1-0.3-0.3-0.6-0.6-0.8c-1.7-1-2-3.6-1.1-5c0.3-0.5,0.4-1.1,0.4-1.7c0-1.1,0-2.2,0-3.4c0-0.5,0.1-0.8,0.6-1
  c3.2-1.3,6.5-1.9,9.9-1.6c2.4,0.2,4.7,0.7,6.9,1.5c0.8,0.3,0.8,0.3,0.8,1.1C30.8,3.6,30.8,4.1,30.8,4.7 M18.7,15.6
  c-0.1-1.3,0.6-2,1.6-2.3c1.1-0.3,2.2-0.3,3.2,0.1c0.5,0.2,0.9,0.6,1.1,1.1c0.1,0.3,0.1,0.7,0.4,0.9c0.3,0.2,0.7,0.1,1,0.1
  c0.2,0,0.4,0,0.6,0c0.5,0.1,0.8-0.2,0.9-0.7c0.2-0.8,0.5-1.6,0.8-2.4c0.1-0.5,0.3-0.8,0.8-0.9c0.3-0.1,0.7-0.4,0.8-0.8
  c0.7-1.3-0.1-2.6-1.6-2.9c-3.8-0.6-7.6-0.7-11.5-0.3c-0.8,0.1-1.5,0.2-2.3,0.4s-1.2,0.9-1.2,1.8c0,0.9,0.4,1.5,1.1,1.7
  c0.4,0.1,0.6,0.3,0.7,0.7c0.3,0.9,0.6,1.9,0.9,2.8c0.1,0.3,0.2,0.5,0.6,0.5C17.2,15.6,17.9,15.6,18.7,15.6 M17,17.3
  c0.9,2.8,2.7,4.2,5.4,4c1.7-0.1,3.7-2.1,4-4h-1.6c0,1.1-0.6,1.8-1.5,2.1c-1,0.3-2.1,0.3-3.1,0c-0.7-0.2-1.3-0.6-1.4-1.4
  c-0.1-0.6-0.3-0.7-0.8-0.7C17.7,17.3,17.4,17.3,17,17.3 M0.1,27.8c0-3.3,0-6.7,0-10c0-0.6,0.2-1.2,0.7-1.6c0.4-0.4,0.6-1,0.3-1.5
  c-0.9-1.6-1.1-3.3-1-5C0.2,8.1,0.5,6.6,0.7,5c0.1-0.4,0.2-0.7,0.4-1c0.6-1.1,1.3-1.2,2-0.2c0.3,0.3,0.5,0.7,0.7,1.1
  C4.5,6.5,5,8.2,5.2,10c0.2,1.4-0.3,2.6-1.5,3.4c-0.8,0.6-1,1.3-0.9,2.2c0,0.2,0.1,0.4,0.3,0.5c0.7,0.5,0.8,1.2,0.8,2.1
  c0,4.5,0,9,0,13.4c0,1.9,0,3.7,0,5.6c0,0.3,0,0.6,0,1c-0.1,1-1,1.7-2,1.7c-0.9,0-1.8-0.8-1.9-1.8S0,36,0,35
  C0.1,32.6,0.1,30.2,0.1,27.8L0.1,27.8z"></path>
                  </svg> </button>

                <div class="process_label">
                  Cut up / Grossing
                </div>
              </div>
              <div class="process-step"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-01.svg" style="width:40px; height:40%; margin:0 auto"> </div>
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Slide printer interface prints</li>
                    <li>labelled slides on demand</li>
                  </ul>

                </div>
                <button id="embedding-microtomy" onclick="select_status('Embedding & Microtomy', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="43.8px" height="33.3px" viewBox="0 0 43.8 33.3">
                    <path d="M13.8,24.3c-2.5-6.5-5-12.9-7.5-19.3C4.2,4.6,2.2,4.2,0,3.8c0.1,6.9,0.2,13.5,0.4,20.3c5.9,2,11.8,4,17.9,6
  c0.3-1.5,0.5-2.7,0.7-4.1C17.2,25.5,15.6,24.9,13.8,24.3 M4.7,20.1c-1.7,0-3-1.5-3-3.3c0-0.2,0-0.4,0.1-0.6c0.3-1.5,1.5-2.7,2.9-2.7
  c0.5,0,0.9,0.1,1.3,0.3c1,0.5,1.7,1.7,1.7,3C7.7,18.6,6.3,20.1,4.7,20.1 M17.3,22.9c3.5,1.3,6.8,2.6,10.2,3.9c3-1.3,6-2.5,9.1-3.8
  c-0.6-0.5-0.9-0.9-1.3-1.2c0-0.1,0.1-0.2,0.1-0.3c1.7,0,3.2,0.7,4.9,1.4c-4.3,1.8-8.5,3.5-12.8,5.3c-4.4-1.4-8.8-2.8-13.3-4.2
  c-2.4-6.2-4.8-12.4-7.3-18.9C8,4.9,9,4.6,10.1,4.4C12.5,10.6,14.9,16.7,17.3,22.9 M22.7,18.4v2.2c-1.6,0.5-3.1,1-4.8,1.5V7.7
  c3.5-0.8,7-1.7,10.5-2.5c0.4,3,0.7,5.7,1.1,8.4c-2.9,1.4-4.1,1.6-4.9,0.9c1.2-0.3,2.5-0.5,3.8-0.8V9.5c-1.8-0.1-3.5-0.4-5.3-0.4
  c-1.3,0-2.1,0.9-2.2,2.2c-0.1,1.8-0.1,3.6-0.1,5.3C20.6,18,21.6,18.3,22.7,18.4 M43.8,26.7C38.3,28.9,33,31,27.4,33.2
  c0.1-1.7,0.2-3.1,0.4-4.6c4.5-1.9,9.1-3.8,13.9-5.8C42.3,24,43,25.2,43.8,26.7 M25.6,3.2c-1.6,0.4-3,0.6-4.3,1.1
  c-3.1,1-6.1,1.1-9.1-0.1C11.1,3.8,9.8,3.6,8.6,4C6.4,4.7,4.3,4,1.8,3.4c0.7-0.3,1-0.5,1.4-0.6C6.5,1.9,9.7,1.1,13,0.2
  c0.6-0.1,1.2-0.3,1.8-0.1c3.4,0.8,6.8,1.7,10.2,2.6C25.2,2.8,25.3,3,25.6,3.2 M10.7,4.4c2.2,0.5,4,1,5.9,1.4
  c0.2,0.8,0.6,1.6,0.6,2.4c0.1,4,0,8,0,12c-0.1,0-0.2,0.1-0.3,0.1C14.9,15.2,12.9,10,10.7,4.4 M19.6,26.2c2.6,0.8,5,1.6,7.5,2.3
  c-0.1,1.5-0.2,3-0.3,4.8c-2.8-1-5.4-2.1-7.9-2.9C19.2,28.8,19.3,28,19.6,26.2 M35.1,23c-2.5,1-4.8,2-7.4,3.1
  c-0.1-1.8-0.2-3.3-0.3-5.1c2.1-0.6,4.2-1.3,6.3-1.9C34.2,20.4,34.7,21.6,35.1,23 M18.3,22.7c2.9-1.3,5.6-1.6,8.6-1.6v4.8
  C24,24.9,21.3,23.9,18.3,22.7 M23.4,20.9v-4.5c0.7-0.2,1.4-0.5,2.3-0.8c1,1.5,1.9,2.8,3,4.5C26.8,20.4,25.2,20.6,23.4,20.9
   M17.8,7.2c-0.2-0.5-0.4-0.8-0.7-1.3c3.6-0.8,7-1.6,10.5-2.4c0.2,0.4,0.4,0.7,0.6,1.2C24.7,5.5,21.3,6.3,17.8,7.2 M26,11.2
  c-0.1,0.8-0.2,1.3-0.3,2c-1.5-0.1-2.8-0.2-4.3-0.3v-2.1C22.9,10.9,24.3,11.1,26,11.2 M29.7,14.6c0.7-0.1,1.1-0.2,1.7-0.3
  c0.4,0.7,0.8,1.3,1.2,2c0.4,0.6,0.7,1.2,1.1,1.9c-0.5,0.2-0.8,0.4-1.3,0.6C31.5,17.4,30.7,16.1,29.7,14.6 M21.4,14.2h2.2
  c-0.5,1.3-0.9,2.4-1.4,3.5C20.9,17,20.7,16.3,21.4,14.2 M22.3,9.9c1.8-0.4,3.6-0.2,5.8,0.3C26.6,10.8,24.1,10.7,22.3,9.9 M27.8,11.2
  v2c-0.4,0.1-0.8,0.2-1.4,0.3v-2.1C26.9,11.3,27.3,11.3,27.8,11.2"></path>
                  </svg> </button>
                <div class="process_label">
                  Embedding & Microtomy
                </div>
              </div>
            </div>
          </div>
          <!-- Row 2 -->
          <div class="process">

            <div class="process-row mid">
              <div class="process-step" style="width:20%;">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown" style="margin-left: 7px; top:185px;"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Further Work</li>
                  </ul>

                </div>
                <div class="image-hide"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-empty-01.svg" style="width:40%; height:26%; margin:0 auto;"> </div>
                <div class="margin-mobile" style="margin-left: 40px;">
                  <button id="further-work" onclick="select_status('Further Work', this);"  type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="44.7px" height="44.7px" viewBox="0 0 44.7 44.7">
                      <path d="M44.7,20.7h-4.6C39.3,12.3,32.5,5.6,24,5V0h-3.3v5C12.5,5.9,6.1,12.5,5.4,20.7H0V24h5.4
  c0.8,8.1,7.2,14.7,15.4,15.7v5H24v-5c8.5-0.6,15.3-7.3,16.1-15.7h4.6V20.7z M24,36.4v-4.1h-3.3v4c-6.3-0.9-11.3-6-12-12.3h3.7v-3.3
  H8.7c0.7-6.4,5.7-11.5,12-12.4v4H24V8.3c6.7,0.6,12,5.8,12.8,12.5h-4.4V24h4.4C36,30.6,30.7,35.8,24,36.4z"></path>
                    </svg> </button>
                  <div class="process_label">
                    Further Work
                  </div>
                </div>
                <div class="margin-mobile" style="margin-left: 40px;"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-up-01.svg" style="width:40px; height:40%; margin:20px auto 0"> </div>
              </div>
              <div class="process-step"> </div>
              <div class="process-step" style="width:50%">
                <div class="process-scan">
                  <div class="row">
                    <div class="col-sm-12">
                      <h3 class="scanheading">Scan QR Code</h3>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group form-focus">
           <input type="text" class="form-control floating" style="text-align:center" value="<?php print $_GET['search']?>" autocomplete="off" id="qr-code-input">
                        <div class="not-found-qr"></div>
                        <label class="focus-label"></label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="process-step"> </div>
              <div class="process-step" style="width:20%">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown" style="top:115px"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Prepared slides are stained using auto-stainer interface</li>
                  </ul>

                </div>
                <div class=""> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-down-01.svg" style="width:40px; height:40%; margin:-60px auto 0"> </div>
                <div>
                  <button id="staining" onclick="select_status('Staining', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="17.3px" height="45.1px" viewBox="0 0 17.3 45.1">
                      <path d="M17.3,32.1c0,3.8,0,7.6,0,11.3c0,1.4-0.3,1.7-1.8,1.7c-4.6,0-9.2,0-13.8,0c-0.1,0-0.3,0-0.4,0
  C0.4,45,0.1,44.6,0,43.8c0-1.3,0-2.6,0-3.8c0-6.3,0-12.7,0-19c0-0.9,0.1-1.7,0.7-2.4c0.6-0.7,1.3-1.2,2.2-1.2c3.8,0,7.6,0,11.4,0
  c1.6,0,2.9,1.3,2.9,2.9c0,1.4,0,2.8,0,4.2C17.3,27,17.3,29.6,17.3,32.1 M16.7,21.6c-1-0.2-15.4-0.2-16,0c-0.2,1.3-0.1,17.8,0.1,18.5
  h15.9V21.6z M8.7,15.6c-1.7,0-3.4,0-5.1,0c-0.9,0-1.1-0.2-1.1-1.1c0-1,0-2.1,0-3.1c0-0.8,0.3-1.1,1.1-1.1c3.4,0,6.9,0,10.3,0
  c0.8,0,1.1,0.3,1.1,1.1c0,1,0,2.1,0,3.1c0,0.9-0.2,1.1-1.1,1.1C12.1,15.6,10.4,15.6,8.7,15.6 M12.3,9.8C11.6,10,5.8,10,5,9.8
  c0.3-1,0.6-2.1,0.9-3.1C6.5,4.8,7,2.9,7.6,1C7.9,0,8-0.1,9,0c0.4,0,0.6,0.2,0.8,0.6c0.9,3,1.8,6,2.6,9C12.4,9.6,12.3,9.7,12.3,9.8
   M13.3,30.9c0,2.6-2,4.6-4.6,4.6s-4.5-2-4.5-4.6s2-4.7,4.6-4.7C11.3,26.2,13.3,28.2,13.3,30.9 M8.7,28c-0.7,1.1-1.3,2.1-1.8,3.1
  c-0.4,0.8-0.2,1.8,0.5,2.3s1.9,0.5,2.6,0s1-1.5,0.5-2.3C10,30.1,9.4,29.2,8.7,28 M2.8,16.2h11.9v0.7H2.8V16.2z"></path>
                    </svg> </button>
                  <div class="process_label">
                    Staining
                  </div>

                </div>
                <div class=""> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-down-01.svg" style="width:40px; height:40%; margin:30px auto 0"> </div>
              </div>
            </div>
          </div>
          <!-- Row 3 -->
          <div class="process">
            <div class="column1"></div>
            <div class="column2"></div>
            <div class="column3b"></div>
            <div class="column4"></div>
            <div class="column5"></div>
            <div class="column6"></div>
            <div class="column7"></div>
            <div class="process-row">
              <div class="process-step">

                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Access digital dication files for macro description and pathologist review</li>
                    <li>Transcribe into patient report</li>
                    <li>Create Final Report for Signing, printing and distribution to external reporting systems</li>
                  </ul>
                </div>

                <button id="admin-support" onclick="select_status('Admin Support', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="37.9px" height="45.1px" viewBox="0 0 37.9 45.1">
                    <path d="M37.9,38.5c0,0.6-0.1,1.1-0.2,1.7c-0.2,0.9-0.7,1.7-1.4,2.3c-1.3,0.9-2.8,1.3-4.3,1.7c-2,0.4-4,0.6-6,0.7
  c-3.7,0.3-7.4,0.2-11.2,0.1c-3.2-0.1-6.4-0.3-9.5-1c-1.2-0.3-2.4-0.7-3.4-1.4C1,42,0.6,41.2,0.3,40.3c-0.1-0.2,0-0.4-0.1-0.5
  c-0.6-2.5,0.5-4.2,2.6-5.5c1.9-1.1,4-1.9,6.1-2.4c1.2-0.3,2.5-0.5,3.7-0.7c2.2,2,4.2,3.9,6.4,5.9c2.1-2,4.2-3.9,6.4-5.9
  c1,0.2,2,0.3,3.1,0.5c1.8,0.4,3.6,0.9,5.2,1.7c0.9,0.4,1.8,1,2.6,1.6C37.4,35.9,38,37,37.9,38.5 M19.1,27.9c-5.3,0-9.1-3.5-10.3-7.6
  c1,0.9,2.7,1.7,5.4,2c0.2,0.5,0.6,0.8,1.2,0.8c0.7,0,1.2-0.6,1.2-1.2c0-0.7-0.6-1.2-1.2-1.2c-0.5,0-0.8,0.2-1.1,0.6
  c-2.6-0.3-4-1.1-4.8-1.8c-0.6-0.5-0.9-1-1.1-1.3c0-0.3,0-0.5,0-0.8C8.5,11.5,13,6.7,19,6.7c6.7,0,10.8,5.5,10.7,10.6
  C29.9,22.4,25.7,27.8,19.1,27.9 M19,0c2.9,0.1,5.6,0.9,8,2.6c3.3,2.3,5.3,5.5,6.1,9.4c0.2,0.9,0.2,1.7,0.3,2.6
  c0,0.3,0.1,0.5,0.4,0.6c0.7,0.4,1.1,1.1,1.4,1.8c0.6,1.7,0.5,3.3-0.2,4.9c-0.2,0.5-0.6,0.9-1,1.2c-0.7,0.6-1.7,0.5-2.4-0.2
  c-0.5-0.5-0.8-1.1-1-1.8c-0.5-1.6-0.4-3.2,0.4-4.8c0.3-0.5,0.6-0.9,1.1-1.3c0.1,0,0.1-0.2,0.1-0.3c0-1.4-0.3-2.8-0.7-4.2
  c-0.7-1.7-1.7-3.4-3.1-4.9c-0.7-0.8-1.6-1.5-2.5-2.1c-1.8-1.2-3.7-1.9-5.8-2c-2.6-0.2-5,0.3-7.2,1.5c-1.2,0.7-2.3,1.5-3.3,2.6
  c-2,2.1-3.2,4.7-3.6,7.5c-0.1,0.6-0.1,1.3-0.2,1.9c0,0.3,0.2,0.3,0.3,0.4c0.5,0.3,0.8,0.8,1.1,1.3c0.4,0.9,0.6,1.8,0.6,2.8
  c0,1.1-0.2,2.1-0.9,3.1c-0.4,0.6-0.9,1-1.6,1.1c-0.4,0-0.8-0.1-1.2-0.3c-1.1-0.8-1.4-2-1.6-3.3C2.4,19,2.5,18,2.9,17
  c0.4-0.9,0.9-1.5,1.6-1.9c0.1,0,0.1-0.2,0.1-0.2c0.1-2,0.5-3.9,1.2-5.8C6.3,7.8,7,6.6,7.9,5.5c0.5-0.4,0.9-0.9,1.4-1.4
  c2-2,4.4-3.3,7.2-3.8C17.3,0.2,18.2,0.1,19,0"></path>
                  </svg> </button>
                <div class="process_label">
                  Admin Support
                </div>

              </div>
              <div class="process-step"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-left-01.svg" style="width:40px; height:40%; margin:0 auto"> </div>
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Slide review & reporting</li>
                    <li>SNOMED coding</li>
                    <li>Image management</li>
                    <li>Digital dication</li>
                    <li>Patient history look-up</li>
                    <li>Final Review & Sign Off</li>
                  </ul>
                </div>
                <button id="reporting" onclick="select_status('Reporting', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="43.8px" height="42.2px" viewBox="0 0 43.8 42.2">
                    <path d="M24.5,7.7c-0.2-0.3-0.1-0.8,0.2-1s0.8-0.1,1,0.2s0.1,0.8-0.2,1C25.2,8.1,24.7,8,24.5,7.7 M12.9,30.6H9.8
  C4.4,30.6,0,35,0,40.4v1.8h22.6v-1.8C22.7,35,18.3,30.6,12.9,30.6 M21.9,15.4c-0.3-0.2-0.8-0.2-1,0.1c-0.2,0.3-0.2,0.8,0.1,1
  c0.3,0.2,0.8,0.2,1-0.1S22.2,15.6,21.9,15.4z M31.1,11.1c0.2-0.3,0.1-0.8-0.3-1c-0.3-0.2-0.8-0.1-1,0.3c-0.2,0.3-0.1,0.8,0.3,1
  C30.4,11.6,30.9,11.5,31.1,11.1z M22.8,10.8c0.4,0,0.7-0.3,0.7-0.7c0-0.4-0.3-0.7-0.7-0.7c-0.4,0-0.7,0.3-0.7,0.7
  C22.1,10.5,22.4,10.8,22.8,10.8z M26.4,11.2c0.4,0,0.8-0.2,0.8-0.6c0.1-0.4-0.2-0.7-0.6-0.8c-0.4,0-0.8,0.2-0.8,0.6
  S26,11.2,26.4,11.2z M33.1,14.2c0.1,0,0.2-0.1,0.3-0.2c0.2-0.2,0.3-0.5,0.1-0.8c-0.1-0.3-0.5-0.5-0.9-0.4c-0.3,0.1-0.5,0.3-0.5,0.6
  c0,0.1,0,0.2,0.1,0.4C32.3,14.2,32.7,14.4,33.1,14.2z M29.8,14.6c0.3-0.3,0.3-0.7,0-1s-0.8-0.3-1,0c-0.3,0.3-0.2,0.8,0,1
  C29.1,14.9,29.6,14.8,29.8,14.6z M23.9,14.8c0,0.4,0.4,0.7,0.8,0.7c0.4,0,0.7-0.4,0.7-0.8c0-0.4-0.4-0.7-0.8-0.7
  C24.2,14,23.9,14.4,23.9,14.8z M23.7,17.8c-0.3,0.2-0.5,0.6-0.3,1c0.2,0.3,0.6,0.5,1,0.3c0.3-0.2,0.5-0.6,0.3-1
  C24.5,17.7,24,17.6,23.7,17.8z M42.7,0H6C5.4,0,4.9,0.5,4.9,1.1V17c-1.1,1.4-1.8,3.1-1.8,5c0,4.4,3.6,8,8,8c3.4,0,6.3-2.1,7.4-5.1
  h16.3v-0.6h-16c0.2-0.7,0.3-1.5,0.3-2.3c0-0.1,0-0.3,0-0.4h20.6c0.4,0,0.8-0.3,0.8-0.8V3.9c-0.1-0.5-0.4-0.8-0.9-0.8H9
  c-0.4,0-0.8,0.3-0.8,0.8v10.7c-1,0.4-1.9,1-2.7,1.8V1.1c0-0.2,0.2-0.4,0.5-0.5h36.6c0.3,0,0.5,0.2,0.5,0.5v22.8
  c0,0.3-0.2,0.5-0.5,0.5h-2.5V25h2.5c0.6,0,1.1-0.5,1.2-1.2V1.1C43.8,0.5,43.3,0,42.7,0z M23.7,20.2l-1.4-1.5l1-1.8l2,0.4l0.2,2
  L23.7,20.2z M25.5,16.3l-2-0.1l-0.5-2l1.7-1.1l1.6,1.3L25.5,16.3z M34.3,13.1L33.6,15l-2-0.2l-0.5-2l1.7-1L34.3,13.1z M29.3,9.4h2
  l0.6,1.9l-1.6,1.3l-1.6-1.2L29.3,9.4z M30.5,13l0.2,2l-1.9,0.8l-1.3-1.5l1-1.7L30.5,13z M28.1,10.5l-1,1.7l-1.9-0.4l-0.2-2L26.8,9
  L28.1,10.5z M24.4,5.8l2,0.4l0.2,2l-1.8,0.9l-1.4-1.5L24.4,5.8z M22.9,8.5l1.5,1.4l-0.8,1.8l-2-0.2l-0.4-2L22.9,8.5z M20.3,14.8
  l2-0.3l0.9,1.8l-1.4,1.5l-1.8-1L20.3,14.8z M38.4,24.6c0,0.6-0.5,1.1-1.1,1.1s-1.1-0.5-1.1-1.1s0.5-1.1,1.1-1.1S38.4,24,38.4,24.6
   M21.1,26.4h6.4V27h-6.4V26.4z M17.9,28.6h12.8v0.6H17.9V28.6z"></path>
                  </svg> </button>
                <div class="process_label">
                  Reporting
                </div>

              </div>
              <div class="process-step"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-left-01.svg" style="width:40px; height:40%; margin:20px auto 0"> </div>
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>Slide Scanner</li>
                  </ul>
                </div>
                <button id="slide-scanner" onclick="select_status('Slide Scanner', this);"  type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="43.3px" height="43.2px" viewBox="0 0 43.3 43.2">
                    <path d="M43.2,9c0-0.5-0.6-0.9-1.1-0.8c0,0.2,0,0.4,0,0.5c-1.4-0.3-2.7-0.6-4-0.9V7.7c0.5,0,0.9,0,1.4-0.1
  c0-0.1,0-0.1,0-0.2c-0.9,0.1-1.8,0.2-2.7,0.2c0,0.4-0.1,0.5-0.1,0.7c0,1,0.1,2,0.1,3c0,1.9-0.1,3.7,0,5.6c0.1,1.4,0.1,1.5-1.3,1.5
  c-3.7-0.1-7.5-0.2-11.2-0.4c-0.4,0-0.8,0-1.1,0c-0.7,0-1.3-0.1-2-0.2c0,0-0.1-0.1-0.2-0.3h2.2c0.1-0.2,0.2-0.3,0.3-0.4
  c0.1,0.1,0.2,0.2,0.3,0.3c0.6,0,0.9-0.4,0.9-0.9c0-2.1,0-4.3,0-6.4c0-0.8-0.5-1.8,0.7-2.3c0-0.1,0.1-0.2,0-0.3
  c-0.3-2.4-0.6-4.7-1-7.1c0-0.2-0.5-0.4-0.7-0.4c-1.7,0-3.3,0.1-5,0.1c-0.4,0-0.8,0-1.3,0.1c-0.3,2.3-0.7,4.5-1,6.8h5.1
  c-0.4,0.6-0.7,1.1-1,1.4c-0.5,0.4-1,1-1.5,1.1c-1.6,0.1-3.1,0-4.7,0c-0.3,0-0.8,0.2-0.9,0.5c-0.3,0.5-0.4,1.1-0.6,1.6
  c-0.2,0.6-0.2,1.4-0.9,1.6c-0.9,0.2-1.7,0.3-2.4,1c-0.1,0.1-0.2,0-0.4,0V7.7c0.5-0.2,1-0.3,1.4-0.4c0-0.1-0.1-0.1-0.1-0.2
  c-2,0.2-3.9,0.4-5.9,0.6c0,0.3,0,0.5,0,0.7c0,1.1,0,2.1-0.2,3.2C4,13.5,4,15.3,5.2,16.9c0.4,0.6,0.2,0.9-0.3,1.3
  c-0.2,0.1-0.4,0.3-0.5,0.5c0,0.1,0,0.2,0.1,0.3h4.6c0,0.1,0,0.2,0,0.4H3.2c-0.8-0.3-1.4,0.1-1.8,1.2c-0.3,0.8-0.6,1.7-0.7,2.6
  c-0.3,1.4-0.6,2.8-0.6,4.3c-0.1,2.3,0,4.6,0,6.9c0,2.1-0.1,4.1-0.1,6.4c0.1,0,0.5,0.2,0.9,0.2c2.9,0.2,5.7,0.4,8.6,0.6
  c2,0.1,4,0.3,5.9,0.4c0.7,0,1.4,0,2.1,0.1c2.4,0.2,4.8,0.4,7.2,0.6c2.5,0.2,4.9,0.2,7.4,0.5c1.5,0.1,2.9,0.1,4-1.1
  c0.2-0.2,0.4-0.3,0.5-0.4c0.9-0.8,1.9-1.5,2.4-2.6c0.2-0.6,0.6-1,0.9-1.6s0.7-1.2,0.7-1.7c0.1-3.6,0.2-7.2,0.2-10.7
  c0-0.8,0-1.7-0.3-2.5c-0.6-1.6-0.3-3,1-4.1c1-0.8,1.7-1.8,1.8-3.1C43.3,13.1,43.2,11,43.2,9z M9,17.7c-0.1-0.6,0.2-0.9,0.8-0.9
  c0.5,0,1,0.2,1.5,0.2c0.7,1,1.8,0.9,2.9,1.1c-0.2,0.1-0.2,0.2-0.3,0.3c-1.4,0.1-2.7,0.2-4.1,0.3C9.1,18.7,9,18.3,9,17.7z M12.9,19.4
  c-0.7,0.1-1.8,0.7-3,0.3c0-0.1,0-0.2,0-0.3H12.9z M33.1,26.8c-0.2,2-0.6,4-0.8,6c-0.2,1.9-0.4,3.7-0.7,5.6c-0.1,0.8-0.3,1.5-0.5,2.2
  c-0.1,0.2-0.4,0.5-0.7,0.5c-2.5,0.4-5.1,0.6-7.6,0.1c-1.1-0.2-2.1-0.6-3-0.9c-0.6-2.7-1.1-5.2-1.6-7.8L3.4,31.9
  c-1.1-0.1-2-1-1.9-2.1c0.1-1.1,0.9-1.9,2-1.9h0.1l14.3,0.7c0-0.8,0-1.5,0-2.3c0.1-2.2,0.3-4.3,1.2-6.4c0.1-0.3,0.8-0.6,1.3-0.6
  c4.1,0.1,8.2,0.3,12.3,0.4c0.4,0,0.7-0.1,1.1-0.1c0.2,0,0.4,0.1,0.7,0.1C33.3,22.2,33.3,24.5,33.1,26.8z M21,22.4l10.5,0.5
  c0,0-0.8,5.2-0.8,6.3l-10.3-0.3C20.4,28.9,20.3,23.3,21,22.4z"></path>
                  </svg> </button>
                <div class="process_label">
                  Slide Scanner
                </div>
              </div>
              <div class="process-step"> <img src="<?php echo base_url() ?>assets/img/processDiagram/arrow-left-01.svg" style="width:40px; height:40%; margin:0 auto"> </div>
              <div class="process-step">
                <div class="dropdown">
                  <button class="btn btn-trans dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></button>
                  <ul class="dropdown-menu paralist">
                    <li>QC check and issue to pathologist</li>
                  </ul>
                </div>
                <button id="quality-assurance" onclick="select_status('Quality Assurance', this);" type="button" class="btn btn-circle"> <svg x="0px" y="0px" width="45.2px" height="45.2px" viewBox="0 0 45.2 45.2">
                    <path d="M11.6,45.2L0,33.6L33.6,0l11.6,11.6L11.6,45.2z M3.6,33.6l8.1,8.1l30-30l-8.1-8.1L3.6,33.6z M20.2,20.6
  c0.9-1.3,1.8-1.5,2.4-1.4c1.1,0.2,1.4,0.4,2.4-0.2c0.7-0.5,2.7-0.8,2.4,0c-0.6,1.7-1.3,1.8-2.1,2.3C22.6,23,23.6,23.1,24,25
  c0.1,0.5,0,0.9-0.3,1.2c-0.7,0.8-2.1,0.4-2.4-0.6c-0.2-0.8-0.8-1.7-2.2-1.9c-1.2-0.1-1.5-0.9-1.5-1.8c0-1,1-1.6,1.9-1.2l0,0
  C19.9,20.9,20.1,20.8,20.2,20.6"></path>
                  </svg> </button>
                <div class="process_label">
                  Quality Assurance
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <div class="col-lg-4 pull-right" style="display:none;" id="dv_lab_rec_history">
        <div class="" id="requestWrap">
                       
          </div>
        <div class="qr_code_area">
          <!-- To be worked on future when dynamically generated QR code is displayed -->
          <div class="image hide" id="qrcode-container" style="display: none;">
            <img src="<?php echo base_url() ?>assets/img/qr_big.png" class="img-fluid">
          </div>
          <table class="table custom-table" id="record-history-table">
            <thead>
              <tr>
                <th id="record-history-table-heading" colspan="5" style="font-size: 20px; padding: 10px;">
                  Record History
                </th>
              </tr>
              <tr>
                <th>Ref:</th>
                <th>Date</th>
                <!-- <th>Time</th> -->
                <th>Status</th>
                <th>User ID</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <!-- End Process -->

    </div>
  </div>
</div>
<div class="modal fade" id="barcode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Barcode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class='row'>
            <div class='col-md-12 text-center' id='br_box_request'>
            <center style="text-align: left;min-height: 125px !important;width: 155px !important;overflow: hidden !important;">
                <div class='barcode_wrap' style="padding: 2px;border-radius: 5px;">    
                    <center>
                    <div class="d-flex" style="display: flex;align-items: center;justify-content: space-around;">
                       <img src="#" id="barcode_img" alt="Barcode" style='max-width: 55px !important;' >
                       <img src="assets/img/qrLogo.jpeg" class="qrlogo" style="max-width: 60px !important;max-height: 60px !important;object-fit: cover;" alt="Barcode">
                     </div>
                            <table style="font-size:10px !important;">
                            <!-- <tr style="line-height: 12px; "><td class='text-center' id='br_digi_number'></td></tr> -->
                            <tr style="line-height: 12px; "><td class='text-center' id='br_lab_number'></td></tr>
                            <tr style="line-height: 12px; "><td class='text-center' id='br_patient'></td></tr>
                            <tr style="line-height: 12px; "><td class='text-center' id='br_test'></td></tr>
                        </table>
                        </center>
                    </div>
                </div>
            </center>
            <div class='col-md-12 text-center hide' id='br_error_box'>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="javascript:print_barcode('br_box')" class="btn btn-primary">Print</a>
      </div>
    </div>
  </div>
</div>
<!-- /Page Content -->