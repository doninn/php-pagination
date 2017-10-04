<?php
include_once "../src/Pagination.php";

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
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
</head>
<body>
    <?php echo $pagination; ?>
    <h1>Active page: <?php echo $page; ?></h1>
</body>
</html>
