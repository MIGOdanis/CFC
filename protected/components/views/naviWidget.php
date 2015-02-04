<?php
foreach ($item as $key => $row) {
    if(in_array($key,  $ignoreController)){
    ?>
    <div>
        <a href="<?php echo Yii::app()->createUrl($row["defaultUrl"]); ?>">
            <div class="navi">
                <?php echo $row["title"]; ?>
                <?php 
                    if($controller == $key){
                       echo '<div class="arrow"></div>'; 
                    }
                ?>
            </div>
        </a>            
    </div>
    <?php 
    }
}
?>                    