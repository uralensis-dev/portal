<ul>
<?php foreach($menuArr as $zeroLevelItem):?>
    <?php if($zeroLevelItem['link']!=''):?>
        <li class="menu-title"><span><a href='<?php echo site_url($zeroLevelItem['link'])?>'><?php echo ($zeroLevelItem['icon']!='')?"<i class='".$zeroLevelItem['icon']."'></i>":"";?><?php echo $zeroLevelItem['name']?></a></span>
    <?php else:?>
        <li class="menu-title"><span><?php echo ($zeroLevelItem['link']!='')?"<i class='".$zeroLevelItem['icon']."'></i>":"";?><?php echo $zeroLevelItem['name']?></span>
    <?php endif;?>
    
    <?php if(!empty($zeroLevelItem['items'])):?>
        <li class="submenu">
            <?php foreach($zeroLevelItem['items'] as $subItems):?>
                <?php if(!empty($subItems['items'])):
                        $data['subItems'] = $subItems;
                        echo $this->load->view('menu-controller/frnt-end-sub-menu',$data,true);
                    ?>
                <?php else:?>
                    <a href="<?php echo ($subItems['link']!='')?site_url($subItems['link']):"#"; ?>"><i class="<?php echo $subItems['icon']; ?>"></i> <span><?php echo $subItems['name']; ?></span></a>
                <?php endif;?>
            <?php endforeach;?> 
        </li>
    <?php endif;?>
<?php endforeach;?>
</ul>