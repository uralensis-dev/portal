<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
	.menu {
  filter: url("#goo");
}


.wrap{
  position:relative;
  width:80vmin; height:80vmin;
  margin:0 auto;
  background:inherit;
  transform:scale(0.2) translatez(0px);
  opacity:0;
  transition:transform .5s, opacity .5s;
}
.wrap a{
  position:absolute;
  left:0; top:0;
  width:47.5%; height:47.5%;
  overflow:hidden;
  transform:scale(.5) translateZ(0px);
  background:#585247;
}
.wrap a div{
  height:100%;
  background-size:cover;
  opacity:.5;
  transition:opacity .5s;
  border-radius:inherit;
}
.wrap a:nth-child(1){
  border-radius:40vmin 0 0 0;
  transform-origin: 110% 110%;
  transition:transform .4s .15s;
}
.wrap a:nth-child(1) div{
  background-image:url('https://farm3.staticflickr.com/2827/10384422264_d9c7299146.jpg');
}
.wrap a:nth-child(2){
  border-radius:0 40vmin 0 0;
  left:52.5%;
  transform-origin: -10% 110%;
  transition:transform .4s .2s;
}
.wrap a:nth-child(2) div{
  background-image:url('https://farm7.staticflickr.com/6083/6055581292_d94c2d90e3.jpg');
}
.wrap a:nth-child(3){
  border-radius:0 0 0 40vmin;
  top:52.5%;
  transform-origin: 110% -10%;
  transition:transform .4s .25s;
}
.wrap a:nth-child(3) div{
  background-image:url('https://farm7.staticflickr.com/6092/6227418584_d5883b0948.jpg');
}
.wrap a:nth-child(4){
  border-radius:0 0 40vmin 0;
  top:52.5%; left:52.5%;
  transform-origin: -10% -10%;
  transition:transform .4s .3s;
}
.wrap a:nth-child(4) div{
  background-image: url('https://farm8.staticflickr.com/7187/6895047173_d4b1a0d798.jpg');
}
.wrap a:nth-child(5){
  width:55%;height:55%;
  left:22.5%; top:22.5%;
  border-radius:50vmin;
  box-shadow:0 0 0 5vmin #E3DFD2;
  transform:scale(1);
}
.wrap a:nth-child(5) div{
  background-image: url('https://farm4.staticflickr.com/3766/12953056854_b8cdf14f21.jpg');
}
.new_wrap span{
  position:relative;
  display:block;
  margin:0 auto;
  top:45vmin;
  width:10vmin; height:10vmin;
  border-radius:100%;
  background:#585247;
  transform:translateZ(0px);
}
.new_wrap span span{
  position:absolute;
  width:60%;height:3px;
  background:#ACA696;
  left:20%; top:50%;
  border-radius:0;
}
.new_wrap span span:after, .new_wrap span span:before{
  content:'';
  position:absolute;
  left:0; top:-1.5vmin;
  width:100%; height:100%;
  background:inherit;
}
.new_wrap span span:after{
  top:1.5vmin;
}
.new_wrap span:hover + .wrap, .wrap:hover{
  transform:scale(.8) translateZ(0px);
  opacity:1;
}
.new_wrap span:hover + .wrap a, .wrap:hover a{
  transform:scale(1) translatez(0px);
}
.wrap a:hover div{
  opacity:1;
  transform:translatez(0px);
}

.menu-item, .menu-open-button {
  background: #00c5fb;
  color:#fff; 
  border-radius: 100%;
  width: 80px;
  height: 80px;
  margin-left: -40px;
  position: absolute;
  top: 20px;
  color: white;
  text-align: center;
  line-height: 80px;
  transform: translate3d(0, 0, 0);
  transition: transform ease-out 200ms;
  font-size: 30px;
}

.menu-open {
  display: none;
}

.hamburger {
  width: 25px;
  height: 3px;
  background: white;
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -12.5px;
  margin-top: -1.5px;
  transition: transform 200ms;
}

.hamburger-1 {
  transform: translate3d(0, -8px, 0);
}

.hamburger-2 {
  transform: translate3d(0, 0, 0);
}

.hamburger-3 {
  transform: translate3d(0, 8px, 0);
}

.menu-open:checked + .menu-open-button .hamburger-1 {
  transform: translate3d(0, 0, 0) rotate(45deg);
}
.menu-open:checked + .menu-open-button .hamburger-2 {
  transform: translate3d(0, 0, 0) scale(0.1, 1);
}
.menu-open:checked + .menu-open-button .hamburger-3 {
  transform: translate3d(0, 0, 0) rotate(-45deg);
}

.menu {
  position: absolute;
  left: 50%;
  margin-left: -190px;
  padding-top: 20px;
  padding-left: 190px;
  width: 380px;
  height: 250px;
  box-sizing: border-box;
  font-size: 20px;
  text-align: left;
  top: 90px;
}

.menu-item:hover {
  background: #04b3e3;
  color: #fff;
}
.menu-item:nth-child(3) {
  transition-duration: 180ms;
}
.menu-item:nth-child(4) {
  transition-duration: 180ms;
}
.menu-item:nth-child(5) {
  transition-duration: 180ms;
}
.menu-item:nth-child(6) {
  transition-duration: 180ms;
}
.menu-item:nth-child(7) {
  transition-duration: 180ms;
}
.menu-item:nth-child(8) {
  transition-duration: 180ms;
}
.menu-item:nth-child(9) {
  transition-duration: 180ms;
}

.menu-open-button {
  z-index: 2;
  transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
  transition-duration: 400ms;
  transform: scale(1.1, 1.1) translate3d(0, 0, 0);
  cursor: pointer;
}

