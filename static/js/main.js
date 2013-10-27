var navi = {
    // variables
    aPages : [],
    aLinks : [],
    tween : {},
    oParent : null,
    oPages : null,
    bRunning : null,
    sTargPage : null,
    sCurPage : null,
    bHash : null,
    sOldH : null,
    initoffstLeft : 0,
    initoffstRight : 0,
    changing : false,
    bUpdateH : true,

    // initialization
    init : function (aParams) {
        this.oPages = document.getElementById(aParams.pages_id);
        this.oParent  = document.getElementById(aParams.parent_id);

        var aAEls = this.oParent.getElementsByTagName('a');
        var i = 0; var p = null;
        while (p = aAEls[i++]) {
            if (p.className && p.className.indexOf('go') >= 0) {
                var sHref = p.href.split('#')[1];
                var oDst = document.getElementById(sHref);
                if (oDst) {
                    // fill-in pages array
                    this.aPages[sHref] = {
                        oObj:  oDst,
                        iXPos: -oDst.offsetLeft,
                        iYPos: -oDst.offsetTop
                    };

                    // fill-in links array
                    this.aLinks.push({a: p, oObj: oDst});

                    p.onclick = function () {
                        navi.goto(this.href.split('#')[1], aParams.duration);
                        return false;
                    }
                }
            }
        }

        this.resize();

        if ('onhashchange' in window) {
            if (location.hash !== '' && location.hash !== '#' && location.hash.indexOf('page')>-1) {
                this.sOldH = location.hash.substring(1);              
                this.initoffstLeft = this.aPages[this.sOldH].oObj.offsetLeft;
                this.initoffstTop = this.aPages[this.sOldH].oObj.offsetTop;
                console.log(this.initoffstLeft);
                this.resize();
                this.goto(this.sOldH, -1);
            } else
                this.goto('page1', -1);
            this.bHash = true;
			
            window.onhashchange = function() {
                if (location.hash.substring(1) !== navi.sOldH) {
                    navi.sOldH = location.hash.substring(1);
                    if (navi.sOldH == '') {
                        navi.bUpdateH = false;
                    }
                    navi.goto(navi.sOldH, aParams.duration);
                }
                return false;
            }
        }
    },

    // on resize
    resize : function () {
        var iCurW = this.oParent.offsetWidth; // current sizes
        var iCurH = this.oParent.offsetHeight;
        for (var i in this.aPages) { // for each page
            var oPage = this.aPages[i];
            //console.log(i);
            var iNewX = Math.round((oPage.oObj.offsetLeft-this.initoffstLeft) * iCurW / oPage.oObj.offsetWidth); // new sizes
            var iNewY = Math.round((oPage.oObj.offsetTop-this.initoffstTop)  * iCurH / oPage.oObj.offsetHeight);
            oPage.oObj.style.left   = iNewX + 'px';
            //console.log(iNewX + 'px');
            oPage.oObj.style.top    = iNewY + 'px';
            oPage.oObj.style.width  = iCurW + 'px';
            oPage.oObj.style.height = iCurH + 'px';
            oPage.iXPos = -iNewX;
            oPage.iYPos = -iNewY;

            if (this.sCurPage)
                this.goto(this.sCurPage, -1);
        }
    },

    goto : function (sHref, iDur) {
    	if(sHref == 'page1' || sHref == 'page2' || sHref == 'page3' || sHref == 'page4'){
	    	if(navi.changing == false){
		        navi.changing = true;
	    		this.tween.iStart = new Date() * 1;
		        this.tween.iDur = iDur;
		        this.tween.fromX = this.oPages.offsetLeft;	//console.log(this.oPages.offsetLeft);
		        this.tween.fromY = this.oPages.offsetTop;
		        this.tween.iXPos   = this.aPages[sHref].iXPos - this.tween.fromX;
		        this.tween.iYPos   = this.aPages[sHref].iYPos - this.tween.fromY;
		        this.sTargPage = sHref; //console.log(this.aPages[sHref].iXPos);
		
		        if (! this.bRunning)
		            this.bRunning = window.setInterval(this.animate, 24);
	    	}
    	}
    },

    animate : function () {
        var iCurTime = (new Date() * 1) - navi.tween.iStart;
        if (iCurTime < navi.tween.iDur) {
            var iCur = Math.cos(Math.PI * (iCurTime / navi.tween.iDur)) - 1;
            navi.oPages.style.left = Math.round(-navi.tween.iXPos * .5 * iCur + navi.tween.fromX) + 'px';
            navi.oPages.style.top  = Math.round(-navi.tween.iYPos * .5 * iCur + navi.tween.fromY) + 'px';
        } else {
            navi.oPages.style.left = Math.round(navi.tween.fromX + navi.tween.iXPos) + 'px';
            navi.oPages.style.top  = Math.round(navi.tween.fromY + navi.tween.iYPos) + 'px';

            window.clearInterval(navi.bRunning);
            navi.bRunning = false;
            navi.sCurPage = navi.sTargPage;

            if (navi.bHash) {
                if (navi.bUpdateH) {
                    navi.sOldH = navi.sCurPage;
                    window.location.hash = navi.sCurPage;
                }
	        	navi.changing = false;                
                navi.bUpdateH = true;
            }
        }
    }
}

