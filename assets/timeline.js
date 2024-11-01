(function(){function VerticalTimeline(element){this.element=element;this.blocks=this.element.getElementsByClassName("js-cd-block");this.images=this.element.getElementsByClassName("js-cd-img");this.contents=this.element.getElementsByClassName("js-cd-content");this.offset=0.8;this.hideBlocks();};VerticalTimeline.prototype.hideBlocks=function(){if(!"classList"in document.documentElement){return;}
var self=this;for(var i=0;i<this.blocks.length;i++){(function(i){if(self.blocks[i].getBoundingClientRect().top>window.innerHeight*self.offset){self.images[i].classList.add("cd-is-hidden");self.contents[i].classList.add("cd-is-hidden");}})(i);}};VerticalTimeline.prototype.showBlocks=function(){if(!"classList"in document.documentElement){return;}
var self=this;for(var i=0;i<this.blocks.length;i++){(function(i){if(self.contents[i].classList.contains("cd-is-hidden")&&self.blocks[i].getBoundingClientRect().top<=window.innerHeight*self.offset){self.images[i].classList.add("wbc-timeline__img--bounce-in");self.contents[i].classList.add("wbc-timeline__content--bounce-in");self.images[i].classList.remove("cd-is-hidden");self.contents[i].classList.remove("cd-is-hidden");}})(i);}};var verticalTimelines=document.getElementsByClassName("js-wbc-timeline"),verticalTimelinesArray=[],scrolling=false;if(verticalTimelines.length>0){for(var i=0;i<verticalTimelines.length;i++){(function(i){verticalTimelinesArray.push(new VerticalTimeline(verticalTimelines[i]));})(i);}
window.addEventListener("scroll",function(event){if(!scrolling){scrolling=true;(!window.requestAnimationFrame)?setTimeout(checkTimelineScroll,250):window.requestAnimationFrame(checkTimelineScroll);}});}
function checkTimelineScroll(){verticalTimelinesArray.forEach(function(timeline){timeline.showBlocks();});scrolling=false;};})();
