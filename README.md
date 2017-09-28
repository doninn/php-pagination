# php-pagination
PHP pagination view class.

This class generates HTML code with pagination ul compartable with Bootstrap 3.

Basic usage example:
```php
$url = "http:\\www.example.com";
$number_of_posts = 100;
$page = min(max(intval($_GET['p']), 1), $number_of_posts);

$pagination = new \renders\pagination\Pagination($page, $pages, $url);

echo $pagination->Render();
```
