<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $page->getMeta ()->title;?></title>
<meta name="description" content="<?php echo $page->getMeta ()->description;?>" />
<meta name="keywords" content="<?php echo $page->getMeta ()->keywords;?>" />

<?php if (!$pagefactory->getIsError ()):?>
  <link rel="canonical" href="<?php echo $page->getURL ();?>" />
<?php else:?>
  <meta name="robots" content="noindex" />
<?php endif;?>

<?php if (($homemodel = Helper::getPageModel ('/')) !== null):?>
  <link rel="index" title="<?php echo $homemodel->getMeta ()->title;?>" href="<?php echo $homemodel->getURL ();?>" />
<?php endif;?>
<?php unset ($homemodel);?>

<?php /*
<link rel="apple-touch-icon" href="/" />
<link rel="icon" type="image/x-icon" href="/" />
*/ ?>

<meta name="google-site-verification" content="KbMvARV-NPa7QQgMR_ePdQ" />

<meta name="viewport" content="width=device-width,initial-scale=1.0" />

<link href="http://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet" type="text/css" />
<link href="stylesheets/fonts/styles.css" media="screen, projection" rel="stylesheet" type="text/css" />
<link href="stylesheets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />