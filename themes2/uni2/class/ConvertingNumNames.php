<?php
interface ConvertingNumNamesInterface{

    const name = [
        'hour' => ['Час', 'Часа', 'Часов', 'Часов'],
        'day' => ['День', 'Дня', 'Деней', 'Деней'],
        'month' => ['Месяц', 'Месяца', 'Месяцев', 'Месяцев'],
        'year' => ['Год', 'Года', 'Лет', 'Лет'],
    ];

    public function key($key);

    public function number($number, $number_type = '');

    public function pre($params);

    public function register($params);

    public function get();
}

class ConvertingNumNames implements ConvertingNumNamesInterface
{

    private $params = [];

    private $number;

    private $register;

    private $pre;

    public function key($key)
    {
        if(is_array($key) && count($key) == 4){
            $this->params = $key;
        } else {
            $this->params = $this::name[(string)$key];
        }
        return $this;
    }

    public function number($number, $number_option = [])
    {
        if(count($number_option) != 0){
            switch ($number_option['type']){
                case 'price':
                    $number = number_format($number, 0, ',', ' ');
                    break;
            }
        }
        $this->number = $number;
        return $this;
    }

    public function pre($params)
    {
        $this->pre = $params;
        if(in_array(mb_strtolower($this->pre), ['от', 'до'])){
            $this->params[0] = $this->params[1];
        };
        return $this;
    }

    public function register($params)
    {
        $this->register = $params;
        return $this;
    }

    public function get()
    {
        if(preg_match("|(1)$|", $this->number)){
            $string = $this->params[0];
        } elseif(preg_match("/(2|3|4)$/", $this->number)){
            $string = $this->params[1];
        } else {
            $string = $this->params[2];
        }
        if(preg_match("/(1)[0-9]$/", $this->number)){
            $string = $this->params[2];
        }

        $string = $this->number. ' ' . $string;

        if($this->pre != ''){
            $string = $this->pre . ' ' . $string;
        }

        if($this->register != ''){
            if($this->register == 1){
                $string = mb_strtolower($string); // Преобразует строку в нижний регистр
            }
            if($this->register == 2){
                $string = mb_strtoupper($string); // Преобразует строку в верхний регистр
            }
        }

        return $string;
    }
}