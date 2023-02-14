<html>
<head>
    <title><?= "Invoice_$invoiceNumber"; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row m-b-20">
                        <div class="col-sm-12" style="text-align: right;">
                            <?php
                            //$img_path = base_url('assets/img/default.jpg');
                            $img_path = $_SERVER["DOCUMENT_ROOT"] . "/assets/img/default.jpg";
                            if(isset($labInfo->logo) && !empty($labInfo->logo) && file_exists(FCPATH.'uploads/logo/'.$labInfo->logo)){
                                $img_path = $_SERVER["DOCUMENT_ROOT"] . "/uploads/logo/$labInfo->logo";
                                //$logo = getcwd(). "/uploads/logo/$labInfo->logo";
                                //$logo = base_url('uploads/logo/').$labInfo->logo;
                                //$logo = FCPATH.'uploads/logo/'.$labInfo->logo;
                            }
                            $type = pathinfo($img_path, PATHINFO_EXTENSION);
                            $data = file_get_contents($img_path);
                            $logo = "data:image/$type;base64, ".base64_encode($data);
                            ?>
                            <img src="<?= $logo; ?>" height="100" style="max-height: 100px; width: auto;"/>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" width="100%">
                            <thead>
                                <th width="50%" style="text-align: left;"></th>
                                <th width="15%" style="text-align: left;"></th>
                                <th width="35%" style="text-align: left;"></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="50%" style="text-align: left;">
                                        <h3>TAX INVOICE</h3>
                                        <?php $pathologist = implode(' ', [$userInfo->enc_first_name, $userInfo->enc_last_name]); ?>
                                        <span><?= $pathologist; ?></span></br>
                                        <span>Attention: Dr. <?= $pathologist; ?></span></br>
                                        <?php foreach ($userInfo->data as $address) { if($address['meta_key'] == 'work_street_address') { continue; } ?>
                                            <span><?= str_replace(',', '<br>', $address['meta_value']); ?></span></br>
                                        <?php } ?>
                                    </td>
                                    <td width="20%" style="text-align: left;">
                                        <strong>Invoice Date</strong></br>
                                        <span><?= date('d M, Y'); ?></span></br>
                                        <hr style="margin: 5px 15px 5px 0px; border: lightblue 0.5px solid;"></br>
                                        <strong>Invoice Number</strong></br>
                                        <span id="invoice_number"><?= $invoiceNumber; ?></span></br>
                                    </td>
                                    <td width="30%" style="text-align: left;">
                                        <?php if(isset($labInfo)){ ?>
                                            <strong><?= $labInfo->lab_name; ?></strong></br>
                                            <span><?= str_replace(',', ',<br>', $labInfo->lab_address); ?></span></br>
                                            <span><?= $labInfo->lab_city; ?></span></br>
                                            <span><?= $labInfo->lab_state .', '. $labInfo->lab_post_code; ?></span></br>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" width="100%">
                            <thead>
                            <tr>
                                <th width="5%" style="text-align: left;"><strong>#</strong></th>
                                <th width="45%" style="text-align: left;"><strong>DESCRIPTION</strong></th>
                                <th width="15%" style="text-align: center;"><strong>QUANTITY</strong></th>
                                <th width="15%" style="text-align: right;"><strong>UNIT PRICE</strong></th>
                                <th width="20%" style="text-align: right;"><strong>AMOUNT(£)</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $count=0; foreach ($result as $row){ $count++; $total = $total + $row['price_sum']; ?>
                                <tr>
                                    <td width="5%" style="text-align: left;"><?= $count; ?></td>
                                    <td width="45%" style="text-align: left;"><?= $row['bill_description']; ?></td>
                                    <td width="15%" style="text-align: center;"><?= $row['quantity']; ?></td>
                                    <td width="15%" style="text-align: right;"><?= '£'. number_format($row['bill_price'],2); ?></td>
                                    <td width="20%" style="text-align: right;"><?= '£'. number_format($row['price_sum'],2); ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <br><hr style="border: lightblue 0.5px solid;"></br>
                    <div>
                        <div class="row m-b-20">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div class="table-responsive no-border">
                                    <table class="table mb-0" width="100%" style="text-align: right;">
                                        <tbody>
                                        <tr>
                                            <th style="text-align: right;">Subtotal</th>
                                            <td style="text-align: right;"><?= '£'. number_format($total,2); ?></td>
                                        </tr>
                                        <!--<tr>
                                            <th style="text-align: right;">TOTAL VAT <span class="text-regular">(20%)</span></th>
                                            <?php /*$vat = ($total > 0) ? ($total * 20/100) : 0; */?>
                                            <td style="text-align: right;"><?/*= '£'. number_format($vat,2); */?></td>
                                        </tr>-->
                                        <tr>
                                            <th style="text-align: right;">TOTAL GBP</th>
                                            <?php $final = $total; ?>
                                            <td style="text-align: right;"><?= '£'. number_format($final,2); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <br><hr style="border: lightblue 0.5px solid;"></br>
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
</body>
</html>