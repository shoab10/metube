<?php
session_start();
include_once "function.php";
include_once "sql.php";
 ?>
<html>
<head>
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jqCloud.js"> </script>
<link rel="stylesheet" type="text/css" href="css/jqCloud.css"/>

<?php
    $kterms = array();
    $fterms = array();
    $words = array();
    $weights = array();
    $max = 0;
    $i=0;

    $query = mysql_query("SELECT DISTINCT (`keyword`), `counter` FROM  `keywords` ORDER BY counter DESC LIMIT 50");

    while ($result_row = mysql_fetch_assoc($query))
    {
      $term = $result_row['keyword'];
      $counter = $result_row['counter'];
      if ($counter > $max) 
        {
          $max = $counter;
        }

      $kterms[] = array('term' => $term, 'counter' => $counter);

    }

    shuffle($kterms);
     foreach ($kterms as $value):
    $percent = floor(($value['counter'] / $max) * 100);


  if ($percent < 20):
    $word[$i]= $value['term']; $weight[$i]= 4;
    elseif ($percent >= 20 and $percent < 40):
    $word[$i]= $value['term']; $weight[$i]= 6;
    elseif ($percent >= 40 and $percent < 60):
    $word[$i]= $value['term']; $weight[$i]= 10;
    elseif ($percent >= 60 and $percent < 80):
    $word[$i]= $value['term']; $weight[$i]= 13;
    else:
    $word[$i]= $value['term']; $weight[$i]= 15;
    endif;
   $i++;
 endforeach;
 $cars= array("haseeb", "shoab"); 
    ?>
<script type="text/javascript"> var word_list = [

     <?php $k =0; ?>
   {text: <?php echo "'". $word[$k]."'"; ?>, weight: <?php echo "'". $weight[$k]."'"; ?>,
    link: <?php echo "'" . "searchmedia.php?method=get&search=$word[$k]"."'";?>}, <?php $k++; ?>
  {text: <?php echo "'". $word[$k]."'"; ?>, weight: <?php echo "'". $weight[$k]."'"; ?>,
    link: <?php echo "'" . "searchmedia.php?method=get&search=$word[$k]"."'";?>}, <?php $k++; ?>
    {text: <?php echo "'". $word[$k]."'"; ?>, weight: <?php echo "'". $weight[$k]."'"; ?>,
    link: <?php echo "'" . "searchmedia.php?method=get&search=$word[$k]"."'";?>}, <?php $k++; ?>
    {text: <?php echo "'". $word[$k]."'"; ?>, weight: <?php echo "'". $weight[$k]."'"; ?>,
    link: <?php echo "'" . "searchmedia.php?method=get&search=$word[$k]"."'";?>}, <?php $k++; ?>

 
   // ...other words
];
$(document).ready(function() {
   $("#wordcloud").jQCloud(word_list);
});

</script>
</head>
<body>
    <h1>jQCloud Example</h1>
    <div id="wordcloud" style="width: 200px; height: 300px; position: relative;"></div>
 

</body>
</html>

