<?php
/**
 *
 */

namespace Scape\PathFinding\Domain;

class Node
{

    /** @var Link[] */
    private $links = [];
    private $name;
    private $tentativeDistance;
    private $isPrimary;
    private $isLast;
    private $parentNodeForQuickestRoute;

    public function connectTo(Node $node, $weight = 1, $inversed = false)
    {
        $this->links[] = new Link($this, $node, $weight);
        if (!$inversed) {
            $node->connectTo($this, $weight, true);
        }
    }

    public function __construct($name, $tentativeDistance = null)
    {
        $this->name = $name;
        $this->tentativeDistance= $tentativeDistance;
    }

    public function makePrimary() {
        $this->tentativeDistance = 0;
        $this->isPrimary = true;
    }

    public function getName() {
        return $this->name;
    }

    /**
     * getLinks
     *
     *
     * @return Link[]
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * setTentativeDistance
     *
     * @param integer $distance
     *
     * @return void
     */
    public function setTentativeDistance($distance)
    {
        $this->tentativeDistance = $distance;
    }

    /**
     * getTentativeDistance
     *
     *
     * @return integer|null
     */
    public function getTentativeDistance()
    {
        return $this->tentativeDistance;
    }

    function __toString()
    {
        return $this->getName();
    }

    /**
     * @return Node
     */
    public function getParentNodeForQuickestRoute()
    {
        return $this->parentNodeForQuickestRoute;
    }

    /**
     * @param Node $parentNodeForQuickestRoute
     */
    public function setParentNodeForQuickestRoute($parentNodeForQuickestRoute)
    {
        $this->parentNodeForQuickestRoute = $parentNodeForQuickestRoute;
    }

    /**
     * @return mixed
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * @return mixed
     */
    public function getIsLast()
    {
        return $this->isLast;
    }

    /**
     * @param mixed $isLast
     */
    public function setIsLast()
    {
        $this->isLast =true ;
    }

}
