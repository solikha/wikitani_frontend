<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
?>
        <style>
            .nav-list>li>a>.menu-icon {
                min-width: 24px;
                vertical-align: baseline;
                font-size: 16px;
            }
            
            .btn-minier {
                font-size: 13px;
            }
            .datepicker-dropdown { 
                z-index: 9999;
            }
            .icon-users:before{content:"\f0c0";}
            .navbar{
                background-color: <?php echo $appconfig['main-barcolor']; ?>!important;
            }
            .edit-group{
                margin-bottom: 10px;
            }
            .edit-control{
                width:100%;
                height:34px;
            }
            textarea.edit-control{
                height:103px;
            }
            span.input-group-addon{
                height:34px;
            }
            select.form-control{
                height:34px;
            }
            a.chosen-single{
                height:34px;
            }
            .radio{
                margin-top: -4px;
                margin-bottom: 8px;
            }
            .modal-header{
                padding-top: 5px;
                padding-bottom: 5px;
                xbackground-color: #ced7dc;
                background-color: #438eb9;
                color: white;
                border-top-left-radius: 6px;
                border-top-right-radius: 6px;
            }
            .modal-body{
                xbackground-color: #f8fafc;
                background-color: #fbfcfd;
            }
            .modal-footer{
                margin-top: 0px;
                xbackground-color: #a5c9dd;
                background-color: #eee;
            }
            .modal-backdrop, .modal-backdrop.fade.in{
                background-color: #333;
                opacity:0.7;
            }
            
        .testing1 {
            display: none;
        }
        
        .twitter-typeahead {
            width:100%;
        }
            
        .tt-hint {
            width:100%;
            background-color: #fff;
        }
            
        .tt-input {
            width:100%;
            border-color: #b5b5b5;
            background-color: #fff!important;
        }
        
        .tt-suggestion{
            cursor: pointer;
        }
        .tt-suggestion:hover{
            background-color: #0097cf;
            color: #fff;
        }
        .tt-menu{
            color: #000;
            width: 100%;
            background-color: #fff;
            margin-top: 2px;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 4px;
            padding-bottom: 6px;
            border-style: solid;
            border-width: thin;
            border-color: #b5b5b5;
        }
        .menu-icon{
            margin-left: -4px!important;
        }
            
        
    @media only screen and (max-width:991px){
        .testing1 {
            display: block;
            height: 30px;
        }
    }
    @media only screen and (max-width:480px){
        .modal{
            padding: 5px;
        }
    }    
        </style>