var index_tags_names = ["CSS笔记", "JavaScript笔记", "元素周期表", "APP下载", "网页小游戏"];
var index_tags_names_in_short = ["CSS", "JS", "周期表", "APP", "游戏"];
var index_tags_addresses = ["//zmbunny.com/CSS3/index.html", "//zmbunny.com/JavaScript/index.html"
    , "//zmbunny.com/PTE/PTE.html", "//zmbunny.com/appDownload/index.html", "//zmbunny.com/games/index.html"];

//导航栏与主体
!function addNavigator() {
    var bodyTag = document.getElementsByTagName("body")[0];
    var navigatorDiv = document.createElement("div");
    navigatorDiv.setAttribute("id", "navigator");
    bodyTag.insertBefore(navigatorDiv,bodyTag.firstElementChild);

    var logoAnchor = document.createElement("a");
    logoAnchor.setAttribute("id", "logo-navigator");
    logoAnchor.setAttribute("href", "//zmbunny.com/index.html");
    navigatorDiv.appendChild(logoAnchor);

    var anchorContainer = document.createElement("div");
    anchorContainer.setAttribute("class","container-navigator");
    navigatorDiv.appendChild(anchorContainer);

    for (var i = 0; i < index_tags_addresses.length; i++) {
        var anchor = document.createElement("a");
        anchor.setAttribute("class", "normal-navigator");
        anchor.setAttribute("href", index_tags_addresses[i]);
        anchor.innerHTML = index_tags_names_in_short[i];
        anchorContainer.appendChild(anchor);
    }
}();