<div class="card">
 			<div class="row d-block">
 				<div class="col-lg-6">
 					<h3 class="page-title">Patient's Personal Information <i class="fa fa-user"></i></h3>
 				</div>
 				<div class="btns-cont">
 					<div class="form-group">
 						<div class="input-group">
 							<span class="input-group-text" id="basic-addon1">
 								<i class="fa fa-search"></i>

 							</span>
 							<input class="form-control" />
 						</div>
 					</div>
 					<div class="form-group">
 						<button type="submit" class="btn btn-success btn-lg btn-block"> Search </button>
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3">
 					<label for="inputSysNo">Sys. no. <span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control-plaintext" value="ptn001" id="inputSysNo" name="inputSysNo" placeholder="Sys. No." readonly>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientFirstName">First Name<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientFirstName" name="firstName" placeholder="First Name" required>
 					<div class="invalid-feedback">
 						Please provide first name.
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientLastName">Last Name<span style="color: red;">*</span></label>
 					<input type="text" class="form-control" id="inputPatientLastName" name="lastName" placeholder="Last Name" required>
 					<div class="invalid-feedback">
 						Please provide last name.
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputGender">Gender<span style="color: red;">*</span></label>
 					<input type="text" class="form-control" id="inputGender" name="gender" placeholder="Gender" required>
 					<div class="invalid-feedback">
 						Please provide Gender
 					</div>
 				</div>
 			</div>

 			<div class="row">
 				<div class="form-group col-md-3">
 					<label for="inputAge">Age </label>
 					<input type="number" aria-describedby="required-description" class="form-control" id="inputAge" name="inputAge" placeholder="Age">

 				</div>
 				<div class="form-group col-md-3">
 					<label class="focus-label">Date of Birth</label>
 					<div class="cal-icon">
 						<input id="dateOfBirth" placeholder="Date Of Birth" name="patientDateOfBirth" class="form-control datetimepicker" type="text">
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<a href="#" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#addressCollapse" aria-controls="addressCollapse" aria-expanded="false" aria-label="Toggle Details">More</a>
 				</div>
 			</div>
 			<div id="addressCollapse" class="row collapse">
 				<div class="form-group col-md-6">
 					<label for="inputPatientAddress1">Address Line 1<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientAddress1" name="inputPatientAddress1" placeholder="Address Line 1" required>

 				</div>
 				<div class="form-group col-md-6">
 					<label for="=inputPatientAddress2">Address Line 2 </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="=inputPatientAddress2" name="=inputPatientAddress2" placeholder="Address Line 2" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientCity">City<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientCity" name="inputPatientCity" placeholder="City" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientState">State/Province<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientState" name="inputPatientState" placeholder="State" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientZip">Zip/Postal Code<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientZip" name="inputPatientZip" placeholder="Zip/Postal Code" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientCountry">Country</label>
 					<select name="tax" id="inputPatientCountry" class="form-control selectTaxt" required tabindex="-1" aria-hidden="true">
 						<option value="" disabled selected>-Select-</option>
 						<option value="Afganistan">Afghanistan</option>
 						<option value="Albania">Albania</option>
 						<option value="Algeria">Algeria</option>
 						<option value="American Samoa">American Samoa</option>
 						<option value="Andorra">Andorra</option>
 						<option value="Angola">Angola</option>
 						<option value="Anguilla">Anguilla</option>
 						<option value="Antigua & Barbuda">Antigua & Barbuda</option>
 						<option value="Argentina">Argentina</option>
 						<option value="Armenia">Armenia</option>
 						<option value="Aruba">Aruba</option>
 						<option value="Australia">Australia</option>
 						<option value="Austria">Austria</option>
 						<option value="Azerbaijan">Azerbaijan</option>
 						<option value="Bahamas">Bahamas</option>
 						<option value="Bahrain">Bahrain</option>
 						<option value="Bangladesh">Bangladesh</option>
 						<option value="Barbados">Barbados</option>
 						<option value="Belarus">Belarus</option>
 						<option value="Belgium">Belgium</option>
 						<option value="Belize">Belize</option>
 						<option value="Benin">Benin</option>
 						<option value="Bermuda">Bermuda</option>
 						<option value="Bhutan">Bhutan</option>
 						<option value="Bolivia">Bolivia</option>
 						<option value="Bonaire">Bonaire</option>
 						<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
 						<option value="Botswana">Botswana</option>
 						<option value="Brazil">Brazil</option>
 						<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
 						<option value="Brunei">Brunei</option>
 						<option value="Bulgaria">Bulgaria</option>
 						<option value="Burkina Faso">Burkina Faso</option>
 						<option value="Burundi">Burundi</option>
 						<option value="Cambodia">Cambodia</option>
 						<option value="Cameroon">Cameroon</option>
 						<option value="Canada">Canada</option>
 						<option value="Canary Islands">Canary Islands</option>
 						<option value="Cape Verde">Cape Verde</option>
 						<option value="Cayman Islands">Cayman Islands</option>
 						<option value="Central African Republic">Central African Republic</option>
 						<option value="Chad">Chad</option>
 						<option value="Channel Islands">Channel Islands</option>
 						<option value="Chile">Chile</option>
 						<option value="China">China</option>
 						<option value="Christmas Island">Christmas Island</option>
 						<option value="Cocos Island">Cocos Island</option>
 						<option value="Colombia">Colombia</option>
 						<option value="Comoros">Comoros</option>
 						<option value="Congo">Congo</option>
 						<option value="Cook Islands">Cook Islands</option>
 						<option value="Costa Rica">Costa Rica</option>
 						<option value="Cote DIvoire">Cote DIvoire</option>
 						<option value="Croatia">Croatia</option>
 						<option value="Cuba">Cuba</option>
 						<option value="Curaco">Curacao</option>
 						<option value="Cyprus">Cyprus</option>
 						<option value="Czech Republic">Czech Republic</option>
 						<option value="Denmark">Denmark</option>
 						<option value="Djibouti">Djibouti</option>
 						<option value="Dominica">Dominica</option>
 						<option value="Dominican Republic">Dominican Republic</option>
 						<option value="East Timor">East Timor</option>
 						<option value="Ecuador">Ecuador</option>
 						<option value="Egypt">Egypt</option>
 						<option value="El Salvador">El Salvador</option>
 						<option value="Equatorial Guinea">Equatorial Guinea</option>
 						<option value="Eritrea">Eritrea</option>
 						<option value="Estonia">Estonia</option>
 						<option value="Ethiopia">Ethiopia</option>
 						<option value="Falkland Islands">Falkland Islands</option>
 						<option value="Faroe Islands">Faroe Islands</option>
 						<option value="Fiji">Fiji</option>
 						<option value="Finland">Finland</option>
 						<option value="France">France</option>
 						<option value="French Guiana">French Guiana</option>
 						<option value="French Polynesia">French Polynesia</option>
 						<option value="French Southern Ter">French Southern Ter</option>
 						<option value="Gabon">Gabon</option>
 						<option value="Gambia">Gambia</option>
 						<option value="Georgia">Georgia</option>
 						<option value="Germany">Germany</option>
 						<option value="Ghana">Ghana</option>
 						<option value="Gibraltar">Gibraltar</option>
 						<option value="Great Britain">Great Britain</option>
 						<option value="Greece">Greece</option>
 						<option value="Greenland">Greenland</option>
 						<option value="Grenada">Grenada</option>
 						<option value="Guadeloupe">Guadeloupe</option>
 						<option value="Guam">Guam</option>
 						<option value="Guatemala">Guatemala</option>
 						<option value="Guinea">Guinea</option>
 						<option value="Guyana">Guyana</option>
 						<option value="Haiti">Haiti</option>
 						<option value="Hawaii">Hawaii</option>
 						<option value="Honduras">Honduras</option>
 						<option value="Hong Kong">Hong Kong</option>
 						<option value="Hungary">Hungary</option>
 						<option value="Iceland">Iceland</option>
 						<option value="Indonesia">Indonesia</option>
 						<option value="India">India</option>
 						<option value="Iran">Iran</option>
 						<option value="Iraq">Iraq</option>
 						<option value="Ireland">Ireland</option>
 						<option value="Isle of Man">Isle of Man</option>
 						<option value="Israel">Israel</option>
 						<option value="Italy">Italy</option>
 						<option value="Jamaica">Jamaica</option>
 						<option value="Japan">Japan</option>
 						<option value="Jordan">Jordan</option>
 						<option value="Kazakhstan">Kazakhstan</option>
 						<option value="Kenya">Kenya</option>
 						<option value="Kiribati">Kiribati</option>
 						<option value="Korea North">Korea North</option>
 						<option value="Korea Sout">Korea South</option>
 						<option value="Kuwait">Kuwait</option>
 						<option value="Kyrgyzstan">Kyrgyzstan</option>
 						<option value="Laos">Laos</option>
 						<option value="Latvia">Latvia</option>
 						<option value="Lebanon">Lebanon</option>
 						<option value="Lesotho">Lesotho</option>
 						<option value="Liberia">Liberia</option>
 						<option value="Libya">Libya</option>
 						<option value="Liechtenstein">Liechtenstein</option>
 						<option value="Lithuania">Lithuania</option>
 						<option value="Luxembourg">Luxembourg</option>
 						<option value="Macau">Macau</option>
 						<option value="Macedonia">Macedonia</option>
 						<option value="Madagascar">Madagascar</option>
 						<option value="Malaysia">Malaysia</option>
 						<option value="Malawi">Malawi</option>
 						<option value="Maldives">Maldives</option>
 						<option value="Mali">Mali</option>
 						<option value="Malta">Malta</option>
 						<option value="Marshall Islands">Marshall Islands</option>
 						<option value="Martinique">Martinique</option>
 						<option value="Mauritania">Mauritania</option>
 						<option value="Mauritius">Mauritius</option>
 						<option value="Mayotte">Mayotte</option>
 						<option value="Mexico">Mexico</option>
 						<option value="Midway Islands">Midway Islands</option>
 						<option value="Moldova">Moldova</option>
 						<option value="Monaco">Monaco</option>
 						<option value="Mongolia">Mongolia</option>
 						<option value="Montserrat">Montserrat</option>
 						<option value="Morocco">Morocco</option>
 						<option value="Mozambique">Mozambique</option>
 						<option value="Myanmar">Myanmar</option>
 						<option value="Nambia">Nambia</option>
 						<option value="Nauru">Nauru</option>
 						<option value="Nepal">Nepal</option>
 						<option value="Netherland Antilles">Netherland Antilles</option>
 						<option value="Netherlands">Netherlands (Holland, Europe)</option>
 						<option value="Nevis">Nevis</option>
 						<option value="New Caledonia">New Caledonia</option>
 						<option value="New Zealand">New Zealand</option>
 						<option value="Nicaragua">Nicaragua</option>
 						<option value="Niger">Niger</option>
 						<option value="Nigeria">Nigeria</option>
 						<option value="Niue">Niue</option>
 						<option value="Norfolk Island">Norfolk Island</option>
 						<option value="Norway">Norway</option>
 						<option value="Oman">Oman</option>
 						<option value="Pakistan">Pakistan</option>
 						<option value="Palau Island">Palau Island</option>
 						<option value="Palestine">Palestine</option>
 						<option value="Panama">Panama</option>
 						<option value="Papua New Guinea">Papua New Guinea</option>
 						<option value="Paraguay">Paraguay</option>
 						<option value="Peru">Peru</option>
 						<option value="Phillipines">Philippines</option>
 						<option value="Pitcairn Island">Pitcairn Island</option>
 						<option value="Poland">Poland</option>
 						<option value="Portugal">Portugal</option>
 						<option value="Puerto Rico">Puerto Rico</option>
 						<option value="Qatar">Qatar</option>
 						<option value="Republic of Montenegro">Republic of Montenegro</option>
 						<option value="Republic of Serbia">Republic of Serbia</option>
 						<option value="Reunion">Reunion</option>
 						<option value="Romania">Romania</option>
 						<option value="Russia">Russia</option>
 						<option value="Rwanda">Rwanda</option>
 						<option value="St Barthelemy">St Barthelemy</option>
 						<option value="St Eustatius">St Eustatius</option>
 						<option value="St Helena">St Helena</option>
 						<option value="St Kitts-Nevis">St Kitts-Nevis</option>
 						<option value="St Lucia">St Lucia</option>
 						<option value="St Maarten">St Maarten</option>
 						<option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
 						<option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
 						<option value="Saipan">Saipan</option>
 						<option value="Samoa">Samoa</option>
 						<option value="Samoa American">Samoa American</option>
 						<option value="San Marino">San Marino</option>
 						<option value="Sao Tome & Principe">Sao Tome & Principe</option>
 						<option value="Saudi Arabia">Saudi Arabia</option>
 						<option value="Senegal">Senegal</option>
 						<option value="Seychelles">Seychelles</option>
 						<option value="Sierra Leone">Sierra Leone</option>
 						<option value="Singapore">Singapore</option>
 						<option value="Slovakia">Slovakia</option>
 						<option value="Slovenia">Slovenia</option>
 						<option value="Solomon Islands">Solomon Islands</option>
 						<option value="Somalia">Somalia</option>
 						<option value="South Africa">South Africa</option>
 						<option value="Spain">Spain</option>
 						<option value="Sri Lanka">Sri Lanka</option>
 						<option value="Sudan">Sudan</option>
 						<option value="Suriname">Suriname</option>
 						<option value="Swaziland">Swaziland</option>
 						<option value="Sweden">Sweden</option>
 						<option value="Switzerland">Switzerland</option>
 						<option value="Syria">Syria</option>
 						<option value="Tahiti">Tahiti</option>
 						<option value="Taiwan">Taiwan</option>
 						<option value="Tajikistan">Tajikistan</option>
 						<option value="Tanzania">Tanzania</option>
 						<option value="Thailand">Thailand</option>
 						<option value="Togo">Togo</option>
 						<option value="Tokelau">Tokelau</option>
 						<option value="Tonga">Tonga</option>
 						<option value="Trinidad & Tobago">Trinidad & Tobago</option>
 						<option value="Tunisia">Tunisia</option>
 						<option value="Turkey">Turkey</option>
 						<option value="Turkmenistan">Turkmenistan</option>
 						<option value="Turks & Caicos Is">Turks & Caicos Is</option>
 						<option value="Tuvalu">Tuvalu</option>
 						<option value="Uganda">Uganda</option>
 						<option value="United Kingdom">United Kingdom</option>
 						<option value="Ukraine">Ukraine</option>
 						<option value="United Arab Erimates">United Arab Emirates</option>
 						<option value="United States of America">United States of America</option>
 						<option value="Uraguay">Uruguay</option>
 						<option value="Uzbekistan">Uzbekistan</option>
 						<option value="Vanuatu">Vanuatu</option>
 						<option value="Vatican City State">Vatican City State</option>
 						<option value="Venezuela">Venezuela</option>
 						<option value="Vietnam">Vietnam</option>
 						<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
 						<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
 						<option value="Wake Island">Wake Island</option>
 						<option value="Wallis & Futana Is">Wallis & Futana Is</option>
 						<option value="Yemen">Yemen</option>
 						<option value="Zaire">Zaire</option>
 						<option value="Zambia">Zambia</option>
 						<option value="Zimbabwe">Zimbabwe</option>
 					</select>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientPhone">Phone Number</label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientPhone" name="inputPatientPhone" placeholder="Phone" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPatientEmail">Email</label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPatientEmail" name="inputPatientEmail" placeholder="Email" required>
 				</div>
 			</div>
 		</div>
 		<div class="card">
 			<div class="row d-block">
 				<div class="col-lg-6">
 					<h3 class="page-title">Physician's Information <i class="fa fa-user"></i></h3>

 				</div>
 				<div class="btns-cont">
 					<div class="form-group">
 						<div class="input-group">
 							<span class="input-group-text" id="basic-addon1">
 								<i class="fa fa-search"></i>
 							</span>
 							<input class="form-control " />
 						</div>
 					</div>
 					<div class="form-group">
 						<button type="submit" class="btn btn-success btn-lg btn-block"> Search </button>
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianFirstName">First Name<span style="color: red;">*</span></label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianFirstName" name="physicianFirstName" placeholder="First Name" required>
 					<div class="invalid-feedback">
 						Please provide first name.
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianLastName">Last Name<span style="color: red;">*</span></label>
 					<input type="text" class="form-control" id="inputPhysicianLastName" name="physicianLastName" placeholder="Last Name" required>
 					<div class="invalid-feedback">
 						Please provide last name.
 					</div>
 				</div>

 			</div>
 			<div class="row">
 				<div class="form-group col-md-6">
 					<label for="inputPhysicianAddress1">Address Line 1 </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianAddress1" name="inputPhysicianAddress1" placeholder="Address Line 1" required>

 				</div>
 				<div class="form-group col-md-6">
 					<label for="inputPhysicianAddress2">Address Line 2 </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianAddress2" name="inputPhysicianAddress2" placeholder="Address Line 2" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianCity">City </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianCity" name="inputPhysicianCity" placeholder="City" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianState">State/Province </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianState" name="inputPhysicianState" placeholder="State/Province" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianZip">Zip/Postal Code </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianZip" name="inputPhysicianZip" placeholder="Zip/Postal Code" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianCountry">Country</label>
 					<select id="inputPhysicianCountry" name="tax" class="form-control selectTaxt" tabindex="-1" aria-hidden="true">
 						<option value="" disabled selected>-Select-</option>
 						<option value="Afganistan">Afghanistan</option>
 						<option value="Albania">Albania</option>
 						<option value="Algeria">Algeria</option>
 						<option value="American Samoa">American Samoa</option>
 						<option value="Andorra">Andorra</option>
 						<option value="Angola">Angola</option>
 						<option value="Anguilla">Anguilla</option>
 						<option value="Antigua & Barbuda">Antigua & Barbuda</option>
 						<option value="Argentina">Argentina</option>
 						<option value="Armenia">Armenia</option>
 						<option value="Aruba">Aruba</option>
 						<option value="Australia">Australia</option>
 						<option value="Austria">Austria</option>
 						<option value="Azerbaijan">Azerbaijan</option>
 						<option value="Bahamas">Bahamas</option>
 						<option value="Bahrain">Bahrain</option>
 						<option value="Bangladesh">Bangladesh</option>
 						<option value="Barbados">Barbados</option>
 						<option value="Belarus">Belarus</option>
 						<option value="Belgium">Belgium</option>
 						<option value="Belize">Belize</option>
 						<option value="Benin">Benin</option>
 						<option value="Bermuda">Bermuda</option>
 						<option value="Bhutan">Bhutan</option>
 						<option value="Bolivia">Bolivia</option>
 						<option value="Bonaire">Bonaire</option>
 						<option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
 						<option value="Botswana">Botswana</option>
 						<option value="Brazil">Brazil</option>
 						<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
 						<option value="Brunei">Brunei</option>
 						<option value="Bulgaria">Bulgaria</option>
 						<option value="Burkina Faso">Burkina Faso</option>
 						<option value="Burundi">Burundi</option>
 						<option value="Cambodia">Cambodia</option>
 						<option value="Cameroon">Cameroon</option>
 						<option value="Canada">Canada</option>
 						<option value="Canary Islands">Canary Islands</option>
 						<option value="Cape Verde">Cape Verde</option>
 						<option value="Cayman Islands">Cayman Islands</option>
 						<option value="Central African Republic">Central African Republic</option>
 						<option value="Chad">Chad</option>
 						<option value="Channel Islands">Channel Islands</option>
 						<option value="Chile">Chile</option>
 						<option value="China">China</option>
 						<option value="Christmas Island">Christmas Island</option>
 						<option value="Cocos Island">Cocos Island</option>
 						<option value="Colombia">Colombia</option>
 						<option value="Comoros">Comoros</option>
 						<option value="Congo">Congo</option>
 						<option value="Cook Islands">Cook Islands</option>
 						<option value="Costa Rica">Costa Rica</option>
 						<option value="Cote DIvoire">Cote DIvoire</option>
 						<option value="Croatia">Croatia</option>
 						<option value="Cuba">Cuba</option>
 						<option value="Curaco">Curacao</option>
 						<option value="Cyprus">Cyprus</option>
 						<option value="Czech Republic">Czech Republic</option>
 						<option value="Denmark">Denmark</option>
 						<option value="Djibouti">Djibouti</option>
 						<option value="Dominica">Dominica</option>
 						<option value="Dominican Republic">Dominican Republic</option>
 						<option value="East Timor">East Timor</option>
 						<option value="Ecuador">Ecuador</option>
 						<option value="Egypt">Egypt</option>
 						<option value="El Salvador">El Salvador</option>
 						<option value="Equatorial Guinea">Equatorial Guinea</option>
 						<option value="Eritrea">Eritrea</option>
 						<option value="Estonia">Estonia</option>
 						<option value="Ethiopia">Ethiopia</option>
 						<option value="Falkland Islands">Falkland Islands</option>
 						<option value="Faroe Islands">Faroe Islands</option>
 						<option value="Fiji">Fiji</option>
 						<option value="Finland">Finland</option>
 						<option value="France">France</option>
 						<option value="French Guiana">French Guiana</option>
 						<option value="French Polynesia">French Polynesia</option>
 						<option value="French Southern Ter">French Southern Ter</option>
 						<option value="Gabon">Gabon</option>
 						<option value="Gambia">Gambia</option>
 						<option value="Georgia">Georgia</option>
 						<option value="Germany">Germany</option>
 						<option value="Ghana">Ghana</option>
 						<option value="Gibraltar">Gibraltar</option>
 						<option value="Great Britain">Great Britain</option>
 						<option value="Greece">Greece</option>
 						<option value="Greenland">Greenland</option>
 						<option value="Grenada">Grenada</option>
 						<option value="Guadeloupe">Guadeloupe</option>
 						<option value="Guam">Guam</option>
 						<option value="Guatemala">Guatemala</option>
 						<option value="Guinea">Guinea</option>
 						<option value="Guyana">Guyana</option>
 						<option value="Haiti">Haiti</option>
 						<option value="Hawaii">Hawaii</option>
 						<option value="Honduras">Honduras</option>
 						<option value="Hong Kong">Hong Kong</option>
 						<option value="Hungary">Hungary</option>
 						<option value="Iceland">Iceland</option>
 						<option value="Indonesia">Indonesia</option>
 						<option value="India">India</option>
 						<option value="Iran">Iran</option>
 						<option value="Iraq">Iraq</option>
 						<option value="Ireland">Ireland</option>
 						<option value="Isle of Man">Isle of Man</option>
 						<option value="Israel">Israel</option>
 						<option value="Italy">Italy</option>
 						<option value="Jamaica">Jamaica</option>
 						<option value="Japan">Japan</option>
 						<option value="Jordan">Jordan</option>
 						<option value="Kazakhstan">Kazakhstan</option>
 						<option value="Kenya">Kenya</option>
 						<option value="Kiribati">Kiribati</option>
 						<option value="Korea North">Korea North</option>
 						<option value="Korea Sout">Korea South</option>
 						<option value="Kuwait">Kuwait</option>
 						<option value="Kyrgyzstan">Kyrgyzstan</option>
 						<option value="Laos">Laos</option>
 						<option value="Latvia">Latvia</option>
 						<option value="Lebanon">Lebanon</option>
 						<option value="Lesotho">Lesotho</option>
 						<option value="Liberia">Liberia</option>
 						<option value="Libya">Libya</option>
 						<option value="Liechtenstein">Liechtenstein</option>
 						<option value="Lithuania">Lithuania</option>
 						<option value="Luxembourg">Luxembourg</option>
 						<option value="Macau">Macau</option>
 						<option value="Macedonia">Macedonia</option>
 						<option value="Madagascar">Madagascar</option>
 						<option value="Malaysia">Malaysia</option>
 						<option value="Malawi">Malawi</option>
 						<option value="Maldives">Maldives</option>
 						<option value="Mali">Mali</option>
 						<option value="Malta">Malta</option>
 						<option value="Marshall Islands">Marshall Islands</option>
 						<option value="Martinique">Martinique</option>
 						<option value="Mauritania">Mauritania</option>
 						<option value="Mauritius">Mauritius</option>
 						<option value="Mayotte">Mayotte</option>
 						<option value="Mexico">Mexico</option>
 						<option value="Midway Islands">Midway Islands</option>
 						<option value="Moldova">Moldova</option>
 						<option value="Monaco">Monaco</option>
 						<option value="Mongolia">Mongolia</option>
 						<option value="Montserrat">Montserrat</option>
 						<option value="Morocco">Morocco</option>
 						<option value="Mozambique">Mozambique</option>
 						<option value="Myanmar">Myanmar</option>
 						<option value="Nambia">Nambia</option>
 						<option value="Nauru">Nauru</option>
 						<option value="Nepal">Nepal</option>
 						<option value="Netherland Antilles">Netherland Antilles</option>
 						<option value="Netherlands">Netherlands (Holland, Europe)</option>
 						<option value="Nevis">Nevis</option>
 						<option value="New Caledonia">New Caledonia</option>
 						<option value="New Zealand">New Zealand</option>
 						<option value="Nicaragua">Nicaragua</option>
 						<option value="Niger">Niger</option>
 						<option value="Nigeria">Nigeria</option>
 						<option value="Niue">Niue</option>
 						<option value="Norfolk Island">Norfolk Island</option>
 						<option value="Norway">Norway</option>
 						<option value="Oman">Oman</option>
 						<option value="Pakistan">Pakistan</option>
 						<option value="Palau Island">Palau Island</option>
 						<option value="Palestine">Palestine</option>
 						<option value="Panama">Panama</option>
 						<option value="Papua New Guinea">Papua New Guinea</option>
 						<option value="Paraguay">Paraguay</option>
 						<option value="Peru">Peru</option>
 						<option value="Phillipines">Philippines</option>
 						<option value="Pitcairn Island">Pitcairn Island</option>
 						<option value="Poland">Poland</option>
 						<option value="Portugal">Portugal</option>
 						<option value="Puerto Rico">Puerto Rico</option>
 						<option value="Qatar">Qatar</option>
 						<option value="Republic of Montenegro">Republic of Montenegro</option>
 						<option value="Republic of Serbia">Republic of Serbia</option>
 						<option value="Reunion">Reunion</option>
 						<option value="Romania">Romania</option>
 						<option value="Russia">Russia</option>
 						<option value="Rwanda">Rwanda</option>
 						<option value="St Barthelemy">St Barthelemy</option>
 						<option value="St Eustatius">St Eustatius</option>
 						<option value="St Helena">St Helena</option>
 						<option value="St Kitts-Nevis">St Kitts-Nevis</option>
 						<option value="St Lucia">St Lucia</option>
 						<option value="St Maarten">St Maarten</option>
 						<option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
 						<option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
 						<option value="Saipan">Saipan</option>
 						<option value="Samoa">Samoa</option>
 						<option value="Samoa American">Samoa American</option>
 						<option value="San Marino">San Marino</option>
 						<option value="Sao Tome & Principe">Sao Tome & Principe</option>
 						<option value="Saudi Arabia">Saudi Arabia</option>
 						<option value="Senegal">Senegal</option>
 						<option value="Seychelles">Seychelles</option>
 						<option value="Sierra Leone">Sierra Leone</option>
 						<option value="Singapore">Singapore</option>
 						<option value="Slovakia">Slovakia</option>
 						<option value="Slovenia">Slovenia</option>
 						<option value="Solomon Islands">Solomon Islands</option>
 						<option value="Somalia">Somalia</option>
 						<option value="South Africa">South Africa</option>
 						<option value="Spain">Spain</option>
 						<option value="Sri Lanka">Sri Lanka</option>
 						<option value="Sudan">Sudan</option>
 						<option value="Suriname">Suriname</option>
 						<option value="Swaziland">Swaziland</option>
 						<option value="Sweden">Sweden</option>
 						<option value="Switzerland">Switzerland</option>
 						<option value="Syria">Syria</option>
 						<option value="Tahiti">Tahiti</option>
 						<option value="Taiwan">Taiwan</option>
 						<option value="Tajikistan">Tajikistan</option>
 						<option value="Tanzania">Tanzania</option>
 						<option value="Thailand">Thailand</option>
 						<option value="Togo">Togo</option>
 						<option value="Tokelau">Tokelau</option>
 						<option value="Tonga">Tonga</option>
 						<option value="Trinidad & Tobago">Trinidad & Tobago</option>
 						<option value="Tunisia">Tunisia</option>
 						<option value="Turkey">Turkey</option>
 						<option value="Turkmenistan">Turkmenistan</option>
 						<option value="Turks & Caicos Is">Turks & Caicos Is</option>
 						<option value="Tuvalu">Tuvalu</option>
 						<option value="Uganda">Uganda</option>
 						<option value="United Kingdom">United Kingdom</option>
 						<option value="Ukraine">Ukraine</option>
 						<option value="United Arab Erimates">United Arab Emirates</option>
 						<option value="United States of America">United States of America</option>
 						<option value="Uraguay">Uruguay</option>
 						<option value="Uzbekistan">Uzbekistan</option>
 						<option value="Vanuatu">Vanuatu</option>
 						<option value="Vatican City State">Vatican City State</option>
 						<option value="Venezuela">Venezuela</option>
 						<option value="Vietnam">Vietnam</option>
 						<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
 						<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
 						<option value="Wake Island">Wake Island</option>
 						<option value="Wallis & Futana Is">Wallis & Futana Is</option>
 						<option value="Yemen">Yemen</option>
 						<option value="Zaire">Zaire</option>
 						<option value="Zambia">Zambia</option>
 						<option value="Zimbabwe">Zimbabwe</option>
 					</select>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianPhone">Phone Number</label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianPhone" name="inputPhysicianPhone" placeholder="Phone" required>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputPhysicianEmail">Email</label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputPhysicianEmail" name="inputPhysicianEmail" placeholder="Email" required>

 				</div>
 			</div>
 		</div>
 		<div class="card">
 			<div class="row" id="case-info-header">
 				<div class="col-lg-6">
 					<h3 class="page-title">Case Information</h3>
 				</div>
 				<div class="col-md-4 d-flex justify-content-end" id="specimens-tab">
 					<button value="0" id="btn-specimen-0" class="btn btn-primary">Specimen 1</button>
 				</div>

 				<div class=" col-sm-1">
 					<button type="button" id="add-specimen" class="btn btn-success"><i class="fa fa-plus"></i></button>
 					<button type="button" id="delete-specimen" class="btn btn-danger">
 						<i class="fa fa-trash-o"></i>
 					</button>
 				</div>
 			</div>
 			<div class="row">
 				<div class="form-group col-md-3">
 					<label class="focus-label">Clinic Date</label>
 					<div class="cal-icon">
 						<input name="toDate" id="inputClinicalDate" class="form-control datetimepicker" type="text">
 						<div class="invalid-feedback">
 							Please Provide Clinical Date
 						</div>
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputRCPath">RCPath Score </label>
 					<input type="text" aria-describedby="required-description" class="form-control" id="inputRCPath" name="inputRCPath" required>
 					<div class="invalid-feedback">
 						Please Provide RCPath Score
 					</div>

 				</div>
 				<div class="form-group col-md-3">
 					<label for="inputStatus">Status</label>
 					<select id="inputStatus" class="form-control selectTaxt" tabindex="-1" aria-hidden="true">
 						<option selected disabled value="">-Select-</option>
 						<option value="Routine">Routine</option>
 						<option value="Urgent">Urgent</option>
 						<option value="Cancer Pathway">Cancer Pathway</option>

 					</select>
 					<div class="invalid-feedback">
 						Please Select Status
 					</div>

 				</div>
 				<div class="form-group col-md-3">
 				</div>
 				<div class="form-group col-md-3">
 					<label class="focus-label">Specimen Type</label>
 					<input name="" id="inputSpecimenType" class="form-control" type="text">
 					<div class="invalid-feedback">
 						Please Specify Specimen Type
 					</div>
 				</div>
 				<div class="form-group col-md-6">
 					<label class="focus-label">MSKCC Received</label>
 					<input id="inputMSKCCReceived" class="form-control" type="text">
 					<div class="invalid-feedback">
 						Please Provide MSKCC Received Date
 					</div>
 				</div>
 				<div class="form-group col-md-6">
 					<textarea id="inputDescription" class="tinyTextarea"></textarea>
 				</div>

 				<div class="form-group col-md-6">
 					<div class="card doctorCard">
 						<div class="input-group">
 							<span class="input-group-text" id="basic-addon1">
 								<label class="focus-label">Description</label>
 								<img src="assets/institute/img/iconBtn.png" align="btn">
 							</span>
 							<input class="form-control" list="desc">
 							<datalist id="desc">
 								<option value="Macroscopic Description 1">
 								</option>
 								<option value="Macroscopic Description 2">
 								</option>
 								<option value="Macroscopic Description 3">
 								</option>
 								<option value="Macroscopic Description 4">
 								</option>
 								<option value="Macroscopic Description 5">
 								</option>
 							</datalist>

 						</div>
 						<textarea id="inputMacroDescription" class="form-control" name=""></textarea>
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label class="focus-label">No. Slides</label>
 					<input id="inputNoSlides" class="form-control" type="text">
 					<div class="invalid-feedback">
 						Please Provide Number Of Slides
 					</div>
 				</div>
 				<div class="form-group col-md-3">
 					<label class="focus-label">No. of Blocks</label>
 					<input id="inputNoBlocks" class="form-control" type="text">
 					<div class="invalid-feedback">
 						Please Provide Number of Blocks
 					</div>
 				</div>
 				<div class="form-group col-md-6">
 					<label class="focus-label">Block Detail</label>
 					<input id="inputBlockDetail" class="form-control" type="text">
 					<div class="invalid-feedback">
 						Please Provide Block Detail
 					</div>
 				</div>
 			</div>
 			<div id="upload-area">
 				<div class="row">
 					<div class="col-md-12">
 						<h3>Upload</h3>
 					</div>
 				</div>
 				<div id="upload-container">
 					<div id="upload-inputs">
 						<div class="row upload-section">
 							<div class="col-md-4">
 								<h3>Digital Slides</h3>
 								<input type="file" id="slides" name="slides" />
 							</div>
 							<div class="col-md-4">
 								<h3>Documents</h3>
 								<input type="file" id="documents" name="documents" />
 							</div>
 							<div class="col-md-4">
 								<h3>Media</h3>
 								<input type="file" id="media" name="media" />
 							</div>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="submit-section ">
 			<button type="submit" id="submitForm" class="btn btn-primary submit-btn">Save</button>
 		</div>
 		<!-- /Page Content -->
 	</div>

 	<!-- /Page Wrapper -->