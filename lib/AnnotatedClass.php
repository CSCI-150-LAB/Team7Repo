<?php

/**
 * A base class that provides a basic framework for processing annotation comments
 */
class AnnotatedClass {
	private const WORD_SEPARATORS = " `~!@#%^&*()-=+[{]}\\|;:'\",<>/?$";
	private static $annotationsMap = [];

	/**
	 * Analyzes the child class and returns the properties and any annotations found
	 *
	 * @return array
	 */
	protected static function getAnnotations() {
		if (!isset(self::$annotationsMap[static::class])) {
			self::$annotationsMap[static::class] = static::processClass();
		}

		return self::$annotationsMap[static::class];
	}

	/**
	 * Performs the actual analysis on the child class
	 *
	 * @return array
	 */
    private static function processClass() {
        $reflector = new ReflectionClass(static::class);
		$annotations = [
			'methods' => [],
			'properties' => []
		];
		
		$classProps = array_merge(
			$reflector->getMethods(ReflectionMethod::IS_PUBLIC),
			$reflector->getProperties(ReflectionProperty::IS_PUBLIC),
			[$reflector]
		);

        foreach ($classProps as $refObj) {
			if (!($refObj instanceof ReflectionClass) && $refObj->isStatic()) {
				continue;
			}

			$comment = $refObj->getDocComment();
			
            if ($comment) {
                // Parsing logic definitely not perfect but suitable for now
                $comment = preg_replace('/\\r?\\n\\r?/', "\n", $comment);

				$lines = explode("\n", $comment);
				$methodMeta = [];
				$methodCalls = [];
				foreach ($lines as $line) {
					$line = preg_replace('/^\\s*(?:\\/\\*)?\\*\\s*/', '', $line);

                    if ($line && $line[0] == '@') {
                        $line = substr($line, 1);
                        $len = strlen($line);

                        $func = $line;
						$paren = strpos($func, '(');
                        if ($paren !== false) {
                            if ($line[$len - 1] != ')') {
								self::readMeta($line, $methodMeta);
                                continue;
                            }

                            $func = rtrim(substr($func, 0, $paren));
                        }
						
						if (strpos($func, ' ') !== false) {
							self::readMeta($line, $methodMeta);
                            continue;
                        }

						$args = [];
                        if ($paren !== false) {
							$argsStr = trim(substr($line, $paren + 1, $len - $paren - 1));
							$args = self::readCommaDelimitedValues($argsStr, ')', false);
                        }
                        else {
                            $args = [];
                        }

                        $methodCalls[] = [
                            'func' => $func,
                            'args' => $args
                        ];
                    }
				}
			}
			else {
				$methodCalls = [];
			}

			// Format the results
			$methodCalls = [
				'calls' => $methodCalls,
				'meta' => $methodMeta
			];

			if ($refObj instanceof ReflectionClass) {
				$annotations['class'] = $methodCalls;
			}
			else {
				$type = $refObj instanceof ReflectionMethod
					? 'methods'
					: 'properties';

				if ($type == 'methods') {
					$methodCalls['paramCount'] = $refObj->getNumberOfParameters();
				}
				
				$annotations[$type][$refObj->getName()] = $methodCalls;
			}
        }

        return $annotations;
	}

	private static function readMeta($line, &$meta) {
		if (preg_match('/^([a-z]+)\\s+(.*)$/i', $line, $matches)) {
			switch ($matches[1]) {
				case 'param':
					if (!isset($meta['param'])) {
						$meta['param'] = [];
					}
					$parts = explode(' ', $matches[2], 2);
					$meta['param'][] = [
						'type' => $parts[0] ?? 'mixed',
						'desc' => $parts[1] ?? ''
					];
					break;
				case 'method':
					if (preg_match('/^(?:(static)\\s+)?(?:([a-z_][a-z0-9_]*)\\s+)?([a-z_][a-z0-9_]*)\\s*\(([^)]*)\)$/i', $matches[2], $matches)) {
						if (!isset($meta['method'])) {
							$meta['method'] = [];
						}

						$meta['method'][] = [
							'static' => !!$matches[1],
							'returnType' => $matches[2] ?? 'mixed',
							'name' => $matches[3],
							'args' => array_filter(array_map('trim', explode(',', $matches[4])))
						];
					}
					break;
				default:
					$meta[$matches[1]] = $matches[2];
					break;
			}
		}
	}
	
