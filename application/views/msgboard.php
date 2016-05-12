<div id="content" class="content-nb">
        <div id="container">
    	<div class="content-left leave-message">
                        <!-- <form id="leave-msg" > -->
                        <?php echo form_open("msgboard/insert",array('id'=>'leave-msg')); ?>
            	           <p>嘿，朋友！<br />今天的天气好吗？<br />今天的世界好吗？<br />留下你此刻的想法吧...</p>
            	           <textarea id="msg_comment" name="msg_comment" rows="5" ></textarea><br />
                         <input type="submit" value="发布" id="msg-submit" class="msg_verify" />
                         </form>
              </div>
              <div class="content-right">
                    <?php if (!empty($mood)): ?>
                            <?php foreach ($mood as $key => $value): ?>
                                    <div class="msg">
                                            <p class="msg-username"><strong><?php echo $value['username']; ?></strong></p>
                                            <p class="msg-content"><?php echo $value['content']; ?></p>
                                            <a href="" id="like" class="like" name="<?php echo $value['type']; ?>">赞(<span id="favour_number"><?php echo $value['favour']; ?></span>)</a>
                                            <input type="hidden" class="mood_id" value="<?php echo $value['id'] ?>">
                                            <a href="" class="reply">回复</a><br/>
                                            <div id='reply-input'>
                                                    <?php echo form_open('msgboard/reply') ?>
                                                            <textarea name="text"  rows="2"></textarea>
                                                            <input type="submit" value="OK" id="reply-submit" class="reply-submit" >
                                                            <input type="hidden" id="parent_id" name="parent_id"  value="<?php echo $value['id']; ?>" >
                                                    </form>
                                            </div>
                                            <div id="existed-reply">
                                                        <?php descendant_show($value['descendant']) ?>
                                            </div>
                                    </div>
                            <?php endforeach ?>
                    <?php endif ?>
                    <div>
                            <p>
                                    <?php for($i=0;$i<$page_num;$i++) {
                                            $page=$i+1;
                                            $offset=$i*$per_page; ?>
                                            <a href="<?php echo base_url(); ?>index.php/msgboard/index/<?php echo $offset; ?>"><?php echo $page ?></a>
                                    <?php } ?>
                            </p>
                    </div>
              </div>
        </div>
</div>