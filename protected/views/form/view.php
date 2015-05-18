<?php
$page = json_decode($model->question);
$pageArr = (array)$page;
$countPage = count($pageArr);
// print_r($formUser); exit;
?>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/bootstrap/validator/js/validator.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="//eland.doublemax.net/cfdmp/clickreceiver?DMP_SR=CF_AT&DMP_SR_TY=ACT<?php echo $model->id;?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery.dateLists.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/css/jquery.dateLists.css">
<link rel="stylesheet" href="<?php echo Yii::app()->params['baseUrl']; ?>/assets/js/jquery-ui/ss-theam/jquery-ui.css">
<style type="text/css">
	.object-group{
		margin-top: 20px;
	}

	.object-group label{
		font-size: 20px;
		margin-bottom: 0px !important;
	}

	.object-group small{
		font-size: 15px;

	}
	.title-group{
		margin-top: 10px;
		margin-bottom: 20px;
	}
	.singleSelect-other-text, .singleSelect-other-radio, .multiSelect-other-text, .multiSelect-other-checkbox{
		max-width: 350px !important;
		float: left;
	}
 	.singleText-text, .form-user-input{
		max-width: 350px !important;
	}	
	.singleSelect-other-box, .multiSelect-other-box{
		overflow: hidden;
	}
	.radios, .checkboxs{
		width: 20px;
		height: 20px;
		margin-right: 10px !important;
	}
	.ntl-table tr td , .tableSelect-table tr td{
		min-width: 30px;
		text-align: center;
	}
	.tableSelect-column-text{
		font-weight: bold;
		text-align: center;
	}
	.tableSelect-row-text{
		font-weight: bold;
		text-align: right;
		max-width: 300px;
	}
	.tableSelect-table{
		width: 100%;
	}
	.tableSelect-table tr{
		border-bottom:  solid 1px #B4B4B4; 
	}
	.tableSelect-table tr:nth-child(even){
		background-color: #F2F2F2;
	}
	.tableSelect-table thead{
		background-color: #ffffff;
	}
	#over-content{
		font-size: 20px;
		margin-top: 20px;
	}
	.ojb{
		margin-top: 15px;
		margin-bottom: 15px;
	}
	.title-group h3{
		font-size: 15px;
	}
	#cf-logo{
		margin-left: -25px;
	}
	#FormsUser_years{
		display: none;
	}
	#FormsUser_years_dateLists{
		overflow: hidden;
	}
	#FormsUser_years_dateLists div{
		float: left;
		margin-right: 10px;
	}
	.dateLists_container .month_container .list{
		margin-right: 0px;
	}
	#contents{
		padding-bottom: 20px;
	}
	.errorMessage{
		color: red !important;
	}
	.fb-login{
		border-right: 1px solid #e5e5e5;
		text-align: center;
		padding-top: 50px;
	}
	.fb-login, .form-login{
		min-height: 350px;
		width: 50%;
		float: left;
	}
	.form-login{
		padding-left: 30px;
		margin-bottom: 30px;
	}
	.form-login-box{
		width: 100%;
		overflow: hidden;
	}
	.fb-login-btn{
		width: 50%;
		margin-right: auto;
		margin-left: auto;
		background-color:#3B5998;
		font-weight: bold;
		min-height: 30px;
		margin-top: 40px;
		border-radius : 5px;
		font-size: 20px;
		line-height: 40px;
		color: #fff;
		padding-top: 5px;
		padding-bottom: 10px;
	}
	.fb-logo{
		max-height: 35px;
	}
	.required-hightlight{
		border-radius:5px;
		padding: 10px;
		border: solid 1px #a94442;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	}
	.err-msg{
		text-align: center;
	}
	#contents{
		padding-left: 0px;
		padding-right: 0px;
	}
	#page{
		padding-left: 50px;
		padding-right: 50px;		
	}
	.over-content{
		text-align: center;
	}
	.bg-danger{
		color: red;
	}
</style>
<?php 
if($model!==null)
	echo $model->head_code;
