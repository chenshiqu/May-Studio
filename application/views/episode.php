    <section id="content">
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
        		<form class="make-comment" >
            		<p>说点什么：</p>
            		<textarea name="msg_comment" rows="8"></textarea>
                    <!-- <br /> -->
                	<input type="submit" id="comment-submit" name="comment-submit" class="msg_verify" value="发布" />
            	</form>
                <p >全部评论<a id="all-cmt" href="">［点击展开］</a></p>
            	<div id="comments" class="collapse">
            		
                	<div class="msg">
            			<p class="msg-username"><strong>阿西莫夫</strong></p>
                		<p class="msg-content">有时候他会迷失在那些古老的世界里，在那里人们生老病死，一切自然；在那里做出来的事覆水难收；在那里罪恶无法预防，幸福也无法规划，滑铁卢战役打输了，就真的作为败战永留史册。有一首他很喜欢的诗说道，亲手写下的字句，永远也不可能被抹去。</p>
                		<a href="" id="like" class="like">赞</a>
                		<a href="" class="reply">回复</a><br />
                		<div id="reply-input">
                			<textarea rows="2"></textarea>
                			<input type="submit" value="OK" id="reply-submit">
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
            	</div>
            </div>
        </div>
    </div>
    </section>
