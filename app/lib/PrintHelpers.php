<?php

class PrintHelpers {
	public static function printStarRating($rating, $title = null) {
		$rating = floatval($rating);
		if (!$title) {
			$title = "{$rating}/5";
		}
		$ratingString = "<span title=\"{$title}\">";
		
		for ($i=0; $i<5; $i++) {
			if ($rating > 0) {
				$ratingString .= '<i class="fas fa-star">';
				if ($rating < 1) {
					$ratingString .= '<i class="partial" style="--partial: ' . ($rating * 100) . '%"></i>';
				}
				$ratingString .= '</i>';
				$rating -= 1;
			}
			else {
				$ratingString .= '<i class="far fa-star"></i>';
			}
		}

		$ratingString .= '</span>';
		
		return $ratingString;
	}
}