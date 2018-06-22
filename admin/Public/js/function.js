/**
 * 刷新验证码
 * @param obj
 * @param url
 * @returns {boolean}
 */
function change_code(obj,url)
{
    $("#code").attr("src",url+Math.random());
    return false;
}


/**
 * ListPage initialization
 */
function listInit(blogId)
{
    articleId = blogId;

    // 加载评论
    getComments( articleId );

    // 语法高亮
    SyntaxHighlighter.all();
}


/**
 * 将用户名称和Email存储到LocalStorage
 */
function setUserInfo()
{
    // 获取当前表单中的值
    currUserName  = $("#commentName").val();
    currUserEmail = $("#commentEmail").val();
    currUserMain  = $("#commentMain").val();

    // 判断当前表单中是否有值
    if ( currUserName != "" && currUserEmail != "" && currUserMain != "" ) {

        // 如果LocalStorage中的值和当前表单中的值不相同，更新LocalStorage中的值
        if ( currUserName != localStorage.userName || currUserEmail != localStorage.userEmail ) {
            localStorage.userName  = currUserName;
            localStorage.userEmail = currUserEmail;
        }

    } else {
        alert( "表单不能为空" );
        return false;
    }
}


/**
 * 查找localStorage，自动为用户设置名称和Email表单
 */
function getUserInfo()
{
    userName  = localStorage.userName;
    userEmail = localStorage.userEmail;
    if( userName != null && userName != "" && userEmail != null && userEmail != "" ){
        $("#commentName").attr("placeholder","");
        $("#commentName").attr("value",userName);
        $("#commentEmail").attr("placeholder","");
        $("#commentEmail").attr("value",userEmail);
    }
}


/**
 * 记录被回复评论ID
 * @param {object} obj 当前文档模型对象
 */
function setCommentId( obj )
{
    // 取得当前评论人的名称
    name = $(obj).parent().prev().prev().find(".currName").text();
    changeCont('<label>回复 <i style="display:inline-block;padding:5px;border-radius:3px;" class="bg-primary">+ '+ name +'</i> ：</label><span class="pull-right" style="display:inline-block;padding:5px;border-radius:3px;background-color:#E5E5E5;color:#555;cursor:pointer;" onclick="cancelReply();">取 消</span>');

    // 将当前评论ID传入隐藏表单
    var dataId = $(obj).attr("data-id");
    $("#commentId").attr("value",dataId);
}


/**
 * 回复评论时将表单文本改为更友好的方式（被回复评论人的名字）
 * @param  {String} cont 将要替换的文本
 * @return {Null}
 */
function changeCont( cont )
{
    $("#reply").html( cont );
}


/**
 * 取消回复评论
 * @return {Null} [description]
 */
function cancelReply()
{
    changeCont('<label>评论：</label>');
    $("#commentId").attr("value","");
}


/**
 * 动态获取评论后加载评论js效果
 */
function loadEffect()
{
    // 指针移动到原评论者名字上时到显示原评论
    $(".replyName>a").on("mouseover",function(){doc = this;t=setTimeout( '(function(that){$(that).next("div.replyCont").stop().fadeIn();})(doc)', 300 );});
    $(".replyName>a").on("mouseout",function(){clearTimeout(t);$(this).next("div.replyCont").stop().fadeOut();});
    
    // 指针移动到评论上时显示评论时间和回复按钮
    $(".comment-cont").on("mouseover mouseout",function(){$(this).find(".comment-date, .block-reply>a").stop().fadeToggle();});
}


/**
 * 显示评论
 */
