<?php
/**
 * 錯誤訊息
 * 
 * 404訊息頁面
 *
 * @author Danis
 * @date 2013.12.12
 * @spend 10 min
 */
?>
<!-- #content -->
<div id="content" class="row section">

	<!-- #single-col -->
	<div id="single-col" class="col-md-12">
		
		<!-- article -->
		<article class="article box">

			<section class="row section">

				<div id="p404" class="col-md-12">

					<h2>咦？找不到您要的頁面。</h2>

					<h4>建議您：</h4>
					
					<ul>
						<li>回<a href="#" onclick="history.go(-1); event.preventDefault();">上一頁</a>重新瀏覽</li>
						<li>回<?php echo CHtml::link('首頁', Yii::app()->homeUrl); ?>重新瀏覽</li>
						<li><?php echo CHtml::link('告訴我們', array('service/contact')); ?>您需要的幫助</li>
					</ul>

				</div><!-- /#p404 -->

				<!-- #link -->
				<!-- <div id="list" class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">相關連結</h3>
						</div>
						<div class="panel-body">
					    	<a class="btn btn-lg btn-block btn-kuru" href="/about">關於庫嚕網</a>
							<a class="btn btn-lg btn-block btn-kuru" href="/legend">使用說明</a>
							<a class="btn btn-lg btn-block btn-kuru" href="/member-admin">會員專區</a>
						</div>
					</div>
				</div> -->
				<!-- /#link -->

            </section>

		</article><!-- /article -->

	</div><!-- /#single-col -->

</div><!-- /#content -->