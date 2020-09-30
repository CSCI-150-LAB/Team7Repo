<?php

// Naive ORM
// Works well for simple cases

/**
 *	/**
 *	 * @Table('users')
 *	 *\
 *	class User extends Model {
 *		/**
 *		 * @Key('Id')
 *		 * @AutoIncrement
 *		 *\
 *		public $id;
 *
 * 		/**
 *		 * @Column('created_at')
 *		 *\
 *		public $createdAt;
 *	}
 */

class Model extends AnnotatedClass {
	protected static $tableMeta = [];
	protected $_exists;

	public static function getByKey(...$keys) {
		$tableMeta = static::getTableMeta();
		if (count($keys) != count($tableMeta['keys'])) {
			throw new Exception('Number of keys passed do not match the number of keys for the table');
		}

		$query = [];
		$queryArgs = [];
		$key = reset($keys);
		foreach ($tableMeta['keys'] as $keyProp) {
			$query[] = "{$keyProp} = :" . count($queryArgs) . ":";
			$queryArgs[] = $key;
			$key = next($keys);
		}

		return static::findOne(implode(' AND ', $query), $queryArgs);
	}

	public static function find($query, ...$args) {
		if (count($args) == 1 && is_array($args[0])) {
			$args = $args[0];
		}
		$query = self::transformStringQuery($query);

		$tableMeta = static::getTableMeta();
		$db = DI::getDefault()->get('Db');
		$result = $db->query("SELECT * FROM {$tableMeta['name']} WHERE {$query}", $args);

		if ($result !== false) {
			return array_map(function($row) {
				return static::fromArray($row, true);
			}, $result);
		}

		return false;
	}

	public static function findOne($query, ...$args) {
		if (count($args) == 1 && is_array($args[0])) {
			$args = $args[0];
		}
		$result = static::find("{$query} LIMIT 1", $args);

		if (is_bool($result)) {
			return $result;
		}

		return isset($result[0])
			? $result[0]
			: null;
	}

	private static function transformStringQuery($query) {
		$tableMeta = static::getTableMeta();

		$patterns = [];
		foreach ($tableMeta['columns'] as $prop => $columnMeta) {
			$patterns[] = $prop;
		}
		$patterns = '/\\b(' . implode('|', $patterns) . ')\\b/';

		return preg_replace_callback($patterns, function($matches) use ($tableMeta) {
			return $tableMeta['columns'][$matches[1]]['name'];
		}, $query);
	}

	public function save() {
		$tableMeta = static::getTableMeta();
		$queryArgs = [];
		
		// Update
		if ($this->_exists) {
			$update = [];
			$where = [];
			foreach ($tableMeta['columns'] as $prop => $propInfo) {
				if (isset($propInfo['key'])) {
					$where[] = "{$propInfo['name']} = :{$prop}:";
					$queryArgs[$prop] = $this->$prop;
				}
				else {
					$update[] = "{$propInfo['name']} = :{$prop}:";
					$queryArgs[$prop] = $this->$prop;
				}
			}

			$update = implode(', ', $update);
			$where = implode(' AND ', $where);

			$db = DI::getDefault()->get('Db');
			return $db->query("UPDATE {$tableMeta['name']} SET {$update} WHERE {$where} LIMIT 1", $queryArgs);
		}

		// Insert
		else {
			$columns = [];
			$values = [];
			foreach ($tableMeta['columns'] as $prop => $propInfo) {
				if (isset($propInfo['key']) && isset($propInfo['autoIncrement'])) {
					continue;
				}

				$columns[] = $propInfo['name'];
				$values[] = ":{$prop}:";
				$queryArgs[$prop] = $this->$prop;
			}

			$columns = implode(', ', $columns);
			$values = implode(', ', $values);

			$db = DI::getDefault()->get('Db');
			$result = $db->query("INSERT INTO {$tableMeta['name']} ({$columns}) VALUES ({$values})", $queryArgs);
			if ($result) {
				if (!is_bool($result)) {
					if ($tableMeta['autoIncrement']) {
						$autoProp = $tableMeta['autoIncrement'];
						$this->$autoProp = $result;
					}
				}

				if ($db->isTrackingModels()) {
					$db->trackModel($this->_exists, true);
				}
				else {
					$this->_exists = true;
				}

				return true;
			}

			return false;
		}
	}

