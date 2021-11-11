<?php
@include("simple_html_dom.php");
$html = file_get_html("https://schiessl.ro/motoare-ventilator/1052-motor-ventilator-ecm-12.html");   //     localhost/Scrach/exe.php


//$results = $html->find( 'script',15)->innertext; //de inloucit cu alta cale de a alfla elementul   #main > script:nth-script(1)
//$results = $html->find('#main > section > script[2]', 0)->innertext; //de inloucit cu alta cale de a alfla elementul
//$results = $html->find('.breadcrumb-container > ul > li:nth-child()', 0)->innertext; //.breadcrumb-container > ul:nth-child(2) > li:nth-child(2)

	$crumbs = $html->find("span[itemprop='name']");

	echo 'Meniu '.$meniu = $crumbs[1]->plaintext'<br/>';
	echo 'Categorie '.$categorie= $crumbs[2]->plaintext'<br/>';
	if(sizeof($crumbs) == 5){
		echo 'Subcategorie  '.$subcategorie= $crumbs[3]->plaintext'<br/>';
		echo 'Titlu '.$titlu= $crumbs[4]->plaintext'<br/>';
	}else{
		echo 'Titlu '.$titlu= $crumbs[3]->plaintext'<br/>';
	}

	$cost = $html->find('span[class="price"]');
	if($cost){
		echo 'Pret '.$price = trim($cost[0]->plaintext, "lei /bucata                       ").'<br/>';
	}else{
		$cost=$html->find('span[class="status-product"]');
		echo 'Precomanda '. $precomanda = $cost[0]->plaintext.'<br/>';
	}

	$desc = $html->find('.product-short-description > p:nth-child()');
	echo 'Descriere '.$description = trim($desc[0]->innertext, "</p>").'<br/>';

	$manufacturer = $html->find('.product-reference > span:nth-child()');
	$string = trim(str_replace('           ', ' ', $manufacturer[0]->plaintext));
	$producator = explode(" ",$string);
	echo 'Producator '.$producator[2].'<br/>';

	$code = trim(str_replace('           ', ' ', $manufacturer[1]->plaintext));
	$cod = explode(" ",$code);
	$cod= strtoupper($cod[2].$cod[3]);
	echo 'COD '.$cod.'<br/>';

//	$specifics = $html->find('section[class="product-features"]');
//	$stringu = explode(" ",$specifics[0]->plaintext);
//	var_dump($stringu);
//	var_dump($specifics[0]->plaintext);

//echo 'price'.$price->plaintext;
//var_dump($results);
  //$pieces = explode("\n", $results);

    //$components = json_decode(rtrim(str_replace('MBG.addProductDetailView(','', trim($pieces[4])), ");"));
//foreach($rezultate as $res){
////	echo "<pre>",var_dump($res);
////	echo "id".$res['id'];
//}
//
//	echo $id = $components->id;
//	echo $name = $components->name;
//	echo $category = $components->category;
//	echo $brand = $components->brand;
//	echo $price = trim($components->price, "lei");

