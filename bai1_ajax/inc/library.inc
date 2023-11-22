<?php
function initTinh($conn){
	$sql="Select * from tinh order by matinh";
	$rs=mysqli_query($conn,$sql);
	$str="<select id=tinh onChange='tinh()'>";
	while($row=mysqli_fetch_array($rs)){
		$str.="<option value={$row['matinh']}>
						{$row['tentinh']}
				</option>";
	}
	$str.="</select>";
	echo $str;
}

function initHuyen($conn){
	$sql="Select * from huyen where matinh='01'";
	$rs=mysqli_query($conn,$sql);
	$str="<span id=huyen style='margin-left:12px;'>
			<select>";
	while($row=mysqli_fetch_array($rs)){
		$str.="<option value={$row['mahuyen']}>{$row['tenhuyen']}</option>";
	}
	$str.="</select></span>";
	echo $str;
}
?>