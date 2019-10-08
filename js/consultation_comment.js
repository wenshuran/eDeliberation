$(document).ready(function(){
  //$(".expand_word_a").parent().parent().parent().next().next().find("div:first").next().find("div:first").nextAll().toggle(); //hide from 2
  $(".expand_word_a").parent().parent().parent().next().next().find("div:first").next().find("div:first").next().nextAll().toggle(); //hide from 3
});
$(document).ready(function(){
  $(".expand_reply_word_a").parent().next().find("div:first").next().toggle();
  $(".expand_reply_word_a").next().toggle();
  $(".expand_reply_word_a_first").parent().next().find("div:first").next().toggle();
  $(".expand_reply_word_a_first").next().toggle();
});
$(document).ready(function(){
  $(".add_comment_div").toggle();
});
$(document).ready(function(){
  $(".add_reply_div").toggle();
});
$(".comment_reply_list_detail").hover(function(){
    $parent_id = '#'+$(this).attr("data-parent-id");
    $($parent_id).addClass("highlight");
  }, function(){
    $parent_id = '#'+$(this).attr("data-parent-id");
    $($parent_id).removeClass("highlight");
  }
);
$(".expand_word_a").click(function(){
  $(this).parent().parent().parent().next().next().find("div:first").next().find("div:first").next().nextAll().toggle(); //hide from 3
  //$(this).parent().parent().parent().next().next().find("div:first").next().find("div:first").nextAll().toggle(); //hide from 2
  if($(this).html()=="Hide"){
    $(this).html("Expand");
  }
  else{
    $(this).html("Hide");
  }
});
$(".expand_reply_word_a").click(function(){
  $(this).parent().next().find("div:first").next().toggle();
  if($(this).html()=="Hide"){
    $(this).parent().parent().removeClass("comment_reply_detail");
    $(this).parent().parent().addClass("simple_comment");
    $(this).html("Expand");
    $(this).next().toggle();
  }
  else{
    $(this).parent().parent().removeClass("simple_comment");
    $(this).parent().parent().addClass("comment_reply_detail");
    $(this).html("Hide");
    $(this).next().toggle();
  }
});
$(".expand_reply_word_a_first").click(function(){
  $(this).parent().next().find("div:first").next().toggle();
  if($(this).html()=="Hide"){
    $(this).parent().parent().removeClass("comment_reply_detail");
    $(this).parent().parent().addClass("simple_comment");
    $(this).html("Expand");
    $(this).next().toggle();
  }
  else{
    $(this).parent().parent().removeClass("simple_comment");
    $(this).parent().parent().addClass("comment_reply_detail");
    $(this).html("Hide");
    $(this).next().toggle();
  }
});
$(".add_comment_btn").click(function(){
  if($(this).parent().parent().parent().next().next().find("div:first").is(':hidden')){
    $(this).parent().parent().parent().next().next().find("div:first").find("div:first").next().children().val("");
  }
  $(this).parent().parent().parent().next().next().find("div:first").toggle();
});
$(".give_reply_word_a").click(function(){
  if($(this).parent().next().find("div:first").next().find("div:first").is(':hidden')){
    $(this).parent().next().find("div:first").next().find("div:first").find("textarea").val("");
  }
  $(this).parent().next().find("div:first").next().find("div:first").toggle();
});
$(".give_reply_word_a_first").click(function(){
  if($(this).parent().next().find("div:first").next().find("div:first").is(':hidden')){
    $(this).parent().next().find("div:first").next().find("div:first").find("textarea").val("");
  }
  $(this).parent().next().find("div:first").next().find("div:first").toggle();
});
$(".add_comment_cancel").click(function(){
  $(this).parent().parent().val("");
  $(this).parent().parent().toggle();
});
$(".add_reply_cancel").click(function(){
  //$(this).parent().parent().val("");
  $(this).parent().parent().toggle();
});
$(".add_reply_cancel_second").click(function(){
  $(this).parent().parent().parent().parent().parent().find(".give_reply_word_a_first").click();
});
$(function(){
  $("#submit_comment").click(function(e){
    var comment = $("#comment_text").val();
    <?php if($isLogin==false){?>
  var name = $("#comment_name").val();
            <?php }?>
            if(comment!=''){
                $.ajax({
                    data:{comment:comment,
                      <?php if($isLogin==false){?>
                          name:name,
                      <?php }?>
                          thread_id: <?php echo $thread_id;?>,
                          c_id: <?php echo $c_id;?>
                    },
                    type:"POST",
                    url:"./index.php?c=consultation_comment&m=add_comment",
                    error:function(msg){
                        alert('ajax fail!'+msg);
                    },
                    success:function(msg){
                        alert("ajax success!"+msg);
    //(".comment_detail_list").reload(location.href+" #.comment_detail_list");
  location.reload();
  $(".expand_word_a").click();
                    }
                });
            }else{
                alert("no comment!");
  }
  return false;
  });
  });
  $(function(){
  $(".add_reply_submit").click(function(e){
            var comment = ($(this)).parent().parent().find("#reply_text").val();
            var comment_id = $(this).parent().parent().parent().parent().parent().attr("id");
          <?php if($isLogin==false){?>
            var name = $(this).parent().parent().find("#comment_name").val();
          <?php }?>

            if(comment!=''){
                $.ajax({
                    data:{comment:comment,parent_id:comment_id,
                      <?php if($isLogin==false){?>
                        name:name,
                      <?php }?>
                        thread_id: <?php echo $thread_id;?>,
                        c_id: <?php echo $c_id;?>},
                    type:"POST",
                    url:"./index.php?c=consultation_comment&m=add_reply",
                    error:function(msg){
                        alert('ajax fail!');
                    },
                    success:function(msg){
                        alert("ajax success!"+msg);
    // location.reload();
  }
  });
  }else{
    alert("no comment!");
  }
  return false;
  });
  });
//$(function(){
//    $(".add_reply_submit_second").click(function(e){
//        var comment = ($(this)).parent().parent().find("#reply_text").val();
//        var comment_id = $(this).parent().parent().parent().parent().parent().attr("id");
//        if(comment!=''){
//            $.ajax({
//                data:{comment:comment,parent_id:comment_id,
//                    thread_id: <?php //echo $thread_id;?>//,
//                    c_id: <?php //echo $c_id;?>//},
//                type:"POST",
//                url:"./index.php?c=consultation_comment&m=add_reply",
//                error:function(msg){
//                    alert('ajax fail!');
//                },
//                success:function(msg){
//                    alert("ajax success!"+msg);
//                    location.reload();
//                }
//            });
//        }else{
//            alert("no comment!");
//        }
//        return false;
//    });
//});
