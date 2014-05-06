NavigationManager.module("Entities", 
	function ( Entities, NavigationManager, Backbone, Marionette, $, _) {
	
	Entities.PostType = Backbone.Model.extend({
	});

	Entities.PostTypeCollection = Backbone.Collection.extend({
		model: Entities.PostType,
	    url: ginger_ajax.ajax_url + '/post/types',
		//url: '../wp-content/plugins/ginger-easynavi/slim-bootstrap.php',
	});	
		
	var postTypes;

	var initializePostTypes = function () {
		
	}

	var api = {
		getPostTypeEntities: function(){
			var postTypes = new Entities.PostTypeCollection ();
			var defer = $.Deferred();

			postTypes.fetch({
				data: {
					'action': 'ginger_navi'
				},

				success: function (data) {
					defer.resolve(data);
				},
			
				reset: true,
			});
			
			/**
			 *  need to add some error handler
			 *  
			 */	


			return defer.promise();
		}
	};

	NavigationManager.reqres.setHandler("postType:entities",
		function(){
			return api.getPostTypeEntities();
	});

	Entities.ListItem = Backbone.Model.extend({
		defaults: {
			post_url: '',
			parent_post_type: '',
		}
	});	

	Entities.ListItemCollection = Backbone.Collection.extend({
		model: Entities.listItem,
		url: ginger_ajax.ajax_url + (this.model == undefined)? '' : this.model.parent_post_type, 
	});	

});
