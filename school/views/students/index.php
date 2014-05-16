<?php $page_title = "Student - Admin Manage Account"; ?>
<?php include HOME . DS . 'includes' . DS . 'header.php'; ?>

<div id="main">
<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?>
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

			/*$( "#addUser" ).click(function() {
					$('#userAddLink').click();
			});
			$( "#importUser" ).click(function() {
					$('#newcontact').click();
			});*/
			$( "#deleteBtn" ).click(function() {
					
					var oTable = $('#example').dataTable();
					var sData = jQuery('input:checked', oTable.fnGetNodes());	
					var numChk = sData.length;
					if(numChk>0){
						var conf = confirm('Are you sure you want to delete?');
						if(conf){
							var rowids = '';							
							
							sData.each(function(index, elem) {
								if(rowids!=""){
									rowids = rowids+','+$(elem).val();
								}else{
									rowids = $(elem).val();	
								}
								
								//remove rows from datatable
								var target_row = $(elem).closest("tr").get(0); // this line did the trick
								var aPos = oTable.fnGetPosition(target_row); 
								oTable.fnDeleteRow(aPos);
								
								
							});
							
							if(rowids!=''){
							$.ajax({
									   type: "GET",
									   url: "../students/deleteuser",		   
									   data: "sid="+rowids+"&xxxxx="+Math.random(),
									   success: function(result){
											
										}
								 });
							}
							
						}
				
					}else{
						alert('Select at least one student');
					}
					

					
					//var aTrs = oTable.fnGetNodes();
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
                    {"bSortable": false, "aTargets": [0,5,7]}
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
                        : true,
                "bAutoWidth"
                        : true}).
                    columnFilter();
            $("#divRefresh").html('<input type="button" classs="btn-table" value="Export" id="btn1"/><input type="button" value="Print" id="btn2" classs="btn-table"><input type="button" value="Hide Filter" id="btn3" classs="btn-table"><input type="button" value="Add Establisment" id="btn4" classs="btn-table" /><input type="button" value="icon_Add Organization" id="btn5" classs="btn-table" />');
            $("tfoot th").each(function(i) {
                
                    this.innerHTML = "<input type='text' class='search_init'>";
                
            });
            jQuery("tfoot input").keyup(function() {
                /* Filter on the column (the index) of this element */
                oTable.fnFilter(this.value, jQuery("tfoot input").index(this));
            });
            var asInitVals = Array();
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
#example_length {
	display: none;
}
tfoot {
	display: table-header-group;
}
</style>

<!-- ## End Data Table  -->

<section id="data_container clearfix">
<div class="wrapper-910">
  <div class="header-wrap">
    <h2 class="page-header">Users</h2>
  </div>
</div>
<section class="table-topbar">
  <div class="wrapper-910">
    <div class="table-buttons">
      <select name="newUser" id="newUser" class="btn-select btn-add-adduser" onChange="adduser_link(this.value);">
        <option value="add" id="addUser">Add Student</option>
        <option value="import" id="importUser">Excel</option>
        <!--<option>PDF</option>-->
      </select>
      <a href="<?php echo BASE_FRONTEND_URL; ?>students/add" class="fancybox fancybox.ajax" id="userAddLink"></a> <a href="<?php echo BASE_FRONTEND_URL; ?>students/import" class="fancybox fancybox.ajax" id="userImportLink" ></a>
      <input type="button" value="Delete Student" class="btn-input btn-add-deleteuser" id="deleteBtn">
      <select name="" class="btn-select btn-export" onChange="coming();">
        <option selected>Export</option>
        <option>Excel</option>
        <option>PDF</option>
      </select>
      <input type="button" value="Print" class="btn-input btn-print" onClick="coming();">
      <input type="button" value="Hide Filter" class="btn-input btn-filter" onClick="coming();">
    </div>
    <!--<div id="divRefresh"></div> --> 
    
  </div>
</section>
<section class="wrapper-910 clearfix">
  <table  id="example"  class="display" style="text-align:left">
    <thead>
    <th width="7%" align="center"><input type="checkbox" id="selectAll"></th>
      <th width="20%"> Name</th>
      <th width="12%">Student ID</th>
      <th width="8%">Grade</th>
      <th width="25%">Email</th>
      <th width="10%">Phone</th>
      <th width="32%">Required Hours</th>
      <th width="20%">Options</th>
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
				print_r($allUsers);   */
				$i = 1; 			
			foreach($allUsers as $user):
				if($i%2==0)
				 $class = 'even';
				else
				  $class = 'odd';
				 
				$gradeArr = array("1"=>"12","2"=>"11","3"=>"10","4"=>"9");
				$current_year =date("Y", strtotime(@$user['created_date']));
				$graduation_year_diff = $user['graduation_year']-$current_year;
				@$grade = $gradeArr[$graduation_year_diff];
				 $user['graduation_year'].$current_year;
				  
            ?>
      <tr  class="even_gradeC <?php echo $class; ?>">
        <td align="center"><input type="checkbox" value="<?php echo $user['user_id']; ?>" name="check_<?php echo $user['user_id']; ?>"></td>
        <td valign="middle"><?php echo $user['firstname']." ".$user['lastname']; ?></td>
        <td valign="middle"><?php echo $user['student_id']; ?></td>
        <td valign="middle" class="center"><?php echo $grade; ?></td>
        <td valign="middle" class="center"><?php echo $user['email']; ?></td>
        <td><?php echo $user['phone']; ?></td>
        <td><?php echo $user['required_hours']; ?></td>
        <td><a href="<?php echo BASE_FRONTEND_URL; ?>students/editUser/<?php echo $user['user_id']; ?>" class="fancybox fancybox.ajax"><img src="../includes/img/edit.png" width="18px" title="View/Edit"></a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<section class="wrapper-800 clearfix"> 
  <!--popup1--><!--popup1--> 
  
</section>

<!--popup2--><!--popup2-->

<section class="wrapper-910 clearfix"> </section>
</div>
</div>
</div>
<!--main-->
</div>
<!--wrap-->
</div>
<a class="fancybox fancybox.ajax" id="newcontact" href="comingsoon" ></a>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>
<script language="javascript">
function coming(){
	 $("#newcontact").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
}
function adduser_link(str){
	
	if(str=='add'){
		 $("#userAddLink").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
	}else if(str=='import'){
		 $("#newcontact").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
	}
}
</script>