	public function delete() {
		if ($this->_exists) {
			$query = [];
			$queryArgs = [];
			$tableMeta = static::getTableMeta();
			foreach ($tableMeta['keys'] as $keyProp) {
				$query[] = "{$tableMeta['columns'][$keyProp]['name']} = :{$keyProp}:";
				$queryArgs[$keyProp] = $this->$keyProp;
			}
			$query = implode(' AND ', $query);

			$db = DI::getDefault()->get('Db');
			$result = $db->query("DELETE FROM {$tableMeta['name']} WHERE {$query} LIMIT 1", $queryArgs);
			if ($result === true) {
				if ($db->isTrackingModels()) {
					$db->trackModel($this->_exists, false);
				}
				else {
					$this->_exists = false;
				}
			}

			return $result === true;
		}
	}

	public function doesExist() {
		return $this->_exists;
	}

	protected static function Table(&$tableMeta, $tableName) {
		$tableMeta['name'] = $tableName;
	}

	protected static function Key(&$columnMeta, $order = 0) {
		$columnMeta['key'] = $order;
	}

	protected static function AutoIncrement(&$columnMeta) {
		$columnMeta['autoIncrement'] = true;
	}

	protected static function Column(&$columnMeta, $name) {
		$columnMeta['name'] = $name;
	}

	protected static function Required(&$columnMeta) {
		$columnMeta['required'] = true;
	}

	protected static function MinLength(&$columnMeta, $length) {
		$columnMeta['minLength'] = $length;
	}

	protected static function MaxLength(&$columnMeta, $length) {
		$columnMeta['maxLength'] = $length;
	}

	protected static function NotMapped(&$columnMeta) {
		$columnMeta['notMapped'] = true;
	}

	protected static function Serialized(&$columnMeta) {
		$columnMeta['serialized'] = true;
	}

	protected static function DatabaseGenerated(&$columnMeta) {
		$columnMeta['databaseGenerated'] = true;
	}

	public static function getTableMeta() {
		if (!isset(self::$tableMeta[static::class])) {
			$meta = [
				'name' => static::class,
				'columns' => [],
				'props' => [],
				'keys' => [],
				'autoIncrement' => false
			];

			$annotations = static::getAnnotations();

			foreach ($annotations['properties'] as $prop => $propInfo) {
				$propMeta = [
					'name' => $prop
				];

				foreach ($propInfo['calls'] as $call) {
					$fn = $call['func'];
					static::$fn($propMeta, ...$call['args']);
				}

				if (isset($propMeta['notMapped']) && $propMeta['notMapped']) {
					continue;
				}

				if (isset($propMeta['key']) && isset($propMeta['autoIncrement'])) {
					$meta['autoIncrement'] = $prop;
				}

				$meta['columns'][$prop] = $propMeta;
			}

			foreach ($meta['columns'] as $prop => $columnInfo) {
				$meta['props'][$columnInfo['name']] = $prop;

				if (isset($columnInfo['key'])) {
					$order = $columnInfo['key'];
					while (isset($meta['keys'][$order])) {
						$order++;
					}

					$meta['keys'][$order] = $prop;
				}
			}
			ksort($meta['keys']);

			foreach ($annotations['class']['calls'] as $call) {
				$fn = $call['func'];
				static::$fn($meta, ...$call['args']);
			}

			self::$tableMeta[static::class] = $meta;
		}

		return self::$tableMeta[static::class];
	}

	public static function fromArray(array $data, $exists = false) {
		$tableMeta = static::getTableMeta();
		if ($exists) {
			foreach ($tableMeta['keys'] as $keyProp) {
				if (!isset($data[$keyProp])) {
					throw new Exception("Required key {$keyProp} missing on existing record");
				}
			}
		}

		$record = new static();

		foreach ($data as $key => $val) {
			$prop = $key;
			if (isset($tableMeta['props'][$prop])) {
				$prop = $tableMeta['props'][$prop];
			}

			$record->$prop = $val;
		}

		$record->_exists = $exists;

		return $record;
	}
}