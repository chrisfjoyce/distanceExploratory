Rickshaw.namespace("Rickshaw.Graph.Renderer.ScatterPlot"),Rickshaw.Graph.Renderer.ScatterPlot=Rickshaw.Class.create(Rickshaw.Graph.Renderer,{name:"scatterplot",defaults:function(t){return Rickshaw.extend(t(),{unstack:!0,fill:!0,stroke:!1,padding:{top:.01,right:.01,bottom:.01,left:.01},dotSize:4})},initialize:function(t,e){t(e)},render:function(t){t=t||{};var e=this.graph,r=t.series||e.series,a=t.vis||e.vis,i=this.dotSize;a.selectAll("*").remove(),r.forEach(function(t){if(!t.disabled){var r=a.selectAll("path").data(t.stack.filter(function(t){return null!==t.y})).enter().append("svg:circle").attr("cx",function(t){return e.x(t.x)}).attr("cy",function(t){return e.y(t.y)}).attr("r",function(t){return"r"in t?t.r:i});t.className&&r.classed(t.className,!0),Array.prototype.forEach.call(r[0],function(e){e.setAttribute("fill",t.color)})}},this)}});