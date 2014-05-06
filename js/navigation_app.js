var NavigationManager = new Marionette.Application();

NavigationManager.addRegions({
	mainRegion: "#ginger-navi-app",
});

NavigationManager.on("initialize:after", function(){
	NavigationManager.NavigationApp.List.Controller.listPostTypeGroups();
});

jQuery( document ).ready( function () {
	NavigationManager.start();
});
