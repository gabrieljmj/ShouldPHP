<?php
/**
 * ShouldPHP
 *
 * @author  Gabriel Jacinto <gamjj74@hotmail.com>
 * @status  dev
 * @link    https://github.com/GabrielJMJ/ShouldPHP
 * @license MIT
 */

namespace Gabrieljmj\Should\Tool;

trait ClassFileInfoTrait
{
    protected $file;

    protected $class;
    protected $namespace;

    protected function getClass($file)
    {
        if ($this->class === null) {
            $this->detectInfo($file);
        }

        return $this->class;
    }

    protected function getNamespace($file)
    {
        if ($this->class === null) {
            $this->detectInfo($file);
        }

        return $this->namespace;
    }

    private function detectInfo($file)
    {
        $fp = fopen($file, 'r');
        $this->class = $this->namespace = $buffer = '';
        $i = 0;

        while (!$this->class) {
            if (feof($fp)){
                break;
            }

            $buffer .= fread($fp, 512);
            $tokens = token_get_all($buffer);

            if (strpos($buffer, '{') === false) {
                continue;
            }

            $totalTokens = count($tokens);

            for (; $i < $totalTokens; $i++) {
                if ($tokens[$i][0] === T_NAMESPACE) {
                    for ($j = $i + 1; $j < $totalTokens; $j++) {
                        if ($tokens[$j][0] === T_STRING) {
                            $this->namespace .= '\\'.$tokens[$j][1];
                        } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                            break;
                        }
                    }
                }

                if ($tokens[$i][0] === T_CLASS) {
                    for ($j = $i + 1; $j < $totalTokens; $j++) {
                        if ($tokens[$j] === '{') {
                            $this->class = $tokens[$i + 2][1];
                        }
                    }
                }

            }
        }
    }
}