// JavaScript Document
var canvas=document.getElementById('canvas'),
	context=canvas.getContext('2d'),
	controls=document.getElementById('controls'),
	
	sun=new Image(),
	cloud=new Image(),
	tree=new Image(),
	friend=new Image(),
	spritesheet = new Image(),
    runnerCells = [
      { left: 0,   top: 0, width: 275, height: 135 },
      { left: 290,  top: 0, width: 275, height: 135 },
      { left: 575, top: 0, width: 270, height: 135 },
      { left: 860, top: 0, width: 265, height: 135 },
      { left: 1140, top: 0, width: 270, height: 135 },
      { left: 1425, top: 0, width: 275, height: 135 },
      { left: 1715, top: 0, width: 275, height: 135 },
    ],
	
	
	lastTime=0,
	lastFpsUpdate={time:0, value:0},
	fps=60,
	
	cloudOffset=0,
	friendOffset=0,
	
	CLOUD_VELOCITY=8,
	FRIEND_VELOCITY=20;
	
// Behaviors.................................................

    runInPlace = {
       lastAdvance: 0,
       PAGEFLIP_INTERVAL: 100,

       execute: function (sprite, context, time) {
          if (time - this.lastAdvance > this.PAGEFLIP_INTERVAL) {
             sprite.painter.advance();
             this.lastAdvance = time;
          }
       }
    },
	moveLeftToRight = {
       lastMove: 0,
       
       execute: function (sprite, context, time) {
         if (this.lastMove !== 0) {
           sprite.left += sprite.velocityX *
                          ((time - this.lastMove) / 1000); 

           if (sprite.left > canvas.width) {
              sprite.left = -275;
           } 
         }
         this.lastMove = time;
       }
    },


    // Sprite....................................................

    sprite = new Sprite('runner',
                        new SpriteSheetPainter(runnerCells),
                        [runInPlace, moveLeftToRight ]);

function erase(){
	context.clearRect(0,0,canvas.width,canvas.height);
}

function draw(){
	
	
	cloudOffset=cloudOffset<canvas.width?cloudOffset+CLOUD_VELOCITY/fps:0;
	friendOffset=friendOffset<canvas.width?friendOffset+FRIEND_VELOCITY/fps:0;
	
	context.save();
	context.translate(-cloudOffset,0);
	context.drawImage(cloud,0,0);
	context.drawImage(cloud,1000,0);
	context.restore();
	
	context.save();
	context.translate(-friendOffset,0);
	context.drawImage(tree,30,canvas.height/2.4);
	//context.drawImage(friend,0,canvas.height/1.55);
	context.drawImage(tree,1030,canvas.height/2.4);
	//context.drawImage(friend,1000,canvas.height/1.55);
	context.restore();
 
   
}

function calculateFps(now){
	var fps=1000/(now-lastTime);
	lastTime=now;
	return fps;
}

function animate(now){
	if(now===undefined){
		now=+new Date;
	}
	fps=calculateFps(now);
	
	erase();
	draw();
	sprite.update(context, now);
   sprite.paint(context);
	requestNextAnimationFrame(animate);
}

context.font='48px Helvetica';
sun.src="./images/sun.png";
cloud.src="./images/cloud.png";
tree.src="./images/tree.png";
friend.src="./images/friend.png";
spritesheet.src = './images/sprite.png';



sprite.velocityX = 100;  // pixels/second
sprite.left = -275;
sprite.top = 100;


cloud.onload=function(e){
	draw();
};

requestNextAnimationFrame(animate);