<?php
$id=$_GET['var'];
require_once("mysqlconnect.php");
$sql_stat="SELECT count(*) as TOTAL, SUM(t1.mesh_msc) as MSC, SUM(t1.mesh_osteo) as OSTEO, SUM(t1.mesh_adipo) as ADIPO,
				SUM(t1.mesh_chondro) as CHONDRO, SUM(t1.mesh_cancer) as CANCER, SUM(t1.mesh_tumor_stroma) as TUMOR_STROMA,
				SUM(t1.mesh_stemcell) as STEM_CELL, SUM(t1.mesh_CSC) as CANCER_STEM_CELL,SUM(t1.mesh_niche) as NICHE,
				SUM(t1.mesh_apoptosis) AS APOPTOSIS, SUM(t1.mesh_proliferation) as PROLIFERATION, SUM(mesh_tumor_suppressor) as ANTIGROWTH,
				SUM(mesh_angiogenesis) as ANGIOGENESIS, SUM(mesh_unlimited_replication) as IMMORTAL, SUM(mesh_invasion) as INVASION,
				SUM(mesh_inflammation) as INFLAMMATION, SUM(mesh_metabolism) as METABOLISM FROM pubmed t1, pubmed_link t2
				WHERE t2.pubmed_id=t1.pubmed_id AND t2.gene_id=\"".$id."\"";		
			
$result = mysql_query($sql_stat) or die(mysql_error());	
$data = mysql_fetch_array($result);

$im = imagecreatefromjpeg("hallmarks.jpg");

$black = imagecolorallocate($im, 0, 0, 0);
$red = imagecolorallocate($im, 0, 0, 0);
$width = imagesx($im);
$height = imagesy($im);

$font=5; // store the int ID of the system font we're using in $font
$leftTextPos = ( $width - imagefontwidth($font)*strlen($text) )/2;

// printing the text
imagestring($im, $font, 20, 195, $data['APOPTOSIS'], $black);
imagestring($im, $font, 165, 10, $data['PROLIFERATION'], $black);
imagestring($im, $font, 260, 10, $data['ANTIGROWTH'], $black);
imagestring($im, $font, 165, $height-30, $data['ANGIOGENESIS'], $black);
imagestring($im, $font, 260, $height-30, $data['INVASION'], $black);
imagestring($im, $font, $width-40, 195, $data['IMMORTAL'], $black);
imagestring($im, $font, 35, 105, $data['METABOLISM'], $black);
imagestring($im, $font, 35, $height-125, 'X', $black);
imagestring($im, $font, $width-60, 105, 'X', $black);
imagestring($im, $font, $width-60, $height-125, 'X', $black);

// Let the browser know that it is an png image..
header("Content-Type: image/jpeg");

// show the image in png format
imagepng ($im);
?>