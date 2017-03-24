<?php
/**
 *
 */

namespace Scape\PathFinding\Domain;

class Link
{
    private $fromNode;
    /**
     * @var Node
     */
    private $toNode;
    private $weight;
    private $active = false;

    public function __construct(Node $from, Node $to, $weight = 1)
    {
        $this->fromNode = $from;
        $this->toNode = $to;
        $this->weight = $weight;
    }

    /**
     * getToNode
     *
     *
     * @return Node
     */
    public function getToNode()
    {
        return $this->toNode;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function activate()
    {
        $this->active = true;
    }

    public function isActive()
    {
        return $this->active;
    }

}
