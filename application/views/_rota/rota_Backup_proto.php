<style>
    table {
        width:100%;
        margin: 20px;
    }
    table .tbl_frst_col {
        background: yellow;
    }
</style>
<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Rota</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
                <li class="breadcrumb-item active">Rota</li>
            </ul>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-1">
        <h2 style="margin-top:20px">Filters</h2>
    </div>
    <div class="col-sm-2">   
        <label>Date:</label>
        <input type="date" class="form-control">
       </div>
    <div class="col-sm-2"> 
        <label>Time:</label>
            <input type="time" class="form-control">      
   </div>
    <div class="col-sm-2"> 
        <label>Teams:</label>
            <input type="text" class="form-control">      
   </div>
    <div class="col-sm-2"> 
        <label>Member:</label>
            <input type="text" class="form-control">      
   </div>
    <div class="col-sm-3 text-center" style="margin-top:20px"> 
        <input type="submit" value="Search" class="btn btn-primary">      
            <a href="#" class="btn btn-success"> Reset </a>     
            <a href="#" class="btn btn-warning"> Print </a>     
   </div>
</div>
<div class="row">
    <table border="1" cellpadding="10">
        <tr class='tbl_frst_col'>
            <th>Week Commencing {date}</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Gastro</td>
            <td>Joanna <br> Pamballi/Francesca <br> Mcdowell/Tim <br> Andrew</td>
            <td>Joanna <br> Pamballi/Francesca <br> Mcdowell/Fiona <br> Campbell</td>
            <td>Christine <br> Estlin/Susan <br> Macpherson</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Skin</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Gynae</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Breast</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Urology</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Small Routine</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>CTC</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>H&N</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>O&ST</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
        <tr>
            <td class='tbl_frst_col'>Death Certification</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
            <td>{data}</td>
        </tr>
    </table>
</div>
