<?php 
if(is_array($item)){
    foreach ($item as $row) {
        if($row["remark"] != "hide"){
?>
    <a href="<?php echo Yii::app()->createUrl($row["url"]); ?>">
        <div class="left-navi-menu 
            <?php 
                if(in_array($action,$row["action"]) && $controller == $row["controller"]){ 
                    if(isset($row['parameter'])){
                            $parameter = explode(",", $row['parameter']);
                            if($_GET[$parameter[0]] == $parameter[1])
                                echo "menu-active";
                    }else{
                        echo "menu-active";
                    }
                } 
            ?>">
            <div class="menu-content">
                <div class="menu-title">
                    <?php echo $row["title"]; ?>
                </div>
                <div class="menu-remark">
                    <?php echo $row["remark"]; ?>
                </div>
            </div>
        </div>
    </a>
<?php
        }
    }
}
?>