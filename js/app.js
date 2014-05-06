( function ($) {
	/**
	 *	Backbone model for navigation list
	 */

	var Navigation = Backbone.Model.extend({
		defaults: {
			post_types: '',
		},
	});

	var Navigation_list = Backbone.Collection.extend({
		model: Navigation,
	    url: ginger_ajax.ajax_url + '/post/types',
		//url: '../wp-content/plugins/ginger-easynavi/slim-bootstrap.php',
	});

	var Navigations = new Navigation_list();

	var Navigation_view = Backbone.View.extend({
		tagName: 'div',

		template: $( '#navi-template' ).html(), 

	   	initialize: function () {
			this.listenTo( this.model, 'change', this.render );
		},	

		attributes: function () {
			return {
				'id': 'navi-list',
				'class': 'panel panel-primary',
			};
		},

	    render: function () {
			var html = Mustache.to_html( this.template, this.model.toJSON() );
    		this.$el.html( html );
			return this;
		}
	});
		
	var App_view = Backbone.View.extend({
		el: $( '#ginger-navi-app' ),
		
	    initialize: function() {
			this.listenTo(Navigations, 'reset', this.add_all);
			//console.log(Navigations.toJSON());
			//Navigations.trigger('reset');
		
			Navigations.fetch({
				data: {
					'action': 'ginger_navi'
				},

				reset: true
			});
		},

	    add_one: function( navigation ) {
			var view = new Navigation_view({ 
					model: navigation, 
			});
			this.$el.append(view.render().el);
		},	
		
		add_all: function() {
			Navigations.each(this.add_one, this);
		}
	});	
	
	var App = new App_view();
})(jQuery);

