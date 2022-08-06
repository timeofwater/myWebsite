!function addBottomBeiAn(){
    var b = document.createElement("div");
    b.setAttribute("style","position: relative;top: 150px;height: 20px;width: 100%;text-align: center;");

    var bot = document.createElement("a");
    bot.setAttribute("href","\"http://beian.miit.gov.cn/\"");
    bot.setAttribute("style","color: #a8afbe;font-size: 16px;");
    bot.innerText = "\u5180icp\u59072021007054\u53f7";

    b.appendChild(bot);
    document.body.appendChild(b);
}();