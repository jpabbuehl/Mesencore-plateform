<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>                                                                  
	<head>
		<?php $entry=$_GET['var'];
		require("/php/entry_info.php");
		$data=array();
		$data=retrieve_stat($entry);					
		?>

		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />	
		<style type="text/css">@import "css/entry.css";</style>
		<script type="text/javascript" src="js/jquery.js"></script>		
        <script src="js/jquery.dataTables.js" type="text/javascript"></script>
		<script src="js/jquery.jeditable.js" type="text/javascript"></script>		
		<script src="js/jquery.dataTables.editable.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js" type="text/javascript"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>
		<script src="js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>	
		<link type="text/css" href="css/jquery.dataTables_themeroller.css" rel="stylesheet" />	
		<script type="text/javascript"> 
		function getUrlVars() {
			var vars = {};
			var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
				vars[key] = value;
				});
			return vars;
		}
		var id = getUrlVars()["var"];	
		
			$(document).ready(function() {
				var oTable = $('#drug').dataTable( {
        			"bJQueryUI": true,	
					//"bStateSave": true,
					//"sPaginationType": "full_numbers",
					"bProcessing": true,
					//"bAutoWidth": true,
					"sAjaxSource": "php/entry_sp.php",
					"fnServerParams": function (aoData) { aoData.push({ "name": "interest", "value": id }) },
					//"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
					"fnDrawCallback": function () {
						$('td.test').editable( '\php\entry_drug_edit.php', {
							"callback": function( sValue, y ) {
							/* Redraw the table from the new data on the server */
							oTable.fnDraw();
							},
							"height": "14px"
						} );
					}
				});					
				var oTable = $('#publication').dataTable( {
        			"bJQueryUI": true,	
					//"bStateSave": true,
					//"sPaginationType": "full_numbers",
					"bProcessing": true,
					"sAjaxSource": "php/entry_pubmed.php",
					"fnServerParams": function (aoData) { aoData.push({ "name": "interest", "value": id }) },
					"sDom": 'T<"clear"><"H"lfr>t<"F"ip>',
					"fnDrawCallback": function () {
						$('td.test').editable( 'php/entry_drug_edit.php', {
							"callback": function( sValue, y ) {
							/* Redraw the table from the new data on the server */
							oTable.fnDraw();
							},
							"height": "14px"
						} );
					}
				});
			});
		</script>                                                               
	</head>
	<body>
		<div id="container">
		  <div class="title"><h1><?php echo $data['SYMBOL']?> - <?php echo $data['NAME']?></h1></div>  
		  <div class="pubmed">
		  <h1>Publication</h1>	
			   <table cellpadding="0" cellspacing="0" border="0" class="display" id="publication">
				   <thead>
						<tr>
							<th>Title</th>
							<th>Interest</th>
						</tr>
					</thead>
					<tbody></tbody>	
					<tfoot>
						<tr>
							<th>Title</th>
							<th>Interest</th>
						</tr>
					</tfoot>
				</table>
		</div>				
		<div class="summary">
				<img src="php/make_mesh_hallmarks.php?var=<?php echo $entry;?>">
				<table id="paper">
					<thead>
					<tr>
						<th>Publication</th>
						<th>Numbers</th>
					</tr>
					</thead>
					<tbody>
						<tr>
							<td>Total</td><td><?php	echo $data['TOTAL']?></td>
						</tr>
						<tr>			
							<td>Stem cell</td><td><?php	echo $data['STEM_CELL']?></td>
						</tr>
						<tr>			
							<td>Mesenchymal stem cell</td><td><?php	echo $data['MSC']?></td>
						</tr>
						<tr>		
							<td>Adipogenesis</td><td><?php echo $data['ADIPO']?></td>
						</tr>
						<tr>
							<td>Osteogenesis</td><td><?php echo $data['OSTEO']?></td>
						</tr>
						<tr>			
						<td>Chondrogenesis</td><td><?php echo $data['CHONDRO']?></td>
						</tr>
					</tbody>
				</table>
		</div>
		<div class="comments">
		
		
		</div>
		<div class="inhibitors">
			<table cellpadding="0" cellspacing="0" border="0" id="drug">
				   <thead>
						<tr>
							<th>Drug Name</th>
							<th>CAS</th>
							<th>Source</th>
						</tr>
					</thead>
					<tbody></tbody>	
					<tfoot>
						<tr>
						    <th>Drug Name</th>
							<th>CAS</th>
							<th>Source</th>
						</tr>
					</tfoot>
			</table>
		</div>
		</div>
	
	</body> 
	
</html>