function showComments()
{
    var conts='';
    for (var i = 0; i < comments.length-2; i++) {
        conts += '<div class="row comment-cont"><div class="col-md-1"><img class="img-rounded" src="/Public/images/1.jpg" style="width:100%;"></div><div class="col-md-11"><div class="col-md-12"><strong class="currName">'+comments[i].name+'</strong>';
                    if( comments[i].pname != null ){
                        conts += '<i style="color:#999;">&nbsp;To&nbsp;</i> <strong class="replyName"><a href="javascript:;" style="color: #999;font-weight: normal;">'+comments[i].pname+'</a><div class="replyCont" style="display:none;"><span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>'+comments[i].pcontent+'</div></strong>';
                    }
                    conts += '<i class="pull-right comment-date">'+comments[i].time+'</i></div><div class="currCont col-md-12">'+comments[i].content+'</div><div class="col-md-12 text-right block-reply"><a href="#comment" data-id="'+comments[i].id+'" onclick="setCommentId(this);">Reply</a></div></div></div>';
    };

    $("#comment-conts").html( conts );  // 显示评论
    loadEffect();                       // 加载评论动态效果
}


/**
 * 生成页数HTML内容并将生成的HTML插入对应区域
 * @param  {int} currPage 当前页号     
 */
function showCmntPage( currPage )
{
    var pageCont   = '';        // 分页HTML
    var visibleNum = 9;         // 在页面表示出来多少页 格式:1 2345678 9   
    var count      = parseInt( comments[comments.length-1] );       // 总评论数
    var pageCount  = parseInt( comments[comments.length-2] );       // 每页评论数
    var pageSum    = parseInt( Math.ceil( count/pageCount ) );      // 总页数
    var currPage   = parseInt( arguments[0] <= pageSum ? arguments[0] : 1 )   // 当前页 默认第一页 如果超出总页数设为第一页

    if( pageSum<9 ) {
        // 顺序输出所有页号
        for (var i = 1; i <= pageSum; i++) {
            if( i == currPage ) {
                pageCont += '<a class="curr" href="javascript:;">'+i+'</a>';
            } else {
                pageCont += '<a href="javascript:;">'+i+'</a>';
            }
        }
    } else if( pageSum>9 ) {
        if( currPage<=5 ) {
            // 前8页
            for (var i = 1; i < 9; i++) {
                if( i == currPage ) {
                    pageCont += '<a class="curr" href="javascript:;">'+i+'</a>';
                } else {
                    pageCont += '<a href="javascript:;">'+i+'</a>';
                }
            }
            // 最后一页
            pageCont += '<span></span><a href="javascript:;">'+pageSum+'</a>';
        } else if( currPage>pageSum-5 ) {
            // 第一页
            pageCont += '<a href="javascript:;">1</a><span></span>';
            // 后8页
            for (var i = pageSum-7; i <= pageSum; i++) {
                if( i == currPage ) {
                    pageCont += '<a class="curr" href="javascript:;">'+i+'</a>';
                } else {
                    pageCont += '<a href="javascript:;">'+i+'</a>';
                }
            }
        } else {
            // 第一页
            pageCont += '<a href="javascript:;">1</a><span></span>'; //6  3~9
            // 中间7页 当前页左右各3页
            for (var i = (currPage-3); i <= (currPage+3); i++) {
                if( i == currPage ) {
                    pageCont += '<a class="curr" href="javascript:;">'+i+'</a>';
                } else {
                    pageCont += '<a href="javascript:;">'+i+'</a>';
                }
            }
            // 最后一页
            pageCont += '<span></span><a href="javascript:;">'+pageSum+'</a>';
        }
    }
    $("#comment>.page").html(pageCont);
}


/**
 * 动态生成Page后加载Page效果
 * @param  int aid 文章ID
 */
function loadPageEff( aid )
{
    $("#comment>.page a").each(function(){
        var currPage = parseInt( $(this).text() );
        $(this).click(function(){
            getComments( aid, currPage );
        });
    });
}


/**
 * 页面加载评论
 * @param  {int} aid      当前文章ID
 * @param  {int} currPage 要取得的评论分页号
 */
function getComments( aid, currPage ){
    var aid = aid;
    var currPage   = arguments[1] ? arguments[1] : 1;   // 当前页 默认第一页
    $.get("/comments/aid/"+aid+"/cur/"+currPage,function(data,status){
        if( status == 'success' ){
            comments = eval(data);      // 将获取到的JSON数据转换为JS对象
            showComments();             // 显示评论
            showCmntPage( currPage );   // 显示分页
            loadPageEff( aid );         // 加载分页效果
        }
    });
}