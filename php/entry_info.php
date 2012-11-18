<?php
function retrieve_stat($id){
	require_once("mysqlconnect.php");
	$output=array();			
    $sql_info="SELECT GENE_ID, SYMBOL, NAME, COMPARTMENT, COMPARTMENT2, SECRETED, INTEREST FROM CAF_CLUSTER WHERE GENE_ID=\"".$id."\"";	
	
	$result_info = mysql_query($sql_info) or die(mysql_error());
	
	$row1 = mysql_fetch_array($result_info) or die(mysql_error());
	
	$sql_stat="SELECT count(*) as TOTAL, SUM(t1.mesh_msc) as MSC, SUM(t1.mesh_osteo) as OSTEO, SUM(t1.mesh_adipo) as ADIPO,
				SUM(t1.mesh_chondro) as CHONDRO, SUM(t1.mesh_cancer) as CANCER, SUM(t1.mesh_tumor_stroma) as TUMOR_STROMA,
				SUM(t1.mesh_stemcell) as STEM_CELL, SUM(t1.mesh_CSC) as CANCER_STEM_CELL,SUM(t1.mesh_niche) as NICHE,
				SUM(t1.mesh_apoptosis) AS APOPTOSIS, SUM(t1.mesh_proliferation) as PROLIFERATION, SUM(mesh_tumor_suppressor) as ANTIGROWTH,
				SUM(mesh_angiogenesis) as ANGIOGENESIS, SUM(mesh_unlimited_replication) as IMMORTAL, SUM(mesh_invasion) as INVASION,
				SUM(mesh_inflammation) as INFLAMMATION, SUM(mesh_metabolism) as METABOLISM FROM pubmed t1, pubmed_link t2
				WHERE t2.pubmed_id=t1.pubmed_id AND t2.gene_id=\"".$id."\"";		
			
	$result_stat = mysql_query($sql_stat) or die(mysql_error());	
	$row2 = mysql_fetch_array($result_stat) or die(mysql_error());
	$output=$row1+$row2;
	return $output;
}
?>