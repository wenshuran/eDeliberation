<div class="detail_container">
  <div class="left_nav" >
    <div class="page_content_word"><strong>PAGE CONTENT</strong></div>
    <div class="page_content_nav"><a href="#about" class="page_content_nav_a">About this consultation</a></div>
    <div class="page_content_nav"><a href="#summary" class="page_content_nav_a">Summary</a></div>
    <div class="page_content_nav"><a href="#links" class="page_content_nav_a">Links</a></div>
    <div class="page_content_nav"><a href="#target" class="page_content_nav_a">Target audience</a></div>
    <div class="page_content_nav"><a href="#reasons" class="page_content_nav_a">Reasons</a></div>
    <div class="page_content_nav"><a href="#contact" class="page_content_nav_a">Contact</a></div>
    <div class="page_content_nav"><a href="#public_consultation" class="page_content_nav_a">Public Consultation</a></div>
    <div></div>
  </div>
  <div class="right_content">
    <div class="aboout" id="about">
      <div class="detail_title">About this consultation</div>
      <div class="consultation_hr"></div>
      <div class="about_period">
        <strong class="about_period_word">Consultation period</strong>
        <?php echo $open_date.' to '.$close_date?>
      </div>
      <div class="about_topic">
        <strong class="about_topic_word">Topic</strong>
        <?php echo $topic?>
      </div>
<!--      <div class="about_department">-->
<!--        <strong class="about_department_word">Departments</strong>-->
<!--        <a href="">--><?php //echo $department?><!--</a>-->
<!--      </div>-->
    </div>
    <div class="summary" id="summary">
      <div class="detail_title">Summary</div>
      <div class="consultation_hr"></div>
      <div class="detail_content">
        <?php echo $summary?>
      </div>
    </div>
    <div class="links" id="links">
      <div class="detail_title">Links</div>
      <div class="consultation_hr"></div>
      <div class="links_content">
        <?php foreach ($links as $link){?>
        <div><a href="<?php echo $link['link'];?>"><?php echo $link['link'];?></a><br></div>
        <?php } ?>
      </div>
    </div>
    <div class="target_audience" id="target">
      <div class="detail_title">Target audience</div>
      <div class="consultation_hr"></div>
      <div class="detail_content"><?php echo $target?></div>
    </div>
    <div class="reasons" id="reasons">
      <div class="detail_title">Reasons</div>
      <div class="consultation_hr"></div>
      <div class="detail_content"><?php echo $reason?></div>
    </div>
    <div class="contact" id="contact">
      <div class="detail_title">Contact</div>
      <div class="consultation_hr"></div>
<!--      <div class="service">Responsible service: --><?php //echo $service?><!--</div>-->
      <div class="address">
        <div class="address_word">Postal address</div>
        <div class="address_detail"><?php echo $address?></div>
      </div>
      <div  class="email">
        <div class="email_word">Email</div>
        <div class="email_detail"><?php echo $email?></div>
      </div>
    </div>
    <div class="public_consultation" id="consultation">
      <div class="detail_title">Public Consultation</div>
      <div class="consultation_hr"></div>
      <div class="public_consultation_btn">
        <button class="public_consultation_btn">Go To Public Consultation</button>
      </div>
  </div>
</div>
