<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title('|',true,'right') ?>Weekly Filet. The best of the week, in one newsletter.</title>
       
<meta name="author" content="David Bauer" >
<meta name="publisher" content="David Bauer" >
<meta name="copyright" content="(c) David Bauer" >
<meta name="description" content="<?php
if(is_home()):
echo 'The Weekly Filet is a weekly compilation of the best pieces found on the web. Intriguing articles, stunning photographs, telling visualisations, excellent songs, smart videos. 5 recommended links, every Friday, free home-delivery.';
else: if (have_posts()): while (have_posts()): the_post();
echo strip_tags(get_the_excerpt()); endwhile; endif; endif;?>" />
<meta name="Content-Language" content="en" />
<meta name="keywords" content="weekly filet, curation, content, david bauer, journalist" > 

<meta property="og:title" content="<?php wp_title('|',true,'right') ?>Weekly Filet. The best of the week, in one newsletter."/>
<meta property="og:image" content="<?php echo catch_that_image() ?>"/>
<meta property="og:type" content="article"/> 
<meta property="og:site_name" content="Weekly Filet"/>
<meta property="article:author" content="https://www.facebook.com/davidbauer" />
<meta property="og:app_id" content="153576157369"/>

<meta name="twitter:card" content="summary">
<meta name="twitter:creator" content="@davidbauer">
<meta name="twitter:url" content="<?php the_permalink(); ?>">
<meta name="twitter:title" content="<?php wp_title(''); ?>">
<meta name="twitter:description" content="<?php if (have_posts() && !is_home()): while (have_posts()): the_post(); echo strip_tags(get_the_excerpt()); endwhile; else: _e('A weekly compilation of the best pieces found on the web. Intriguing articles, stunning photographs, telling visualisations, excellent songs, smart videos. 5 links, every Friday, free home-delivery.', 'ia3'); endif;?>">
<meta name="twitter:image" content="http://www.weeklyfilet.com/wp-content/themes/weeklyfilet-V3/images/logo.png">
<meta property="twitter:site" content="@weeklyfilet" />
<meta property="twitter:domain" content="weeklyfilet.com" />


<link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
<link rel="alternate" type="application/rss+xml" title="Weekly Filet RSS Feed" href="http://www.weeklyfilet.com/feed" />
<link rel="pingback" href="http://www.weeklyfilet.com/xmlrpc.php" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>


<?php wp_head(); ?>

<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18717219-5']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>


<body <?php body_class(); ?>>

<div id="topbar">
	<div class="t t1"> </div>
	<div class="t t2"> </div>
	<div class="t t3"> </div>
	<div class="t t4"> </div>
	<div class="t t5"> </div>
	<div class="t t6"> </div>
	<div class="t t7"> </div>
	<div class="t t8"> </div>
</div>

	<div id="wrap" class="clr">

		<?php get_sidebar( 'sidebar' ); ?>

		<div class="site-main-wrap clr">
			<div id="main" class="site-main clr container">
			
			