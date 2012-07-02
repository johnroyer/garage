<?php

	//---------------- Google Chart ----------------
	function show_pic($xlen,$ylen,$type,$data,$text){
		if( sizeof($data) != sizeof($text) )
			exit();

		$url = "http://chart.apis.google.com/chart?";
		$resized_data = resize_data($data,$xlen,$ylen);
		$cht = cht($type);
		$chx = chx($data,$text);
		if($type=="radar")
			$resized_data[] = $resized_data[0];
		$chd = chd($resized_data);
		$chs = chs($xlen,$ylen);
		return $url.$chs."&".$cht."&".$chd."&".$chx;
	}

	function cht($t){
		if( $t=="line" )
			return "cht=lc&chm=D,4D89F9,0,0,2,0";
		if( $t=="radar" )
			return "cht=r&chm=B,FF990080,0,1,100.0&chco=FF9900";
	}

	function chx($data,$text){
		if( !is_array($text) )
			echo "chx error";
		$s="";
		foreach($text as $str){
			$s .= "|".$str;
		}
		$min = min($data);
		$max = max($data);
		return "chxt=y,x&chxl=0:|$min|$max|1:".$s;
	}

	function chd($data){
		if( !is_array($data) )
			echo "chd error";
		$length = sizeof($data);
		$out="";
		$a=0;
		foreach($data as $val){
			$out.="$val";
			if( $a < $length-1 ){
				$out.=",";
				$a++;
			}
		}
		return "chd=t:".$out;
	}

	function resize_data($data,$x,$y){
		// resize data to maximun = 100, minimun = 0
		if( !is_array($data) )
			echo "resize error";
		$limit = 100;
		$max = max($data);
		foreach($data as $val){
			@$out[] = (int)( $limit * ($val / $max) );
		}
		return $out;
	}

	function chs($x,$y){
		if( !is_int($x) || !is_int($y) ){
			echo "chs error";
		}elseif($x > 0 && $y > 0){
			return "chs=".$x."x".$y;
		}
	}

?>