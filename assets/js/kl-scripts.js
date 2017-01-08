var domainroot = "",
    hasChaser = 1;
! function(e, a, t) {
    "use strict";

    function n(a) {
        e.ajax({
            type: a.attr("method"),
            url: a.attr("action"),
            data: a.serialize(),
            cache: !1,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function(a) {
                var t = e('<span class="alert alert-danger"><button type="button" class="close icon-close" data-dismiss="alert" aria-hidden="true"></button>Could not connect to server. Please try again later.</span>');
                e("#notification_container").html(t), setTimeout(function() {
                    t.addClass("animate")
                }, 300)
            },
            success: function(a) {
                if ("success" != a.result) {
                    var t = a.msg.substring(4),
                        n = e('<span class="alert alert-warning"><button type="button" class="close icon-close" data-dismiss="alert" aria-hidden="true"></button>' + t + "</span>");
                    e("#notification_container").html(n), setTimeout(function() {
                        n.addClass("animate")
                    }, 300)
                } else {
                    var t = a.msg,
                        n = e('<span class="success alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>' + t + "</span>");
                    e("#notification_container").html(n), setTimeout(function() {
                        n.addClass("animate")
                    }, 300)
                }
            }
        })
    }
    var i = e(a),
        o = e(t),
        s = e("#main-menu > ul"),
        l = 300,
        r = !1;
    if (1 == hasChaser) {
        s.clone().appendTo(t.body).wrap('<div class="chaser"><div class="container"><div class="row"><div class="col-md-12"></div></div></div></div>');
        var c = e("#content"),
            d = e("body .chaser");
        c && c.length > 0 && (l = c.first(), l = l.offset().top), o.scrollTop() > l && (d.addClass("visible"), r = !0), e(a).on("scroll", function() {
            !r && o.scrollTop() > l ? (d.addClass("visible"), r = !0) : r && o.scrollTop() < l && (d.removeClass("visible"), r = !1)
        })
    }
    var p = {
        added: !1,
        updateChaserMenu: function() {
            var a = e(".chaser"),
                t = e("#menu-main-menu", a);
            if (a.hasClass("visible") && !p.added) {
                var n = t.clone(!0);
                a.empty();
                var i = e(".kl-top-header"),
                    o = e(".logo-container"),
                    s = e("#ctabutton"),
                    l = i.clone(!0),
                    r = o.clone(!0),
                    c = s.clone(!0);
                a.append('<div class="container"><div class="row" id="chaserMenuRow"></div></div>'), e("#chaserMenuRow", a).append('<div class="col-sm-2 col-md-2" id="left-container"></div>').append('<div class="col-sm-10 col-md-10" id="right-container"></div>'), e("#left-container").append(r), e("#right-container").append('<div id="_wpk-custom-bar" class="col-sm-12 col-md-12"></div>').append('<div id="wpk-main-menu" class="col-sm-11 col-md-11"></div>').append('<div id="_wpk-cta-button" class="col-sm-1 col-md-1"></div>'), e("#_wpk-custom-bar").append(l), e("#wpk-main-menu").append(n), e("#_wpk-cta-button").append(c), p.added = !0
            }
        }
    };
    e(a).scroll(function() {
        p.updateChaserMenu()
    });
    var u = e("#page_wrapper"),
        m = e(".zn-res-trigger"),
        f = "Back",
        h = '<li class="zn_res_menu_go_back"><span class="zn_res_back_icon glyphicon glyphicon-chevron-left"></span><a href="#">' + f + "</a></li>",
        g = e("#main-menu > ul").clone().attr({
            id: "zn-res-menu",
            "class": ""
        }),
        v = function() {
            var a = g.prependTo(u);
            m.click(function(e) {
                e.preventDefault(), a.addClass("zn-menu-visible"), b()
            }), a.find('a:not([rel*="mfp-"])').on("click", function(a) {
                e(".zn_res_menu_go_back").first().trigger("click")
            }), a.find("li:has(> ul)").addClass("zn_res_has_submenu").prepend('<span class="zn_res_submenu_trigger glyphicon glyphicon-chevron-right"></span>'), a.find(".zn_res_has_submenu > ul").addBack().prepend(h), e(".zn_res_menu_go_back").click(function(a) {
                a.preventDefault();
                var t = e(this).closest(".zn-menu-visible");
                t.removeClass("zn-menu-visible"), b(), t.is("#zn-res-menu") && u.css({
                    height: "auto"
                })
            }), e(".zn_res_submenu_trigger").click(function(a) {
                a.preventDefault(), e(this).siblings("ul").addClass("zn-menu-visible"), b()
            })
        },
        b = function() {
            var t = e(".zn-menu-visible").last().css({
                    height: "auto"
                }).outerHeight(!0),
                n = e(a).height(),
                i = 0,
                o = e("#wpadminbar");
            n > t && (t = n, o.length > 0 && (i = o.outerHeight(!0), t -= i)), e(".zn-menu-visible").last().attr("style", ""), u.css({
                height: t
            })
        },
        y = !1,
        _ = function() {
            e(a).width() < 1200 ? (y || (v(), y = !0), u.addClass("zn_res_menu_visible")) : (e(".zn-menu-visible").removeClass("zn-menu-visible"), u.css({
                height: "auto"
            }).removeClass("zn_res_menu_visible"))
        };
    e(t).ready(function() {
        _()
    }), e(a).on("resize", function() {
        _()
    });
    var w = e("#search").children(".searchBtn"),
        C = w.next(),
        k = w.parent();
    if (w.click(function(a) {
            a.preventDefault();
            var t = e(this);
            t.hasClass("active") ? (t.removeClass("active").find("span").addClass("glyphicon-search icon-white").removeClass("glyphicon-remove"), C.hide()) : (t.addClass("active").find("span").removeClass("glyphicon-search icon-white").addClass("glyphicon-remove"), C.show())
        }), e(t).click(function() {
            w.removeClass("active").find("span").addClass("glyphicon-search icon-white").removeClass("glyphicon-remove"), C.hide(0)
        }), k.click(function(e) {
            e.stopPropagation()
        }), e("#totop").length) {
        var x = 100,
            P = function() {
                var t = e(a).scrollTop();
                t > x ? e("#totop").addClass("show") : e("#totop").removeClass("show")
            };
        P(), e(a).on("scroll", function() {
            P()
        }), e("#totop").on("click", function(a) {
            a.preventDefault(), e("html,body").animate({
                scrollTop: 0
            }, 700)
        })
    }
    e.ajax({
        url: "php_helpers/date.php",
        success: function(a) {
            e("#current-date").html(a)
        }
    }), e(".kl-video").each(function(a, t) {
        var n = e(t),
            i = n.next(".kl-video--controls"),
            o = i.find(".btn-toggleplay"),
            s = i.find(".btn-audio"),
            l = n.attr("data-setup"),
            r = "undefined" != typeof l ? JSON.parse(l) : "{}";
        if (1 == r.height_container && n.closest(".kl-video-container").css("height", n.height()), r.hasOwnProperty("muted") && 1 == r.muted && s.children("i").addClass("mute"), r.hasOwnProperty("autoplay") && 0 == r.autoplay && o.children("i").addClass("paused"), "undefined" != typeof video_background) {
            var c = new video_background(n, {
                position: r.hasOwnProperty("position") ? r.position : "absolute",
                "z-index": r.hasOwnProperty("zindex") ? r.zindex : "-1",
                loop: r.hasOwnProperty("loop") ? r.loop : !0,
                autoplay: r.hasOwnProperty("autoplay") ? r.autoplay : !1,
                muted: r.hasOwnProperty("muted") ? r.muted : !0,
                mp4: r.hasOwnProperty("mp4") ? r.mp4 : !1,
                webm: r.hasOwnProperty("webm") ? r.webm : !1,
                ogg: r.hasOwnProperty("ogg") ? r.ogg : !1,
                flv: r.hasOwnProperty("flv") ? r.flv : !1,
                fallback_image: r.hasOwnProperty("poster") ? r.poster : !1,
                youtube: r.hasOwnProperty("youtube") ? r.youtube : !1,
                priority: r.hasOwnProperty("priority") ? r.priority : "html5",
                video_ratio: r.hasOwnProperty("video_ratio") ? r.video_ratio : !1,
                sizing: r.hasOwnProperty("sizing") ? r.sizing : "fill",
                start: r.hasOwnProperty("start") ? r.start : 0
            });
            o.on("click", function(a) {
                a.preventDefault(), c.toggle_play(), e(this).children("i").toggleClass("paused")
            }), s.on("click", function(a) {
                a.preventDefault(), c.toggle_mute(), e(this).children("i").toggleClass("mute")
            })
        }
    }), "undefined" != typeof e.fn.magnificPopup && (e("a.kl-login-box").magnificPopup({
        type: "inline",
        closeBtnInside: !0,
        showCloseBtn: !0,
        mainClass: "mfp-fade mfp-bg-lighter"
    }), e('a[data-lightbox="image"]:not([data-type="video"])').each(function(a, t) {
        0 == e(t).parents(".gallery").length && e(t).magnificPopup({
            type: "image",
            tLoading: "",
            mainClass: "mfp-fade"
        })
    }), e(".mfp-gallery.images").each(function(a, t) {
        e(t).magnificPopup({
            delegate: "a",
            type: "image",
            gallery: {
                enabled: !0
            },
            tLoading: "",
            mainClass: "mfp-fade"
        })
    }), e('.mfp-gallery.misc a[data-lightbox="mfp"]').magnificPopup({
        mainClass: "mfp-fade",
        type: "image",
        gallery: {
            enabled: !0
        },
        tLoading: "",
        callbacks: {
            elementParse: function(a) {
                a.type = e(a.el).attr("data-mfp")
            }
        }
    }), e('a[data-lightbox="iframe"]').magnificPopup({
        type: "iframe",
        mainClass: "mfp-fade",
        tLoading: ""
    }), e('a[data-lightbox="inline"]').magnificPopup({
        type: "inline",
        mainClass: "mfp-fade",
        tLoading: ""
    }), e('a[data-lightbox="ajax"]').magnificPopup({
        type: "ajax",
        mainClass: "mfp-fade",
        tLoading: ""
    }), e('a[data-lightbox="youtube"], a[data-lightbox="vimeo"], a[data-lightbox="gmaps"], a[data-type="video"]').magnificPopup({
        disableOn: 700,
        type: "iframe",
        removalDelay: 160,
        preloader: !0,
        fixedContentPos: !1,
        mainClass: "mfp-fade",
        tLoading: ""
    }), e(".single_product_main_image .images a").magnificPopup({
        mainClass: "mfp-fade",
        type: "image",
        gallery: {
            enabled: !0
        },
        tLoading: ""
    }));
    var z = e(".flickrfeed"),
        O = z.find(".flickr_feeds");
    O && O.length && e.each(O, function(a, t) {
        var n = e(t),
            i = n.attr("data-limit") ? n.attr("data-limit") : 6,
            o = n.attr("data-fid");
        "undefined" != typeof e.fn.jflickrfeed && n.jflickrfeed({
            limit: i,
            qstrings: {
                id: o
            },
            itemTemplate: '<li><a href="{{image_b}}" data-lightbox="image"><img src="{{image_s}}" alt="{{title}}" /><span class="theHoverBorder"></span></a></li>'
        }, function(e) {
            n.find(" a[data-lightbox='image']").magnificPopup({
                type: "image",
                tLoading: ""
            }), n.parent().removeClass("loadingz")
        })
    }), e(".js-tonext-btn").on("click", function(a) {
        a.preventDefault();
        var t = e(this).attr("data-endof") ? e(this).attr("data-endof") : !1,
            n = 0;
        t && (n = e(t).height() + e(t).offset().top), e("html,body").animate({
            scrollTop: n
        }, 1e3, "easeOutExpo")
    });
    var T = function(e) {
            var a = e.find(".zn_blog_columns");
            0 != a.length && a.imagesLoaded(function() {
                a.isotope({
                    itemSelector: ".blog-isotope-item",
                    animationEngine: "jquery",
                    animationOptions: {
                        duration: 250,
                        easing: "easeOutExpo",
                        queue: !1
                    },
                    filter: "",
                    sortAscending: !0,
                    sortBy: ""
                })
            })
        },
        D = e(".zn_blog_archive_element");
    D && T(D), e(".shop-latest-carousel > ul").each(function(a, t) {
        e(this).carouFredSel({
            responsive: !0,
            scroll: 1,
            auto: !1,
            height: 437,
            items: {
                width: 260,
                visible: {
                    min: 1,
                    max: 4
                }
            },
            prev: {
                button: e(this).parent().find("a.prev"),
                key: "left"
            },
            next: {
                button: e(this).parent().find("a.next"),
                key: "right"
            }
        })
    });
    var j = function(a) {
            var t = a.find(".zn_limited_offers");
            t && "undefined" != typeof e.fn.carouFredSel && e.each(t, function(a, t) {
                var n = e(t);
                n.carouFredSel({
                    responsive: !0,
                    width: "92%",
                    scroll: 1,
                    items: {
                        width: 190,
                        visible: {
                            min: 2,
                            max: 4
                        }
                    },
                    prev: {
                        button: function() {
                            return n.closest(".limited-offers-carousel").find(".prev")
                        },
                        key: "left"
                    },
                    next: {
                        button: function() {
                            return n.closest(".limited-offers-carousel").find(".next")
                        },
                        key: "right"
                    }
                })
            })
        },
        E = e(".limited-offers-carousel");
    E && j(E);
    var L = e(".price-range-slider");
    e.each(L, function(a, t) {
        var n = e(this),
            i = n.parent().find(".price-result"),
            o = i.data("currency");
        n.slider({
            range: !0,
            min: 0,
            max: 500,
            values: [75, 300],
            slide: function(e, a) {
                i.val(o + a.values[0] + " - " + o + a.values[1])
            }
        }), i.val(o + n.slider("values", 0) + " - " + o + n.slider("values", 1))
    }), e.each(e(".contactForm form"), function(a, t) {
        var n = e(t),
            i = e('<div class="cf_response"></div>');
        n.prepend(i), n.h5Validate(), n.submit(function(a) {
            return a.preventDefault(), n.h5Validate("allValid") && (i.hide(), e.post(e(this).attr("action"), n.serialize(), function(e) {
                i.html(e).fadeIn("fast"), null != e.match("success") && n.get(0).reset()
            })), !1
        })
    });
    var O = e(".portfolio-item-more-toggle");
    O && e.each(O, function(a, t) {
        var n = e(t);
        n.on("click", function(e) {
            e.preventDefault(), e.stopPropagation();
            var a = n.parents(".portfolio-item-desc").first();
            a.toggleClass("is-opened")
        })
    }), O = e(".kl-contentmaps__panel-tgg"), O && O.each(function(a, t) {
        var n = e(t);
        n.on("click", function(a) {
            a.preventDefault(), a.stopPropagation();
            var t = e(n.data("target"));
            if (t) {
                var i = n.data("targetClass");
                i && t.toggleClass(i)
            }
        })
    }), O = e(".kl-iconbox"), O && e.each(O, function(a, t) {
        var n = e(t),
            i = e(n.data("targetElement"));
        i && n.on("mouseenter", function(e) {
            i.addClass("kl-ib-point-active")
        }).on("mouseleave", function() {
            i.removeClass("kl-ib-point-active")
        })
    });
    var B = e("#mc-embedded-subscribe-form");
    e("#mc-embedded-subscribe").on("click", function(e) {
        e && e.preventDefault(), n(B)
    }), e(".bubble-box").each(function(t, n) {
        var o = e(n),
            s = o.attr("data-reveal-at"),
            l = o.attr("data-hide-after"),
            r = 1e3;
        "undefined" == typeof s && s.length <= 0 && (s = r), i.smartscroll(function(t) {
            o.length > 0 && e(a).scrollTop() > s && !o.hasClass("bb--anim-show") && !o.hasClass("bb--anim-hide") && (o.addClass("bb--anim-show"), "undefined" != typeof l && l.length >= 0 && setTimeout(function() {
                o.removeClass("bb--anim-show").addClass("bb--anim-hide").one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function() {
                    e(this).remove()
                })
            }, l))
        }), o.find(".bb--close").on("click", function() {
            o.addClass("bb--anim-hide").one("animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd", function() {
                e(this).remove()
            })
        })
    }), e(".kl-pp-box[data-ppbox-timeout]").each(function(a, t) {
        var n = e(t),
            i = n.attr("data-ppbox-timeout"),
            o = "undefined" == typeof i && e(i).length <= 0 ? i : 8e3,
            s = n.attr("data-cookie-expire"),
            l = "undefined" != typeof s ? s : 2;
        if (!e.cookie("ppbox")) {
            setTimeout(function() {
                e.magnificPopup.open({
                    items: {
                        src: e(n.get(0))
                    },
                    type: "inline",
                    mainClass: "mfp-fade mfp-bg-lighter",
                    tLoading: ""
                })
            }, o)
        }
        e(t).find(".dontshow").on("click", function(a) {
            a.preventDefault(), e.cookie("ppbox", "hideit", {
                expires: parseInt(l),
                path: "/"
            }), e.magnificPopup.close()
        })
    }), e(".popup-with-form, .popup-with-form2, .popup-with-form3, .popup-thanks").magnificPopup({
        closeBtnInside: !0,
        type: "inline",
        preloader: !1,
        focus: "#name",
        callbacks: {
            beforeOpen: function() {
                e(a).width() < 700 ? this.st.focus = !1 : this.st.focus = "#name"
            }
        }
    });
    var A = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    A && (t.getElementsByTagName("body")[0].className += " is-safari"), twitterFetcher.fetch("350189033558798336", "twitterFeed", 1, !0, !1)
}(window.jQuery, window, document);
