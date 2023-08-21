// with jquery-3.6.0.min.js before this

/**
 * use this frame by add '<script src="/Js/jquery-3.6.0.min.js"></script>' in <head>
 */
$(function () {

    // frame style
    var bodyWidth = 1200;
    var bodyCss = {
        "width": bodyWidth + "px",
        "min-height": "85vh",
        "background-color": "#24334a",
        "color": "#eeeeee"
    };
    $("body").css(bodyCss);
    $("*").css({"margin": "0", "padding": "0", "border": "0", "box-sizing": "border-box"});
    $("a").css({"text-decoration": "none"});
    $("div").css({"display": "inline-block"});
    $(".odm_extension").css({"display": "none"});
    $(".mpa-sc").css({"display": "none"});
    $("head").append("<link rel=\"shortcut icon\" href=\"//zmbunny.com/pictures/shortcutLogo.png\"/>");

    // navigator
    var index_tags_names = ["CSS笔记", "JavaScript笔记", "元素周期表", "APP下载", "网页小游戏"];
    var index_tags_names_in_short = ["CSS", "JS", "周期表", "APP", "游戏"];
    var index_tags_addresses = ["//zmbunny.com/CSS3/index.html", "//zmbunny.com/JavaScript/index.html"
        , "//zmbunny.com/PTE/PTE.html", "//zmbunny.com/appDownload/index.html", "//zmbunny.com/games/index.html"];
    !function addNavigator() {
        var bodyTag = $("body");
        var navigatorDiv = document.createElement("div");
        $(navigatorDiv).prop("id", "navigator");
        $(bodyTag).prepend(navigatorDiv);

        var logoAnchor = document.createElement("a");
        $(logoAnchor).prop("id", "logo-navigator");
        $(logoAnchor).prop("href", "//zmbunny.com/index.html");
        $(navigatorDiv).append(logoAnchor);

        var anchorContainer = document.createElement("div");
        $(anchorContainer).prop("class", "container-navigator");
        $(navigatorDiv).append(anchorContainer);

        for (var i = 0; i < index_tags_addresses.length; i++) {
            var anchor = document.createElement("a");
            $(anchor).prop("class", "normal-navigator");
            $(anchor).prop("href", index_tags_addresses[i]);
            $(anchor).text(index_tags_names_in_short[i]);
            $(anchorContainer).append(anchor);
        }
    }();
    $("#navigator").css({
        "position": "relative",
        "top": "0",
        "width": "100%",
        "height": "55px",
        "background": "#000000",
        "white-space": "nowrap",
        "overflow": "hidden",
    });
    $("#navigator::-webkit-scrollbar").css({"display": "none",});
    $("#logo-navigator").css({
        "display": "inline",
        "float": "left",
        "width": "200px",
        "height": "55px",
        "background": "url(\"//zmbunny.com/pictures/logo.png\") no-repeat",
    });
    $(".container-navigator").css({"height": "55px",});
    $(".normal-navigator").css({
        "display": "inline",
        "float": "left",
        "width": "50px",
        "height": "55px",
        "line-height": "55px",
        "text-align": "center",
        "font-size": "12px",
        "color": "#a8afbe",
        "text-decoration": "none",
        "background": "url(\"//zmbunny.com/pictures/La.png\")",
    });
    $(".normal-navigator:hover").css({
        "background": "url(\"//zmbunny.com/pictures/p3.png\")",
        "transform": "scale(1.01)",
        "transition": "0.15s",
    });

    // fill the page
    !function fillThePage() {
        var old = $("body").children();
        var d = document.createElement("div");
        $(d).prop("id", "body-container");
        $(d).css({
            "display": "block",
            "width": bodyWidth + "px",
            "margin": "auto",
            "min-height": "800px",
        });
        $("body").append(d);
        $(d).append(old);
        $("body").css({
            "margin": "auto",
        });
    }();

    // bottom bei an
    !function addBottomBeiAn() {
        var b = document.createElement("div");
        $(b).css({
            "position": " relative",
            "top": "15px",
            "height": "20px",
            "width": " 100%",
            "text-align": "center",
        });
        var bot = document.createElement("a");
        $(bot).prop("href", "\"http://beian.miit.gov.cn/\"");
        $(bot).prop("style", "color: #a8afbe;font-size: 16px;");
        $(bot).text("\u5180icp\u59072021007054\u53f7");
        $(b).append(bot);
        $("body").append(b);
    }();
});