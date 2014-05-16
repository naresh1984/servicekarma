<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student - Admin Manage Account</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">


<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<!--				check box				-->
<script type='text/javascript' src="js/custom-form-elements.js"></script>
<!--					check box				-->


<!--tabbed content-->
<script type="text/javascript">

/***********************************************
* Tab Content script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

//Set tab to intially be selected when page loads:
//[which tab (1=first tab), ID of tab content to display]:
var initialtab=[1, "sc1"]

////////Stop editting////////////////

function cascadedstyle(el, cssproperty, csspropertyNS){
if (el.currentStyle)
return el.currentStyle[cssproperty]
else if (window.getComputedStyle){
var elstyle=window.getComputedStyle(el, "")
return elstyle.getPropertyValue(csspropertyNS)
}
}

var previoustab=""

function expandcontent(cid, aobject){
if (document.getElementById){
highlighttab(aobject)
detectSourceindex(aobject)
if (previoustab!="")
document.getElementById(previoustab).style.display="none"
document.getElementById(cid).style.display="block"
previoustab=cid
if (aobject.blur)
aobject.blur()
return false
}
else
return true
}

function highlighttab(aobject){
if (typeof tabobjlinks=="undefined")
collecttablinks()
for (i=0; i<tabobjlinks.length; i++)
tabobjlinks[i].style.backgroundColor=initTabcolor
var themecolor=aobject.getAttribute("theme")? aobject.getAttribute("theme") : initTabpostcolor
aobject.style.backgroundColor=document.getElementById("tabcontentcontainer").style.backgroundColor=themecolor
}

function collecttablinks(){
var tabobj=document.getElementById("tablist")
tabobjlinks=tabobj.getElementsByTagName("A")
}

function detectSourceindex(aobject){
for (i=0; i<tabobjlinks.length; i++){
if (aobject==tabobjlinks[i]){
tabsourceindex=i //source index of tab bar relative to other tabs
break
}
}
}

function do_onload(){
var cookiename=(typeof persisttype!="undefined" && persisttype=="sitewide")? "tabcontent" : window.location.pathname
var cookiecheck=window.get_cookie && get_cookie(cookiename).indexOf("|")!=-1
collecttablinks()
initTabcolor=cascadedstyle(tabobjlinks[1], "backgroundColor", "background-color")
initTabpostcolor=cascadedstyle(tabobjlinks[0], "backgroundColor", "background-color")
if (typeof enablepersistence!="undefined" && enablepersistence && cookiecheck){
var cookieparse=get_cookie(cookiename).split("|")
var whichtab=cookieparse[0]
var tabcontentid=cookieparse[1]
expandcontent(tabcontentid, tabobjlinks[whichtab])
}
else
expandcontent(initialtab[1], tabobjlinks[initialtab[0]-1])
}

if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload


</script>
<!--tabbed content script ends here -->




<!-- ## Data Table  -->
	
    <link rel="stylesheet" type="text/css" href="css/datatable.css"/>
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    
	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.columnFilter.js"></script>
    <script type="text/javascript" language="javascript" src="js/TableTools.js"></script>        
    
    <script type="text/javascript">
        (function($) {
            /*
             * Function: fnGetColumnData
             * Purpose:  Return an array of table values from a particular column.
             * Returns:  array string: 1d data array
             * Inputs:   object:oSettings - dataTable settings object. This is always the last argument past to the function
             *           int:iColumn - the id of the column to extract the data from
             *           bool:bUnique - optional - if set to false duplicated values are not filtered out
             *           bool:bFiltered - optional - if set to false all the table data is used (not only the filtered)
             *           bool:bIgnoreEmpty - optional - if set to false empty values are not filtered from the result array
             * Author:   Benedikt Forchhammer <b.forchhammer /AT\ mind2.de>
             */
            $.fn.dataTableExt.oApi.fnGetColumnData = function(oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty) {
                // check that we have a column id
                if (typeof iColumn == "undefined")
                    return new Array();

                // by default we only want unique data
                if (typeof bUnique == "undefined")
                    bUnique = true;

                // by default we do want to only look at filtered data
                if (typeof bFiltered == "undefined")
                    bFiltered = true;

                // by default we do not want to include empty values
                if (typeof bIgnoreEmpty == "undefined")
                    bIgnoreEmpty = true;

                // list of rows which we're going to loop through
                var aiRows;

                // use only filtered rows
                if (bFiltered == true)
                    aiRows = oSettings.aiDisplay;
                // use all rows
                else
                    aiRows = oSettings.aiDisplayMaster; // all row numbers

                // set up data array   
                var asResultData = new Array();

                for (var i = 0, c = aiRows.length; i < c; i++) {
                    iRow = aiRows[i];
                    var aData = this.fnGetData(iRow);
                    var sValue = aData[iColumn];

                    // ignore empty values?
                    if (bIgnoreEmpty == true && sValue.length == 0)
                        continue;

                    // ignore unique values?
                    else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1)
                        continue;

                    // else push the value onto the result data array
                    else
                        asResultData.push(sValue);
                }

                return asResultData;
            }
        }(jQuery));
        function fnCreateSelect(aData)
        {
            var r = '<select><option value=""></option>', i, iLen = aData.length;
            for (i = 0; i < iLen; i++)
            {
                r += '<option value="' + aData[i] + '">' + aData[i] + '</option>';
            }
            return r + '</select>';
        }
        $(document).ready(function() {
            /*$('#submit').click(function() {
             var sData = $('input', oTable.fnGetNodes()).serialize();
             alert("The following data would have been submitted to the server: \n\n" + sData);
             console.log(sData);
             return false;
             });*/

            var someObj = [];
            $("#submit").click(function() {
                $("input:checkbox").each(function() {
                    if ($(this).is(":checked")) {
                        someObj.push($(this).attr("name"));
                    }
                    console.log(someObj);
                })
            });
            $("#selectAll").click(function() {
                $("input:checkbox").attr('checked', this.checked);
            }
            );
            $("#btn1").live("click", function() {
                alert("Export clicked");
            });
            $("#btn2").live("click", function() {
                alert("print clicked");
            });
            $("#btn3").live("click", function() {
                //alert("hide filters clicked");
                $("tfoot").toggle(700).animate({height: "20px"}, "fast");
                //div.animate({top:'100px'},"slow");
            });
            var oTable = $('#example').dataTable({
                "sDom": '<"pagingTop"<"#refresh">ip>rt<"clear">',
                "sPaginationType": "full_numbers",
                "bLengthChange": false,
                "bPaginate"
                        : false,
                "bFilter"
                        : true,
                "aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0]}
                ],
                /*"aoColumns": [
                 {type:"hidden"},
                 {type: "select", values: ['All', 'Red Cross', 'Save The Bay']},
                 {type: "select", values: ['All', 'Humanitarian', 'Educational', 'Environmental']},
                 null,
                 null,
                 null,
                 {type: "select", values: ['All', 'Approved', 'Pending', 'Rejected']}
                 ],*/
                "bInfo"
                        : false,
                "bAutoWidth"
                        : true}).
                    columnFilter();
            $("#divRefresh").html('<input type="button" classs="btn-table" value="Export" id="btn1"/><input type="button" value="Print" id="btn2" classs="btn-table"><input type="button" value="Hide Filter" id="btn3" classs="btn-table"><input type="button" value="Add Establisment" id="btn4" classs="btn-table" /><input type="button" value="icon_Add Organization" id="btn5" classs="btn-table" />');
            $("tfoot th").each(function(i) {
                if (i >= 3 && i <= 6) {
                    this.innerHTML = fnCreateSelect(oTable.fnGetColumnData(i));
                    $('select', this).change(function() {
                        oTable.fnFilter($(this).val(), i);
                    });
                }
                else {
                    this.innerHTML = "<input type='text' class='search_init'>";
                }
            });
            jQuery("tfoot input").keyup(function() {
                /* Filter on the column (the index) of this element */
                oTable.fnFilter(this.value, jQuery("tfoot input").index(this));
            });
            
            if($("tfoot").is(':visible')){
            jQuery("tfoot input").each(function(i) {
                asInitVals[i] = this.value;
            });
            }


            jQuery("tfoot input").focus(function() {
                if (this.className == "search_init")
                {
                    this.className = "";
                    this.value = "";
                }
            });

            jQuery("tfoot input").blur(function(i) {
                if (this.value == "")
                {
                    this.className = "search_init";
                    this.value = asInitVals[jQuery("tfoot input").index(this)];
                }
            });
            new FixedHeader(oTable, {"top": true});
        });
    </script>
    
     <style>
        #example_length{
            display: none;
        }
        tfoot {
            display: table-header-group;
        }

    </style>

