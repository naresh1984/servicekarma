<?php $page_title = "Service Karma"; ?>
<?php include HOME . DS . 'includes' . DS . 'header.php'; ?>    

<div id="main">  

<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?> 
    
   
    <section id="data_container clearfix">
    	<div class="wrapper-910">
        	<div class="header-wrap">
            	<h2 class="page-header">Reports</h2>                
            </div>
                    
        </div>

<!-- Data Tables start - html -->
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
                "bLengthChange": true,
                "bPaginate"
                        : true,
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
				"iDisplayLength": 5,
                "bInfo"
                        : true,
                "bAutoWidth"
                        : true}).
                    columnFilter();
            $("#divRefresh").html('<input type="button" classs="btn-table" value="Export" id="btn1"/><input type="button" value="Print" id="btn2" classs="btn-table"><input type="button" value="Hide Filter" id="btn3" classs="btn-table"><input type="button" value="Add Establisment" id="btn4" classs="btn-table" /><input type="button" value="icon_Add Organization" id="btn5" classs="btn-table" />');
            $("tfoot th").each(function(i) {			
                if (i >= 3 && i <= 6) {				
                    this.innerHTML = "<input type='text' class='search_init'>";
                }
                else {
					if(i==0 || i==7)
					{
							this.innerHTML = "<input type='text' class='search_init'>";
					}
					else
					{						
                   		 this.innerHTML = "<input type='text' class='search_init'>";
					}
                }
            });
            jQuery("tfoot input").keyup(function() {
                /* Filter on the column (the index) of this element */
                oTable.fnFilter(this.value, jQuery("tfoot input").index(this));
            });
            
            if($("tfoot").is(':visible')){
            jQuery("tfoot input").each(function(i) {
                //asInitVals[i] = this.value;
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
           // new FixedHeader(oTable, {"top": true});
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
 
 <?php
 /* echo "<pre>";
  print_r($users_details);*/
    function convertToHoursMins($time) {
    settype($time, 'integer');
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return array($hours, $minutes);
   }
 ?>
<div class="wrapper-910">     
    <div id="tabs">
        
        <div id="tabs-1">            
            <div class="table-buttons">
                <select name="select" class="btn-select btn-export" onChange="coming();">
                      <option selected>Export</option>
                      <option>Excel</option>
                      <option>PDF</option>
                    </select>
                    <input type="button" value="Print" class="btn-input btn-print" onClick="coming();">
                    <input type="button" value="Hide Filter" class="btn-input btn-filter" onClick="coming();">
                    <select name="select" class="btn-select btn-filter" onChange="coming();">
                      <option selected>Current Filter:None</option>
                      <option>Update Current Filter</option>
                      <option>Save As</option>
                      <option>Load Filter</option>
    
       
                      <option>Manage Filter</option>
                    </select>
            </div>    
            <div class="clear"></div>   
            <div>
                <table  id="example"  class="display">
                    <thead>
                <tr>
           		  <th class="checkcenter"><input type="checkbox" id="selectAll"></th>
               		<th align="left">User Name</th>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                <?php foreach($users_details as $user_info):
				$convert_minits = convertToHoursMins($user_info['minutes']);
				if(count($convert_minits) == 0){
					$convert_minits = array(0,0);
				}
				$gradeArr = array("1"=>"12","2"=>"11","3"=>"10","4"=>"9");
				$current_year =date("Y", strtotime(@$user_info['created_date']));
				$graduation_year_diff = $user_info['graduation_year']-$current_year;
				@$grade = $gradeArr[$graduation_year_diff];
				
				if($user_info['required_hours'] <= $user_info['hours'])
				$eligible = 'Eligible';
				else
				$eligible = 'NOT Eligible';
				
				 ?>
                    <tr class="odd_gradeX" id="filter">
                        <td align="center"><input type="checkbox" value="1" name="check1"></td>
                        <td class="read_only"><a href="studentinfo/<?php echo $user_info['id']; ?>" class="fancybox fancybox.ajax"><?php echo $user_info['firstname'].' '.$user_info['lastname']; ?></a></td>
                        <td class="center"><span class="read_only"><?php echo $user_info['email']; ?></span></td>
                        <td class="center"><?php echo $user_info['phone']; ?></td>
                        <td><?php echo $user_info['student_id']; ?></td>
                        <td><?php echo @$grade; ?></td>
                        <td><?php echo $eligible; ?></td>
                         <td><?php echo $convert_minits[0]+$user_info['hours'].':'.$convert_minits[1]; ?></td>
                    </tr>
                <?php endforeach; ?> 
                </tbody>
          </table>
            
            
            
            </div>
            

        </div>
        
    </div>
</div>        

 <div class="clear"></div>
</section>
    <div class="clear40"></div>
    
  </div>
</div>
</div><!--main-->
</div><!--wrap-->
<a class="fancybox fancybox.ajax" id="newcontact" href="comingsoon" ></a>

<script language="javascript">
function coming(){
	 $("#newcontact").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
}
</script>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>