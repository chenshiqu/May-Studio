<?php 

/**
 * 递归方式显示留言数据
 * @param $descendant array()
 */
function descendant_show($descendant)
{
        foreach ($descendant as $key => $value) {
                echo '<div class="reply-box">';
                echo '<p>';
                echo '<input  type="hidden" value="'.$value['id'].'"/>';
                echo '<strong class="reply-username">'.$value['username'].'</strong> 回复 <strong>'.$value['parent_name'].'</strong>：'.$value['content'].'<a  class="reply-reply" href="">回复</a>';
                echo '</p>';
                echo '</div>';
                // if($value['child']) 
                // {
                //         descendant_show($value['descendant']);
                // }               
        }
        
}