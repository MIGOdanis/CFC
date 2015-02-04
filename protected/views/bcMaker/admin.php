<?php
function newPage(){

	$code = getCode();
	$repBg = str_replace("{bg_url}", $_POST['bg_url'] , $code);
	$repYTBID = str_replace("{ytb_id}", $_POST['ytb_id'] , $repBg);
	$repLink = str_replace("{link}", $_POST['link'] , $repYTBID);
	$repBanner = str_replace("{banner}", $_POST['banner'] , $repLink);

    $folder = $_POST['name'];
    $localPath = dirname(__FILE__)."/../../../bcMaker/".$_POST['name'];
    if(!is_dir($localPath)){
        mkdir($localPath, 0777, true);
    }
    // if(!is_dir($folder)){
    // 	return array("msg" => "目錄建立失敗" , "code" => false);
    // }

    $fileName = md5(time().$folder) . ".php";
    $urlFile = $folder . "/" . $fileName;
    $fileName = $localPath . DIRECTORY_SEPARATOR . $fileName;
    if (is_file($fileName)) {
    	return array("msg" => "檔案已存在" , "code" => false);
    }

	//開啟檔案從頭複寫
	$file = fopen($fileName , "a+");
	fwrite($file, $repBanner);
	fclose($file);


	return array("msg" => $urlFile , "code" => true);
}

function getCode(){
	return file_get_contents(dirname(__FILE__)."/".$_POST['type']);
}

function getAppCode($type){

if($type == "r"){
return '
<style type="text/css">
#a_banner{
position: absolute;
right: -120px;
top: 135px;
}
.CFAD_OUTAD_CODE{
    position: relative;
}
</style>
<script type="text/javascript">
var COC = document.getElementsByClassName("CFAD_OUTAD_CODE"),
new_banner = document.createElement("img"),
img_src = "'. $_POST['banner'] . '",
COA = document.getElementsByClassName("CFAD_OUTAD_A");

new_banner.setAttribute("id", "a_banner");
new_banner.setAttribute("src", img_src);
new_banner.setAttribute("width", "120");
new_banner.setAttribute("height", "300");
COC[0].appendChild(new_banner);

COA[0].addEventListener("mouseover",function(){
var obj=document.getElementById("a_banner");
obj.style.right="0px"
});
COA[0].addEventListener("mouseout",function(){
var obj=document.getElementById("a_banner");
obj.style.right="-120px"
});
</script>';
}else{
return '
<style type="text/css">
#a_banner{
position: absolute;
right: 36px;
top: -90px;
}
.CFAD_OUTAD_CODE{
    position: relative;
}
</style>
<script type="text/javascript">
var COC = document.getElementsByClassName("CFAD_OUTAD_CODE"),
new_banner = document.createElement("img"),
img_src = "'. $_POST['banner'] . '",
COA = document.getElementsByClassName("CFAD_OUTAD_A");

new_banner.setAttribute("id", "a_banner");
new_banner.setAttribute("src", img_src);
new_banner.setAttribute("width", "728");
new_banner.setAttribute("height", "90");
COC[0].appendChild(new_banner);

COA[0].addEventListener("mouseover",function(){
var obj=document.getElementById("a_banner");
obj.style.top="0px"
});
COA[0].addEventListener("mouseout",function(){
var obj=document.getElementById("a_banner");
obj.style.top="-90px"
});
</script>';
}
}

function getPerCode($type){
	if($type == "bg"){
		return '<style>.CFAD_OUTAD_A{height: 0px !important;}</style>';
	}else{
		return '
<style>
.CFAD_OUTAD_A{
height: 570px !important;
margin-top: 0px !important;
}
</style>
';
	}
}
?>
<style type="text/css">
	.r-font{
		color: red;
	}
	#bottom{
		text-align: center;
	}
	.type-box{
		margin-top: 10px;
	}
	form{
		margin-bottom: 15px;
	}
