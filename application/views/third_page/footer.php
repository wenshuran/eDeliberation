<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/edeliberation/application/third_party/jquery-3.4.1.min.js"><\/script>')</script>
<script>
    $(document).ready(function(){
        $(".expand_word_a").parent().parent().next().next().find("div:first").find("div:first").nextAll().toggle();
    });
    $(document).ready(function(){
        $(".expand_reply_word_a").parent().next().find("div:first").next().toggle();
    });
    $(".expand_word_a").click(function(){
        $(this).parent().parent().next().next().find("div:first").find("div:first").nextAll().toggle();
        if($(this).html()=="Hide")
            $(this).html("Expand");
        else
            $(this).html("Hide");
    });
    $(".expand_reply_word_a").click(function(){
        $(this).parent().next().find("div:first").next().toggle();
        if($(this).html()=="Hide"){
            $(this).parent().parent().removeClass("comment_reply_detail");
            $(this).parent().parent().addClass("simple_comment");
            $(this).html("Expand");
        }
        else{
            $(this).parent().parent().removeClass("simple_comment");
            $(this).parent().parent().addClass("comment_reply_detail");
            $(this).html("Hide");
        }
    });
    function comment_type(c_id, thread){
        window.open('./index.php?c=consultation_comment&m=index&c_id='+c_id+'&thread='+thread);
    }
</script>
</body>
</html
