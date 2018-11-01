<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$(document).ready(
  function(){
    $("#controller").click(
      function(){
        $("#panel").toggle("slow");
      }
    );
    $("#toggler").click(
      function(){
        $("#slider").toggle("slow");
      }
    );
  }
);

</script>
