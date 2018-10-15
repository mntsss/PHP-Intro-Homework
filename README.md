# PHP-Intro-Homework

Project has two dependencies:
1. https://github.com/paragonie/EasyRSA
2. https://packagist.org/packages/phpunit/php-timer

Not using type hinting pros:
  In theory methods should accept any type of arguments and work with it as long as incorrect parameter type doesn't trigger an unhandled
exception. This could make methods more versatile and reusable. In this particular case, though, EasyRSA checks argument types inside it's 
methods, so even if I don't use type hinting and strict types, exception is still thrown.

Not using type hinting cons:
  It's difficult to predict how certain methods will react when given arguments with incorrect type. And a software shouldn't have 
  cases where it could act unpredictably, so naturally that's a big disadvantage of not using strict types and type hinting.
  
Using strict types and type hinting pros:
  For some reason using type hints script's speed drastically improved (even though I couldn't find any information in docs on why or how
  type hinting could affect performance). On mid range CPU (i5 4690) performance improvement wasn't that noticeable, hovever when I 
  tried running the same script on older CPU (Xeon W3520) proccessing time decreased up to 20 times when using type hinting.
  Another big advantage is that type hinting helps to catch errors earlier and makes it easier to diagnose compared to when something 
  goes wrong down in the method or in methods that it calls. 
  Also type hinting makes code a little bit more readable and helps other developers to understand what's going on in methods' calls 
  hierarchy. 
  Oh, and type hints eliminate a need to manually check if given argument has corrent type in case it's crucial that argument's type (or 
  function return type) would be as expected (great substitute for is_string, is_bool and etc...).
  
Cons:
  I guess a little bit more code.

