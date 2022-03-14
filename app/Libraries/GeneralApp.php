<?php

function gender() {
	return [
		[
			'id' => 'N',
			'name' => '--Pilih--'
		],
		[
			'id' => 'L',
			'name' => 'Laki-Laki'
		],
		[
			'id' => 'P',
			'name' => 'Perempuan'
		],
	];
}

function generalFormatArrayInput($array = []) {
	$newArray = [['id' => null, 'name' => 'None']];
	foreach($array as $value) {
		$newArray[] = $value;
	}

	return $newArray;
}