<?php
/**
 * 增加活動設定
 *
 * @author Danis
 * @date 2014.4.2
 * @spend 25 min
 */

$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/admin-table-form.css');
?>
<style type="text/css">
	.forms .row{
		border-top:#95A5A5 solid 1px;
		margin-bottom: 10px;
		overflow: hidden;
		background-color: #ECF0F1;
	}
	.row-title{
		border-bottom:#95A5A5 solid 1px;
		overflow: hidden;		
		background-color: #7E8C8D;
		color: #fff;
		font-weight: bold;
	}
	.base-infor{
		position: relative;
	}
	.tab-arrow2{
		width: 0px;
		height: 0px;
		border-style: solid;
		border-width: 15px 10px 0 10px;
		border-color: #ECF0F1 transparent transparent transparent;
		position: absolute;
		bottom: -35px;
		left: 50%;
		margin-left: -10px;
		z-index: 999;
		display: none;
	}
	.name{
		width: 55%;
		float: left;
		font-size: 16px;
	}
	.value{
		width: 35%;
		float: left;	
		font-size: 16px;
		word-break:break-all;	
	}
	.input{
		width: 100%;
		display: none;
		font-size: 18px;
		background-color: #BEC3C7;
		float: left;
		padding-top: 30px;
		padding-bottom: 10px;
		padding-left: 10px;
	}
	.edit{
		float: right;
		cursor: pointer;
		font-size: 18px;
	}
	.forms{
		border:#95A5A5 solid 1px;
		background-color: #ECF0F1;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		margin-bottom: 10px;
	}
	.input-title , .iput-box{
		font-weight: bold;
		color: #fff;
		float: left;
		width: 10%;
		height: auto;
		line-height: 26px;
	}
	.bot-group{
		float: right;
		margin-right: 40px;
	}
</style>
<script>
$(function() {
	$('.edit').click(function() {
		var iid = $(this).data("iid");
		$('.input').hide();
		$('.tab-arrow2').hide();
		$("#"+iid).show();
		$(this).parent().find(".tab-arrow2").show();
	});

	$('.close').click(function() {
		$('.input').hide();
		$('.tab-arrow2').hide();
	});

	$('.tab-but').click(function() {
		$('.forms').hide();
		$('#' + $(this).data("fn")).show();
		$('.tab-but').removeClass("active");
		$('.tab-but .tab-arrow').removeClass("tab-arrow-active");
		$(this).addClass("active");
		$(this).find(".tab-arrow").addClass("tab-arrow-active");
	});

	$('.save').click(function() {
		var id = $(this).data("sid");
		var value = $("#ip-"+id).val();
		var data = {value:value,id:id};
		$.post('ajaxUpateValue', data, function (data) {
			if(data.data.error == true){
				$('.input').hide();
				$('.tab-arrow2').hide();
				$('#v-'+id).html(value);
			}else{
				alert("修改失敗");
			}
		});
	});	
});
</script>
<div class="con-box">
	<div class="tab-bar">
		<div class="tab-but active" data-fn="index">
			<b>首頁參數</b>
			<div class="tab-arrow tab-arrow-active"></div>
		</div>
		<div class="tab-but"  data-fn="forum">
			<b>論壇參數</b>
			<div class="tab-arrow"></div>
		</div>
		<div class="tab-but"  data-fn="company">
			<b>店家參數</b>
			<div class="tab-arrow"></div>
		</div>			
		<div class="tab-but"  data-fn="search">
			<b>搜尋參數</b>
			<div class="tab-arrow"></div>
		</div>
		<div class="tab-but"  data-fn="all">
			<b>全站參數</b>
			<div class="tab-arrow"></div>
		</div>
		<div class="tab-but"  data-fn="other">
			<b>其他參數</b>
			<div class="tab-arrow"></div>
		</div>
	</div>
	<div class="form-box">
		<!-- 活動資訊 -->
		<div id="index" class="forms active">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['index'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>
		</div>
		<!-- 主辦單位及聯絡資訊 -->
		<div id="forum" class="forms">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['forum'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>						
		</div>
		<!-- 交通方式 -->
		<div id="company" class="forms">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['company'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>													
		</div>
		<!-- 活動內容 -->
		<div id="search" class="forms">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['search'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>												
		</div>
		<!-- 圖片管理 -->
		<div id="all" class="forms">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['all'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>					
		</div>
		<!-- 交通方式 -->
		<div id="other" class="forms">
			<div class="row-title">			
					<div class="name">名稱</div>
					<div class="value">參數</div>			
					<div class="edit">操作</div>
			</div>
			<?php foreach($model['other'] as $row): ?>
			<div class="row">
				<div class="base-infor">
					<div class="name"><?php echo $row->name;?></div>
					<div class="value" id="v-<?php echo $row->id;?>"><?php echo $row->value;?></div>			
					<div class="edit" data-iid="<?php echo $row->key;?>"><b>編輯</b></div>
					<div class="tab-arrow2"></div>
				</div>
				<div class="input" id="<?php echo $row->key;?>">
					<div class="input-title">編輯參數</div>
					<div class="iput-box">
						<?php if(mb_strlen($row->value,"utf-8") < 28): ?>
							<input type="text" id="ip-<?php echo $row->id;?>" value="<?php echo $row->value;?>" size="60">
						<?php else: ?>
							<textarea style="width: 500px; height: 120px;" id="ip-<?php echo $row->id;?>"><?php echo $row->value;?></textarea>
						<?php endif;?>
					</div>
					<div class="bot-group">
						<button class="save" data-sid="<?php echo $row->id;?>">儲存</button>
						<button class="close">取消</button>
					</div>
				</div>
			</div>	
			<?php endforeach; ?>															
		</div>
	</div>
</div>