<?php

class PrintHelpers {
	public static function printStarRating($rating) {
		$rating = floatval($rating);
		$ratingString = '';
		
		for ($i=0; $i<5; $i++) {
			if ($rating > 0) {
				$ratingString .= '<i class="fas fa-star" style="color:#FED000;">';
				if ($rating < 1) {
					if ($rating < 0.25) {
						$rating = 0.25;
					}
					elseif ($rating > 0.7) {
						$rating = 0.7;
					}
					$ratingString .= '<i class="partial" style="--partial: ' . ($rating * 100) . '%"></i>';
				}
				$ratingString .= '</i>';
				$rating -= 1;
			}
			else {
				$ratingString .= '<i class="far fa-star"></i>';
			}
		}
		
		return $ratingString;
	}
}