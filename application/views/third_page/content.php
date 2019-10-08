<div class="detail_container">
  <div class="left_nav" >
    <div class="page_content_word"><strong>PAGE CONTENT</strong></div>
    <div class="page_content_nav"><a href="#summary" class="page_content_nav_a">Summary</a></div>
    <div class="page_content_nav"><a href="#threads" class="page_content_nav_a">Discussion Threads</a></div>
    <div class="page_content_nav"><a href="#recent" class="page_content_nav_a">Recent comments</a></div>
    <?php foreach ($threads as $thread){?>
    <div class="page_content_nav">
      <a href="#<?php echo $thread['thread'];?>" class="page_content_nav_a">
        <?php echo ucfirst($thread['thread']);?> comments
      </a>
    </div>
    <?php }?>
  </div>
  <div class="right_content">
    <div class="summary" id="summary">
      <div class="detail_title">Summary</div>
      <div class="consultation_hr"></div>
      <div class="summary_content">
        <div class="summary_detail">
          <?php echo $summary;?>
        </div>
        <div class="summary sentiment_btns">
          <div class="support_btn_picture">
            <?php if($sentiment['sentiment']=="pos"){?>
              <i class="far fa-thumbs-up"></i>
            <?php } elseif ($sentiment['sentiment']=="neg"){?>
              <i class="far fa-thumbs-down"></i>
            <?php }?>
          </div>
          <div class="summary support_rate_score">
            <?php echo $sentiment['support_rate'];?>
          </div>
        </div>
      </div>
    </div>
    <div class="threads" id="threads">
      <div class="detail_title">Discussion Threads</div>
      <div class="consultation_hr"></div>
      <div class="detail_content">
        <?php foreach ($threads as $thread){?>
          <button class="thread_btn" onclick="comment_type(<?php echo $consultation_id;?>,'<?php echo $thread['thread']?>')">
            <?php echo ucfirst($thread['thread']);?>
          </button>
        <?php }?>
      </div>
    </div>
    <div class="public_comments" id="recent">
      <div class="public_title">
        <div class="public_title_word">Recent Comments</div>
        <div class="expand_word">
          <a href=#### class="expand_word_a" id="recent_expand"">Expand</a>
        </div>
      </div>
      <div class="public_hr"></div>
      <div class="comment_list">
        <div class="comment_item">
          <?php foreach ($recent_comments as $recent){?>
          <div id="<?php echo $recent['comment_id'];?>">
            <div class="user_time_thread">
              <i class="user_time_thread_right">@<?php echo $recent['user'];?> commented on <?php echo $recent['date_time'];?> in </i>
              <button class="thread_in_item" onclick="comment_type(<?php echo $consultation_id;?>,'<?php echo $recent['thread']?>')">
                <?php echo $recent['thread'];?>
              </button>
              <?php if ($replies['recent'][$recent['comment_id']]['num'][0]['num']>0){?>
                <a href=#### class="expand_reply_word_a">
                  <?php echo $replies['recent'][$recent['comment_id']]['num'][0]['num'];?> relpies
                </a>
              <?php } else{?>
                <a href=#### class="expand_reply_word_a"></a>
              <?php }?>
            </div>
            <div class="comment_detail">
              <div class="comment_content">
                <?php echo $recent['text'];?>
              </div>
              <div class="comment_reply_list">
                <?php foreach ($replies['recent'][$recent['comment_id']]['replies'] as $reply){?>
                <div id="<?php echo $reply['comment_id'];?>" class="comment_reply_list_detail">
                  <div class="user_time_thread">
                    <i class="user_time_thread_right">
                      @<?php echo $reply['user'];?> replied on <?php echo $reply['date_time'];?>
                    </i>
                  </div>
                  <div class="comment_detail">
                    <?php echo $reply['text'];?>
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
    <?php foreach ($threads as $thread){?>
      <div class="public_comments" id="<?php echo $thread['thread'];?>">
        <div class="public_title">
          <div class="public_title_word">
            <?php echo ucfirst($thread['thread']);?> Comments
            (<?php echo count($comments[$thread['thread']]);?> of <?php echo $num[$thread['thread']][0]['num'];?>)
          </div>
          <div class="expand_word">
            <a href=#### class="expand_word_a" id="<?php echo $thread['thread'];?>">Expand</a>
          </div>
        </div>
        <div class="public_hr"></div>
        <div class="comment_list">
          <div class="comment_item">
            <?php foreach ($comments[$thread['thread']] as $list){?>
            <div id="<?php echo $list['comment_id'];?>">
              <div class="user_time_thread">
                <i class="user_time_thread_right">
                  @<?php echo $list['user'];?> commented on <?php echo $list['date_time'];?> in
                </i>
                <?php if ($replies[$thread['thread']][$list['comment_id']]['num'][0]['num']>0){?>
                <a href=#### class="expand_reply_word_a">
                  <?php echo $replies[$thread['thread']][$list['comment_id']]['num'][0]['num'];?> relpies
                </a>
                <?php } else{?>
                <a href=#### class="expand_reply_word_a"></a>
                <?php }?>
              </div>
              <div class="comment_detail">
                <div class="comment_content">
                  <?php echo $list['text'];?>
                </div>
                <div class="comment_reply_list">
                  <?php foreach ($replies[$thread['thread']][$list['comment_id']]['replies'] as $reply){?>
                    <div id="<?php echo $reply['comment_id'];?>" class="comment_reply_list_detail">
                      <div class="user_time_thread">
                        <i class="user_time_thread_right">
                          @<?php echo $reply['user'];?> replied on <?php echo $reply['date_time'];?>
                        </i>
                      </div>
                      <div class="comment_detail">
                        <?php echo $reply['text'];?>
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
    <?php }?>
  </div>
</div>
