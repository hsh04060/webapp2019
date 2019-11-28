/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */
"use strict";

var loser = null;  // whether the user has hit a wall

window.onload = function() {
    $("start").observe("click",startClick);
    var boundary = $$(".boundary");
    for(var i=0;i<boundary.length-1;i++){
        boundary[i].observe("mouseover",overBoundary);
    }
    $("end").observe("mouseover",overEnd);
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    this.addClassName("youlose");
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    var boundary = $$(".boundary");
    for(var i=0;i<boundary.length-1;i++){
        boundary[i].removeClassName("youlose");
    }
    loser = null;
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    var boundary = $$(".boundary");
    for(var i=0;i<boundary.length-1;i++){
        if(boundary[i].hasClassName("youlose")){
            loser = true;
        }
    }
    var text = $("status");
    if(loser){text.innerHTML = "You lose! :(";}
    else{text.innerHTML = "You win! :)";}
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    var boundary = $$(".boundary");
    for(var i=0;i<boundary.length-1;i++){
        boundary[i].addClassName("youlose");
    }
    var text = $("status");
    text.innerHTML = "You lose! :(";
}



