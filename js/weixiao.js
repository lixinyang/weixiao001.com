/*
 */

var weixiao = function() {
	var weblist = {};
	weblist['360buy'] = {
	    name: "京东商城",
	    logo: "/images/merchants/360buy.jpg",
	    url: "http://click.union.360buy.com/JdClick/?unionId=6490&t=1&to=http://www.360buy.com",
	    domain: '360buy.com',
	    keywords: "京东,京东商城,jd,jingdong,jingdongshangcheng,360buy"
	};
	weblist['amazon'] = {
		id: '245',
	    name: "卓越亚马逊",
	    logo: "/images/merchants/joyo.gif",
	    //url: "http://p.yiqifa.com/c?s=d2c1d4cd&w=317782&c=245&i=201&l=0&e=dddefault&t=http://www.amazon.cn",
	    url: "http://p.yiqifa.com/c?s=2df122e8&w=351245&c=245&i=201&l=0&e=dddefault&t=http://www.amazon.cn",
	    domain: 'amazon.cn',
	    keywords: "亚马逊,卓越,amazon,zhuoyue,joyo"
	};
	weblist['dangdang'] = {
		id: '247',
	    name: "当当网",
	    logo: "/images/merchants/dangdang.jpg",
	    //url: "http://p.yiqifa.com/c?s=e899e047&w=317782&c=247&i=159&l=0&e=dddefault&t=http://www.dangdang.com",
	    url: "http://p.yiqifa.com/c?s=55b0ea84&w=351245&c=247&i=159&l=0&e=dddefault&t=http://www.dangdang.com",
	    domain: 'dangdang.com',
	    keywords: "dd,dangdang,当当"
	};
	weblist['vancl'] = {
			id: '255',
		    name: "凡客诚品",
		    logo: "/images/merchants/vancl.jpg",
		    //url: "http://p.yiqifa.com/c?s=b32f3f96&w=317782&c=255&i=150&l=0&e=dddefault&t=http://www.vancl.com",
		    url: "http://p.yiqifa.com/c?s=d2658224&w=351245&c=255&i=150&l=0&e=dddefault&t=http://www.vancl.com",
		    domain: '360buy.com',
		    keywords: "fk,vk,vancl,凡客,凡客诚品"
		};
	weblist['tmall'] = {
			id: '5549',
		    name: "淘宝商城",
		    logo: "/images/merchants/tmall.jpg",
		    url: "http://p.yiqifa.com/c?s=59c2eb34&w=351245&c=5549&i=12782&l=0&e=dddefault&t=http://www.tmall.com",
		    domain: 'tmall.com',
		    keywords: "taobao,tb,tmall,淘宝商城"
		};
	weblist['newegg'] = {
			id: '280',
		    name: "新蛋网",
		    logo: "/images/merchants/newegg.gif",
		    //url: "http://p.yiqifa.com/c?s=3c715283&w=317782&c=280&i=240&l=0&e=dddefault&t=http://www.newegg.com.cn",
		    url: "http://p.yiqifa.com/c?s=c160519f&w=351245&c=280&i=240&l=0&e=dddefault&t=http://www.newegg.com.cn",
		    domain: 'newegg.com.cn',
		    keywords: "xindan,xd,newegg,新蛋"
		};
	weblist['leyou'] = {
			id: '252',
		    name: "乐友",
		    logo: "/images/merchants/leyou.gif",
		    //url: "http://p.yiqifa.com/c?s=49c63252&w=317782&c=252&i=284&l=0&e=dddefault&t=http://www.leyou.com",
		    url: "http://p.yiqifa.com/c?s=f5538cc3&w=351245&c=252&i=284&l=0&e=dddefault&t=http://www.leyou.com",
		    domain: 'leyou.com',
		    keywords: "ly,lelyou,乐友"
		};
	weblist['redbaby'] = {
			id: '249',
		    name: "红孩子",
		    logo: "/images/merchants/redbaby.jpg",
		    //url: "http://p.yiqifa.com/c?s=4f40efa2&w=317782&c=249&i=12102&l=0&e=dddefault&t=http://www.binggo.com/",
		    url: "http://p.yiqifa.com/c?s=6bbfce52&w=351245&c=249&i=12102&l=0&e=dddefault&t=http://www.binggo.com/",
		    domain: 'binggo.com',
		    keywords: "hhz,honghaizi,redbaby,红孩子"
		};
	weblist['yihaodian'] = {
			id: '139',
		    name: "一号店",
		    logo: "/images/merchants/yihaodian.jpg",
		    url: "http://p.yiqifa.com/c?s=f3a89475&w=351245&c=139&i=802&l=0&e=dddefault&t=http://www.yihaodian.com/product/index.do",
		    domain: 'yihaodian.com',
		    keywords: "yhd,yihaodian,一号店"
		};
	weblist['womai'] = {
			id: '4102',
		    name: "我买网",
		    logo: "/images/merchants/womai.jpg",
		    //url: "http://p.yiqifa.com/c?s=52886ee6&w=317782&c=4102&i=3542&l=0&e=dddefault&t=http://www.womai.com",
		    url: "http://p.yiqifa.com/c?s=1f1fd777&w=351245&c=4102&i=3542&l=0&e=dddefault&t=http://www.womai.com",
		    domain: 'vancl.com',
		    keywords: "wm,womai,我买,我买网"
		};
	weblist['lafaso'] = {
			id: '227',
		    name: "乐蜂网",
		    logo: "/images/merchants/lafaso.jpg",
		    url: "http://p.yiqifa.com/c?s=442247b6&w=351245&c=227&i=196&l=0&e=dddefault&t=http://www.lafaso.com/",
		    domain: 'lafaso.com',
		    keywords: "lafaso,lefeng,lf,乐蜂,乐蜂网"
		};
        weblist['vipshop'] = {
                        id: '4018',
                    name: "唯品会",
                    logo: "/images/merchants/vipshop.jpg",
                    url: "http://p.yiqifa.com/c?s=4fd509e6&w=351245&c=4018&i=2882&l=0&e=dddefault&t=http://www.vipshop.com/",
                    domain: 'vipshop.com',
                    keywords: "weipinhui,vipshop,唯品会"
                };
/*    	weblist['gaopeng'] = {
    			id: '5434',
    		    name: "高鹏团购",
    		    logo: "/images/merchants/gaopeng.png",
    		    //url: "http://p.yiqifa.com/c?s=e2454e20&w=317782&c=5434&i=11822&l=0&e=dddefault&t=http://www.gaopeng.com",
    		    url: "http://p.yiqifa.com/c?s=0dbe0de0&w=351245&c=5434&i=11822&l=0&e=dddefault&t=http://www.gaopeng.com",
    		    domain: 'gaopeng.com',
    		    keywords: "gp,高朋,gaopeng,groupon"
    		};*/
        weblist['dianping'] = {
                id: '6198',
            name: "点评团",
            logo: "/images/merchants/dianping.jpg",
            url: "http://p.yiqifa.com/c?s=5d97ce71&w=351245&c=6198&i=17902&l=0&e=dddefault&t=http://t.dianping.com",
            domain: 'dianping.com',
            keywords: "dianping,dp,点评团"
        };
	
	var hasLogin = false;
	var user = {
			'id': '000',
			'user_token': '00000',
			'display_name':'lxy',
			'selected_project_id':'1111',
			'selected_project_name':'贵州山区教育项目'
	};

	var initialed = false;

	function getCookie(c_name)
	{
		var i,x,y,ARRcookies=document.cookie.split(";");
		for (i=0;i<ARRcookies.length;i++)
		{
			  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
			  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
			  x=x.replace(/^\s+|\s+$/g,"");
			  if (x==c_name)
			  {
			    return unescape(y);
			  }
		}
		//modified by lxy
		return '';
	}
	
	//如果传入了user_token则返回指定用户的信息，否则返回当前登录用户的信息
	var init = function(callback, user_token) {
		//用户未登录返回false，已登录返回user对象
		if(user_token) var url = "http://weixiao001.com/ajax/user/" + user_token;
		else var url = "/ajax/current_user";
		$.getJSON(url, function(json) {
			if(json) {
				user = json;
				hasLogin = true;
				//将用户的user_token写入url参数
		        list = weixiao.merchant_list;
		        for(web in list) {
		        	list[web].url = list[web].url.replace('dddefault', user.id);
		        }
			}
			else {
				user = null;
				hasLogin = false;
				//将用户的cookie_token写入url参数
		        list = weixiao.merchant_list;
		        for(web in list) {
		        	if(getCookie('cookie_token').length>0) {
		        		list[web].url = list[web].url.replace('dddefault', getCookie('cookie_token'));
		        	}
		        }
			}
			callback();
		}).error(function() { 
			callback();
		});
		initialed = true;
		
	};

	var feedback = function(text, callback) {
		$.post("/ajax/feedback", {"text":text}, function(result) {
			if(callback) {
				callback(result);
			}
		});
	};
	
	//action_id为该网站在亿起发网站的促销活动id
	var get_merchant = function(action_id) {
		for(web in weblist){
			if(weblist[web].id == action_id) return weblist[web];
		}
	};
	
	return {
		init: init,
		get_user: function() {
			if(!initialed) alert('weixiao.js not initialed! call weixiao.init() on document.ready please. ');
			return user;
		},
		has_login: function() {
			return hasLogin;
		},
		feedback: feedback,
		merchant_list: weblist,
		get_merchant: get_merchant
	};
}();
