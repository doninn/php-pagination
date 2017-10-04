<?php
include_once "../src/Pagination.php";

use \renders\pagination\Pagination;

$url = parse_url ($_SERVER['REQUEST_URI'])['path'];
$number_of_posts = 1000;
$posts_per_page = 10;

$pages = Pagination::GetPagesCount($number_of_posts, $posts_per_page);
$page = Pagination::ValidatePageIndex(intval(isset($_GET['p']) ? $_GET['p'] : 1), $pages);

$pagination = new Pagination($page, $pages, $url);
$pagination_html = $pagination->Render();

?>
<html>
<head>
    <!-- Twitter Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- highlight.js -->
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <!-- tidy-html5 -->
    <script src='http://lovasoa.github.io/tidy-html5/tidy.js'></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <!-- Twitter Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <style>
        pre {
            border-top: none;
            border-bottom: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-radius: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <?php echo $pagination_html; ?>

    <div class="jumbotron">
        <h1>php-pagination demo page</h1>
        <p>Active page index is <strong><?php echo $page; ?></strong></p>
        <p>
            <a class="btn btn-primary btn-lg" target="_blank"
              href="https://github.com/doninn/php-pagination" role="button">
                View on Github
            </a>
        </p>
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#source_html" aria-controls="home" role="tab" data-toggle="tab">Paginagion HTML of this page</a></li>
        <li role="presentation"><a href="#source_php" aria-controls="profile" role="tab" data-toggle="tab">PHP code behind</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="source_html">

            <pre><code id="html" class="html"></code></pre>
        </div>
        <div role="tabpanel" class="tab-pane" id="source_php">
            <pre><code id="php" class="php">use \renders\pagination\Pagination;

$url = parse_url ($_SERVER['REQUEST_URI'])['path'];
$number_of_posts = 1000;
$posts_per_page = 10;

$pages = Pagination::GetPagesCount($number_of_posts, $posts_per_page);
$page = Pagination::ValidatePageIndex(intval(isset($_GET['p']) ? $_GET['p'] : 1), $pages);

$pagination = new Pagination($page, $pages, $url);
$pagination_html = $pagination->Render();</code></pre>
        </div>
    </div>

    <?php echo $pagination_html; ?>
</div>

<script>
    var options = {
        "indent":"auto",
        "indent-spaces":2,
        "wrap":80,
        "markup":true,
        "output-xml":false,
        "numeric-entities":true,
        "quote-marks":true,
        "quote-nbsp":false,
        "show-body-only":true,
        "quote-ampersand":false,
        "break-before-br":true,
        "uppercase-tags":false,
        "uppercase-attributes":false,
        "drop-font-tags":true,
        "tidy-mark":false
    };

    $(function() {
        var soure = '<?php echo $pagination_html; ?>';
        var tidy_code = tidy_html5(soure, options);
        var result = hljs.highlight("html", tidy_code);
        $('#html').html(result.value);
        hljs.highlightBlock($('#php')[0]);
    });

</script>


</body>
</html>