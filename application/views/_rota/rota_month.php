<script type="text/javascript">
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    const d = new Date();
    var year = d.getFullYear();

</script>

<?php
$last_sunday = strtotime("last monday"); // Updated from Sunday to Monday
$last_sunday = date('w', $last_sunday) == date('w') ? $last_sunday + 7 * 86400 : $last_sunday;
$monday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +1 days"));
$tuesday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +2 days"));
$wednesday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +3 days"));
$thursday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +4 days"));
$friday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +5 days"));
$saturday = date("Y-m-d", strtotime(date("Y-m-d", $last_sunday) . " +6 days"));
$this_week_sd = date("Y-m-d", $last_sunday);
// echo "Current week start from  ";

$uri_segment = '';
if ($this->uri->segment(3) != '') {
    if ($this->uri->segment(3) == 'booking_in') {
        $uri_segment = 'Booking In';
    }
    if ($this->uri->segment(3) == 'cut_up') {
        $uri_segment = 'Cut Up';
    }
    if ($this->uri->segment(3) == 'embedding') {
        $uri_segment = 'Embedding';
    }
    if ($this->uri->segment(3) == 'sectioning') {
        $uri_segment = 'Sectioning';
    }
}
?>
<style>
    .list_rota .rota_pop:hover {
        background: azure;
    }
    .edit_btn:hover {
        cursor: pointer;
        background: #fff;
    }
    .custome_monthly_cal tr td{
        width: calc(100%/7);
        height: 250px;
    }
    .custome_monthly_cal tr td.disable{
        background: #f5f5f5;
        pointer-events: none;
    }
    .list_tasks{
        margin-top: -30px;
    }
    .list_tasks li{
        display: inline-block;
        font-size: 16px;
        float: left;
        width: 80%;
        text-align: left;
        position: relative;
        padding: 0px 10px;
        margin-bottom: 4px;
    }
    .list_tasks li.mdt_task, .list_tasks li.cut_up_task{
        border-color:gold;
    }
    .list_tasks li.holidays_hours{
        border-color:#55ce63;
    }
    .list_tasks li.sick_days{
        border-color:#55ce63;
    }
    .list_tasks li.over_time_task{
        border-color:#00c5fb;
    }
    .list_tasks li.username_show {
        background: #00c5fb;
        color: #fff;
        margin-bottom: 10px;
        padding: 3px 10px;
        font-size: 18px;
    }
    .list_tasks li.holidays_hours:after {
        content: "\f072";
        position: absolute;
        right: -10px;
        top: 0;
        font-family: fontawesome;
        color: #55ce63;
        border: 1px solid #55ce63;
        border-radius: 20px;
        width: 15px;
        height: 15px;
        line-height: 1.2;
        text-align: center;
    }
    .list_tasks li.sick_days:after {
        content: "\f2be";
        position: absolute;
        right: -10px;
        top: 0;
        font-family: fontawesome;
        color: #f62d51;
    }
    .list_tasks li.over_time_task:after {
        content: "\f067";
        position: absolute;
        right: -10px;
        top: 0;
        font-family: fontawesome;
        color: #00c5fb;
        border: 1px solid #00c5fb;
        border-radius: 20px;
        width: 15px;
        height: 15px;
        line-height: 1.2;
        text-align: center;
    }
    .list_tasks li.mdt_task:before, .list_tasks li.holidays_hours:before,
    .list_tasks li.sick_days:before, .list_tasks li.cut_up_task:before,
    .list_tasks li.over_time_task:before {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        background: gold;
        content: '';
        position: absolute;
        left: -10px;
        top: 2px;
    }
    .list_tasks li.holidays_hours:before{
        background: #55ce63;
    }
    .list_tasks li.sick_days:before{
        background: #f62d51;
    }
    .list_tasks li.over_time_task:before{
        background: #00c5fb;
    }
    @media screen and (min-width: 1600px) {
        .page-header .breadcrumb a, 
        .breadcrumb-item.active{font-size: 18px;}
    }
</style>
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Rota</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active">Rota</li>
            </ul>
        </div>
        <div class="col-auto float-right ml-auto">
            <a target="_blank" href="<?php echo  site_url('_rota/rota_inner_category') ?>" class="btn add-btn btn-rounded"><i class="fa fa-plus"></i> Rota Category</a>
        </div>
    </div>
</div>
<div class="row form-group">
    <div class="col-sm-4">
        From:  <strong>01 <?php echo date('M Y', strtotime($monday)) ?></strong><br> To:  <strong>31 <?php echo date('M Y', strtotime($monday)) ?></strong>
    </div>
    <div class="col-sm-4 text-center">
        <h3><strong><script type="text/javascript">
            document.write(monthNames[d.getMonth()]);
            document.write("<span style='margin-left:10px;'>" + year);
                </script></strong></h3>
    </div>
    <div class="col-sm-4 text-right">   
        <h3><strong>Today: </strong><?php echo  date('d M Y', strtotime(date('Y-m-d'))) ?></h3>
    </div>
    <div class="clearfix"></div>
    <input type="hidden" id="base_url" value="<?php echo  site_url('_rota/rota') ?>">