.menu-open-button:hover {
  transform: scale(1.2, 1.2) translate3d(0, 0, 0);
}

.menu-open:checked + .menu-open-button {
  transition-timing-function: linear;
  transition-duration: 200ms;
  transform: scale(0.8, 0.8) translate3d(0, 0, 0);
}

.menu-open:checked ~ .menu-item {
  transition-timing-function: cubic-bezier(0.935, 0, 0.34, 1.33);
}
.menu-open:checked ~ .menu-item:nth-child(3) {
  transition-duration: 180ms;
  transform: translate3d(0.08361px, -104.99997px, 0);
}
.menu-open:checked ~ .menu-item:nth-child(4) {
  transition-duration: 280ms;
  transform: translate3d(104.99997px , 0, 0);
  /*transform: translate3d(90.9466px, -52.47586px, 0);*/
}
.menu-open:checked ~ .menu-item:nth-child(5) {
  transition-duration: 380ms;
  /*transform: translate3d(90.9466px, 52.47586px, 0);*/
  transform: translate3d(-104.99997px, 0 , 0);
}
.menu-open:checked ~ .menu-item:nth-child(6) {
  transition-duration: 480ms;
  transform: translate3d(0.08361px, 104.99997px, 0);
}
.menu-open:checked ~ .menu-item:nth-child(7) {
  transition-duration: 580ms;
  transform: translate3d(-90.86291px, 52.62064px, 0);
}
.menu-open:checked ~ .menu-item:nth-child(8) {
  transition-duration: 680ms;
  transform: translate3d(-91.03006px, -52.33095px, 0);
}
.menu-open:checked ~ .menu-item:nth-child(9) {
  transition-duration: 780ms;
  transform: translate3d(-0.25084px, -104.9997px, 0);
}
</style>
<div class="page-header">
    <input type="hidden" id="user_role_get" name="user_role_get" value="<?php echo $group_id; ?>">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Users</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url('auth/create_user'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> User</a>
        </div>
        <div class="col-auto float-right ml-auto">
            <a href="<?php echo base_url('auth/create_hospital'); ?>" class="btn add-btn"><i class="fa fa-plus"></i> Hospital</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
    <a href="javascript:;">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                <div class="dash-widget-info">
                    <h3>5</h3>
                    <span>Network</span>
                </div>
            </div>
        </div>
      </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
    <a href="javascript:;">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-hospital-o"></i></span>
                <div class="dash-widget-info">
                    <h3>20</h3>
                    <span>Hospital</span>
                </div>
            </div>
        </div>
        </a>
    </div>  
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
    <a href="javascript:;">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-medkit"></i></span>
                <div class="dash-widget-info">
                    <h3>20</h3>
                    <span>Laboratory</span>
                </div>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
    <a href="javascript:;">
        <div class="card dash-widget">
            <div class="card-body">
                <span class="dash-widget-icon"><i class="fa fa-medkit"></i></span>
                <div class="dash-widget-info">
                    <h3>04</h3>
                    <span>Cancer Service</span>
                </div>
            </div>
        </div>
        </a>
    </div>    
</div>

<!-- /Page Header -->
<!-- Search Filter -->
<div class="row filter-row">
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus name-select-container">
            <select class="form-control floating" name="user_name" id="select-name">

            </select>
            <label class="focus-label">Name</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus hospital-select-container">
            <select class="form-control floating" name="hospital" id="select-hospital">
                <option value="">Select Hospital</option>

            </select>
            <label class="focus-label">Hospital</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus role-select-container">
            <select class="form-control floating" name="groups" id="group-select">
                <option value="">Select Role</option>
            </select>
            <label class="focus-label">Role</label>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group form-focus select-focus org-select-container">
            <select class="form-control floating" name="organization" id="select-organization">
                <option value="">Select Organization</option>
            </select>
            <label class="focus-label">Organization</label>
        </div>
    </div>
    
</div>


<div class="row">
	<div class="col-md-12">
		<nav class="menu">
  <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open"/>
  <label class="menu-open-button" for="menu-open">
    <span class="hamburger hamburger-1"></span>
    <span class="hamburger hamburger-2"></span>
    <span class="hamburger hamburger-3"></span>
  </label>
  
  <a href="#" class="menu-item"> <i class="fa fa-building"></i> </a>
  <a href="#" class="menu-item"> <i class="fa fa-hospital-o"></i> </a>
  <a href="#" class="menu-item"> <i class="fa fa-medkit"></i> </a>
  <a href="#" class="menu-item"> <i class="fa fa-medkit"></i> </a>
  <!-- <a href="#" class="menu-item"> <i class="fa fa-cog"></i> </a> -->
  <!-- <a href="#" class="menu-item"> <i class="fa fa-ellipsis-h"></i> </a> -->
  
</nav>


<!-- filters -->
<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
    <defs>
      <filter id="shadowed-goo">
          
          <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
          <feGaussianBlur in="goo" stdDeviation="3" result="shadow" />
          <feColorMatrix in="shadow" mode="matrix" values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 1 -0.2" result="shadow" />
          <feOffset in="shadow" dx="1" dy="1" result="shadow" />
          <feComposite in2="shadow" in="goo" result="goo" />
          <feComposite in2="goo" in="SourceGraphic" result="mix" />
      </filter>
      <filter id="goo">
          <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation="10" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
          <feComposite in2="goo" in="SourceGraphic" result="mix" />
      </filter>
    </defs>
</svg>

	</div>
</div>



<div class="new_wrap"><span><span></span></span></div>
<div class="wrap">
  <a href="#"><div></div></a>
  <a href="#"><div></div></a>
  <a href="#"><div></div></a>
  <a href="#"><div></div></a>
  <a href="#"><div></div></a>
</div>