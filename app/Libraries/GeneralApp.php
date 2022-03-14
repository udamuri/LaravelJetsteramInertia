<?php

function rupiah($value, $decimals = 0) {
    $result = "Rp " . number_format($value, $decimals, ',', '.');
	return $result;
}

function units() {
	return [
		'KG' => "Kilogram",
		'GR' => "Gram",
		'LT' => "Liter",
		'GL' => "Galon",
		'PCS' => "Pcs",
		'LL' => "Lain nya",
	];
}

function getDistance($latitude1, $longitude1, $latitude2, $longitude2) {
	$lat_origin = (double) $latitude1;
	$long_origin = (double) $longitude1;
	
	$lat_dest = (double) $latitude2;
	$long_dest = (double) $longitude2;

	$radius      = 3958;      # Earth's radius (miles, convert to meters)
	$deg_per_rad = 57.29578;  # Number of degrees/radian (for conversion)

	$distance = ($radius * pi() * sqrt(
				($lat_origin - $lat_dest)
				* ($lat_origin - $lat_dest)
				+ cos($lat_origin / $deg_per_rad)  # Convert these to
				* cos($lat_dest / $deg_per_rad)    # radians for cos()
				* ($long_origin - $long_dest)
				* ($long_origin - $long_dest)
		) / 180);
	
	return number_format(($distance * 1000), 2);
}

function formatDistance($distance = null) {
	$returnValue = "";
	if($distance == null) {
		$returnValue = "-";
	} else {
		if($distance < 1) {
			$returnValue = ((String) round(($distance * 1000), 1)) . " Meter";
		} else {
			$returnValue = (String) round(($distance), 1). " Kilometer";
		}
	}

	return $returnValue;
}

function bankStatusLists() {
	return [
		'reviewed' => "Ditinjau",
		'rejected' => "Ditolak",
		'active' => "Aktif",
	];
}


function bankStatusTranslate($status) {
	$statusTranslate = "none";

	switch ($status) {
		case "reviewed":
			$statusTranslate = "Ditinjau";
			break;
		case "rejected":
			$statusTranslate = "Ditolak";
			break;
		case "active":
			$statusTranslate = "Aktif";
			break;
		default:
			$statusTranslate = "none";
	}

	return $statusTranslate;
}

function roleApiTranslate($role) {
	$statusTranslate = "user";
	switch ($role) {
		case "user":
			$statusTranslate = "user";
			break;
		case "bank":
			$statusTranslate = "bank";
			break;
		case "super-admin":
			$statusTranslate = "sx";
			break;
		case "admin":
			$statusTranslate = "sy";
			break;
		default:
			$statusTranslate = "user";
	}

	return $statusTranslate;
}