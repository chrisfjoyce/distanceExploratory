Rickshaw.namespace("Rickshaw.Graph.Axis.X"),Rickshaw.Graph.Axis.X=function(t){var i=this,e=.1;this.initialize=function(t){this.graph=t.graph,this.orientation=t.orientation||"top",this.pixelsPerTick=t.pixelsPerTick||75,t.ticks&&(this.staticTicks=t.ticks),t.tickValues&&(this.tickValues=t.tickValues),this.tickSize=t.tickSize||4,this.ticksTreatment=t.ticksTreatment||"plain",t.element?(this.element=t.element,this._discoverSize(t.element,t),this.vis=d3.select(t.element).append("svg:svg").attr("height",this.height).attr("width",this.width).attr("class","rickshaw_graph x_axis_d3"),this.element=this.vis[0][0],this.element.style.position="relative",this.setSize({width:t.width,height:t.height})):this.vis=this.graph.vis,this.graph.onUpdate(function(){i.render()})},this.setSize=function(t){if(t=t||{},this.element){this._discoverSize(this.element.parentNode,t),this.vis.attr("height",this.height).attr("width",this.width*(1+e));var i=Math.floor(this.width*e/2);this.element.style.left=-1*i+"px"}},this.render=function(){void 0!==this._renderWidth&&this.graph.width!==this._renderWidth&&this.setSize({auto:!0});var i=d3.svg.axis().scale(this.graph.x).orient(this.orientation);i.tickFormat(t.tickFormat||function(t){return t}),this.tickValues&&i.tickValues(this.tickValues),this.ticks=this.staticTicks||Math.floor(this.graph.width/this.pixelsPerTick);var s=Math.floor(this.width*e/2)||0,h;if("top"==this.orientation){var a=this.height||this.graph.height;h="translate("+s+","+a+")"}else h="translate("+s+", 0)";this.element&&this.vis.selectAll("*").remove(),this.vis.append("svg:g").attr("class",["x_ticks_d3",this.ticksTreatment].join(" ")).attr("transform",h).call(i.ticks(this.ticks).tickSubdivide(0).tickSize(this.tickSize));var r=("bottom"==this.orientation?1:-1)*this.graph.height;this.graph.vis.append("svg:g").attr("class","x_grid_d3").call(i.ticks(this.ticks).tickSubdivide(0).tickSize(r)).selectAll("text").each(function(){this.parentNode.setAttribute("data-x-value",this.textContent)}),this._renderHeight=this.graph.height},this._discoverSize=function(t,i){if("undefined"!=typeof window){var s=window.getComputedStyle(t,null),h=parseInt(s.getPropertyValue("height"),10);if(!i.auto)var a=parseInt(s.getPropertyValue("width"),10)}this.width=(i.width||a||this.graph.width)*(1+e),this.height=i.height||h||40},this.initialize(t)};