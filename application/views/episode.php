    <div id="content" class="content-episode">
    <div id="container">
    	<div class="content-left">
        	<h1>EP<?php echo $story['picture'].'.'.$story['title']  ?></h1>
            <img src="images/stories/<?php echo $story['picture'] ?>.jpg" alt="cartoon" width="550" />
        </div>
        <div class="content-right">
        	<div class="recommendation">
            	<h4>相关推荐</h4>
            	<ul>
                	<li><a href="">灰蓝鸡汤之Things Will Always Work Out</a></li>
                    <li><a href=""></a></li>
                </ul>
            </div>
            <div class="comment-list">
        		<!-- <form class="make-comment" > -->
                            <?php echo form_open("episode/comment",array('class'=>'make-comment')); ?>
            		<p>说点什么：</p>
            		<textarea name="msg_comment" rows="8" ></textarea>
                    <!-- <br /> -->
                	<input type="submit" id="comment-submit" name="comment-submit" class="msg_verify" value="发布" />
                            <input type="hidden" name="story_id" value="<?php echo $story['id'] ?>">
                            </form>
                <p >全部评论<a id="all-cmt" href="">［点击展开］</a></p>
            	<div id="comments" class="collapse">
                            <?php if (!empty($comment)): ?>
                                    <?php foreach ($comment as $key => $value): ?>
                                            <div class="msg">
                                                    <p class="msg-username"><strong><?php echo $value['username'] ?></strong></p>
                                                    <p class="msg-content"><?php echo $value['content'] ?></p>
                                                    <a href="" id="like" class="like" name="<?php echo $value['type'] ?>">赞(<span id="favour_number"><?php echo $value['favour'] ?></span>)</a>
                                                    <input type="hidden" class="comment_id" value="<?php echo $value['id'] ?>">
                                                    <a href="" class="reply">回复</a><br />
                                                    <div id="reply-input">
                                                            <?php echo form_open("/episode/reply") ?>
                                                                <textarea rows="2" name="text"></textarea>
                                                                <input type="submit" value="OK" id="reply-submit" class="msg_verify">
                                                                <input type="hidden" id="parent_id" name="parent_id" value="<?php echo $value['id'] ?>">
                                                                <input type="hidden" name="story_id" value="<?php echo $story['id'] ?>">
                                                            </form>
                                                    </div>
                                                    <div id="existed-reply">
                                                        <div id="like-by">
                                                                <p><strong>周作人</strong>、<strong>伯里曼</strong>赞了这则评论</p>
                                                        </div>
                                                        <div class="reply-box">
                                                                <p><strong class="reply-username">伯里曼</strong>：所有人体轮廓测量都是通过把人体分为各个部分来测量的。<a  class="reply-reply" href="">回复</a></p>
                                                
                                                        </div>
                                                        <div class="reply-box">
                                                            <p><strong class="reply-username">周作人</strong> 回复 <strong>伯里曼</strong>：日光底下无新事，已有的事后必再有，已行的事后必再行。<a class="reply-reply" href="">回复</a></p>
                                                        </div>
                                                    </div>
                                            </div>
                                    <?php endforeach ?>
                            <?php endif ?>
            	</div>
            </div>
        </div>
    </div>
    </div>
