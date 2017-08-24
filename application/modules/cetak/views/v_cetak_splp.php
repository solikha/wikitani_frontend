<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); /* Manggu Framework * Simple PHP Application Development * Kusnassriyanto S. Bahri * kusnassriyanto@gmail.com * */
$function = new splp();
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <style>
            .headerPagedStart { 
                page: smallsquare; 
            } 
            .page1 { 
                page: page1; 
            } 
            .page2 { 
                page: page2; 
            } 
            .page3 { 
                page: page3; 
            } 
            .page4 { 
                page: page4; 
            } 
            @page smallsquare {   
                sheet-size: A5-L;
            } 
            @page page1 {    
                sheet-size: A5;
            }
            @page page2 {    
                sheet-size: A5;
            }
            @page page3 {    
                sheet-size: A5;
            }
            @page page4 {    
                sheet-size: A5;
            }

/*20.8  14.8   R5*/
/*12.4  17.8   buku*/
/*15  17.9   contoh*/


/*contoh*/
/*l9.7,5
l9.6,5

t4.3  r8.4
t4.7   r7.1
t7    r5.7
t9.3   r8.3  
t9.8
t10.3*/

        </style>
        <h2 class="headerPagedStart">Paged Media using CSS</h2>
        <div class="gradient" style="float: right; width: 28%; margin-bottom: 0pt; "> 
            This is text in a &lt;div&gt; element that is set to float:right 
            and width:28%. It also has an image with float:right inside. With this exception, you cannot nest 
            elements with the float property set inside one another. 
        </div> 
        <div class="gradient" style="float: left; width: 54%; margin-bottom: 0pt; "> 
            This is text in a &lt;div&gt; element that is set to float:left and width:54%. 
        </div> 
        <table rotate="+90" style="clear: both; margin: 0pt; padding: 0pt; ">
            This is text that follows a &lt;div&gt; element that is set to clear:both.
        </table> 


        <div class="page1">
            <table rotate="+90" style="width: 104mm;">
                <tr>
                    <td>okey</td>
                </tr>
            </table>
            <table rotate="+90" style="height: 50%;float: right;">
                    <tr>
                        <th>1A</th>
                        <th>2A</th>
                        <th>3B</th>
                        <th>4B</th>
                    </tr>
            </table>
        </div>
        <div class="page2">
            heheh
        </div>
        <div class="page3">
            heheh
        </div>
        <div class="page4">
            heheh
        </div>
    </body>
</html>
