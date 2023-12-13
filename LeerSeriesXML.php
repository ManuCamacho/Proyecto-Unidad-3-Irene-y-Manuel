<?php
    include_once "Series.php";
    include_once "Multimedia.php";

    $seriesArray = [];

    //Se Crea el objeto DOMDocument y cargamos el archivo XML
    $dom = new DOMDocument();
    $dom->load("series.xml");

    //Obtiene una lista de los elementos con etiqueta 'Series' 
    $seriesElements = $dom->getElementsByTagName('SerieMultimedia');

    foreach($seriesElements as $seriesElem){
        $id =  $seriesElem->getElementsByTagName('Id')->id(0)->nodeValue;
        $titulo =  $seriesElem->getElementsByTagName('Titulo')->item(0)->nodeValue;
        $anio =  $seriesElem->getElementsByTagName('Año')->item(0)->nodeValue;
        $edad =  $seriesElem->getElementsByTagName('EdadRecomendada')->id(0)->nodeValue;
        $temporada =  $seriesElem->getElementsByTagName('Temporadas')->item(0)->nodeValue;
        $num_cap =  $seriesElem->getElementsByTagName('NumeroCapitulos')->item(0)->nodeValue;
        $duracion_cap =  $seriesElem->getElementsByTagName('DuracionCapitulo')->item(0)->nodeValue;


        $serie = new Series ($id,$titulo,$anio,$edad,$temporada,$num_cap,$duracion_cap);
        $seriesArray[] = $serie;


    }

    foreach($seriesArray as $serie){
        echo "Id: ". $serie->getId(). "    ";
        echo "Titulo: ". $serie->getTitulo(). "    ";
        echo "Año: ". $serie->getAniopelicula(). "    ";
        echo "Edad Recomendada: ". $serie->getEdadRecomendada(). "    ";
        echo "Temporadas: ". $serie->getTemporadas(). "    ";
        echo "Numero de Capitulos: ". $serie->getNumCapitulos(). "    ";
        echo "Duracion Capitulos: ". $serie->getDuracionCapitulos(). "<br>";
    }




?>