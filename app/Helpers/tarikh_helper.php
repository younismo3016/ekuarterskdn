<?php
if (! function_exists('convert_date_formattodb'))
{
	function convert_date_formattodb($value)
	{
		$Date = explode("/", $value);
				$d = $Date[0];
				$m = $Date[1];
				$year = $Date[2];
				$gabung = $year."-".$m."-".$d;
				return $gabung;
	}
}
if (! function_exists('convert_date_formattodb2'))
{
	function convert_date_formattodb2($value)
	{
		$Date = explode("/", $value);
				$m = $Date[0];
				$d = $Date[1];
				$year = $Date[2];
				$gabung = $year."-".$m."-".$d;
				return $gabung;
	}
}
if (! function_exists('convert_date_db_toview'))
{
	function convert_date_db_toview($value)
	{
		$pieces = explode("-",$value);
		$y = $pieces[0];
		$m = $pieces[1];
		$d = $pieces[2];
		$a=$d."-".$m."-".$y;
		return $a;
	}
}
if (! function_exists('convert_date_db_toview2'))
{
	function convert_date_db_toview2($value)//tukar 2016-09-30 to 30-09-2016
	{
		$pieces = explode("-",$value);
		$y = $pieces[0];
		$m = $pieces[1];
		$d = $pieces[2];
		$a=$d."/".$m."/".$y;
		return $a;
	}
}
