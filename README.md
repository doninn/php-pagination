# php-pagination
PHP pagination view class.

This class generates HTML code with pagination ul compartable with Bootstrap 3.

## Usage
Basic usage example:
```php
$url = "/mypage";
$number_of_posts = 100;
$posts_per_page = 10;

$pages = ceil($number_of_posts / $posts_per_page);
$page = min(max(intval($_GET['p']), 1), $pages);

$pagination = new \renders\pagination\Pagination($page, $pages, $url);

echo $pagination->Render();
```

## License 
MIT