<!-- ## End Data Table  -->
</head>
<body class="main_databg">
<div id="wrap">
<div class="gridContainer clearfix">
  <div id="LayoutDiv1">
    <header>
      <div class="top_color"> 
               
        <a href="" class="school_logo"><img src="img/servicekarma-logo.png" /></a>
        <ul class="top-nav">
          <li>
            <div class="user-picture"><img src="img/icon_profile-preview-small.png" alt="Profile"></div>
            <b><span>Welcome</span><a href="#">John!</a></b></li>
          <li><a href="#">My Account</a></li>
          <li><a href="#">Logout</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
 <div id="main">   
    <nav>
    	<a href="index.php">home</a>
        <!--<a href="manageaccounts.html">Manage accounts</a>-->
        <a href="manageusers.php">Manage Users</a>
        <a href="managereports.php" class="active" >Manage Reports</a>
        <!--<a href="manageevents.html" class="right_border">Manage Events</a>-->

    </nav>
    
    
    <section id="data_container clearfix">
    	<div class="wrapper-910">
        	<div class="header-wrap" id="urreport">
            	<h2 class="page-header">user details </h2>  
                
          </div>
          
          
          <div style="display: block;" id="faq1" class="icongroup1">


<ul id="tablist">
<li><a style="background-color: rgb(255, 255, 255);" href="#" class="current" onclick="return expandcontent('sc1', this)">User Reports</a></li>
<li><a style="background-color: rgb(255, 102, 0);" href="#" onclick="return expandcontent('sc2', this)">Establishment Reports</a></li>

