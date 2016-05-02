<div id="content" class="content-nb">
	<div id="container">
		<div class="content-left">
			<div id="play_area"><div id="description"></div></div>
        	                           <div class="play_menu">
                	                   <p>Next: </p>
                                                <div id="play_nextType">	
                                                </div>
                                                <p>Mode: </p>
                                                <div class="level_menu" id="play_menu_level">
                                                <ul>
                                                            <li>
                                                                    <a href="javascript:void(0);" level=0 >简单</a>
                                                            </li>
                                                            <li>
                                                                    <a href="javascript:void(0);" level=1 class="current_level">中等</a>
                                                            </li>
                                                            <li>
                                                                    <a href="javascript:void(0);" level=2>困难</a>
                                                            </li>
                                                </ul>
                                                </div>
        	                                   <p >Score: </p>
                                                <p><span id="play_score">0</span></p>
                                                <a id="play_btn_start" class="play_btn" href="javascript:void(0);" unselectable="on">开始</a>
                                                <a id="play_rst" class="play_btn" href="javascript:void(0);" unselectable="on">重置</a>
                                                
                                        </div>
                                        <div id="play_menu_m">
                                                	<a id="direction_up" href="javascript:void(0);">    </a>
                                                    <a id="direction_left" href="javascript:void(0);">    </a>
                                                    <a id="direction_down" href="javascript:void(0);">    </a>
                                                    <a id="direction_right" href="javascript:void(0);">    </a>
                                                    <a id="play_start_m" href="javascript:void(0);">S</a>
                                                    <a id="play_reset_m" href="javascript:void(0);">R</a>
                                        </div>
    	               </div>
	               <div class="content-right">
	                           <table id="tetris_ranking">
    	                                       <caption>Tetris Rankings</caption>
                                                    <tr>
                                                    	<th>Rank</th>
                                                        <th>Score</th>
                                                        <th>Username</th>
                                                    </tr>
                                                    <?php foreach ($game as $key => $value): ?>
                                                              <tr>
                                                                    <td><?php echo $value['rank'] ?></td>
                                                                    <td><?php echo $value['score'] ?></td>
                                                                    <td><?php echo $value['username'] ?></td>
                                                              </tr>  
                                                    <?php endforeach ?>        
                                        </table>
                                        <div class="page_link"><?php echo $this->pagination->create_links(); ?></div>
                             </div>
	</div>
</div>