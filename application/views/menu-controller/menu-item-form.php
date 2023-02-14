<!-- Page Content -->
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
				<?php if($editMode):?>
                	<h3 class="page-title">Edit Menu Item For - "<?php echo $menuData['menu_name'];?>" - "<?php echo $menuData['name'];?>"</h3>
				<?php else:?>
                	<h3 class="page-title">Menu Item For - "<?php echo $menuData['menu_name'];?>" - "<?php echo $menuData['name'];?>"</h3>
				<?php endif;?>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo site_url("menu/list");?>">Menu</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo site_url("menu/itemList/".$menuData['menu_id']);?>">Menu Items List</a></li>
					<?php if($editMode):?>
	                    <li class="breadcrumb-item active">Edit Menu Item</li>
					<?php else:?>
						<li class="breadcrumb-item active">Menu Item</li>
					<?php endif;?>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<?php if($editMode):?>
					<h4 class="card-title mb-0">Edit Menu Item</h4>
				<?php else:?>
					<h4 class="card-title mb-0">Menu Item</h4>
				<?php endif;?>
			</div>
			<div class="card-body">
				<?php if($editMode):?>
					<?php
						$attributes = array('method' => 'POST');
						echo form_open("menu/saveMenuItem/". $menuData['menu_id']."/". $itemID, $attributes);
						?>
				<?php else:?>
					<?php
						$attributes = array('method' => 'POST');
						echo form_open("menu/saveMenuItem/". $menuData['menu_id']."/", $attributes);
					?>
				<?php endif;?>
					<div class="form-group row">
						<label class="col-form-label col-md-2">Item Name</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name='item_name' id='item_name' value='<?php echo isset($itemData['item_name'])?$itemData['item_name']:"";?>'>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-md-2">Item Link</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name='item_link' id='item_link' value='<?php echo isset($itemData['item_link'])?$itemData['item_link']:"";?>'>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-form-label col-md-2">Item Icon</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name='item_icon' id='item_icon' value='<?php echo isset($itemData['item_icon'])?$itemData['item_icon']:"";?>'>
						</div>
					</div>
					<input type='hidden' name='menu_id' value="<?php echo isset($menuID)?$menuID:"";?>"/>
					<?php if(isset($parentID) && $parentID!='0'){?>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Item Parent</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name='' id='' value='<?php echo isset($parentData['item_name'])?$parentData['item_name']:"";?>' readonly>
							</div>
						</div>
						<input type='hidden' name='menu_item_parent_id' value="<?php echo $parentID;?>"/>
					<?php }else{
						?>
						<div class="form-group row">
						<label class="col-form-label col-md-2">Item Parent</label>
						<div class="col-md-10">
							<select class="form-control" name='menu_item_parent_id' id='menu_item_parent_id' >
								<option>-- Select Parent--</option>
								<option value='0'>-- NO PARENT--</option>
								<?php foreach($itemsList as $item):?>
								<option 
									value="<?php echo $item->menu_item_id?>"
									<?php echo (isset($itemData['menu_item_parent_id']) && $itemData['menu_item_parent_id'] == $item->menu_item_id)?"selected":"";?>
								><?php echo $item->item_name?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
						<?php
					}?>
					
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>