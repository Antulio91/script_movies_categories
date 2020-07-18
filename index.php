<?php
	header('Content-type: application/json;');
	$url = './movies.json'; // path to your JSON file
	$data = file_get_contents($url); // put the contents of the file into a variable
	$movies = json_decode($data, true);

	// Main Array
	$newArray = [];
	
	// Running through the json of all the movies
	foreach ($movies as $key => $movie) {
		foreach ($movie["genre"] as $index => $genre) {
			unset($movie["genre"]); // Eliminating the genres
			if (!array_key_exists($genre, $newArray)) {
				$newArray[$genre]['total_movies'] = 0;
				$newArray[$genre]['total_minutes'] = 0;
				$newArray[$genre]['average_minutes'] = 0;
				$newArray[$genre]['movies'] = [];
			};
			$newArray[$genre]['total_movies'] = $newArray[$genre]['total_movies'] + 1;
			$newArray[$genre]['total_minutes'] = $newArray[$genre]['total_minutes'] + $movie["runtime"];
			$newArray[$genre]['average_minutes'] = round($newArray[$genre]['total_minutes'] / $newArray[$genre]['total_movies'], 2);
			array_push($newArray[$genre]["movies"], $movie);
		};
	};

	/*Ïmprime contenido del nuevo Array*/
	print_r(json_encode($newArray, JSON_PRETTY_PRINT));
?>