</ul>

<div style="background-color: rgb(255, 255, 255);" id="tabcontentcontainer">

<div style="display: block;" id="sc1" class="tabcontent">

      
        <div id="all_document" class="pending-services-content">
 
          <div class="wrapper-910">
                  <div class="table-buttons">
                    <select name="select" class="btn-select btn-export">
                      <option selected>Export</option>
                      <option>Excel</option>
                      <option>PDF</option>
                    </select>
                    <input type="button" value="Print" class="btn-input btn-print">
                    <input type="button" value="Hide Filter" class="btn-input btn-filter">
                    <select name="select" class="btn-select btn-filter">
                      <option selected>Current Filter:None</option>
                      <option>Update Current Filter</option>
                      <option>Save As</option>
                      <option>Load Filter</option>
    
       
                      <option>Manage Filter</option>
                    </select>
                  </div>
                 
                  <ul class="prev-next">
                    <li><a href="#" class="icon-first"></a></li>
                    <li><a href="#" class="icon-prev"></a></li>
                    <li><a href="#" class="icon-next"></a></li>
                    <li><a href="#" class="icon-last"></a></li>
                  </ul>
                  <span class="items">Items 1-15 of 33</span> </div>
<table  id="example"  class="display">
                    <thead>
                <tr>
           		  <th class="checkcenter"><input type="checkbox" id="selectAll"></th>
               		<th align="left">User Name</th>
                    <th>Affiliation</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>ID</th>
                    <th>Grade</th>
                    <th>Graduation Eligibility</th>
                    <th>Hours Volunteered</th>
                </thead>
                <tfoot>
                    <tr>
                        <th align="center"></th>
                        <th>Organization Name</th>
                        <th>Type Of Event</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
        
                    <tr class="odd_gradeX" id="filter">
                        <td align="center"><input type="checkbox" value="1" name="check1"></td>
                        <td class="read_only">John Smith</td>
                        <td>Irvington High</td>
                        <td>User</td>
                        <td class="center"><span class="read_only">john.smith@yahoo.com</span></td>
                        <td class="center">408-777-1100</td>
                        <td>8070853</td>
                        <td>9</td>
                        <td>Eligible</td>
                        <td>40</td>
                    </tr>
                    <tr class="even_gradeC" id="4">
                        <td align="center"><input type="checkbox" value="2" name="check2"></td>
                        <td class="read_only">Mark Johnson</td>
                        <td>Irvington High</td>
                        <td>User</td>
                        <td class="center"><p>abc@yahoo.com</p>
                        <p>&nbsp;</p></td>
                        <td class="center">408-777-1100</td>
                        <td>4521638</td>
                        <td>9</td>
                        <td>Eligible</td>
                        <td>60</td>
                    </tr>
                    <tr class="odd_gradeX" id="2">
                        <td align="center"><input type="checkbox" value="3" name="check3"></td>
                        <td class="read_only">Katherine Jones</td>
                        <td>Irvington High</td>
                        <td>User</td>
                        <td class="center">abc@yahoo.com</td>
                        <td class="center">408-123-1100</td>
                        <td>1247856</td>
                        <td>10</td>
                        <td>Eligible</td>
                        <td>20</td>
                    </tr>
                    <tr class="even_gradeC">
                      <td align="center"><input type="checkbox" value="3" name="check4"></td>
                      <td class="read_only">Steve Irwin</td>
                      <td>Irvington High</td>
                      <td>User</td>
                      <td class="center">test1234@yahoo.com</td>
                      <td class="center">408-223-1112</td>
                      <td>7542136</td>
                      <td>12</td>
                      <td>Not Eligible</td>
                      <td>100</td>
                    </tr>
                    <tr class="even_gradeC">
                      <td align="center"><input type="checkbox" value="3" name="check5"></td>
                      <td class="read_only">Jospeh Smith</td>
                      <td>Irvington High</td>
                      <td>User</td>
                      <td class="center"><span class="read_only">jo.smith@yahoo.com</span></td>
                      <td class="center">408-777-1100</td>
                      <td>8070853</td>
                      <td>9</td>
                      <td>Not Eligible</td>
                      <td>40</td>
                    </tr>
                    <tr class="even_gradeC">
                      <td align="center"><input type="checkbox" value="3" name="check6"></td>
                      <td class="read_only">Stephan Ross</td>
                      <td>Irvington High</td>
                      <td>Admin</td>
                      <td class="center">sross@hotmail.com</td>
                      <td class="center">408-777-1101</td>
                      <td>4521638</td>
                      <td>9</td>
                      <td>Eligible</td>
                      <td>60</td>
                    </tr>
                    <tr class="even_gradeC">
                      <td align="center"><input type="checkbox" value="3" name="check7"></td>
                      <td class="read_only">Daniel Ross</td>
                      <td>Irvington High</td>
                      <td>User</td>
                      <td class="center">abc@hotmail.com</td>
                      <td class="center">408-123-1100</td>
                      <td>1247856</td>
                      <td>12</td>
                      <td>Eligible</td>
                      <td>35</td>
                    </tr>
                </tbody>
          </table>
            
       	</div>



