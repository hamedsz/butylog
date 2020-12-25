# Butylog

### Installation

Install the package from composer

```sh
$ composer install hamedsz/butylog
```

add this code to ur env file...

```sh
BUTYLOG=true
```

add this line of code to ur app.php file in providers array in config folder...

```sh
\hamedsz\butylog\AppServiceProvider::class
```

### How to use?

in your controllers you can call ButyLog::log static method to log ur data

```sh
ButyLog::log("this is title" , $some_variable);
```

### How to see logs?

for watch system logs u can use this url:


```sh
http://{APP_URL}/butylogs
```
