<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title mb-0">Group Menu</h4>
			</div>
			<div class="card-body">
				<?php if($editMode):?>
					<?php
						$attributes = array('method' => 'POST');
						echo form_open("menu/save/". $menuData['menu_id'], $attributes);
					?>
				<?php else:?>
					<?php
						$attributes = array('method' => 'POST');
						echo form_open("menu/save/", $attributes);
					?>
				<?php endif;?>
					<div class="form-group row">
						<label class="col-form-label col-md-2">Menu Name</label>
						<div class="col-md-10">
							<input type="text" class="form-control" name='menu_name' id='menu_name' value='<?php echo isset($menuData['menu_name'])?$menuData['menu_name']:"";?>'>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-form-label col-md-2">Menu for User Group</label>
						<div class="col-md-10">
							<select class="form-control" name='group_id' id='group_id' >
								<option>-- Select --</option>
								<?php foreach($groupList as $grp):?>
								<option 
									value="<?php echo $grp->id?>"
									<?php echo (isset($menuData['group_id']) && $menuData['group_id'] == $grp->id)?"selected":"";?>
								><?php echo $grp->name?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>