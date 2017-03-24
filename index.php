<?php

use Scape\PathFinding\Domain\Node;
use Scape\PathFinding\Service\PathFindingService;

require_once 'vendor/autoload.php';

$start = $_GET['start'];
$end = $_GET['end'];

$service = new PathFindingService();
$nodeA = new Node('A');
$nodeB = new Node('B');
$nodeC = new Node('C');
$nodeD = new Node('D');
$nodeE = new Node('E');
$nodeF = new Node('F');
$nodeG = new Node('G');
$nodeH = new Node('H');
$nodeI = new Node('I');
$service->addNode($nodeA);
$service->addNode($nodeB);
$service->addNode($nodeC);
$service->addNode($nodeD);
$service->addNode($nodeE);
$service->addNode($nodeF);
$service->addNode($nodeG);
$service->addNode($nodeH);
$service->addNode($nodeI);

$nodeA->connectTo($nodeB);
$nodeB->connectTo($nodeC);
$nodeC->connectTo($nodeD,20);
$nodeD->connectTo($nodeE);
$nodeE->connectTo($nodeF);
$nodeC->connectTo($nodeG);
$nodeA->connectTo($nodeH);
$nodeH->connectTo($nodeI);
$nodeH->connectTo($nodeG);
$nodeG->connectTo($nodeF,20);
$nodeI->connectTo($nodeF);
$nodeH->connectTo($nodeF,20);
$nodeH->connectTo($nodeB);

if ($start != null) {
    $service->getNode($start)->makePrimary();
}

if ($end != null) {
    $service->getNode($end)->setIsLast();
}

if ($start != null || $end != null) {
    $service->findShortestPathDijkstraToNode($service->getNode($start), $service->getNode($end));
    $service->printPath($service->getNode($start), $service->getNode($end));
}
?>

<html>
<head>
    <script type="application/javascript" src="http://visjs.org/dist/vis.js"></script>
    <link href="http://visjs.org/dist/vis-network.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="mynetwork"><div class="vis-network" tabindex="900" style="position: relative; overflow: hidden; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;"><canvas width="1200" height="800" style="position: relative; touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;"></canvas></div></div>



<script type="text/javascript">
  // create an array with nodes
  var nodes = new vis.DataSet([
    <?php foreach ($service->getNodes() as $node): ?>
    {id: '<?php echo $node->getName() ?>', label: '<?php echo $node->getName() ?>', color: '<?php echo ($node->getIsPrimary()) ? 'lightgreen' : (($node->getIsLast()) ? '#FF0000' : 'lightblue') ?>'},
    <?php endforeach; ?>
  ]);

  // create an array with edges
  var edges = new vis.DataSet([
      <?php foreach ($service->getNodes() as $key => $node): ?>
        <?php foreach ($node->getLinks() as $link): ?>
            {
              from: '<?php echo $node->getName()?>',
              to: '<?php echo $link->getToNode()->getName() ?>',
              arrows: 'to',
              color: '<?php echo ($link->isActive()) ? 'black' : '#dcdcdc' ?>',
              label: '<?php echo $link->getWeight() ?>'
            },
        <?php endforeach; ?>
      <?php endforeach; ?>
  ]);

  // create a network
  var container = document.getElementById('mynetwork');
  var data = {
    nodes: nodes,
    edges: edges
  };
  var options = {};
  var network = new vis.Network(container, data, options);
</script>
</body>
</html>

