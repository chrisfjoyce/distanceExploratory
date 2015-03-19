Rickshaw.namespace('Rickshaw.Graph.RangeSliderY');

Rickshaw.Graph.RangeSliderY = Rickshaw.Class.create({

	initialize: function(args) {

		var element = this.element = args.element;
		var graph = this.graph = args.graph;

		this.slideCallbacks = [];

		this.build();

		graph.onUpdate( function() { this.update() }.bind(this) );
	},

	build: function() {

		var element = this.element;
		var graph = this.graph;
		
		var maximum = graph.max;
		var minimum = graph.min;
		
		if(typeof minimum == 'undefined')
		{
			minimum = 0;
		}		
		

		var self = this;

		$( function() {
			$(element).slider( {
				range: true,
				min: minimum,
				max: maximum,
				values: [ 
					minimum,
					maximum
				],
				slide: function( event, ui ) {

					if (ui.values[1] <= ui.values[0]) return;

					//graph.window.xMin = ui.values[0];
					//graph.window.xMax = ui.values[1];
					graph.min = ui.values[0];
					graph.max = ui.values[1];
					//console.log(graph.min + "," + graph.max );
					graph.update();

//					var domain = graph.dataDomain();
					
					//if we're at an extreme, stick there
					/*
					if (domain[0] == ui.values[0]) {
						graph.min = undefined;
						console.log("At Extreme Min");
					}

					if (domain[1] == ui.values[1]) {
						graph.max = undefined;						
						console.log("At Extreme Max");
						
					}
					*/

					self.slideCallbacks.forEach(function(callback) {
						callback(graph, graph.window.xMin, graph.window.xMax);
					});
				}
			} );
		} );

		//$(element)[0].style.height = graph.height + 'px';

	},

	update: function() {

		var element = this.element;
		var graph = this.graph;

		var values = $(element).slider('option', 'values');

		//var domain = graph.dataDomain();

/*
		$(element).slider('option', 'min', domain[0]);
		$(element).slider('option', 'max', domain[1]);

		if (graph.window.xMin == null) {
			values[0] = domain[0];
		}
		if (graph.window.xMax == null) {
			values[1] = domain[1];
		}
		*/

		$(element).slider('option', 'values', values);
	},

	onSlide: function(callback) {
		this.slideCallbacks.push(callback);
	}
});

