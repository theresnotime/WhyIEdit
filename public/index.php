<?php
/**
 * Index file
 * 
 * PHP version 8
 *
 * @category  HTML
 * @package   WhyIEdit
 * @author    Sam <sam@theresnotime.co.uk>
 * @copyright 2021 Sam
 * @license   <https://opensource.org/licenses/MIT> MIT
 * @version   GIT: 1.0.0
 * @link      #
 */
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

$meta = new WhyIEdit\Meta('en');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php echo $meta->site_desc; ?>"/>
        <title><?php echo $meta->site_name; ?></title>
        <!-- Preconnects etc -->
        <link rel="dns-prefetch" href="//i1.wp.com" />
        <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
        <link rel="dns-prefetch" href="//imagedelivery.net" />
        <link rel="dns-prefetch" href="//www.google-analytics.com">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Nanum+Pen+Script&display=swap"
            rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
        <!-- SEO -->
        <meta property="og:title" content="<?php echo $meta->site_name; ?>">
        <meta property="og:description" content="<?php echo $meta->site_desc; ?>">
        <meta property="og:image" content="todo">
        <meta property="og:url" content="https://www.theresnotime.co.uk">
        <meta name="twitter:title" content="<?php echo $meta->site_name; ?>">
        <meta name="twitter:description" content="<?php echo $meta->site_desc; ?>">
        <meta name="twitter:image" content="todo">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="todo">
        <!-- Critical JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
        </script>
        <script src="/assets/js/why.js"></script>
    </head>
    <body>
        <div class="container text-center main">
            <div class='row justify-content-center'>
                <div class='col-6 col-lg-3 align-self-center'>
                    <img src="/assets/img/wikipedia-logo.png" class="img-fluid rounded mx-auto d-block">
                </div>
            </div>
            
            <h1 class="display-2 user">
                <span id="user" style="opacity:0;">&nbsp;</span>
            </h1>
            <h1 class="display-4 edits">
                <em><span id="editsto"></span></em>
            </h1>
            <h2 class="display-2 quotes" id="quotes">
                <span class="text-wrapper">
                    <span class="line line1"></span>
                    <span class="letters" id="quoteText">&nbsp;</span>
                </span>
            </h2>
            <p class="lead" id="sign-up">&nbsp;</p>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"
            integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
    </body>
</html>