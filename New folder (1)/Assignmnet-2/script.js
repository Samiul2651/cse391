function Gererate_Quote() {
	var quotes= ["Wise men speak because they have something to say; fools because they have to say something.",
        "If opportunity doesn’t knock, build a door.", 
        "If you don’t make mistakes, you’re not working on hard enough problems." ,
        "Courage is what it takes to stand up and speak. Courage is also what it takes to sit down and listen." ,
        "Do what you can, with what you have, where you are.", 
        "Peace comes from within. Do not seek it without."];
	var length = quotes.length;
	var quoteNumber = Math.floor(Math.random() * (length));
	document.getElementById('quote').innerText = quotes[quoteNumber];
	
}

function Change_Color(box) {

    if (box === 'box1') {
        document.getElementById('quote_generator').style.color = 'yellow';
        document.getElementById('quote_generator').style.borderColor = 'yellow';
        document.getElementById('quote_generator').style.backgroundColor = 'green';
        document.getElementById('quote_generator').style.fontSize = '18px';
        document.getElementById('quote_generator').style.fontFamily = 'sans-serif';
    }
    else if (box === 'box2') {
        document.getElementById('quote_generator').style.color = 'green';
        document.getElementById('quote_generator').style.borderColor = 'green';
        document.getElementById('quote_generator').style.backgroundColor = 'yellow';
        document.getElementById('quote_generator').style.fontSize = '16px';
        document.getElementById('quote_generator').style.fontFamily = 'cursive';
    }
    else if (box === 'box3') {
        document.getElementById('quote_generator').style.color = 'blue';
        document.getElementById('quote_generator').style.borderColor = 'blue';
        document.getElementById('quote_generator').style.backgroundColor = 'orange';
        document.getElementById('quote_generator').style.fontSize = '20px';
        document.getElementById('quote_generator').style.fontFamily = 'monospace';
    }
    else {
        document.getElementById('quote_generator').style.color = 'red';
        document.getElementById('quote_generator').style.borderColor = 'red';
        document.getElementById('quote_generator').style.backgroundColor = 'black';
        document.getElementById('quote_generator').style.fontSize = '22x';
        document.getElementById('quote_generator').style.fontFamily = 'fantasy';
    }
    Gererate_Quote();
}

function ConvertUnit(type, unit){
    var changedUnit = 0;
    var unitName = "";
    if(type == '1'){
        var changedUnit = unit / 2.2046;
        unitName = "kilograms";
    }
    else{
        var changedUnit = unit * 2.2046;
        unitName = "pounds";
    }
    document.getElementById("output").innerText = changedUnit.toFixed(4) + unitName;
}

function calculateAll(text) {
    var list = text.split(',');
    //console.log(list);
    var editedList = [];
    var max = 0;
    var min = 0;
    var sum = 0;
    var first = true;
    for(i of list){
        const isValidNumber = !isNaN(i);
        if(isValidNumber && i != ""){
            var number = Number(i);
            if(first){
                max = number;
                min = number;
                first = false;
            }
            if(number > max){
                max = number;
            }
            if(number < min){
                min = number;
            }
            sum = sum + max;
            editedList.push(number);
        }
    }
    //console.log(editedList);
    var length = editedList.length;
    var avg = sum / length;
    var reversedText = text.split(',').reverse().join(',');
    var reversedEditedText = editedList.reverse().join(',');
    document.getElementById("min").innerText = min;
    document.getElementById("max").innerText = max;
    document.getElementById("sum").innerText = sum;
    document.getElementById("average").innerText = avg;
    document.getElementById("reverse").innerText = reversedEditedText;
}


function clearAll(){
    document.getElementById('magic_box').value = "";
}
var cap = 0;
function capitalize() {
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    var newLines = [];
    if(cap % 2 == 0){
    	for(i of lines){
            newLines.push(i.toUpperCase());
    	}
    }
    else{
    	for(i of lines){
            newLines.push(i.toLowerCase());
    	}
    }
    cap += 1;
    var newText = newLines.join('\n');
    document.getElementById('magic_box').value = newText;
}

function sortText(){
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    lines.sort();
    var newText = lines.join('\n');
    document.getElementById('magic_box').value = newText;
}

function reverseText(){
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    var newLines = [];
    for(i of lines){
        var j = i.split('');
        var k = j.reverse().join('');
        newLines.push(k);
    }
    var newText = newLines.join('\n');
    document.getElementById('magic_box').value = newText;
}

function stripBlank(){
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    var newLines = [];
    for(i of lines){
        var j = "";
        var letters = i.split('');
        var f = false;
        for(k of letters){
            if(k != " "){
                f = true;
            }
            if(f){
                j += k;
            }
        }
        if(j != ""){
            var l = j.split('').reverse();
            var m = false;
            var r = [];
            for(k of l){
                if(k != " "){
                    m = true;
                }
                if(m){
                    r.push(k);
                }
            }
            j = r.reverse().join('');
            newLines.push(j);
        }
    }
    var newText = newLines.join('\n');
    document.getElementById('magic_box').value = newText;
}


function addNumbers() {
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    for(var i = 0;i < lines.length; i++){
        var j = (i+1);
        var k = j + ') ' + lines[i];
        lines[i] = k;
    }
    var newText = lines.join('\n');
    document.getElementById('magic_box').value = newText;
}

function shuffleText(){
    var text = document.getElementById('magic_box').value;
    var lines = text.split('\n');
    var n = lines.length;
    var j = 0;
    var list = [];
    var newLines = [];
    while(j < n){
        var k = Math.floor(Math.random() * n);
        if(!list.includes(k)){
            list.push(k);
            j += 1;
        }
    }
    for(i of list){
        newLines.push(lines[i]);
    }
    var newText = newLines.join('\n');
    document.getElementById('magic_box').value = newText;
}
