<?php

namespace Basilico\Atk;

/**
 * AtkSilexConnector
 *
 * @author Dharma <dharma@basili.co>
 */
class AtkSilexConnector
{
  /**
   * Last used node
   */  
  private $lastNode = null;
  
  /**
   * Load atk-framework libraries
   */  
  public function __construct() {
    $config_atkroot = realpath(dirname(__FILE__).'/../../../../../web/backoffice').'/';
    $GLOBALS['config_atkroot'] = $config_atkroot;
    require_once $config_atkroot . "atk.inc";
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
   * (stable API)
   */  
  public function getRows($query) {
    return $this->getDb()->getrows($query);
  }
  

  public function setLastNode($node) {
    $this->lastNode = $node;
  }

  
  /**
   * Proxy methods
   */
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

  public function getNode($node) {
    return getNode($node);
  }    
}