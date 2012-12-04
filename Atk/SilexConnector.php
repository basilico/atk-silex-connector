<?php

namespace Basilico\Atk;

require __FILE__.'/../../web/backoffice/atk.inc';

/**
 * 
 */
class Atk_SilexConnector
{
  /**
   *
   */  
  private $lastNode = null;
  
  /**
   *
   */  
  public function __construct() {

  }
  
  /**
   * (stable API)
   */  
  public function fetch($node, $options=array()) {
    $this->setLastNode($node);
    return $this->getNode($node)->selectDb($options['where'], $options['order'], $options['limit']);
  }
  
  /**
   * (stable API)
   */  
  public function fetchOne($node, $options=array()) {
    $this->setLastNode($node);
    $r = $this->getNode($node)->selectDb($options['where'], $options['order'], 1);
    return $r[0];
  }

  /**
   * Stable API
   */  
  public function getRows($query) {
    return $this->getDb()->getrows($query);
  }
  
  public function query($query) {
    return $this->getDb()->query($query);
  }
  
  public function getDb() {
    if ($this->lastNode) {
      $db = $this->getNode($this->lastNode)->getDb();
    } else {
      $db = atkGetDb();
    }
    
    return $db;
  }
  
  /**
   * Atk method
   */
  public function getNode($node) {
    return getNode($node);
  }

  public function setLastNode($node) {
    $this->lastNode = $node;
  }
    
}
