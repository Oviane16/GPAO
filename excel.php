<?php
require_once '../Classes/PHPExcel/IOFactory.php';
$FILENAME="d:\presence.xls"; //nom du fichier à ouvrir


// Chargement du fichier Excel
$objPHPExcel = PHPExcel_IOFactory::load($FILENAME);

/**
 * récupération de la première feuille du fichier Excel
 * @var PHPExcel_Worksheet $sheet
 */
$sheet = $objPHPExcel->getSheet(0);

echo '<table border="1">';

// On boucle sur les lignes
foreach($sheet->getRowIterator() as $row) {

    echo '<tr>';

    // On boucle sur les cellule de la ligne
    foreach ($row->getCellIterator() as $cell) {
        echo '<td>';
        print_r($cell->getValue());
        echo '</td>';
    }

    echo '</tr>';
}
echo '</table>';
?>