NavigationManager.module("NavigationApp.List",
	function ( List, ContactManager, Backbone, Marionette, $, _ ) {
	List.Controller = {
		listPostTypeGroups: function () {	
			var	postTypes =
				ContactManager.request("postType:entities");	
			
			$.when(postTypes).done( function (postTypesDeferred) {
					
				console.log(postTypesDeferred.models);
				_.each( postTypesDeferred.models, function ( value, key, list ) {
					console.log(value);
					list[key].url = ginger_ajax.ajax_url + '/post/types/' + value.attributes.post_type;
				});
				
				console.log(postTypesDeferred.models);
				
				var postTypeGroupsView = new List.PostTypeGroups({
					collection: postTypesDeferred
				});
				
				NavigationManager.mainRegion.show(postTypeGroupsView);
			});	
		},
		
		listPostTypeItems: function () {
			
		}
	}
});
