atk-silex-connector
===================

Yet, the first (and only) Atk-Silex Middleware :|


TODO
----

* Class Refactor
* Avoid use of `atkNode::selectDb` (see below)

`
// Catch use of deprecated selectDb and countDb methods. We implement
// this here instead of keeping wrapper methods because if someone has
// overridden these methods the atkCompatSelector will be used instead of
// the normal atkSelector which will call the overridden selectDb and/or
// countDb methods which might call parent::selectDb(...) which would
// call the select() method which would again instantiate an
// atkCompatSelector etc. This way we can make sure the atkCompatSelector is
// only instantiated on the first call after which we use a normal
// selector if a call to parent::selectDb(...) is made.

$condition = array_key_exists(0, $params) ? $params[0] : '';
$order = array_key_exists(1, $params) ? $params[1] : '';
$limit = array_key_exists(2, $params) ? $params[2] : '';
$excludes = array_key_exists(3, $params) ? $params[3] : '';
$includes = array_key_exists(4, $params) ? $params[4] : '';
$mode = array_key_exists(5, $params) ? $params[5] : '';
$distinct = array_key_exists(5, $params) ? $params[5] : false;
$ignoreDefaultFilters = array_key_exists(6, $params) ? $params[6] : false;

$selector = atknew('atk.utils.atk'.($this->hasFlag(NF_ML) ? 'ml' : '').'selector', $this);
$this->_initSelector($selector);
$selector->where($condition);
if ($order === false || $order != '')
  $selector->orderBy($order);
if ($limit != null && !is_array($limit))
  $selector->limit($limit, 0);
else if ($limit != null)
  $selector->limit($limit['limit'], $limit['offset']);
$selector->excludes($excludes);
$selector->includes($includes);
$selector->mode($mode);
$selector->distinct($distinct);
$selector->ignoreDefaultFilters($ignoreDefaultFilters);
return $selector->getAllRows();
`