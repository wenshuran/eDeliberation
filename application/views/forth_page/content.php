<div class="detail_container">
  <div class="left_nav" >
    <div class="page_content_word"><strong>PAGE CONTENT</strong></div>
    <div class="page_content_nav"><a href="#summary" class="page_content_nav_a">Summary</a></div>
    <div class="page_content_nav">
      <a href="#<?php echo $thread;?>" class="page_content_nav_a">
        <?php echo ucfirst($thread);?> Comments
      </a>
    </div>
  </div>
  <div class="right_comment_content">
    <div class="summary" id="summary">
      <div class="detail_title">Summary</div>
      <div class="consultation_hr"></div>
      <div class="summary_content">
        <div class="summary_detail"><?php echo $summary;?></div>
<!--        <div class="summary sentiment_btns">-->
<!--          <div class="support_btn_picture">-->
<!--            <i class="far fa-thumbs-up"></i>-->
<!--                          <i class="far fa-thumbs-down"></i>-->
<!--          </div>-->
<!--          <div class="summary support_rate_score">-->
<!--            100%-->
<!--                        --><?php //echo $support_rate;?>
<!--          </div>-->
<!--        </div>-->
      </div>
    </div>
    <div class="public_comments" id="<?php echo $thread;?>">
      <div class="public_title">
        <div class="comment_title_word">
          <?php echo ucfirst($thread);?> Comments(<?php echo $num[0]['num'];?>)
        </div>
        <div class="comment_title_right">
<!--          <div class="expand_comment_word">-->
<!--            <a href=#### class="expand_word_a" id="--><?php //echo $thread;?><!--">Expand</a>-->
<!--          </div>-->
          <div class="add_comment">
            <button class="add_comment_btn" onclick="">Comment</button>
          </div>
        </div>
      </div>
      <div class="add_comment_hr"></div>
      <div class="comment_detail_list">
        <div class="add_comment_div">
          <?php if ($isLogin==false){?>
            <div class="add_comment_name">
              <div class="name_word">Your name:</div>
              <div class="name_text"><textarea id="comment_name" cols="66%" placeholder="Your name here" required></textarea></div>
            </div>
          <?php }?>
          <div class="add_comment_word">Your comment:</div>
          <div class="add_comment_text">
            <textarea id="comment_text" cols="66%" rows="8%" placeholder="Your comment here" required></textarea>
          </div>
          <div class="add_comment_btns">
            <a href=#### class="add_comment_cancel">Cancel</a>
            <button id="submit_comment" class="add_comment_submit">Add Comment</button>
          </div>
        </div>
        <div class="comment_item">
          <?php foreach ($comments as $list){?>
          <div id="<?php echo $list['comment_id'];?>" class="simple_comment">
            <div class="user_time_thread">
              <i class="user_time_thread_right">
                @<?php echo $list['user'];?> commented on <?php echo $list['date_time'];?>
              </i>
              <a href=#### class="expand_reply_word_a">
                <?php echo $replies[$list['comment_id']]['num'][0]['num'];?> relpies
              </a>
              <a href=#### class="give_reply_word_a">Reply</a>
            </div>
            <div class="comment_detail">
              <div class="comment_content">
                <?php echo $list['text'];?>
              </div>
              <div class="comment_reply_list">
                <div class="add_reply_div">
                  <?php if ($isLogin==false){?>
                  <div class="add_comment_name">
                    <div class="name_word">Your name:</div>
                    <div class="name_text"><textarea id="comment_name" cols="60%" placeholder="Your name here" required></textarea></div>
                  </div>
                  <?php }?>
                  <div class="add_comment_word">Your comment:</div>
                  <div class="add_comment_text">
                    <textarea id="reply_text" cols="60%" rows="8%" placeholder="Your comment here" required></textarea>
                  </div>
                  <div class="add_reply_btns">
                    <a href=#### class="add_reply_cancel">Cancel</a>
                    <button id="submit_reply" class="add_reply_submit">Add Comment</button>
                  </div>
                </div>
                <?php foreach ($replies[$list['comment_id']]['replies'] as $reply){?>
                <div id="<?php echo $reply['comment_id'];?>" class="comment_reply_list_detail"
                     data-parent-id="<?php echo $reply_parents[$reply['comment_id']][0]['comment_id'];?>">
                  <div class="user_time_thread">
                    <i class="user_time_thread_right">
                      @<?php echo $reply['user'];?> replied to @<?php echo $reply_parents[$reply['comment_id']][0]['user'];?>
<!--                      --><?php //echo $reply['parents'];?>
                      on <?php echo $reply['date_time'];?>
                    </i>
                    <a href=#### class="give_reply_word_a_first">Reply</a>
                  </div>
                  <div class="comment_detail">
                    <div class="comment_content">
                      <?php echo $reply['text'];?>
                    </div>
                    <div class="comment_reply_list">
                      <div class="add_reply_div">
                        <?php if ($isLogin==false){?>
                        <div class="add_comment_name">
                          <div class="name_word">Your name:</div>
                          <div class="name_text"><textarea id="comment_name" cols="54%" placeholder="Your name here" required></textarea></div>
                        </div>
                        <?php }?>
                        <div class="add_comment_word">Your comment:</div>
                        <div class="add_comment_text">
                          <textarea id="reply_text" cols="54%" rows="8%" placeholder="Your comment here" required></textarea>
                        </div>
                        <div class="add_reply_btns">
                          <a href=#### class="add_reply_cancel_second">Cancel</a>
                          <button id="submit_reply" class="add_reply_submit_second">Add Comment</button>
                        </div>
                      </div>
<!--                      --><?php //foreach ($replies[$reply['comment_id']]['replies'] as $reply_second){?>
<!--                        <div id="--><?php //echo $reply_second['comment_id'];?><!--" class="comment_reply_list_detail" style="background-color: aliceblue">-->
<!--                          <div class="user_time_thread">-->
<!--                            <i class="user_time_thread_right">-->
<!--                              @--><?php //echo $reply_second['user'];?><!-- replied on --><?php //echo $reply_second['date_time'];?>
<!--                            </i>-->
<!--                          </div>-->
<!--                          <div class="comment_detail">-->
<!--                            <div class="comment_content">-->
<!--                              --><?php //echo $reply_second['text'];?>
<!--                            </div>-->
<!--                          </div>-->
<!--                        </div>-->
<!--                      --><?php //}?>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
              <div class="comment_hr"><hr class="comment_hr"></div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>
    </div>
  </div>
</div>
