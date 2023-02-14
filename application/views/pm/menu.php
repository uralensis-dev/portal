<?php $this->load->helper('url'); ?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav priv-msg-nav">
      <li class="<?php echo empty($this->uri->segment(2)) ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm" ?>">Inbox<span class="tg-notificationtag"><?php echo getPrivateMessageCount('inbox'); ?></span></a></li>
      <li class="<?php echo $this->uri->segment(3) == 3 ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm/messages/" . MSG_UNREAD ?>">Unread<span class="tg-notificationtag"><?php echo getPrivateMessageCount('unread'); ?></span></a></li>
      <li class="<?php echo $this->uri->segment(3) == 2 ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm/messages/" . MSG_SENT ?>">Sent<span class="tg-notificationtag"><?php echo getPrivateMessageCount('sent'); ?></span></a></li>
      <li class="<?php echo $this->uri->segment(3) == 1 ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm/messages/" . MSG_DELETED ?>">Trashed<span class="tg-notificationtag"><?php echo getPrivateMessageCount('deleted'); ?></span></a></li>
      <li class="<?php echo $this->uri->segment(2) == 'send' ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm/send" ?>">Compose</a></li>
     <?php
     
     if($this->ion_auth->is_admin()){
       ?>
       <li class="<?php echo $this->uri->segment(2) == 'massmail' ? 'active' : ''; ?>"><a href="<?php echo site_url() . "/pm/massmail" ?>">Announcement</a></li>
       <?php 
     }
     ?> 
    </ul>
  </div>
</nav>
<br />