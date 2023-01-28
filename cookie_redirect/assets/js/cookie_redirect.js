setInterval(function () {
    if (document.cookie.indexOf("url") < 0) {
        window.location.href = cookie_object.redirect_page;
        console.log("cookie Not exists")
    }
    else {
        console.log("cookie exists")
    }
    }, cookie_object.interval_timeout * 1000);