<?php

namespace Deimos;

class Morphy extends \phpMorphy
{

    protected $_rows = [];

    /**
     * Alias for getBaseForm
     *
     * @param mixed $word - string or array of strings
     * @param mixed $type - prediction managment
     * @return array
     */
    function lemmatize($word, $type = self::NORMAL) {
        if (isset($this->_rows[$word][$type]))
            return $this->_rows[$word][$type];

        $this->_rows[$word][$type] = $this->getBaseForm($word, $type);
        return $this->_rows[$word][$type];
    }

    /**
     * @param mixed $word - string or array of strings
     * @param mixed $type - prediction managment
     * @return array
     */
    function getBaseForm($word, $type = self::NORMAL) {
        if (isset($this->_rows[$word][$type]))
            return $this->_rows[$word][$type];

        $this->_rows[$word][$type] = $this->invoke('getBaseForm', $word, $type);
        return $this->_rows[$word][$type];
    }

}

class phpMorphy
{

    private $_morphy = array();

    /**
     * @param $key
     * @return Morphy
     */
    public function get($key)
    {
        return $this->__get($key);
    }

    /**
     * @param $key
     * @return Morphy|null
     */
    public function __get($key)
    {
        if ($key == 'ru') {
            $key = 'ru_RU';
        }
        elseif ($key == 'en') {
            $key = 'en_EN';
        }
        else {
            return null;
        }

        if (!isset($this->_morphy[$key]))
            $this->_morphy[$key] = $this->init($key);

        return $this->_morphy[$key];
    }

    /**
     * @param $lang
     * @return \phpMorphy
     */
    private function init($lang)
    {
        $opts = array(
            'storage' => PHPMORPHY_STORAGE_MEM,
            'predict_by_suffix' => true,
            'predict_by_db' => true,
            'graminfo_as_text' => true,
            'common_source' => array(
                'type' => 'fsa',
                'opts' => null
            )
        );
        $dir = __DIR__ . '/phpMorphy/dicts/' . $lang;
        return new Morphy($dir, $lang, $opts);
    }

}