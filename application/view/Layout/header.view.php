 <?php

use \Glial\I18n\I18n;

echo "<!DOCTYPE html>\n";
echo "<html lang=\"" . I18n::Get() . "\">";
echo "<head>\n";
echo "<meta charset=utf-8 />\n";
echo "<meta name=\"Keywords\" content=\"\" />\n";
echo "<meta name=\"Description\" content=\"\" />\n";
echo "<meta name=\"Author\" content=\"Aurelien LEQUOY\" />\n";
echo "<meta name=\"robots\" content=\"index,follow,all\" />\n";
echo "<meta name=\"generator\" content=\"GLIALE 1.1\" />\n";
echo "<meta name=\"runtime\" content=\"[PAGE_GENERATION]\" />\n";
echo "<link rel=\"shortcut icon\" href=\"favicon.ico\" />";
echo "<title>" . $GLIALE_TITLE . " - Glial 2.1.2</title>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . CSS . "default.style.css\" />\n";

?>

 </head>
 <body>

<div id="all">
<header>
<div id="headline"><?= date("l d F Y - H:i:s") ?> CET</div>
<div id="banner"></div>
<menu></menu>
</header>
<div id="main">