</style>
<script>
$(function() {
	$( "#name" ).autocomplete({
	source: "getNameList.php",
	minLength: 1,
	select: function( event, ui ) {

	}
	});
});
</script>
	<div class="page-header">
	  <h1>蓋板產生器</h1>
	</div>	
	<?php
		if($_GET['make'] == "1"){
			if(!isset($_POST['name']) || empty($_POST['name'])){
				echo 	'<div class="alert alert-danger" role="alert">
							<strong>未輸入專案代號</strong>
						</div>';
			}elseif(!isset($_POST['ytb_id']) || empty($_POST['ytb_id'])){
				echo 	'<div class="alert alert-danger" role="alert">
							<strong>未輸入影片ID</strong>
						</div>';
			}elseif(!isset($_POST['link']) || empty($_POST['link'])){
				echo 	'<div class="alert alert-danger" role="alert">
							<strong>未輸入導頁連結</strong>
						</div>';
			}elseif($_POST['type'] != "bg_code.html"){
				if(!isset($_POST['banner']) || empty($_POST['banner'])){
					echo 	'<div class="alert alert-danger" role="alert">
								<strong>未輸入banner</strong>
							</div>';
				}else{
					$newpage = newPage();
					if($newpage['code'] === true){
						$codeHead = '<iframe src="http://events.doublemax.net/800_600_maker/' . $newpage['msg'] . '?link=CLICKFORCE" frameborder="0" width="800" height="600" id="temp"></iframe>';
						$peCode = getPerCode("full");
						if($_POST['type'] != "right_code.html"){
							$appCode = getAppCode("t");
						}else{
							$appCode = getAppCode("r");
						}
						
						echo 	'<div class="alert alert-'.$upload['code'].'" role="alert">
									<div>
									<strong>複製以下文字至外掛程式碼</strong>
									<textarea rows="5" cols="100">'.$codeHead.'</textarea>
									</div>
									<div>
									<strong>複製以下文字至前置HTML碼</strong>
									<textarea rows="5" cols="100">'.$peCode.'</textarea>
									</div>
									<div>
									<strong>複製以下文字至後置HTML碼</strong>
									<textarea rows="5" cols="100">'.$appCode.'</textarea>
									</div>												
								</div>';

						$_POST['name'] = "";
						$_POST['bg_url'] = "";
						$_POST['ytb_id'] = "";
						$_POST['link'] = "";
						$_POST['banner'] = "";
					}else{
						echo 	'<div class="alert alert-danger" role="alert">
									<strong>' . $newpage['msg'] . '</strong>
								</div>';
					}
				}
			}else{
			 	if(!isset($_POST['bg_url']) || empty($_POST['bg_url'])){
					echo 	'<div class="alert alert-danger" role="alert">
							<strong>未輸入背景連結</strong>
						</div>';
				}else{
					$newpage = newPage();
					if($newpage['code'] === true){
						$codeHead = '<iframe src="http://events.doublemax.net/800_600_maker/' . $newpage['msg'] . '?link=CLICKFORCE" frameborder="0" width="800" height="600" id="temp"></iframe>';
						$peCode = getPerCode("bg");
						echo 	'<div class="alert alert-'.$upload['code'].'" role="alert">
									<div>
									<strong>複製以下文字至外掛程式碼</strong>
									<textarea rows="5" cols="100">'.$codeHead.'</textarea>
									</div>
									<div>
									<strong>複製以下文字至前置HTML碼</strong>
									<textarea rows="5" cols="100">'.$peCode.'</textarea>
									</div>
								</div>';

						$_POST['name'] = "";
						$_POST['bg_url'] = "";
						$_POST['ytb_id'] = "";
						$_POST['link'] = "";
						$_POST['banner'] = "";
					}else{
						echo 	'<div class="alert alert-danger" role="alert">
									<strong>' . $newpage['msg'] . '</strong>
								</div>';
					}
				}
			}
		}?>
		<form enctype="multipart/form-data" action="admin?make=1" method="POST">
			<div class="form-group">
				<span><b>*必填 專案代號(將作為資料夾名稱，<span class="r-font">請使用英文</span>)</b></span><span><input id="name" class="form-control" name="name" type="text" value="<?php echo $_POST['name'];?>" placeholder="專案代號"/></span>
				<span><b>*必填 影片ID</b></span><span><input id="ytb_id" class="form-control" name="ytb_id" type="text" value="<?php echo $_POST['ytb_id'];?>" placeholder="影片ID"/></span>
				<span><b>*必填 導頁連結</b></span><span><input id="link" class="form-control" name="link" type="text" value="<?php echo $_POST['link'];?>" placeholder="導頁連結"/></span>		
				<span><b>*選擇"蓋板廣告 - 背景"時必填 背景連結</b></span><span><input id="bg_url" class="form-control" name="bg_url" type="text" value="<?php echo $_POST['bg_url'];?>" placeholder="背景連結 ex:http://bgimg.com/bg.jpg"/></span>
				<span><b>*非選擇"蓋板廣告 - 背景"時必填 Banner連結</b></span><span><input id="banner" class="form-control" name="banner" type="text" value="<?php echo $_POST['banner'];?>" placeholder="Banner連結 ex:http://bgimg.com/bg.jpg"/></span>						
				<div class="type-box"><b>廣告形式</b></div>
				<span>
					<select name="type">
						<option value="bg_code.html" <?php if($_POST['type'] == "bg_code.html"){ echo 'selected="true"'; }?>>蓋板廣告 - 背景</option>
						<option value="top_code.html" <?php if($_POST['type'] == "top_code.html"){ echo 'selected="true"'; }?>>蓋板廣告 - Banner(上)</option>
						<option value="right_code.html" <?php if($_POST['type'] == "right_code.html"){ echo 'selected="true"'; }?>>蓋板廣告 - Banner(右)</option>
					</select>		
				</span>	
			</div>
			<button type="subtim" class="btn btn-primary">送出</button>
		</form>