</div>

<div id="sc2" class="tabcontent">


    <div style="background-color: rgb(255, 255, 255);">

<div style="display: block;" id="sc1" class="tabcontent">



      
        <div id="all_document" class="pending-services-content">
 
          <div class="wrapper-910">
                  <div class="table-buttons">
                    <select name="select" class="btn-select btn-export">
                      <option selected>Export</option>
                      <option>Excel</option>
                      <option>PDF</option>
                    </select>
                    <input type="button" value="Print" class="btn-input btn-print">
                    <input type="button" value="Hide Filter" class="btn-input btn-filter">
                    <select name="select" class="btn-select btn-filter">
                      <option selected>Current Filter:None</option>
                      <option>Update Current Filter</option>
                      <option>Save As</option>
                      <option>Load Filter</option>
    
       
                      <option>Manage Filter</option>
                    </select>
                  </div>
                 
                  <ul class="prev-next">
                    <li><a href="#" class="icon-first"></a></li>
                    <li><a href="#" class="icon-prev"></a></li>
                    <li><a href="#" class="icon-next"></a></li>
                    <li><a href="#" class="icon-last"></a></li>
                  </ul>
                  <span class="items">Items 1-15 of 33</span> </div>
<table  id="example"  class="display">
                    <thead>
                <tr>
           		  <th class="checkcenter"><input type="checkbox" id="selectAll"></th>
               		<th align="left">Est. Name</th>
                    <th>Subtype</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Phone</th>
                    <th>Required Hours</th>
                    <th>URL Alias</th>
                    <th>Total number of users</th>
                </thead>
                <tfoot>
                    <tr>
                        <th align="center"></th>
                        <th>Organization Name</th>
                        <th>Type Of Event</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
        
                  <tr class="odd_gradeX odd" id="filter">
                        <td align="center"><input type="checkbox" value="1" name="check1"></td>
                        <td>Irvington High</td>
                        <td>School</td>
                        <td >Fremont</td>
                        <td>California</td>
                        <td>408-777-1100</td>
                        <td>40</td>
                        <td>Irvington</td>
                        <td>140</td>
                    </tr>
                  <tr class="even_gradeC even" id="4">
                        <td align="center"><input type="checkbox" value="2" name="check2"></td>
                        <td>Oregon High</td>
                        <td>School</td>
                        <td>Portland</td>
                        <td>Oregon</td>
                        <td>408-777-1101</td>
                        <td>60</td>
                        <td>Oregon</td>
                        <td>120</td>
                    </tr>
                    <tr class="even_gradeC even" id="4">
                        <td align="center"><input type="checkbox" value="2" name="check2"></td>
                        <td>Oregon High</td>
                        <td>School</td>
                        <td>Portland</td>
                        <td>Oregon</td>
                        <td>408-777-1101</td>
                        <td>60</td>
                        <td>Oregon</td>
                        <td>120</td>
                    </tr>
                    <tr class="even_gradeC even" id="4">
                        <td align="center"><input type="checkbox" value="2" name="check2"></td>
                        <td>Oregon High</td>
                        <td>School</td>
                        <td>Portland</td>
                        <td>Oregon</td>
                        <td>408-777-1101</td>
                        <td>60</td>
                        <td>Oregon</td>
                        <td>120</td>
                    </tr>
                    <tr class="even_gradeC even" id="4">
                        <td align="center"><input type="checkbox" value="2" name="check2"></td>
                        <td>Oregon High</td>
                        <td>School</td>
                        <td>Portland</td>
                        <td>Oregon</td>
                        <td>408-777-1101</td>
                        <td>60</td>
                        <td>Oregon</td>
                        <td>120</td>
                    </tr>
                 
                </tbody>
            </table>
            
        	</div>



</div>

</div>

</div>

</div>


          
</div>
<section class="wrapper-910 clearfix"></section>

      <!--popup2--><!--popup2-->
      
      
      
    </div>
   
  </div>
</div> 
</div>
</div><!--main-->
</div><!--wrap-->
<footer> <small>Servicekarma 2013</small> 
      
      <!--<div class="soc_area">
        	<a href="" class="fbicn"></a><a href="" class="twticn"></a><a href="" class="blgicn"></a>
        </div>-->
      <div class="ftr_link"> <a href="">About</a> &nbsp;| <a href="">contact</a> &nbsp;| <a href="">feedback</a> </div>
    </footer>
</body>
</html>
