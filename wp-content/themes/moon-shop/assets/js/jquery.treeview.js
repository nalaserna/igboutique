/*
 * Treeview 1.4.2 - jQuery plugin to hide and show branches of a tree
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-treeview/
 *
 * Copyright Jörn Zaefferer
 * Released under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 */
!function (a) {
    a.extend(a.fn, {swapClass: function (a, e) {
        var l = this.filter("." + a);
        return this.filter("." + e).removeClass(e).addClass(a), l.removeClass(a).addClass(e), this
    }, replaceClass: function (a, e) {
        return this.filter("." + a).removeClass(a).addClass(e).end()
    }, hoverClass: function (e) {
        return e = e || "hover", this.hover(function () {
            a(this).addClass(e)
        }, function () {
            a(this).removeClass(e)
        })
    }, heightToggle: function (a, e) {
        a ? this.animate({height: "toggle"}, a, e) : this.each(function () {
            jQuery(this)[jQuery(this).is(":hidden") ? "show" : "hide"](), e && e.apply(this, arguments)
        })
    }, heightHide: function (a, e) {
        a ? this.animate({height: "hide"}, a, e) : (this.hide(), e && this.each(e))
    }, prepareBranches: function (a) {
        return a.prerendered || (this.filter(":last-child:not(ul)").addClass(e.last), this.filter((a.collapsed ? "" : "." + e.closed) + ":not(." + e.open + ")").find(">ul").hide()), this.filter(":has(>ul)")
    }, applyClasses: function (l, s) {
        if (this.filter(":has(>ul):not(:has(>a))").find(">span").unbind("click.treeview").bind("click.treeview",function (e) {
            this == e.target && s.apply(a(this).next())
        }).add(a("a", this)).hoverClass(), !l.prerendered) {
            this.filter(":has(>ul:hidden)").addClass(e.expandable).replaceClass(e.last, e.lastExpandable), this.not(":has(>ul:hidden)").addClass(e.collapsable).replaceClass(e.last, e.lastCollapsable);
            var t = this.find("div." + e.hitarea);
            t.length || (t = this.prepend('<div class="' + e.hitarea + '"/>').find("div." + e.hitarea)), t.removeClass().addClass(e.hitarea).each(function () {
                var e = "";
                a.each(a(this).parent().attr("class").split(" "), function () {
                    e += this + "-hitarea "
                }), a(this).addClass(e)
            })
        }
        this.find("div." + e.hitarea).click(s)
    }, treeview: function (l) {
        function s(l, s) {
            function i(s) {
                return function () {
                    return t.apply(a("div." + e.hitarea, l).filter(function () {
                        return s ? a(this).parent("." + s).length : !0
                    })), !1
                }
            }

            a("a:eq(0)", s).click(i(e.collapsable)), a("a:eq(1)", s).click(i(e.expandable)), a("a:eq(2)", s).click(i())
        }

        function t() {
            a(this).parent().find(">.hitarea").swapClass(e.collapsableHitarea, e.expandableHitarea).swapClass(e.lastCollapsableHitarea, e.lastExpandableHitarea).end().swapClass(e.collapsable, e.expandable).swapClass(e.lastCollapsable, e.lastExpandable).find(">ul").heightToggle(l.animated, l.toggle), l.unique && a(this).parent().siblings().find(">.hitarea").replaceClass(e.collapsableHitarea, e.expandableHitarea).replaceClass(e.lastCollapsableHitarea, e.lastExpandableHitarea).end().replaceClass(e.collapsable, e.expandable).replaceClass(e.lastCollapsable, e.lastExpandable).find(">ul").heightHide(l.animated, l.toggle)
        }

        function i() {
            var e = [];
            o.each(function (l, s) {
                e[l] = a(s).is(":has(>ul:visible)") ? 1 : 0
            }), a.cookie(l.cookieId, e.join(""), l.cookieOptions)
        }

        function n() {
            var e = a.cookie(l.cookieId);
            if (e) {
                var s = e.split("");
                o.each(function (e, l) {
                    a(l).find(">ul")[parseInt(s[e]) ? "show" : "hide"]()
                })
            }
        }

        if (l = a.extend({cookieId: "treeview"}, l), l.toggle) {
            var r = l.toggle;
            l.toggle = function () {
                return r.apply(a(this).parent()[0], arguments)
            }
        }
        this.data("toggler", t), this.addClass("treeview");
        var o = this.find("li").prepareBranches(l);
        switch (l.persist) {
            case"cookie":
                var d = l.toggle;
                l.toggle = function () {
                    i(), d && d.apply(this, arguments)
                }, n();
                break;
            case"location":
                var h = this.find("a").filter(function () {
                    return 0 == location.href.toLowerCase().indexOf(this.href.toLowerCase())
                });
                if (h.length) {
                    var p = h.addClass("selected").parents("ul, li").add(h.next()).show();
                    l.prerendered && p.filter("li").swapClass(e.collapsable, e.expandable).swapClass(e.lastCollapsable, e.lastExpandable).find(">.hitarea").swapClass(e.collapsableHitarea, e.expandableHitarea).swapClass(e.lastCollapsableHitarea, e.lastExpandableHitarea)
                }
        }
        return o.applyClasses(l, t), l.control && (s(this, l.control), a(l.control).show()), this
    }}), a.treeview = {};
    var e = a.treeview.classes = {open: "open", closed: "closed", expandable: "expandable", expandableHitarea: "expandable-hitarea", lastExpandableHitarea: "lastExpandable-hitarea", collapsable: "collapsable", collapsableHitarea: "collapsable-hitarea", lastCollapsableHitarea: "lastCollapsable-hitarea", lastCollapsable: "lastCollapsable", lastExpandable: "lastExpandable", last: "last", hitarea: "hitarea"}
}(jQuery);