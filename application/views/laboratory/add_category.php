<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    div.dataTables_wrapper div.dataTables_length select {
        position: absolute;
        top: -62px;
        height: 37px !important;
        width: 50px !important;
        left: 29px;
        padding: 0;
    }

    table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
        padding-right: 15px !important
    }

    .custome_BTN label:focus {
        background: #006df1;
        color: #fff !important;
        border-color: #006df1;
    }

    .breadcrumb {
        padding: 0 !important
    }

    .tg-cancel input {
        display: none;
    }

    .tg-cancel label i {
        color: red;
    }

    .tg-cancel label {
        cursor: pointer;
        margin-bottom: 0;
        width: 45px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 50%;
    }

    @media screen and (min-width: 1600px) {
        body {
            font-size: 18px;
        }
    }

    @media screen and (max-width: 1380px) {
        .tg-cancel label {
            width: 35px;
            padding: 5px;
        }

        div.dataTables_wrapper div.dataTables_length select {
            top: -59px;
        }
    }

    .action_th_icon {
        float: right !important;
    }

    .form-control.is-invalid, .was-validated .form-control:invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
        /*background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E);*/
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .invalid-feedback {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .form-control.is-valid, .was-validated .form-control:valid {
        border-color: #28a745;
        padding-right: calc(1.5em + .75rem);
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: center right calc(.375em + .1875rem);
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }

    .valid-feedback {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #28a745;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Laboratory</h3>
            <div class="tg-breadcrumbarea tg-searchrecordhold">
                <ol class="tg-breadcrumb tg-breadcrumbvtwo">
                    <li><a href="javascript:;">Dashboard</a></li>
                    <li class="active">Add Category</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="jstree">
                <ul>
                    <li>Hospital 1
                        <ul>
                            <li id="child_node_1">Pathology Group
                                <ul>
                                    <li>Speciality
                                        <ul>
                                            <li>Level 1</li>
                                            <li>Level 2</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>Hospital 1
                        <ul>
                            <li id="child_node_1">Pathology Group
                                <ul>
                                    <li>Speciality
                                        <ul>
                                            <li>Level 1</li>
                                            <li>Level 2</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

