<?php

namespace App\Utils;

class CodeGenerator {

	public static function getCode($id)
	{
		$c = new self();
		return $c->to_4($id);
	}

	private function lfsr($x) {
		return ($x >> 1) ^ (($x&1) ? 0xe10000 : 0);
	}

	private function to_4($x) {
		for($i=0;$i<24;$i++)
			$x = $this->lfsr($x);
		$str = pack("CCC", $x >> 16, ($x >> 8) & 0xff, $x & 0xff);
		return base64_encode($str);
	}

	private function rev_lfsr($x) {
		$bit = $x & 0x800000;
		$x = $x ^ ($bit ? 0xe10000 : 0);
		return ($x << 1) + ($bit ? 1 : 0);
	}

	private function from_4($str) {
		$str = base64_decode($str);
		$x = unpack("C*", $str);
		$x = $x[1]*65536 + $x[2] * 256 + $x[3];
		for($i=0;$i<24;$i++)
			$x = rev_lfsr($x);
		return $x;
	}
}