NavigationManager.module("NavigationApp.List",
	function ( List, ContactManager, Backbone, Marionette, $, _ ) {
	List.Controller = {
		listPostTypeGroups: function () {	
			var	postTypes =
				ContactManager.request("postType:entities");	
			
			$.when(postTypes).done( function (postTypesDeferred) {
				console.log(postTypesDeferred.models[0].attributes);
				var postTypeGroupsView = new List.PostTypeGroups({
					collection: postTypesDeferred
				});

				NavigationManager.mainRegion.show(postTypeGroupsView);
			});	
		},
		
		listPostTypeListItem: function () {
			
		}
	}
});
