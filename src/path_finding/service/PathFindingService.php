<?php
/**
 *
 */

namespace Scape\PathFinding\Service;

use Exception;
use Scape\PathFinding\Domain\Node;

class PathFindingService
{

    /** @var Node[] */
    private $nodes;

    public function addNode(Node $node)
    {
        $this->nodes[] = $node;
    }

    /**
     * getNode
     *
     * @param $name
     *
     * @throws \Exception
     *
     * @return Node
     */
    public function getNode($name)
    {
        foreach ($this->nodes as $node) {
            if ($node->getName() == $name) {
                return $node;
            }
        }
        throw new Exception('Node not found');
    }

    public function findShortestPathDijkstraToNode(Node $from, Node $to)
    {
        $current = $from;
        $visited = [$from->getName() => $from];
        $unvisited = $this->getAllNodeExcept($from);

        while(true) {
            $this->calculateNeighbours($current, $visited);

            $current = $this->determineLowestUnvisited($unvisited, $to);
            if ($current === null) {
                throw new Exception('unable to determine highest unvisited');
            }

            unset($unvisited[$current->getName()]);
            $visited[$current->getName()] = $current;

            if ($current->getName() === $to->getName()) {
                // found shortest path. return it
                break;
            }
        }

        return $to;
    }

    /**
     * calculateNeighbours
     *
     * @param $current
     *
     * @return void
     */
    private function calculateNeighbours(Node $current, $visited = [])
    {
// find the lowest weighted neighbour
        $links = $current->getLinks();

        //update the values of the neighbours
        foreach ($links as $link) {
            $toNode = $link->getToNode();
            if ($current->getName() === $toNode->getName()) {
                continue;
            }
            if (in_array($toNode->getName(), array_keys($visited))) {
                continue;
            }

            $distance = $current->getTentativeDistance() + $link->getWeight();
            if (null === $toNode->getTentativeDistance() || $distance < $toNode->getTentativeDistance()) {
                $toNode->setTentativeDistance($distance);
                $toNode->setParentNodeForQuickestRoute($current);
            }
        }

    }

    /**
     * getAllNodeExcept
     *
     * @param \Scape\PathFinding\Domain\Node $current_node
     *
     * @return Node[]
     */
    private function getAllNodeExcept(Node $current_node)
    {
        $set= [];
        foreach ($this->nodes as $node) {
             if ($node->getName() !== $current_node->getName()) {
                 $set[$node->getName()] = $node;
             }
        }
        return $set;
    }

    /**
     * determineLowestUnvisited
     *
     * @param Node[] $unvisited
     *
     * @return Node
     */
    private function determineLowestUnvisited($unvisited, Node $target_node)
    {
        /** @var Node $lowest_node */
        $lowest_node = null;
        foreach ($unvisited as $node) {
            if ($node->getTentativeDistance() == null) {
                continue;
            }
            if ($lowest_node === null) {
                $lowest_node = $node;
            }
            else if ($node->getTentativeDistance() <= $lowest_node->getTentativeDistance()) {
                if ($node->getName() === $target_node->getName() || $node->getTentativeDistance() < $lowest_node->getTentativeDistance())
                {
                    $lowest_node = $node;
                }
            }
        }
        return $lowest_node;
    }

    public function printPath(Node $nodeA, Node $nodeI)
    {

        $current_node = $nodeI;
        $path = [];
        while (true) {
            $path[] = $current_node;
            if ($current_node->getParentNodeForQuickestRoute() === null) {
                break;
            }
            $new_node     = $current_node->getParentNodeForQuickestRoute();

            // find the link
            foreach($new_node->getLinks() as $link) {
                if ($link->getToNode() === $current_node) {
                    $link->activate();
                }
            }

            $current_node = $new_node;
        }

    }

    /**
     * @return \Scape\PathFinding\Domain\Node[]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

}