var dirs = new Array();
for(var i=0;i<10;i++){
	dirs[i]=new Array();
	for(var j=0;j<4;j++){
		dirs[i][j]=0;
	}
}



var updatepage = function(pageid,pageurl){
	$.get(pageurl, function(data) {
			  $('#'+pageid+'-body').html(data);
		});
}

var showregform = function(){
	$('#seccodeimg').click();
	$('#regModal').modal('show');
}

var showapplyform = function(){
	$('#applyseccodeimg').click();
	$('#applyModal').modal('show');
}

var usercenter = function(){
	$("#usercenter").attr({'href':'?c=userinfo'});
	$("#usercenter").fancybox({
				'width'				: '60%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
	$("#usercenter").trigger('click');
}

var forgetpass = function(){
	$("#forgetpass").attr({'href':'?c=userinfo&a=applypass'});
	$("#forgetpass").fancybox({
				'width'				: '60%',
				'height'			: '80%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
	$("#forgetpass").trigger('click');
}

var tuserlogin = function(){
	$("#tuserlogin").attr({'href':'?c=sinauser&act=connect'});
	$("#tuserlogin").fancybox({
				'width'				: '60%',
				'height'			: '80%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
	$("#tuserlogin").trigger('click');
}

var getCookie = function(cookie_name){ 
    var allcookies = document.cookie; 
    var cookie_pos = allcookies.indexOf(cookie_name);
    if (cookie_pos != -1) {
        cookie_pos += cookie_name.length + 1; 
        var cookie_end = allcookies.indexOf(";", cookie_pos); 
        if (cookie_end == -1) {
            cookie_end = allcookies.length;
        }
        var value = unescape(allcookies.substring(cookie_pos, cookie_end));
    }
    return value;
}

window.onload = function() { // page onload
    navi.init({parent_id: 'maincontainer', pages_id: 'pages', duration: 500});
}

window.onkeydown = function(event){ // keyboard alerts
    switch (event.keyCode) {
        case 37: // Left key
            var iPage = navi.sCurPage.substring(4) * 1;
            if(dirs[iPage-1][3] == 1){
	            iPage--;
	            if (iPage < 1) {
	                iPage = 1;
	            }
	            navi.goto('page' + iPage, 500);
            }
            break;
        case 39: // Right key
            var iPage = navi.sCurPage.substring(4) * 1;
            if(dirs[iPage-1][1] == 1){
	            iPage++;
	            if (iPage > 16) {
	                iPage = 16;
	            }
            	navi.goto('page' + iPage, 500);
            }
            break;
        case 38: // Up key
            var iPage = navi.sCurPage.substring(4) * 1;
            if(dirs[iPage-1][0] == 1){
	            iPage -= 4;
	            if (iPage < 1) {
	                iPage = 1;
	            }
	            navi.goto('page' + iPage, 500);
            }
            break;
        case 40: // Down key
            var iPage = navi.sCurPage.substring(4) * 1;
            if(dirs[iPage-1][2] == 1){
	            iPage += 4;
	            if (iPage > 16) {
	                iPage = 16;
	            }
	            navi.goto('page' + iPage, 500);
            }
            break;
    }
};

// When DOM is fully loaded
jQuery(document).ready(function($) {
	if(window.location.hash != '' && window.location.hash != 'page1'){
		window.location = '?';
	}
	if(uid > 0){
		updatepage('page2','?c=website');
	}
	/* ---------------------------------------------------------------------- */
	/*	Reg Form
	/* ---------------------------------------------------------------------- */
	(function() {

		// Setup any needed variables.
		var $form   = $('#reg-form'),
			$loader = '<img src="'+static_path+'images/loader.gif" height="11" width="16" alt="Loading..." /> 请稍候...';

		$form.append('<div id="response" style="display: none;margin-left: 20px;">');
		var $response = $('#response');
		
		var $smt = $('#submit');
		// Do what we need to when form is submitted.
		$smt.on('click', function(e){
			// Hide any previous response text and show loader
			$response.html($loader).show();
			$("#tip_wrong").hide();
			// Make AJAX request 
			$.ajax({
				type: 'POST',
				url: '?a=reg',
				data: $form.serialize(),
				dataType: 'json',
				success: function( data ) {
							// Hide loading
							$response.hide();
							if(data.error){
								var errmsg = [];
								//失败
								$.each(data.msg,function(key, val) {
								    errmsg.push('<li>' + val + '</li>');
								    $('#'+key).focus();
								  });
								$("#tip_wrong_content").html(errmsg.join(''));
								$("#tip_wrong").show();
								$('#seccodeimg').click();
								$('#seccode').val('');
							}else{
								$('#reg-modal-body').html('<center>恭喜注册成功,请返回登录！</center>');
								$("#submit").hide();
								$("#goback").show();
								$('#loginemail').val($('#email').val());
							}
						}
			});
			// Cancel default action
			e.preventDefault();
		});

	})();
	
	
	
	/* ---------------------------------------------------------------------- */
	/*	Apply Invite Code Form
	/* ---------------------------------------------------------------------- */
	(function() {

		// Setup any needed variables.
		var $form   = $('#apply-form'),
			$loader = '<img src="'+static_path+'images/loader.gif" height="11" width="16" alt="Loading..." /> 请稍候...';

		$form.append('<div id="applyresponse" style="display: none;margin-left: 20px;">');
		var $response = $('#applyresponse');
		
		var $smt = $('#applysubmit');
		// Do what we need to when form is submitted.
		$smt.on('click', function(e){
			// Hide any previous response text and show loader
			$response.html($loader).show();
			$("#apply_wrong").hide();
			// Make AJAX request 
			$.ajax({
				type: 'POST',
				url: '?a=apply',
				data: $form.serialize(),
				dataType: 'json',
				success: function( data ) {
							// Hide loading
							$response.hide();
							if(data.error){
								var errmsg = [];
								//失败
								$.each(data.msg,function(key, val) {
								    errmsg.push('<li>' + val + '</li>');
								    $('#'+key).focus();
								  });
								$("#apply_wrong_content").html(errmsg.join(''));
								$("#apply_wrong").show();
								$('#applyseccodeimg').click();
								$('#applyseccode').val('');
							}else{
								$('#apply-modal-body').html('<center>感谢您的关注，您的申请已经提交成功,请返回！</center>');
								$("#applysubmit").hide();
								$("#applygoback").show();
							}
						}
			});
			// Cancel default action
			e.preventDefault();
		});

	})();
	
	/* ---------------------------------------------------------------------- */
	/*	Login Form
	/* ---------------------------------------------------------------------- */
	(function() {

		// Setup any needed variables.
		var $form   = $('#login-form'),
			$loader = '<img src="'+static_path+'images/loader.gif" height="11" width="16" alt="Loading..." /> 请稍候...';

		$form.append('<div id="loginresponse" style="display: none;margin-left: 20px;">');
		var $response = $('#loginresponse');
		
		var $smt = $('#loginsubmit');
		// Do what we need to when form is submitted.
		$smt.on('click', function(e){
			// Hide any previous response text and show loader
			$response.html($loader).show();
			$("#login_wrong").hide();
			// Make AJAX request 
			$.ajax({
				type: 'POST',
				url: '?a=login',
				data: $form.serialize(),
				dataType: 'json',
				success: function( data ) {
							// Hide loading
							$response.hide();
							if(data.error){
								var errmsg = [];
								//失败
								$.each(data.msg,function(key, val) {
								    errmsg.push('<li>' + val + '</li>');
								    $('#'+key).focus();
								  });
								$("#login_wrong_content").html(errmsg.join(''));
								$('#regseccodeimg').click();
								$("#login_wrong").show();
							}else{
								$('#login-div').html('<p>登录成功</p>欢迎你'+data.msg.username+'，请点击下面按钮进入管理面板。<a class="btn-info" href="javascript:navi.goto(\'page2\',500)"> 立即进入管理面板 > </a>');								
								$('#userbar').html(data.msg.username+'<a href="?a=logout" class="blue">退出登录</a><a href="javascript:;" onclick="usercenter();">用户中心</a>');
								//打开去向第二页的开关，同时打开回来的。
								dirs[0][1] = 1;dirs[1][3] = 1;
								$('#page1_goto2').show();
								updatepage('page2','?c=website');
							}
						}
			});
			// Cancel default action
			e.preventDefault();
		});

	})();
	
});