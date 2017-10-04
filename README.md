<p align="center">
    <img width="160" height="160" src="http://assets.doninn.com/php-projects/php-pagination/images/php_pagination.png"/>
</p>

# php-pagination
PHP pagination view class.

<p>
<strong>
<a href="http://naprimerax.org/demo/php-projects/php-pagination/demo/" target="_blank">DEMO</a>
</strong>
</p>

This class generates HTML code with pagination ul compatible with Bootstrap 3.

## Usage
Basic usage example:
```php
<?php
use \renders\pagination\Pagination;

$url = parse_url ($_SERVER['REQUEST_URI'])['path'];
$number_of_posts = 1000;
$posts_per_page = 10;

$pages = Pagination::GetPagesCount($number_of_posts, $posts_per_page);
$page = Pagination::ValidatePageIndex(intval(isset($_GET['p']) ? $_GET['p'] : 1), $pages);

$pagination = new \renders\pagination\Pagination($page, $pages, $url);

?>
<html>
<head>
    <!-- Twitter Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
    <?php echo $pagination; ?>
    <h1>Active page: <?php echo $page; ?></h1>
</body>
</html>
```
Pagination outputs of this example:
<p align="center">
    <img src="http://assets.doninn.com/php-projects/php-pagination/images/screenshot1.png"/>
</p>
<p align="center">
    <img src="http://assets.doninn.com/php-projects/php-pagination/images/screenshot2.png"/>
</p>
<p align="center">
    <img src="http://assets.doninn.com/php-projects/php-pagination/images/screenshot3.png"/>
</p>

## License 
MIT
