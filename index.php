<?php

	/*
		Realizar un json de Peliculas Agrupados por Categorías, en base al archivo movies.json, calcular la cantidad de peliculas por categorias y el promedio en minutos.

		Ejemplo:
		{
			"Comedy": {
		        "total_movies": 2,
		        "average_minutes": 43,
		        "total_minutes": 86,
		        "movies": [
		            {
		                "title": "Vikings",
		                "runtime": 44,
		                "year": "2013\u2013",
		                "director": "N\/A",
		                "writer": "Michael Hirst",
		                "actors": "Travis Fimmel, Clive Standen, Gustaf Skarsg\u00e5rd, Katheryn Winnick",
		                "plot": "The world of the Vikings is brought to life through the journey of Ragnar Lothbrok, the first Viking to emerge from Norse legend and onto the pages of history - a man on the edge of myth.",
		                "lenguage": "English, Old English, Norse, Old, Latin"
		            },
		            {
		                "title": "Gotham",
		                "runtime": 42,
		                "year": "2014\u2013",
		                "director": "N\/A",
		                "writer": "Bruno Heller",
		                "actors": "Ben McKenzie, Donal Logue, David Mazouz, Sean Pertwee",
		                "plot": "The story behind Detective James Gordon's rise to prominence in Gotham City in the years before Batman's arrival.",
		                "lenguage": "English"
		            }
		        ]
		    }
	 	}
	 	######################
			Postulante:
			Fecha:
			Telefono:
			Corre: 
		######################
	*/
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

	/*Ïmprime contenido del Json*/
	#print_r(json_encode($movies, JSON_PRETTY_PRINT));

	/*Ïmprime contenido del nuevo Array*/
	print_r(json_encode($newArray, JSON_PRETTY_PRINT));
?>