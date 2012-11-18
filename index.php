<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>                                                                  
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />	
		<script type="text/javascript" src="js/jquery.js"></script>		
        <script src="js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="js/jquery.jeditable.js" type="text/javascript"></script>		
		<script src="js/jquery.dataTables.editable.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>
		<script src="js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>	
		<link type="text/css" href="css/jquery.dataTables_themeroller.css" rel="stylesheet" />	
		<script type="text/javascript"> 		
			$(document).ready(function() {
				var oTable = $('#example').dataTable( {
					"bProcessing": true,
					"bJQueryUI": true,
					"sAjaxSource": "php/server_processing.php",
					"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
					"bAutoWidth": false,
					"bServerSide": true,				
					"iDisplayLength" :100,
					"iDisplayStart": 0,
					"aLengthMenu": [[100, 500, 1000, 2000, 2500, -1], [100, 500, 1000, 2000, 2500, "All"]],
					"aoColumnDefs": [
						{ "fnRender": function ( oObj ) {
							return '<a href="entry.php?var='+oObj.aData[0]+'">ENSMUST'+oObj.aData[0]+'</a>'; },
							"mDataProp": null,
							"sDefaultContent": "Edit",
							"sClass": "my_class",
							"aTargets": [0]
						},
						{"sWidth": "1000%", "aTargets": [ 1 ]} 
					],
					"aoColumns": [
						{ "sClass": "center", "sWidth": "5%"},
						{ "sClass": "center","sSortDataType": "dom-text","sWidth": "1px" },
						null,
						null,
						null,
						null,
						null,
						null,
					]
				});
			/*	$('#example').dataTable().columnFilter({ 	
					sPlaceHolder: "head:before"
					});
			*/
				$("#example").dataTable().columnFilter( {
					sPlaceHolder: "head:after",
					aoColumns:[
						null,
						{type: "text"},
						{type: "text"},
						{type: "number"},	
						{type: "number"},
						null,
						null,
						{type: "select", values:['0','1']},
					]
				});
			
				$("#example.", oTable.fnGetNodes()).editable( 'php/editable_ajax.php', {
                    "callback": function( sValue, y ) {
                        var aPos = oTable.fnGetPosition( this );
                        oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                    },
                    "submitdata": function ( value, settings ) {
                        return {
                            "row_id": this.parentNode.getAttribute('id'),
                            "column": oTable.fnGetPosition( this )[2]
                        };
                    },
                    "height": "14px"
                });
			});
		</script>   
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Tabs
				$('#tabs').tabs();

				// Dialog
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						},
						"Cancel": function() {
							$(this).dialog("close");
						}
					}
				});

				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				// Datepicker
				$('#datepicker').datepicker({
					inline: true
				});

				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				// Progressbar
				$("#progressbar").progressbar({
					value: 20
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

			});
		</script>
		<style type="text/css">
			/*demo page css*/
			body{ font: 70% "Trebuchet MS", sans-serif; margin: 5px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>
		
	</head>                                                                 
	<body id="dt_example">
		<div id="container">
		  <h1>Cancer-associated fibroblast Cluster</h1>			   	
			   <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
				   <thead>
						<tr>
							<th>Ensembl ID</th>
							<th>Symbol</th>
							<th>Name</th>
							<th>LCM Arrays</th>
							<th>CD10 Arrays</th>
							<th>PROTEIN</th>
							<th>Secreted</th>
							<th>Interest</th>
						</tr>
					</thead>
					<tbody></tbody>	
					<tfoot>
						<tr>
							<th>Ensembl ID</th>
							<th>Symbol</th>
							<th>Name</th>
							<th>LCM Arrays</th>
							<th>CD10 Arrays</th>
							<th>PROTEIN</th>
							<th>Secreted</th>
							<th>Interest</th>
						</tr>
					</tfoot>
				</table>  				                             
		</div>	 
	</body>                                                                 
</html>
