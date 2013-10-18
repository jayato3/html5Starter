/*
 *	Avoid console errors in browsers without consoles
 */
if(!(window.console&&console.log)){(function(){var noop=function(){};var methods=["assert","clear","count","debug","dir","dirxml","error","exception","group","groupCollapsed","groupEnd","info","log","markTimeline","profile","profileEnd","markTimeline","table","time","timeEnd","timeStamp","trace","warn"];var length=methods.length;var console=window.console={};while(length--){console[methods[length]]=noop}}())};

/*
 *	ClassIE
 *	Detects versions of Internet Explorer
 *
 *	Version     : 0.3.0
 *	Author      : Aurélien Delogu (dev@dreamysource.fr)
 *	Homepage    : https://github.com/pyrsmk/ClassIE
 *	License     : MIT
 */
this.IE=-1;/*@cc_on (function(a){var b=a.createElement("div"),c=function(a){b.innerHTML="<!--[if IE "+a+"]>1<![endif]-->";return b.innerHTML==1},d=6;if(!c("5.5000"))while(!c(d)&&++d<10);a.documentElement.className+=" ie"+d,this.IE=d})(document) @*/