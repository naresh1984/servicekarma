<?php $page_title = "Service Karma"; ?>
<?php include HOME . DS . 'includes' . DS . 'header.php'; ?>    

<div id="main">  

<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?>
    
<?php
/*echo "<pre>";
print_r($allServiceRecordsHours);*/
function convertToHoursMins($time) 
{
	settype($time, 'integer');
	if ($time < 1) 
	{
		return;
	}
	$hours = floor($time / 60);
	$minutes = ($time % 60);
	return array($hours, $minutes);
}

$convert_pending_minutes = convertToHoursMins($allServiceRecordsHours['pending_minutes']);
if(count($convert_pending_minutes) == 0)
{
	$convert_pending_minutes = array(0,0);
}

$convert_approved_minutes = convertToHoursMins($allServiceRecordsHours['approved_minutes']);
if(count($convert_approved_minutes) == 0)
{
	$convert_approved_minutes = array(0,0);
}
?>   
    <section id="data_container clearfix">
    	<div class="wrapper-910">
        	<div class="header-wrap">
            	<h2 class="page-header left" style="padding-top:10px;">How I have changed the world!</h2>                                
                <div class="hours-details">
                    <div class="hours-description">Required Hours</div>
                    <div class="hours-value" style="width:40px;"><?php echo $allServiceRecordsHours['required_hours'].":".$allServiceRecordsHours['required_minutes']; ?></div>
                </div>
                
                <div class="hours-details r-margin-10">
                    <div class="hours-description r-margin-10">Approved Service Hours</div>
                    <div class="hours-value" style="width:40px;"><?php echo $allServiceRecordsHours['approved_hours']+$convert_approved_minutes[0].":".$convert_approved_minutes[1]; ?></div>
                </div>
                
                <div class="hours-details r-margin-10">
                    <div class="hours-description">Pending Service Hours</div>
                    <div class="hours-value" style="width:40px;"><?php echo $allServiceRecordsHours['pending_hours']+$convert_pending_minutes[0].":".$convert_pending_minutes[1]; ?></div>
                </div>                
                <div class="clear"></div>                
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
                    {"bSortable": false, "aTargets": [0,2,4,7]}
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
					
					$("#sss").click(function(){
  //oTable.fnFilter('35');
var data = oTable._('tr', {"filter": "applied"});

// Do something with the data
alert( JSON.stringify(data)+" rows matched the filter" );
});
					
					
            $("#divRefresh").html('<input type="button" classs="btn-table" value="Export" id="btn1"/><input type="button" value="Print" id="btn2" classs="btn-table"><input type="button" value="Hide Filter" id="btn3" classs="btn-table"><input type="button" value="Add Establisment" id="btn4" classs="btn-table" /><input type="button" value="icon_Add Organization" id="btn5" classs="btn-table" />');
            $("tfoot th").each(function(i) {               
/*				 if (i == 2 || i == 7) {
                    this.innerHTML = fnCreateSelect(oTable.fnGetColumnData(i));
                    $('select', this).change(function() {
                        oTable.fnFilter($(this).val(), i);
                    });
                }
                else {
						if(i==0 || i==8)
						{
								this.innerHTML = "";
						}
						else
						{						
							 this.innerHTML = "<input type='text' class='search_init'>";
						}                   
                }*/
				
				if (i == 5 || i == 6) {
                    this.innerHTML = fnCreateSelect(oTable.fnGetColumnData(i));
                    $('select', this).change(function() {
                        oTable.fnFilter($(this).val(), i);
                    });
                }				
				else if(i>1 && i<7)
				{						
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
<!-- Data Tables end - html -->
       
       	
 <div class="wrapper-910">     


            
            <div class="table-buttons">            	
                <select name="select" class="btn-select btn-export" onChange="coming();">
                    <option selected>Export</option>
                    <option>Excel</option>
                    <option>PDF</option>
                </select>
                <input type="button" value="Print" class="btn-input btn-print" onClick="coming();">
                <input type="button" value="Hide Filter" class="btn-input btn-filter" onClick="coming();">

            </div>    
            <div class="clear"></div>   
            <div id="users_list_div">
                <table  class="display" id="example">
                    <thead>
                        <th class="checkcenter"><input type="checkbox" id="selectAll"></th>
                        <th>Organization / Event</th>
                        <th>Date Range</th>
                        <th>Location</th>
                        <th>No of Hours</th>
                        <th>Document Provided?</th>  
                        <th>Status</th> 						                       
                        <th>Options</th>
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
                       <?php 
						/*    echo "<pre>";
							print_r($allServiceRecords);   */
							$i = 1; 			
							foreach($allServiceRecords as $serviceRecord):
							if($i%2==0)
							 $class = 'even';
							else
							  $class = 'odd';
						?>
						  <tr class="even_gradeC <?php echo $class; ?>">
							  <td align="center"><input type="checkbox" value="<?php echo $serviceRecord['service_hours_id']; ?>" name="check17"></td>
							  <td valign="middle"><?php echo $serviceRecord['organization_event']; ?></td>
							  <td valign="middle"><?php echo date("m/d/Y", strtotime(@$serviceRecord['from_date']))." - ".date("m/d/Y", strtotime(@$serviceRecord['to_date'])); ?></td>
                              <td valign="middle"><?php echo $serviceRecord['street1']."<br />".$serviceRecord['city']." ".$serviceRecord['state_code']." ".$serviceRecord['zipcode']; ?></td>
							  <td valign="middle"><?php echo $serviceRecord['hours'].":".$serviceRecord['minutes']; ?></td>	
							  <td valign="middle"><?php if(@$serviceRecord['document']!='') { echo "Yes"; } else { echo "No"; } ?></td>
                               <td valign="middle"><?php echo $serviceRecord['is_approved']; ?></td>					
							  <td><a href="<?php echo BASE_FRONTEND_URL; ?>servicerecord/viewServicerecord/<?php echo $serviceRecord['service_hours_id']; ?>" class="fancybox fancybox.ajax"><img src="../includes/img/edit.png" width="18px" title="View/Edit"></a></td>
							</tr>
						<?php endforeach; ?>       
                    </tbody>
                </table>
            
            
            
            </div>
            



   
</div>        

 <div class="clear"></div>
</section>
    <div class="clear40"></div>
    
  </div>

  <a class="fancybox fancybox.ajax" id="newcontact" href="comingsoon" ></a>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>
<script language="javascript">
function coming(){
	 $("#newcontact").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
}
</script>