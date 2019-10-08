<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/edeliberation/application/third_party/jquery-3.4.1.min.js"><\/script>')</script>
<script>
  $(document).ready(function () {
      $(".public_consultation").find(".login").toggle();
  });
  $(".public_consultation_btn").click(function () {
      window.open('./index.php?c=public_consultation&m=index&c_id=<?php echo $c_id?>');
  });
  </script>
</body>
</html>
