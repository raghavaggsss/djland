window.myNameSpace = window.myNameSpace || { };
var re = new RegExp(/^.*\//);
var api_base = "" + re.exec(window.location.origin)['input'] + '/api2/public/';
var site_base = "" + re.exec(window.location.origin)['input'];
console.log(api_base);

function Playsheet(){
	var this_ = this;
	var member_id = $('#member_id').text() || 1;
	var requests = Array();
		


	this.initialize = function(id){
		this.getMemberShows(member_id);
		this.start = {};
		this.end = {};
		$.when(requests['show_load']).then(function(){
			if(id != null && id > 0){
				this_.load(id);
			}else{
				this_.info = {};
				this_.podcast = {};
				this_.playitems = Array();
				this_.ads = Array();
				//TODO
				this_.getNextShowtime();
				//Get next show time
				//Get ads
				this_.info.id = -1;
				this_.podcast.id = -1;
			}
		});

	}
	

	this.load = function(id){
		requests['load'] = 
			$.ajax({
				type:"GET",
				url: api_base + "playsheet/"+id,
				dataType: "json",
				async: true
			}).then(function(response){
				this_.info = response.playsheet;
				this_.playitems = response.playitems;
				this_.podcast = response.podcast;
	          	this_.setStart(this_.info.start_time.replace(/-/g,'/'));
	        	this_.setEnd(this_.info.end_time.replace(/-/g,'/'));
			},function(error){
				return false;
				//TODO: Log Error Message
			})
		
	}
	
	this.create = function(){
		var this_ = this;
		//Create Playsheet
		$.ajax({
			type:"PUT",
			url: api_base+ "show/playsheet",
			dataType: "json",
			async: true
		}).then(function(response){
			this_.info.id = response;
			//Create Podcast
			$.ajax({
				type:"PUT",
				url: api_base+ "playsheet/"+this_.info.id+"/podcast",
				dataType: "json",
				async: true
			}).then(function(response){
				this_.podcast.id = response;
				return true;
			},function(error){
				return false;
				//TODO: Log Error
			});
		},function(error){
			return false;
			//TODO: Log Error
		});
	};
	this.save = function(){
		var this_ = this;
		//Save Playsheet
		var playsheet_save = $.ajax({
			type:"POST",
			url: api_base+ "playsheet/"+this_.id,
			data: {'playsheet':this_.info},
			dataType: "json",
			async: true
		}).then(function(response){
			return true;
		},function(error){
			return false;
		});
		//Save Podcast
		$.ajax({
			type:"POST",
			url: api_base+ "playsheet/"+this_.id+'/podcast',
			dataType: "json",
			data: {'podcast':this_.podcast},
			async: true
		}).then(function(response){
			return true;
		},function(error){
			return false;
		});
		//Save Playitems
		for(var playitem in this.playitems){
			$.ajax({
				type:"POST",
				url: api_base+"playsheet/"+this_.id+'/ads/'+this.playitems[playitem]['id'],
				data: {"playitem": this_.playitems[playitem]} ,
				dataType: "json",
				async: true,
			}).then(function(response){

			},function(error){
				this_.error = true;
				this_.logError(error);
			});
		}
		//Save Ads
		for(var ad in this.ads){
			$.ajax({
				type:"POST",
				url: api_base+ "playsheet/"+this_.id+'/ads/'+this.ads[ad]['id'],
				dataType: "json",
				async: true,
				data: {'ad':this.ads[ad]}
			}).then(function(response){

			},function(error){
				this_.error = true;
				this_.logError(error);
			});
		}
	};
	this.delete = function(){
		return $.ajax({
			type:"DELETE",
			url: api_base+ "playsheet/"+this.id,
			dataType: "json",
			async: true
		}).then(function(response){
			return true;
		},function(error){
			return false;
		});
	};

	this.checkUnique = function(){
		requests['unique_check'] = 
			$.ajax({
				type:"GET",
				url: api_base+ "playsheet/where/unixtime/"+this_.info.unix_time,
				dataType: "json",
				async: true
			}).then(
				function(response){
					if(response.length > 0) this_.load(response[0].id);
				}
			);
	};

	this.getMemberShows = function(member_id){
		requests['show_load'] = 
			$.ajax({ 
				type:"GET",
				url: api_base + "member/"+member_id + '/active_shows',
				dataType: "json",
				async: true
			}).then(
				function(shows){
					this_.shows = shows;
					this_.show=this_.shows[0];
				},
				function(error){
					//TODO: Log Error
				}
			)
		
	}
	this.getNextShowtime = function(){

		requests['show_time'] = 
			$.ajax({ 
				type:"GET",
				url: api_base + "show/"+this_.show['id'] + '/nextshow',
				dataType: "json",
				async: true
			}).then(
				function(response){
					this_.info.unix_time = response.start;
					this_.setStart(response.start * 1000);
        			this_.setEnd(response.end * 1000);
					this_.checkUnique();
					console.log(this_);

				}
			);
	}



	//Mutators
	this.setActiveShow = function(id){
		this.show = this.shows.filter(function(object){if(object.id == id) return object;})[0];
	}
	this.setStartUnix = function(unix){
		this.info.unix_time = unix;
		//TODO: Get promotions
	};
	this.setStartUnixMilli = function(millsecond_unix){
		this.info.unix_time = millsecond_unix / 1000;
	};
	this.setStart = function(date){
		console.log("In Date"+ date);
		var date = new Date(date);
		console.log("Out Date"+date);
		this.start.date = date;
		this.start.hour = date.getHours();
		this.start.minute = date.getMinutes();
		this.start.second = date.getSeconds();
		console.log(this.start);
	}
	this.setStartDate = function(date){
		var date = new Date(date  * 1000);
		date.setHours(this.info.start_time.getHours());
		date.setMinutes(this.info.start_time.getMinutes());
		date.setSeconds(this.info.start_time.getSeconds());
		this.info.start_time = date;

	};
	this.setStartHour = function(hour){
		var date = new Date(this.start_time);
		date.setHours(hour);
		this.info.start_time = date;
	};
	this.setStartMinute = function(minute){
		var date = new Date(this.start_time);
		date.setMinutes(minute);
		this.info.start_time = date;
	};
	this.setStartSecond = function(second){
		var date = new Date(this.start_time);
		date.setSeconds(second);
		this.start_time = date;
	};
	this.setEnd = function(date){
		var date = new Date(date);
		this.end.date = date;
		this.end.hour = date.getHours();
		this.end.minute = date.getMinutes();
		this.end.second = date.getSeconds();
	}
	this.setEndDate = function(date){
		var date = new Date(date);
		date.setHours(this.end_time.getHours());
		date.setMinutes(this.end_time.getMinutes());
		date.setSeconds(this.end_time.getSeconds());
		this.info.end_time = date;
	};
	this.setEndHour = function(hour){
		var date = new Date(this.end_time);
		date.setHours(hour);
		this.info.end_time = date;
	};
	this.setEndMinute = function(minute){
		var date = new Date(this.end_time);
		date.setMinutes(minute);
		this.info.end_time = date;
	};
	this.setEndSecond = function(second){
		var date = new Date(this.end_time);
		date.setSeconds(second);
		this.info.end_time = date;	
	};
	this.setShowId = function(id){
		this.info.show_id = id;
	}
	this.setStatus = function(status){
		this.info.status = status;
	}
	//Getters
	this.addPlayitem = function(index){
		var this_ = this;
		$.ajax({
			type:"PUT",
			url: api_base+ "playsheet/"+this_.info.id+"/playitem",
			dataType: "json",
			async: true
		}).then(function(response){
			this_.playitems.splice(index+1,0,response);
			$.ajax({
				type:"POST",
				url: site_base+"/templates/playitem.php",
				dataType: "json",
				data: {"playitem":response,"index":index},
				async: true
			}).then(
				function(html){
					$('#playitems').append(html);
				}
			);
			
		});
	}
	this.removePlayitem = function(index){
		var this_ = this;
		$.ajax({
			type:"DELETE",
			url: api_base+ "playsheet/"+this_.info.id+"/playitem/"+this_.playitems[index].id,
			dataType: "json",
			async: true
		}).then(function(response){
			this_.playitems.splice(index,1);
			if(this_.playitems.length < 1){
                $('#addRows').text("Add Row");
            }
		},function(error_response){
			//LOG ERROR
		});
	}

}

	
	

	
