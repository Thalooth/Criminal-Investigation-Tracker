<?php
include '../vendor/autoload.php';

//Data
$samples = [
    [1, 3, 1, 3],
    [1, 3, 2, 3],
    [1, 2, 3, 3],
    [1, 1, 2, 1],
    [2, 4, 2, 3],
    [3, 7, 2, 1],
    [2, 4, 1, 3],
    [2, 5, 2, 1],
    [2, 4, 3, 2],
    [2, 6, 1, 1]
];

$labels = ['Veerappan', 'Veerappan', 'Veerappan', 'Suni','Suni', 'Suni', 'Yadav', 'Yadav','Yadav', 'Yadav'];

//laelled dataset
use Rubix\ML\Datasets\Labeled;
$dataset = new Labeled($samples, $labels);

//k nearest neighbors classification
use Rubix\ML\Classifiers\KNearestNeighbors;
$estimator = new KNearestNeighbors(3);

//training
$estimator->train($dataset);
//var_dump($estimator->trained());

//predictions
use Rubix\ML\Datasets\Unlabeled;

$samples = [
    [2, 4, 2, 1],
    [1, 2, 1, 3],
    [2, 5, 1, 2]
];

$dataset = new Unlabeled($samples);

$predictions = $estimator->predict($dataset);

var_dump($predictions);

//Model Evaluation
use Rubix\ML\CrossValidation\HoldOut;

$validator = new HoldOut(0.2);

use Rubix\ML\CrossValidation\Metrics\Accuracy;

$dataset = new Labeled($samples, $labels);

$score = $validator->test($estimator, $dataset, new Accuracy());

echo $score;

?>