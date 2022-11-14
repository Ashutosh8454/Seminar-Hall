
         let date=new Date();
         let year=date.getFullYear();
         let month=date.getMonth()+1;
         let day=date.getDate();
         console.log(year);
         console.log(month);
         console.log(day);
         if (month<10) {
             month="0"+month;
         }
         if (day<10) {
             day="0"+day;
         }
         let today=year+"-"+month+"-"+day;
         document.getElementById("i6").setAttribute("min",today);
 
         let starttime=document.getElementById("i4");
         let endtime=document.getElementById("i5");
         console.log(starttime.value);
         // starttime.addevent
         endtime.addEventListener('click',()=>{
             if(starttime.value.length==0)
             {
                 alert("Please select start time first");
                 endtime.value="";
             }else{
                 endtime.value=starttime.value;
             }
         })
         endtime.addEventListener("change",function(){
             if(starttime.value.length==0)
             {
                 alert("Please select start time first");
                 endtime.value="";
             }
             if (endtime.value<starttime.value) {
                 alert("End time should be greater than start time");
                 endtime.value="";
             }
         });