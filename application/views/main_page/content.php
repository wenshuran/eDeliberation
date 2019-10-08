<div id="container">
  <div id="content">
    <div class="consultation_num">Consultations(<?php echo $result_num?>)</div>
    <div><br><br><hr class="consultation_hr"></div>
    <div class="show_result_id">Showing result <?php echo $page_id_min.' to '.$page_id_max?></div>
    <div id="consultation_list">
    <?php if ($result_num > 0) {
      for($id=$page_id_min; $id<=$page_id_max; $id++){?>
        <div id = <?php echo $id?>>
        <div class="consultation_status">CONSULTATION STATUS: <?php echo $this->data[$id]['status']?></div>
        <div class="consultation_title"><a href="./index.php?c=consultation_detail&m=index&c_id=<?php echo $id?>" class="consultation_title" target="_blank"><?php echo $this->data[$id]['title']?></a></div>
        <div class="topic">
          <div class="topic_word">Topic</div>
          <div class="topic_content"><?php echo $this->data[$id]['topic']?></div>
        </div>
        <div class="period">
          <div class="period_word">Consultation period</div>
          <div class="period_content"><?php echo $this->data[$id]['open_date'].' to '. $this->data[$id]['close_date']?></div>
        </div>
        <?php if ($id<$result_num and $id!=$list_max_num){?>
          <div><br><hr></div>
        <?php }
        if ($result_num>$list_max_num and $id%$list_max_num==0){?>
          <div id="footer">
          <div><hr class="consultation_hr" "></div>
          <div class="footer_nav">
          <?php echo $page_nav?>
          </div>
        </div>
        <?php }
        else if ($id == $result_num){?>
        <div id="footer">
        <div><hr class="consultation_hr"></div>
        <div style="text-align: center; letter-spacing:10px;">
          <strong>$current_page_pos</strong>
        </div>
        </div>
      <?php } ?>
      </div>
    <?php }
    } else { ?>
      <div> $result_num</div>
    <?php } ?>
  </div>
</div>
