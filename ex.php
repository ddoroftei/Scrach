<?php
@include("simple_html_dom.php");

if (!function_exists('str_contains')) {
	function str_contains($haystack, $needle) {
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}

for ($i = 1; $i <= 4; $i++){
	$xml = simplexml_load_string(file_get_contents('https://sildor.ro/sitemaps/product-sitemap'.$i.'.xml'));
	foreach ($xml->url as $url ){
		if(str_contains($xml->url->loc, 'https://sildor.ro/shop/')){
				continue;
		}
		$html = file_get_html($url->loc);
		product($html);
		echo '<br/>';
//		exit(1);
	}

}

function product($html){

	$get_crumbs = $html->find("nav[class='woocommerce-breadcrumb']");
	$crumbs= explode('&nbsp;&#47;&nbsp;',$get_crumbs[0]->plaintext);
	if(sizeof($crumbs) <=4){

		echo 'Menu '. $crumbs[1].'<br/>';
		echo 'Category '. $crumbs[2].'<br/>';
		echo 'Title '. $crumbs[3].'<br/>';

	}else if(sizeof($crumbs) <= 5){

		echo 'Menu '. $crumbs[1].'<br/>';
		echo 'Category '. $crumbs[2].'<br/>';
		echo 'Sub-Category '. $crumbs[3].'<br/>';
		echo 'Title '. $crumbs[4].'<br/>';

	}else{

		echo 'Menu '. $crumbs[1].'<br/>';
		echo 'Category '. $crumbs[2].'<br/>';
		echo 'Manufacturer '. $crumbs[3].'<br/>';
		echo 'Sub-category '. $crumbs[4].'<br/>';
		echo 'Title '. $crumbs[5].'<br/>';
	}


	$get_information = $html->find(".elementor-element-d1309a2 > div:nth-child(1) > p:nth-child(1)");
	$get_info = $html->find('div[class="column"]');
	echo '<br/>'.'Descriere: '.'<br/>';
	if($get_info){

		$info = explode('; ',trim(str_replace('m ','m; ',$get_info[0]->plaintext)));
		$infor = str_replace(array(' ', 'Dimensiuni:'),'',$info);

		foreach($infor as $inf){
			echo $inf.'<br/>';

		}
	}else{

		$information = explode('</p>', trim(str_replace(array('<p>','<strong>', '</strong>', '<strong style="font-size: 16px;">'),'',$get_information[0]->innertext)));


		foreach ($information as $info){
			$filter = str_contains($info, 'Fisa');
			$filter2 = str_contains($info,'Detalii');

			if(!$filter && !$filter2 ){

				echo $info.'<br/>';
			}
		}
	}


	$get_price = $html->find('p.price > span:nth-child(1) > bdi:nth-child(1)');
	if($get_price != NULL){

		$set_price = explode(' ', trim(str_replace("&nbsp;&euro;", "", $get_price[0]->plaintext)));
		$price = str_replace(',','.',$set_price[0]);
		echo 'Price '.((float)$price).'<br/>';
	}else{
		echo 'Price disponible soon'.'<br/>';
	}
}






