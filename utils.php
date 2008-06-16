<?php

/**
 * Parse a human readable string for a number of bytes
 *
 * @param string Input string
 * @return int Number of bytes
 */
function parse_bytes($str)
{
	if (is_numeric($str))
		return intval($str);
		
	if (preg_match('/([0-9]+)([a-z])/i', $str, $regs))
	{
		$bytes = floatval($regs[1]);
		switch (strtolower($regs[2]))
		{
			case 'g':
				$bytes *= 1073741824;
				break;
			case 'm':
				$bytes *= 1048576;
				break;
			case 'k':
				$bytes *= 1024;
				break;
		}
	}

	return intval($bytes);
}

/**
 * Create a human readable string for a number of bytes
 *
 * @param int Number of bytes
 * @return string Byte string
 */
function show_bytes($bytes)
{
	if ($bytes > 1073741824)
	{
		$gb = $bytes/1073741824;
		$str = sprintf($gb>=10 ? "%dGB" : "%.1fGB", $gb);
	}
	else if ($bytes > 1048576)
	{
		$mb = $bytes/1048576;
		$str = sprintf($mb>=10 ? "%dMB" : "%.1fMB", $mb);
	}
	else if ($bytes > 1024)
		$str = sprintf("%dKB",	 round($bytes/1024));
	else
		$str = sprintf('%dB', $bytes);

	return $str;
}


?>
