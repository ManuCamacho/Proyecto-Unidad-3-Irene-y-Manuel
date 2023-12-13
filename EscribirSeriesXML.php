<?php
    include_once "Multimedia.php";
    include_once "Series.php";

    $generoValor = genero::Accion;
    $serie1 = new Series(1, 'Serie1', 2000, 12, $generoValor, 2,16,45);
   

    $series = [$serie1];

    // Se Crea un objeto de la clase DOMDocument
    $dom = new DOMDocument('1.0', 'UTF-8');

    //Indicamos que el documento XML resultante es formateado automaticamente.
    $dom->formatOutput = true;

    //Se crea el elemento raiz del documento
    $raiz = $dom->createElement('SerieMultimedia'); //etiqueta principal que no tiene valor.
    $dom->appendChild($raiz);

    // Recorremos el array de series y creamos un elemento en el archivo XML con cada serie.
    foreach($series as $serie){
        $serieElem = $dom->createElement('Series');
        $dom->appendChild($serieElem);
        $serieElem->appendChild($dom->createElement('Id',$serie->getId()));
        $serieElem->appendChild($dom->createElement('Titulo',$serie->getTitulo()));
        $serieElem->appendChild($dom->createElement('Año',$serie->getAniopelicula()));
        $serieElem->appendChild($dom->createElement('EdadRecomendada',$serie->getEdadRecomendada()));
        $serieElem->appendChild($dom->createElement('Temporadas',$serie->getTemporadas()));
        $serieElem->appendChild($dom->createElement('NumeroCapitulos',$serie->getNumCapitulos()));
        $serieElem->appendChild($dom->createElement('DuracionCapitulo',$serie->getDuracionCapitulos()));

    }

    $dom->save("series.xml");

?>