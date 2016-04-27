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
	},
	//-> showTetris, nextTetris
	play:function(){
		var self = this;
		this.e_startBtn.html("暂停");
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
		$("html").keydown(function(e){
			if(!self.playing) return !self.playing;
			switch (e.keyCode) {
				case 37:
					self.direction = "left";
					break;
				case 38:
					self.direction = "top";
					break;
				case 39:
					self.direction = "right";
					break;
				case 40:
					self.direction = "bottom";
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
			if(this.rabbit===true){
				this.preTetris[j].removeClass("rabbit");
			}
		}
		for(var k=0, klen = this.thisTetris.length; k<klen; k++){
			this.thisTetris[k].addClass("active");
			if(this.rabbit===true){
				this.thisTetris[k].addClass("rabbit");
			}
		}
		this.preTetris = this.thisTetris.slice(0);
	},
	//judge whether levels are full -> getScore
	//if tetris touch the top layer -> gameOver
	tetrisDown:function(){
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
			this.level=this.tempLevel;
			/*console.log(this.level);
			$("#desc").remove();
			this.gameDesc("嘭！");
			console.log($("#desc").html());*/
			$("#description p").remove();
			$("#description").html("<p>嘭！</p>");
			console.log($("#description").html());
			this.sleep(1000);
			this.rabbit=false;
			/*$("#desc").remove();*/
			/*this.gameDesc("一个胖子的力量...");*/
			$("#description").empty();
			$("#description").html("<p>一个胖子的力量...</p>");
			console.log($("#description").html());
			$(".play_cell.active").removeClass("active");
			$(".play_cell.rabbit").removeClass("rabbit");
			this.sleep(1000);
			/*$("#desc").remove();*/
			$("#description").empty();
			this.score += 500;
			this.e_playScore.html(this.score); 
			this.fullArr = [];
			this.nextTetris();
			return;
		}
		if(this.fullArr.length){
			this.getScore();
			return;
		}
		for(var i = 6; i<9; i++){
			if(this.cellArr[i].hasClass("active")){
				this.gameOver("没关系，人生还长嘛！😏");
				return;
			}
		}
		//end the game for no reason with 0.1% probability
		if(ran<0.001){
			this.gameOver("不知道为什么，game over了，人生就是这么艰难。😏");
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
		if(Math.random()>0.5){
			this.rabbit=true;
		}
		if(this.rabbit){
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
			}this.sleep(500);
			
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
		$.ajax({
			url: 'index.php/game/insert',
			type: 'POST', 
			data: {score:play_score},
			//async:false,
		})
		.done(function(return_data) {
                                                                                   if(!return_data)
                                                                                   {
                                                                                        alert("请登入");
                                                                                   }
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log(play_score);
			console.log("complete");
		});
		
		this.gameAlert(over_alert);
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
		var html='<div id="desc">'+cont+'</div>';
		$('#play_area').append(html);
	}*/
};
$(document).ready(function(e) {
	var t = new Tetris();
});