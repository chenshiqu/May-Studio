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
        	<div class="msg">
            	<p class="msg-username"><strong><?php echo $mood['username']; ?></strong></p>
                <p class="msg-content"><?php echo $mood['content']; ?></p>
                <a href="" id="like" class="like" name="<?php echo $mood['type']; ?>">赞(<span id="favour_number"><?php echo $mood['favour']; ?></span>)</a>
                <input type="hidden" class="mood_id" value=" <?php echo $mood['id'] ?>">
                <a href="" class="reply">回复</a><br />
                <div id="reply-input">
                        <?php echo form_open("msgboard/reply") ?>
                	<textarea rows="2" name="text"></textarea>
                	<input type="submit" value="OK" id="reply-submit" class="reply-submit">
                            <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $mood['id'] ?>">
                        </form>
                </div>
                <div id="existed-reply">
                        <div id="like-by">
                    	<!-- <p><strong>周作人</strong>、<strong>伯里曼</strong>赞了这则留言</p> -->
                        </div>
                        <?php foreach ($descendant as $key => $value): ?>
                                    <div>
                                                <p>
                                                        <input type="hidden" value="<?php echo $value['id']; ?>">
                                                        <strong class="reply-username"> <?php echo $value['username'] ?></strong>回复<strong><?php echo $value['parent_name'] ?></strong>
                                                        :<?php echo $value['content']; ?>
                                                        <a class="reply-reply" href="">回复</a>
                                                </p>
                                    </div>
                        <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
    </div>
