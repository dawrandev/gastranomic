// Load saved settings from localStorage
function restoreSavedSettings() {
    // Restore color
    if (localStorage.getItem("color"))
        $("#color").attr("href", "../assets/css/" + localStorage.getItem("color") + ".css");

    // Restore dark mode
    if (localStorage.getItem("dark"))
        $("body").attr("class", "dark-only");

    // Restore layout
    if (localStorage.getItem("main-layout")) {
        var layout = localStorage.getItem("main-layout");
        $(".main-layout li").removeClass('active');
        $(".main-layout li[data-attr='" + layout + "']").addClass("active");
        $("body").attr("class", layout);
        $("html").attr("dir", layout);
    }

    // Restore page wrapper
    if (localStorage.getItem("page-wrapper")) {
        var pageWrapper = localStorage.getItem("page-wrapper");
        $(".page-wrapper").attr("class", "page-wrapper " + pageWrapper);
    }

    // Restore sidebar setting
    if (localStorage.getItem("sidebar-setting")) {
        var sidebarSetting = localStorage.getItem("sidebar-setting");
        $(".sidebar-setting li").removeClass('active');
        $(".sidebar-setting li[data-attr='" + sidebarSetting + "']").addClass("active");
        $(".sidebar-wrapper").attr("sidebar-layout", sidebarSetting);
    }

    // Restore mix layout
    if (localStorage.getItem("mix-layout")) {
        var mixLayout = localStorage.getItem("mix-layout");
        $(".customizer-mix li").removeClass('active');
        $(".customizer-mix li[data-attr='" + mixLayout + "']").addClass("active");
        $("body").attr("class", mixLayout);
    }

    // Restore primary and secondary colors
    if (localStorage.getItem("primary") != null) {
        document.documentElement.style.setProperty('--theme-deafult', localStorage.getItem("primary"));
        document.documentElement.style.setProperty('--theme-primary', localStorage.getItem("primary"));
        if (document.getElementById("ColorPicker1"))
            document.getElementById("ColorPicker1").value = localStorage.getItem("primary");
    }
    if (localStorage.getItem("secondary") != null) {
        document.documentElement.style.setProperty('--theme-secondary', localStorage.getItem("secondary"));
        if (document.getElementById("ColorPicker2"))
            document.getElementById("ColorPicker2").value = localStorage.getItem("secondary");
    }
}

// Restore settings on page load
restoreSavedSettings();

