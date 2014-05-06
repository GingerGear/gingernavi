NavigationManager.module("NavigationApp.List", 
	function ( List, NavigationManager, Backbone, Marionette, $, _ ) {
	
	List.PostTypeItem = Marionette.ItemView.extend({
		template: $( '#list-item-template' ).html(),

		tagName: 'li',

		render: function () {
			var html = Mustache.to_html( this.template, this.model.toJSON() );
    		this.$el.html( html );
			return this;
		}
	});
	
	List.PostTypeGroup = Marionette.CompositeView.extend({
		className: 'panel panel-primary',

		tagName: 'div',
	   	
		template: $( '#navi-template' ).html(), 

		itemView: List.PostTypeItem,

		itemViewContainer: 'ul',
			
		events: {
			"click .collapsed": function (e) {
				e.preventDefault();
				e.stopPropagation();
				this.model.fetch({
					data: {
						'action': 'ginger_navi',
					},	
				});
			}
		},
		
	   	initialize: function () {
			//this.listenTo( this.model, 'change', this.render );
		},	

	    render: function () {
			var html = Mustache.to_html( this.template, this.model.toJSON() );
    		this.$el.html( html );
			return this;
		},


	});
	
	List.PostTypeGroups = Marionette.CollectionView.extend ({
		id: 'navi-list',

		className: 'panel-group',

		itemView: List.PostTypeGroup,		
	});

});
