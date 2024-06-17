addEventListener("popstate",function(e){
    console.log("back?");
    console.log(e);
    const contentHeader = e.state ? e.state.contentHeader : null;//obj.getHeaderLoginPage();
    const contentMain = e.state ? e.state.contentMain : null;//obj.getMainPage();
    //$("#block-login").html(contentHeader);
    $("#menu-header").html(contentHeader);
    $("#main_content").html(contentMain);
},false);

$(document).ready( async function() {
    console.log("script");
});