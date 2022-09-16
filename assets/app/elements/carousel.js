"use strict";
$(function () {
	var t = "rtl" === $("html").attr("dir"),
		n = {
			prev: "fa fa-angle-".concat(t ? "right" : "left"),
			next: "fa fa-angle-".concat(t ? "left" : "right"),
		};
	$("#slick-1").slick({ rtl: t }),
		$("#slick-2").slick({ rtl: t, slidesToShow: 3, slidesToScroll: 2 }),
		$("#slick-3").slick({
			rtl: t,
			centerMode: !0,
			prevArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-prev-2">\n        <i class="'.concat(
					n.prev,
					'"></i>\n      </button>\n    '
				),
			nextArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-next-2">\n        <i class="'.concat(
					n.next,
					'"></i>\n      </button>\n    '
				),
		}),
		$("#slick-4").slick({
			rtl: t,
			prevArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-prev-3">\n        <i class="'.concat(
					n.prev,
					'"></i>\n      </button>\n    '
				),
			nextArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-next-3">\n        <i class="'.concat(
					n.next,
					'"></i>\n      </button>\n    '
				),
		}),
		$("#slick-5").slick({
			rtl: t,
			autoplay: !0,
			autoplaySpeed: 1e3,
			slidesToShow: 2,
		}),
		$("#slick-6").slick({ rtl: t, dots: !0 }),
		$("#slick-7-for").slick({ rtl: t, arrows: !1, asNavFor: "#slick-7-nav" }),
		$("#slick-7-nav").slick({
			rtl: t,
			centerMode: !0,
			slidesToShow: 3,
			asNavFor: "#slick-7-for",
			focusOnSelect: !0,
			prevArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-prev-2">\n        <i class="'.concat(
					n.prev,
					'"></i>\n      </button>\n    '
				),
			nextArrow:
				'\n      <button type="button" class="btn btn-flat-primary slick-next-2">\n        <i class="'.concat(
					n.next,
					'"></i>\n      </button>\n    '
				),
		});
});
