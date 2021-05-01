<?php

class ClassController extends Controller
{
	public function CourseCatalogAction($search) {
		$search = str_replace([' '], ['+'], $search);
		$url = "https://www.fresnostate.edu/catalog/search/index.html?search={$search}";
		return $this->html(file_get_contents($url));
	}
}