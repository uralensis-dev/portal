<div class="tg-dbsectionspace tg-haslayout">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-dashboardbox inner-page-content">
            <div class="form-group">
                <label for="hospital_id">Select Hospital to view Incident Reports</label>
                <select name="incident_hopsital_group_id" class="form-control incident_hopsital_group_id">
                    <option value="false">Choose Hospital</option>
                    <?php
                    if (!empty($hospitals_list)) {
                        foreach ($hospitals_list as $hospitals) {
                            echo '<option value="' . $hospitals->id . '">' . $hospitals->description . '</option> ';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <div class="hospital_users_incident"></div>
                <br>
                <div class="hospital_incident_reports"></div>
            </div>
            </div>
        </div>
    </div>
</div>