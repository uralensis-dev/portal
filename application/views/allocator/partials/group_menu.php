<div class="col-sm-12 col-md-3">
    <div class="roles-menu">
        <ul>
            <?php foreach ($groups as $group): 
                 if ($group->group_type == 'H') {
                ?>
                <li class="<?php echo  $hospital_id == $group->id ? "active":"";?>">
                    <a href="<?php echo  site_url("/allocator/$view/{$group->id}");?>"><?php echo  $group->description; ?></a>
                </li>
                 <?php } ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>