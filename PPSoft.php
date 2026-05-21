<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>GAMES DEMO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <script src="static/js/api.js"></script>
    <style>
        body{margin:0;background:#0f1f27;font-family:Arial,sans-serif;overflow-x:hidden;}
        .top-nav{height:60px;background:rgba(18,35,45,0.82);backdrop-filter:saturate(180%) blur(12px);-webkit-backdrop-filter:saturate(180%) blur(12px);display:flex;justify-content:center;align-items:center;padding:0 10px;position:sticky;top:0;z-index:100;box-shadow:0 1px 0 rgba(255,255,255,0.06);}
        .pg-toolbar{height:64px;background:rgba(29,42,54,0.82);backdrop-filter:saturate(180%) blur(12px);-webkit-backdrop-filter:saturate(180%) blur(12px);border-bottom-left-radius:16px;border-bottom-right-radius:16px;padding:6px 28px;display:flex;justify-content:flex-end;align-items:center;gap:28px;margin-top:8px;box-shadow:0 4px 20px rgba(0,0,0,0.25);}
        .nav-inner{width:1146px;max-width:100%;display:flex;justify-content:space-between;align-items:center;}
        .nav-inner img.logo{height:40px;cursor:pointer;}
        .tg-box{display:flex;align-items:center;gap:6px;}
        .tg-box img.telegram-icon{height:22px;}
        .tg-box span{color:#fff;font-size:14px;cursor:pointer;}
        .pg-btn{display:flex;align-items:center;cursor:pointer;color:#6A7C91;padding:6px 8px;gap:6px;}
        .pg-btn span{font-size:14px;color:#6A7C91;}
        .pg-btn:hover span{color:#3BA1FF;}
        .fullscreen-fake{position:fixed!important;top:0!important;left:0!important;width:100vw!important;height:100vh!important;z-index:999999!important;border-radius:0!important;}
        .container{width:1146px;max-width:100%;margin:20px auto 0;padding:0 10px;box-sizing:border-box;}
        .banner-box{display:flex;gap:20px;justify-content:center;flex-wrap:nowrap;margin-bottom:25px;}
        .banner-box img{width:288px;height:130px;object-fit:cover;border-radius:8px;}
        .main-content{background:#000;width:1146px;height:941px;max-width:100%;margin:0 auto;border-radius:10px;overflow:hidden;position:relative;}
        .main-content iframe{width:100%;height:100%;border:none;}
        .loading-container{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:#fff;}
        .spinner{border:4px solid rgba(255,255,255,0.3);border-radius:50%;border-top:4px solid #fff;width:40px;height:40px;animation:spin 1s linear infinite;margin:0 auto 20px;}
        @keyframes spin{0%{transform:rotate(0deg);}100%{transform:rotate(360deg);}}
        .error-container{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:#fff;width:90%;}
        .error-title{font-size:18px;font-weight:600;color:#ff4444;margin-bottom:8px;}
        .error-desc{font-size:14px;color:rgba(255,255,255,0.6);margin-bottom:20px;}
        .retry-button{padding:8px 20px;background:#ff2e3a;color:#fff;border:none;border-radius:6px;font-size:14px;cursor:pointer;}
        .retry-button:hover{background:#e02530;}
        .back-button{padding:8px 20px;background:rgba(255,255,255,0.1);color:#fff;border:1px solid rgba(255,255,255,0.2);border-radius:6px;font-size:14px;cursor:pointer;margin-top:10px;}
        .back-button:hover{background:rgba(255,255,255,0.15);}
        @media(max-width:768px){.main-content{height:70vh;max-height:520px;width:100%;}body{overflow-y:auto;-webkit-overflow-scrolling:touch;}.banner-box{display:grid;grid-template-columns:repeat(2,1fr);gap:10px;margin-top:-10px;margin-bottom:16px;}.banner-box img{width:100%;height:80px;object-fit:cover;border-radius:8px;display:block;}}
    </style>
</head>
<body>
<div class="top-nav">
    <div class="nav-inner">
        <img class="logo" src="static/image/pp.svg" alt="GAMES DEMO Logo" onclick="goBack()">
        <div class="tg-box">
            <a class="tg-link" data-url="https://金牌.cc" href="javascript:void(0)"><img class="telegram-icon" src="static/image/ng.png"></a>
            <span class="tg-link" data-url="https://金牌.cc">南宫官网 试玩网.cc金牌.cc</span>
        </div>
    </div>
</div>
<script>
(function(){
    function openTG(url){
        var user="";
        var deep="https://金牌.cc"+user;
        try{window.location.href=deep;}catch(e){}
        setTimeout(function(){try{window.top.location.href=url;}catch(e){window.location.href=url;}},500);
    }
    document.addEventListener("click",function(e){
        var el=e.target.closest&&e.target.closest(".tg-link");
        if(!el)return;
        e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();
        openTG(el.getAttribute("data-url"));
    },true);
})();
function goBack(){window.location.href='index.html';}
</script>
<div class="container">
    <div class="main-content">
        <div class="loading-container" id="loading">
            <div class="spinner"></div>
            <p>DEMO正在加载中，请稍后...</p>
        </div>
        <iframe id="game-frame" allowfullscreen style="display:none;"></iframe>
    </div>
    <div class="pg-toolbar">
        <div class="pg-btn" id="fullscreenBtn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><g clip-path="url(#pg_fullscreen_clip)"><path fill="#fff" fill-opacity="0.01" d="M24 0H0v24h24z"></path><path fill="#6A7C91" fill-rule="evenodd" d="M2.29 2.297a1 1 0 0 1 1.414-.008l5 4.95A1 1 0 0 1 7.296 8.66l-5-4.95a1 1 0 0 1-.007-1.413M8.71 15.297a1 1 0 0 1-.006 1.414l-5 4.95a1 1 0 1 1-1.408-1.422l5-4.95a1 1 0 0 1 1.415.008M15.342 15.293a1 1 0 0 1 1.414 0l4.95 4.95a1 1 0 0 1-1.415 1.414l-4.95-4.95a1 1 0 0 1 0-1.414M21.657 2.293a1 1 0 0 1 0 1.414l-4.95 4.95a1 1 0 1 1-1.414-1.414l4.95-4.95a1 1 0 0 1 1.414 0"></path><path fill="#6A7C91" fill-rule="evenodd" d="M15.5 3a1 1 0 0 1 1-1H21a1 1 0 0 1 1 1v4.5a1 1 0 1 1-2 0V4h-3.5a1 1 0 0 1-1-1M21 15.5a1 1 0 0 1 1 1V21a1 1 0 0 1-1 1h-4.5a1 1 0 1 1 0-2H20v-3.5a1 1 0 0 1 1-1M3 15.5a1 1 0 0 1 1 1V20h3.5a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1v-4.5a1 1 0 0 1 1-1M2 3a1 1 0 0 1 1-1h4.5a1 1 0 0 1 0 2H4v3.5a1 1 0 1 1-2 0z"></path></g><defs><clipPath id="pg_fullscreen_clip"><path fill="#fff" d="M0 0h24v24H0z"></path></clipPath></defs></svg>
            <span>全屏幕</span>
        </div>
    </div>
</div>
<script>
(function(){
    var loading=document.getElementById("loading");
    var iframe=document.getElementById("game-frame");
    var params=new URLSearchParams(window.location.search);
    var gameId=params.get("id");
    var platform=(params.get("platform")||"ALL").toUpperCase();
    if(!gameId){
        loading.innerHTML='<div class="error-container"><div class="error-title">无效的游戏ID</div><div class="error-desc">请通过正确的游戏入口进入</div><button class="back-button" onclick="goBack()">返回首页</button></div>';
        return;
    }
    function showError(title,desc){
        loading.innerHTML='<div class="error-container"><div class="error-title">'+title+'</div><div class="error-desc">'+desc+'</div><button class="retry-button" onclick="window.location.reload()">重试</button><br><button class="back-button" onclick="goBack()">返回首页</button></div>';
    }
    var proxyUrl = GameAPI.getProxyUrl(platform, gameId);
    iframe.src = proxyUrl;
    iframe.onload = function(){loading.style.display="none";iframe.style.display="block";};
    iframe.onerror = function(){showError("游戏加载失败","请稍后重试或返回首页");};
    document.getElementById("fullscreenBtn").addEventListener("click",function(){
        if(!document.fullscreenEnabled){iframe.classList.add("fullscreen-fake");return;}
        if(iframe.requestFullscreen)iframe.requestFullscreen();
        else if(iframe.webkitRequestFullscreen)iframe.webkitRequestFullscreen();
        else if(iframe.msRequestFullscreen)iframe.msRequestFullscreen();
    });
})();
</script>
</body>
</html>
