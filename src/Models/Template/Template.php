<?php

namespace App\Models\Template;

use Exception;

class Template
{

    public $file;

    public $vars = array();
    public function set($key, $value)
    {

        $this->vars[$key] = $value;
    }

    public function display()
    {
        try {
            if (file_exists($this->file)) {
                $output = file_get_contents($this->file);
                foreach ($this->vars as $innerArray) {
                    //  Check type
                    if (is_array($innerArray)) {
                        //  Scan through inner loop
                        foreach ($innerArray as $key => $value) {
                            $output = preg_replace('/{' . $key . '}/', $value, $output);
                        }
                        echo $output;
                    }
                }
            } else {
                throw new Exception("Missing template --" . $this->file);
            }
        } catch (Exception $e) {

            echo "Exception caught: " . $e->getMessage();
        }
    }
}
