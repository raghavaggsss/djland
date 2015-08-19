(function (){
    var app = angular.module('djland.editPlaysheet',['djland.api','djland.utils','ui.sortable','ui.bootstrap']);
	var shows;
	app.controller('PlaysheetController',function($filter,call){
   
    	this.id = id;
    	this.socan = socan;
    	this.name = name;
    	this.tags = tags;
    	this.help = help;
		this.shows = Array();
		var this_ = this;

		call.getPlaysheetData(5000).then(function(data){
			//this_.shows = data;
			//this_.playsheet_id = data.data.playsheet_id;
			var playsheet = data.data;
			this_.playsheet = playsheet.playsheet;
			this_.playitems = playsheet.playitems;
			this_.ads = playsheet.ads;
			this_.edit_date = playsheet.edit_date;
			this_.host_names = playsheet.hosts;
		});  
    });

    //Declares <playitem> tag
    app.directive('playitem',function(){
    	return{
    		restrict: 'A',
    		templateUrl: 'templates/playitem.html'
    	};
    });
    app.directive('ad',function(){
    	return{
    		restrict: 'A',
    		templateUrl: 'templates/ad.html'
    	}
    });
    var socan = true;
    
	var id = '101';
	var name = 'Test Show';
})();