$('<div class="customizer-links"><div class="nav flex-column nac-pills" id="c-pills-tab" role="tablist" aria-orientation="vertical"> <a class="nav-link" id="c-pills-home-tab" data-bs-toggle="pill" href="#c-pills-home" role="tab" aria-controls="c-pills-home" aria-selected="true" data-original-title="" title=""><div class="settings"><i class="icon-settings"></i></div> <span>Параметры</span> </a></div></div><div class="customizer-contain"><div class="tab-content" id="c-pills-tabContent"><div class="customizer-header"> <i class="icofont-close icon-close"></i><h5>Параметры дизайна</h5><p class="mb-0">Выберите тему <i class="fa fa-thumbs-o-up txt-primary"></i></p></div><div class="customizer-body custom-scrollbar"><div class="tab-pane fade show active" id="c-pills-home" role="tabpanel" aria-labelledby="c-pills-home-tab"><h6>Тип макета</h6><ul class="main-layout layout-grid"><li data-attr="ltr" class="active"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-light sidebar"></li><li class="bg-light body"><span class="badge badge-primary">LTR</span></li></ul></div></li><li data-attr="rtl"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-light body"><span class="badge badge-primary">RTL</span></li><li class="bg-light sidebar"></li></ul></div></li><li data-attr="ltr" class="box-layout px-3"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-light sidebar"></li><li class="bg-light body"><span class="badge badge-primary">Box</span></li></ul></div></li></ul><h6 class="">Тип боковой панели</h6><ul class="sidebar-type layout-grid"><li data-attr="normal-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-dark sidebar"></li><li class="bg-light body"></li></ul></div></li><li data-attr="compact-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-dark sidebar compact"></li><li class="bg-light body"></li></ul></div></li></ul><h6 class="">Параметры боковой панели</h6><ul class="sidebar-setting layout-grid"><li class="active" data-attr="default-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body bg-light"><span class="badge badge-primary">Стандартная</span></div></li><li data-attr="border-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body bg-light"><span class="badge badge-primary">Граница</span></div></li><li data-attr="iconcolor-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body bg-light"><span class="badge badge-primary">Цвет значков</span></div></li></ul><h6 class="">Цвет</h6><ul class="layout-grid unlimited-color-layout"> <input id="ColorPicker1" type="color" value="#7366ff" name="Background" /> <input id="ColorPicker2" type="color" value="#f73164" name="Background" /> <button type="button" class="color-apply-btn btn btn-primary color-apply-btn">Применить</button></ul><h6>Светлая тема</h6><ul class="layout-grid customizer-color"><li class="color-layout" data-attr="color-1" data-primary="#7366ff" data-secondary="#f73164"><div></div></li><li class="color-layout" data-attr="color-2" data-primary="#4831D4" data-secondary="#ea2087"><div></div></li><li class="color-layout" data-attr="color-3" data-primary="#d64dcf" data-secondary="#8e24aa"><div></div></li><li class="color-layout" data-attr="color-4" data-primary="#4c2fbf" data-secondary="#2e9de4"><div></div></li><li class="color-layout" data-attr="color-5" data-primary="#7c4dff" data-secondary="#7b1fa2"><div></div></li><li class="color-layout" data-attr="color-6" data-primary="#3949ab" data-secondary="#4fc3f7"><div></div></li></ul><h6 class="">Тёмная тема</h6><ul class="layout-grid customizer-color dark"><li class="color-layout" data-attr="color-1" data-primary="#4466f2" data-secondary="#1ea6ec"><div></div></li><li class="color-layout" data-attr="color-2" data-primary="#4831D4" data-secondary="#ea2087"><div></div></li><li class="color-layout" data-attr="color-3" data-primary="#d64dcf" data-secondary="#8e24aa"><div></div></li><li class="color-layout" data-attr="color-4" data-primary="#4c2fbf" data-secondary="#2e9de4"><div></div></li><li class="color-layout" data-attr="color-5" data-primary="#7c4dff" data-secondary="#7b1fa2"><div></div></li><li class="color-layout" data-attr="color-6" data-primary="#3949ab" data-secondary="#4fc3f7"><div></div></li></ul><h6 class="">Смешанная тема</h6><ul class="layout-grid customizer-mix"><li class="color-layout active" data-attr="light-only"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-light sidebar"></li><li class="bg-light body"></li></ul></div></li><li class="color-layout" data-attr="dark-sidebar"><div class="header bg-light"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-dark sidebar"></li><li class="bg-light body"></li></ul></div></li><li class="color-layout" data-attr="dark-only"><div class="header bg-dark"><ul><li></li><li></li><li></li></ul></div><div class="body"><ul><li class="bg-dark sidebar"></li><li class="bg-dark body"></li></ul></div></li></ul><hr style="margin: 20px 0;"><h6>Восстановить по умолчанию</h6><button type="button" class="btn btn-warning btn-sm reset-customizer-btn w-100"><i class="fa fa-undo me-2"></i>Сбросить все настройки</button></div></div></div></div>').appendTo($('body'));

