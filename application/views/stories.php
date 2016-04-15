
<div id="content" class="content-nb">
    <div id="container">
        <div class="content-left">
            <ul>
                <?php for($i=0;$i<5;$i++){ 
                    if(isset($result[$i])) { ?>
                        <li>
                            <a href=" <?php echo base_url(); ?>index.php/episode/index/<?php echo $result[$i]['id'] ?>">
                                <?php echo "EP".$result[$i]['picture'].".".$result[$i]['title']  ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div class="content-right">
            <ul>
                <?php for($i=5;$i<10;$i++){
                    if(isset($result[$i])) { ?>
                        <li>
                            <a href=" <?php echo base_url(); ?>index.php/episode/index/<?php echo $result[$i]['id'] ?>">
                                <?php echo "EP".$result[$i]['picture'].".".$result[$i]['title']  ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
        <div><?php echo $this->pagination->create_links(); ?></div>
    </div>
</div>
 