<?php

/**
 * A base class that provides a basic framework for processing annotation comments
 */
class AnnotatedClass {
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

                $methodCalls = explode("\n", $comment);
                $methodCalls = array_map(function($line) {
					$line = preg_replace('/^\\s*(?:\\/\\*)?\\*\\s*/', '', $line);

                    if ($line && $line[0] == '@') {
                        $line = substr($line, 1);
                        $len = strlen($line);

                        $func = $line;
                        $paren = strpos($func, '(');
                        if ($paren !== false) {
                            if ($line[$len - 1] != ')') {
                                return false;
                            }

                            $func = rtrim(substr($func, 0, $paren));
                        }
                        elseif (strpos($func, ' ') !== false) {
                            return false;
                        }

                        $args = [];
                        if ($paren !== false) {
                            $argsStr = trim(substr($line, $paren + 1, $len - $paren - 2));
                            $len = strlen($argsStr);

                            while ($len) {
                                $firstChar = $argsStr[0];

                                if ($firstChar == '"' || $firstChar == "'") {
                                    // read string
                                    $ndx = 1;
                                    $escaping = false;
                                    $str = '';
                                    while ($argsStr[$ndx] != $firstChar || $escaping) {
                                        $char = $argsStr[$ndx];
                                        $ndx++;
                                        if ($ndx == $len) {
                                            return false;
                                        }

                                        if ($escaping) {
                                            $escaping = false;
                                            $str .= $char;
                                            continue;
                                        }

                                        if ($char == '\\') {
                                            $escaping = true;
                                        }
                                        else {
                                            $str .= $char;
                                        }
                                    }

                                    $args[] = $str;
                                    $skip = $ndx + 1;
                                }
                                else {
                                    // read not-string
                                    $comma = strpos($argsStr, ',');
                                    if ($comma === false) {
                                        $comma = $len;
                                    }

                                    $args[] = self::getDocBlockVar(rtrim(substr($argsStr, 0, $comma)));
                                    $skip = 0;
                                }

                                $skip = strpos($argsStr, ',', $skip);
                                if ($skip === false) {
                                    $skip = $len;
                                }
                                else {
                                    $skip++;
                                }

                                $argsStr = ltrim(substr($argsStr, $skip));
                                $len = strlen($argsStr);
                            }
                        }
                        else {
                            $args = [];
                        }

                        return [
                            'func' => $func,
                            'args' => $args
                        ];
                    }
                }, $methodCalls);

				$methodCalls = array_filter($methodCalls);
			}
			else {
				$methodCalls = [];
			}

			// Format the results
			$methodCalls = [
				'calls' => $methodCalls
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

	/**
	 * Converts value strings to their real primitive value
	 * Supports booleans and numbers
	 *
	 * @param string $input
	 * @return mixed
	 */
    private static function getDocBlockVar($input) {
		if (strcasecmp($input, 'true') === 0) {
			return true;
		}

		if (strcasecmp($input, 'false') === 0) {
			return false;
		}

        if (is_numeric($input)) {
            return floatval($input);
        }

        return null;
    }
}