</div>

<div class="row">
   <!--  <div class="col-lg-3">
        <ul class="main-list">
            <p>Hospital Knightbridge</p>
            <p>Pathologists</p>
            <li class="active">
                <a href="#">Team Dermatopatholgy <span class="fa fa-chevron-down pull-right"></span></a>
                <ul class="children">
                    <li>
                        <a href="#">Bobby Hill</a>
                    </li>
                    <li><a href="#">Jeffery Powel</a></li>
                    <li><a href="#">Dr. Iskander</a></li>
                    <li><a href="#">Dr. Chaudhry</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Team Uropathology <span class="fa fa-chevron-down pull-right"></span></a>
                <ul class="children">
                    <li><a href="#">Bobby Hill</a></li>
                    <li><a href="#">Jeffery Powel</a></li>
                    <li><a href="#">Dr. Iskander</a></li>
                    <li><a href="#">Dr. Chaudhry</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Team Breast <span class="fa fa-chevron-down pull-right"></span></a>
                <ul class="children">
                    <li><a href="#">Bobby Hill</a></li>
                    <li><a href="#">Jeffery Powel</a></li>
                    <li><a href="#">Dr. Iskander</a></li>
                    <li><a href="#">Dr. Chaudhry</a></li>
                </ul>
            </li>
        </ul>

        

    </div> -->
    <div class="col-md-12">
        <div class="card new_card">
            <div class="card-header" id="headingOne">
                <div class="row">
                    <div class="col-sm-12" style="border-bottom: 1px solid #ddd;">
                        <div class="main-list" style="padding: 5px 0; text-transform: capitalize;">
                            <p class="mb-0 pull-left"><?php echo  get_user_group_name($this->ion_auth->user()->row()->id); ?></p>
                            <!--<p class="mb-0 text-right pull-right">Pathologist</p>-->
                            <div class="clearfix"></div> 
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3" style="border-right: 1px solid #ddd; padding-top: 10px;">
                        <!--<p><input type="text" name="" class="form-control" placeholder="Search Team"></p>-->
                        <p>
                            <select name="search_team" id="team_id" class="form-control">
                                <option value="">Select Team</option>
                                <?php
                                foreach (getTeamsByGroupId('', '', $uri_segment) as $team) {
                                    $selection = "";
                                    if ($team['team_id'] == $this->uri->segment(4)) {
                                        $selection = "selected='selected'";
                                    }
                                    echo "<option $selection  value='" . $team['team_id'] . "'>" . $team['team_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="col-sm-9 bg-white">
                        <ul class="list_rota day_wise list-unstyled">
                            <li class="list-item">Tuesday<p><?php echo  date('d M Y', strtotime($monday)) ?></p></li>
                        </ul>
                    </div>   
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered custome_monthly_cal">
                    <thead class="text-center">
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>

                    <tbody class="text-right">
                        <tr>
                            <td class="disable">29</td>
                            <td class="disable">30</td>
                            <td>1
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Iskandar Ch.</span>
                                    </li>
                                    <li class="list-item mdt_task">
                                        <div class="desc">MDT</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item holidays_hours">
                                        <div class="desc">Holiday Hours</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item sick_days">
                                        <div class="desc">Sick Days</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>2</td>
                            <td>3
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Bobby Hill</span>
                                    </li>
                                    <li class="list-item cut_up_task">
                                        <div class="desc">Cut Up</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item over_time_task">
                                        <div class="desc">Over Time</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>4</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Jeffrey Powel</span>
                                    </li>
                                    <li class="list-item cut_up_task">
                                        <div class="desc">Cut Up</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item over_time_task">
                                        <div class="desc">Over Time</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>14</td>
                            <td>15
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Iskandar </span>
                                    </li>
                                    <li class="list-item cut_up_task">
                                        <div class="desc">Cut Up</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item holidays_hours">
                                        <div class="desc">Over Time</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>16</td>
                            <td>17</td>
                            <td>18</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>21</td>
                            <td>22</td>
                            <td>23</td>
                            <td>24
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Jeffrey Powel</span>
                                    </li>
                                    <li class="list-item mdt_task">
                                        <div class="desc">MDT</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item holidays_hours">
                                        <div class="desc">Holiday Hours</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                    <li class="list-item sick_days">
                                        <div class="desc">Sick Days</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>25</td>
                            <td>26</td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>28</td>
                            <td>29
                                <ul class="list-unstyled list_tasks">
                                    <li class="list-item username_show">
                                        <span>Dr. Bobby</span>
                                    </li>
                                    <li class="list-item holidays_hours">
                                        <div class="desc">Holiday Hours</div>
                                        <div><span>12:00</span> to <span>13:50</span></div>
                                    </li>
                                </ul>
                            </td>
                            <td>30</td>
                            <td>31</td>
                            <td class="disable">1</td>
                            <td class="disable">2</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

