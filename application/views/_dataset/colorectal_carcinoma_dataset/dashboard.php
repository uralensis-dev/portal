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
    <h1>Colorectal Carcinoma Dataset</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="container">

                <h2>1) Specimen type†:</h2>
                Total colectomy 
                <input type='radio'><br>  
                / Subtotal colectomy 
                <input type='radio'><br>  
                /
                Right hemicolectomy 
                <input type='radio'><br>  
                / Transverse colectomy 
                <input type='radio'><br>  
                /
                Left hemicolectomy 
                <input type='radio'><br>  
                / Anterior resection [AR] 
                <input type='radio'><br>  
                /
                Sigmoid colectomy 
                <input type='radio'><br>  
                / Hartmann’s procedure 
                <input type='radio'><br>  
                /
                Abdominoperineal excision [APE] 
                <input type='radio'><br>  
                /
                <h3>Maximum tumour diameter†: </h3>
                Not identified 
                <input type='radio'><br>  

                <h3>Site of tumour†:</h3>
                Caecum 
                <input type='radio'><br>  
                / Right (ascending) colon
                <input type='radio'><br>  
                / Hepatic flexure
                <input type='radio'><br>  

                Transverse colon
                <input type='radio'><br>  
                / Splenic flexure
                <input type='radio'><br>  
                / Left (descending)
                colon
                <input type='radio'><br>  
                / Sigmoid colon
                <input type='radio'><br>  
                / Rectum 
                <input type='radio'><br>  
                / Unknown 
                <input type='radio'><br>  

                <h3>Tumour perforation (pT4): </h3>
                Yes 
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  

                <h3>For rectal tumours:</h3>
                <h3>Relation of tumour to peritoneal reflection: (tick one):</h3>
                Above 
                <input type='radio'><br>  
                Astride 
                <input type='radio'><br>  
                Below 
                <input type='radio'><br>  

                <h3>Plane of mesorectal excision (AR and APE)†:</h3>
                Mesorectal fascia 
                <input type='radio'><br>  

                Intramesorectal 
                <input type='radio'><br>  

                Muscularis propria 
                <input type='radio'><br>  


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">


                <h2>2) Plane of resection of the sphincters (APE only):</h2>
                Extralevator 
                <input type='radio'><br>  
                / Sphincteric 
                <input type='radio'><br>  
                / Intrasphincteric 
                <input type='radio'><br>  

                <h3>For APE specimens:</h3>
                <h3>Tumour type†:</h3>
                Adenocarcinoma 
                <input type='radio'><br>  

                Other, or variant of adenocarcinoma 
                <input type='radio'><br>  

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">

                <h2>3) Differentiation by predominant area†:</h2>
                Well/moderate 
                <input type='radio'><br>  
                Poor 
                <input type='radio'><br>  
                Not applicable 
                <input type='radio'><br>  

                Local invasion:
                No carcinoma identified (pT0) 
                <input type='radio'><br>  

                Submucosa (pT1) 
                <input type='radio'><br>  

                Muscularis propria (pT2) 
                <input type='radio'><br>  

                Beyond muscularis propria (pT3) 
                <input type='radio'><br>  

                Tumour cells have breached the serosa (pT4a) 
                <input type='radio'><br>  

                Tumour has perforated below peritoneal reflection (pT4a)

                <input type='radio'><br>  

                and/or tumour invades adjacent organs (pT4b) 
                <input type='radio'><br>  


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">


                <h2>4) Maximum distance beyond muscularis propria†:</h2>
                N/A (if intramural tumour) 
                <input type='radio'><br>  

                Preoperative therapy response (tumour regression
                score)†:
                Not applicable 
                <input type='radio'><br>  

                No viable cancer cells (TRS 0) 
                <input type='radio'><br>  

                Single cells or rare small groups of cancer cells (TRS 1) 
                <input type='radio'><br>  

                Residual cancer with evident tumour regression (TRS 2) 
                <input type='radio'><br>  

                No evident tumour regression (TRS 3) 
                <input type='radio'><br>  

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">


                <h2>5) Carcinoma involvement of margins†:</h2>

                Doughnuts 
                <input type='radio'><br>  
                N/A 
                <input type='radio'><br>  
                N/S 
                <input type='radio'><br>  
                Yes 
                <input type='radio'><br>  
                No
                Longitudinal margin involved 
                <input type='radio'><br>  
                N/A 
                <input type='radio'><br>  
                N/S 
                <input type='radio'><br>  
                Yes 
                <input type='radio'><br>  
                No
                Circumferential margin involved 
                <input type='radio'><br>  
                N/A 
                <input type='radio'><br>  
                N/S 
                <input type='radio'><br>  
                Yes 
                <input type='radio'><br>  
                No
                (N/S = not submitted by pathologist)

                (N1a, 1 node; N1b, 2–3 nodes; N1c, tumour deposits only).
                pN2a, 4–6 nodes; pN2b, >6)
                Highest node involved: Yes 
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  


            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">


                <h2>6) Number of tumour deposits: 0
                    <input type='radio'><br>  
                    1
                    <input type='radio'><br>  
                    2
                    <input type='radio'><br>  
                    3
                    <input type='radio'><br>  
                    4
                    <input type='radio'><br>  
                    5
                    <input type='radio'><br>  
                    >5
                    <input type='radio'><br>  
                </h2>
                Deepest level of venous invasion:
                None 
                <input type='radio'><br>  
                / Intramural
                <input type='radio'><br>  
                / Extramural 
                <input type='radio'><br>  

                Deepest level of lymphatic (small vessel) invasion:
                None 
                <input type='radio'><br>  
                / Intramural
                <input type='radio'><br>  
                / Extramural 
                <input type='radio'><br>  

                Deepest level of perineural invasion:
                None 
                <input type='radio'><br>  
                / Intramural
                <input type='radio'><br>  
                / Extramural 
                <input type='radio'><br>  



            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="container">


                <h2>7) Histologically confirmed distant metastatic disease†:</h2>
                Yes (pM1) 
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  
                If yes
                (pM1a, one organ; pM1b, >1 organ; pM1c, peritoneal)
                Separate abnormalities: No Yes
                Polyp(s)  
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  
                yes
                Polyposis 
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  
                yes
                Synchronous carcinoma(s)  
                <input type='radio'><br>  
                No 
                <input type='radio'><br>  
                yes
                (separate proforma for each cancer)
                Complete resection (by >1 mm) at all margins†:
                Yes (R0) 
                <input type='radio'><br>  
                No (R1) 
                <input type='radio'><br>  
                No (R2) 
                <input type='radio'><br>  


            </div>
        </div>
    </div>



    <!--DYNAMIC FORM CODE END-->


</section>