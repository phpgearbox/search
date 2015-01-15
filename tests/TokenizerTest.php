<?php
////////////////////////////////////////////////////////////////////////////////
// __________ __             ________                   __________              
// \______   \  |__ ______  /  _____/  ____ _____ ______\______   \ _______  ___
//  |     ___/  |  \\____ \/   \  ____/ __ \\__  \\_  __ \    |  _//  _ \  \/  /
//  |    |   |   Y  \  |_> >    \_\  \  ___/ / __ \|  | \/    |   (  <_> >    < 
//  |____|   |___|  /   __/ \______  /\___  >____  /__|  |______  /\____/__/\_ \
//                \/|__|           \/     \/     \/             \/            \/
// -----------------------------------------------------------------------------
//          Designed and Developed by Brad Jones <brad @="bjc.id.au" />         
// -----------------------------------------------------------------------------
////////////////////////////////////////////////////////////////////////////////

use Gears\Search\TextProcessors\Tokenizer;

class TokenizerTest extends PHPUnit_Framework_TestCase
{
	public function testTokenizer()
	{
		$tokenizer = new Tokenizer();

$string = <<<HTML
<!DOCTYPE html>

<html lang="en-US">

	<head>
		
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" >
																		
		<title>Hipster Ipsum | Artisanal filler text for your site or project.</title>
				
				 
		<link rel="alternate" type="application/rss+xml" title="Hipster Ipsum &raquo; Feed" href="http://hipsum.co/feed/" />
<link rel="alternate" type="application/rss+xml" title="Hipster Ipsum &raquo; Comments Feed" href="http://hipsum.co/comments/feed/" />
<link rel='stylesheet' id='jetpack_image_widget-css'  href='http://hipsum.co/wp-content/plugins/jetpack/modules/widgets/image-widget/style.css?ver=20140808' type='text/css' media='all' />
<link rel='stylesheet' id='jetpack_css-css'  href='http://hipsum.co/wp-content/plugins/jetpack/css/jetpack.css?ver=3.3' type='text/css' media='all' />
<link rel='stylesheet' id='hemingway_googleFonts-css'  href='//fonts.googleapis.com/css?family=Lato%3A400%2C700%2C400italic%2C700italic%7CRaleway%3A700%2C400&#038;ver=4.1' type='text/css' media='all' />
<link rel='stylesheet' id='hemingway_style-css'  href='http://hipsum.co/wp-content/themes/steinbeck/style.css?ver=4.1' type='text/css' media='all' />
<script type='text/javascript' src='http://hipsum.co/wp-includes/js/jquery/jquery.js?ver=1.11.1'></script>
<script type='text/javascript' src='http://hipsum.co/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1'></script>
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://hipsum.co/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://hipsum.co/wp-includes/wlwmanifest.xml" /> 
<link rel='canonical' href='http://hipsum.co/' />
<link rel='shortlink' href='http://hipsum.co/' />
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-37342493-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<meta name="google-site-verification" content="nswTjpSXlHOcmtmt9zG1YxigkXCK7mSaU7BptP2Y5MU" /><meta name="google-site-verification" content="nswTjpSXlHOcmtmt9zG1YxigkXCK7mSaU7BptP2Y5MU" />      
	      <!--Customizer CSS--> 
	      
	      <style type="text/css">
	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           	           
	           	           	      </style> 
	      
	      <!--/Customizer CSS-->
	      
      		<link rel="stylesheet" id="custom-css-css" type="text/css" href="http://hipsum.co/?custom-css=1&#038;csblog=1&#038;cscache=6&#038;csrev=14" />
			
	</head>
	
	<body class="home page page-id-5 page-template-default">
	
		<div class="big-wrapper">
	
			<div class="header-cover section bg-dark-light no-padding">
		
				<div class="header section" style="background-image: url(http://hipsum.co/wp-content/uploads/2014/03/cropped-flannel1.jpg);">
							
					<div class="header-inner section-inner">
					
						<div class="blog-info">
						
							<h1 class="blog-title">
								<a href="http://hipsum.co" title="Hipster Ipsum &mdash; Artisanal filler text for your site or project." rel="home">Hipster Ipsum</a>
							</h1>
							
														
								<h3 class="blog-description">Artisanal filler text for your site or project.</h3>
								
													
						</div> <!-- /blog-info -->
									
					</div> <!-- /header-inner -->
								
				</div> <!-- /header -->
			
			</div> <!-- /bg-dark -->
			
			<div class="navigation section no-padding bg-dark">
			
				<div class="navigation-inner section-inner">
				
					<div class="toggle-container hidden">
			
						<div class="nav-toggle toggle">
								
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
							
							<div class="clear"></div>
						
						</div>
						
						<div class="search-toggle toggle">
								
							<div class="metal"></div>
							<div class="glass"></div>
							<div class="handle"></div>
						
						</div>
						
						<div class="clear"></div>
					
					</div> <!-- /toggle-container -->
					
					<div class="blog-search hidden">
					
						<form method="get" class="searchform" action="http://hipsum.co/">
	<input type="search" value="" placeholder="Search form" name="s" id="s" /> 
	<input type="submit" id="searchsubmit" value="Search">
</form>					
					</div>
				
					<ul class="blog-menu">
					
						<li id="menu-item-478" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-478"><a href="http://hipsum.co/show-off/">Humblebrag Time!</a></li>
<li id="menu-item-519" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-519"><a href="https://twitter.com/hipsum_">Twitter</a></li>
												
					 </ul>
					 
					 <div class="clear"></div>
					 
					 <ul class="mobile-menu">
					
						<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-478"><a href="http://hipsum.co/show-off/">Humblebrag Time!</a></li>
<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-519"><a href="https://twitter.com/hipsum_">Twitter</a></li>
						
					 </ul>
				 
				</div> <!-- /navigation-inner -->
				
			</div> <!-- /navigation -->

<div class="wrapper section-inner">						

	<div class="content left">
	
					
		<div class="posts">
	
			<div class="post">
			
																		
				<div class="post-header">
											
				    <h2 class="post-title">Home</h2>
				    				    
			    </div> <!-- /post-header -->
			   				        			        		                
				<div class="post-content">

<div class="hipsum"><p>Wolf jean shorts kogi pour-over, roof party YOLO Carles Austin mumblecore organic Brooklyn Echo Park retro.  Fixie messenger bag Brooklyn, fashion axe vinyl ennui craft beer polaroid cardigan gentrify next level scenester normcore retro.  Readymade Vice cornhole food truck, bicycle rights occupy cray Bushwick Thundercats Wes Anderson Godard.  Deep v freegan whatever, lo-fi 90's quinoa Shoreditch skateboard pork belly selfies.  Post-ironic sustainable Etsy wayfarers heirloom meggings.  Fashion axe fixie occupy banjo bespoke slow-carb mlkshk cliche quinoa retro art party readymade.  Food truck locavore church-key cray YOLO put a bird on it.</p><p>Small batch Portland wayfarers, hoodie next level Neutra PBR&B photo booth meggings lomo.  Asymmetrical Tumblr four dollar toast wolf quinoa lomo.  Ugh gentrify distillery pour-over.  Marfa try-hard beard, forage gastropub next level swag hoodie VHS Vice XOXO skateboard vegan health goth.  Blue Bottle fap raw denim cray artisan.  Pickled Vice VHS leggings mumblecore farm-to-table.  Four dollar toast trust fund photo booth gentrify meh.</p><p>Seitan hella Banksy Austin, pop-up asymmetrical paleo chillwave put a bird on it lumbersexual.  Locavore gluten-free squid brunch, tote bag XOXO sustainable.  Echo Park Pinterest cronut gastropub fap VHS, tattooed pork belly fashion axe.  Before they sold out normcore Echo Park, ennui mustache cardigan kale chips plaid pickled wolf hoodie selfies whatever farm-to-table.  Lomo drinking vinegar tousled, pour-over seitan DIY selfies.  XOXO shabby chic food truck ugh taxidermy, meggings American Apparel lomo heirloom farm-to-table photo booth selvage.  Cliche leggings freegan taxidermy, Vice pop-up meggings direct trade.</p><p>Vegan pop-up Marfa Portland organic.  Wayfarers gastropub direct trade  XOXO artisan.  Cred Tumblr whatever artisan.  Biodiesel farm-to-table church-key Kickstarter, cred selvage normcore Helvetica cornhole heirloom Pitchfork taxidermy Vice flexitarian slow-carb.  Kale chips single-origin coffee Wes Anderson, next level scenester vinyl craft beer Schlitz jean shorts aesthetic twee meditation Austin swag bitters.  Disrupt plaid Brooklyn, jean shorts ethical messenger bag VHS aesthetic.  Brunch Kickstarter kogi hashtag.</p></div>
							                                        
					<p>Oh. You need a little dummy text for your mockup? How quaint.</p>
<p>I bet you&#8217;re still using Bootstrap too&#8230;</p>
<form id="hipster-ipsum" action="/" method="get">
<table>
<tbody>
<tr>
<td></td>
<td><input type="submit" class="ghost-btn" value="Beer me!"/></td>
</tr>
<tr>
<td><strong>Options:</strong></td>
<td></td>
</tr>
<tr>
<td>Paragraphs:</td>
<td><input style="width: 40px;" type="text" maxlength="2" name="paras" value="4" /></td>
</tr>
<tr>
<td>Type:</td>
<td><select id="type" name="type" class="form-control"><option selected="selected" value="hipster-centric">Hipster, neat.</option><option value="hipster-latin">Hipster with a shot of Latin.</option></select></td>
</tr>
</tbody>
</table>
</form>
					
																			            			                        
				</div> <!-- /post-content -->
								
			</div> <!-- /post -->
			
			
		
		
					
		</div> <!-- /posts -->
		
			
		<div class="clear"></div>
		
	</div> <!-- /content left -->
	
	
	<div class="sidebar right" role="complementary">
	
		<div class="widget widget_text"><div class="widget-content"><h3 class="widget-title">PBR Money</h3>			<div class="textwidget"><script type="text/javascript" src="http://cdn.yoggrt.com/yoggrt.js?legacyid=1266117&zoneid=1353&key=8a3009cf0b78db15b03e28458bb098d6&serve=C6SD52Y&placement=hipsteripsumme" id="_yoggrt_js"></script></div>
		</div><div class="clear"></div></div><div class="widget widget_text"><div class="widget-content"><h3 class="widget-title">Visit</h3>			<div class="textwidget"><a href="http://labbunny.com">The Lab Bunny</a> — One time beauty school suspendee, two time college dropout, full time lipstick hoarder. Libra. Non-smoker. DTF.</div>
		</div><div class="clear"></div></div><div class="widget widget_image"><div class="widget-content"><h3 class="widget-title">Consume</h3><div class="jetpack-image-container"><div class="wp-caption aligncenter" ><a href="https://www.etsy.com/shop/theNewerYork/search?search_query=hipsum&amp;order=date_desc&amp;view_type=gallery&amp;ref=shop_search"><img src="http://hipsum.co/wp-content/uploads/2015/01/il_fullxfull.701978082_qnbo-compressor.jpg" width="300" height="300" /></a><p class="wp-caption-text">Posters and totes <a href="https://www.etsy.com/shop/theNewerYork/search?search_query=hipsum&amp;order=date_desc&amp;view_type=gallery&amp;ref=shop_search">now available</a> for your boring cubicle walls &amp; farmers market purchases!</p></div></div>
</div><div class="clear"></div></div>		
	</div><!-- /sidebar -->

	
	<div class="clear"></div>

</div> <!-- /wrapper -->
								
	<div class="footer section large-padding bg-dark">
		
		<div class="footer-inner section-inner">
		
						
				<div class="column column-1 left">
				
					<div class="widgets">
			
						<div class="widget widget_text"><div class="widget-content"><h3 class="widget-title">Credits</h3>			<div class="textwidget"><p><a href="http://jasoncosper.com/">Jason Cosper</a> made this. But he was more into it before it sold out.<br />
<!-- Header photo by the fantastically talented <a href="http://folio.ditz-revolution.net/">Helga Weber</a>. --></p>
</div>
		</div><div class="clear"></div></div>											
					</div>
					
				</div>
				
			 <!-- /footer-a -->
				
						
				<div class="column column-2 left">
				
					<div class="widgets">
			
						<div class="widget widget_text"><div class="widget-content"><h3 class="widget-title">Participate</h3>			<div class="textwidget"><p>Want to build an app that uses Hipster Ipsum? <a href="http://hipsterjesus.com/">There's an API for that</a>.</p>
<p>Make something cool using Hipster Ipsum? <a href="http://hipsteripsum.me/show-off/">Tell us about it</a>. Or don't. Whatever.</p>
</div>
		</div><div class="clear"></div></div>											
					</div> <!-- /widgets -->
					
				</div>
				
			 <!-- /footer-b -->
								
						
				<div class="column column-3 left">
			
					<div class="widgets">
			
						<div class="widget widget_text"><div class="widget-content"><h3 class="widget-title">Crass Commercialism</h3>			<div class="textwidget"><p>Like what we're doing? Consider using our referral links for these sites...</p>
<p><a href="http://www.amazon.com/exec/obidos/redirect?tag=boogah-20&path=subst/home/home.html">Amazon</a>, <a href="https://secure.backblaze.com/r/00q4hq">Backblaze</a>, <a href="http://www.jackthreads.com/invite/boogah">JackThreads</a>, <a href="https://grandst.com/r/4sz5b25re">Grand St.</a>, <a href="http://www.gilt.com/invite/boogah">Gilt</a>, <a href="http://fab.com/ej8cpb">Fab</a></p>
</div>
		</div><div class="clear"></div></div>											
					</div> <!-- /widgets -->
					
				</div>
				
			 <!-- /footer-c -->
			
			<div class="clear"></div>
		
		</div> <!-- /footer-inner -->
	
	</div> <!-- /footer -->
	
	<div class="credits section bg-dark no-padding">
	
		<div class="credits-inner section-inner">
	
			<p class="credits-left">
			
				Copyleft 2015 <a href="http://astrangerinthealps.com/" title="A Stranger in the Alps">A Stranger in the Alps</a>
			
			</p>
			
			<p class="credits-right">
				
				<span>Theme by <a href="http://www.andersnoren.se">Anders Noren</a></span> &mdash; <a title="To the top" class="tothetop">Up &uarr;</a>
				
			</p>
			
			<div class="clear"></div>
		
		</div> <!-- /credits-inner -->
		
	</div> <!-- /credits -->

</div> <!-- /big-wrapper -->

<script type='text/javascript' src='http://hipsum.co/wp-includes/js/comment-reply.min.js?ver=4.1'></script>
<script type='text/javascript' src='http://s0.wp.com/wp-content/js/devicepx-jetpack.js?ver=201503'></script>
<script type='text/javascript' src='http://hipsum.co/wp-content/themes/hemingway/js/global.js?ver=4.1'></script>

	<script src="http://stats.wp.com/e-201503.js" type="text/javascript"></script>
	<script type="text/javascript">
	st_go({v:'ext',j:'1:3.3',blog:'24067704',post:'5',tz:'-8'});
	var load_cmc = function(){linktracker_init(24067704,5,2);};
	if ( typeof addLoadEvent != 'undefined' ) addLoadEvent(load_cmc);
	else load_cmc();
	</script>
</body>
</html>
HTML;

		$this->assertEquals($tokenizer->process($string), array
		(
			0 => '',
			1 => 'hipster',
			2 => 'ipsum',
			3 => '',
			4 => 'artisanal',
			5 => 'filler',
			6 => 'text',
			7 => 'for',
			8 => 'your',
			9 => 'site',
			10 => 'or',
			11 => 'project',
			12 => 'hipster',
			13 => 'ipsum',
			14 => 'artisanal',
			15 => 'filler',
			16 => 'text',
			17 => 'for',
			18 => 'your',
			19 => 'site',
			20 => 'or',
			21 => 'project',
			22 => 'humblebrag',
			23 => 'time',
			24 => 'twitter',
			25 => 'humblebrag',
			26 => 'time',
			27 => 'twitter',
			28 => 'home',
			29 => 'wolf',
			30 => 'jean',
			31 => 'shorts',
			32 => 'kogi',
			33 => 'pourover',
			34 => 'roof',
			35 => 'party',
			36 => 'yolo',
			37 => 'carles',
			38 => 'austin',
			39 => 'mumblecore',
			40 => 'organic',
			41 => 'brooklyn',
			42 => 'echo',
			43 => 'park',
			44 => 'retro',
			45 => 'fixie',
			46 => 'messenger',
			47 => 'bag',
			48 => 'brooklyn',
			49 => 'fashion',
			50 => 'axe',
			51 => 'vinyl',
			52 => 'ennui',
			53 => 'craft',
			54 => 'beer',
			55 => 'polaroid',
			56 => 'cardigan',
			57 => 'gentrify',
			58 => 'next',
			59 => 'level',
			60 => 'scenester',
			61 => 'normcore',
			62 => 'retro',
			63 => 'readymade',
			64 => 'vice',
			65 => 'cornhole',
			66 => 'food',
			67 => 'truck',
			68 => 'bicycle',
			69 => 'rights',
			70 => 'occupy',
			71 => 'cray',
			72 => 'bushwick',
			73 => 'thundercats',
			74 => 'wes',
			75 => 'anderson',
			76 => 'godard',
			77 => 'deep',
			78 => 'v',
			79 => 'freegan',
			80 => 'whatever',
			81 => 'lofi',
			82 => '90s',
			83 => 'quinoa',
			84 => 'shoreditch',
			85 => 'skateboard',
			86 => 'pork',
			87 => 'belly',
			88 => 'selfies',
			89 => 'postironic',
			90 => 'sustainable',
			91 => 'etsy',
			92 => 'wayfarers',
			93 => 'heirloom',
			94 => 'meggings',
			95 => 'fashion',
			96 => 'axe',
			97 => 'fixie',
			98 => 'occupy',
			99 => 'banjo',
			100 => 'bespoke',
			101 => 'slowcarb',
			102 => 'mlkshk',
			103 => 'cliche',
			104 => 'quinoa',
			105 => 'retro',
			106 => 'art',
			107 => 'party',
			108 => 'readymade',
			109 => 'food',
			110 => 'truck',
			111 => 'locavore',
			112 => 'churchkey',
			113 => 'cray',
			114 => 'yolo',
			115 => 'put',
			116 => 'a',
			117 => 'bird',
			118 => 'on',
			119 => 'itsmall',
			120 => 'batch',
			121 => 'portland',
			122 => 'wayfarers',
			123 => 'hoodie',
			124 => 'next',
			125 => 'level',
			126 => 'neutra',
			127 => 'pbrb',
			128 => 'photo',
			129 => 'booth',
			130 => 'meggings',
			131 => 'lomo',
			132 => 'asymmetrical',
			133 => 'tumblr',
			134 => 'four',
			135 => 'dollar',
			136 => 'toast',
			137 => 'wolf',
			138 => 'quinoa',
			139 => 'lomo',
			140 => 'ugh',
			141 => 'gentrify',
			142 => 'distillery',
			143 => 'pourover',
			144 => 'marfa',
			145 => 'tryhard',
			146 => 'beard',
			147 => 'forage',
			148 => 'gastropub',
			149 => 'next',
			150 => 'level',
			151 => 'swag',
			152 => 'hoodie',
			153 => 'vhs',
			154 => 'vice',
			155 => 'xoxo',
			156 => 'skateboard',
			157 => 'vegan',
			158 => 'health',
			159 => 'goth',
			160 => 'blue',
			161 => 'bottle',
			162 => 'fap',
			163 => 'raw',
			164 => 'denim',
			165 => 'cray',
			166 => 'artisan',
			167 => 'pickled',
			168 => 'vice',
			169 => 'vhs',
			170 => 'leggings',
			171 => 'mumblecore',
			172 => 'farmtotable',
			173 => 'four',
			174 => 'dollar',
			175 => 'toast',
			176 => 'trust',
			177 => 'fund',
			178 => 'photo',
			179 => 'booth',
			180 => 'gentrify',
			181 => 'mehseitan',
			182 => 'hella',
			183 => 'banksy',
			184 => 'austin',
			185 => 'popup',
			186 => 'asymmetrical',
			187 => 'paleo',
			188 => 'chillwave',
			189 => 'put',
			190 => 'a',
			191 => 'bird',
			192 => 'on',
			193 => 'it',
			194 => 'lumbersexual',
			195 => 'locavore',
			196 => 'glutenfree',
			197 => 'squid',
			198 => 'brunch',
			199 => 'tote',
			200 => 'bag',
			201 => 'xoxo',
			202 => 'sustainable',
			203 => 'echo',
			204 => 'park',
			205 => 'pinterest',
			206 => 'cronut',
			207 => 'gastropub',
			208 => 'fap',
			209 => 'vhs',
			210 => 'tattooed',
			211 => 'pork',
			212 => 'belly',
			213 => 'fashion',
			214 => 'axe',
			215 => 'before',
			216 => 'they',
			217 => 'sold',
			218 => 'out',
			219 => 'normcore',
			220 => 'echo',
			221 => 'park',
			222 => 'ennui',
			223 => 'mustache',
			224 => 'cardigan',
			225 => 'kale',
			226 => 'chips',
			227 => 'plaid',
			228 => 'pickled',
			229 => 'wolf',
			230 => 'hoodie',
			231 => 'selfies',
			232 => 'whatever',
			233 => 'farmtotable',
			234 => 'lomo',
			235 => 'drinking',
			236 => 'vinegar',
			237 => 'tousled',
			238 => 'pourover',
			239 => 'seitan',
			240 => 'diy',
			241 => 'selfies',
			242 => 'xoxo',
			243 => 'shabby',
			244 => 'chic',
			245 => 'food',
			246 => 'truck',
			247 => 'ugh',
			248 => 'taxidermy',
			249 => 'meggings',
			250 => 'american',
			251 => 'apparel',
			252 => 'lomo',
			253 => 'heirloom',
			254 => 'farmtotable',
			255 => 'photo',
			256 => 'booth',
			257 => 'selvage',
			258 => 'cliche',
			259 => 'leggings',
			260 => 'freegan',
			261 => 'taxidermy',
			262 => 'vice',
			263 => 'popup',
			264 => 'meggings',
			265 => 'direct',
			266 => 'tradevegan',
			267 => 'popup',
			268 => 'marfa',
			269 => 'portland',
			270 => 'organic',
			271 => 'wayfarers',
			272 => 'gastropub',
			273 => 'direct',
			274 => 'trade',
			275 => 'xoxo',
			276 => 'artisan',
			277 => 'cred',
			278 => 'tumblr',
			279 => 'whatever',
			280 => 'artisan',
			281 => 'biodiesel',
			282 => 'farmtotable',
			283 => 'churchkey',
			284 => 'kickstarter',
			285 => 'cred',
			286 => 'selvage',
			287 => 'normcore',
			288 => 'helvetica',
			289 => 'cornhole',
			290 => 'heirloom',
			291 => 'pitchfork',
			292 => 'taxidermy',
			293 => 'vice',
			294 => 'flexitarian',
			295 => 'slowcarb',
			296 => 'kale',
			297 => 'chips',
			298 => 'singleorigin',
			299 => 'coffee',
			300 => 'wes',
			301 => 'anderson',
			302 => 'next',
			303 => 'level',
			304 => 'scenester',
			305 => 'vinyl',
			306 => 'craft',
			307 => 'beer',
			308 => 'schlitz',
			309 => 'jean',
			310 => 'shorts',
			311 => 'aesthetic',
			312 => 'twee',
			313 => 'meditation',
			314 => 'austin',
			315 => 'swag',
			316 => 'bitters',
			317 => 'disrupt',
			318 => 'plaid',
			319 => 'brooklyn',
			320 => 'jean',
			321 => 'shorts',
			322 => 'ethical',
			323 => 'messenger',
			324 => 'bag',
			325 => 'vhs',
			326 => 'aesthetic',
			327 => 'brunch',
			328 => 'kickstarter',
			329 => 'kogi',
			330 => 'hashtag',
			331 => 'oh',
			332 => 'you',
			333 => 'need',
			334 => 'a',
			335 => 'little',
			336 => 'dummy',
			337 => 'text',
			338 => 'for',
			339 => 'your',
			340 => 'mockup',
			341 => 'how',
			342 => 'quaint',
			343 => 'i',
			344 => 'bet',
			345 => 'youre',
			346 => 'still',
			347 => 'using',
			348 => 'bootstrap',
			349 => 'too',
			350 => 'options',
			351 => 'paragraphs',
			352 => 'type',
			353 => 'hipster',
			354 => 'neathipster',
			355 => 'with',
			356 => 'a',
			357 => 'shot',
			358 => 'of',
			359 => 'latin',
			360 => 'pbr',
			361 => 'money',
			362 => 'visit',
			363 => 'the',
			364 => 'lab',
			365 => 'bunny',
			366 => '',
			367 => 'one',
			368 => 'time',
			369 => 'beauty',
			370 => 'school',
			371 => 'suspendee',
			372 => 'two',
			373 => 'time',
			374 => 'college',
			375 => 'dropout',
			376 => 'full',
			377 => 'time',
			378 => 'lipstick',
			379 => 'hoarder',
			380 => 'libra',
			381 => 'nonsmoker',
			382 => 'dtf',
			383 => 'consumeposters',
			384 => 'and',
			385 => 'totes',
			386 => 'now',
			387 => 'available',
			388 => 'for',
			389 => 'your',
			390 => 'boring',
			391 => 'cubicle',
			392 => 'walls',
			393 => '',
			394 => 'farmers',
			395 => 'market',
			396 => 'purchases',
			397 => 'credits',
			398 => 'jason',
			399 => 'cosper',
			400 => 'made',
			401 => 'this',
			402 => 'but',
			403 => 'he',
			404 => 'was',
			405 => 'more',
			406 => 'into',
			407 => 'it',
			408 => 'before',
			409 => 'it',
			410 => 'sold',
			411 => 'out',
			412 => 'participate',
			413 => 'want',
			414 => 'to',
			415 => 'build',
			416 => 'an',
			417 => 'app',
			418 => 'that',
			419 => 'uses',
			420 => 'hipster',
			421 => 'ipsum',
			422 => 'theres',
			423 => 'an',
			424 => 'api',
			425 => 'for',
			426 => 'that',
			427 => 'make',
			428 => 'something',
			429 => 'cool',
			430 => 'using',
			431 => 'hipster',
			432 => 'ipsum',
			433 => 'tell',
			434 => 'us',
			435 => 'about',
			436 => 'it',
			437 => 'or',
			438 => 'dont',
			439 => 'whatever',
			440 => 'crass',
			441 => 'commercialism',
			442 => 'like',
			443 => 'what',
			444 => 'were',
			445 => 'doing',
			446 => 'consider',
			447 => 'using',
			448 => 'our',
			449 => 'referral',
			450 => 'links',
			451 => 'for',
			452 => 'these',
			453 => 'sites',
			454 => 'amazon',
			455 => 'backblaze',
			456 => 'jackthreads',
			457 => 'grand',
			458 => 'st',
			459 => 'gilt',
			460 => 'fab',
			461 => 'copyleft',
			462 => '2015',
			463 => 'a',
			464 => 'stranger',
			465 => 'in',
			466 => 'the',
			467 => 'alps',
			468 => 'theme',
			469 => 'by',
			470 => 'anders',
			471 => 'noren',
			472 => '',
			473 => 'up',
			474 => '',
			475 => '',
		));
	}
}