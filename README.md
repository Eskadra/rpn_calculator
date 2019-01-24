# rpn_converter: widget for yii2 

# What does it do
Calculates the arithmetic expressions specified by the user in rpn</br>example: 15 7 1 1 + − ÷ 3 × 2 1 1 + + − = 15

## Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Remember to refer to the [composer.json](https://github.com/kartik-v/yii2-widgets/blob/master/composer.json) for 
this extension's requirements and dependencies. 

### Install

Either run

```
$ php composer.phar require Eskadra/rpn_converter "*"
```

or add

```
"Eskadra/rpn_converter": "*"
```

to the ```require``` section of your `composer.json` file.

### how it works
```php
use Eskadra\rpn_converter;

echo rpn_converter::widget(
['message'=>'15 7 1 1 + − ÷ 3 × 2 1 1 + + −']
);
```