$(document).ready(function () {

    $(".customizer-color li").on('click', function () {
        $(".customizer-color li").removeClass('active');
        $(this).addClass("active");
        var color = $(this).attr("data-attr");
        var primary = $(this).attr("data-primary");
        var secondary = $(this).attr("data-secondary");
        localStorage.setItem("color", color);
        localStorage.setItem("primary", primary);
        localStorage.setItem("secondary", secondary);
        localStorage.removeItem("dark");
        $("#color").attr("href", "../assets/css/" + color + ".css");
        $(".dark-only").removeClass('dark-only');
        location.reload(true);
    });

    $(".customizer-color.dark li").on('click', function () {
        $(".customizer-color.dark li").removeClass('active');
        $(this).addClass("active");
        $("body").attr("class", "dark-only");
        localStorage.setItem("dark", "dark-only");
    });

    $(".customizer-links #c-pills-home-tab").click(function () {
        $(".customizer-contain").addClass("open");
        $(".customizer-links").addClass("open");
    });

    $(".customizer-contain .icon-close").on('click', function () {
        $(".customizer-contain").removeClass("open");
        $(".customizer-links").removeClass("open");
    });

    $(".color-apply-btn").click(function () {
        location.reload(true);
    });

    $(".reset-customizer-btn").click(function () {
        if (confirm("Вы уверены? Все настройки будут восстановлены по умолчанию.")) {
            // Clear all localStorage settings
            localStorage.removeItem("color");
            localStorage.removeItem("primary");
            localStorage.removeItem("secondary");
            localStorage.removeItem("dark");
            localStorage.removeItem("main-layout");
            localStorage.removeItem("page-wrapper");
            localStorage.removeItem("sidebar-setting");
            localStorage.removeItem("mix-layout");

            // Reload page to apply defaults
            location.reload(true);
        }
    });

    var primary = document.getElementById("ColorPicker1").value;
    document.getElementById("ColorPicker1").onchange = function () {
        primary = this.value;
        localStorage.setItem("primary", primary);
        document.documentElement.style.setProperty('--theme-primary', primary);
    };

    var secondary = document.getElementById("ColorPicker2").value;
    document.getElementById("ColorPicker2").onchange = function () {
        secondary = this.value;
        localStorage.setItem("secondary", secondary);
        document.documentElement.style.setProperty('--theme-secondary', secondary);
    };

    $(".customizer-mix li").on('click', function () {
        $(".customizer-mix li").removeClass('active');
        $(this).addClass("active");
        var mixLayout = $(this).attr("data-attr");
        $("body").attr("class", mixLayout);
        localStorage.setItem("mix-layout", mixLayout);
    });

    $('.sidebar-setting li').on('click', function () {
        $(".sidebar-setting li").removeClass('active');
        $(this).addClass("active");
        var sidebar = $(this).attr("data-attr");
        $(".sidebar-wrapper").attr("sidebar-layout", sidebar);
        localStorage.setItem("sidebar-setting", sidebar);
    });

    $('.sidebar-type li').on('click', function () {
        $("body").append('');
        console.log("test");
        var type = $(this).attr("data-attr");

        var boxed = "";
        if ($(".page-wrapper").hasClass("box-layout")) {
            boxed = "box-layout";
        }
        switch (type) {
            case 'compact-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                $(this).addClass("active");
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }
            case 'normal-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper " + boxed);
                $(".logo-wrapper").find('img').attr('src', '../assets/images/logo/logo.png');
                localStorage.setItem('page-wrapper', 'horizontal-wrapper');
                break;
            }
            case 'default-body': {
                $(".page-wrapper").attr("class", "page-wrapper  only-body" + boxed);
                localStorage.setItem('page-wrapper', 'only-body');
                break;
            }
            case 'dark-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper dark-sidebar');
                break;
            }
            case 'compact-wrap': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar');
                break;
            }
            case 'color-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper color-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper color-sidebar');
                break;
            }
            case 'compact-small': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small');
                break;
            }
            case 'box-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper box-layout " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper box-layout');
                break;
            }
            case 'enterprice-type': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type');
                break;
            }
            case 'modern-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper modern-type" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper modern-type');
                break;
            }
            case 'material-layout': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper material-type" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper material-type');
                break;
            }
            case 'material-icon': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small material-icon" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small material-icon');
                break;
            }
            case 'advance-type': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type advance-layout" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type advance-layout');
                break;
            }
            default: {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }
        }
        location.reload(true);
    });

    $('.main-layout li').on('click', function () {
        $(".main-layout li").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", layout);
        $("html").attr("dir", layout);
        localStorage.setItem("main-layout", layout);
    });

    $('.main-layout .box-layout').on('click', function () {
        $(".main-layout .box-layout").removeClass('active');
        $(this).addClass("active");
        var layout = $(this).attr("data-attr");
        $("body").attr("class", "box-layout");
        $("html").attr("dir", layout);
        localStorage.setItem("main-layout", layout);
    });

});