	private static function readCommaDelimitedValues(&$str, $terminatingCharacter, $isArray) {
		$result = [];
		$firstValue = true;

		while ($str[0] != $terminatingCharacter) {
			if ($str[0] == ',') {
				if ($firstValue) {
					throw new Exception("Missing first value");
				}

				$str = ltrim(substr($str, 1));
			}

			$part1 = self::readValue($str);
			if (strpos($str, '=>') === 0) {
				if (!$isArray) {
					throw new Exception("Can't have keys in function call");
				}

				$str = ltrim(substr($str, 2));
				$part2 = self::readValue($str);
				$result[$part1] = $part2;
			}
			else {
				$result[] = $part1;
			}

			$firstValue = false;
		}

		$str = ltrim(substr($str, 1));
		return $result;
	}

	private static function readValue(&$str) {
		// Strings
		if ($str[0] == '"' || $str[0] == "'") {
			return self::readString($str);
		}

		// Arrays - New
		elseif ($str[0] == '[') {
			$str = ltrim(substr($str, 1));
			return self::readCommaDelimitedValues($str, ']', true);
		}

		// Arrays - Old
		elseif (stripos($str, 'array') === 0) {
			$str = ltrim(substr($str, 5));
			if ($str[0] != '(') {
				throw new Exception("Unexpected character while parsing old array");
			}

			$str = ltrim(substr($str, 1));
			return self::readCommaDelimitedValues($str, ')', true);
		}

		// Variable
		elseif ($str[0] == '$') {
			$rightSide = strcspn($str, self::WORD_SEPARATORS . '.', 1);
			$var = substr($str, 1, $rightSide);

			if (is_numeric($var[0])) {
				throw new Exception("Variable names cannot start with a number");
			}

			$str = ltrim(substr($str, $rightSide + 1));

			if ($var == 'this') {
				//TODO: Resolve this
				return null;
			}
			
			return isset($GLOBALS[$var])
				? $GLOBALS[$var]
				: null;
		}

		// Other primitives
		else {
			$rightSide = strcspn($str, self::WORD_SEPARATORS);
			if (!$rightSide) {
				throw new Exception("Expected a value in function/array");
			}

			$value = substr($str, 0, $rightSide);
			$str = ltrim(substr($str, $rightSide));

			return self::getPrimitiveVar($value);
		}
	}

	private static function readString(&$str) {
		$ndx = 1;
		$len = strlen($str);
		$escaping = false;
		$result = '';
		$quoteChar = $str[0];

		while ($str[$ndx] != $quoteChar || $escaping) {
			$char = $str[$ndx];
			$ndx++;
			if ($ndx == $len) {
				throw new Exception("String \"{$result}\" does not terminate");
			}

			if ($escaping) {
				$escaping = false;
				switch ($char) {
					case 't':
						$result .= "\t";
						break;
					case 'r':
						$result .= "\r";
						break;
					case 'n':
						$result .= "\n";
						break;
					default:
						$result .= $char;
						break;
				}
				continue;
			}

			if ($char == '\\') {
				$escaping = true;
			}
			else {
				$result .= $char;
			}
		}

		$str = ltrim(substr($str, $ndx + 1));
		return $result;
	}

	/**
	 * Converts value strings to their real primitive value
	 * Supports booleans and numbers
	 *
	 * @param string $input
	 * @return mixed
	 */
    private static function getPrimitiveVar($input) {
		if (strcasecmp($input, 'true') === 0) {
			return true;
		}

		if (strcasecmp($input, 'false') === 0) {
			return false;
		}

		if (strcasecmp($input, 'null') === 0) {
			return null;
		}

        if (is_numeric($input)) {
            return floatval($input);
        }

        throw new Exception("Unrecognized primitive value");
    }
}