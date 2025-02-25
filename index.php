<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
    
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
            background-color: #f5f5f5;
        }
        .countdown {
            font-size: 50px;
            color: #333;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        .label {
            font-size: 25px;
            margin-top: 10px;
        }
        .checkbox-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 10px;
        }
        .custom-checkbox {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 16px;
        }

        .custom-checkbox input {
         display: none;
        }

        .custom-checkbox .checkmark {
         width: 20px;
         height: 20px;
         border: 2px solid #555;
         border-radius: 4px;
          margin-right: 8px;
         transition: background-color 0.2s ease;
        }

        .custom-checkbox input:checked + .checkmark {
         background-color: #4caf50;
         border-color: #4caf50;
         position: relative;
        }

        .custom-checkbox input:checked + .checkmark::after {
         content: '';
         position: absolute;
         top: 4px;
         left: 7px;
        width: 5px;
         height: 10px;
        border: solid white;
         border-width: 0 2px 2px 0;
        transform: rotate(45deg);
        }
        
    </style>
</head>
<body>
    <h1 id= "title">Countdown to Break</h1>
    
    
    <div class="countdown" id="countdown"></div>
    
     <div class="text" id="testText"></div>
    
    <div class="checkbox-container" style ="margin: 0 auto;">
        
    <label class="custom-checkbox">
      <input id = "breakbox"  type="radio" name="time" />
      <span class="checkmark"></span>
      Break
     </label><br>
     
     <label class="custom-checkbox">
      <input id = "lessonbox"  type="radio"name = "time" />
      <span class="checkmark"></span>
      Lesson
     </label><br>
      
    
    
  </div>
  

    
    <div class="label" id="countdown-label"></div>

 
     
    <script>
        /*var data = null;

        var xhr = new XMLHttpRequest();
        xhr.withCredentials = true;
        
        xhr.addEventListener("readystatechange", function () {
          if (this.readyState === this.DONE) {
            let package = this.responseText;
          }
        });
        
        xhr.open("GET", "https://api.collectapi.com/time/timezone?data.city=berlin");
        xhr.setRequestHeader("content-type", "application/json");
        xhr.setRequestHeader("authorization", "apikey 0iLN9ujEVivHbV7sij8B6A:56SF0LP24e1r7SGN9jwFRL");
        
        xhr.send(data);
        //document.getElementById("textText").innerHtml = package;*/
        const timeTable = [
            "07:45:00",
            "08:40:00",
            "09:30:00",
            "10:35:00",
            "11:30:00",
            "12:25:00",
            "13:20:00",
            "14:10:00",
            "15:00:00",
            "15:50:00"
            
            
            
            
            
];
        const breakTable = [
             "07:00:00",
             "07:55:00",
             "08:45:00",
             "09:50:00",
             "10:45:00",
             "11:40:00",
             "12:35:00",
             "13:25:00",
             "14:15:00",
             "15:10:00"
             
            
];
        var countdown = document.getElementById("countdown");
        let Break = false;//document.getElementById("break").checked;
        
        document.getElementById("lessonbox").checked = true;
        
        let nextTime;
        /*document.getElementById("lessonbox").addEventListener("click", changeTable(false));
        document.getElementById("breakbox").addEventListener("click", changeTable(true));*/
        checkTime();
        
        /*function changeTable(pol){
            Break = pol;
            checkTime();
        }*/
        function checkTime(){ 
            Break = document.getElementById("breakbox").checked;
            if (!Break) {
                nextTime = findNextClosestTime(timeTable);
                document.getElementById("title").innerHTML = "Countdown to Break";
            } else if(Break) {
                nextTime = findNextClosestTime(breakTable);
                document.getElementById("title").innerHTML = "Countdown to Lesson";
            }
        }

        

        var countdownInterval = setInterval(function() {
            if(nextTime !== null){
                getDisplayTime(nextTime);
                //checkTime();
            } else {
                
                countdown.innerHTML = "GET OFF";
                /*let myWindow = open(location, "_self");
                myWindow.close();*/
            }      
        }, 1000);
        
        
        function getDisplayTime(table){
            checkTime();
            const [hours, minutes] = table.split(":").map(Number);
            let now = new Date().getTime();
            let targetDate = new Date();
            targetDate.setHours(hours);
            targetDate.setMinutes(minutes-1);
            targetDate.setSeconds(55);
    
            let timeRemaining = targetDate.getTime() - now;
        
            const minutesS = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const secondsS = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            
        
            
            
            if(secondsS > 0){
               countdown.innerHTML = minutesS + "m " + secondsS + "s";
            }
            else {
                //countdown.
                stopInerval(countdownInterval);
                countdown.innerHTML = "GO GO GO";
                Blik();
            }
            
            
        }
        
       function findNextClosestTime(times){
            const now = new Date().getTime();
            for (let i = 0; i < times.length; i++){
                if(now < convertToMidnight(times[i])){
                    //console.log(now+":"+convertToMidnight(times[i]));
                    return times[i];
                }
        
            }
            return null;
        }
        function convertToMidnight(time){
            const [hours, minutes, seconds] = time.split(":").map(Number);
            let targetTime = new Date();
            targetTime.setHours(hours);
            targetTime.setMinutes(minutes);
            targetTime.setSeconds(seconds);
            return targetTime.getTime();
        }
       
    </script>
  
    
</body>
</html>
