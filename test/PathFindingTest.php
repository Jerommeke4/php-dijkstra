<?php
use PHPUnit\Framework\TestCase;
use Scape\PathFinding\Domain\Node;
use Scape\PathFinding\Service\PathFindingService;

/**
 *
 */
class PathFindingTest extends TestCase
{

    /**
     * @var PathFindingService
     */
    private $service;

    public function setUp()
    {
        $service = new PathFindingService();
        $nodeA   = new Node('A');
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
        $nodeC->connectTo($nodeD);
        $nodeD->connectTo($nodeE);
        $nodeE->connectTo($nodeF);
        $nodeC->connectTo($nodeG);
        $nodeA->connectTo($nodeH);
        $nodeH->connectTo($nodeI);
        $nodeH->connectTo($nodeG);
        $nodeG->connectTo($nodeF);
        $nodeI->connectTo($nodeF);
        $nodeH->connectTo($nodeF);
        $nodeH->connectTo($nodeB);

        $this->service = $service;
    }

    public function testFindPathDijkstra() {
        $nodeA = $this->service->getNode('A');
        $nodeI = $this->service->getNode('E');
        $nodeA->makePrimary();
        $start = microtime(false);
        self::assertEquals(3, $this->service->findShortestPathDijkstraToNode($nodeA, $nodeI)->getTentativeDistance());
        echo microtime(false) - $start;
        $this->service->printPath($nodeA, $nodeI);
    }

}