?>
<div id="page" <?php if($value->display == 0){ echo "class='hide-page'"; }?>>
<?php 
if($model===null){
?>
	<div class="page-header">
		<img id="cf-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cf.png">
 		<div class="title-group">
			<h1 class="err-msg">表單維護中，請稍後再試</h1>
		</div>
	</div>	
<?php
}elseif(time() < $model->star_time || time() > $model->end_time){
?>
	<div class="page-header">
		<img id="cf-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cf.png">
 		<div class="title-group">
			<h1 class="err-msg">
				表單已經過期，感謝您的支持
			</h1>
		</div>
	</div>	
<?php
}else{
if(!isset(Yii::app()->session['page'.$model->id."last"]) || (Yii::app()->session['page'.$model->id."last"] < 1) && !in_array(Yii::app()->session['page'.$model->id."last"], array("end","last")))
	Yii::app()->session['page'.$model->id."last"] = 1;

$pageIndex = Yii::app()->session['page'.$model->id."last"];

//print_r(json_decode($ans,true)); exit;

if(Yii::app()->session['page'.$model->id."last"] == "end")
	unset(Yii::app()->session['page'.$model->id."last"]);

if($pageIndex == "end"){
?>
		<div id="over-content">
			<div><img id="cf-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cf.png"></div>
			<div class="over-content"><?php echo nl2br($model->over_content); ?></div>
		</div>
		<?php 
		if($this->id != "index"){
			$ansArray = json_decode($ans,true);
			if(!empty($ansArray)){
				foreach ($ansArray as $key => $ansRow) {
				?>
					<div class="over-content-page">
						<div class="page-header">
					 		<div class="title-group">
								<h2><?php echo $page->$key->pageTitle;?>(分頁<?php echo $page->$key->pageIndex;?>)</h2>
								<h3><?php echo nl2br($page->$key->pageCaption);?></h3>
							</div>
						</div>			
					<?php
					foreach ($ansRow as $ansRowkey => $ansRowvalue) {
					?>
						<div class="ojb">
							<label><?php echo $page->$key->object->$ansRowkey->title; ?></label>
							<div><?php echo $page->$key->object->$ansRowkey->caption; ?></div>
							<div class="ans">
								<?php 
								if(in_array($page->$key->object->$ansRowkey->type, array("tableSelect","multiSelect"))){
									if(!empty($ansRowvalue)){
										foreach ($ansRowvalue as $li => $data) {
											echo $li ." : ". $data . "<br>";
										}
									}
								}else{
									echo $ansRowvalue;
								}
								
								 ?>
							</div>
						</div>
					<?php
					}
					?>
					</div> 
				<?php
				}
			}
		}
		?>
	</div>
<?php
}else{
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'site-setting-form',
		'enableAjaxValidation'=>false,
	)); 
	?>
		<div class="page-header">
			<img id="cf-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cf.png">
	 		<div class="title-group">
				<h1><?php echo $page->$pageIndex->pageTitle;?></h1>
				<h3><?php echo nl2br($page->$pageIndex->pageCaption);?></h3>
			</div>
		</div>

		<?php 
		if($this->id != "index" || (isset(Yii::app()->session['formUser']) && $formUser->id > 0)){ ?>
			<input type="hidden" name="formStart" value='1' />
			<input type="hidden" name="ans" value='<?php echo $ans; ?>' />
			<input type="hidden" name="page" value='<?php echo $pageIndex; ?>' />
			<div class="ojb-group">
				<?php
					// print_r($page->$pageIndex); exit;
					if(!empty($page->$pageIndex->object)){
						foreach ($page->$pageIndex->object as $object) {

							$this->widget('FormWidget', 
								array(
									'object'=>$object,
									'update' => 0
								)
							);
						}
					}
				?>
			</div>
			<div class="modal-footer">
			<?php if ($model->progress == 1) {?>			
				<style type="text/css">
					#bar{
						border-radius: 5px;
				        border: solid 2px #E8E8E8;		
						width: <?php echo (300 * ($pageIndex / $countPage)) ?>px;
						height: 20px;
						background: url("<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/bar.jpg");
						text-align: center;
						color: #fff;
					}
					#bar-box{
						border-radius: 5px;
				        border: solid 2px #E8E8E8;		
						width: 300px;
						height: 20px;
						float: left;
					}
					#bar-text{
						line-height: 24px;
						float: left;
						margin-left: 20px;
					}				
				</style>			
				<div id="bar-box">
					<div id="bar">
						
					</div>
				</div>
				<div id="bar-text">
					進度<?php echo round((100 * ($pageIndex / $countPage)),0) ?>%
				</div>
			<?php }?>
				<input class="btn btn-primary" id="next" type="submit" value="<?php echo ($page->$pageIndex->pageOver == "end")? "提交" : "下一頁"; ?>">
			</div>
		<?php }else{?>
			<?php 
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'site-setting-form',
				'enableAjaxValidation'=>false,
			)); ?>
			
			<div class="login-box">
				<h3>請填寫您的聯絡資料</h3>
				<small>您填寫的資料僅用於本次活動</small>
				<div class="form-login-box">
					<div class="fb-login">
						<?php if(isset($fbLink) && !empty($fbLink)){ ?>
						<h4>不想重複填寫聯絡資料嗎?</h4>
						<small>快使用Fackbook聯結帳號記住我</small>
						<a href="<?php echo $fbLink;?>">
							<div class="fb-login-btn">
								<span><img class="fb-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/FB.png"></span>
								<span>使用FB登入</span>
							</div>
						</a>
						<?php }else{ ?>
							<h4>歡迎回來! <?php echo $fbResponse['name']; ?></h4>
							<small>表單已經自動替您填寫完成!</small><br>
							<small>現在您可以透過右方表單進入表單</small>
							<div class="fb-login-btn">
								<span><img class="fb-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/FB.png"></span>
								<span>+</span>
								<span><img class="fb-logo" src="<?php echo Yii::app()->params['baseUrl']; ?>/assets/image/cf-W.png"></span>
								<span> >>> </span>
							</div>
						<?php }?>
					</div>
					<div class="form-login">
						<?php
							$error = $form->errorSummary($formUser);
							$error = str_replace("Please fix the following input errors","請確認表單",$error);
							if(!empty($error)){
								echo '<p class="bg-danger">' . $error . '</p>';
							}
						?>
						<div class="form-group">
							<label><?php echo $form->labelEx($formUser,'name'); ?></label>
							<?php echo $form->textField($formUser,'name',array('size'=>60,'maxlength'=>70 , "class"=>"form-control form-user-input" , "placeholder"=>"您的姓名")); ?>
							<p class="text-danger"><?php echo $form->error($formUser,'name'); ?></p>
						</div>	
						<div class="form-group">
							<label><?php echo $form->labelEx($formUser,'mail'); ?></label>
							<?php echo $form->textField($formUser,'mail',array('size'=>60,'maxlength'=>70 , "class"=>"form-control form-user-input" , "placeholder"=>"電子信箱")); ?>
							<p class="text-danger"><?php echo $form->error($formUser,'mail'); ?></p>
						</div>	
						<div class="form-group">
							<label><?php echo $form->labelEx($formUser,'phone'); ?></label>
							<?php echo $form->textField($formUser,'phone',array('size'=>60,'maxlength'=>70 , "class"=>"form-control form-user-input" , "placeholder"=>"聯絡電話")); ?>
							<p class="text-danger"><?php echo $form->error($formUser,'phone'); ?></p>
						</div>
						<div class="form-group">
							<label>您的性別</label>
							<label class="checkbox-inline">
						  		<input type="radio" name="FormsUser[gender]" value="1" <?php if($formUser->gender == 1){ echo "checked"; }?>>
						  		男性
						  		<input type="radio" name="FormsUser[gender]" value="2" <?php if($formUser->gender == 2){ echo "checked"; }?>>
						  		女性
							</label>
							<p class="text-danger"><?php echo $form->error($formUser,'gender'); ?></p>
						</div>
						<div class="form-group">
							<label><?php echo $form->labelEx($formUser,'years'); ?></label>
							<?php echo $form->textField($formUser,'years',array('size'=>60,'maxlength'=>70 , "class"=>"form-control form-user-input")); ?>
							<p class="text-danger"><?php echo $form->error($formUser,'years'); ?></p>
						</div>																		
					</div>
				</div>	
				<div class="modal-footer">
					
					<input class="btn btn-primary" id="next" type="submit" value="下一頁">
				</div>
			</div>
			<?php $this->endWidget(); ?>
		<?php }?>
		<script type="text/javascript">
			$(function() {
				var indexT = 0;
				$(".index").each(function(t){
					indexT++
					$(this).html(indexT + ".");
				});	

				$('#FormsUser_years').dateDropDowns({
				    dateFormat:'yy-mm-dd',
				    monthNames: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'], 
				    yearStart:'<?php echo (date("Y") - 80);?>', yearEnd:'<?php echo date("Y");?>'
				});

				$( ".datepick" ).datepicker({
					defaultDate: "+0d",
					// maxDate: "today",
					minDate: "2014-12-01",
					changeMonth: true,
					numberOfMonths: 1,
					dateFormat:"yy-mm-dd",
					onClose: function( selectedDate ) {
						$( "#end_day" ).datepicker( "option", "minDate", selectedDate );
					}
				});

				$("select").change(function(){
					var value = $(this).find("option:selected").text();
					var warp ="";
					//console.log(value);
					$(this).children().each(function(t){
						if($(this).text() == value){
							warp = $(this).data("warp");
						}
					});	
					$("#hide-"+$(this).attr("name")+"-dropWarp").attr("value",warp);
				});

				$("#next").click(function(){
					var check = 0;
					var firstHLT = 0;
					console.log(check);
					$(".required-check").each(function(){
						if($(this).data("type") == "singleText" || $(this).data("type") == "multiText"){
							if($(this).data("type") == "singleText"){
								var val = $("input[name='"+$(this).attr("id")+"']").val();
							}else{
								var val = $("textarea[name='"+$(this).attr("id")+"']").val();
								console.log(val);
							}
							
							if(val.length <= 0){
								check = 1;
								$(this).addClass("required-hightlight");
								if(firstHLT == 0){
									firstHLT = $(this).offset().top;
								}
							}else{
								$(this).removeClass("required-hightlight");
							}
						}else if($(this).data("type") == "singleSelect" || $(this).data("type") == "numberToLevel"){
							var val = $("input[name='"+$(this).attr("id")+"']:checked").val();
							if(val == undefined){
								check = 1;
								$(this).addClass("required-hightlight");
								if(firstHLT == 0){
									firstHLT = $(this).offset().top;
								}
							}else{
								$(this).removeClass("required-hightlight");
							}
						}else if($(this).data("type") == "multiSelect"){
							var val = $("input[name='"+$(this).attr("id")+"[]']:checked").val();
							if(val == undefined){
								check = 1;
								$(this).addClass("required-hightlight");
								if(firstHLT == 0){
									firstHLT = $(this).offset().top;
								}
							}else{
								$(this).removeClass("required-hightlight");
							}							
						}else if($(this).data("type") == "tableSelect"){
							var box = this;
							$(this).find("tr").each(function(t){
								if($(this).find("input").length > 0){ 
									var val = $(this).find("input:checked").val();
									if(val == undefined){
										check = 1;
										$(box).addClass("required-hightlight");
										if(firstHLT == 0){
											firstHLT = $(box).offset().top;
										}
									}else{
										$(box).removeClass("required-hightlight");
									}
								}
							});							
						}else if($(this).data("type") == "dropDown"){
							var val = $("select[name='"+$(this).attr("id")+"']").val();
							if(val == "請選擇一個項目"){
								check = 1;
								$(this).addClass("required-hightlight");
								if(firstHLT == 0){
									firstHLT = $(this).offset().top;
								}
							}else{
								$(this).removeClass("required-hightlight");
							}							
						}
						if(check == 1){
							console.log(this);
						}

					});

					console.log(check);
					if(check == 1){
						$('body').animate({
								scrollTop: firstHLT,
						}, 1000);
						check = 0;
						return false;
					}
						
				})
			})
		</script>
		<?php $this->endWidget(); ?>
		<?php }?>	
	</div>
	
<?php }?>