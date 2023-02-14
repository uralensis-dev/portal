<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row m-b-20">
					<div class="col-sm-12 text-right">
                        <?php $img = base_url('assets/img/default.jpg');
                        if(isset($labInfo->logo) && !empty($labInfo->logo) && file_exists(FCPATH.'uploads/logo/'.$labInfo->logo)){
                            $img = base_url('uploads/logo/').$labInfo->logo;
                        } ?>
                        <img style="max-height: 80px; width: auto;" class="hospital-logo-preview" src="<?= $img; ?>" alt="Logo">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-6 col-xl-6 m-b-20">
						<h3>TAX INVOICE</h3>
                        <ul class="list-unstyled">
                            <?php $pathologist = implode(' ', [$userInfo->enc_first_name, $userInfo->enc_last_name]); ?>
							<li><span><?= $pathologist; ?></span></li>
							<li><span>Attention: Dr. <?= $pathologist; ?></span></li>
                            <?php foreach ($userInfo->data as $address) { if($address['meta_key'] == 'work_street_address') { continue; } ?>
                                <li><span><?= str_replace(',', '<br>', $address['meta_value']); ?></span></li>
                            <?php }   ?>
						</ul>
					</div>
                    <div class="col-sm-2 col-lg-2 col-xl-2" style="padding: 0px;">
                        <ul class="list-unstyled">
                            <li><strong>Invoice Date</strong></li>
                            <li><span><?= date('d M, Y'); ?></span></li>
                            <li><hr style="margin: 5px 15px 5px 0px; border: lightblue 0.5px solid;"></li>
                            <li><strong>Invoice Number</strong></li>
                            <li><span id="invoice_number"><?= $invoiceNumber; ?></span></li>
                        </ul>
                    </div>
					<div class="col-sm-4 col-lg-4 col-xl-4 m-b-20">
						<ul class="list-unstyled">
                            <?php if(isset($labInfo)){ ?>
							<li><strong><?= $labInfo->lab_name; ?></strong></li>
							<li><span><?= str_replace(',', ',<br>', $labInfo->lab_address); ?></span></li>
							<li><span><?= $labInfo->lab_city; ?></span></li>
							<li><span><?= $labInfo->lab_state .', '. $labInfo->lab_post_code; ?></span></li>
                            <?php } ?>
						</ul>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
                                <th width="5%"><strong>#</strong></th>
								<th width="45%" class="d-none d-sm-table-cell"><strong>DESCRIPTION</strong></th>
                                <th width="15%" class="text-center"><strong>QUANTITY</strong></th>
                                <th width="15%" class="text-right"><strong>UNIT PRICE</strong></th>
								<th width="20%" class="text-right"><strong>AMOUNT(£)</strong></th>
							</tr>
						</thead>
						<tbody>
                        <?php
                            $total=0; $count=0; $quantity=0;
                            foreach ($result as $row){
                                $count++; $total = $total + $row['price_sum'];
                                $quantity = $quantity + $row['quantity'];
                        ?>
							<tr>
								<td><?= $count; ?></td>
								<td width="45%"><?= $row['bill_description']; ?></td>
                                <td width="15%" class="text-center"><?= $row['quantity']; ?></td>
                                <td width="15%" class="text-right"><?= '£'. number_format($row['bill_price'],2); ?></td>
                                <td width="20%" class="text-right"><?= '£'. number_format($row['price_sum'],2); ?></td>
							</tr>
                        <?php } ?>
						</tbody>
					</table>
				</div>
				<div>
					<div class="row m-b-20">
						<div class="col-sm-6"></div>
						<div class="col-sm-6">
                            <div class="table-responsive no-border">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td class="text-right"><?= '£'. number_format($total,2); ?></td>
                                    </tr>
                                    <!--<tr>
                                        <th>TOTAL VAT <span class="text-regular">(0%)</span></th>
                                        <?php /*$vat = ($total > 0) ? ($total * 100/100) : 0; */?>
                                        <td class="text-right"><?/*= '£'. number_format($vat,2); */?></td>
                                    </tr>-->
                                    <tr>
                                        <th>TOTAL GBP</th>
                                        <?php $final = $total; ?>
                                        <input type="hidden" id="quantity" value="<?= $quantity; ?>" />
                                        <input type="hidden" id="total_amount" value="<?= number_format($final,2); ?>" />
                                        <td class="text-right"><?= '£'. number_format($final,2); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
					<div class="invoice-info">
						<strong>Due Date: <?= date("d M Y", strtotime("+1 month", time())); ?></strong>
                        <p class="text-muted">
                            Payment should be made by bank transfer to the following account:<br>
                            <?= nl2br($payment_info); ?>
                        </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>