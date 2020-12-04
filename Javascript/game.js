const canvas = document.querySelector('canvas')
//const height = document.querySelector('content').height
const c = canvas.getContext('2d')
canvas.width = 300
canvas.height = 500
var circlenum = 1
var score = 0
var circles=[]
var bullets=[]
var state=null
var lastDownTarget
var keydown=false
var bestscore = 0

var GameState=null
 updateKeys = function(key){
  currentKey = key.keyCode
  state.updateInput(currentKey)
 }
function menuState(text){
    this.text = text
}
menuState.prototype.update = function(){
}
menuState.prototype.updateInput = function(key){
if(key==32)
    {
        state= new playState()
    }
}
menuState.prototype.draw=function(){
 c.beginPath()
 c.fillText(this.text, (canvas.width/2)-(c.measureText(this.text).width/2),canvas.height/2)
 c.fillStyle = 'white'
 c.fill()
 c.closePath()
}

function playState(){
    createCircles()
    this.player= new player(canvas.width/2)
}

playState.prototype.update = function(){
    circles.forEach(circle => {
        circle.update()
        circle.collisionCheck(this.player)
    })
    bullets.forEach(bullet => {
        bullet.update()
    })
    for(let i=0;i<=bullets.length-1;i++)
        {
            if(bullets[i].y<=0){
                bullets.splice(i,1)
            }
            for(let f=0; f<=circles.length-1;f++)
                {

                    if( hitBox(circles[f],bullets[i]))
                    {
                        score++
                        bullets.splice(i,1)
                        circles.splice(f,1)
                        if(circles.length<1)
                        {
                            circlenum++
                            createCircles()
                        }
                    }
                }
            }
            
    this.player.update()
}
function hitBox( source, target ) {
        var myleft = source.x
        var myright = source.x + (source.size)
        var mytop = source.y
        var mybottom = source.y + (source.size)
        var otherleft = target.x
        var otherright = target.x + (target.size)
        var othertop = target.y
        var otherbottom = target.y + (target.size)
        return!((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright))
}
playState.prototype.updateInput = function(key){
    this.player.updateInput(key)
}
playState.prototype.draw = function(){
 c.beginPath()
 c.fillText("Score: " + score, 0,20)
 c.fillStyle = 'white'
 c.fill()
 c.closePath()
    this.player.draw()    
    bullets.forEach(bullet => {
    bullet.draw()
 })
        circles.forEach(circle => {
    circle.draw()
 })
//draw score

}


function player(x){
this.size=20
this.x=x-(this.size/2)
this.y=canvas.height-this.size
}
player.prototype.updateInput = function(key){
    if(key==65 || key==37 ){
        if(!(this.x<=0)){
            this.x=this.x-5
        }
    }
    if(key==68 || key==39 ){
        if(!(this.x>=(canvas.width-this.size))){
            this.x=this.x+5
        }
    }
    if(key==32){
        bullets.push(new bullet(this.x+(this.size/2),this.y))
    }
}
player.prototype.draw = function(){
    c.beginPath()
    c.rect(this.x,this.y,this.size,this.size)
    c.fillStyle = 'white'
    c.fill()
    c.closePath()
}
player.prototype.update = function(){
    
}

//bullet
function bullet(x,y){
    this.x=x
    this.y=y
    this.size = 5
}
bullet.prototype.update = function(){
    this.y-=3
}
bullet.prototype.draw = function(){
    c.beginPath()
    c.rect(this.x,this.y,this.size,this.size)
    c.fillStyle = 'white'
    c.fill()
    c.closePath()
}

// Circle objects
function Circle(x, y, radius, color) {
 this.x = x
 this.y = y
 if(this.y>=canvas.height-60)
    {
        this.y=this.y-60
    }
 this.size = radius
 this.color = color
 this.velocity = {
 x: ((Math.random()* 6) - 3), 
 y: ((Math.random()* 6) - 3)
 }
}
Circle.prototype.draw = function() {
 c.beginPath()
 c.arc(this.x, this.y, this.size, 0, Math.PI * 2, false)
 c.fillStyle = this.color
 c.fill()
 c.closePath()
}
Circle.prototype.collisionCheck = function(object){
     if(hitBox(object, this))
        {
            state=new endGame()
        }
}




//end game/leader board
function endGame(){
this.text = "End of game, your score was: " + score
this.text2 = "Press space to play again"
this.text3= "Best score so far: " + bestscore
uploadScore()
}
endGame.prototype.draw = function(){
 c.beginPath()
 c.fillText(this.text, (canvas.width/2)-(c.measureText(this.text).width/2),(canvas.height/2)-100)
 c.fillText(this.text2, (canvas.width/2)-(c.measureText(this.text2).width/2),(canvas.height/2)-125)
 c.fillText(this.text3, (canvas.width/2)-(c.measureText(this.text3).width/2),(canvas.height/2)-150)
 c.fillStyle = 'white'
 c.fill()
 c.closePath()
}
endGame.prototype.update = function(){
this.text3= "Best score so far: " + bestscore
}
endGame.prototype.updateInput = function(key){
    if(key==32)
        {
            bullets=[]
            circles=[]
            circlenum=1
            score=0
            state = new playState()
        }
}


Circle.prototype.update = function() {
 this.draw()

 if(this.x>=(canvas.width-this.size)){
    this.velocity.x=-this.velocity.x
    }
 if(this.y>=(canvas.height-this.size)){
    this.velocity.y=-this.velocity.y
    }
 if(this.x<=(0+this.size)){
    this.velocity.x=-this.velocity.x
    }
 if(this.y<=(0+this.size)){
    this.velocity.y=-this.velocity.y
    }
 this.x += this.velocity.x // Move x coordinate
 this.y += this.velocity.y // Move y coordinate
}
function createCircles(){ 
    for (let i = 0; i < circlenum; i++) {
        const x = Math.random() * canvas.width
        const y = Math.random() * canvas.height
        const radius = 5
        const color = 'white'
        circles.push(new Circle(x, y, radius, color))
    }
}
// Implementation
function init() {
 c.font = "20px Arial"
    state= new menuState("- press space to play -")
    output = document.getElementById("output")
    document.onkeydown = updateKeys
    animate()
}

// Animation Loop
function animate() {
 requestAnimationFrame(animate) 
 c.clearRect(0, 0, canvas.width, canvas.height) // empt canvas
 state.update()
 state.draw()
}

function uploadScore() {
    var xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            bestscore = this.responseText;
        }
    }
    xmlhttp.open("GET", "process/gamedata.php?q=" + score, true)
    xmlhttp.send()
}

init()