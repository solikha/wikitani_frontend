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

<?php
    foreach($mainmenu as $item){
        if ($item['tipe']=='ul'){
            if ($item['level']==0){
                echo '<ul class="nav nav-list">';
            } else {
                echo '<ul class="submenu">';
            }
        } else if ($item['tipe']=='/ul'){
            echo '</ul>';
        } else if ($item['tipe']=='item'){
            echo '<li class="hsub">';
            echo '<a href="'.$item['link'].'" data-rel="tooltip" data-placement="bottom" title="" data-original-title="'.$item['description'].'">';
            echo '<i class="menu-icon '.$item['iconname'].'"></i>';
            echo '<span class="menu-text">'.$item['caption'].'</span>';
            echo '</a>';
            echo '</li>';
        } else if ($item['tipe']=='parent0'){
            echo '<a href="'.$item['link'].'" class="dropdown-toggle" >';
            echo '<i class="menu-icon '.$item['iconname'].'"></i>';
            echo '<span class="menu-text">'.$item['caption'].'</span>';
            echo '<b class="arrow icon-angle-down"></b>';
            echo '</a>';
        } else if ($item['tipe']=='parent1'){
            echo '<a href="'.$item['link'].'" class="dropdown-toggle">';
            echo '<i class="menu-icon icon-double-angle-right"></i>';
            echo $item['caption'];
            echo '<b class="arrow icon-angle-down"></b>';
            echo '</a>';
        } else if ($item['tipe']=='parent'){
            echo '<a href="'.$item['link'].'" class="dropdown-toggle" >';
            echo '<i class="menu-icon '.$item['iconname'].'"></i>';
            echo '<span class="menu-text">'.$item['caption'].'</span>';
            echo '<b class="arrow icon-angle-down"></b>';
            echo '</a>';
        } else if ($item['tipe']=='li'){
            echo '<li>';
        } else if ($item['tipe']=='/li'){
            echo '</li>';
        }
    }
?>

