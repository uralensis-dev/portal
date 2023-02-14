<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
    <?php
    $cnt = 0;
    foreach ($test_sub_categories["main_cat"] as $mainKey => $mainValue) {
        $cnt++;
        ?>
        <li class="nav-item"><a class="nav-link <?php echo ($cnt == 1 ? 'active' : ''); ?>" href="#solid-rounded-tab<?php echo $mainValue["main_cat_id"]; ?>" data-toggle="tab"><?php echo $mainValue["main_cat_name"]; ?></a></li>
    <?php } ?>

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
    <?php
    $t = 0;
    foreach ($test_sub_categories["main_cat"] as $catKey => $catValue)
    {
        ?>
        <?php foreach ($catValue["sub_cat"] as $subKey => $suBValue) { $t++; ?>
        <div class="tab-pane <?php echo ($t == 1 ? 'show active' : ''); ?>" id="solid-rounded-tab<?php echo $t; ?>">
            <div class="form-group">
                <h4 style="display:none"><?php echo $suBValue["sub_cat_name"]; ?>:</h4>
                <ul class="qucikSearch">
                    <?php
                    foreach ($suBValue["tests"] as $subTestKey => $subTestValue)
                    { ?>
                        <li><a href="javascript:;" title="<?php echo $subTestValue["test_desction"]; ?>" data-id="<?php echo $subTestValue["test_id"]; ?>" class="btn btn-info btn-block"><?php echo $subTestValue["test_name"]; ?></a></li>
                    <?php } ?> <div style="clear:both;"></div>
                    <br>
                </ul>
            </div>
        </div>
    <?php } ?>
    <?php } ?>
</div>