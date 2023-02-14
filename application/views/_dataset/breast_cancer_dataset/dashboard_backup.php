<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Dataset</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">Dashboard</li>
                <li class="breadcrumb-item active">Dataset</li>
            </ul>
        </div>
    </div>
</div>
<section>


    <!--DYNAMIC FORM CODE START-->
    
    <h1>Breast Cancer Dataset</h1>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <h2>1)	Surgical specimen(s)</h2>

                    <h3>Side:</h3><br> 
                    <p>Right <input type='radio'></p>	
                    <p>Left <input type='radio'></p>

                    <h3>Specimen type:</h3><br> 
                    WLE <input type='radio'><br>
                    Excision biopsy  <input type='radio'><br>   	
                    Localisation specimen <input type='radio'><br>    	
                    Segmental excision <input type='radio'><br>  
                    Mastectomy <input type='radio'><br>   	  
                    Subcutaneous mastectomy <input type='radio'><br>   
                    Re-excision  <input type='radio'><br>   	  
                    Further margins (including  cavity shaves/bed biopsies)   <input type='radio'><br>    
                    Microdochectomy/microductectomy <input type='radio'><br>   
                    SLN              <input type='radio'><br>   	  
                    Axillary sampling <input type='radio'><br>     	
                    Axillary LN level I <input type='radio'><br>      
                    Axillary LN level II <input type='radio'><br>    
                    Axillary LN level III <input type='radio'><br> 	
                    Total duct excision/Hadfield’s procedure <input type='radio'><br>   

                    <h3>Specimen radiograph seen:</h3><br> 		
                    Yes <input type='radio'><br> 		
                    No <input type='radio'><br>

                    <h3>Mammographic abnormality:</h3><br> 		
                    Yes <input type='radio'><br> 		
                    No <input type='radio'><br>		
                    Unsure <input type='radio'><br> 

                    <h3>Site of previous core biopsy seen:</h3><br> 	 	
                    Yes <input type='radio'><br> 		
                    No <input type='radio'><br>

                    <h3>Histological calcification:</h3><br> 	 		
                    Absent <input type='radio'><br> 	
                    Benign <input type='radio'><br> 	
                    Malignant <input type='radio'><br> 		
                    Both <input type='radio'><br>

                    <h3>Benign lesions:</h3><br>
                    Columnar cell change <input type='radio'><br>    	
                    Complex sclerosing lesion/radial scar <input type='radio'><br>     	
                    Fibroadenoma <input type='radio'><br> 
                    Fibrocystic change <input type='radio'><br>     	
                    Multiple papillomas <input type='radio'><br>     		
                    Papilloma (single) <input type='radio'><br> 
                    Periductal mastitis/duct ectasia <input type='radio'><br>    
                    Sclerosing adenosis <input type='radio'><br>     		
                    Solitary cyst <input type='radio'><br>     

                    <h3>Epithelial proliferation:</h3><br> 	
                    Not present <input type='radio'><br>      	
                    Present without atypia <input type='radio'><br>     
                    Flat epithelial atypia  <input type='radio'><br>	
                    Present with atypia (ductal) <input type='radio'><br>          	 
                    Present with atypia (lobular) <input type='radio'><br>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">

                    <h2>2)	Malignant lesions</h2>

                    <h3>Malignant in situ lesion:</h3><br>    	
                    Not present <input type='radio'><br>		
                    Present <input type='radio'><br>

                    <h3>In situ components:</h3><br>   	
                    Ductal <input type='radio'><br> 	
                    Lobular <input type='radio'><br>   	
                    Paget’s <input type='radio'><br>

                    <h3>DCIS grade:</h3><br>    	
                    High <input type='radio'><br>     	
                    Intermediate <input type='radio'><br>    	
                    Low <input type='radio'><br>  	
                    Not assessable <input type='radio'><br>

                    <h3>DCIS growth pattern:</h3><br>  	
                    Solid <input type='radio'><br>   	
                    Cribriform <input type='radio'><br>    	
                    Papillary <input type='radio'><br>    	
                    Micropapillary <input type='radio'><br>  
                    Apocrine <input type='radio'><br>   	
                    Flat <input type='radio'><br>   	
                    Comedo <input type='radio'><br>    

                    <h3>DCIS necrosis:</h3><br>    	
                    Present <input type='radio'><br>    	
                    Absent   <input type='radio'><br>

                    <h3>Inflammation:</h3><br> 	
                    Present <input type='radio'><br>    	
                    Absent   <input type='radio'><br> 

                    <h3>LCIS:</h3><br> 	
                    Present <input type='radio'><br>    	
                    Absent <input type='radio'><br>
                    Paget’s disease: 	
                    Present <input type='radio'><br>    	
                    Absent <input type='radio'><br>
                    Microinvasive: 	
                    Present <input type='radio'><br>    	
                    Absent <input type='radio'><br>

                    <h3>Invasive carcinoma</h3><br>  	
                    Present <input type='radio'><br>    	
                    Absent <input type='radio'><br>

                    <h3>Size and extent</h3><br>

                    <h3>Disease extent:	</h3><br>	
                    Localised <input type='radio'><br> 	
                    Multiple invasive foci <input type='radio'><br> 	 
                    Not assessable <input type='radio'><br>

                    <h3>Invasive tumour type</h3><br>   
                    Pure <input type='radio'><br> (tick one box below)     
                    Mixed <input type='radio'><br> (tick all components present below)
                    Tubular/Cribriform <input type='radio'><br>   
                    Lobular <input type='radio'><br>   Mucinous <input type='radio'><br>   
                    Medullary-like <input type='radio'><br>   
                    Ductal/NST <input type='radio'><br>   
                    Micropapillary <input type='radio'><br> 

                    <h3>Histological grade</h3><br> 	 	
                    1 <input type='radio'><br>      
                    2 <input type='radio'><br>     	
                    3 <input type='radio'><br>    	
                    Not assessable <input type='radio'><br>

                    <h3>Components (optional):</h3><br>	
                    Tubule formation  		
                    1 <input type='radio'><br> 	
                    2 <input type='radio'><br>  	
                    3 <input type='radio'><br>  	
                    Not assessable <input type='radio'><br>

                    <h3>Nuclear pleomorphism</h3><br>  	
                    1 <input type='radio'><br>  	
                    2 <input type='radio'><br>  	
                    3 <input type='radio'><br>  	
                    Not assessable <input type='radio'><br>

                    <h3>Mitoses</h3><br> 			
                    1 <input type='radio'><br>  	
                    2 <input type='radio'><br> 	
                    3 <input type='radio'><br>  	
                    Not assessable <input type='radio'><br>  

                    <h3>Lymphovascular invasion</h3><br>   
                    Present <input type='radio'><br> 	
                    Absent <input type='radio'><br>  	
                    Possible <input type='radio'><br>

                    <h3>Lymph node stage</h3><br>
                    Intra-operative assessment (optional)
                    Sentinel LN assessed: 	
                    No <input type='radio'><br> 		
                    Yes <input type='radio'><br>   	
                    Positive <input type='radio'><br>   	
                    Negative <input type='radio'><br>  

                    <h3>Sentinel LN positive:</h3><br> 	
                    Macrometastasis <input type='radio'><br>  	
                    Micrometastasis <input type='radio'><br>  		
                    ITCs <input type='radio'><br> 
                    (Note ITCs only classified as node negative)

                    <h3>Method of assessment:</h3><br>    
                    PCR <input type='radio'><br>     
                    OSNA <input type='radio'><br>    
                    Frozen section <input type='radio'><br>     
                    Cytology <input type='radio'><br>    

                    <h3>Axillary nodes present:	</h3><br>  
                    No <input type='radio'><br>  	   
                    Yes <input type='radio'><br>

                    <h3>Extracapsular spread:</h3><br>       
                    Present  <input type='radio'><br>	                       
                    Not identified <input type='radio'><br>

                    <h3>For single node positive:</h3><br>  
                    Macrometastasis <input type='radio'><br>  	
                    Micrometastasis <input type='radio'><br>  	
                    ITCs <input type='radio'><br>
                    (Note ITCs only classified as node negative)

                    <h3>Summary lymph node stage:</h3><br> 
                    1 = Node negative <input type='radio'><br>	 
                    2 = 1–3 nodes positive <input type='radio'><br> 		 
                    3 = 4 or more nodes positive <input type='radio'><br>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">

                    <h2>3)	Modifications for post neoadjuvant therapy cases:</h2>    

                    <h3>Residual tumour size and extent</h3><br>
                    Disease extent:
                    Localised residual tumour <input type='radio'><br>    
                    Multiple residual invasive foci <input type='radio'><br>       
                    Cannot be assessed <input type='radio'><br>

                    <h3>Residual invasive tumour type</h3><br>   
                    Pure <input type='radio'><br>  (tick one box below)  
                    Mixed <input type='radio'><br> (tick all components present below)		
                    Not applicable (no residual invasive tumour) <input type='radio'><br>
                    Tubular/cribriform <input type='radio'><br>    
                    Lobular <input type='radio'><br>   
                    Mucinous <input type='radio'><br>   
                    Medullary-like <input type='radio'><br>    
                    Ductal/NST <input type='radio'><br>   
                    Micropapillary <input type='radio'><br> 

                    <h3>Residual tumour histological grade:</h3><br>	 
                    1 <input type='radio'><br>     	
                    2 <input type='radio'><br>     	
                    3 <input type='radio'><br>    	
                    Cannot be assessed <input type='radio'><br>

                    <h3>Residual in situ components:</h3><br> 
                    DCIS: 			
                    Present <input type='radio'><br>        
                    Absent <input type='radio'><br>

                    <h3>DCIS grade:</h3><br> 	
                    High <input type='radio'><br>     
                    Intermediate <input type='radio'><br>     
                    Low <input type='radio'><br>     
                    Cannot be assessed <input type='radio'><br>

                    <h3>LCIS:</h3><br> 			
                    Present <input type='radio'><br>       
                    Not identified <input type='radio'><br>

                    <h3>Paget’s disease:</h3><br> 		 	
                    Present <input type='radio'><br>       
                    Not identified <input type='radio'><br>       
                    Cannot be assessed <input type='radio'><br>

                    <h3>Microinvasive:</h3><br> 	
                    Present <input type='radio'><br>       
                    Not identified <input type='radio'><br>

                    <h3>Lymphovascular invasion</h3><br>   
                    Present <input type='radio'><br> 	
                    Not identified <input type='radio'><br>  	
                    Uncertain <input type='radio'><br>

                    <h3>Post therapy lymph node stage</h3><br>
                    Evidence of treatment response in the metastases:  
                    Present <input type='radio'><br>     
                    Absent <input type='radio'><br>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">

                    <h2>4)	Final classification of chemotherapy response</h2>

                    <h3>Breast disease response:</h3><br>

                    1.	Complete pathological response, either (i) no residual carcinoma or (ii) no residual invasive tumour but DCIS present <input type='radio'><br>
                    2.	Partial response to therapy <input type='radio'><br>
                    a.	minimal residual disease/near total effect typically (<10% of tumour remaining in the tumour bed seen as an area of residual fibrosis delineating the original tumour extent) <input type='radio'><br>
                    b.	Evidence of response but significant tumour remaining (>10% of tumour remaining in the tumour bed seen as an area of residual fibrosis delineating the original tumour extent) <input type='radio'><br>
                    3.	No evidence of response to therapy <input type='radio'><br> 

                    <h3>Lymph nodal response:</h3><br>
                    1.	No evidence of metastatic disease and no evidence of changes in the lymph nodes <input type='radio'><br>
                    2.	Metastatic tumour not detected but evidence of response/’down-staging’, e.g. fibrosis <input type='radio'><br>
                    3.	Metastatic disease present but also evidence of response, such as nodal fibrosis  <input type='radio'><br>
                    4.	Metastatic disease present with no evidence of response to therapy <input type='radio'><br>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">

                    <h2>5)	TNM stage</h2>
                    <h3>T stage:</h3><br>  	
                    pTis  <input type='radio'><br>    
                    pT1mi <input type='radio'><br>    
                    pT1a <input type='radio'><br>    
                    pT1b <input type='radio'><br>    
                    pT1c <input type='radio'><br>    
                    pT2 <input type='radio'><br>   
                    pT3 <input type='radio'><br>    
                    pT4a <input type='radio'><br>    
                    pT4b <input type='radio'><br>    
                    pT4c <input type='radio'><br>     
                    pT4d  <input type='radio'><br>     
                    Cannot be assessed <input type='radio'><br>

                    <h3>N stage:</h3><br>  	
                    pN0 <input type='radio'><br>    
                    pN1mi <input type='radio'><br>    
                    pN1a <input type='radio'><br>    
                    pN1b <input type='radio'><br>    
                    pN1c <input type='radio'><br>    
                    pN2a <input type='radio'><br>    
                    pN2b <input type='radio'><br>    
                    pN3a <input type='radio'><br>    
                    pN3c <input type='radio'><br>   
                    Cannot be assessed <input type='radio'><br>

                    <h3>M stage:</h3><br> 	
                    pM1 <input type='radio'><br> 
                    Cannot be assessed <input type='radio'><br>

                    Note: Add suffix ‘y’ to TNM codes for post neoadjuvant therapy treated cases

                    <h2>6)	Receptor status</h2>
                    <h3>Oestrogen receptor status:</h3><br> 
                    Positive (> or = 1%) <input type='radio'><br>		
                    Negative (<1%) <input type='radio'><br>

                    <h3>On-slide positive control material:</h3><br> 	
                    Present <input type='radio'><br> 	
                    Absent <input type='radio'><br>

                    <h3>HER2 IHC score:</h3><br>     
                    0 Negative <input type='radio'><br>   1+ <input type='radio'><br>     
                    Negative <input type='radio'><br>    
                    2+ Borderline  <input type='radio'><br>    
                    3+ Positive  <input type='radio'><br>

                    <h3>Status:</h3><br>  	         
                    Amplified <input type='radio'><br>   
                    Non-amplified <input type='radio'><br>    
                    Borderline <input type='radio'><br>    
                    Not performed <input type='radio'><br>

                    <h3>Final HER2 status:</h3><br>  
                    Positive <input type='radio'><br>	
                    Negative <input type='radio'><br>

                    <h3>Optional:
                        Progesterone receptor status:</h3><br> 	
                    Positive (>1%) <input type='radio'><br>	
                    Negative (<1%) <input type='radio'><br>

                    <h3>On-slide positive control material:</h3><br> 	
                    Present <input type='radio'><br> 	
                    Absent <input type='radio'><br> 

                </div>
            </div>
        </div>
    </div>
    <!--DYNAMIC FORM CODE END-->


</section>