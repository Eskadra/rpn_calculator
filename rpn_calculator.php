<?php
/**
 * rpn - reverse polish notation
 *
 * @author Fedor Vyrzhykovsky
 */

namespace app\components;
use yii\base\Widget;

class rpn_calculator extends Widget{

    public $message;

    public function init(){
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function run(){
        parent::run(); // TODO: Change the autogenerated stub
        //создаем строку с ошибкой
        $errStr =  '[ Error: string is NULL ]';
        //в случае если строка message пуста выдаем ошибку, если нет передаем строку дальше
        if ($this->message === null) {
            //вызываем строку с ошибкой
            return $this->message = $errStr;
        } else {
            //rpnCalc но сперва проверим на правильность написания используя isCopyPast()
            return $nStr = $this->isWriteRight($this->message);
        }
    }

    public function isWriteRight($message){
        //регулярное выражение на проверку двух неизвестных символов
        $pattern = "/[÷×]/";
        //Если есть совпадения в строке
        if( preg_match($pattern, $message) ){
            //Вслучае если все таки есть совпадения передаем строку в функцию isCopyPast($message)
            return $this->isCopyPast($message);
        }else{
            //если данных символов нет считаем результат испозуя функцию rpnCalc($message)
            return $this->rpnCalc($message);
        }
    }

    public function isCopyPast($message){
        //Создаем массив с нашими неизвестными операторами
        $notAcceptableOperators = array("+", "−", "÷", "×");
        //Разбираем строку и создаем разделитель ' '
        $key = explode(' ', $message);
        //создаем пустую строку
        $convertedRes = '';
        //Создаем наш стек
        foreach ($key as $value)
            //проверяем значения в стеке числовые они или нет
            if (is_numeric($value)) {
                $numbers[] = $value;
            }elseif (in_array($value, $notAcceptableOperators)) {
                //извлекаем первый элемент массива
                $fNum = array_pop($numbers);
                //извлекаем второй элемент массива
                $sNum = array_pop($numbers);
                //далее все просто если по мере прохождения стека мы натыкаемся на операторов +-/* переменовываем их в нормальных и складываем значения
                switch ($value) {
                    case '+':
                        $value = '+';
                        $convertedRes = $sNum . ' ' . $fNum . ' ' . $value;
                        break;
                    case '−':
                        $value = '-';
                        $convertedRes = $sNum . ' ' . $fNum . ' ' . $value;
                        break;
                    case '÷':
                        $value = '/';
                        $convertedRes = $sNum . ' ' . $fNum . ' ' . $value;
                        break;
                    case '×':
                        $value = '*';
                        $convertedRes = $sNum . ' ' . $fNum . ' ' . $value;
                        break;
                }
                //Добавляем несколько элементов массива
                array_push($numbers, $convertedRes);
            }
        //Возвращает количество символов в исходной строке
        $xyz = iconv_strlen($message);
        //Возвращает количество символов в переделанной строке
        $zyx = iconv_strlen($convertedRes);
        //сравниваем для проверки результата
        if ($xyz===$zyx){
            return  $this->rpnCalc($convertedRes);
        }else{
            return 'The algorithm did not work correctly, kindly bring your operators to a normal view!';
        }
    }

    public function rpnCalc($message){
        //Создаем массив с нашими операторами
        $acceptableOperators = array("+", "-", "/", "*");
        //Разбираем строку и создаем разделитель ' '
        $key = explode(' ', $message);
        //создаем пустую строку
        $calcRes='';
        //Проверяем на кол-во символов оно не должно быть равным 1 и в конце нашего массива обязательно должен стоять оператор
        if (count($key) == 1){
            return 'More than 2 characters required.';
        } elseif ( !in_array(end($key), $acceptableOperators) ){
            return 'The last character must be an operator.';
        }
        //Создаем наш стек
        foreach ($key as $value) {
            //проверяем значения в стеке числовые они или нет
            if (is_numeric($value)) {
                $numbers[] = $value;
            } elseif (in_array($value, $acceptableOperators)) {
                //извлекаем первый элемент массива
                $fNum = array_pop($numbers);
                //извлекаем второй элемент массива
                $sNum = array_pop($numbers);
                //далее все просто если по мере прохождения стека мы натыкаемся на операторов +-/* и прибавляем к ним 2 крайних числа
                switch ($value) {
                    case '+':
                        $calcRes = $sNum + $fNum;
                        break;
                    case '-':
                        $calcRes = $sNum - $fNum;
                        break;
                    case '/':
                        $calcRes = $sNum / $fNum;
                        break;
                    case '*':
                        $calcRes = $sNum * $fNum;
                        break;
                }
                array_push($numbers, $calcRes);
            }
        }
        //возвращяем наш результат
        return $calcRes;
    }
}
