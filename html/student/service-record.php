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
<title>Student - My Service Record</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
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


<!-- ## Data Table  -->
	
    <link rel="stylesheet" type="text/css" href="css/datatable.css"/>
	<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    
	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="js/FixedHeader.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.columnFilter.js"></script>
    <script type="text/javascript" language="javascript" src="js/TableTools.js"></script>        
       <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css?v=2.1.5" media="screen" />       
<script type="text/javascript" language="javascript">
$(document).ready(function() {			
			$('.fancybox').fancybox();
		});
</script>
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
          <li><a href="profile.php">My profile</a></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
   <div id="main"> 
    <nav>
    	<a href="index.php">home</a>
        <a href="#" class="active">My Service Record</a>
        <a href="upcoming-events.php" class="right_border">Upcoming Events</a>
        
        <div class="mnu_ebtn">
        	<button class="button button-bluenew right fancybox fancybox.ajax" href="enter_service_hours.php">enter service hours</button>
        </div>
    </nav>
    
    
    <section id="data_container clearfix">
    	<div class="wrapper-910">
        	<div class="header-wrap">
            	<h2 class="page-header left">How I have changed the world!</h2>
                                
                <div class="hours-details">
                    <div class="hours-description">Required Hours</div>
                    <div class="hours-value">60</div>
                </div>
                
                <div class="hours-details r-margin-10">
                    <div class="hours-description r-margin-10">Approved Service Hours</div>
                    <div class="hours-value">40</div>
                </div>
                
                <div class="hours-details r-margin-10">
                    <div class="hours-description">Pending Service Hours</div>
                    <div class="hours-value">10</div>
                </div>
                
                <div class="clear"></div>
                
            </div>
                    
        </div>
        
        <section class="table-topbar">
        	
        	<div class="wrapper-910">
            	<div class="table-buttons">
                    <select name="" class="btn-select btn-export">
                        <option selected>Export</option>
                        <option>Excel</option>
                        <option>PDF</option>
                    </select>                    
                    <input type="button" value="Print" class="btn-input btn-print">                    
                    <input type="button" value="Hide Filter" class="btn-input btn-filter">                    
                </div>
            	<!--<div id="divRefresh"></div> -->                 	
                <ul class="prev-next">
                	<li><a href="#" class="icon-first"></a></li>
                    <li><a href="#" class="icon-prev"></a></li>
                    <li><a href="#" class="icon-next"></a></li>
                    <li><a href="#" class="icon-last"></a></li>
                </ul>
                <span class="items">Items 1-15 of 33</span>                
            </div>
        </section>
        
        <section class="wrapper-910 clearfix">        
        
        	<table  id="example"  class="display">
                <thead>
                <th align="center"><input type="checkbox" id="selectAll"></th>
                <th>Organization Name</th>
                <th>Type Of Event</th>
                <th>Date Range</th>
                <th>Location</th>
                <th>No of Hours</th>
                <th>Status</th>
                <th>Actions</th>
            </thead>
            <tfoot>
                <tr>
                    <th align="center"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th><input type="text" size="16" style="color:#FFFFFF; font-weight:bold;"></th>
                    <th></th>
                </tr>
            </tfoot>
            <tbody>
    
                <tr class="odd_gradeX" id="filter">
                    <td align="center"><input type="checkbox" value="1" name="check1"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="service-record-details.php" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="2" name="check2"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="service-record-details.php" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="3" name="check3"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="rej_icon">Rejected</span></div></td>
                    <td><a href="service-record-details.php" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="4" name="check4"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="5" name="check5"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="6" name="check6"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="7" name="check7"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="8" name="check8"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="9" name="check9"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="10" name="check10"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="11" name="check11"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="12" name="check12"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="13" name="check13"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="14" name="check14"></td>
                    <td>Red Cross</td>
                    <td>Environmental</td>
                    <td>2012-09-01</td>
                    <td class="center">Def</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="15" name="check15"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Environmental</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="16" name="check16"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">xyz</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="5" name="check5"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="6" name="check6"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="7" name="check7"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="5" name="check5"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="app_icon">Approved</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="even_gradeC" id="4">
                    <td align="center"><input type="checkbox" value="6" name="check6"></td>
                    <td>Red Cross</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
                <tr class="odd_gradeX" id="2">
                    <td align="center"><input type="checkbox" value="7" name="check7"></td>
                    <td class="read_only">Save The Bay</td>
                    <td>Educational</td>
                    <td>2012-09-01</td>
                    <td class="center">Abc</td>
                    <td class="center">23</td>
                    <td><div class="noti_icons"><span class="pend_icon">Pending</span></div></td>
                    <td><a href="#" class="noti_icons"><span class="action_icon"></span></a></td>
                </tr>
            </tbody>
        </table>
            
        
        </section>        
      
    </section>

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
