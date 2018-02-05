<?php

	function convert($value){															//function to convert UTF8
		$value = preg_replace('/\\\\u00A0/', ' ', $value);
		$value = preg_replace('/\\\\u0026/', '&', $value);
		$value = preg_replace('/\\\\u003C/', '<', $value);
		$value = preg_replace('/\\\\u003E/', '>', $value);
		$value = preg_replace('/\\\\u00E4/', 'ä', $value);
		$value = preg_replace('/\\\\u00C4/', 'Ä', $value);
		$value = preg_replace('/\\\\u00F6/', 'ö', $value);
		$value = preg_replace('/\\\\u00D6/', 'Ö', $value);
		$value = preg_replace('/\\\\u00FC/', 'ü', $value);
		$value = preg_replace('/\\\\u00DC/', 'Ü', $value);
		$value = preg_replace('/\\\\u00DF/', 'ß', $value);
		$value = preg_replace('/\\\\u20AC/', '€', $value);
		$value = preg_replace('/\\\\u0024/', '$', $value);
		$value = preg_replace('/\\\\u00A3/', '£', $value);
		$value = preg_replace('/\\\\u00a0/', ' ', $value);
		$value = preg_replace('/\\\\u003c/', '<', $value);
		$value = preg_replace('/\\\\u003e/', '>', $value);
		$value = preg_replace('/\\\\u00e4/', 'ä', $value);
		$value = preg_replace('/\\\\u00c4/', 'Ä', $value);
		$value = preg_replace('/\\\\u00f6/', 'ö', $value);
		$value = preg_replace('/\\\\u00d6/', 'Ö', $value);
		$value = preg_replace('/\\\\u00fc/', 'ü', $value);
		$value = preg_replace('/\\\\u00dc/', 'Ü', $value);
		$value = preg_replace('/\\\\u00df/', 'ß', $value);
		$value = preg_replace('/\\\\u20ac/', '€', $value);
		$value = preg_replace('/\\\\u00a3/', '£', $value);

		return $value;
	}

 ?>
