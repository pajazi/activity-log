(()=>{var e,r={606:(e,r,t)=>{"use strict";t(771)},771:()=>{$(document).ready((function(){var e=$("#user-select"),r=e.data("url"),t=e.data("selected-id"),a=e.data("selected-text"),n=e.data("placeholder");if(e.select2({allowClear:!0,ajax:{url:r,delay:250,data:function(e){return{search:e.term}},processResults:function(e){return{results:$.map(null==e?void 0:e.data,(function(e){var r,t;return{text:(null!==(r=e.first_name)&&void 0!==r?r:"")+" "+(null!==(t=e.last_name)&&void 0!==t?t:""),id:e.id}}))}},cache:!0},placeholder:n,minimumInputLength:2}),t){var l=new Option(a,t,!0,!0);$(".user-select").append(l).trigger("change")}}))},181:()=>{}},t={};function a(e){var n=t[e];if(void 0!==n)return n.exports;var l=t[e]={exports:{}};return r[e](l,l.exports,a),l.exports}a.m=r,e=[],a.O=(r,t,n,l)=>{if(!t){var o=1/0;for(s=0;s<e.length;s++){for(var[t,n,l]=e[s],i=!0,u=0;u<t.length;u++)(!1&l||o>=l)&&Object.keys(a.O).every((e=>a.O[e](t[u])))?t.splice(u--,1):(i=!1,l<o&&(o=l));if(i){e.splice(s--,1);var d=n();void 0!==d&&(r=d)}}return r}l=l||0;for(var s=e.length;s>0&&e[s-1][2]>l;s--)e[s]=e[s-1];e[s]=[t,n,l]},a.n=e=>{var r=e&&e.__esModule?()=>e.default:()=>e;return a.d(r,{a:r}),r},a.d=(e,r)=>{for(var t in r)a.o(r,t)&&!a.o(e,t)&&Object.defineProperty(e,t,{enumerable:!0,get:r[t]})},a.o=(e,r)=>Object.prototype.hasOwnProperty.call(e,r),(()=>{var e={640:0,913:0};a.O.j=r=>0===e[r];var r=(r,t)=>{var n,l,[o,i,u]=t,d=0;if(o.some((r=>0!==e[r]))){for(n in i)a.o(i,n)&&(a.m[n]=i[n]);if(u)var s=u(a)}for(r&&r(t);d<o.length;d++)l=o[d],a.o(e,l)&&e[l]&&e[l][0](),e[l]=0;return a.O(s)},t=self.webpackChunk=self.webpackChunk||[];t.forEach(r.bind(null,0)),t.push=r.bind(null,t.push.bind(t))})(),a.O(void 0,[913],(()=>a(606)));var n=a.O(void 0,[913],(()=>a(181)));n=a.O(n)})();