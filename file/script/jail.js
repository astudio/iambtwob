(function(e,t){var n=t(jQuery),r=typeof define=="function"&&define.amd;r?define(e,["jquery"],n):(this.jQuery||this.$||this)[e]=n})("jail",function(e){function s(e,n){var r=!1;!n||(r=n.data("triggerElem")),!!r&&typeof r.bind=="function"&&(r.bind(e.event,{options:e,images:n},u),t.bind("resize",{options:e,images:n},u))}function o(e){var t=0;if(e.length===0)return;for(;;){if(t===e.length)break;e[t].getAttribute("data-src")?t++:e.splice(t,1)}}function u(n){var i=n.data.images,u=n.data.options;i.data("poller",setTimeout(function(){r=e.extend({},i),o(r),e(r).each(function(){if(this===window)return;f(u,this,r)});if(a(r)){e(n.currentTarget).unbind(n.type);return}if(u.event!=="scroll"){var l=/scroll/i.test(u.event)?i.data("triggerElem"):t;u.event="scroll",i.data("triggerElem",l),s(u,e(r))}},u.timeout))}function a(t){var n=!0;return e(t).each(function(){!e(this).attr("data-src")||(n=!1)}),n}function f(n,r,i){var s=e(r),o=/scroll/i.test(n.event)?i.data("triggerElem"):t,u=!0;n.loadHiddenImages||(u=h(s,o,n)&&s.is(":visible")),u&&l(o,s,n.offset)&&c(n,s)}function l(e,t,n){var r=e[0]===window,i=r?{top:0,left:0}:e.offset(),s=i.top+(r?e.scrollTop():0),o=i.left+(r?e.scrollLeft():0),u=o+e.width(),a=s+e.height(),f=t.offset(),l=t.width(),c=t.height();return s-n<=f.top+c&&a+n>=f.top&&o-n<=f.left+l&&u+n>=f.left}function c(t,n){var s=new Image;s.onload=function(){n.hide().attr("src",s.src),n.removeAttr("data-src"),t.effect?(t.speed?n[t.effect](t.speed):n[t.effect](),n.css("opacity",1),n.show()):n.show(),o(r),!t.callbackAfterEachImage||t.callbackAfterEachImage.call(this,n,t),a(r)&&!!t.callback&&!i&&(t.callback.call(e.jail,t),i=!0)},s.src=n.attr("data-src")}function h(n,i,o){var u=n.parent(),a=!0;while(u.length&&u.get(0).nodeName.toUpperCase()!=="BODY"){if(u.css("overflow")==="hidden"){if(!l(u,n,o.offset)){a=!1;break}}else if(u.css("overflow")==="scroll"&&!l(u,n,o.offset)){a=!1,e(r).data("triggerElem",u),o.event="scroll",s(o,e(r));break}if(u.css("visibility")==="hidden"||n.css("visibility")==="hidden"){a=!1;break}if(i!==t&&u===i)break;u=u.parent()}return a}var t=e(window),n={timeout:1,effect:!1,speed:400,triggerElement:null,offset:0,event:"load",callback:null,callbackAfterEachImage:null,placeholder:!1,loadHiddenImages:!1},r=[],i=!1;return e.jail=function(t,r){var i=t||{},s=e.extend({},n,r);e.jail.prototype.init(i,s),/^(load|scroll)/.test(s.event)?e.jail.prototype.later.call(i,s):e.jail.prototype.onEvent.call(i,s)},e.jail.prototype.init=function(n,r){n.data("triggerElem",r.triggerElement?e(r.triggerElement):t),!r.placeholder||n.each(function(){e(this).attr("src",r.placeholder)})},e.jail.prototype.onEvent=function(t){var n=this;t.triggerElement?s(t,n):n.bind(t.event,{options:t,images:n},function(t){var n=e(this),i=t.data.options,s=t.data.images;r=e.extend({},s),c(i,n),e(t.currentTarget).unbind(t.type)})},e.jail.prototype.later=function(t){var n=this;setTimeout(function(){r=e.extend({},n),n.each(function(){f(t,this,n)}),t.event="scroll",s(t,n)},t.timeout)},e.fn.jail=function(t){return new e.jail(this,t),r=[],this},e.jail});