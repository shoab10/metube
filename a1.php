<html>
<body>
<div id="star"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="lib/jquery.raty.js"></script>
<script type="text/javascript">
$('#star').raty();
$('#star').raty({
  click: function(score, evt) {
    alert('ID: ' + $(this).attr('id') + "\nscore: " + score + "\nevent: " + evt);
  }
});

</script>
</body>