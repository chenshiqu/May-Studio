// JavaScript Document
var Tetris = function(options){
	this.e_playArea = $("#play_area");
	this.e_startBtn = $("#play_btn_start");
	this.e_rstBtn=$("#play_rst");
	this.e_playScore = $("#play_score");
	this.e_playDirection = $("#play_direction");
	this.e_levelBtn = $("#play_btn_level");
	this.e_levelMenu = $("#play_menu_level");
	this.e_nextType = $("#play_nextType");
	
	this.cellCol = 15;
	this.cellRow = 24;
	this.cellArr = [];
	this.miniCellArr = [];
	this.score = 0;
	this.direction = "bottom";
	this.timer = null;
	this.interval = [600,300,100,50];
	this.levelScore = [10,20,40];
	this.doubleScore = [1,4,10,20];
	this.level = 1;
	this.tempLevel=1;
	
	this.playing = false;
	this.turning = false;
	this.death = false;
	this.rabbit=false;
	this.ifTetrisDown=false;
	
	this.offsetCol = Math.floor(this.cellCol/2);
	this.offsetRow = -3;
	this.offsetFix = 0;
	this.tetrisArr = [];
	this.tetrisArr[0] = [[0,1,this.cellCol,this.cellCol+1],[0,1,this.cellCol,this.cellCol+1]];
	this.tetrisArr[1] = [[1,this.cellCol-1,this.cellCol,this.cellCol+1],[0,this.cellCol,this.cellCol*2,this.cellCol*2+1],
						 [this.cellCol-1,this.cellCol,this.cellCol+1,this.cellCol*2-1],[-1,0,this.cellCol,this.cellCol*2]
						];
	this.tetrisArr[2] = [[-1,this.cellCol-1,this.cellCol,this.cellCol+1],[0,1,this.cellCol,this.cellCol*2],
						 [this.cellCol-1,this.cellCol,this.cellCol+1,this.cellCol*2+1],[0,this.cellCol,this.cellCol*2-1,this.cellCol*2]
						];
	this.tetrisArr[3] = [[0,this.cellCol,this.cellCol+1,this.cellCol*2+1],[this.cellCol,this.cellCol+1,this.cellCol*2-1,this.cellCol*2]];
	this.tetrisArr[4] = [[0,this.cellCol-1,this.cellCol,this.cellCol*2-1],[this.cellCol-1,this.cellCol,this.cellCol*2,this.cellCol*2+1]];
	this.tetrisArr[5] = [[0,this.cellCol-1,this.cellCol,this.cellCol+1],[0,this.cellCol,this.cellCol+1,this.cellCol*2],
						 [this.cellCol-1,this.cellCol,this.cellCol+1,this.cellCol*2],[0,this.cellCol-1,this.cellCol,this.cellCol*2]
						];
	this.tetrisArr[6] = [[0,this.cellCol,this.cellCol*2,this.cellCol*3],[this.cellCol-1,this.cellCol,this.cellCol+1,this.cellCol+2]];
	this.tetrisType = [1,1];
	this.tetrisType = [1,0];
	this.tetrisTypeArr = [];
	
	this.preTetris = [];
	this.thisTetris = [];
	this.fullArr = [];
	
	this.start();
};
Tetris.prototype = {
	//start the game, ->init, menu, control
	start:function(){
		this.init();
		this.menu();
		this.control();
	},
	//set the difficulty options
	setOptions:function(options){
		this.score = options.score === 0 ? options.score : (options.score|| this.score);
		this.level = options.level === 0 ? options.level : (options.level|| this.level);
	},
	//clear the grid and set score as 0
	resetArea:function(){
		$(".play_cell.active").removeClass("active");
		$("#description").empty();
		this.setOptions({
			"score": 0
		});
		this.e_playScore.html(this.score);
	},
	//start button -> play/pause/reset
	//level button -> setOptions
	//reset button -> pause, resetArea
	menu:function(){
		var self = this;
		
		this.e_startBtn.click(function(){
			/*self.e_levelMenu.hide();*/
			if(self.playing){
				self.pause();
			}else if(self.death){
				self.resetArea();
				self.play();
			}else{
				self.play();
			}
		});
		$("#play_start_m").click(function(){
			/*self.e_levelMenu.hide();*/
			if(self.playing){
				self.pause();
			}else if(self.death){
				self.resetArea();
				self.play();
			}else{
				self.play();
			}
		});
		this.e_levelMenu.find("a").click(function(){
			if(self.playing) return;
			$(".level_menu li a").removeClass("current_level");
			$(this).addClass("current_level");
			self.setOptions({
				"level": $(this).attr("level")
			});
		});
		this.e_rstBtn.click(function(){
			var ran=Math.random();
			if(ran<0.5){
				self.pause();
				self.gameAlert("人生这么艰难，你说重来就重来？😏");
			}else{
				self.pause();
				self.resetArea();
				clearInterval(self.timer);
				self.preTetris = [];
				self.offsetRow = -2;
				self.offsetCol = 7;
				self.tetrisType = self.nextType;
				self.nextType = self.tetrisTypeArr[Math.floor(self.tetrisTypeArr.length * Math.random())];
				self.showNextType();
			}
		});
		$("#play_reset_m").click(function(){
			var ran=Math.random();
			if(ran<0.5){
				self.pause();
				self.gameAlert("人生这么艰难，你说重来就重来？😏");
			}else{
				self.pause();
				self.resetArea();
				clearInterval(self.timer);
				self.preTetris = [];
				self.offsetRow = -2;
				self.offsetCol = 7;
				self.tetrisType = self.nextType;
				self.nextType = self.tetrisTypeArr[Math.floor(self.tetrisTypeArr.length * Math.random())];
				self.showNextType();
			}
		});
		$("#direction_up").click(function(){
			if(!self.playing) return !self.playing;
			self.direction="top";
			self.changTetris();
		});
		$("#direction_left").click(function(){
			if(!self.playing) return !self.playing;
			self.direction="left";
			if(self.offsetCol > 0) self.offsetCol --;
			self.showTetris(self.direction);
		});
		$("#direction_right").click(function(){
			if(!self.playing) return !self.playing;
			self.direction="right";
			self.offsetCol ++;
			self.showTetris(self.direction);
		});
		$("#direction_down").click(function(){
			if(!self.playing) return !self.playing;
			self.direction="bottom";
			if(self.offsetRow < self.cellRow-2) self.offsetRow ++;
			self.showTetris(self.direction);
		});
	},
	//-> showTetris, nextTetris
	play:function(){
		var self = this;
		this.e_startBtn.html("暂停");
		$("#play_start_m").html("P");
		this.playing = true;
		this.death = false;
		if(this.turning){
			this.timer = setInterval(function(){
				self.offsetRow++;
				self.showTetris();
			},this.interval[this.level]);
		}else{
			this.nextTetris();
		}
		
	},
	//
	pause:function(){
		this.e_startBtn.html("开始")
		$("#play_start_m").html("S");
		this.playing = false;
		clearTimeout(this.timer);
	},
	//initiation, ->showNextType
	init:function(){
		var self = this, _ele, _miniEle, _arr = [];
		//build the grid
		for(var i = 0; i < this.cellRow; i++){
			for(var j = 0; j < this.cellCol; j++){
				_ele = document.createElement("div");
				_ele.className = "play_cell";
				_ele.id = "play_cell_" + i + "_" + j;
				this.cellArr.push($(_ele));
				this.e_playArea.append(_ele);
			}
		}
		//build the preview grid
		for(var m = 0; m<16; m++){
			_miniEle = document.createElement("div");
			_miniEle.className = "play_mini_cell";
			this.miniCellArr.push($(_miniEle));
			this.e_nextType.append(_miniEle);
		}
		//
		for(var k = 0, klen = this.tetrisArr.length; k<klen; k++){
			for(var j = 0, jlen = this.tetrisArr[k].length; j<jlen; j++){
				this.tetrisTypeArr.push([k,j]);
			}
		};
		
		this.nextType = this.tetrisTypeArr[Math.floor(this.tetrisTypeArr.length * Math.random())];
		this.showNextType();
		
	},
	//keydown event
	//-> drive
	control:function(){
		var self = this;
		if(self.playing){
			$("#play_area").bind('swipeup',function(){self.direction="top";console.log("swipeup");});
			$("#play_area").bind('swipedown',function(){self.direction="bottom";});
			$("#play_area").bind('swipeleft',function(){self.direction="left";});
			$("#play_area").bind('swiperight',function(){self.direction="right";});
		}
		$("html").keydown(function(e){
			switch (e.keyCode) {
				case 37:
					self.direction = "left";
					if(!self.playing) return !self.playing;
					break;
				case 38:
					self.direction = "top";
					if(!self.playing) return !self.playing;
					break;
				case 39:
					self.direction = "right";
					if(!self.playing) return !self.playing;
					break;
				case 40:
					self.direction = "bottom";
					if(!self.playing) return !self.playing;
					break;
				case 32:
					self.direction = "start";
					break;
				default:
					return;
					break;
			}
			self.e_playDirection.html(self.direction);
			self.drive();
			return false;
		})
	},
	//change the direction of current tetris
	changTetris:function(){
		var _len = this.tetrisArr[this.tetrisType[0]].length;
		if(this.tetrisType[1] < _len-1){
			this.tetrisType[1]++;
		}else{
			this.tetrisType[1] = 0;
		}
	},
	//inplement the function of control
	//->changTetris
	drive:function(){
		
		switch (this.direction) {
			case "left":
				if(this.offsetCol > 0) this.offsetCol --;
				break;
			case "top":
				this.changTetris();
				break;
			case "right":
				this.offsetCol ++;
				break;
			case "bottom":
				if(this.offsetRow < this.cellRow-2) this.offsetRow ++;
				break;
			case "start":
				if(this.playing){
					this.pause();
				}else if(this.death){
					this.resetArea();
					this.play();
				}else{
					this.play();
				}
				break;
			default:break;
		}
		this.showTetris(this.direction);
	},
	//show tetris in the grid
	//-> tetrisDown
	showTetris:function(dir){
		var _tt = this.tetrisArr[this.tetrisType[0]][this.tetrisType[1]],
		_ele,self=this;
		this.turning = true;
		this.thisTetris = [];
		for(var i=_tt.length-1; i>=0; i--){
			_ele = this.cellArr[_tt[i] + this.offsetCol + this.offsetRow * this.cellCol];
			if(this.offsetCol<7 && (_tt[i] + this.offsetCol + 1)%this.cellCol == 0){
				this.offsetCol ++;
				return;
			}else if(this.offsetCol>7 && (_tt[i] + this.offsetCol)%this.cellCol == 0){
				this.offsetCol --;
				return;
			}
			if(_ele && _ele.hasClass("active") && dir == "left" && ($.inArray(_ele,this.preTetris)<0)){
				if(($.inArray(_ele, this.cellArr) - $.inArray(this.preTetris[i], this.cellArr)) % this.cellCol !=0){
					this.offsetCol ++;
					return;
				}
			}
			if(_ele && _ele.hasClass("active") && dir == "right" && ($.inArray(_ele,this.preTetris)<0)){
				if(($.inArray(_ele, this.cellArr) - $.inArray(this.preTetris[i], this.cellArr)) % this.cellCol !=0){
					this.offsetCol --;
					return;
				}
			}
			if(_ele){
				if(_ele.hasClass("active") && ($.inArray(_ele,this.preTetris)<0)){
					this.tetrisDown();
					return;
				}else{
					this.thisTetris.push(_ele);
				}
			}else if(this.offsetRow > 0 ){
				this.tetrisDown();
				return;
			}
		};
		
		for(var j=0, jlen = this.preTetris.length; j<jlen; j++){
			this.preTetris[j].removeClass("active");
			if(this.rabbit) this.preTetris[j].removeClass("rabbit");
		}
		for(var k=0, klen = this.thisTetris.length; k<klen; k++){
			this.thisTetris[k].addClass("active");
			if(this.rabbit) this.thisTetris[k].addClass("rabbit");
			
		}
		if(this.rabbit&&this.preTetris.length>0){
			this.preTetris[this.preTetris.length-1].empty();
			
			
		}
		if(this.rabbit){
			this.thisTetris[this.thisTetris.length-1].append("<img src='images/fat-rabbit.png'>");
		}
		this.preTetris = this.thisTetris.slice(0);
	},
	forceRefresh_1:function(){
		$("#description p").remove();
		$("#description").html("<p>一个胖子的力量...😏</p>");
		$(".play_cell.active").removeClass("active");
		$(".play_cell.rabbit").removeClass("rabbit");
		
		$(".play_cell").empty();
		setTimeout(self.forceRefresh_2,1000);
		return;
	},
	forceRefresh_2:function(){
		
		$("#description p").remove();
		
		$("#play_area.play_cell.active").css("background","black");
		self.score += 500;
		self.e_playScore.html(self.score); 
		self.fullArr = [];
		self.nextTetris();
		return;
	},
	//judge whether levels are full -> getScore
	//if tetris touch the top layer -> gameOver
	tetrisDown:function(){
		this.ifTetrisDown=true;
		self=this;
		clearInterval(this.timer);
		var _index;
		var ran=Math.random();
		this.turning = false;
		
		forOuter:
		for(var j = 0, jlen = this.preTetris.length; j<jlen; j++){
			_index = $.inArray(this.preTetris[j],this.cellArr);
			for(var k = _index - _index%this.cellCol, klen = _index - _index%this.cellCol + this.cellCol; k<klen; k++){
				if(!this.cellArr[k].hasClass("active")){
					continue forOuter;
				}
			}
			if($.inArray(_index - _index%this.cellCol,this.fullArr)<0) this.fullArr.push(_index - _index%this.cellCol);
		}
		
		if(this.rabbit===true){
			this.rabbit=false;
			
			this.level=this.tempLevel;
			$("#description p").remove();
			$("#description").html("<p>嘭！</p>");
			setTimeout(this.forceRefresh_1,1000);
			return;
		}
		if(this.fullArr.length){
			this.getScore();
			return;
		}
		for(var i = 6; i<9; i++){
			if(this.cellArr[i].hasClass("active")){
				this.gameOver("GAME OVER了，没关系，人生还长嘛！😏");
				return;
			}
		}
		//end the game for no reason with 0.1% probability
		if(ran<0.01){
			this.gameOver("不知道为什么，GAME OVER了，人生就是这么艰难。😏");
			return;
		}
		this.nextTetris();
	
	},
	
	
	//get next type of tetris randomly, ->showNextType, showTetris
	nextTetris:function(){
		var self = this;
		clearInterval(this.timer);
		this.preTetris = [];
		this.offsetRow = -2;
		this.offsetCol = 7;
		this.tetrisType = this.nextType;
		this.nextType = this.tetrisTypeArr[Math.floor(this.tetrisTypeArr.length * Math.random())];
		this.showNextType();
		//generate a rabbit tetris with 0.5% probability
		if(Math.random()>0.99){
			this.rabbit=true;
		}
		if(this.rabbit){
			$("#play_area.play_cell.active").css("background","none");
			this.tempLevel=this.level;
			this.level=3;
			/*this.gameDesc("啊...");*/
			$("#description").append("<p>啊...</p>");
		}
		this.timer = setInterval(function(){
			self.offsetRow++;
			self.showTetris();
		},this.interval[this.level]);
	},
	//show next type of tetris in the menu
	showNextType:function(){
		var _nt = this.tetrisArr[this.nextType[0]][this.nextType[1]],_ele,_index;
		this.e_nextType.find(".active").removeClass("active");
		for(var i = 0, ilen = _nt.length; i<ilen; i++){
			if(_nt[i] > this.cellCol-2){
				_index = (_nt[i]+2)%this.cellCol-2 + 1 + 4*parseInt((_nt[i]+2)/this.cellCol);
			}else{
				_index = _nt[i] + 1;
			}
			_ele = this.miniCellArr[_index];
			_ele.addClass("active");
		}
	},
	sleep:function(n) { //n表示的毫秒数
            var start = new Date().getTime();
            while (true){ if (new Date().getTime() - start > n) break};
    },
	//calculate the score
	getScore:function(){
		var self = this;
		
		for(var i = this.fullArr.length-1; i>=0; i--){
			for(var j = 0; j<this.cellCol; j++){
				this.cellArr[j+this.fullArr[i]].removeClass("active");
				
				if(j === this.cellCol-1){
					for(var k = this.fullArr[i]; k>=0; k--){
						if(this.cellArr[k].hasClass("active")){
						this.cellArr[k].removeClass("active");
						this.cellArr[k + this.cellCol].addClass("active");
						}
					}
				}
			}
			
		}
		this.score += this.levelScore[this.level]*this.doubleScore[this.fullArr.length-1];
		this.e_playScore.html(this.score); 
		this.fullArr = [];
		this.nextTetris();
	},
	//-> pause
	gameOver:function(over_alert){
		this.death = true;
		this.pause();
		
		//get and upload score
		var play_score=$('#play_score').html();

		var state; //user state
		$.ajax({
			url: 'index.php/game/insert',
			type: 'POST', 
			data: {score:play_score},
			async:false,
		})
		.done(function(return_data) {
                                                                                   state=return_data;
                                                                                   console.log(state);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log(play_score);
			console.log("complete");
		});
		
		//this.gameAlert(over_alert);
		/*console.log(state);
		if(state==1)
		{*/
			this.gameAlert(over_alert);
		//}
		/*else
		{
			this.gameAlert("请先登入");
		}*/
		this.resetArea();
		return;
	},
	//pop the alert box
	gameAlert:function(cont){
		var html='<div id="alert_background"></div><div id="alert_box"><div id="alert_cont">'+cont+'</div><a href="javascript:void(0);" class="alert_button">好吧！</a><a href="javascript:void(0);" class="alert_button">傻逼！</a></div>';
		$('body').append(html);
		$('.alert_button').click(function(){
			$('#alert_background').remove();
			$('#alert_box').remove();
		});
	},
	/*gameDesc:function(cont){
		var html='<p>'+cont+'</p>';
		$('#description').append(html);
	}*/
};
$(document).ready(function(e) {
	var t = new Tetris();
});


