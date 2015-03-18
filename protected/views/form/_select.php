<script type="text/javascript">
	$(function() {
		$(".select-type-drop-down").attr("href",$(".select-type-drop-down").attr("href")+"&pageCount="+$('#pageCount').val())
		$(".select-type-btn").click(function() {
			$.ajax({
				url:$(this).attr("href"),
				//data: { type : $(this).data("page") },
				success:function(html){
					$('#new-type').html(html);
					$('[data-toggle="dropdown"]').parent().removeClass('open');
				}
			})
	        .fail(function(e) {
	            if(e.status == 403){
	                window.location.reload();
	            }
	        });
			return false;//阻止a标签		
		});
	})
</script>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title">選擇題目形式</h4>
</div>
<div class="modal-body">
	<div class="btn-group">
		<button id="type-list" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
		請選擇題目形式 <span class="caret"></span>
		</button>
	  	<ul class="dropdown-menu" role="menu">
			<li><a class="select-type-btn" href="types?type=newPage&pid=<?php echo $pid; ?>">新分頁</a></li>
			<li><a class="select-type-btn" href="types?type=singleText&pid=<?php echo $pid; ?>">單行文字</a></li>
			<li><a class="select-type-btn" href="types?type=multiText&pid=<?php echo $pid; ?>">多行文字</a></li>
			<li><a class="select-type-btn" href="types?type=singleSelect&pid=<?php echo $pid; ?>">單選按鈕</a></li>
			<li><a class="select-type-btn" href="types?type=multiSelect&pid=<?php echo $pid; ?>">複選按鈕</a></li>
			<li><a class="select-type-btn" href="types?type=tableSelect&pid=<?php echo $pid; ?>">表格按鈕</a></li>
			<li><a class="select-type-btn select-type-drop-down" href="types?type=dropDown&pid=<?php echo $pid; ?>">下拉選單</a></li>
			<li><a class="select-type-btn" href="types?type=numberToLevel&pid=<?php echo $pid; ?>">以數字表示程度</a></li>
			<li><a class="select-type-btn" href="types?type=dateAndTime&pid=<?php echo $pid; ?>">日期與時間</a></li>
			<li><a class="select-type-btn" href="types?type=html&pid=<?php echo $pid; ?>">HTML區塊(圖片上傳|超連結|文字)</a></li>
		</ul>
	</div>
	<div id="new-type">

	</div>	
</div>
