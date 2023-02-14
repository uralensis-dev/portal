<a href="<?php echo ($subItems['link']!='')?site_url($subItems['link']):"#"; ?>"><?php echo ($subItems['icon']!='')?"<i class='".$subItems['icon']."'></i>":""; ?><span><?php echo $subItems['name']; ?><span class="menu-arrow"></span></a>
<ul style="display: none;">
<?php  

 foreach($subItems['items'] as $subSubItems):?>
    <?php if(!empty($subSubItems['items'])):
                $data['subItems'] = $subSubItems;
                echo $this->load->view('menu-controller/frnt-end-sub-menu',$data,true);
            ?>
    <?php else:?>
        <li><a href="<?php echo ($subSubItems['link']!='')?site_url($subSubItems['link']):"#"; ?>"><?php echo ($subSubItems['icon']!='')?"<i class='".$subSubItems['icon']."'></i>":""; ?> <span><?php echo $subSubItems['name']; ?></span></a></li>
    <?php endif;?>
<?php endforeach;?>
</ul>
