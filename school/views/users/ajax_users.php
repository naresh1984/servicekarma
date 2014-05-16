
<link href="<?php echo BASE_FRONTEND_URL; ?>includes/css/datatable.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_FRONTEND_URL; ?>includes/css/demo_page.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.js"></script>

<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.dataTables.js" ></script>
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/FixedHeader.js" ></script>
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
                    {"bSortable": false, "aTargets": [0,4,8]}
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
				
				if(i>1 && i<7)
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
<script type="text/javascript">
$.noConflict();
</script>
<table  class="display" id="example">
    <thead>
        <th class="checkcenter"><input type="checkbox" id="selectAll"></th>
        <th>Name</th>
        <th>Establishment Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>City</th>
        <th>State</th>
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
            <th></th>
        </tr>
    </tfoot>
    <tbody>   
       <?php 
        /*    echo "<pre>";
            print_r($allUsers);   */
            $i = 1; 			
            foreach($allUsers as $user):
            if($i%2==0)
             $class = 'even';
            else
              $class = 'odd';
        ?>
          <tr class="even_gradeC <?php echo $class; ?>">
              <td align="center"><input type="checkbox" value="<?php echo $user['user_id']; ?>" name="check17"></td>
              <td valign="middle"><?php echo $user['firstname']." ".$user['lastname']; ?></td>
              <td valign="middle"><?php echo $user['establishment_name']; ?></td>
              <td valign="middle"><?php echo $user['email']; ?></td>
              <td valign="middle"><?php echo $user['phone']; ?></td>
              <td valign="middle"><?php echo $user['city']; ?></td>
              <td valign="middle"><?php echo $user['state']; ?></td>
			  <td valign="middle"><?php echo $user['user_status']; ?></td>	
			  <td><a href="<?php echo BASE_FRONTEND_URL; ?>users/editUser/<?php echo $user['user_id']; ?>" class="fancybox fancybox.ajax"><img src="../includes/img/view_edit.png"></a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>