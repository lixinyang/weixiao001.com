<!-- 右导航 -->
<h3>文章分类</h3>
    <?php wp_list_cats(); ?>
<h3>邀请好友</h3>
			<p>
			<script type="text/javascript" charset="utf-8">
			(function(){
			  var _w = 106 , _h = 24;
			  var param = {
			    url:'http://weixiao001.com/',
			    type:'5',
			    count:'', /**是否显示分享数，1显示(可选)*/
			    appkey:'3382333545', /**您申请的应用appkey,显示分享来源(可选)*/
			    title:'', /**分享的文字内容(可选，默认为所在页面的title)*/
			    pic:'', /**分享图片的路径(可选)*/
			    ralateUid:'2176040087', /**关联用户的UID，分享微博会@该用户(可选)*/
			    rnd:new Date().valueOf()
			  }
			  var temp = [];
			  for( var p in param ){
			    temp.push(p + '=' + encodeURIComponent( param[p] || '' ) )
			  }
			  document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://hits.sinajs.cn/A1/weiboshare.html?' + temp.join('&') + '" width="'+ _w+'" height="'+_h+'"></iframe>')
			})()
			</script></p>
