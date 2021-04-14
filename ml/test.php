<?php
require '../vendor/autoload.php';

//Data
$samples = [
    [4, 3, 44.2],
    [2, 2, 16.7],
    [2, 4, 19.5],
    [3, 3, 55.0],
    [4, 1, 24.2],
    [4, 2, 46.7],
    [1, 2, 29.5],
    [3, 2, 43.7],
    [3, 3, 39.5],
    [4, 4, 35.0]
];

$labels = ['married', 'divorced', 'married', 'divorced','divorced', 'married', 'divorced', 'married','married', 'married'];

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